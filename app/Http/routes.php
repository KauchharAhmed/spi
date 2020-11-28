<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
#--------------------- process event----------------------#
Route::get('/process_event','FrontendController@process_event');
Route::get('/door_one','FrontendController@door_one');
Route::get('/door_two','FrontendController@door_two');
#-------------------- end process event--------------------#
#----------------------- FRONT END -----------------------#
Route::get('/','FrontendController@index');
Route::get('/missionVision','FrontendController@missionVision');
Route::get('/history','FrontendController@history');
Route::get('/notice','FrontendController@notice');
Route::get('/contactUs','FrontendController@contactUs');
Route::get('/photoGallery','FrontendController@photoGallery');
Route::get('/videoGallery','FrontendController@videoGallery');
Route::get('/singleNews','FrontendController@singleNews');
Route::get('/prinicipalMessage','FrontendController@prinicipalMessage');
Route::get('/spiStaffList','FrontendController@spiStaffList');
Route::get('/spiDeptInfo/{dept_id}','FrontendController@spiDeptInfo');
Route::get('/spiClassRoutine','FrontendController@spiClassRoutine');
Route::post('/getStudentSemisterWiseRoutine','FrontendController@getStudentSemisterWiseRoutine');
Route::get('/sectionPageInfo/{section_id}/{sub_section_id}','FrontendController@sectionPageInfo');
#---------------------- WEB ADMIN ACCESS -------------------------------#
Route::get('/webAdmin/{superadmin_id}/{type}','WebAdminController@webAdmin');
Route::get('/webMasterDashboard','WebAdminController@webMasterDashboard');
Route::post('/insertPrincipalMessage','WebAdminController@insertPrincipalMessage');
Route::get('/changePrincipalStatus/{id}','WebAdminController@changePrincipalStatus');
Route::get('/editPrincipalMessage/{id}','WebAdminController@editPrincipalMessage');
Route::post('/updatePrincipalMessage','WebAdminController@updatePrincipalMessage');
Route::get('/webAddNotice','WebAdminController@webAddNotice');
Route::get('/webAddNoticeInfo','WebAdminController@webAddNoticeInfo');
Route::post('/webAddNoticeInfo','WebAdminController@webAddNoticeInfo');
Route::get('/webManageNotice','WebAdminController@webManageNotice');
Route::get('/w_notice_delete/{id}','WebAdminController@w_notice_delete');
Route::get('/webBannerAdd','WebAdminController@webBannerAdd');
Route::post('/webAddBannerInfo','WebAdminController@webAddBannerInfo');
Route::get('/webManageBanner','WebAdminController@webManageBanner');
Route::get('/webLatestNewsAndEventAdd','WebAdminController@webLatestNewsAndEventAdd');
Route::post('/webAddEventInfo','WebAdminController@webAddEventInfo');
Route::get('/webManageLatestNewsAndEvent','WebAdminController@webManageLatestNewsAndEvent');
Route::get('/webAddPhotoGallary','WebAdminController@webAddPhotoGallary');
Route::post('/webAddPhotoGallaryInfo','WebAdminController@webAddPhotoGallaryInfo');
Route::get('/webManagePhotoGallary','WebAdminController@webManagePhotoGallary');
Route::get('/superAdminFromWebAdmin/{superadmin_id}/{type}','AdminController@superAdminFromWebAdmin');
#-------------- Principal Message ----------------------#
Route::get('/principalMessageList','WebAdminController@principalMessageList');
Route::get('/addNewPrincipalMessage','WebAdminController@addNewPrincipalMessage');
#----------------------- ADMIN ---------------------------#
Route::get('/admin','AdminController@index');
// super admin login
Route::post('superAdminLogin','AdminController@superAdminLogin');
Route::get('/superadminDashboard','AdminController@superadminDashboard');
Route::get('/superAdminLogout','AdminController@superAdminLogout');
Route::get('/adminList','UserController@adminList');
Route::get('/addAdminForm','UserController@addAdminForm');
Route::post('/addAdminInfo','UserController@addAdminInfo');
Route::get('/addAdminInfo','UserController@addAdminInfo');
Route::get('/editAdminForm/{id}','UserController@editAdminForm');
Route::post('/editAdminInfo','UserController@editAdminInfo');
Route::get('/deleteAdmin/{id}','UserController@deleteAdmin');
Route::post('/getAllStaffForAddLeave','UserController@getAllStaffForAddLeave');
Route::get('/adminDashboard','AdminController@adminDashboard');
Route::get('/adminLogout','AdminController@adminLogout');
Route::get('/addStaffRfidNumber/{id}','AdminController@addStaffRfidNumber');
Route::post('/addStaffRfidNoInfo','AdminController@addStaffRfidNoInfo');
#--------------------- start education info ----------------------#
// probidhan
Route::get('/probidhanList','EducationInfoController@probidhanList');
Route::get('/addNewProbidhanForm','EducationInfoController@addNewProbidhanForm');
Route::post('/addNewProbidhanInfo','EducationInfoController@addNewProbidhanInfo');
Route::get('/assionProbidhanList','EducationInfoController@assionProbidhanList');
Route::get('/addNewProbidhanAssionForm','EducationInfoController@addNewProbidhanAssionForm');
Route::post('/addAssignYearProbidhanInfo','EducationInfoController@addAssignYearProbidhanInfo');
Route::get('/depertemntList','EducationInfoController@depertemntList');
Route::get('/addDepartmentForm','EducationInfoController@addDepartmentForm');
Route::post('/addDepartmentInfo','EducationInfoController@addDepartmentInfo');
Route::get('/shiftList','EducationInfoController@shiftList');
Route::get('/addShiftForm','EducationInfoController@addShiftForm');
Route::post('/addShiftInfo','EducationInfoController@addShiftInfo');
Route::get('/semisterList','EducationInfoController@semisterList');
Route::get('/addSemisterForm','EducationInfoController@addSemisterForm');
Route::post('/addSemisterInfo','EducationInfoController@addSemisterInfo');
Route::get('/teacherList','TeacherController@teacherList');
Route::get('/addTeacherForm','TeacherController@addTeacherForm');
Route::post('/addTeacherInfo','TeacherController@addTeacherInfo');
Route::get('/craftInstructorList','TeacherController@craftInstructorList');
Route::get('/addCraftInstructorForm','TeacherController@addCraftInstructorForm');
Route::post('/addCraftInsInfo','TeacherController@addCraftInsInfo');
Route::get('/staffList','UserController@staffList');
Route::get('/addStaffForm','UserController@addStaffForm');
Route::post('/addStaffInfo','UserController@addStaffInfo');
Route::get('/departmetnHeadList','AdminController@departmetnHeadList');
Route::get('/addDepartmentHeadForm','AdminController@addDepartmentHeadForm');
Route::post('/getTeacher','AdminController@getTeacher');
Route::post('/addDepartmentHeadInfo','AdminController@addDepartmentHeadInfo');
Route::get('/departmentHeadDashboard','AdminController@departmentHeadDashboard');
Route::get('/departmentHeadLogout','AdminController@departmentHeadLogout');
Route::get('/subjectList','SubjectController@subjectList');
Route::get('/addSubjectForm','SubjectController@addSubjectForm');
Route::post('/addSubjectInfo','SubjectController@addSubjectInfo');
Route::get('/sessionList','EducationInfoController@sessionList');
Route::get('/addSessionForm','EducationInfoController@addSessionForm');
Route::post('/addSessionInfo','EducationInfoController@addSessionInfo');
Route::get('/sectionList','EducationInfoController@sectionList');
Route::get('/addSectionForm','EducationInfoController@addSectionForm');
Route::post('/addSectionInfo','EducationInfoController@addSectionInfo');
Route::post('/getSectionByDepartment','EducationInfoController@getSectionByDepartment');
Route::post('/getSectionByDepartmentForSuperadmin','EducationInfoController@getSectionByDepartmentForSuperadmin');
Route::get('/officeStartTime','EducationInfoController@officeStartTime');
Route::get('/editStartOfficeTime/{id}','EducationInfoController@editStartOfficeTime');
Route::post('/editOfficeTimeStart','EducationInfoController@editOfficeTimeStart');
Route::get('/superAdminTeacherList','TeacherController@superAdminTeacherList');
Route::get('/superAdminCraftInstructorList','TeacherController@superAdminCraftInstructorList');
Route::get('/superAdminOtherStaffList','TeacherController@superAdminOtherStaffList');
#----------------------------------START ROUTINE-----------------------------------#
Route::get('/routineList','Routine@routineList');
Route::get('/addRoutineForm','Routine@addRoutineForm');
Route::post('/getSubjectByDepAndSemister','Routine@getSubjectByDepAndSemister');
Route::post('/addRoutineInfo','Routine@addRoutineInfo');
Route::get('/semisterWiseRoutine','Routine@semisterWiseRoutine');
Route::post('/getSemisterWiseRoutine','Routine@getSemisterWiseRoutine');
Route::get('/changeRoutine/{id}','Routine@changeRoutine');
Route::post('/editRoutineInfo','Routine@editRoutineInfo');
#----------------------------------END ROUTINE-------------------------------------#
#----------------------------------START STUDENT-----------------------------------#
Route::get('/newStudentRegForm','StudentController@newStudentRegForm');
Route::post('/addNewStudentInfo','StudentController@addNewStudentInfo');
Route::get('/studentList','StudentController@studentList');
Route::post('/getStudentList','StudentController@getStudentList');
Route::get('/addStudentRfidNumber/{id}/{shift}/{semister}','StudentController@addStudentRfidNumber');
Route::post('/addStudentRfidNo','StudentController@addStudentRfidNo');
Route::get('/addStudentDoorLogNumber/{id}/{shift}/{semister}','StudentController@addStudentDoorLogNumber');
Route::post('/addStudentDoorLogNo','StudentController@addStudentDoorLogNo');
// student promossion
Route::get('/studentPromossion/','StudentController@studentPromossion');
Route::post('/promossionStudentList','StudentController@promossionStudentList');
Route::post('/autoPromossionInNewSemister','StudentController@autoPromossionInNewSemister');
Route::get('/studentPromossionList','StudentController@studentPromossionList');
Route::post('/studentPromissionList','StudentController@studentPromissionList');
// studetn session update
Route::get('/updateSessionStudentList','StudentController@updateSessionStudentList');
Route::post('/getStudentListToUpdateSession','StudentController@getStudentListToUpdateSession');
Route::post('/updateStudentSessionInfo','StudentController@updateStudentSessionInfo');
Route::get('/studentVerify','StudentController@studentVerify');
Route::post('/studentVerifyCheck','StudentController@studentVerifyCheck');
//student update
Route::get('/editStudentInfo/{id}','StudentController@editStudentInfo');
Route::post('/updateStudentInfo','StudentController@updateStudentInfo');
Route::get('/duplicateVerifyCheck/{roll}','StudentController@duplicateVerifyCheck');
Route::get('/deleteDuplicateValue/{studentID}/{student_table_id}/{roll}','StudentController@deleteDuplicateValue');

