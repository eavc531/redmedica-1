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
route::get('/', function(){
    return redirect()->route('home');
});

Route::get('loginRedirect', 'Auth\LoginController@loginRedirect')->name('loginRedirect');

Route::post('verify/Session', 'Auth\LoginController@verifySession')->name('verifySession');
route::get('home','HomeController@home')->name('home');
route::post('login2','Auth\LoginController@login2')->name('login2');
route::get('list/result2','HomeController@tolist2')->name('tolist2');

route::get('list/result3','HomeController@tolist3')->name('tolist3');
route::post('ajax/map','HomeController@ajax_map')->name('ajax_map');

route::post('list/specialtyList1','HomeController@specialtyList1')->name('specialtyList1');
route::post('list/specialtyList2','HomeController@specialtyList2')->name('specialtyList2');
route::post('list/specialtyList3','HomeController@specialtyList3')->name('specialtyList3');
route::post('list/specialtyList4','HomeController@specialtyList4')->name('specialtyList4');
route::post('logout','Auth\LoginController@logout')->name('logout');

route::get('medicalCenter/{id}/search/medico','medicalCenterController@search_medico_medical_center')->name('search_medico_medical_center');

route::get('medicalCenter/{id}/search/medico/belongs','medicalCenterController@search_medico_belong_medical_center')->name('search_medico_belong_medical_center');
////midleware//
// Route::group(['middleware' => ['medicalCenterConfirm']], function () {

route::post('patient/photo_profile/store','photoController@patient_image_profile')->name('patient_image_profile');

Route::get('patient/add/medic/{id}','patientController@patient_add_medic')->name('patient_add_medic');
route::get('patient/{id}/edit','patientController@patient_edit_data')->name('patient_edit_data');
route::post('patient/{id}/updates','patientController@patient_update')->name('patient_update');

Route::get('patient/{id}resend/mail/confirm','patientController@resend_mail_confirm_patient')->name('resend_mail_confirm_patient');



Route::get('medico/{m_id}/calification','medicoController@calification_medic')->name('calification_medic');

Route::post('verify_change_date','medico_diaryController@verify_change_date')->name('verify_change_date');


Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/edit','medicoController@medico_note_edit')->name('medico_note_edit');

Route::get('medico/{m_id}/patient/{p_id}/appointment/{app_id}/details','medico_diaryController@medico_app_details')->name('medico_app_details');

Route::post('medico/patient/appointment/{app_id}/cancel','medico_diaryController@appointment_cancel')->name('appointment_cancel');

Route::get('medico/appointment/{id}/confirm','medico_diaryController@appointment_confirm')->name('appointment_confirm');
Route::post('medico/appointment/confirm','medico_diaryController@appointment_confirm_ajax')->name('appointment_confirm_ajax');
Route::post('medico/event/personal','medico_diaryController@event_personal_store')->name('event_personal_store');
// Route::get('medico/{m_id}/patient/{p_id}/note/{app_id}/config','notesController@note_replace_config')->name('note_replace_config');

route::post('medico/patient/note/config/store','notesController@note_config_store')->name('note_config_store');

route::get('medico/{m_id}/patient/{p_id}/edit/appointment/{app_id}','medico_diaryController@edit_appointment')->name('edit_appointment');
route::post('medico/patient/cancel/appointment/','medico_diaryController@cancel_appointment')->name('cancel_appointment');

///////////////NOTES
route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/view_preview','notesController@view_preview')->name('view_preview');
route::get('medico/{m_id}/patient/{p_id}/type_notes','notesController@type_notes')->name('type_notes');

route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/config','notesController@note_config')->name('note_config');
route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/ini_create','notesController@note_medic_ini_create')->name('note_medic_ini_create');
route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/ini_edit','notesController@note_ini_edit')->name('note_ini_edit');
route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/evo_edit','notesController@note_evo_edit')->name('note_evo_edit');
route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/inter_edit','notesController@note_inter_edit')->name('note_inter_edit');
route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/urgencias_edit','notesController@note_urgencias_edit')->name('note_urgencias_edit');
route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/egreso_edit','notesController@note_egreso_edit')->name('note_egreso_edit');
route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/referencia_edit','notesController@note_referencia_edit')->name('note_referencia_edit');

route::get('medico/{m_id}/patient/{p_id}/notes/','notesController@notes_patient')->name('notes_patient');
route::post('medico/patient/note/store','notesController@note_store')->name('note_store');
route::post('medico/patient/note/update/{id}','notesController@note_update')->name('note_update');

