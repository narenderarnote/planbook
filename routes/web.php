<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',function(){
    return view('welcome');
});

Route::post('/signUp', array(
    'as' => 'signUp',
    'uses' => 'GuestController@register'
));
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');
Route::post('/login', array(
    'as' => 'login',
    'uses' => 'GuestController@login',
));

Route::get('/logout', array(
    'as' => 'logout',
    'uses' => 'GuestController@logout',
));
Route::get('/student/logout', array(
    'as' => 'logout',
    'uses' => 'StudentController@logout',
));

Route::post('/studentlogin', ['as'=>'studentlogin','uses'=>'StudentController@studentAuth']);
   
/*Route::group(['middleware' => ['student']], function () {
    
    Route::post('/studentlogin', ['as'=>'studentlogin','uses'=>'StudentController@studentAuth']);
   
});*/
/**  Dashboard  **/ 
Route::group(['namespace' => 'Teacher','prefix' => 'teacher', 'as' => 'teacher.','middleware'=>'auth'], function()
{

    Route::match(['get','post'], 'step', ["as" => "step", "uses" => "SignupStepController@step"]);
    Route::match(['get','post'], 'step-2', ["as" => "step2", "uses" => "SignupStepController@step2"]);
    Route::match(['get','post'], 'step-3', ["as" => "step3", "uses" => "SignupStepController@step3"]);
    Route::match(['get','post'], 'step-4/{LessonSectionLayout}', ["as" => "step4", "uses" => "SignupStepController@step4"]);
    Route::match(['get','post'], 'step-5', ["as" => "step5", "uses" => "SignupStepController@step5"]);

    Route::group(['middleware'=>'IsSignupCompleted'],function(){

        /* Teacher Dashboard Routes*/

        Route::group([ 'prefix' => "dashboard", 'as' => 'dashboard.' ], function()
        {
            Route::get('/index', ['as' => 'index', 'uses' => 'DashboardController@index']);
            Route::get('/showCalendar', ['as' => 'showCalendar', 'uses' => 'DashboardController@showCalendar']);
			Route::get('/weekCalendar', ['as' => 'week', 'uses' => 'DashboardController@weekView']);
            Route::get('/dayCalendar', ['as' => 'day', 'uses' => 'DashboardController@dayView']);
			Route::get('/listCalendar', ['as' => 'list', 'uses' => 'DashboardController@listView']);
            Route::post('/getClasses', ['as' => 'class', 'uses' => 'ClassesController@getClass']);
			Route::Post('/addlessons', ['as' => 'addlesson', 'uses' => 'LessonController@create']);
			Route::Post('/attachFiles', ['as' => 'attachFiles', 'uses' => 'MyFilesController@myFileUpload']);
			Route::Post('/movelessons', ['as' => 'movelessons', 'uses' => 'LessonController@movelessons']);
			Route::Post('/copylessons', ['as' => 'copylessons', 'uses' => 'LessonController@copylessons']);
			Route::Post('/bumplessons', ['as' => 'bumplessons', 'uses' => 'LessonController@bumplessons']);
			Route::Post('/backlessons', [ 'as' => 'backlessons', 'uses' => 'LessonController@backlessons']);
			Route::Post('/extendlessons', [ 'as' => 'extendlessons', 'uses' => 'LessonController@extendlessons']);
			Route::Post('/deletelessons', [ 'as' => 'deletelessons', 'uses' => "LessonController@deletelessons"]);
			Route::get('/authUploads', [ 'as' => 'authUploads', 'uses' => "MyFilesController@authUploads"]);
            Route::get('/listClasses/{class_id}', [ 'as' => 'listClasses', 'uses' => "LessonController@listLessons"]);
            Route::post('/updateEmail', ['as' => 'updateEmail', 'uses' => 'DashboardController@updateEmail']);
            Route::post('/updatePassword', ['as' => 'updatePassword', 'uses' => 'DashboardController@updatePassword']);
            Route::post('/updateAccountDetails', ['as' => 'updateAccountDetails', 'uses' => 'DashboardController@updateAccountDetails']);
            Route::post('/contactUs', ['as' => 'contactUs', 'uses' => 'DashboardController@contactUs']);
            Route::post('/viewItems', ['as' => 'viewItems', 'uses' => 'DashboardController@viewItems']);
            Route::get('/toDo', ['as' => 'toDo', 'uses' => 'DashboardController@toDo']);
		    Route::post('/todoPost', ['as' => 'todoPost', 'uses' => 'DashboardController@todoPost']);  
        });
		

        /* School Year Routes*/

        Route::group([ 'prefix' => "school_year", 'as' => 'school_year.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "SchoolYearController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddSchoolYear', 'uses' => "SchoolYearController@getAddSchoolYear"]);
            Route::match(['post'], '/add', [ 'as' => 'postAddSchoolYear', 'uses' => "SchoolYearController@postAddSchoolYear"]);
            Route::match(['get','post'], '/edit/{school_year_id}', [ 'as' => 'editSchoolYear', "uses" => "SchoolYearController@editSchoolYear"]);

        });


        /* classes Routes*/

        Route::group([ 'prefix' => "classes", 'as' => 'classes.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "ClassesController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddClass', 'uses' => "ClassesController@getAddClass"]);
            Route::match(['post'], '/add', [ 'as' => 'postAddClass', 'uses' => "ClassesController@postAddClass"]);
            Route::match(['get'], '/edit/{class_id}', [ 'as' => 'edit', "uses" => "ClassesController@getEditClass"]);
            Route::match(['post'], '/edit/{class_id}', [ 'as' => 'edit', "uses" => "ClassesController@postEditClass"]);
			/*Route::match(['get'], '/import', [ 'as' => 'getImportClass', 'uses' => "ClassesController@getImportClass"]);
            Route::match(['get'], '/importcalendar', [ 'as' => 'importCalendar', 'uses' => "ClassesController@importCalendar"]);
            Route::match(['get'], '/importcalendar/{class_id}/{year}', [ 'as' => 'importCalendar', 'uses' => "ClassesController@copyCalendar"]);
            Route::match(['post'], '/copyclass', [ 'as' => 'copyClass', 'uses' => "ClassesController@copyClass"]);
            Route::match(['post'], '/copyafterbefore', [ 'as' => 'copyafterbefore', 'uses' => "ClassesController@copyAfterBefore"]);
            Route::match(['get'],'/addteacher',['as'=>'addteacher','uses'=>'ClassesController@addTeacher']);
            Route::match(['post'], '/postAddteacher', [ 'as' => 'postAddteacher', 'uses' => "ClassesController@postAddteacher"]);
            Route::match(['get'],'/userdata/{id}',['as'=>'userdata','uses'=>'ClassesController@userData']);*/
        });

        /*Import & share user's data*/
        Route::group([ 'prefix' => "import", 'as' => 'import.' ], function()
        {
            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "ImportController@index"]);
            Route::match(['get'],'/userYear/{id}',['as'=>'userYear','uses'=>'ImportController@userYear']);
            Route::match(['get'],'/userClass',['as'=>'userClass','uses'=>'ImportController@userClass']);
            Route::match(['get'],'/getdata',['as'=>'getdata','uses'=>'ImportController@getdata']);
            Route::match(['get'],'/classData',['as'=>'classData','uses'=>'ImportController@classData']);
            Route::match(['get'],'/getAssessment',['as'=>'getAssessment','uses'=>'ImportController@getAssessment']);
            Route::match(['get'],'/getAssignment',['as'=>'getAssignment','uses'=>'ImportController@getAssignment']);
            Route::match(['get'],'/getLessons',['as'=>'getLessons','uses'=>'ImportController@getLessons']);
            Route::match(['get'],'/getStudents/{year_id}',['as'=>'getStudents','uses'=>'ImportController@getStudents']);
            Route::match(['get'],'/getUnits',['as'=>'getUnits','uses'=>'ImportController@getUnits']);
            Route::match(['get'],'/copyCalendar/{class_id}/{year}', [ 'as' => 'copyCalendar', 'uses' => "ImportController@copyCalendar"]);
            Route::match(['post'],'/copylessons', [ 'as' => 'copylessons', 'uses' => "ImportController@copylessons"]);
            Route::match(['post'],'/copyunits', [ 'as' => 'copyunits', 'uses' => "ImportController@copyunits"]);
            Route::match(['post'],'/copyafterbefore', [ 'as' => 'copyafterbefore', 'uses' => "ImportController@copyAfterBefore"]);
            Route::match(['post'],'/copyafterunits', [ 'as' => 'copyafterunits', 'uses' => "ImportController@copyafterunits"]);
            Route::match(['get'],'/getclasstable', [ 'as' => 'getclasstable', 'uses' => "ImportController@getClassTable"]);
            Route::match(['post'],'/postclasscopy', [ 'as' => 'postclasscopy', 'uses' => "ImportController@postClassCopy"]);
            Route::match(['get'],'/getassessmenttable/{id}', [ 'as' => 'getassessmenttable', 'uses' => "ImportController@getAssessmentTable"]);
            Route::match(['post'],'/postassessmentcopy/{id}', [ 'as' => 'postassessmentcopy', 'uses' => "ImportController@postAssessmentCopy"]);
            Route::match(['get'],'/getassignmenttable/{id}', [ 'as' => 'getassignmenttable', 'uses' => "ImportController@getAssignmentTable"]);
            Route::match(['post'],'/postassignmentcopy/{id}', [ 'as' => 'postassignmentcopy', 'uses' => "ImportController@postAssignmentCopy"]);
            Route::match(['get'],'/getstudenttable/{id}', [ 'as' => 'getstudenttable', 'uses' => "ImportController@getStudentTable"]);
            Route::match(['post'],'/poststudentcopy', [ 'as' => 'poststudentcopy', 'uses' => "ImportController@postStudentCopy"]);
            Route::match(['get'],'/getstudentcopytable/{id}', [ 'as' => 'getstudentcopytable', 'uses' => "ImportController@studentCopyTable"]);
            Route::match(['get'],'/addteacher',['as'=>'addteacher','uses'=>'ImportController@addTeacher']);
            Route::match(['post'], '/postAddteacher', [ 'as' => 'postAddteacher', 'uses' => "ImportController@postAddteacher"]);

        }); 
        /* teacher units Routes*/

        Route::group([ 'prefix' => "units", 'as' => 'units.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "UnitsController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddUnit', 'uses' => "UnitsController@getAddUnit"]);
            Route::match(['post'], '/add', [ 'as' => 'postAddUnit', 'uses' => "UnitsController@postAddUnit"]);
            Route::match(['get'], '/edit/{unit_id}', [ 'as' => 'getEditUnit', "uses" => "UnitsController@getEditUnit"]);
            Route::match(['post'], '/edit/{unit_id}', [ 'as' => 'postEditUnit', "uses" => "UnitsController@postEditUnit"]);

        });


        /* teacher My Files Routes*/

        Route::group([ 'prefix' => "my_files", 'as' => 'my_files.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "MyFilesController@index"]);
            Route::match(['post'], '/myFileUpload', [ 'as' => 'myFileUpload', 'uses' => "MyFilesController@myFileUpload"]);
            Route::match(['post'], '/myFileDownload', [ 'as' => 'myFileDownload', 'uses' => "MyFilesController@fileDownload"]);        
        });

        /* teacher Assignments Routes*/

        Route::group([ 'prefix' => "assignments", 'as' => 'assignments.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "AssignmentsController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddAssignment', 'uses' => "AssignmentsController@getAddAssignment"]);
            Route::match(['post'], '/add', [ 'as' => 'postAddAssignment', 'uses' => "AssignmentsController@postAddAssignment"]);
            Route::match(['get'], '/edit/{assignment_id}', [ 'as' => 'getEditAssignment', "uses" => "AssignmentsController@getEditAssignment"]);
            Route::match(['post'], '/edit/{assignment_id}', [ 'as' => 'postEditAssignment', "uses" => "AssignmentsController@postEditAssignment"]);
            Route::match(['get'], '/score/{assessment_id}', [ 'as' => 'getScoreAssignment', 'uses' => "AssignmentsController@getScoreAssignment"]);
			Route::match(['post'], '/scoreAdd', [ 'as' => 'addScoreAssignment', 'uses' => "AssignmentsController@addScoreAssignment"]);
			Route::match(['get'], '/score', [ 'as' => 'getScoreAssignmentAll', 'uses' => "AssignmentsController@getScoreAssignmentAll"]);
			route::match(['get'], '/authUploads', [ 'as' => 'authUploads', 'uses' => "AssignmentsController@authUploads"]);
			route::match(['get'], '/seletedAssignment', [ 'as' => 'seletedAssignment', 'uses' => "AssignmentsController@seletedAssignment"]);
        });

        /* teacher Assessment Routes*/

        Route::group([ 'prefix' => "assessments", 'as' => 'assessments.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "AssessmentsController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddAssignment', 'uses' => "AssessmentsController@getAddAssessment"]);
            Route::match(['post'], '/add', [ 'as' => 'postAddAssignment', 'uses' => "AssessmentsController@postAddAssessment"]);
            Route::match(['get'], '/edit/{assessment_id}', [ 'as' => 'getEditAssignment', "uses" => "AssessmentsController@getEditAssessment"]);
            Route::match(['post'], '/edit/{assessment_id}', [ 'as' => 'postEditAssignment', "uses" => "AssessmentsController@postEditAssessment"]);
            Route::match(['get'], '/score/{assessment_id}', [ 'as' => 'getScoreAssessment', 'uses' => "AssessmentsController@getScoreAssessment"]);
			Route::match(['post'], '/scoreAdd', [ 'as' => 'getScoreAssessment', 'uses' => "AssessmentsController@addScoreAssessment"]);
			Route::match(['get'], '/score', [ 'as' => 'getScoreAssessmentAll', 'uses' => "AssessmentsController@getScoreAssessmentAll"]);
            route::match(['get'], '/authUploads', [ 'as' => 'authUploads', 'uses' => "AssessmentsController@authUploads"]);
			route::match(['get'], '/seletedAssessment', [ 'as' => 'seletedAssessment', 'uses' => "AssessmentsController@seletedAssessment"]);
			
        });
		/* teacher Standards Routes*/

        Route::group([ 'prefix' => "standards", 'as' => 'standards.' ], function()
        {
            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "StandardsController@index"]);
			Route::match(['get','post'], '/explore', [ 'as' => 'explore', 'uses' => "StandardsController@explore"]);
        });

		/* teacher Events Routes*/

        Route::group([ 'prefix' => "events", 'as' => 'events.' ], function()
        {
            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "EventsController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'addEvents', 'uses' => "EventsController@getAddEvents"]);
            route::match(['get'], '/authUploads', [ 'as' => 'authUploads', 'uses' => "EventsController@authUploads"]);
            Route::Post('/attachFiles', ['as' => 'attachFiles', 'uses' => 'EventsController@myFileUpload']);
            Route::match(['post'], '/add', [ 'as' => 'postAddEvent', 'uses' => "EventsController@postAddEvents"]);
            Route::match(['get'], '/edit/{event_id}', [ 'as' => 'getEditEvent', "uses" => "EventsController@getEditEvent"]);
            Route::match(['post'], '/edit/{event_id}', [ 'as' => 'postEditEvent', "uses" => "EventsController@postEditEvent"]);
            Route::get('/importExport', [ 'as' => 'importExport', "uses" => 'EventsController@importExport']);
            Route::get('/downloadExcel/{events}', [ 'as' => 'downloadExcel', "uses" => 'EventsController@downloadExcel']);
            Route::post('/importExcel', [ 'as' => 'importExcel', "uses" => 'EventsController@importExcel']);
            Route::get('/getyear', [ 'as' => 'getyear', "uses" => 'EventsController@getImport']);
        });

        /* Teacher's Grades Routes*/

        Route::group([ 'prefix' => "grades", 'as' => 'grades.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "GradesController@index"]);
            Route::match(['get','post'], '/addstudents', [ 'as' => 'addstudents', 'uses' => "GradesController@addstudents"]);
            Route::match(['get'], '/getData/{class_id}', [ 'as' => 'getData', 'uses' => "GradesController@getUserData"]);
            Route::match(['post'], '/postData', [ 'as' => 'postData', 'uses' => "GradesController@postUserData"]);
            Route::match(['post'], '/postGradeLetters', [ 'as' => 'postGradeLetters', 'uses' => "GradesController@postGradeLetters"]);
            Route::match(['get'], '/add', [ 'as' => 'add', 'uses' => "GradesController@addPeriods"]);
            Route::match(['post'], '/postPeriod', [ 'as' => 'postPeriod', 'uses' => "GradesController@postPeriod"]);
            Route::match(['get'], '/geteditPeriod/{period_id}', [ 'as' => 'geteditPeriod', 'uses' => "GradesController@geteditPeriod"]);
            Route::match(['post'], '/posteditPeriod/{period_id}', [ 'as' => 'posteditPeriod', 'uses' => "GradesController@posteditPeriod"]);
            Route::match(['get'], '/deletePeriod/{period_id}', [ 'as' => 'deletePeriod', 'uses' => "GradesController@deletePeriod"]);
            Route::match(['get'], '/performanceReport', [ 'as' => 'performanceReport', 'uses' => "GradesController@performanceReport"]);
            Route::match(['get'], '/pdfview', [ 'as' => 'pdfview', 'uses' => "GradesController@pdfView"]);
            
           
        });
        /* Teacher's Mylist Routes*/

        Route::group([ 'prefix' => "mylist", 'as' => 'mylist.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "MylistController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddList', 'uses' => "MylistController@getAddList"]);
            Route::match(['post'], '/add', [ 'as' => 'postAddList', 'uses' => "MylistController@postAddmylist"]);
            Route::match(['get'], '/edit/{id}', [ 'as' => 'getEditList', 'uses' => "MylistController@getEditList"]);
            Route::match(['post'], '/edit/{id}', [ 'as' => 'postEditMylist', "uses" => "MylistController@postEditMylist"]);
        });

        /* Teacher's strategies Routes*/

        Route::group([ 'prefix' => "mystrategies", 'as' => 'mystrategies.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "MystrategiesController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddList', 'uses' => "MystrategiesController@getAddstrategies"]);
            Route::match(['post'], '/add', [ 'as' => 'postAddList', 'uses' => "MystrategiesController@postAddstrategies"]);
            Route::match(['get'], '/edit/{id}', [ 'as' => 'getEditMystrategies', 'uses' => "MystrategiesController@getEditstrategies"]);
            Route::match(['post'], '/edit/{id}', [ 'as' => 'postEditMystrategies', "uses" => "MystrategiesController@postEditstrategies"]);
        });

        /*overview modals Routes*/
        
        Route::group([ 'prefix' => "overview", 'as' => 'overview.' ], function()
        {

            Route::match(['get'], '/index', [ 'as' => 'index', 'uses' => "DashboardController@overview"]);
            Route::match(['get'], '/overviewnext/{url}', [ 'as' => 'overviewnext', 'uses' => "DashboardController@overviewnext"]);
        });

        /*Partials Routes*/

        Route::group([ 'prefix' => "partials", 'as' => 'partials.' ], function()
        {

            Route::match(['get'], '/announcement', [ 'as' => 'announcement', 'uses' => "PartialsController@Announcement"]);
            Route::match(['post'], '/announcement_save', [ 'as' => 'announcement_save', 'uses' => "PartialsController@AnnouncementSave"]);
            Route::match(['post'], '/announcement_edit', [ 'as' => 'announcement_edit', 'uses' => "PartialsController@AnnouncementEdit"]);
            Route::match(['get'], '/announcement_delete/{id}', [ 'as' => 'announcement_delete', 'uses' => "PartialsController@AnnouncementDelete"]);
            Route::match(['get'], '/substitute', [ 'as' => 'substitute', 'uses' => "PartialsController@Substitute"]);
            Route::match(['post'], '/substitute_save', [ 'as' => 'substitute_save', 'uses' => "PartialsController@SubstituteSave"]);
            Route::match(['post'], '/substitute_edit', [ 'as' => 'substitute_edit', 'uses' => "PartialsController@SubstituteEdit"]);
            Route::match(['get'], '/substitute_delete/{id}', [ 'as' => 'substitute_delete', 'uses' => "PartialsController@SubstituteDelete"]);
        });
        /* Teacher's Add Student Routes*/

        Route::group([ 'prefix' => "addstudents", 'as' => 'addstudents.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "AddstudentController@index"]);
            Route::match(['get'], '/add', [ 'as' => 'getAddStudent', "uses" => "AddstudentController@getAddStudents"]);
            Route::match(['post'], '/add', [ 'as' => 'getAddStudent', "uses" => "AddstudentController@postAddStudents"]);
            Route::match(['get'], '/edit/{id}', [ 'as' => 'geteditStudent', "uses" => "AddstudentController@getEditStudents"]);
            Route::match(['post'], '/edit/{id}', [ 'as' => 'posteditStudent', "uses" => "AddstudentController@postEditStudents"]);
            Route::post('/importExcel', [ 'as' => 'importExcel', "uses" => 'AddstudentController@importExcel']);
            Route::match(['get','post'], '/filterStudents', [ 'as' => 'filterStudents', "uses" => "AddstudentController@FilterStudent"]);
        });

        /* Teacher's Assign Student Routes*/

        Route::group([ 'prefix' => "assignstudents", 'as' => 'assignstudents.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "AssignstudentController@index"]);
            Route::match(['get','post'], '/getStudents/{id}', [ 'as' => 'getStudents', "uses" => "AssignstudentController@getStudents"]);
            Route::match(['get','post'], '/assignAllStudents/{id}', [ 'as' => 'getStudents', "uses" => "AssignstudentController@AssignAllStudents"]);
            Route::match(['get','post'], '/assignSingle', [ 'as' => 'assignSingle', "uses" => "AssignstudentController@AssignSingleStudent"]);
            Route::match(['get','post'], '/removeSingle', [ 'as' => 'assignSingle', "uses" => "AssignstudentController@RemoveSingleStudent"]);
            Route::match(['get','post'], '/filterStudents/{id}', [ 'as' => 'filterStudents', "uses" => "AssignstudentController@FilterStudent"]);
            Route::match(['get','post'], '/removeAllStudents/{id}', [ 'as' => 'removeAllStudents', "uses" => "AssignstudentController@RemoveAllStudent"]);
        });

        /* Teacher's Sharing Option Routes*/
        
        Route::group([ 'prefix' => "sharingoption", 'as' => 'sharingoption.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "SharingoptionController@index"]);
            Route::match(['post'], '/postOptions', [ 'as' => 'postOptions', 'uses' => "SharingoptionController@postOptions"]);
            Route::match(['post'], '/posteditOptions/{id}', [ 'as' => 'posteditOptions', 'uses' => "SharingoptionController@postEditOptions"]);
           
        });

        /* Teacher's tepmplate Option Routes*/
        
        Route::group([ 'prefix' => "template", 'as' => 'template.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "TemplateController@index"]);
           
        });

        /* Teacher's display Option Routes*/
        
        Route::group([ 'prefix' => "display", 'as' => 'display.' ], function()
        {

            Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "DisplayController@index"]);
           
        });
    });
  

});

Route::group(['namespace' => 'Student','prefix' => 'student', 'as' => 'student.','middleware'=>'student'], function()
{

    Route::group([ 'prefix' => "dashboard", 'as' => 'dashboard.'], function(){
    Route::get('/showCalendar', ['as' => 'showCalendar', 'uses' => 'DashboardController@showCalendar']);
    Route::match(['get','post'], '/index', [ 'as' => 'index', 'uses' => "DashboardController@index"]);
    Route::get('/weekCalendar', ['as' => 'week', 'uses' => 'DashboardController@weekView']);
    Route::get('/dayCalendar', ['as' => 'day', 'uses' => 'DashboardController@dayView']);


    });
});


Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/reviews', function () {
    return view('reviews');
});

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/tutorials', function () {
    return view('tutorials');
});