Route::get('/superAdminStudentList','StudentController@superAdminStudentList');
Route::post('/getStudentListForSuperAdmin','StudentController@getStudentListForSuperAdmin');
#----------------------------------END STUDENT-------------------------------------#
#---------------------------- STUDENT ATTENDENT -----------------------------------#
Route::post('/studentAttendent','StudentattendentController@studentAttendent');
Route::get('/teacherAttendent/{card_no}','StudentattendentController@teacherAttendent');
#------------------------- END STUDENT ATTENDENT ----------------------------------#
#------------------------- ID CARD CREATE------------------------------------------#
Route::get('/createIdCard','IdcardController@createIdCard');
Route::post('/getStudentIdCard','IdcardController@getStudentIdCard');
Route::get('/generateIdCard/{id}/{shift}/{semister}','IdcardController@generateIdCard');
// staff id card
Route::get('/staffIdCard/{id}','IdcardController@staffIdCard');
#------------------------- END ID CARD ------------------------------------------#
#------------------------- HOLIDAY ------------------------------------------#
Route::get('/createWeeklyHoliday','HolidayController@createWeeklyHoliday');
Route::get('/otherHolidayForm','HolidayController@otherHolidayForm');
Route::post('/createWeeklyHolidayInfo','HolidayController@createWeeklyHolidayInfo');
Route::post('/addOtherHolidayInfo','HolidayController@addOtherHolidayInfo');
Route::get('/showAllHoliday','HolidayController@showAllHoliday');
Route::get('/deleteHoliday/{id}','HolidayController@deleteHoliday');
#------------------------- END HOLIDAY---------------------------------------#
#---------------------------------- TEACHER----------------------------------#
Route::get('/teacherDashboard','AdminController@teacherDashboard');
Route::get('/teacherLogout','AdminController@teacherLogout');
Route::get('/editTeacherInfo/{id}','TeacherController@editTeacherInfo');
Route::post('/updateTeacherInfo','TeacherController@updateTeacherInfo');
#----------------------------- END TEACHER ----------------------------------#
#---------------------------------- CRAFT ----------------------------------#
Route::get('/craftDashboard','AdminController@craftDashboard');
Route::get('/craftLogout','AdminController@craftLogout');
Route::get('/editCraftInfo/{id}','TeacherController@editCraftInfo');
Route::post('/updateCraftInfo','TeacherController@updateCraftInfo');
#----------------------------- END CRAFT ----------------------------------#
#----------------------------- LEAVE MANAGEMRNT----------------------------#
Route::get('/requestLeave','LeaveController@requestLeave');
Route::post('/requestLeaveInfo','LeaveController@requestLeaveInfo');
Route::get('/leaveRequestList','LeaveController@leaveRequestList');
Route::get('/viewApplication/{id}','LeaveController@viewApplication');
Route::get('/deleteApplication/{id}','LeaveController@deleteApplication');
Route::get('/craftRequestLeave','LeaveController@craftRequestLeave');
Route::post('/craftRequestLeaveInfo','LeaveController@craftRequestLeaveInfo');
Route::get('/craftLeaveRequestList','LeaveController@craftLeaveRequestList');
Route::get('/viewCraftApplication/{id}','LeaveController@viewCraftApplication');
Route::get('/deleteCraftApplication/{id}','LeaveController@deleteCraftApplication');
Route::get('/pendingLeaveRequest','LeaveController@pendingLeaveRequest');
Route::get('/requestedApplicationView/{id}','LeaveController@requestedApplicationView');
Route::get('/approvedApplication/{id}','LeaveController@approvedApplication');
Route::get('/notApprovedApplication/{id}','LeaveController@notApprovedApplication');
Route::get('/approvedLeaveList','LeaveController@approvedLeaveList');
Route::get('/rejectApplicationList','LeaveController@rejectApplicationList');
Route::get('/addStaffLeave','LeaveController@addStaffLeave');
Route::post('/addStaffLeaveInfo','LeaveController@addStaffLeaveInfo');
Route::get('/manageStaffLeave','LeaveController@manageStaffLeave');
Route::get('/deleteStaffLeave/{id}','LeaveController@deleteStaffLeave');
#-----------------------------END LEAVE MANAGEMRNT----------------------------#
#----------------------------- STAFF TRANING----------------------------------#
Route::get('/addStaffTraining','LeaveController@addStaffTraining');
Route::post('/addStaffTraningInfo','LeaveController@addStaffTraningInfo');
Route::get('/manageStaffTraining','LeaveController@manageStaffTraining');
Route::get('/deleteStaffTraning/{id}','LeaveController@deleteStaffTraning');
#----------------------------- END STAFF TRANING------------------------------#
#----------------------------- MANUAL ATTENDENT-------------------------------#
Route::get('/manualStaffAttendent/{user_id}/{attendent_date}','AttendentController@manualStaffAttendent');
Route::post('/addStaffManualAttendentInfo/','AttendentController@addStaffManualAttendentInfo');
Route::get('/manualEditStaffAttendentTime/{user_id}/{attendent_date}','AttendentController@manualEditStaffAttendentTime');
Route::post('/editStaffManualEditAttendentTimeInfo','AttendentController@editStaffManualEditAttendentTimeInfo');
// studen manual attendent 