route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/referencia/create','notesController@note_referencia_create')->name('note_referencia_create');
route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/interconsulta_create','notesController@note_inter_create')->name('note_inter_create');
route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/urg_create','notesController@note_urgencias_create')->name('note_urgencias_create');
route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/egreso_create','notesController@note_egreso_create')->name('note_egreso_create');
route::get('medico/{m_id}/patient/{p_id}/note/{n_id}/evo_create','notesController@note_evo_create')->name('note_evo_create');

/////////////////
Route::get('medico/{m_id}/patient/{p_id}/note/{n_id}','medicoController@create_note_patient')->name('create_note_patient');

Route::get('medico/{m_id}/admin/data/{p_id}/patient','medicoController@admin_data_patient')->name('admin_data_patient');
// Route::get('medico/{m_id}/admin/data/{p_id}/patient','patientController@admin_data_patient')->name('admin_data_patient');
Route::resource('city','cityController');
route::resource('user','userController');
route::resource('medico','medicoController');
route::get('medico/{id}/perfil','medicoController@medico_perfil')->name('medico_perfil');
route::resource('medico_diary','medico_diaryController');
route::post('compare/hours/{id}','medico_diaryController@compare_hours')->name('compare_hours');

route::get('check/{id}/notification','medicoController@marcar_como_vista')->name('marcar_como_vista');
route::get('Medico/{m_id}/patient/{p_id}/appointment/{app_id}/marcar_como_vista','medicoController@marcar_como_vista_redirect')->name('marcar_como_vista_redirect');
route::get('medico/{id}/diary/events','medico_diaryController@medico_diary_events')->name('medico_diary_events');
route::post('medico/{id}/diary/events2','medico_diaryController@medico_diary_events2')->name('medico_diary_events2');

route::get('medico/{id}/business/hours','medico_diaryController@medico_business_hours')->name('medico_business_hours');

route::post('medico/business/hours/edit','medico_diaryController@medico_business_hours_update')->name('medico_business_hours_update');
route::post('delete/event','medico_diaryController@delete_event')->name('delete_event');
route::get('delete/{id}/event2','medico_diaryController@delete_event2')->name('delete_event2');
Route::post('medico/update/event', 'medico_diaryController@update_event')->name('update_event');
Route::get('medico/{id}/panel/diary', 'medico_diaryController@medico_diary')->name('medico_diary');
Route::get('medico/{id}/panel/schedule', 'medico_diaryController@medico_schedule')->name('medico_schedule');

route::post('medico/{id}/schedule/store','medico_diaryController@medico_schedule_store')->name('medico_schedule_store');

Route::get('medico/{id}/diary/fullscreen', 'medico_diaryController@medico_diary_fullscreen')->name('medico_diary_fullscreen');

route::post('medico/list/social_network','medicoController@social_network_list')->name('social_network_list');
route::post('medicalCenter/list/social_network','medicalCenterController@medicalCenter_social_list')->name('medicalCenter_social_list');
route::post('medico/list/services','medicoController@medico_service_list')->name('medico_service_list');
route::post('medico/list/experience','medicoController@medico_experience_list')->name('medico_experience_list');

route::post('medicoBorrar','medicoController@medicoBorrar')->name('medicoBorrar');
route::post('medico/experience/delete','medicoController@medico_experience_delete')->name('medico_experience_delete');
route::post('medico/service/store','medicoController@service_medico_store')->name('service_medico_store');
route::post('medic/experience/store','medicoController@medico_experience_store')->name('medico_experience_store');
route::post('medic/social_network/store','medicoController@medico_social_network_store')->name('medico_social_network_store');

Route::get('medico/{id}/notification/appointments', 'medicoController@notification_appointments')->name('notification_appointments');

route::post('medicalCenter/social/store','medicalCenterController@medicalCenter_social_store')->name('medicalCenter_social_store');
route::post('borrar_social','medicoController@borrar_social')->name('borrar_social');


route::get('medico/{id}/data/primordial/','medicoController@data_primordial_medico')->name('data_primordial_medico');

route::get('medic/{id}/consulting_room/create','consulting_roomController@consulting_room_create')->name('consulting_room_create');

route::resource('patient','patientController');
route::get('medico/{m_id}/stipulate/appointment/patient/{p_id}','medico_diaryController@medico_stipulate_appointment')->name('medico_stipulate_appointment');

route::get('stipulate/{id}/appointment','medico_diaryController@stipulate_appointment')->name('stipulate_appointment');

Route::get('patient/{id}/profile','patientController@patient_profile')->name('patient_profile');
route::post('patient/appoitment/rate/store','patientController@store_rate_comentary')->name('store_rate_comentary');
route::get('patient/{id}/medicos','patientController@patient_medicos')->name('patient_medicos');
route::get('patient/{id}/appoitment/rate','patientController@rate_appointment')->name('rate_appointment');

