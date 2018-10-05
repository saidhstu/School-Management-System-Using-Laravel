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

Route::group(['middleware' => ['auth:admin']],function() {
    Route::get('admin/home','AdminController@index');

//    Website Routes

    Route::get('website/management','WebsiteController@index');
    Route::resource('about/menus','AboutMenuController');
    Route::resource('about/details','AboutDetailsController');
    Route::resource('/messages','MessageController');
    Route::resource('/insinfos','InsInfoController');
    Route::resource('/links','LinkController');
    Route::resource('/routines','RoutineController');
    Route::resource('/syllebus','SyllebusController');
    Route::resource('/notices','NoticeController');
    Route::resource('/cos','CoController');

//    Result Routes

    Route::get('result/management','ResultController@index');
    Route::get('result/config','ResultController@getConfig');
    Route::resource('classes', 'SclassController');
    Route::resource('sections', 'SectionController');
    Route::resource('groups', 'GroupController');
    Route::resource('exams', 'ExamController');
    Route::resource('monthlies', 'MonthlyController');
    Route::resource('subjects', 'SubjectController');
    Route::resource('students', 'StudentController');
    Route::get('edit/{id}/student', 'StudentController@get_edit_student');
    Route::post('/get/students','StudentController@getStudents');
    Route::post('student/upload', 'StudentController@importStudent');
    Route::resource('/teachers','TeacherController');
    Route::resource('/school/teachers','SchoolTeacherController');
    Route::get('/all/teachers','TeacherController@getAllTeacher');
    Route::post('/import/teachers','TeacherController@importTeacher');
    Route::resource('class/sections', 'ClassSectionController');
    Route::resource('class/exams', 'ClassExamController');
    Route::resource('class/monthlies', 'ClassMonthlyController');
    Route::resource('class/subjects', 'ClassSubjectController');
    Route::resource('class/groups', 'ClassGroupController');
    Route::resource('class/subjects', 'ClassSubjectController');
    Route::post('/get/class/subjects','ClassSubjectController@getClassSubjects');
    Route::resource('teacher/subjects', 'TeacherSubjectController');
    Route::resource('teacher/classes', 'TeacherClassController');
    Route::resource('subject/numbers', 'SubjectNumberController');
    Route::resource('optional/subjects','OptionalSubjectController');
    Route::post('optional/subjects/students','OptionalSubjectController@getStudents');
    Route::resource('non/subjects','NonSubjectController');
    Route::post('non/subjects/students','NonSubjectController@getStudents');

    Route::resource('/betons','BetonController');
    Route::resource('/tifins','TifinController');
    Route::resource('/elecs','ElecController');

    Route::resource('/config/session','SetSessionAmountController');
    Route::resource('/session/fees','SessionFeeController');
    Route::post('/session/fees/students','SessionFeeController@getStudents');

    Route::resource('/get/betons','GetBetonController');

//    Result Viewing Routes

    Route::get('/view/result','ResultController@viewResult');
    Route::get('/view/all/result','ResultController@viewAllResult');
    Route::post('/view/all/result','ResultController@getAllResult');
    Route::post('/get/result','ResultController@getResult');
    Route::get('/view/tabulation','ResultController@viewTabulation');
    Route::post('/get/tabulation','ResultController@getTabulation');
    Route::get('/view/merit','ResultController@viewMerit');
    Route::post('/get/merit','ResultController@getMerit');
    Route::get('/view/demerit','ResultController@viewDemerit');
    Route::get('/view/result/information','ResultController@viewResultInformation');
    Route::post('/view/result/information','ResultController@getResultInformation');
    Route::post('/get/demerit','ResultController@getDemerit');
    Route::get('/promotion','ResultController@getPromotion');
    Route::post('/get/promotion','ResultController@getPromotionStudents');
    Route::post('/set/promotion','ResultController@setPromotion');
    
    Route::get('/view/merge/result','ResultController@viewMergeResult');
    Route::post('/view/merge/result','ResultController@getMergeResult');

//    Account related Routes
    Route::get('/student/admission', 'StudentController@admission');
    Route::resource('/funds','FundController');
    Route::resource('/session/config','SessionConfigController');
    Route::get('/account','AccountController@index');
    Route::get('/daily/report','ReportController@dailyReport');
    Route::get('/monthly/report','ReportController@monthlyReport');
    Route::post('/monthly/report','ReportController@getMonthlyReport');
    Route::get('/yearly/report','ReportController@yearlyReport');
    Route::post('/yearly/report','ReportController@getYearlyReport');
    Route::get('/student/wise/report','ReportController@studentReport');
    Route::post('/student/wise/report','ReportController@getStudentReport');
    Route::post('previous/daily/report','ReportController@getPreviousReport');
    Route::resource('/extra/income','ExtraIncomeController');
    Route::resource('/income/head','IncomeHeadController');
    Route::get('/incomehead/search','IncomeHeadController@searchHead');
    Route::get('income/report/view','ExtraIncomeController@incomeReport');
    Route::post('income/report/view','ExtraIncomeController@collectReport');

    Route::resource('/insinfos','InsInfoController');

//    Expense Related Routes
    Route::resource('expense','ExpenseController');
    Route::resource('/expenseheads', 'ExpenseHeadController');
    Route::get('expense/report/view','ExpenseController@expenseReport');
    Route::post('expense/report/view','ExpenseController@collectReport');
    Route::get('/expensehead/search','ExpenseHeadController@searchHead');

    Route::resource('/fees','FeesController');
//    Route::get('/bank/page','AdminPageController@getBank');
//    Route::resource('/banks','BankController');
//    Route::resource('/bank/accounts','BankAccountController');
//    Route::resource('/bank/deposits','BankDepositController');
//    Route::resource('/bank/withdraws','BankWithdrawController');
    Route::post('/student/history','FeesController@getStudentHistory');
    Route::post('/student/img','FeesController@getStudentImg');
    Route::post('/student/info','FeesController@getStudentInfo');
    Route::get('/receipt/{serial}/print','FeesController@receipt');
    Route::post('/view/receipt','FeesController@viewReceipt');

    Route::resource('/exam/fees', 'ExamFeeController');
    Route::post('/exam/fees/students','ExamFeeController@getStudents');
    Route::resource('/exam/payments', 'ExamPaymentController');
    Route::post('/exam/payments/students','ExamPaymentController@getStudents');

    Route::resource('/beton/fees', 'BetonController');
    Route::post('/beton/fees/students','BetonController@getStudents');

    Route::resource('/tifin/fees', 'TifinController');
    Route::post('/tifin/fees/students','TifinController@getStudents');

    Route::resource('/elec/fees', 'ElecController');
    Route::post('/elec/fees/students','ElecController@getStudents');

    Route::resource('/form/fees', 'FormFeeController');
    Route::post('/form/fees/students','FormFeeController@getStudents');
    Route::resource('/form/payments', 'FormPaymentController');
    Route::post('/form/payments/students','FormPaymentController@getStudents');

    Route::resource('/other/fees', 'OtherFeeController');
    Route::post('/other/fees/students','OtherFeeController@getStudents');
    Route::resource('/other/payments', 'OtherPaymentController');
    Route::post('/other/payments/students','OtherPaymentController@getStudents');

    Route::resource('/fine/fees', 'FineFeeController');
    Route::post('/fine/fees/students','FineFeeController@getStudents');
    Route::resource('/fine/payments', 'FinePaymentController');
    Route::post('/fine/payments/students','FinePaymentController@getStudents');

    Route::resource('/attendence/fees', 'AttendenceFeeController');
    Route::post('/attendence/fees/students','AttendenceFeeController@getStudents');
    Route::resource('/attendence/payments', 'AttendencePaymentController');
    Route::post('/attendence/payments/students','AttendencePaymentController@getStudents');

    Route::get('student/payments','StudentController@studentPayments');
    Route::post('/student/total/funds','StudentController@studentPaymentHistory');
    Route::get('/student/payment/details','StudentController@studentPaymentDetails');
    Route::get('/student/payment/details','StudentController@getPaymentDetails');
    Route::post('/student/payment/details','StudentController@studentPaymentDetails');

    Route::post('non/subjects/students','NonSubjectController@getStudents');
    Route::post('/get/op/subjects','NonSubjectController@getSubjects');

    Route::get('/non/{id}/op','NonSubjectController@getOpNon');
    Route::post('/add/non','NonSubjectController@setOpNon');
    Route::get('/get/optional','OptionalSubjectController@getOptional');
    Route::post('/get/optional','OptionalSubjectController@getOptionalStudents');
    Route::post('/set/optional','OptionalSubjectController@setOptional');
    Route::get('/get/non','NonSubjectController@getNon');
    Route::post('/get/non','NonSubjectController@getNonStudents');
    Route::post('/set/non','NonSubjectController@setNon');

//    admit Card

    Route::get('/admit/card','StudentController@getAdmitCart');
    Route::post('/admit/card','StudentController@viewAdmitCart');
    Route::get('/single/admit/card','StudentController@getSingleAdmit');
    Route::post('/single/admit/card','StudentController@viewSingleAdmit');
    Route::get('/sit/plan','StudentController@sitPlan');
    Route::post('/sit/plan','StudentController@getSitPlan');
    
    Route::get('/get/sms','ResultController@getSms');
    Route::post('/get/sms/info','ResultController@getSmsInfo');
    Route::post('/send/sms','ResultController@sendSms');
    
    //    Accessories Controller

    Route::get('/accessories','AccessoriesController@index');
    Route::resource('/products','ProductController');
    Route::get('/sell/items','ProductSellController@sellItem');
    Route::post('/sell/items','ProductSellController@sItem');
    Route::get('/print/items','ProductSellController@printItem');
    Route::resource('product/sell','ProductSellController');
    Route::post('/search/student','ProductSellController@searchStudent');
    Route::post('/search/product','ProductController@searchProduct');
    Route::get('/print/items','ProductSellController@printItems');
    Route::post('/student/product/history','ProductSellController@studentHistory');




//    Website Routes

    Route::resource('sliders','SliderController');
    Route::resource('galleries','GalleryController');
    Route::resource('jobs','JobController');

});


