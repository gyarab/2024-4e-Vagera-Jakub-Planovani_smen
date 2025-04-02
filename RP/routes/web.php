<?php

use App\Http\Controllers\AlgorithmController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CertainStatisticsController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmployeeLoader;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PersonalShiftControler;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ObjectStructureController;
use App\Http\Controllers\RightsController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserAvatarController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OptionsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShiftRequest;
use App\Http\Controllers\StatisticsController;
use App\Mail\VerificationEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Optional;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\AuthManager;


/** source: https://www.youtube.com/watch?v=0uUgkbhQvxk */
Route::get('/', function () {
    return view('welcome');
});
Route::get('/main-page', function () {
    return view('main-page');
});
Route::get('/verification', function () {
    return view('verification');
});
Route::get('/verification-success', function () {
    return view('verification-success');
});

Route::get('/admin/dashboard3', function () {
    return view('admin.dashboard3');
})->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard3');

Route::get('/admin/shift-model/create-model-shift', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('admin.shift-model.create-model-shift',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.shift-model.create-model-shift');

Route::get('/admin/create-user', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('admin.create-user',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.create-user');

Route::get('/admin/device-register', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('admin.device-register',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.device-register');
/*Route::get('/admin/shift-model/create-model-shift', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('admin.shift-model.create-model-shift',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.shift-model.create-model-shift');*/

//Route::get('/structure', [ObjectStructureController::class, 'structureGet']);


Route::get('/admin/object-model/create-model-object', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
  
    return view('admin.object-model.create-model-object',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.object-model.create-model-object');

Route::get('/admin/object-model/test', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('admin.object-model.test',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.object-model.test');

Route::get('/admin/board', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('admin.board',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.board');

Route::get('/admin/board-information', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    $board = (new BoardController)->boardLoader();
    return view('admin.board-information',compact('id','parameters', 'board'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.board-information');

Route::get('/admin/employee-list', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('admin.employee-list',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.employee-list');

Route::get('/admin/calendar', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('admin.calendar',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.calendar');

Route::get('/admin/calendar-view', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('admin.calendar-view',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.calendar-view');

Route::get('/admin/offers', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('admin.offers',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.offers');


Route::get('/admin/offers', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('admin.offers',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.offers');

Route::get('/admin/permanent-time-options', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('admin.permanent-time-options',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.permanent-time-options');

Route::get('/admin/time-options', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('admin.time-options',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.time-options');

Route::get('/admin/employee-statistics', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('admin.employee-statistics',compact('id','parameters'));

})->middleware(['auth', 'verified', 'admin'])->name('admin.employee-statistics');
Route::get('/admin/my-permanent-time-options', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('admin.my-permanent-time-options',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.my-permanent-time-options');

Route::get('/admin/employee-list/{id}', [EmployeeLoader::class, 'showProfile'])->name('profile');

Route::get('/admin/assign-shifts/{id}', [AssignmentController::class, 'showAssignments'])->name('showAssignments');
Route::get('/admin/manager-rights/{id}', [RightsController::class, 'showRights'])->name('showRights');

Route::get('/admin/detail-offer/{id}', [OfferController::class, 'showOffer'])->name('showOffer');
Route::get('/manager/detail-offer/{id}', [OfferController::class, 'showOfferManager'])->name('showOfferManager');

Route::get('/admin/permanent-time-options/{id}', [OptionsController::class, 'showPermanentOption'])->name('showPermanentOption');

Route::get('/admin/employee-statistics/{id}', [CertainStatisticsController::class, 'showCertainStatistics'])->name('showCertainStatistics');




/*Route::post('/api/login_mobile',[AuthManager::class, "login"]);
Route::post('/api/register_mobile',[AuthManager::class, "register"]);*/
/*Route::get('/admin/employee-list/{id}', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    $showProfile = (new EmployeeLoader)->showProfile($id);
    return view('admin.employee-list-personal',compact('id','parameters', 'showProfile'));
})->middleware(['auth', 'verified', 'admin'])->name('profile');*/

Route::get('/admin/editor-profile', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
   

    //Route::get('/profile-image/{filename}', [ImageController::class, 'showProfileImage'])->name('profile.image');
    return view('admin.editor-profile',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.editor-profile');

Route::get('/admin/my-statistics', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('admin.my-statistics',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.my-statistics');

Route::get('/admin/confirm-offer-request', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
   

    //Route::get('/profile-image/{filename}', [ImageController::class, 'showProfileImage'])->name('profile.image');
    return view('admin.confirm-offer-request',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.confirm-offer-request');

//Route::get('/admin/editor-profile/{filename}', [UserAvatarController::class, 'showProfileImage'])->name('showProfileImage');
//Route::post('/admin/object-model/create-model-object', [ObjectStructureController::class, 'structureGet'])->name('structureGet');
//Route::post('/admin/object-model/create-model-object', [ObjectStructureController::class, 'parametrsGet'])->name('parametrsGet');


Route::get('/admin/dttest', function () {
    return view('admin.dttest');
})->middleware(['auth', 'verified', 'admin'])->name('admin.dttest');

Route::get('/admin/test2', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('admin.test2',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.test2');



Route::get('/manager/dashboard', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    $yesterday = (new PersonalShiftControler)->yesterday_shift();
    $today = (new PersonalShiftControler)->today_shift();
    $tommorow = (new PersonalShiftControler)->tomorrow_shift();
    $planned1 = (new PersonalShiftControler)->number_planned1();
    $planned2 = (new PersonalShiftControler)->number_planned2();
    $worked = (new PersonalShiftControler)->number_worked();
    $board = (new BoardController)->boardLoader();
    $today_offer = (new PersonalShiftControler)->today_offer();
    $tommorow_offer = (new PersonalShiftControler)->tommorow_offer();
    $tommorow_offer2 = (new PersonalShiftControler)->tommorow_offer_next();
    $tomorrow_shift_next = (new PersonalShiftControler)->tomorrow_shift_next();

    return view('manager.dashboard', compact('id','yesterday','today','tommorow','parameters','worked','planned1','planned2', 'board', 'today_offer', 'tommorow_offer', 'tommorow_offer2', 'tomorrow_shift_next'));
})->middleware(['auth', 'verified', 'manager'])->name('manager.dashboard');

Route::get('/manager/board-information', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    $board = (new BoardController)->boardLoader();
    return view('manager.board-information',compact('id','parameters', 'board'));
})->middleware(['auth', 'verified', 'manager'])->name('manager.board-information');

Route::get('/manager/my-permanent-time-options', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('manager.my-permanent-time-options',compact('id','parameters'));
})->middleware(['auth', 'verified', 'manager'])->name('manager.my-permanent-time-options');

Route::get('/manager/my-permanent-time-options', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('manager.my-permanent-time-options',compact('id','parameters'));
})->middleware(['auth', 'verified', 'manager'])->name('manager.my-permanent-time-options');

Route::get('/manager/my-statistics', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('manager.my-statistics',compact('id','parameters'));
})->middleware(['auth', 'verified', 'manager'])->name('manager.my-statistics');

Route::get('/manager/calendar-view', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('manager.calendar-view',compact('id','parameters'));
})->middleware(['auth', 'verified', 'manager'])->name('manager.calendar-view');

Route::get('/manager/calendar', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('manager.calendar',compact('id','parameters'));
})->middleware(['auth', 'verified', 'manager'])->name('manager.calendar');


Route::get('/manager/confirm-offer-request', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
       return view('manager.confirm-offer-request',compact('id','parameters'));
})->middleware(['auth', 'verified', 'manager'])->name('manager.confirm-offer-request');


Route::get('/manager/offers', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('manager.offers',compact('id','parameters'));
})->middleware(['auth', 'verified', 'manager'])->name('manager.offers');

Route::get('/manager/model-shift', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('manager.model-shift',compact('id','parameters'));
})->middleware(['auth', 'verified', 'manager'])->name('manager.model-shift');

Route::get('/manager/employee-list', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    return view('manager.employee-list',compact('id','parameters'));
})->middleware(['auth', 'verified', 'manager'])->name('manager.employee-list');


Route::get('/full_time/dashboard', function () {
    return view('full_time.dashboard');
})->middleware(['auth', 'verified', 'full_time'])->name('full_time.dashboard');

Route::get('/part_time/dashboard', function () {
    return view('part_time.dashboard');
})->middleware(['auth', 'verified', 'part_time'])->name('part_time.dashboard');




/*Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});



//use App\Http\Controllers\UserController;

Route::post('/ajax-submit',  [UserController::class, 'ajaxStore'])->name('user.ajaxStore');
Route::post('/verification_action',  [VerificationController::class, 'verification_action'])->name('verification_action');
Route::post('/verificationLoad',  [VerificationController::class, 'verificationLoad'])->name('verificationLoad');
Route::post('/verificationNew',  [VerificationController::class, 'verificationNew'])->name('verificationNew');
Route::post('/verifyUser',  [VerificationController::class, 'verifyUser'])->name('verifyUser');



Route::post('/mainObjectSelect',  [AssignmentController::class, 'mainObjectSelect'])->name('mainObjectSelect');
Route::post('/loadAssignmentStructure',  [AssignmentController::class, 'loadAssignmentStructure'])->name('loadAssignmentStructure');
Route::post('/insertAssignments',  [AssignmentController::class, 'insertAssignments'])->name('insertAssignments');
Route::post('/loadAssignmentTimeline',  [AssignmentController::class, 'loadAssignmentTimeline'])->name('loadAssignmentTimeline');
Route::post('/loadAssignmentList',  [AssignmentController::class, 'loadAssignmentList'])->name('loadAssignmentList');
Route::post('/loadShiftAssignmentStructure',  [AssignmentController::class, 'loadShiftAssignmentStructure'])->name('loadShiftAssignmentStructure');


Route::post('/structureRightsGet',  [RightsController::class, 'structureRightsGet'])->name('structureRightsGet');
Route::post('/insertRights',  [RightsController::class, 'insertRights'])->name('insertRights');
Route::post('/loadRightstTimeline',  [RightsController::class, 'loadRightstTimeline'])->name('loadRightstTimeline');
Route::post('/loadRightsList',  [RightsController::class, 'loadRightsList'])->name('loadRightsList');
Route::post('loadObjectsRights', [RightsController::class, 'loadObjectsRights'])->name('loadObjectsRights');


Route::post('/saveBoard',  [BoardController::class, 'saveBoard'])->name('saveBoard');
Route::post('/loadLargeBoard',  [BoardController::class, 'loadLargeBoard'])->name('loadLargeBoard');
Route::post('/MultiCarouselInsert',  [BoardController::class, 'MultiCarouselInsert'])->name('MultiCarouselInsert');
Route::post('/MultiCarouselInsert2',  [BoardController::class, 'MultiCarouselInsert2'])->name('MultiCarouselInsert2');
Route::post('/storeImageBoard',  [BoardController::class, 'storeImageBoard'])->name('storeImageBoard');
Route::post('/loadBoardData',  [BoardController::class, 'loadBoardData'])->name('loadBoardData');
Route::post('/updateBoard',  [BoardController::class, 'updateBoard'])->name('updateBoard');
Route::post('/updateImageBoard',  [BoardController::class, 'updateImageBoard'])->name('updateImageBoard');
Route::post('/loadBoardTimeline',  [BoardController::class, 'loadBoardTimeline'])->name('loadBoardTimeline');
Route::post('/deleteBoard',  [BoardController::class, 'deleteBoard'])->name('deleteBoard');


Route::post('/registerDevice',  [DeviceController::class, 'registerDevice'])->name('registerDevice');
Route::post('/validateSecureCookie',  [DeviceController::class, 'validateSecureCookie'])->name('validateSecureCookie');
Route::post('/loadDevices',  [DeviceController::class, 'loadDevices'])->name('loadDevices');
Route::post('/changeDeviceStatusActive',  [DeviceController::class, 'changeDeviceStatusActive'])->name('changeDeviceStatusActive');
Route::post('/changeDeviceStatusSuspend',  [DeviceController::class, 'changeDeviceStatusSuspend'])->name('changeDeviceStatusSuspend');


Route::post('/cal_obj_load',  [CalendarController::class, 'cal_obj_load'])->name('cal_obj_load');
Route::post('/cal_obj_load_view',  [CalendarController::class, 'cal_obj_load_view'])->name('cal_obj_load_view');

Route::post('/pickLoaderCalendar',  [CalendarController::class, 'pickLoaderCalendar'])->name('pickLoaderCalendar');

Route::post('/pickLoaderCalendarEditor',  [CalendarController::class, 'pickLoaderCalendarEditor'])->name('pickLoaderCalendarEditor');

Route::post('/getCommentCalendar',  [CalendarController::class, 'getCommentCalendar'])->name('getCommentCalendar');
Route::post('/getSavedCalendarData',  [CalendarController::class, 'getSavedCalendarData'])->name('getSavedCalendarData');
Route::post('/getShiftOffer',  [CalendarController::class, 'getShiftOffer'])->name('getShiftOffer');
Route::post('/insertOffer',  [CalendarController::class, 'insertOffer'])->name('insertOffer');
Route::post('/deleteOffer',  [CalendarController::class, 'deleteOffer'])->name('deleteOffer');




Route::post('/insertCalendarData',  [AlgorithmController::class, 'insertCalendarData'])->name('insertCalendarData');
Route::post('/loadEmployeeTableCalendar',  [AlgorithmController::class, 'loadEmployeeTableCalendar'])->name('loadEmployeeTableCalendar');
Route::post('/algorithmSelectBest',   [AlgorithmController::class, 'algorithmSelectBest'])->name('algorithmSelectBest');
Route::post('/algorithmPick',   [AlgorithmController::class, 'algorithmPick'])->name('algorithmPick');
Route::post('/algorithmBestCombination',   [AlgorithmController::class, 'algorithmBestCombination'])->name('algorithmBestCombination');


Route::post('/today_offer',  [PersonalShiftControler::class, 'today_offer'])->name('today_offer');


Route::post('/adminGetAllOffer',  [OfferController::class, 'adminGetAllOffer'])->name('adminGetAllOffer');
Route::post('/sendOffer',  [OfferController::class, 'sendOffer'])->name('sendOffer');
Route::post('/deleteOffer',  [OfferController::class, 'deleteOffer'])->name('deleteOffer');



Route::post('/loadRequestWaiting',  [ShiftRequest::class, 'loadRequestWaiting'])->name('loadRequestWaiting');
Route::post('/loadRequestHistory',  [ShiftRequest::class, 'loadRequestHistory'])->name('loadRequestHistory');
Route::post('/loadRequestTable',  [ShiftRequest::class, 'loadRequestTable'])->name('loadRequestTable');
Route::post('/confirmRequest',   [ShiftRequest::class, 'confirmRequest'])->name('confirmRequest');
Route::post('/requestProfile',   [ShiftRequest::class, 'requestProfile'])->name('requestProfile');


Route::post('/loadOrganizationTable',   [OrganizationController::class, 'loadOrganizationTable'])->name('loadOrganizationTable');


Route::post('/insertPermanenntOption',   [OptionsController::class, 'insertPermanenntOption'])->name('insertPermanenntOption');
Route::post('/loadPermanentOptions',   [OptionsController::class, 'loadPermanentOptions'])->name('loadPermanentOptions');
Route::post('/loadPermanentOptionsTimeline',   [OptionsController::class, 'loadPermanentOptionsTimeline'])->name('loadPermanentOptionsTimeline');
Route::post('/loadTimeOptions',   [OptionsController::class, 'loadTimeOptions'])->name('loadTimeOptions');
Route::post('/insertTimeOptions',   [OptionsController::class, 'insertTimeOptions'])->name('insertTimeOptions');



Route::post('/yearlyStats',   [StatisticsController::class, 'yearlyStats'])->name('yearlyStats');
Route::post('/weekStats',   [StatisticsController::class, 'weekStats'])->name('weekStats');
Route::post('/myStatsTable',   [StatisticsController::class, 'myStatsTable'])->name('myStatsTable');
Route::post('/myStats',   [StatisticsController::class, 'myStats'])->name('myStats');
Route::post('/loadStatsComment',   [StatisticsController::class, 'loadStatsComment'])->name('loadStatsComment');
Route::post('/loadPieStats',   [StatisticsController::class, 'loadPieStats'])->name('loadPieStats');
Route::post('/loadTableLog',   [StatisticsController::class, 'loadTableLog'])->name('loadTableLog');
Route::post('/loadTableBreak',   [StatisticsController::class, 'loadTableBreak'])->name('loadTableBreak');


Route::post('/certainStatsTable',   [CertainStatisticsController::class, 'certainStatsTable'])->name('certainStatsTable');
Route::post('/certainStats',   [CertainStatisticsController::class, 'certainStats'])->name('certainStats');
Route::post('/loadStatsCommentCertain',   [CertainStatisticsController::class, 'loadStatsCommentCertain'])->name('loadStatsCommentCertain');
Route::post('/loadPieStatsCertain',   [CertainStatisticsController::class, 'loadPieStatsCertain'])->name('loadPieStatsCertain');
Route::post('/loadTableLogCertain',   [CertainStatisticsController::class, 'loadTableLogCertain'])->name('loadTableLogCertain');
Route::post('/loadTableBreakCertain',   [CertainStatisticsController::class, 'loadTableBreakCertain'])->name('loadTableBreakCertain');



Route::post('/confirmArrival',   [AttendanceController::class, 'confirmArrival'])->name('confirmArrival');
Route::post('/confirmDeparture',   [AttendanceController::class, 'confirmDeparture'])->name('confirmDeparture');
Route::post('/attendanceConditions',   [AttendanceController::class, 'attendanceConditions'])->name('attendanceConditions');
Route::post('/startBreak',   [AttendanceController::class, 'startBreak'])->name('startBreak');
Route::post('/endBreak',   [AttendanceController::class, 'endBreak'])->name('endBreak');






//loadTimeOptions
//changeDeviceStatus
/*Route::post('/admin/object-model/create-model-object/create', [ObjectStructureController::class, 'structureGet'])->name('structureGet');
Route::post('/admin/object-model/create-model-object/update', [ObjectStructureController::class, 'parametrsGet'])->name('parametrsGet');*/
//Route::get('/admin/object-model/create-model-object', [ObjectStructureController::class, 'index'])->name('objectModelIndex');

/*Route::post('/admin/object-model/create-model-object', function () {
    $id = (new ObjectStructureController)->session_id();
    $parameters = (new ObjectStructureController)->session_parameters();
    return view('admin.object-model.create-model-object',compact('id','parameters'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.object-model.create-model-object');*/

Route::prefix('admin/object-model/create-model-object/')->group(function () {
    Route::post('structureGet', [ObjectStructureController::class, 'structureGet'])->name('structureGet');
    Route::post('parametrsGet', [ObjectStructureController::class, 'parametrsGet'])->name('parametrsGet');
    Route::post('structureCreate', [ObjectStructureController::class, 'structureCreate'])->name('structureCreate');
    Route::post('structureSubCreate', [ObjectStructureController::class, 'structureSubCreate'])->name('structureSubCreate');
    Route::post('structureDelete', [ObjectStructureController::class, 'structureDelete'])->name('structureDelete');
    Route::post('structureRename', [ObjectStructureController::class, 'structureRename'])->name('structureRename');
    Route::post('selectMainObjects', [ObjectStructureController::class, 'selectMainObjects'])->name('selectMainObjects');
    Route::post('treeLoad', [ObjectStructureController::class, 'treeLoad'])->name('treeLoad');

    
    
    //Route::post('objectDropdown', [ObjectStructureController::class, 'objectDropdown'])->name('objectDropdown');
});

Route::prefix('admin/employee-list/')->group(function () {
    Route::post('LoadNumberAll', [EmployeeLoader::class, 'LoadNumberAll'])->name('LoadNumberAll');
    Route::post('loadEmployee', [EmployeeLoader::class, 'loadEmployee'])->name('loadEmployee');
    Route::post('calendarEmployeeSearch', [EmployeeLoader::class, 'calendarEmployeeSearch'])->name('calendarEmployeeSearch');
    Route::post('getNameRole', [EmployeeLoader::class, 'getNameRole'])->name('getNameRole');

    
    //Route::post('objectDropdown', [ObjectStructureController::class, 'objectDropdown'])->name('objectDropdown');
});

Route::prefix('admin/email/')->group(function () {
    Route::post('sendEmail', [EmailController::class, 'sendEmail'])->name('sendEmail');
    
    //Route::post('objectDropdown', [ObjectStructureController::class, 'objectDropdown'])->name('objectDropdown');
});

Route::get('/email-verification', function () {
    //$details = (new EmailController)->sendEmail();

    return view('email-verification');
    //return view('email-verification');
})->name('email-verification');

Route::prefix('admin/shift-model/create-model-shift/')->group(function () {
    Route::post('loadExistingShifts', [ShiftController::class, 'loadExistingShifts'])->name('loadExistingShifts');
    Route::post('loadExistingObjects', [ShiftController::class, 'loadExistingObjects'])->name('loadExistingObjects');
    Route::post('loadExistingListShift', [ShiftController::class, 'loadExistingListShift'])->name('loadExistingListShift');
    Route::post('loadObjectStructure', [ShiftController::class, 'loadObjectStructure'])->name('loadObjectStructure');
    Route::post('shiftSave', [ShiftController::class, 'shiftSave'])->name('shiftSave');
    Route::post('loadExistingShiftParametrs', [ShiftController::class, 'loadExistingShiftParametrs'])->name('loadExistingShiftParametrs');
    Route::post('editShift', [ShiftController::class, 'editShift'])->name('editShift');
    Route::post('enableShift', [ShiftController::class, 'enableShift'])->name('enableShift');
    Route::post('deleteShift', [ShiftController::class, 'deleteShift'])->name('deleteShift');

    
    });
    Route::prefix('admin/editor-profile/')->group(function () {
    
        Route::post('storeImage', [UserAvatarController::class, 'storeImage'])->name('storeImage');
        Route::post('showProfileImage', [UserAvatarController::class, 'showProfileImage'])->name('showProfileImage');
        Route::post('showProfileImageChat', [UserAvatarController::class, 'showProfileImageChat'])->name('showProfileImageChat');
        Route::post('updateProfile', [UserAvatarController::class, 'updateProfile'])->name('updateProfile');
        Route::post('updateProfilePersonal', [UserAvatarController::class, 'updateProfilePersonal'])->name('updateProfilePersonal');
        Route::post('loadEditTimeline', [UserAvatarController::class, 'loadEditTimeline'])->name('loadEditTimeline');

        
        
        /*Route::post('/get-image', function (Request $request) {
            $filename = $request->input('filename');
        
            // Check if the image exists in the 'public' disk (storage/app/public)
            if (Storage::disk('public')->exists('profile-images/' . $filename)) {
                // Return the URL to the image
                return response()->json([
                    'url' => Storage::disk('public')->url('profile-images/' . $filename)
                ]);
            }
        
            return response()->json(['error' => 'Image not found'], 404);
        })->name('get.image');*/
    
        });
        Route::post('showImagePersonal', [UserAvatarController::class, 'showImagePersonal'])->name('showImagePersonal');

        Route::post('parameters', [ProfileController::class, 'parameters'])->name('parameters');
        Route::post('insertUser', [ProfileController::class, 'insertUser'])->name('insertUser');
        Route::post('storeImageInsert', [ProfileController::class, 'storeImageInsert'])->name('storeImageInsert');
/*Route::post('/admin/object-model/create-model-object', [ObjectStructureController::class, 'structureGet'])->name('structureGet');
Route::post('/admin/object-model/update-model-object', [ObjectStructureController::class, 'parametrsGet'])->name('parametrsGet');*/
/*Route::post('/admin/object-model/create-model-object', function (Illuminate\Http\Request $request) {
  
    $userController = new ObjectStructureController();
    $userResponse = $userController->structureGet($request);
 
    $productController = new ObjectStructureController();
    $productResponse = $productController->parametrsGet($request); 

    return response()->json([
        'structureGet' => $userResponse,
        'parametrsGet' => $productResponse,
    ]);
});*/





//Route::post('/admin/object-model/create-model-object', [ObjectStructureController::class, 'parametrsGet'])->name('parametrsGet');

/*Route::get('/email/verify',function(){
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verify/{id}/{hash}',function(EmailVerificationRequest $request){
    $request->fulfill();

    return view('/profile');
})->middleware(['auth','signed'])->name('verification.verify');

Route::post('/email/verification-notification',function(Request $request){
    $request->user()->sendEmailVerificationNotification();
    
    return back()->with('message','Verification link sent!');
})->middleware(['auth','throttle:6,1'])->name('verification.send');*/


Route::get('/admin/dashboard3', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    $yesterday = (new PersonalShiftControler)->yesterday_shift();
    $today = (new PersonalShiftControler)->today_shift();
    $tommorow = (new PersonalShiftControler)->tomorrow_shift();
    $planned1 = (new PersonalShiftControler)->number_planned1();
    $planned2 = (new PersonalShiftControler)->number_planned2();
    $worked = (new PersonalShiftControler)->number_worked();
    $board = (new BoardController)->boardLoader();
    return view('admin.dashboard3', compact('id','yesterday','today','tommorow','parameters','worked','planned1','planned2', 'board'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard3');


Route::get('/admin/dashboard-main', function () {
    $id = (new ProfileController)->session_id();
    $parameters = (new ProfileController)->session_parameters();
    $yesterday = (new PersonalShiftControler)->yesterday_shift();
    $today = (new PersonalShiftControler)->today_shift();
    $tommorow = (new PersonalShiftControler)->tomorrow_shift();
    $planned1 = (new PersonalShiftControler)->number_planned1();
    $planned2 = (new PersonalShiftControler)->number_planned2();
    $worked = (new PersonalShiftControler)->number_worked();
    $board = (new BoardController)->boardLoader();
    $today_offer = (new PersonalShiftControler)->today_offer();
    $tommorow_offer = (new PersonalShiftControler)->tommorow_offer();
    $tommorow_offer2 = (new PersonalShiftControler)->tommorow_offer_next();
    $tomorrow_shift_next = (new PersonalShiftControler)->tomorrow_shift_next();

    return view('admin.dashboard-main', compact('id','yesterday','today','tommorow','parameters','worked','planned1','planned2', 'board', 'today_offer', 'tommorow_offer', 'tommorow_offer2', 'tomorrow_shift_next'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard-main');
/*Route::post('/admin/user_data' ,[UserController::class, 'admin.user_data']);
Route::get('/admin/dttest' ,[UserController::class, 'index']);*/

Route::post('/broadcasting/auth', function (Request $request) {
    try {
        return Broadcast::auth($request);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

//Route::get('/', 'MessagesController@index')->name(config('chatify.routes.prefix'));

/**
 *  Fetch info for specific id [user/group]
 */
//Route::post('/idInfo', 'MessagesController@idFetchData');

/**
 * Send message route
 */
//Route::post('/sendMessage', 'MessagesController@send')->name('send.message');

/**
 * Fetch messages
 */
//Route::post('/fetchMessages', 'MessagesController@fetch')->name('fetch.messages');

/**
 * Download attachments route to create a downloadable links
 */
//Route::get('/download/{fileName}', 'MessagesController@download')->name(config('chatify.attachments.download_route_name'));

/**
 * Authentication for pusher private channels
 */
//Route::post('/chat/auth', 'MessagesController@pusherAuth')->name('pusher.auth');

/**
 * Make messages as seen
 */
//Route::post('/makeSeen', 'MessagesController@seen')->name('messages.seen');

/**
 * Get contacts
 */
//Route::get('/getContacts', 'MessagesController@getContacts')->name('contacts.get');

/**
 * Update contact item data
 */
//Route::post('/updateContacts', 'MessagesController@updateContactItem')->name('contacts.update');


/**
 * Star in favorite list
 */
//Route::post('/star', 'MessagesController@favorite')->name('star');

/**
 * get favorites list
 */
//Route::post('/favorites', 'MessagesController@getFavorites')->name('favorites');

/**
 * Search in messenger
 */
//Route::get('/search', 'MessagesController@search')->name('search');

/**
 * Get shared photos
 */
//Route::post('/shared', 'MessagesController@sharedPhotos')->name('shared');

/**
 * Delete Conversation
 */
//Route::post('/deleteConversation', 'MessagesController@deleteConversation')->name('conversation.delete');

/**
 * Delete Message
 */
//Route::post('/deleteMessage', 'MessagesController@deleteMessage')->name('message.delete');

/**
 * Update setting
 */
//Route::post('/updateSettings', 'MessagesController@updateSettings')->name('avatar.update');

/**
 * Set active status
 */
//Route::post('/setActiveStatus', 'MessagesController@setActiveStatus')->name('activeStatus.set');






/*
* [Group] view by id
*/
//Route::get('/group/{id}', 'MessagesController@index')->name('group');

/*
* user view by id.
* Note : If you added routes after the [User] which is the below one,
* it will considered as user id.
*
* e.g. - The commented routes below :
*/
// Route::get('/route', function(){ return 'Munaf'; }); // works as a route
//Route::get('/{id}', 'MessagesController@index')->name('user');
// Route::get('/route', function(){ return 'Munaf'; }); // works as a user id



require __DIR__.'/auth.php';
