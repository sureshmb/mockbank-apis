<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Repos\Exams\ExamRepository;

class ExamsController extends AppController
{
  protected $examRepo;

  public function __construct(ExamRepository $examRepo) 
  {
    $this->examRepo = $examRepo;
  }
  public function getList($type = 'all', $offset = 0, $count = -1) 
  {
    $total_records = $this->examRepo->getCount();
    $result = $this->examRepo->getList($type, $offset, $count);
  	switch ($type) {
  	  case 'all':
  	  case 'upcoming':
  	    return response()->json([
  	    	'status' => 200, 
  	    	'success'=> true, 
  	    	'data' => $result, 
  	    	'total_records' => $total_records, 
  	    	'message'	=>	'Success Response'
  	    ],200);
  	    break;
  	  case 'my':
  	  	try {
	        if ($user = JWTAuth::parseToken()->authenticate()) {
	          return response()->json([
	          	'status' => 200, 
	          	'success'=> true, 
	          	'data' => $result, 
	          	'total_records' => $total_records, 
	          	'message'	=>	'success_response'
	          ],200);
	        }
		    } catch (TokenExpiredException $e) {
		      return response()->json([
		      	'status'	=>	$e->getStatusCode(),
		      	'success'	=>	false,
		      	'data'		=>	null,
		      	'total_records'	=>	null,
		      	'message'	=>	'token_expired'
		      ], $e->getStatusCode());
		    } catch (TokenInvalidException $e) {
			      return response()->json([
			      	'status'	=>	$e->getStatusCode(),
			      	'success'	=>	false,
			      	'data'		=>	null,
			      	'total_records'	=>	null,
			      	'message'	=>	'invalid_token'
			      ], $e->getStatusCode());
		    } catch (JWTException $e) {
		      return response()->json([
		      	'status'	=>	$e->getStatusCode(),
		      	'success'	=>	false,
		      	'data'		=>	null,
		      	'total_records'	=>	null,
		      	'message'	=>	'token_absent'
		      ], $e->getStatusCode());
		    }
  	    break;  
  	  default:
  	    break;
  	}
  }

  public function getSearchSuggestions($keyword) {
    return [
      'status'  =>  200,
      'success' =>  true,
      'keyword' =>  $keyword,
      'data'    => [
        [
          'exam_id'     =>  65,
          'exam_title'  =>  'Exam 54 Title',
          'confidence'  =>  0.7
        ],
        [
          'exam_id'     =>  645,
          'exam_title'  =>  'Exam 144 Title',
          'confidence'  =>  0.65
        ]
      ],
      'total_records' =>  250    
    ];      
  }

  public function getSearch($keyword, $offset = 0) {
    $examTypes = ['upcoming', 'my'];
    for ($i=$offset+1; $i <= $offset+ 20; $i++) { 
      $result [] = [
        'id' => $i,
        'title' => 'Exam Title - '.$i,
        'description' =>  'Description for Exam - '.$i,
        'image'       =>  \URL::to('/').'/course-images/img_'.$i.'.jpg'
      ];
    }
    return ['status' => 200, 'success' => true, 'data' => $result, 'total_records'  =>  250];
  }