Route::post('/teacherAddManualyStudentClassAttendent','AttendentController@teacherAddManualyStudentClassAttendent');
// teacher manual attendent by dept head
Route::get('/manualTeacherAttendentByDeptHead','AttendentController@manualTeacherAttendentByDeptHead');
Route::post('/manualTeacherAttendentByDeptHeadInfo
','AttendentController@manualTeacherAttendentByDeptHeadInfo');
Route::post('/addManualTeacherAttendentClass
','AttendentController@addManualTeacherAttendentClass');
#---------------------------- END MANUAL ATTENDENT----------------------------#
#-------------------------    REPORT    --------------------------------------#
Route::get('/showTodayAttendent/{shift}','ReportController@showTodayAttendent');
Route::get('/reportTodayAttendent','ReportController@reportTodayAttendent');
Route::get('/reportMonthlyAttendentForm','ReportController@reportMonthlyAttendentForm');
Route::post('/reportTodayAttendentView','ReportController@reportTodayAttendentView');
Route::get('/deptHeadLiveMonitoring/{shift}','ReportController@deptHeadLiveMonitoring');
Route::get('/deptHeadPreviousLiveMonitoring/{shift}','ReportController@deptHeadPreviousLiveMonitoring');

Route::get('/superAdminPreviousLiveMonitoring/{shift}','ReportController@superAdminPreviousLiveMonitoring');
Route::post('/superAdminPreviousLiveMonitoringView','ReportController@superAdminPreviousLiveMonitoringView');
Route::post('/deptHeadPreviousLiveMonitoringView','ReportController@deptHeadPreviousLiveMonitoringView');

Route::get('/todayStudentAttedntReportByDeptHead','ReportController@todayStudentAttedntReportByDeptHead');
Route::post('/reportMonthlyAttendentView','ReportController@reportMonthlyAttendentView');
Route::get('/reportDatewiseAttendentForm','ReportController@reportDatewiseAttendentForm');
Route::post('/reportDatewiseAttendentView','ReportController@reportDatewiseAttendentView');
Route::get('/reportMonthlyClassWiseAttendentForm','ReportController@reportMonthlyClassWiseAttendentForm');
Route::post('/reportMonthlyClassWiseAttendentView','ReportController@reportMonthlyClassWiseAttendentView');
Route::get('/reportDatewiseClassWiseAttendentForm','ReportController@reportDatewiseClassWiseAttendentForm');
Route::post('/reportDatewiseClassWiseAttendentView','ReportController@reportDatewiseClassWiseAttendentView');
// view student attendent list
Route::get('/viewStudentAttendentList/{routine_id}/{rcdate}','ReportController@viewStudentAttendentList');
Route::get('/viewStudentAttendentListByDeptHead/{routine_id}/{rcdate}','ReportController@viewStudentAttendentListByDeptHead');
// teacher see his routine class
Route::get('/teacherTodayClass/{shift}','ReportController@teacherTodayClass');
Route::get('/viewStudentAttendentListByTeacher/{routine_id}/{rcdate}','ReportController@viewStudentAttendentListByTeacher');
#----------------------- start teacher attendent report ---------------------------------#
Route::get('/reportTeacherTodayAttendentForm','ReportController@reportTeacherTodayAttendentForm');
Route::get('/reportTeacherClassWiseTodayAttendent','ReportController@reportTeacherClassWiseTodayAttendent');
Route::get('/reportTeacherMonthlyAttendent','ReportController@reportTeacherMonthlyAttendent');
Route::post('/reportMonthlyTeacherAttendentView','ReportController@reportMonthlyTeacherAttendentView');
Route::get('/reportTeacherDatewiseAttendent','ReportController@reportTeacherDatewiseAttendent');
Route::get('/totalClassHeldSummary','ReportController@totalClassHeldSummary');
Route::post('/reportTotalClassHeldSummaryView','ReportController@reportTotalClassHeldSummaryView');
Route::get('/overAllSummaryReport','ReportController@overAllSummaryReport');
Route::post('/overAllSummaryReportView','ReportController@overAllSummaryReportView');
Route::get('/reportTeacherClassWisePreviousDateAttendent','ReportController@reportTeacherClassWisePreviousDateAttendent');
Route::post('/reportTeacherClassWisePreviousDateAttendentView','ReportController@reportTeacherClassWisePreviousDateAttendentView');

#---------------------- end start teacher attendent report ------------------------------#
#----------------------- staff door attendent report---------------------------------------#
Route::get('/reportStaffDoorAttendentForm','ReportController@reportStaffDoorAttendentForm');
Route::post('/reportStaffDoorAttendentView','ReportController@reportStaffDoorAttendentView');
Route::get('/reportStaffMonthlyDoorAttendentForm','ReportController@reportStaffMonthlyDoorAttendentForm');
Route::post('/reportMonthlyStaffDoorAttendentView','ReportController@reportMonthlyStaffDoorAttendentView');
#----------------------- end staff door attendent report------------------------------------#
#----------------------- student door attendent report--------------------------------------#
Route::get('/reportStudentDoorAttendentForm','ReportController@reportStudentDoorAttendentForm');
Route::post('/reportDailyStudentDoorReportView','ReportController@reportDailyStudentDoorReportView');
#---------------------- end student door attendent report-----------------------------------#
#------------------------ door report-------------------------------------------------------#
Route::get('/doorLogReport','ReportController@doorLogReport');
Route::post('/reportDoorLogView','ReportController@reportDoorLogView');
#----------------------- end door report----------------------------------------------------#
#---------------------- droop out-------------------------------------------------------#
Route::get('/studentDroopOut/{id}','DroopController@studentDroopOut');
Route::post('/studentDroopOutInfo','DroopController@studentDroopOutInfo');
#--------------------- end droop out----------------------------------------------------#
#--------------------- leave report-----------------------------------------------------#
Route::get('/staffLeaveReport','ReportController@staffLeaveReport');
Route::post('/staffLeaveReportView','ReportController@staffLeaveReportView');
#--------------------- end leave report-------------------------------------------------#
#--------------------- training report--------------------------------------------------#
Route::get('/staffTrainingReport','ReportController@staffTrainingReport');
Route::post('/staffTrainingReportView','ReportController@staffTrainingReportView');
#-------------------- end training report------------------------------------------------#
#-------------------- holiday report ----------------------------------------------------#
Route::get('/buySmsReport','ReportController@buySmsReport');
Route::post('/buySmsReportView','ReportController@buySmsReportView');
#-------------------- end holiday report ------------------------------------------------#
#--------------------- absent and present report----------------------------------------#
Route::get('/reportPeriodicClassWiseTopPresentList','ReportController@reportPeriodicClassWiseTopPresentList');
Route::post('/reportPeriodicClassWiseTopPresentListView','ReportController@reportPeriodicClassWiseTopPresentListView');
Route::get('/reportPeriodicClassWiseTopAbsentList','ReportController@reportPeriodicClassWiseTopAbsentList');
Route::post('/reportPeriodicClassWiseTopAbsentListView','ReportController@reportPeriodicClassWiseTopAbsentListView');
Route::get('/reportPeriodicClassWisePercentagePresentList','ReportController@reportPeriodicClassWisePercentagePresentList');
Route::post('/reportPeriodicClassWisePercentagePresentListView','ReportController@reportPeriodicClassWisePercentagePresentListView');
Route::get('/reportPeriodicClassWisePercentageAbsentList','ReportController@reportPeriodicClassWisePercentageAbsentList');
Route::post('/reportPeriodicClassWisePercentageAbsentListView','ReportController@reportPeriodicClassWisePercentageAbsentListView');
// perodic days present list
Route::get('/reportPeriodicStudentPresentList','ReportController@reportPeriodicStudentPresentList');
Route::post('/reportPeriodicStudentPresentListView','ReportController@reportPeriodicStudentPresentListView');
Route::get('/reportPeriodicStudentAbsentList','ReportController@reportPeriodicStudentAbsentList');
Route::post('/reportPeriodicStudentAbsentListView','ReportController@reportPeriodicStudentAbsentListView');
#-------------------- end absent and present report------------------------------------#
// holiday report
Route::get('/holidayReport','ReportController@holidayReport');
Route::post('/holidayReportView','ReportController@holidayReportView');
Route::get('/sentSmsReport','ReportController@sentSmsReport');
Route::post('/sentSmsReportView','ReportController@sentSmsReportView');
#------------------------- END REPORT -------------------------------------------------#
#----------------------------    PRINT    ---------------------------------------------#
// normal print
Route::post('/printDepHeadList','PrintController@printDepHeadList');
Route::post('/printTeacherListBySuperadmin','PrintController@printTeacherListBySuperadmin');
Route::post('/printCraftInstructorListBySuperadmin','PrintController@printCraftInstructorListBySuperadmin');
Route::post('/printOtherStaffListBySuperadmin','PrintController@printOtherStaffListBySuperadmin');
Route::post('/printHolidayReport','PrintController@printHolidayReport');




// end normal print
Route::post('/printStudentList','PrintController@printStudentList');
Route::post('/printSemisterRoutine','PrintController@printSemisterRoutine');
Route::get('/printIdCard/{id}/{shift}/{semister}','PrintController@printIdCard');
Route::get('/printTeacherIdCard/{id}','PrintController@printTeacherIdCard');
Route::post('/printStaffNormalAttendentViewReport','PrintController@printStaffNormalAttendentViewReport');
Route::post('/printStaffDgAttendentViewReport','PrintController@printStaffDgAttendentViewReport');
Route::post('/printReportMontlyStaffDoorAttendentView','PrintController@printReportMontlyStaffDoorAttendentView');
Route::post('/printTotalClassHeldSummaryReportReport','PrintController@printTotalClassHeldSummaryReportReport');
Route::post('/printOverAllSummaryReport','PrintController@printOverAllSummaryReport');
Route::post('/printReportTeacherClassWiseTodayAttendent','PrintController@printReportTeacherClassWiseTodayAttendent');
Route::post('/printReportTeacherMonthlyAttendent','PrintController@printReportTeacherMonthlyAttendent');
Route::post('/printDatewiseClasswiseAttendentReport','PrintController@printDatewiseClasswiseAttendentReport');

#---------------------- Print Student Attedndent Report ------------------------#
Route::post('/printTodayAttendentReport','PrintController@printTodayAttendentReport');
Route::post('/printMonthlyAttendentReport','PrintController@printMonthlyAttendentReport');
Route::post('/printDateWiseAttendentReport','PrintController@printDateWiseAttendentReport');
Route::post('/printMonthlyClassWiseAttendentReport','PrintController@printMonthlyClassWiseAttendentReport');
Route::get('/printTeacherTodayAttendentReport','PrintController@printTeacherTodayAttendentReport');
Route::post('/printDailyDoorLog','PrintController@printDailyDoorLog');
Route::post('/printStaffLeaveReport','PrintController@printStaffLeaveReport');
Route::post('/printStaffTrainingReport','PrintController@printStaffTrainingReport');

#------------------------ result print---------------------------------------------#
Route::get('/printSemesteResultMarksheet/{probidhan_id}/{year}/{shift}/{dept}/{semister}/{section}/{roll}/{merit_status}/{pass_fail_status}','PrintController@printSemesteResultMarksheet');
#-------------------------     END PRINT  --------------------------------------#
#------------------------- print studetn door report-----------------------------#
Route::post('/printDailyStudentDoorReport','PrintController@printDailyStudentDoorReport');
#------------------------- end print student door report---------------------------#

#------------------------- csv format ---------------------------------------------#
Route::get('/csvTeacherTodayAttendentReport','CsvController@csvTeacherTodayAttendentReport');
Route::post('/csvReportTeacherClassWiseTodayAttendent','CsvController@csvReportTeacherClassWiseTodayAttendent');
Route::post('/csvReportTeacherMonthlyAttendent','CsvController@csvReportTeacherMonthlyAttendent');
Route::post('/csvStaffNormalAttendentViewReport','CsvController@csvStaffNormalAttendentViewReport');
Route::post('/csvStaffDgAttendentViewReport','CsvController@csvStaffDgAttendentViewReport');
Route::post('/csvReportMontlyStaffDoorAttendentView','CsvController@csvReportMontlyStaffDoorAttendentView');
Route::post('/csvMonthlyAttendentReport','CsvController@csvMonthlyAttendentReport');
Route::post('/csvDateWiseAttendentReport','CsvController@csvDateWiseAttendentReport');
Route::post('/csvMonthlyClassWiseAttendentReport','CsvController@csvMonthlyClassWiseAttendentReport');
Route::post('/csvDatewiseClasswiseAttendentReport','CsvController@csvDatewiseClasswiseAttendentReport');
Route::post('/csvDailyStudentDoorReport','CsvController@csvDailyStudentDoorReport');
#------------------------ end csv format -------------------------------------------#
#----------------------------    SETTING    --------------------------------------#
Route::get('/setting/','SettingController@setting');
Route::post('/editSettingInfo/','SettingController@editSettingInfo');
Route::get('/machineNumber/','SettingController@machineNumber');
Route::post('/addMachineInfo/','SettingController@addMachineInfo');

Route::get('/superAdminManualStudentAttendentPermission/','SettingController@superAdminManualStudentAttendentPermission');

Route::post('/addStudentAttendentPermissionInfo/','SettingController@addStudentAttendentPermissionInfo');

#----------------------------    END SETTING    --------------------------------------#
Route::get('/studentLogin','StudentController@studentLogin');
Route::post('/studentLoginProcess','StudentController@studentLoginProcess');
#--------------------------- DATABASE BACKUP---------------------------------------#
Route::get('/databaseBackup/','SettingController@databaseBackup');

#-------------------------- SMS----------------------------------------------#
Route::get('/sendSms','SmsController@sendSms');
Route::post('/sendingSms','SmsController@sendingSms');
Route::get('/staffSmsSent','SmsController@staffSmsSent');
Route::post('/sendingStaffSms','SmsController@sendingStaffSms');
#----------------------------REGISTRATION--------------------------------------#

#-------------------- WEB SECTION CONTROLLER --------------------#
Route::get('/addWebSection','WebSectionController@addWebSection');
Route::post('/webSectionInfo','WebSectionController@webSectionInfo');
Route::get('/manageWebSection','WebSectionController@manageWebSection');

Route::get('/addWebSectionSubMenu','WebSectionController@addWebSectionSubMenu');
Route::post('/webSectionSubmenuInfo','WebSectionController@webSectionSubmenuInfo');
Route::get('/addWebSectionPageInfo','WebSectionController@addWebSectionPageInfo');
Route::post('/getWebSectionSubmenu','WebSectionController@getWebSectionSubmenu');
Route::post('/webSectionPageInfo','WebSectionController@webSectionPageInfo');
Route::get('manageWebSectionPageInfo','WebSectionController@manageWebSectionPageInfo');

Route::get('/reg','RegistrationController@reg');
Route::post('/regInfo','RegistrationController@regInfo');
Route::get('/checkReg','RegistrationController@checkReg');
Route::post('/studentVerifyCheckByStudent','RegistrationController@studentVerifyCheckByStudent');
Route::get('/studentRegList','RegistrationController@studentRegList');
#----------------------------- RESULT-------------------------------------#
Route::get('/teacherSearchToAddResult','ResultController@teacherSearchToAddResult');
Route::post('/getTeacherRoutineWiseSubjectToAddMarks','ResultController@getTeacherRoutineWiseSubjectToAddMarks');
Route::get('/teacherAddMarks/{probidhan_id}/{year}/{shift}/{dept}/{semister}/{section}/{subject_id}/{marks_type}/{total_marks}','ResultController@teacherAddMarks');
Route::post('/addTeacherMarkInfoInsert','ResultController@addTeacherMarkInfoInsert');
#---------------------------- END RESULT----------------------------------#
#--------------------------- RESULT LIST REPORT---------------------------#
Route::get('/deptHeadResultList','ResultReportController@deptHeadResultList');
Route::post('/deptHeadResultListView','ResultReportController@deptHeadResultListView');
#-------------------------- END RESULT LIST REPORT-------------------------#
#-----------------------------print-----------------------------------#
Route::post('/printStudentListforSuperAdmin','PrintController@printStudentListforSuperAdmin');
Route::post('/printPeriodicClassWisePercentagePresentList','PrintController@printPeriodicClassWisePercentagePresentList');
Route::post('/printPeriodicClassWisePercentageAbsentList','PrintController@printPeriodicClassWisePercentageAbsentList');
Route::post('/printPeriodicClassWiseTopPresentList','PrintController@printPeriodicClassWiseTopPresentList');
Route::post('/printPeriodicClassWiseTopAbsentList','PrintController@printPeriodicClassWiseTopAbsentList');
Route::post('/printPeriodicStudentPresentList','PrintController@printPeriodicStudentPresentList');
Route::post('/printPeriodicStudentAbsentList','PrintController@printPeriodicStudentAbsentList');

#-----------------------------print-----------------------------------#
#-----------------------------csv-------------------------------------#
Route::post('/csvStudentListforSuperAdmin','CsvController@csvStudentListforSuperAdmin');
Route::post('/csvPeriodicClassWisePercentagePresentList','CsvController@csvPeriodicClassWisePercentagePresentList');
Route::post('/csvPeriodicClassWisePercentageAbsentList','CsvController@csvPeriodicClassWisePercentageAbsentList');
Route::post('/csvPeriodicClassWiseTopPresentList','CsvController@csvPeriodicClassWiseTopPresentList');
Route::post('/csvPeriodicClassWiseTopAbsentList','CsvController@csvPeriodicClassWiseTopAbsentList');
Route::post('/csvPeriodicStudentPresentList','CsvController@csvPeriodicStudentPresentList');
Route::post('/csvPeriodicStudentAbsentList','CsvController@csvPeriodicStudentAbsentList');
#-----------------------------csv-------------------------------------#

#---------------------------- change password-------------------------#
Route::get('/superAdminChangePassword','SettingController@superAdminChangePassword');
Route::post('/changeSuperAdminPassword','SettingController@changeSuperAdminPassword');
Route::get('/forgottenPasswordForm','SettingController@forgottenPasswordForm');
Route::post('/forgottenPasswordMobileVerify','SettingController@forgottenPasswordMobileVerify');
Route::get('/recoverPassword/{id}/{random_session_value}/{type}','SettingController@recoverPassword');
Route::post('/finalRecoveryAccount/','SettingController@finalRecoveryAccount');
#---------------------------- end change password---------------------#























      





















































