<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Http\Requests;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\AppController;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Http\Requests\SocialLoginRequest;
use App\Http\Requests\LoginRequest;
use App\Events\UserRegistered;
use App\Repos\Users\UserRepository;
use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends AppController
{
	protected $userRepo;
	public function __construct(UserRepository $userRepo) 
  {
  	$this->userRepo = $userRepo;
  }

  public function postAdd(CreateUserRequest $request) 
  {  	
  	try {
  		$request['password'] = bcrypt($request->password);
      $request['otp'] = (new AppController)->generateOtp(6);
      $saveUser = $this->userRepo->addUser($request->all());
      $request['user_id'] = $saveUser->id;
      event(new UserRegistered($request->except('password')));
  		$response = $request->except('password','otp');
      $success = true;
  	} catch (Exception $e) {
  		$response = $e;
      $success = false;
  	} finally {
  		return ['status' => 200,'success' => $success,'userData' => $response];
  	}
  }

  public function postVerifyOtp(VerifyOtpRequest $request) 
  {
    if(!$this->userRepo->userVerified($request->email)) {
      if($this->userRepo->verifyOtp($request))
        return ['status' => 200, 'success' => true, 'verified_status' => true, 'message' => 'Validated'];
    } else {
      return ['status' => 200, 'success' => false, 'verified_status' => true, 'message' => 'Already Verified'];
    }
    return ['status' => 200, 'success' => false, 'verified_status' => null, 'message' => 'Invalid Code'];
  }

  public function getResendOtp($email) 
  {
    if(!$this->userRepo->userVerified($email)) {
      try {
        $user = $this->userRepo->getOtpDetails($email);
        (new AppController)->shootEmail($user->email, $user->name, 'Your OTP', ['otp' => $user->otp, 'name' => $user->name], 'emails.resend-otp');
        $success = true;
        $message = 'OTP Sent';
        $verified_status = false;
      } catch(Exception $e) {
        $success = false;
        $message = 'OTP Resend Failed';
        $verified_status = null;
      }
    } else {
      $success = true;
      $message = 'Already Verified';
      $verified_status = true;
    }
    return response()->json(['status' => 200, 'success' => $success, 'verified_status' => $verified_status, 'message' => $message]);
  }

  public function getAccountStatus($email) 
  {
    if($this->userRepo->userVerified($email))
      return ['status' => 200, 'success' => true, 'verified_status' => true, 'message' => 'Verified'];
    return ['status' => 200, 'success' => false,'verified_status' => false, 'message' => 'Pending Verification'];  
  }

  public function postLogin(LoginRequest $request) {
    $loginDetails = $request->only('email','password');
    try {
      if (! $token = JWTAuth::attempt($loginDetails)) {
        return response()->json([
          'status' => 401,
          'success' =>  false,
          'token'   =>  null,
          'userData'  =>  null,
          'message' => 'Invalid Credentials'
        ], 401);
      }
    } catch (JWTException $e) {
        return response()->json([
          'status' => 500,
          'success' =>  false,
          'token'   =>  null,
          'userData'  =>  null,
          'message' => 'Internal Server Error'
        ], 500);
    }

    return response()->json([
      'status' => 200,
      'success' =>  true,
      'token'   =>  $token,
      'userData'  =>  $this->userRepo->getUser($request->email),
      'message' => 'Login Success'
    ], 200);

  }

  public function postAuthenticatedUser()
  {
    if (! $user = JWTAuth::parseToken()->authenticate()) {
      return response()->json([
        'status'  =>  404,
        'success' =>  false,
        'userData' => null,
        'message'  => 'Invalid Token'
      ], 404);
    }
    return response()->json([
      'status'  =>  200,
      'success' =>  true,
      'userData' => $user,
      'message'  => 'Valid Token'
    ], 200);
  }

  public function postSocialLogin(SocialLoginRequest $request) 
  {
    return [
      'status'  =>  200,
      'success'   =>  true,
      'token'     =>  (new AppController)->generateOtp(40),
      'userData'  =>  $this->userRepo->firstUser()
    ];
  }

  public function getProfile($userId) 
  {
    return [
      'status'  =>  200,
      'success'   =>  true,
      'userData'  =>  $this->userRepo->firstUser()
    ];
  }

  public function postProfile() 
  {
    return [
      'status'  =>  200,
      'success'   =>  true,
      'userData'  =>  $this->userRepo->firstUser()
    ];
  }

}
