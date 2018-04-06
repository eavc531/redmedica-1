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


route::get('/', function () {
    return redirect()->route('home');
});


Route::get('loginRedirect', 'Auth\LoginController@loginRedirect')->name('loginRedirect');

route::get('home','HomeController@home')->name('home');
route::resource('user','userController');
route::resource('medico','medicoController');
route::get('medico/{id}/perfil','medicoController@medico_perfil')->name('medico_perfil');

route::resource('medico_diary','medico_diaryController');

route::get('medico/{id}/diary/events','medico_diaryController@medico_diary_events')->name('medico_diary_events');
route::get('medico/{id}/business/hours','medico_diaryController@medico_business_hours')->name('medico_business_hours');

route::post('medico/business/hours/edit','medico_diaryController@medico_business_hours_update')->name('medico_business_hours_update');

Route::get('medico/{id}/panel/diary', 'medico_diaryController@medico_diary')->name('medico_diary');
Route::get('medico/{id}/panel/schedule', 'medico_diaryController@medico_schedule')->name('medico_schedule');

route::post('medico/schedule/store','medico_diaryController@medico_schedule_store')->name('medico_schedule_store');

Route::get('medico/{id}/diary/fullscreen', 'medico_diaryController@medico_diary_fullscreen')->name('medico_diary_fullscreen');

route::post('medico/list/social_network','medicoController@social_network_list')->name('social_network_list');
route::post('medico/list/services','medicoController@medico_service_list')->name('medico_service_list');
route::post('medico/list/experience','medicoController@medico_experience_list')->name('medico_experience_list');

route::post('medicoBorrar','medicoController@medicoBorrar')->name('medicoBorrar');
route::post('medico/experience/delete','medicoController@medico_experience_delete')->name('medico_experience_delete');
route::post('medico/service/store','medicoController@service_medico_store')->name('service_medico_store');
route::post('medic/experience/store','medicoController@medico_experience_store')->name('medico_experience_store');
route::post('medic/social_network/store','medicoController@medico_social_network_store')->name('medico_social_network_store');
route::post('borrar_social','medicoController@borrar_social')->name('borrar_social');

route::get('data/primordial/{id}/medico','medicoController@data_primordial_medico')->name('data_primordial_medico');

route::get('medic/{id}/consulting_room/create','consulting_roomController@consulting_room_create')->name('consulting_room_create');

route::resource('patient','patientController');
route::resource('medicalCenter','medicalCenterController');
route::get('data/primordial/{id}/medical_center','medicalCenterController@data_primordial_medical_center')->name('data_primordial_medical_center');

route::resource('photo','photoController');
route::get('medico/photo/delete/{id}','photoController@photo_delete')->name('photo_delete');
route::post('image/medico/store','photoController@image_store')->name('image_store');

route::resource('consulting_room','consulting_roomController');

route::get('medico/{id}/info/create','medicoController@medico_specialty_create')->name('medico_specialty_create');
route::post('medico/specialty/store','medicoController@medico_specialty_store')->name('medico_specialty_store');

route::get('confirm/MedicalCenter/{id}/{code}','medicalCenterController@confirmMedicalCenter')->name('confirmMedicalCenter');
route::get('confirm/medico/{id}/{code}','medicoController@confirmMedico')->name('confirmMedico');

route::get('confirm/medico/{id}','medicoController@successRegMedico')->name('successRegMedico');
route::get('confirm/assistant/{id}','assistantController@successRegAssistant')->name('successRegAssistant');

route::get('confirm/MedicalCenter/{id}','medicalCenterController@successRegMedicalCenter')->name('successRegMedicalCenter');

route::post('resend/mail/confirmation','medicoController@resendMailMedicoConfirm')->name('resendMailMedicoConfirm');

route::get('list/result/','HomeController@tolist')->name('tolist');
/////////////////////////////////////////////////////////////////////////////////borar
route::post('list/result2','HomeController@tolist2')->name('tolist2');
/////////////////////////////////////////////////////////////////////////////////borrar

route::post('login2','Auth\LoginController@login2')->name('login2');

route::post('logout','Auth\LoginController@logout')->name('logout');

route::get('medical/centers/list','medicalCenterController@MedicalCenterList')->name('MedicalCenterList');
route::get('medicos/list','medicoController@medicosList')->name('medicosList');


route::get('category/{id}/specialty/delete','specialty_categoryController@specialtyC_delete')->name('specialtyC_delete');

route::resource('specialty','specialtyController');
route::resource('sub_specialty','sub_specialtyController');

route::resource('assistant','assistantController');
route::resource('administrators','administratorsController');
route::resource('plans','plansController');
route::resource('promoters','promotersController');
route::resource('specialty_category','specialty_categoryController');

route::get('cities/{id}/plan','plansController@citiesPlans')->name('citiesPlans');
route::post('cities/plan/store','plansController@citiesPlansStore')->name('citiesPlansStore');
route::get('cities/{id}/administrator','administratorsController@citiesAdmin')->name('citiesAdmin');
route::post('cities/administrator/store','administratorsController@citiesAdminStore')->name('citiesAdminStore');

route::get('delete/city/{id}/administrator','administratorsController@deleteCityAdmin')->name('deleteCityAdmin');
route::get('delete/city/{id}/plan','plansController@deleteCityPlan')->name('deleteCityPlan');


route::get('confirm/assistant/{id}/{code}','assistantController@confirmAssistant')->name('confirmAssistant');

route::get('confirm/assistant/{id}/{code}','assistantController@confirmAssistant')->name('confirmAssistant');
route::get('register/assistant/{id}/step4','assistantController@AvisoConfirmAccountAssistant')->name('AvisoConfirmAccountAssistant');

route::resource('permissionSet','permissionSetController');
route::get('permission/admin/{id}','permissionSetController@listPermissionSet')->name('listPermissionSet');
route::get('permission/{id}/set/admin/','permissionSetController@PermissionSet')->name('PermissionSet');

route::get('permissions/{id}/store/{id2}/','PermissionSetController@PermissionSetStore')->name('PermissionSetStore');


route::get('clients/promoter/{id}','promotersController@clientsPromoter')->name('clientsPromoter');
//sroute::get('edit/price/{id}/plan','plansController@PermissionSet')->name('editPrice');
