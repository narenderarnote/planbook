<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Facades\App\Helpers\Common;

use App\UserClass;
use App\SchoolYear;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Paginator;
use Session;
use Input;
use Validator;
use Hash;
use DB;
use Redirect;
use View;
use Mail;
use Exception;
use App\Unit;
use App\ClassLesson;
class ClassesController extends Controller
{
    /**
    * $data array pass data to view 
    */
    protected $data = [];

	public function __construct(){

		
		
	}

   /**
	 * Classes List
	 */
	public function index()
	{
		$user_selected_school_year = SchoolYear::where('id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->first();
		$this->data['user_selected_school_year'] = $user_selected_school_year;
		$this->data['user_classes'] = UserClass::whereUserId(Auth::id())->get();

		return view('teacher.classes.index', $this->data);

		//return redirect()->to('/');
	}

	/**
	 * Get add Class view
	 */
	public function getAddClass()
	{
	
		// get user classes schedule setting

		$user_selected_school_year = SchoolYear::where('id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->first();

		$this->data['user_selected_school_year'] = $user_selected_school_year;

		$this->data['DefaultClassesSchedules'] = Common::ClassesScheduled("one_week");

		//echo"<pre>";print_r($this->data['DefaultClassesSchedules']);die;


		return view('teacher.classes.add', $this->data);

	}

	/**
	 * Post add Class view
	 */

	public function postAddClass(Request $request)
	{

		$response = array();

        $UserClass = new UserClass();


        if($request->isMethod('post')) {

            //echo"<pre>";print_r($request->all());die;


            $validation['class_name'] = 'required';

            $validator = Validator::make($request->all(), $validation);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{

            	$format = 'd/m/Y';

                $UserClass->user_id = Auth::id();
                $UserClass->year_id = Auth::user()->current_selected_year;
                $UserClass->class_name = $request['class_name'];
                $UserClass->start_date = \Carbon\Carbon::createFromFormat($format, $request['start_date']);
                $UserClass->end_date = \Carbon\Carbon::createFromFormat($format,$request['end_date']);
                $UserClass->class_color = $request['class_color'];
                $UserClass->collaborate = $request['collaborate'];

                $class_schedule = json_encode($request['class_schedule']);
                $UserClass->class_schedule = $class_schedule;

                if($UserClass->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

	}


	/**
	 * Get edit Class view
	 */
	public function getEditClass($class_id)
	{
	
		// get user class

		$this->data['userClass'] = UserClass::where('id', $class_id)->first();
		

		//echo"<pre>";print_r($this->data['userClass']);die;

		return view('teacher.classes.edit', $this->data);

	}

	/**
	 * Post Edit Class
	 */

	public function postEditClass(Request $request, $class_id)
	{

		$response = array();

        $UserClass = UserClass::where('id', $class_id)->first();


        if($request->isMethod('post')) {

            //echo"<pre>";print_r($request->all());die;


            $validation['class_name'] = 'required';


            $rules = array(
                'class_name'   => 'required',
                'start_date'   => 'required',
                'end_date'   => 'required',
                
            );

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {

                $response['error'] = $validator->errors()->all();

            }else{

            	$format = 'd/m/Y';
               
                $UserClass->class_name = $request['class_name'];
                $UserClass->start_date = \Carbon\Carbon::createFromFormat($format, $request['start_date']);
                $UserClass->end_date = \Carbon\Carbon::createFromFormat($format,$request['end_date']);
                $UserClass->class_color = $request['class_color'];
                $UserClass->collaborate = $request['collaborate'];

                $class_schedule = json_encode($request['class_schedule']);
                $UserClass->class_schedule = $class_schedule;

                if($UserClass->save()){

                    $response['success'] = 'TRUE';

                }

            }

        }

        return response()->json($response);

	}
	/*popup for edit class*/
    public function getClass(Request $request)
	{
	
		// get user class
		$date = $request->sendDate;
		$getDate = explode(' ', $date);
		$classData = UserClass::where('id', $request->classID)->first();
		/* $getTime = collect(json_decode($classData->class_schedule))
									->where("text", $request->day)
									->where("is_class" , "1")
									->first(); */
		$getTime = ClassLesson::where('class_id',$request->classID)->where('lesson_date',$getDate[1])->first();							
		$this->data['times'] = $getTime;
		
		$this->data['userClass'] = $classData->class_name;
		
		$lessonData = ClassLesson::where('class_id',$request->classID)->where('lesson_date',$getDate[1])->first();
		
		$this->data['lessonDetails'] = $lessonData;
		
		$this->data['unit'] = Unit::where('class_id',$request->classID)->where('user_id',Auth::id())->get()->pluck('unit_title','id');
		
		return  $this->data;

	}

	public function getImportClass(Request $request){
		$user_selected_school_year = SchoolYear::where('id',Auth::user()->current_selected_year)->where('user_id',Auth::user()->id)->get();
		$this->data['user_selected_school_year'] = $user_selected_school_year;
		$this->data['user_classes'] = UserClass::whereUserId(Auth::id())->get();

		return view('teacher.classes.import', $this->data);

		
	
	}

	public function importCalendar(Request $request){
		$schoolYear = $request->year; 
		$year_name  = explode('-',$schoolYear);
		$start 		= $year_name[0];
		$end        = $year_name[1];
		$type  		= $request->type;
		$this->data['current_selected_year'] = $request->year; 
		if($type=='Lessons'){
			$class_id = $request->class_id;
			$this->data['classes'] = UserClass::where('user_id',Auth::user()->id)->where('id',$class_id)->where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($start, $end, $class_id){
	       		$q->where('user_id',Auth::user()->id)->where('id',$class_id)->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
				})->get();
			$this->data['code']=1;   
			$this->data['user_lessons']=$lessons = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date', '>=', $start)->Where('lesson_date', '<=' , $end)->orWhere(function($q) use($start, $end, $class_id){
	       		$q->where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date', '>=' ,$start )->where('lesson_date' ,'<=', $end);
				})->get();
			    return view('teacher.classes.lessonCalendar', $this->data);


		}
		else{
			$this->data['code']=2;

			$getUnits = Unit::where('class_id',$request->class_id)->where('user_id',Auth::id())->get();
			$unitIds   = array();
			$unitTitle = array();
			$unitCount = array();
			$unitLessons = array();
			foreach($getUnits as $units){
				$unitIds[]   =  $units['id'];
				$unitTitle[] =  $units['unit_title']; 
			}
			foreach($unitIds as $ui){
				$unitCount[] = ClassLesson::where('unit',$ui)->where('user_id',Auth::id())->get()->count();
				$unitLessons[] = ClassLesson::where('unit',$ui)->where('user_id',Auth::id())->get();
			}
			$this->data['current_selected_year'] = $request->year; 
			$this->data['class_lessons'] = $unitLessons;
			$this->data['unitCount'] = array_combine($unitTitle,$unitLessons);
			//print_r($this->data['class_lessons']);
			//exit;
			return view('teacher.classes.lessonCalendar', $this->data);
		}
		
	}

	public function copyCalendar(Request $request, $class_id, $year){
		$schoolYear = $year; 
		$year_name  = explode('-',$schoolYear);
		$start 		= $year_name[0];
		$end        = $year_name[1];
			$this->data['classes'] = UserClass::where('user_id',Auth::user()->id)->where('id',$class_id)->get();
			$this->data['code']=3;   
			$this->data['user_lessons']=$lessons = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date', '>=', $start)->Where('lesson_date', '<=' , $end)->orWhere(function($q) use($start, $end, $class_id){
	       		$q->where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date', '>=' ,$start )->where('lesson_date' ,'<=', $end);
				})->get();
			    return view('teacher.classes.lessonCalendar', $this->data);

	}	