Route::post('/get/exams','JsFileController@getExams');
Route::post('/get/sections','JsFileController@getSections');
Route::post('/get/groups','JsFileController@getGroups');
Route::post('/get/subjects','JsFileController@getSubjects');

Route::group(['middleware' => 'auth'],function() {
    Route::get('/user','UserController@index');
    Route::get('/user/logout','Auth\LoginController@logout');
});

Route::group(['middleware' => 'auth:teacher'],function() {
    Route::get('teacher/home','TeacherController@index');
    Route::get('teacher/class','TeacherController@getClasses');
    Route::get('teacher/subject','TeacherController@getSubjects');
    Route::get('add/result','ResultController@addResult');
    Route::post('add/result','ResultController@getStudentsMarks');
    Route::get('/update/result','ResultController@updateResult');
    Route::post('/update/result','ResultController@getStudentsMarksEdit');
    Route::post('/insert/mark','ResultController@store');
    Route::get('/generate/merit/students','ResultController@generatePage');
    Route::post('/generate/merit/students','ResultController@generateMerit');
    Route::post('/students/generate','ResultController@getStudentsGenerate');
    Route::resource('/sent/message','SentMessageController');
    Route::post('/get/message/students','SentMessageController@getStudents');
    Route::get('/take/attendence','AttendenceController@takeAttendence');
    Route::post('/take/att/students','AttendenceController@getStudents');
    Route::get('/view/att/students','AttendenceController@viewAttendence');
    Route::post('/view/att/students','AttendenceController@viewAttendenceReport');
    Route::resource('/take/attendeces','AttendenceController');
    Route::get('/print/mark','ResultController@getPrintMark');
    Route::post('/print/mark','ResultController@printMark');
//    Route::get('/view/result','ResultController@viewResult');
//    Route::get('/view/all/result','ResultController@viewAllResult');
//    Route::post('/view/all/result','ResultController@getAllResult');
//    Route::post('/get/result','ResultController@getResult');
//    Route::get('/view/tabulation','ResultController@viewTabulation');
//    Route::post('/get/tabulation','ResultController@getTabulation');
//    Route::get('/view/merit','ResultController@viewMerit');
//    Route::post('/get/merit','ResultController@getMerit');
//    Route::get('/view/demerit','ResultController@viewDemerit');
//    Route::post('/get/demerit','ResultController@getDemerit');

});