  public function getInfo($exam_id) {

    $json_data = '{"page_title":"IBPS PO 2015-16 Exam Preparation","page_url":"www.mockbank.com\/ibps-po","exam_title":"IBPS PO 2015-16","exam_information_section_title_bar":"About IBPS PO 2015-16","date":"","status":"Admit Cards Out","name_of_post":"Probationary Officer","mode":"Online","selection_procedure":"<ul>\r\n\t<li>Phase 1: Preliminary Objective Test<\/li>\r\n\t<li>Phase 2: Mains Objective Test<\/li>\r\n\t<li>Phase 3: Interview<\/li>\r\n<\/ul>\r\n","dates_of_phase1":"","pattern_of_phase1":"","dates_of_phase2":"","pattern_of_phase2":"","dates_of_preliminary":["10\/03\/2015,10\/04\/2015,10\/11\/2015"],"pattern_of_preliminary":"<ul>\r\n\t<li>English Language (30 questions, 30 marks)<\/li>\r\n\t<li>Quantitative Aptitude (35 questions, 35 marks)<\/li>\r\n\t<li>Reasoning (35 questions, 35 marks)<\/li>\r\n<\/ul>\r\n","dates_of_mains":["10\/31\/2015"],"pattern_of_mains":"<ul>\r\n\t<li>Reasoning (50 questions, 50 marks)<\/li>\r\n\t<li>English Language (40 questions, 40 marks)<\/li>\r\n\t<li>Quantitative Aptitude (50 questions, 50 marks)<\/li>\r\n\t<li>General Awareness, with special reference to banking industry (40 questions, 40 marks)<\/li>\r\n\t<li>Computer Knowledge (20 questions, 20 marks)<\/li>\r\n<\/ul>\r\n","syllabus":"<p><strong>IBPS PO Reasoning&nbsp;Syllabus<\/strong>&nbsp;:- Reasoning Section covers all logical reasoning questions. Check&nbsp;<strong>&ldquo;Syllabus&nbsp;of IBPS PO Exam&rdquo;<\/strong>&nbsp;Logical Reasoning contains Verbal &amp; Non Verbal Category questions. Verbal reasoning means blood relation \/ Sitting arrangement \/ coding decoding \/ making series and Syllogism. Non verbal covers making series \/ analogy and classification.<\/p>\r\n\r\n<ul>\r\n\t<li>Number series<\/li>\r\n\t<li>letter &amp; symbol series<\/li>\r\n\t<li>statement and argument<\/li>\r\n\t<li>logical problems<\/li>\r\n\t<li>verbal reasoning<\/li>\r\n\t<li>blood relations<\/li>\r\n\t<li>coding-decoding<\/li>\r\n\t<li>number ranking<\/li>\r\n\t<li>making judgments etc.<\/li>\r\n<\/ul>\r\n\r\n<p><strong>IBPS PO English&nbsp;Syllabus<\/strong>&nbsp;: &nbsp;English language Syllabus of IBPS PO Exam is a common paper of&nbsp;basic&nbsp;English knowledge. it have General English , Comprehension &amp; Spelling sections which is<br \/>\r\n<strong>General English:<\/strong>&nbsp;Vocabulary, synonyms, Antonyms, Word formation and Sentence completion<br \/>\r\n<strong>Comprehension:<\/strong>&nbsp;Theme detection, Deriving conclusions, Passage completion, Error detection and Passage correction, Sentence correction<br \/>\r\n<strong>Spelling:<\/strong>&nbsp;Grammar, Idioms and Phrases contains IBPS PO&nbsp;Syllabus<\/p>\r\n\r\n<p><strong>IBPS PO Quantitative Aptitude&nbsp;Syllabus<\/strong>&nbsp;: Quantitative aptitude Syllabus of IBPS PO Exam papers contains&nbsp;Number system, HCF &amp; LCM,&nbsp;Number series, Problems based on numbers. Approximation Wrong Number, Decimal fractions, Square root and cube root, Simplifications. Partnerships, Percentage, Ratio and proportions, Average &amp; Ages Ratio &amp; Proportion. Profit and loss, Simple interest and compound interest, Time and work, Time and distance, Average, Mensuration. Permutation and combination, Data tables, Probability, Pie charts, Bar graphs, Line graphs, Mixed graphs, Case study. IBPS PO&nbsp;Syllabus&nbsp;Quantitative&nbsp;Aptitude paper&nbsp;cover all these.<\/p>\r\n","salary":"Scale I - 23700 - (980 x 7 ) - 30560 - (1145 x 2 ) - 32850 - (1310 x 7) - 42020","previous_year_cuttoff":[{"year":"2014","cutoff":"50"},{"year":"2013","cutoff":"55"}],"eligibilty_criteria":["Under IBPS PO Recruitment Eligibility Criteria 2015 Candidates must have completed their Graduation Degree from any recognized university or institution. Participants also required their mark sheet numbers while they submit IBPS PO online form 2015","Under IBPS Eligibility Criteria for PO 2015 Interested candidates must have age between 20 \u2013 30 years","Participants must have these citizenship which is given below..  Citizen of Indian Citizen of Nepal Citizen of Bhutan A Tibetan refugee Migrated Peoples from Pakistan, Burma, Sri Lanka, East African countries of Kenya, Uganda, the United Republic of Tanzania (formerly Tanganyika and Zanzibar), Zambia, Malawi, Zaire, Ethiopia and Vietnam with the intention of permanently settling in India."],"previous_year_papers":[],"notifications":{"description":"",  "notification_link":""},"marketing_benefits":["benefits1","benefits2","benefits3"]}';
    return [
      'status' => 200,
      'success' =>  true,
      'data' => json_decode($json_data)
    ];
  }

