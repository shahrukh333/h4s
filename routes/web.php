<?php

// ****************************** INDEX CONTROLLER ********************************************

Route::get('/', 'IndexController@index')->name('HomePage');

Route::get('cities/{city}', 'IndexController@city');

Route::get('sidebar/{id}', 'IndexController@show');

Route::get('show/{id}', 'IndexController@showHostelCommit');

Route::get('/searchShow/{id}', 'IndexController@searchShowCommit');

Route::get('cities/show/{id}', 'IndexController@show');

Route::post('search', 'IndexController@searchCommit');

Route::post('/searchsidebar', 'IndexController@modifySearch');

Route::get('/index', 'IndexController@index'); 

Route::get('/editprofile', 'IndexController@editProfile');

Route::get('/booking','IndexController@booking');

Auth::routes(['verify' => true]);

Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

// *************************** USERS CONTROLLER *********************************************

Route::post('/registerManager',[
    'uses' => 'UsersController@registerManagerCommit',
    'as' => 'registerManager'
]);

Route::post('/addHosteller',[
    'uses' => 'UsersController@addHostellerCommit',
    'as' => 'addHosteller'
]);

Route::post('/validateUser',[
    'uses' => 'UsersController@validateUserCommit',
    'as' => 'validateUser'
]);

Route::get('/getHostelManager','UsersController@getManagerCommit');

Route::get('/removeHostelManager/{id}',[
    'uses' => 'UsersController@removeHostelManagerCommit',
    'as' => 'removeHostelManager'
]);

Route::post('/updateUsername','UsersController@updateUsernameCommit');

Route::post('/updatePassword','UsersController@updatePasswordCommit');

Route::get('/deleteAccount','UsersController@deleteAccountCommit');

Route::get('/addhostelmanager','UsersController@addHostelManagerCommit');

Route::get('/leaveHostel','UsersController@leaveHostelCommit');

Route::post('/hostelManagerLeave','UsersController@hostelManagerLeaveCommit');

Route::get('/approveHostelManagerLeave/{id}','UsersController@approveHostelManagerLeaveCommit');

// *************************** MESS MENU CONTROLLER ****************************************

//Route::get('/showHostel', 'HostelsController@index');

Route::post('/showMessMenu/{id}',[
    'uses' => 'MessMenuController@showMessMenu',
    'as' => 'showMessMenu'
]);


/**
 * add breakfast menu
 */
Route::post('/addBreakfastMenu',[
    'uses' => 'MessMenuController@addBreakfastMenuCommit',
    'as' => 'addBreakfastMenu'
]);

/**
 * add lunch menu
 */
Route::post('/addLunchMenu',[
    'uses' => 'MessMenuController@addLunchMenuCommit',
    'as' => 'addLunchMenu'
]);

/**
 * add lunch menu
 */
Route::post('/addDinnerMenu',[
    'uses' => 'MessMenuController@addDinnerMenuCommit',
    'as' => 'addDinnerMenu'
]);

/**
 * edit breakfast route
 */
Route::get('/editBreakfast/{id}',[
    'uses' => 'MessMenuController@showEditBreakfastPage',
    'as' => 'editBreakfast'
]);

/**
 * edit lunch route
 */
Route::get('/editLunch/{id}',[
    'uses' => 'MessMenuController@showEditLunchPage',
    'as' => 'editLunch'
]);

/**
 * edit dinner route
 */
Route::get('/editDinner/{id}',[
    'uses' => 'MessMenuController@showEditDinnerPage',
    'as' => 'editDinner'
]);

/**
 * update dinner route
 */
Route::post('/updatebreakfast',[
    'uses' => 'MessMenuController@updateBreakfastMenu',
    'as' => 'updatebreakfast'
]);

/**
 * update lunch route
 */
Route::post('/updatelunch',[
    'uses' => 'MessMenuController@updateLunchMenu',
    'as' => 'updatelunch'
]);

/**
 * update dinner route
 */
Route::post('/updatedinner',[
    'uses' => 'MessMenuController@updateDinnerMenu',
    'as' => 'updatedinner'
]);