Route::group(['middleware' => 'auth:student'],function() {
    Route::get('student/home','StudentController@home');
    Route::get('/get/student/dues','StudentController@getDues');
    Route::get('/get/student/payments','StudentController@getPayments');
    Route::get('/get/student/messages','StudentController@getMessages');
    Route::get('/view/{id}/message','StudentController@getSingleMessage');
});

Auth::routes();
Route::get('admin/logout','Admin\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin','Admin\LoginController@login');
Route::get('teacher','Teacher\LoginController@showLoginForm')->name('teacher.login');
Route::post('teacher','Teacher\LoginController@login');
Route::get('teacher/logout','Teacher\LoginController@logout');
Route::get('student','Student\LoginController@showLoginForm')->name('student.login');
Route::post('student','Student\LoginController@login');
Route::get('student/logout','Student\LoginController@logout');

// Website Routes


Route::get('/','PagesController@getIndex');
Route::get('/all-teachers','PagesController@allTeachers');
Route::get('bivag/{bivag_id}/teacher','PagesController@getBivagTeacher');

Route::get('/about/{id}/details','PagesController@aboutDetails');

// Result Routes

Route::get('/result','PagesController@getResult');
Route::post('/result','PagesController@searchResult');

Route::get('gallery','PagesController@getGallery');
Route::get('co-curri','PagesController@co_curri');

Route::get('/error','PagesController@error');
Route::get('/contact','PagesController@getContact');
Route::get('/job','PagesController@getJob');
Route::get('/job-details','PagesController@getJobDetails');