  public function getCourses($examId) {
  	try {
  		if($examWithCourses = $this->examRepo->getCourses($examId)) {
  			return response()->json([
  				'status'	       =>	200,
  				'success'	       =>	true,
  				'data'		       =>	$examWithCourses->courses,
          'total_records'  =>  $this->examRepo->getCoursesCount($examId),
  				'message'	       =>	'courses_retrieved'
  			], 200);
  		}
  	} catch (Exception $e) {
  		return response()->json([
				'status'	      =>	500,
				'success'	      =>	false,
				'data'		      =>	null,
        'total_records' =>  null,
				'message'	      =>	'server_response_failed'
			], 500);
  	}
  	
    // return [
    //   'status'  => 200, 
    //   'success' => true, 
    //   'data'    => [
    //     'courses' =>  [
    //       [ 'id' => 5637, 
    //         'title' => 'Course 1 Title', 
    //         'price' => 250, 
    //         'discounted_price' => 200, 
    //         'benefits' => [
    //           ['benefit_id' => 34,'credits' => 10],
    //           ['benefit_id' => 35,'credits' => 15]
    //         ],
    //         'tests' => [
    //           ['test_specification_id' => 25, 'credits' => 20, 'test_title' => 'Mock Tests'],
    //           ['test_specification_id' => 26, 'credits' => 10, 'test_title' => 'Subject Tests']
    //         ]
    //       ],
    //       [ 'id' => 5638, 
    //         'title' => 'Course 2 Title', 
    //         'price' => 450, 
    //         'discounted_price' => null, 
    //         'benefits' => [
    //           ['benefit_id' => 34,'credits' => 10],
    //           ['benefit_id' => 35,'credits' => 20],
    //           ['benefit_id' => 36,'credits' => 25]
    //         ],
    //         'tests' => [
    //           ['test_specification_id' => 25, 'credits' => 30, 'test_title' => 'Mock Tests'],
    //           ['test_specification_id' => 26, 'credits' => 15, 'test_title' => 'Subject Tests']
    //         ]
    //       ]
    //     ]
    //   ],
    //   'total_records' =>  650
    // ];
  }

  public function getCourseBenefits($courseId) {
    try {
      return response()->json([
        'status'  => 200,
        'success' =>  true,
        'data'    =>  $this->examRepo->getCourseBenefits($courseId),
        'message' =>  'course_benefits_response_success'
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'status'  => 500,
        'success' =>  true,
        'data'    =>  null,
        'message' =>  'course_benefits_response_failed'
      ], 500);
    }
  }

  public function getTestimonials($examId, $offset = 0, $count = -1) {
    try {
      return response()->json([
        'status'  =>  200,
        'success' =>  true,
        'data'    =>  $this->examRepo->getTestimonials($examId, $offset, $count),
        'total_records' =>  $this->examRepo->getTestimonialsCount($examId),
        'message' =>  'testimonials_response_success'
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'status'  =>  500,
        'success' =>  false,
        'data'    =>  null,
        'total_records' =>  null,
        'message' =>  'testimonials_response_failed'
      ], 500);
    }
    
  }

  public function getAssets($examId, $offset = 0, $count = -1) {
    try {
      return response()->json([
        'status'  =>  200,
        'success' =>  true,
        'data'    =>  $this->examRepo->getAssets($examId, $offset, $count),
        'total_records' =>  $this->examRepo->getAssetsCount($examId),
        'message' =>  'assets_response_success'
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'status'  =>  500,
        'success' =>  false,
        'data'    =>  null,
        'total_records' =>  null,
        'message' =>  'assets_response_failed'
      ], 500);
    }
  }

  public function getEvents($examId, $offset = 0, $count = -1) {
    try {
      return response()->json([
        'status'  =>  200,
        'success' =>  true,
        'data'    =>  $this->examRepo->getEvents($examId, $offset, $count),
        'total_records' =>  $this->examRepo->getEventsCount($examId),
        'message' =>  'events_response_success'
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'status'  =>  500,
        'success' =>  false,
        'data'    =>  null,
        'total_records' =>  null,
        'message' =>  'events_response_failed'
      ], 500);
    }
  }


}