Route::get('/addMessMenu','MessMenuController@addMessMenu');

Route::get('/Mess','MessMenuController@getHostelMess');

Route::get('/hostelMessMenu','MessMenuController@hostelMessMenuCommit');

// *************************** RULES CONTROLLER *****************************************

/**
 * this route returns hostel rules
 */
Route::get('/Rules',[
    'uses' => 'RulesController@getHostelRules',
    'as' => 'Rules'
]);

/**
 * this route returns edit hostel rule page
 */
Route::get('/editHostelRules/{id}',[
    'uses' => 'RulesController@displayEditHostelRulesPage',
    'as' => 'editHostelRules'
]);

/**
 * this route returns edit hostel rule page
 */
Route::post('/updateRules',[
    'uses' => 'RulesController@updateRulesCommit',
    'as' => 'updateRules'
]);

Route::post('/addHostelRule', [
    'uses' => 'RulesController@addHostelRulesCommit',
    'as' => 'addHostelRule'
]);

Route::get('/hostelRules', 'RulesController@hostelRulesCommit');

// *************************** FACILITY REVIEW CONTROLLER ******************************

/**
 * this route returns hostel facilities
 */
Route::get('/getHostelFacilities',[
    'uses' => 'FacilityReviewController@getHostelFacilities',
    'as' => 'getHostelFacilities'
]);

/**
 * this route returns hostel facilities
 */
Route::get('/updateReviewStatus/{id}',[
    'uses' => 'FacilityReviewController@updateReviewStatusCommit',
    'as' => 'updateReviewStatus'
]);

/**
 * this route returns edit hostel facility page
 */
Route::get('/editHostelFacilities/{id}',[
    'uses' => 'FacilityReviewController@displayEditHostelFacilitiesPage',
    'as' => 'editHostelFacilities'
]);

/**
 * this route returns the registe hostel method
 */
Route::post('/registerHostelReview',[
    'uses' => 'FacilityReviewController@registerHostelReviewCommit',
    'as' => 'registerHostelReview'
]);

/**
 * this route returns the method to update hostel facilities
 */
Route::post('/updateHostelFacilities',[
    'uses' => 'FacilityReviewController@updateHostelFacilitiesCommit',
    'as' => 'updateHostelFacilities'

]);

Route::post('/updateReview',[
    'uses' => 'FacilityReviewController@updateReviewCommit',
    'as' => 'updateReview'

]);

Route::post('/addHostelFacility', 'FacilityReviewController@addHostelFacilities');

Route::get('/myReviews','FacilityReviewController@myReviewsCommit');

Route::get('/editReview/{id}','FacilityReviewController@editReviewCommit');

Route::get('/Review','FacilityReviewController@reviewCommit');

Route::get('/reviewHostel','FacilityReviewController@reviewHostelCommit');


// *************************** DASHBOARD CONTROLLER *********************************

Route::get('/dashboard', [
    'uses' => 'dashboardController@index',
    'as' => 'dashboard'
]);
//->middleware('verified')

Route::get('/myHostel/{id}',[
    'uses' => 'dashboardController@myHostelCommit',
    'as' => 'myHostel'
]);



// *************************** COMPLAINTS QUERIES CONTROLLER *****************************

Route::get('/Complaint','ComplaintsQueriesController@complaintCommit');

Route::get('/Query','ComplaintsQueriesController@viewQueries');

Route::get('/updateComplaints/{id}','ComplaintsQueriesController@updateHostelComplaints');

Route::get('/showReplyQueryPage/{id}','ComplaintsQueriesController@showReplyQueryPage');

Route::get('/replycomplaints/{id}','ComplaintsQueriesController@replyHostelComplaint');

Route::get('/hostelComplaint','ComplaintsQueriesController@hostelComplaintCommit');

Route::get('/myComplaints','ComplaintsQueriesController@myComplaintsCommit');

Route::get('/editComplaint/{id}','ComplaintsQueriesController@editComplaintCommit');

Route::get('/deleteComplaint/{id}','ComplaintsQueriesController@deleteComplaintCommit');