route::get('patient/{id}/appoitment','patientController@patient_appointments')->name('patient_appointments');
route::get('patient/{id}/appoitment/pending','patientController@patient_appointments_pending')->name('patient_appointments_pending');
route::get('patient/{id}/appoitment/unrated','patientController@patient_appointments_unrated')->name('patient_appointments_unrated');

route::post('appoitment/store','medico_diaryController@appointment_store')->name('appointment_store');
route::get('patients/register','patientController@patient_register_view')->name('patient_register_view');
route::post('patient/register/store','patientController@patient_register')->name('patient_register');
route::get('confirm/patient/{id}/{code}','patientController@confirmPatient')->name('confirmPatient');
route::resource('medicalCenter','medicalCenterController');

route::post('medicalCenter/select/insurrances','medicalCenterController@select_insurrances')->name('select_insurrances');
route::post('medicalCenter/select/insurrances/medico','medicoController@select_insurrances2')->name('select_insurrances2');

route::get('confirm/patient/{id}','patientController@successRegPatient')->name('successRegPatient');

route::get('patient/{id}/edit/address','patientController@address_patient')->name('address_patient');

route::post('patient/{id}/store/address','patientController@patient_store_address')->name('patient_store_address');

route::get('patient/delete/{id}/medico','patientController@delete_patient_doctors')->name('delete_patient_doctors');

//
route::get('medico/{id}/patients','medicoController@medico_patients')->name('medico_patients');

route::get('medico/{m_id}/patient/{p_id}/appointments','medicoController@medico_appointments_patient')->name('medico_appointments_patient');

route::get('medico/delete/{id}/patient','patientController@delete_medico_patients')->name('delete_medico_patients');
//
route::post('medicalCenter/{id}/store/experience','medicalCenterController@medical_center_experience_store')->name('medical_center_experience_store');
route::post('medicalCenter/{id}/store/specialty','medicalCenterController@medical_center_specialty_store')->name('medical_center_specialty_store');
route::post('medicalCenter/{id}/list/specialty','medicalCenterController@medicalCenter_list_specialty')->name('medicalCenter_list_specialty');
route::post('medicalCenter/{id}/list/experience','medicalCenterController@medicalCenter_list_experience')->name('medicalCenter_list_experience');

route::post('medicalCenter/specialty/delete','medicalCenterController@medical_specialty_delete')->name('medical_specialty_delete');
route::post('medicalCenter/experience/delete','medicalCenterController@medical_experience_delete')->name('medical_experience_delete');

route::get('medicalCenter/{id}/create/add/insurrances','medicalCenterController@create_add_insurrances')->name('create_add_insurrances');
route::post('medicalCenter/{id}/store/insurrances','medicalCenterController@medicalCenter_store_insurrances')->name('medicalCenter_store_insurrances');

route::post('medico/{id}/store/insurrances','medicoController@medico_store_insurrances')->name('medico_store_insurrances');
route::get('medico/{id}/create/add/insurrances','medicoController@medico_create_add_insurrances')->name('medico_create_add_insurrances');

route::get('medicalCenter/insurance/{id}/delete','medicalCenterController@delete_insurance')->name('delete_insurance');


route::get('medicalCenter/{id}/data/primordial/','medicalCenterController@data_primordial_medical_center')->name('data_primordial_medical_center');
route::get('data/primordial/{id}/medical_center/address','medicalCenterController@data_primordial_medical_center2')->name('data_primordial_medical_center2');

route::get('medical_center/{id}/panel','medicalCenterController@medical_center_panel')->name('medical_center_panel');

route::resource('photo','photoController');

route::get('medico/{id}/map/show','HomeController@detail_medic_map')->name('detail_medic_map');

route::get('medicalCenter/image/delete/{id}','photoController@photo_medical_delete')->name('photo_medical_delete');
route::get('medico/photo/delete/{id}','photoController@photo_delete')->name('photo_delete');

route::post('image/medico/store','photoController@image_store')->name('image_store');
route::post('image/medical_center/store','photoController@image_store_medical_center')->name('image_store_medical_center');

route::resource('consulting_room','consulting_roomController');

route::get('medico/{id}/info/create','medicoController@medico_specialty_create')->name('medico_specialty_create');
route::post('medico/specialty/store','medicoController@medico_specialty_store')->name('medico_specialty_store');

route::post('inner/cities/select','medicoController@inner_cities_select')->name('inner_cities_select');
route::post('inner/cities/select2','medicoController@inner_cities_select2')->name('inner_cities_select2');
route::post('inner/cities/select3','medicoController@inner_cities_select3')->name('inner_cities_select3');

