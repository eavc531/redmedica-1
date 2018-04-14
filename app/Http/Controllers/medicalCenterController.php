<?php

namespace App\Http\Controllers;

use App\country;
use App\user;
use Illuminate\Http\Request;
use App\medicalCenter;
use Mail;
use App\promoter;
use App\state;
use App\city;
use App\Role;
use App\day;

class medicalCenterController extends Controller
{
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function __construct(){
    // $this->Middleware('medicalCenterConfirm',['only'=>['edit']]);

  }

  public function medical_center_edit_schedule($id){
    $medicalCenter = medicalCenter::find($id);
    $lunes = day::where('name', 'lunes')->orderBy('hour_ini','asc')->get();
    $martes = day::where('name', 'martes')->orderBy('hour_ini','asc')->get();
    $miercoles = day::where('name', 'miercoles')->orderBy('hour_ini','asc')->get();
    $jueves = day::where('name', 'jueves')->orderBy('hour_ini','asc')->get();
    $viernes = day::where('name', 'viernes')->orderBy('hour_ini','asc')->get();
    $sabado = day::where('name', 'sabado')->orderBy('hour_ini','asc')->get();
    $domingo = day::where('name', 'domingo')->orderBy('hour_ini','asc')->get();

       return view('medicalCenter.edit_schedule')->with('medicalCenter', $medicalCenter)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo);
  }

  public function medical_center_schedule_delete($id){
    //day::destroy($id);

    $day = day::find($id);
    $day->delete();
  
    return back()->with('danger', 'se a eliminado horas de la columna: '.$day->name);
  }
  public function medical_center_store_schedule(Request $request,$id){
    //dd($request->all());

      $request->validate([
        'day'=>'required',
      ]);

      $medicalCenter = medicalCenter::find($id);
      $day = new day;
      $day->name = $request->day;
      $day->hour_ini = $request->hour_start.':'.$request->mins_start;
      $day->hour_end = $request->hour_end.':'.$request->mins_end;
      $day->save();

      return back()->with('success', 'Se a han agregado nuevas horas al dia: '.$request->day);
  }

  public function medical_center_edit_address($id){
    $medicalCenter = medicalCenter::find($id);
    $cities = city::orderBy('name','asc')->pluck('name','name');
    $states = state::orderBy('name','asc')->pluck('name','name');
     return view('medicalCenter.edit_address')->with('medicalCenter', $medicalCenter)->with('cities', $cities)->with('states', $states);
  }

  public function medical_center_update_address(Request $request,$id){
      $request->validate([
        'country'=>'required',
        'state'=>'required',
        'city'=>'required',
        'postal_code'=>'required',
        'colony'=>'required',
        'street'=>'required',
        'number_ext'=>'required',
      ]);

        $medicalCenter = medicalCenter::find($id);
        $medicalCenter->country = $request->country;
        $medicalCenter->state = $request->state;
        $medicalCenter->city = $request->city;
        $medicalCenter->postal_code = $request->postal_code;
        $medicalCenter->colony = $request->colony;
        $medicalCenter->street = $request->street;
        $medicalCenter->number_ext = $request->number_ext;
        $medicalCenter->number_int = $request->number_int;
        $medicalCenter->save();


     return redirect()->route('medicalCenter.edit',$medicalCenter->id)->with('medicalCenter', $medicalCenter)->with('success','Se han actualziado datos de la Dirección del Centro Médico');
  }

  public function medical_center_edit_data($id){
    $medicalCenter = medicalCenter::find($id);
     return view('medicalCenter.medical_center_edit_data')->with('medicalCenter', $medicalCenter);
  }

  public function medical_center_edit_data_update(Request $request,$id){


    $request->validate([
      'name'=>'required',
      'nameAdmin'=>'required',
      //'email_institution'=>'required',
      'phone_admin'=>'required',
      'sanitary_license'=>'required',
      'id_medicalCenter'=>'required',
      'phone'=>'required',
      //'phone2'=>'required',

    ]);

    $medicalCenter = medicalCenter::find($id);

    $medicalCenter->name = $request->name;
    $medicalCenter->nameAdmin = $request->nameAdmin;
    $medicalCenter->email_institution = $request->email_institution;
    $medicalCenter->phone_admin = $request->phone_admin;
    $medicalCenter->sanitary_license = $request->sanitary_license;
    $medicalCenter->id_medicalCenter = $request->id_medicalCenter;
    $medicalCenter->phone = $request->phone;
    $medicalCenter->phone2 = $request->phone2;

    $medicalCenter->save();

     return redirect()->route('medicalCenter.edit',$medicalCenter->id)->with('success','Se han guardado los datos del centro medico con exito');
  }


  public function medicalCenter_profile($id){
    $medicalCenter = medicalCenter::find($id);
     return view('medicalCenter.profile')->with('medicalCenter', $medicalCenter);
  }

  public function medical_center_panel($id){
    $medicalCenter = medicalCenter::find($id);
     return view('medicalCenter.panel.panel')->with('medicalCenter', $medicalCenter);
  }

  public function data_primordial_medical_center($id){

    $medicalCenter = medicalCenter::find($id);
     $countries = country::orderBy('name','asc')->pluck('name','name');
     //dd($countries);
     $cities = city::orderBy('name','asc')->pluck('name','name');
     $states = state::orderBy('name','asc')->pluck('name','name');
     return view('medicalCenter.data_primordial_medical_center')->with('medicalCenter', $medicalCenter)->with('cities', $cities)->with('states', $states)->with('countries',$countries);
  }

  public function data_primordial_medical_center2($id){

    $medicalCenter = medicalCenter::find($id);
    $countries = country::orderBy('name','asc')->pluck('name','name');
    //dd($countries);
    $cities = city::orderBy('name','asc')->pluck('name','name');
    $states = state::orderBy('name','asc')->pluck('name','name');
   return view('medicalCenter.data_primordial_medical_center_address')->with('medicalCenter', $medicalCenter)->with('cities', $cities)->with('states', $states)->with('countries',$countries);
  }

    public function confirmMedicalCenter($id,$code){
      $medicalCenter = medicalCenter::find($id);

      if($medicalCenter->confirmation_code == $code){
          $medicalCenter->confirmation_code = null;
          $medicalCenter->statuss = 'mailConfirmed';
          $medicalCenter->save();

          return redirect()->route('home')->with('confirmMedico', 'confirmMedico');
      }

         return redirect()->route('successRegMedicalCenter',$medicalCenter->id)->with('warning', 'No se pudo verificar la autenticacion del usuario, por favor presione el boton "Reenviar Correo de Confirmación" para intentarlo Nuevamente.');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function MedicalCenterList(){
       $medicalCenters = medicalCenter::orderBy('id','desc')->paginate(10);
       return view('medicalCenter.medicalCenterList')->with('medicalCenters',$medicalCenters);
     }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $countries = country::orderBy('name','asc')->pluck('name','name');

        return view('medicalCenter.create')->with('countries', $countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
          'name'=>'required',
          'emailAdmin'=>'required|unique:medical_centers',
          'nameAdmin'=>'required',
          'phone_admin'=>'required|numeric',
          'password'=>'required',
          'country'=>'required',
        ]);

        $code = str_random(25);
        $medicalCenter = new medicalCenter;
        $medicalCenter->fill($request->all());
        $medicalCenter->confirmation_code = $code;
        $medicalCenter->save();

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->emailAdmin;
        $user->password = bcrypt($request->password);
        $user->medical_center_id = $medicalCenter->id;
        $user->confirmation_code = $code;
        $user->role = 'medical_center';
        $user->save();

        $role = Role::where('name','medical_center')->first();

        $user->attachRole($role);
        Mail::send('mails.confirmMedicalCenter',['medicalCenter'=>$medicalCenter,'code'=>$code], function($msj) use ($medicalCenter){
           $msj->subject('Médicos Si');
           $msj->to('eavc53189@gmail.com');
           // $msj->to($medicalCenter->emailAdmin);

         });

        return redirect()->route('successRegMedicalCenter',$medicalCenter->id);
    }

    public function successRegMedicalCenter($id){
      $medicalCenter = medicalCenter::find($id);
      return view('medicalCenter.successReg')->with('medicalCenter',$medicalCenter);
    }

    public function resend_mail_medical_center($id){
      $medicalCenter = medicalCenter::find($id);
      $code = str_random(25);
      $medicalCenter->confirmation_code = $code;
      $medicalCenter->save();
      Mail::send('mails.confirmMedicalCenter',['medicalCenter'=>$medicalCenter,'code'=>$code], function($msj) use ($medicalCenter){
         $msj->subject('Médicos Si');
         $msj->to('eavc53189@gmail.com');
         // $msj->to($medicalCenter->emailAdmin);
       });

       return redirect()->route('successRegMedicalCenter',$medicalCenter->id)->with('success','Se ha Enviado un mensaje a su correo electronico para que pueda Confirmar su Cuenta');
    }

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
    public function edit($id)
    {
      $medicalCenter = medicalCenter::find($id);

      return view('medicalCenter.edit')->with('medicalCenter', $medicalCenter);

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
      //dd($request->all());

        $medicalCenter = medicalCenter::find($id);

        if($medicalCenter->email_institution != $request->email_institution){
          $request->validate([
            'email_institution'=>'required|unique:medical_centers',
          ]);
        }


        $request->validate([
          'id_medicalCenter'=>'required',
          'name'=>'required',
          'nameAdmin'=>'required',
          //'email_institution'=>'required',
          'phone_admin'=>'required',
          'phone'=>'required',
          'city'=>'required',
          'country'=>'required',
          'sanitary_license'=>'required',
          'state'=>'required',
          'postal_code'=>'required',
          'colony'=>'required',
          'street'=>'required',
          'number_ext'=>'required',

        ]);

        if($request->city == 'opciones'){
          return back()->with('warning', 'El campo ciudad es requerido');
        }

        $medicalCenter = medicalCenter::find($id);
        $medicalCenter->fill($request->all());
        $medicalCenter->save();

        return redirect()->route('medicalCenter.edit',$id);

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