Route::get('/registerQuery','ComplaintsQueriesController@registerQueryCommit');

Route::post('/replyComplaint',[
    'uses'=>'ComplaintsQueriesController@storeComplaintReply',
    'as'=>'replyComplaint'
]);

Route::post('/updateComplaint',[
    'uses'=>'ComplaintsQueriesController@updateComplaintCommit',
    'as'=>'updateComplaint'
]);

Route::post('/getComplaintReply',[
    'uses'=>'ComplaintsQueriesController@getComplaintReplyCommit',
    'as'=>'getComplaintReply'
]); 

Route::post('/replyQuery',[
    'uses'=>'ComplaintsQueriesController@storeQueryReply',
    'as'=>'replyQuery'
]);

Route::post('/registerHostelQuery',[
    'uses'=>'ComplaintsQueriesController@registerHostelQueryCommit',
    'as'=>'registerHostelQuery'
]);

Route::post('/updateQuery',[
    'uses'=>'ComplaintsQueriesController@updateQueryCommit',
    'as'=>'updateQuery'
]);

Route::post('/registerComplaint',[
    'uses'=>'ComplaintsQueriesController@registerComplaintCommit',
    'as'=>'registerComplaint'
]);

Route::post('/getQueryReply',[
    'uses'=>'ComplaintsQueriesController@getQueryReplyCommit',
    'as'=>'getQueryReply'
]);

Route::get('/myQueries','ComplaintsQueriesController@myQueriesCommit');

Route::get('/editQuery/{id}','ComplaintsQueriesController@editQueryCommit');

Route::get('/deleteQuery/{id}','ComplaintsQueriesController@deleteQueryCommit');

Route::get('/deleteHostellerQuery/{id}','ComplaintsQueriesController@deleteHostellerQueryCommit');

Route::get('/getComReply/{id}','ComplaintsQueriesController@getComplaintReply');

Route::get('/getQueReply/{id}','ComplaintsQueriesController@getQueReplyCommit');

Route::get('/adminHostelComplaints', 'ComplaintsQueriesController@adminHostelComplaintsCommit');

Route::get('/adminViewHostelComplaints/{id}', 'ComplaintsQueriesController@adminViewHostelComplaintsCommit');

// *************************** BOOKINGS CONTROLLER *************************************

Route::post('/bookHostel','BookingsController@bookHostelCommit');

Route::get('/booking','BookingsController@bookingCommit');

Route::get('/BookingRequest','BookingsController@viewBookingRequests');

Route::get('/acceptRequest/{id}','BookingsController@viewAcceptBookingRequestPage');

Route::get('/addHosteller/{id}/{rId}','BookingsController@addHostellerCommit');

Route::get('/myBooking', 'BookingsController@myBookingCommit');

Route::get('/deleteBookingRequest/{id}', 'BookingsController@deleteBookingRequest');

Route::get('/cancelBookingRequest/{id}', 'BookingsController@cancelBookingRequestCommit');

Route::post('/updateBooking',[
    'uses'=>'BookingsController@updateBookingCommit',
    'as'=>'updateBooking'
]);

Route::post('/cancelBooking',[
    'uses'=>'BookingsController@cancelBookingCommit',
    'as'=>'cancelBooking'
]);

Route::post('/getRoomStatus',[
    'uses'=>'BookingsController@getRoomStatusCommit',
    'as'=>'getRoomStatus'
]);

// *************************** ROOMS SPACE FACILITY CONTROLLER *************************

Route::get('/hostelRoom','RoomSpaceFacilityController@hostelRoomCommit');

Route::get('/getRoom/{id}',[
    'uses' => 'RoomSpaceFacilityController@getHostelRoom',
    'as' => 'getRoom'
]);

Route::post('/addRoom',[
    'uses'=>'RoomSpaceFacilityController@addHostelRoom',
    'as'=>'addRoom'
]);

Route::post('/updateRoomDetail',[
    'uses'=>'RoomSpaceFacilityController@updateRoomDetailCommit',
    'as'=>'updateRoomDetail'
]);

