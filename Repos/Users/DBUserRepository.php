<?php namespace App\Repos\Users;
use App\Repos\Users\UserRepository;
use App\User;
use App\Models\Otp;

use App\Http\Controllers\AppController;

class DBUserRepository implements UserRepository {
	protected $model, $otpModel;

	public function __construct(User $model, Otp $otpModel) {
		$this->model = $model;
		$this->otpModel = $otpModel;
	}

	public function addUser($userData) {
		return $this->model->create($userData);
	}

	public function verifyOtp($vData) {
		if($this->model->whereEmail($vData['email'])->whereOtp($vData['code'])->count()) {
			$this->model->whereEmail($vData['email'])->update(['verified' => 1]);
			return true;
		}
		return false;
	}

	public function getOtpDetails($email) {
		return $this->model->whereEmail($email)->first(['name','email','otp','verified']);
	}

	public function userVerified($email) {
		return $this->model->whereEmail($email)->value('verified');	
	}

	public function firstUser() {
		return $this->model->first();	
	}
}