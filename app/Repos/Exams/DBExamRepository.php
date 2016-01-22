<?php namespace App\Repos\Exams;
use App\Repos\Exams\ExamRepository;
use App\Models\Exam;
use App\Models\Course;
use App\Models\ExamCourse;
use App\Models\CourseBenefit;
use App\Models\ExamAsset;
use App\Models\CalendarEventExam;

class DBExamRepository implements ExamRepository {
	protected $model, $courseModel, $examCourseModel, $courseBenefitModel, $examAssetModel, $examEventsModel;

	public function __construct(Exam $model, Course $courseModel, ExamCourse $examCourseModel, CourseBenefit $courseBenefitModel, ExamAsset $examAssetModel, CalendarEventExam $examEventsModel) {
		$this->model = $model;
		$this->courseModel = $courseModel;
		$this->examCourseModel = $examCourseModel;
		$this->courseBenefitModel = $courseBenefitModel;
		$this->examAssetModel = $examAssetModel;
		$this->examEventsModel = $examEventsModel;
	}

	public function getList($type, $offset, $count) {
		if($type == 'all') {
			if ($count == -1)
				return $this->model->get();
			else
				return $this->model->skip($offset)->take($count)->get();
		} else {
			if ($count == -1)
				return $this->model->whereType($type)->get();
			else
				return $this->model->whereType($type)->skip($offset)->take($count)->get();
		}
	}

	public function getCount() {
		return $this->model->count();	
	}

	public function getCourses($examId) {
		return $this->model->with('courses.benefits')->whereId($examId)->first();	
	}

	public function getCourseBenefits($courseId) {
		return $this->courseModel->with('benefits')->whereId($courseId)->first();	
	}

	public function getTestimonials($examId, $offset, $count) {
		if($count == -1) {
			return $this->examAssetModel
				    	->join('assets', function ($join) {
				        $join->on('exam_assets.asset_id', '=', 'assets.id')
				             ->where('assets.asset_type', '=', 'Testimonial');
				    		})
				    	->whereExamId($examId)
				    	->get();
		} else {
			return $this->examAssetModel
				    	->join('assets', function ($join) {
				        $join->on('exam_assets.asset_id', '=', 'assets.id')
				             ->where('assets.asset_type', '=', 'Testimonial');
				    		})
				    	->whereExamId($examId)
				    	->skip($offset)
				    	->take($count)
				    	->get();
		}
		
		
	}	

	public function getAssets($examId, $offset, $count) {
		if($count == -1) {
			return $this->examAssetModel
				    	->join('assets', function ($join) {
				        $join->on('exam_assets.asset_id', '=', 'assets.id');
				    		})
				    	->whereExamId($examId)
				    	->get();	
		} else {
			return $this->examAssetModel
				    	->join('assets', function ($join) {
				        $join->on('exam_assets.asset_id', '=', 'assets.id');
				    		})
				    	->whereExamId($examId)
				    	->skip($offset)
				    	->take($count)
				    	->get();	
		}

	}

	public function getEvents($examId, $offset, $count) {
		if($count == -1) {
			return $this->examEventsModel
				    	->join('calendar_events', function ($join) {
				        $join->on('calendar_events_exams.event_id', '=', 'calendar_events.id');
				    		})
				    	->whereExamId($examId)
				    	->get();	
		} else {
			return $this->examEventsModel
				    	->join('calendar_events', function ($join) {
				        $join->on('calendar_events_exams.event_id', '=', 'calendar_events.id');
				    		})
				    	->whereExamId($examId)
				    	->skip($offset)
				    	->take($count)
				    	->get();	
		}

	}

	public function getCoursesCount($examId) {
		return $this->examCourseModel->whereExamId($examId)->count();	
	}

	public function getTestimonialsCount($examId) {
		return $this->examAssetModel
			    	->join('assets', function ($join) {
			        $join->on('exam_assets.asset_id', '=', 'assets.id')
			             ->where('assets.asset_type', '=', 'Testimonial');
			    		})
			    	->whereExamId($examId)
			    	->count();
	}

	public function getAssetsCount($examId) {
		return $this->examAssetModel
			    	->join('assets', function ($join) {
			        $join->on('exam_assets.asset_id', '=', 'assets.id');
			    		})
			    	->whereExamId($examId)
			    	->count();
	}

	public function getEventsCount($examId) {
		return $this->examEventsModel
			    	->join('calendar_events', function ($join) {
			        $join->on('calendar_events_exams.event_id', '=', 'calendar_events.id');
			    		})
			    	->whereExamId($examId)
			    	->count();	
	}
}	