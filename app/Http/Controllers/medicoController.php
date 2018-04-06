<?php

namespace App\Http\Controllers;
use App\medico;
use App\city;
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
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;



class medicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
         'state'=>'required',
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
       $cities = city::all()->pluck('name','name');

      return view('medico.data_primordial_medico')->with('medico', $medico)->with('cities', $cities);
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
      $cities = city::orderBy('name','asc')->pluck('name','name');
      $promoters = promoter::orderBy('id_promoter','asc')->pluck('id_promoter','id_promoter');
      $medicalCenter = medicalCenter::orderBy('name','asc')->pluck('name','id');
      $specialties = specialty::orderBy('name','asc')->pluck('name','id');

      return view('medico.create')->with('medicalCenter',$medicalCenter)->with('cities',$cities)->with('promoters', $promoters);
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
          $medico = medico::find($user->medico_id)->first();

          $medico->state = 'medium';
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
           'email'=>'required|unique:medicos|unique:users',
           'password'=>'required',
           //'city'=>'required',
           //'medicalCenter_id'=>'required',
           //'id_promoter'=>'nullable',
           'phone'=>'required|numeric',
           //'facebook'=>'required',

        ]);

        $medico = new medico;
        $medico->fill($request->all());
        $medico->password = bcrypt($request->password);
        $medico->state = 'medium';
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

        Mail::send('mails.confirmMedico',['medico'=>$medico,'user'=>$user,'code'=>$code],function($msj){
           $msj->subject('Médicos Si');
           $msj->to('eavc53189@gmail.com');

      });

         return redirect()->route('successRegMedico',$user->id)->with('user', $user);

    }

    public function successRegMedico($id)
    {
      $user = User::find($id);
        return view('medico.successReg')->with('user', $user);
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

         return view('medico.perfil')->with('medico', $medico)->with('photo', $photo)->with('consulting_rooms', $consulting_room)->with('consultingIsset', $consultingIsset)->with('cities', $cities)->with('medicalCenter', $medicalCenter)->with('medico_specialty', $medico_specialty)->with('social_networks', $social_networks)->with('images', $images)->with('insurance_carriers',$insurance_carriers);
     }

    public function edit($id)
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

        return view('medico.edit')->with('medico', $medico)->with('photo', $photo)->with('consulting_rooms', $consulting_room)->with('consultingIsset', $consultingIsset)->with('cities', $cities)->with('medicalCenter', $medicalCenter)->with('medico_specialty', $medico_specialty)->with('social_networks', $social_networks)->with('images', $images)->with('insurance_carriers',$insurance_carriers);
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

      $request->validate([
         'name'=>'required',
         'lastName'=>'required',
         'gender'=>'required',
         'city'=>'required',
         'state'=>'required',
         'identification'=>'required',
         //'email'=>'required|unique:medicos|unique:users',
         //'password'=>'required',
         //'medicalCenter_id'=>'required',
         'id_promoter'=>'nullable',
         'phone'=>'required|numeric',

         //'facebook'=>'required',

      ]);
      $medico = medico::find($id);

      $medico->fill($request->all());
      $medico->state = 'complete';
      $medico->save();

      if($request->ajax()){
          return response()->json('ok');
      }else{
          return redirect()->route('medico.edit',$id)->with('successComplete', 'valusse');
      }


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
}