route::get('confirm/MedicalCenter/{id}/{code}','medicalCenterController@confirmMedicalCenter')->name('confirmMedicalCenter');



route::get('confirm/MedicalCenter/{id}/{code}','medicalCenterController@confirmMedicalCenter')->name('confirmMedicalCenter');
route::get('confirm/medico/{id}/{code}','medicoController@confirmMedico')->name('confirmMedico');

route::get('confirm/medico/{id}','medicoController@successRegMedico')->name('successRegMedico');
route::get('confirm/assistant/{id}','assistantController@successRegAssistant')->name('successRegAssistant');


route::get('confirm/MedicalCenter/{id}','medicalCenterController@successRegMedicalCenter')->name('successRegMedicalCenter');

route::post('medicalCenter/{id}/description','medicalCenterController@medicalCenter_description_show')->name('medicalCenter_description_show');

route::post('medicalCenter/{id}/description','medicalCenterController@medicalCenter_description_show')->name('medicalCenter_description_show');
route::post('medicalCenter/{id}/description/update','medicalCenterController@medicalCenter_description_update')->name('medicalCenter_description_update');

route::get('medicalCenter/{id}/manage/medicos','medicalCenterController@medical_center_manage_medicos')->name('medical_center_manage_medicos');


route::get('medicalCenter/{id}/edit/data','medicalCenterController@medical_center_edit_data')->name('medical_center_edit_data');
route::post('medicalCenter/{id}/edit/data/update','medicalCenterController@medical_center_edit_data_update')->name('medical_center_edit_data_update');
route::post('medicalCenter/add/medico','medicalCenterController@medical_center_add_medico')->name('medical_center_add_medico');

route::get('medicalCenter/{id}/edit/address','medicalCenterController@medical_center_edit_address')->name('medical_center_edit_address');

route::get('medico/{id}/edit/address','medicoController@medico_edit_address')->name('medico_edit_address');

route::post('medicalCenter/{id}/update/address','medicalCenterController@medical_center_update_address')->name('medical_center_update_address');
route::post('medico/{id}/update/address','medicoController@medico_update_address')->name('medico_update_address');

route::get('medicalCenter/{id}/edit/schedule','medicalCenterController@medical_center_edit_schedule')->name('medical_center_edit_schedule');

route::post('medicalCenter/{id}/store/schedule','medicalCenterController@medical_center_store_schedule')->name('medical_center_store_schedule');


route::get('medico/{id}/delete/schedule','medico_diaryController@medico_schedule_delete')->name('medico_schedule_delete');
route::get('medicalCenter/{id}/delete/schedule','medicalCenterController@medical_center_schedule_delete')->name('medical_center_schedule_delete');

route::get('send_mail/medicalCenter/{id}/code_confirmded','medicalCenterController@resend_mail_medical_center')->name('resend_mail_medical_center');
route::get('medicalCenter/{id}/profile','medicalCenterController@medicalCenter_profile')->name('medicalCenter_profile');

route::get('medico/{id}/resend/mail/confirmation','medicoController@resendMailMedicoConfirm')->name('resendMailMedicoConfirm');

route::get('list/result/','HomeController@tolist')->name('tolist');
/////////////////////////////////////////////////////////////////////////////////borar

/////////////////////////////////////////////////////////////////////////////////borrar
route::post('map/medicalCenter','HomeController@map_medical_center_name')->name('map_medical_center_name');



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


route::get('promoters/{id}/add/medic/invited','promotersController@add_medic')->name('add_medic');

route::post('promoters/store/medic','promotersController@store_medic')->name('store_medic');

route::get('promoters/{id}/add/medical_center/invited','promotersController@add_medical_center')->name('add_medical_center');

route::get('promoter/{id}/list_medical_center_invited','promotersController@list_medical_center_invited')->name('list_medical_center_invited');

route::get('promoter/{id}/list_client','promotersController@list_client')->name('list_client');
route::post('promoter/{id}/list_client_activated','promotersController@list_client_activated')->name('list_client_activated');

route::post('promoter/{id}/list_client_desactivated','promotersController@list_client_desactivated')->name('list_client_desactivated');

route::get('promoter/{id}/panel_control','promotersController@panel_control_promoters')->name('panel_control_promoters');

route::post('promoters/store/medical_center','promotersController@store_medical_center')->name('store_medical_center');

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
route::post('medicalCenter/{id}/coordinates/store','medicalCenterController@medicalCenter_store_coordinates')->name('medicalCenter_store_coordinates');
route::post('medico/{id}/coordinates/store','medicoController@medico_store_coordinates')->name('medico_store_coordinates');

route::get('patient/{p_id}/medico/{m_id}/
rate','patientController@patient_rate_medic')->name('patient_rate_medic');