Route::post('/removeHostelRoom',[
    'uses'=>'RoomSpaceFacilityController@removeHostelRoomCommit',
    'as'=>'removeHostelRoom'
]);

Route::get('/removeRoomate/{id}','RoomSpaceFacilityController@removeRoomate');

Route::get('/shiftHosteller/{id}/{roomId}','RoomSpaceFacilityController@shiftHostellerCommit');

Route::get('/changeHostellerRoom/{id}/{hId}','RoomSpaceFacilityController@changeHostellerRoomCommit');

// *************************** NOTIFICATIONS CONTROLLER ********************************

Route::get('/myNotifications','NotificationsController@myNotificationsCommit');

Route::get('/getMyMess/{id}','NotificationsController@getMyMessCommit');

Route::get('/getMyRules/{id}','NotificationsController@getMyRulesCommit');

Route::get('/myComplaintReply/{id}','NotificationsController@getMyComplaintCommit');

Route::get('/myQueryReply/{id}','NotificationsController@getMyQueryCommit');

Route::get('/hostelFacilities','NotificationsController@hostelFacilitiesCommit');

Route::get('/myDuesNotification/{id}','NotificationsController@myDuesNotificationCommit');

// ******************************* HOSTELS CONTROLLER *************************************

Route::get('/hostelRegistration','HostelsController@hostelRegistrationCommit');

Route::get('/hostelInformation','HostelsController@hostelInformationCommit');

Route::post('/registerHostel',[
    'uses'=>'HostelsController@registerHostelCommit',
    'as'=>'registerHostel'
]);

Route::post('/updateHostelInformation',[
    'uses'=>'HostelsController@updateHostelInformationCommit',
    'as'=>'updateHostelInformation'
]);

Route::post('/getHostelData',[
    'uses'=>'HostelsController@getHostelDataCommit',
    'as'=>'getHostelData'
]);

Route::get('/deleteHostelImage/{name}/{id}',[
    'uses'=>'HostelsController@deleteHostelImageCommit',
    'as'=>'deleteHostelImage'
]);

Route::get('/editHostelInformation/{id}','HostelsController@editHostelInformationCommit');

Route::get('/editHostelImages','HostelsController@editHostelImagesCommit');

Route::post('/addHostelImage','HostelsController@addHostelImageCommit');

Route::get('/practice',function(){
    return view('practice');
});

Route::get('/deleteHostel','HostelsController@deleteHostelCommit');

// ******************************* DUES CONTROLLER **************************************

Route::get('/hostelDuesData',[
    'uses'=>'DuesController@hostelDuesDataCommit',
    'as'=>'hostelDuesData'
]);

Route::get('/editHostellerDues/{id}',[
    'uses'=>'DuesController@editHostellerDuesCommit',
    'as'=>'editHostellerDues'
]);

Route::post('/updateHostellerDues',[
    'uses'=>'DuesController@updateHostellerDuesCommit',
    'as'=>'updateHostellerDues'
]);

Route::get('/editHostellerDues/{id}/{name}', 'DuesController@editHostellerDuesCommit');

Route::get('/myHostelDues', 'DuesController@myHostelDuesCommit');

Route::get('/notifyDefaulters', 'DuesController@notifyDefaultersCommit');

Route::get('/resetDuesData', 'DuesController@resetDuesDataCommit');

Route::post('/adjustPreviousBalance', 'DuesController@adjustPreviousBalanceCommit');

/* *************************************** ADMIN TASKS CONTROLLER ************************************** */

Route::get('/issueWarning/{id}', 'AdminTasksController@issueWarningCommit');

Route::get('/blockedHostels', 'AdminTasksController@blockedHostelsCommit');

Route::get('/warnedHostels', 'AdminTasksController@warnedHostelsCommit');

Route::get('/NotifyHostelOwner/{id}', 'AdminTasksController@NotifyHostelOwnerCommit');

Route::get('/notifyOwner/{id}', 'AdminTasksController@notifyOwnerCommit');

Route::get('/unblockHostel/{id}', 'AdminTasksController@unblockHostelCommit');

Route::get('/blockHostel/{id}', 'AdminTasksController@blockHostelCommit');