	public function copyClass(Request $request ){
		$date       = $request->date;
		$class_date = explode(' ',$date);
		$response   = array();
        $classLessons = new ClassLesson();
        $class_id  = $request->to_class;
        if($request->isMethod('post') && $request->type='Lessons') {
        	$haslesson = ClassLesson::where('user_id',Auth::user()->id)->where('lesson_date',$class_date[1])->where('class_id',$request->to_class)->first();
        	if($haslesson==''){
        		$lessons   = ClassLesson::where('user_id',Auth::user()->id)->where('id',$request->lesson_id)->first();
	 			$classLessons->class_id = $request->to_class;
				$classLessons->user_id = Auth::user()->id;
				$classLessons->lesson_date = $class_date[1];
				$classLessons->lesson_start_time = $lessons->lesson_start_time;
			    $classLessons->lesson_end_time = $lessons->lesson_end_time;
				$classLessons->unit = $lessons->unit;
				$classLessons->lesson_title = $lessons->lesson_title;
				$classLessons->lesson_text = $lessons->lesson_text;
				$classLessons->homework = $lessons->homework;
				$classLessons->notes = $lessons->notes;
				$classLessons->standards = $lessons->standards;
				$classLessons->lock_lesson_to_date = $lessons->lock_lesson_to_date; 
				$classLessons->attachments = $lessons->attachments; 
				if($classLessons->save()){

                    $schoolYear ='2017-2018'; 
		$year_name  = explode('-',$schoolYear);
		$start 		= $year_name[0];
		$end        = $year_name[1];
			$this->data['classes'] = UserClass::where('user_id',Auth::user()->id)->where('id',$class_id)->where('start_date', '>=', $start)->Where('end_date', '<=' , $end)->orWhere(function($q) use($start, $end, $class_id){
	       		$q->where('user_id',Auth::user()->id)->where('id',$class_id)->where('end_date', '>=' ,$start )->where('start_date' ,'<=', $end);
				})->get();
			$this->data['code']=3;   
			$this->data['user_lessons']=$lessons = ClassLesson::where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date', '>=', $start)->Where('lesson_date', '<=' , $end)->orWhere(function($q) use($start, $end, $class_id){
	       		$q->where('user_id',Auth::user()->id)->where('class_id',$class_id)->where('lesson_date', '>=' ,$start )->where('lesson_date' ,'<=', $end);
				})->get();
			    return view('teacher.classes.lessonCalendar', $this->data);

                }
        	}
        	else{
        		$response['success'] = 'FALSE';
        	}	
        	return response()->json($response);	
        }
	}
}
