<?php

namespace App\Http\Controllers;
use App\patients_doctor;
use App\event;
use App\patient;
use App\medico;
use App\country;
use App\city;
use App\state;
use App\promoter;
use App\User;
use App\medicalCenter;
use App\specialty;
use App\specialty_category;
use App\photo;
use App\consulting_room;
use App\medico_specialty;
use Mail;
use App\medico_service;
use App\medico_experience;
use App\social_network;
use App\Role;
use App\insurance_carrier;
use Geocoder;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class medicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function medico_edit_address($id){
       $medico = medico::find($id);
       $cities = city::orderBy('name','asc')->pluck('name','name');
       $states = state::orderBy('name','asc')->pluck('name','name');
        return view('medico.edit_address')->with('medico', $medico)->with('cities', $cities)->with('states', $states);
     }

     public function medico_update_address(Request $request,$id){

         $request->validate([
           'country'=>'required',
           'state'=>'required',
           'city'=>'required',
           'postal_code'=>'required',
           'colony'=>'required',
           'street'=>'required',
           'number_ext'=>'required',
         ]);

          if($request->city == 'opciones'){
            return back()->with('warning', 'El campo ciudad es requerido')->withInput();
          }
           // $Coordinates =
           //  Geocoder::getCoordinatesForAddress($request->number_ext,$request->street,$request->colony,$request->city,$request->state,$request->country);

            $Coordinates = Geocoder::getCoordinatesForAddress($request->country.','.$request->city.','.$request->colony.','.$request->street.','.$request->number_ext);

           $state = state::where('name',$request->state)->first();

           $city = city::where('name',$request->city)->first();

           $medico = medico::find($id);
           if($medico->stateConfirm != 'data_primordial_complete' and $medico->stateConfirm != 'complete'){
             return redirect()->route('data_primordial_medico',$id)->with('warning', 'Debes rellenar los siguietnes Datos para Poder acceder a otros paneles de tu cuenta.');
           }




           $medico->country = $request->country;
           $medico->state = $request->state;
           $medico->city = $request->city;
           $medico->state_id = $state->id;
           $medico->city_id = $city->id;

           $medico->postal_code = $request->postal_code;
           $medico->colony = $request->colony;
           $medico->street = $request->street;
           $medico->number_ext = $request->number_ext;
           $medico->number_int = $request->number_int;
           $medico->longitud = $Coordinates['lng'];
           $medico->latitud = $Coordinates['lat'];
           $medico->save();


           if($medico->stateConfirm == 'data_primordial_complete'){
             $medico->stateConfirm = 'complete';
             $medico->save();
             return redirect()->route('medico.edit',$id)->with('successComplete','nada');
           }

        return redirect()->route('medico.edit',$medico->id)->with('medico', $medico)->with('success','Se ha actualizado la Dirección de su sitio de trabajo');
     }



     public function inner_cities_select(Request $request){
       $cities = city::where('state_id',$request->state_id)->orderBy('name','asc')->pluck('name','id');
       return $cities;
     }

     public function inner_cities_select2(Request $request){
       $cities = city::where('state_id',$request->state_id)->orderBy('name','asc')->pluck('name','name');
       return $cities;
     }

     public function inner_cities_select3(Request $request){
       $state = state::where('name', $request->name)->first();
       $cities = city::where('state_id',$state->id)->orderBy('name','asc')->pluck('name','name');
       return $cities;
     }

     public function inner_states_select(Request $request){

       $state = state::where('name', $request->name)->first();
       $cities = city::where('state_id',$state->id)->orderBy('name','asc')->pluck('name','name');
       return $cities;
     }

     public function medico_specialty_create($id)
     {
        $specialty = specialty::orderBy('name','asc')->pluck('name','name');
         return view('medico.medico_specialty.create')->with('medico_id',$id)->with('specialty', $specialty);
     }

     public function medico_specialty_store(Request $request){
       $request->validate([
         'type'=>'required',
         'institution'=>'required',
         'specialty'=>'required',
         'from'=>'required',

         'until'=>'required',
         'aditional'=>'nullable',
       ]);

       if($request->type == 'other'){
         $request->validate([
           'other'=>'required'
         ]);

       }

       $specialty = specialty::where('name',$request->specialty)->first();

       $specialty_category = specialty_category::find($specialty->specialty_category_id);

       $medico_specialty = new medico_specialty;
       $medico_specialty->fill($request->all());
       $medico_specialty->specialty_category = $specialty_category->name;
       if($request->type == 'other'){
         $medico_specialty->type = $request->other;
       }
       $medico_specialty->save();

       return redirect()->route('medico.edit',$request->medico_id)->with('success','Se ha Agregado una nueva Especialidad/Carrera, de forma satisfactoria.');

     }
     public function data_primordial_medico($id){

       $medico = medico::find($id);
       $cities = city::orderBy('name','asc')->pluck('name','id');
       $states = state::orderBy('name','asc')->pluck('name','id');
        $specialties = specialty::orderBy('name','asc')->pluck('name','name');
      return view('medico.data_primordial_medico',compact('medico','cities','states','specialties'));
     }

    public function medico_service_list(Request $request){

        $medico_services = medico_service::where('medico_id', $request->medico_id)->get();

        return view('medico.list_service')->with('services', $medico_services);
    }

    public function medico_experience_delete(Request $request){
      $medico_service = medico_experience::find($request->medico_id);
      $medico_service->delete();

      return response()->json($medico_service);

    }

    public function medicoBorrar(Request $request){
      $medico_service = medico_service::find($request->medico_id);
      $medico_service->delete();

      return response()->json($medico_service);

    }

     public function social_network_list(Request $request){
         $social_networks = social_network::where('medico_id', $request->medico_id)->get();

         return view('medico.list_social')->with('social_networks', $social_networks);
     }

     public function medico_experience_list(Request $request){

         $experiences = medico_experience::where('medico_id', $request->medico_id)->get();

         return view('medico.list_experience')->with('experiences', $experiences);
     }

     public function borrar_social(Request $request){
       $social_network = social_network::find($request->id);
       $social_network->delete();

      return response()->json($request->id);
     }

     public function medico_social_network_store(Request $request)
     {

         $request->validate([
           'name'=>'required|'.Rule::unique('social_networks')->where('medico_id',$request->medico_id),
           'link'=>'required'
         ]);

         $social_network = new social_network;
         $social_network->name = $request->name;
         $social_network->link = $request->link;
         $social_network->medico_id = $request->medico_id;
         $social_network->save();

         return response()->json('ok');
     }

     public function medico_experience_store(Request $request)
     {
         $request->validate([
           'name'=>'required',
         ]);

         $medico_experience = new medico_experience;
         $medico_experience->name = $request->name;
         $medico_experience->medico_id = $request->medico_id;
         $medico_experience->save();

         return redirect()->route('medico.edit',$request->medico_id)->with('success', 'Experiencia Agregada');

     }
     public function service_medico_store(Request $request)
     {
         $request->validate([
           'name'=>'required',
         ]);

         $medico_service = new medico_service;
         $medico_service->name = $request->name;
         $medico_service->medico_id = $request->medico_id;
         $medico_service->save();

         return redirect()->route('medico.edit',$request->medico_id)->with('success', 'Servicio Agregado');

     }

    public function index()
    {
        //
    }

    public function medicosList()
    {
        $medicos = medico::orderBy('id','desc')->paginate(10);
        return view('medico.medicosList')->with('medicos',$medicos);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $countries = country::orderBy('name','asc')->pluck('name','name');
      $specialties = specialty::orderBy('name','asc')->pluck('name','name');

      return view('medico.create',compact('countries','specialties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



     public function confirmMedico($id,$code){

      $user = User::find($id);

      if($user->confirmation_code == $code){
          $user->confirmation_code = $code;
          $user->confirmed = 'medium';
          $user->save();

          $medico = medico::find($user->medico_id);

          $medico->stateConfirm = 'medium';
          $medico->save();

          return redirect()->route('home')->with('confirmMedico', 'confirmMedico');

      }

          $user->save();
         return redirect()->route('successRegMedico',$user->id)->with('warning', 'No se pudo verificar la autenticacion del usuario,por favor presione el boton "Reenviar Correo de Confirmación" para intentarlo Nuevamente.');

     }

    public function store(Request $request)
    {

        $request->validate([
           //'identification'=>'required|unique:medicos',
           'name'=>'required',
           'lastName'=>'required',
           'gender'=>'required',
           'specialty'=>'required',
           'country'=>'required',
           'email'=>'required|unique:medicos|unique:users',
           'password'=>'required',
           //'medicalCenter_id'=>'required',
           //'id_promoter'=>'nullable',
           'phone'=>'required|numeric',
           //'facebook'=>'required',

        ]);

        if($request->terminos == Null){
          return back()->with('warning', 'Debes Aceptar los Términos y Condiciones, para poder continuar.')->withInput();
        }

        $medico = new medico;
        $medico->fill($request->all());
        $medico->password = bcrypt($request->password);
        $medico->stateConfirm = 'porConfirmar';
        $medico->save();

        $code = str_random(25);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->medico_id = $medico->id;
        $user->confirmation_code = $code;
        $user->role = 'medico';
        $user->save();

        $role = Role::where('name','medico')->first();

        $user->attachRole($role);

        Mail::send('mails.confirmMedico',['medico'=>$medico,'user'=>$user,'code'=>$code],function($msj) use($medico){
           $msj->subject('Médicos Si');
           // $msj->to($medico->email);
           $msj->to('eavc53189@gmail.com');

      });

         return redirect()->route('successRegMedico',$medico->id)->with('user', $user)->with('medico', $medico);

    }

    public function successRegMedico($id)
    {
      $medico = medico::find($id);
      $user = User::where('medico_id',$id)->get();

        return view('medico.successReg')->with('user', $user)->with('medico', $medico);
    }

    public function resendMailMedicoConfirm(Request $request){

         $code = str_random(25);
         $user = User::find($request->user_id);
         $user->confirmation_code = $code;
         $user->save();

         Mail::send('mails.confirmMedico',['user'=>$user,'code'=>$code], function($msj) use($user){
            $msj->subject('Red Medica: '.$user->name);
            $msj->to('eavc53189@gmail.com');
        });

        return redirect()->route('successRegMedico',$user->id)->with('success', 'Se ha Reenviado el mensaje de confirmación a tu Correo Electronico.')->with('user', $user);
   }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     public function medico_perfil($id)
     {
         $insurance_carriers = insurance_carrier::where('medico_id',$id)->get();
         $medicalCenter = medicalCenter::orderBy('name','asc')->pluck('name','name');
         $cities = city::orderBy('name','asc')->pluck('name','name');
         $medico = medico::find($id);
         $consulting_room = consulting_room::where('medico_id',$medico->id)->get();
         $consultingIsset = consulting_room::where('medico_id',$medico->id)->count();
         $photo = photo::where('medico_id', $medico->id)->where('type', 'perfil')->first();
         $medico_specialty = medico_specialty::where('medico_id', $medico->id)->paginate(10);
         $social_networks = social_network::where('medico_id', $id)->get();
         $images = photo::where('medico_id', $medico->id)->where('type','image')->get();

         return view('medico.perfil')->with('medico', $medico)->with('photo', $photo)->with('consulting_rooms', $consulting_room)->with('consultingIsset', $consultingIsset)->with('cities', $cities)->with('medicalCenter', $medicalCenter)->with('medico_specialty', $medico_specialty)->with('social_networks', $social_networks)->with('images', $images)->with('insurance_carriers',$insurance_carriers)->with('states', $states);
     }

    public function edit($id)
    {
        $insurance_carriers = insurance_carrier::where('medico_id',$id)->get();
        $medicalCenter = medicalCenter::orderBy('name','asc')->pluck('name','name');
        $cities = city::orderBy('name','asc')->pluck('name','id');
        $states = state::orderBy('name','asc')->pluck('name','id');
        $medico = medico::find($id);
        $consulting_room = consulting_room::where('medico_id',$medico->id)->get();
        $consultingIsset = consulting_room::where('medico_id',$medico->id)->count();
        $photo = photo::where('medico_id', $medico->id)->where('type', 'perfil')->first();
        $medico_specialty = medico_specialty::where('medico_id', $medico->id)->paginate(10);
        $social_networks = social_network::where('medico_id', $id)->get();
        $images = photo::where('medico_id', $medico->id)->where('type','image')->get();
        $specialties = specialty::orderBy('name','asc')->pluck('name','name');

        return view('medico.edit')->with('medico', $medico)->with('photo', $photo)->with('consulting_rooms', $consulting_room)->with('consultingIsset', $consultingIsset)->with('cities', $cities)->with('medicalCenter', $medicalCenter)->with('medico_specialty', $medico_specialty)->with('social_networks', $social_networks)->with('images', $images)->with('insurance_carriers',$insurance_carriers)->with('states', $states)->with('specialties', $specialties);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // /return $request;
      $request->validate([
         'name'=>'required',
         'lastName'=>'required',
         'gender'=>'required',
         // 'city_id'=>'required',
         // 'state_id'=>'required',
         'identification'=>'required',
         'specialty'=>'required',
         //'sub_specialty'=>'required',
         //'email'=>'required|unique:medicos|unique:users',
         //'password'=>'required',
         //'medicalCenter_id'=>'required',
         'id_promoter'=>'nullable',
         'phone'=>'required|numeric',

         //'facebook'=>'required',

      ]);
      $city = city::find($request->city_id);

      $medico = medico::find($id);
      $medico->fill($request->all());

      // $medico->latitud = $city->latitud;
      // $medico->longitud = $medico->longitud;
      //$medico->state = 'complete';



      if($medico->stateConfirm == 'complete'){
        $medico->save();
          return redirect()->route('medico.edit',$id)->with('success','Sus datos han sido actualizados con exito');
      }else{
        $medico->stateConfirm = 'data_primordial_complete';
        $medico->save();
          return redirect()->route('medico_edit_address',$id)->with('success', 'Sus datos han sido actualizados con exito, por Favor Agregue su dirección de trabajo.');
          // return redirect()->route('medico.edit',$id)->with('successComplete', 'valusse');
      }

      // if($medico->stateConfirm == 'mailConfirmed')
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function medico_store_coordinates(Request $request,$id)
    {
      $medico = medico::find($id);
      $medico->longitud = $request->longitud;
      $medico->latitud = $request->latitud;
      $medico->save();

      return response()->json('ok');

    }

    public function medico_patients($id)
    {
        $medico = medico::find($id);

        $patients = patients_doctor::Join('medicos', 'patients_doctors.medico_id', '=', 'medicos.id')
                                    ->Join('patients', 'patients_doctors.patient_id', '=', 'patients.id')
                                    ->select('patients.*','patients_doctors.id as patients_doctor_id')
                                    ->where('medicos.id',$id)
                                    ->orderBy('patients_doctors.created_at','desc')
                                    ->paginate(10);

        return view('medico.medico_patients',compact('medico','patients'));

    }

    public function medico_appointments_patient($medico_id,$patient_id)
    {
        $medico = medico::find($medico_id);
        $patient = patient::find($patient_id);
        $appointments = event::where('medico_id', $medico_id)->where('patient_id',$patient_id)->orderBy('created_at','desc')->paginate(10);

        return view('medico.medico_patient_appointments',compact('medico','patient','appointments'));

    }

}
