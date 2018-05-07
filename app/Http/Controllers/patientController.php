<?php

namespace App\Http\Controllers;
use App\patient;
use App\user;
use App\role;
use Illuminate\Http\Request;
use Mail;
use App\country;
use App\state;
use App\city;
use App\medico;
use App\patients_doctor;
use App\event;
use Geocoder;
use Carbon\Carbon;
class patientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient = patient::orderBy('name','asc')->paginate(10);
        return view('patient.index')->with('patients', $patient);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function patient_medicos($id)
     {
      $patient = patient::find($id);

      $medicos = patients_doctor::Join('medicos', 'patients_doctors.medico_id', '=', 'medicos.id')
                                  ->Join('patients', 'patients_doctors.patient_id', '=', 'patients.id')
                                  ->select('medicos.*','patients_doctors.id as patients_doctor_id')
                                  ->where('patients.id',$id)
                                  ->orderBy('patients_doctors.created_at','desc')
                                  ->paginate(10);

         return view('patient.patient_medicos',compact('medicos','patient'));
     }

     public function store_rate_comentary(Request $request)
     {
       $request->validate([
         'score'=>'required'
       ]);

       $calification = '';
       switch ($request->score) {
    case  Null:
        $calification = 'Neutral';
        break;
    case 1:
        $calification = 'Muy Mala';
        break;
    case 2:
        $calification = 'Mala';
        break;
    case 3:
        $calification = 'Regular';
        break;
    case 4:
        $calification = 'Buena';
        break;
    case 5:
        $calification = 'Excelente';
        break;

      }

       $event = event::find($request->event_id);
       $event->score = $request->score;
       $event->calification = $calification;
       $event->comentary = $request->comentary;
       $event->save();

       return back()->with('success', 'Se ha guardado de forma exitosa, la calificación de la Cita.');
     }

     public function rate_appointment($id)
     {
       $app = event::find($id);
       return view('patient.rate_appointment',compact('app'));
     }
     public function patient_appointments(Request $request,$id)
     {
       $patient = patient::find($id);
       $appointments = event::where('patient_id', $id)->orderBy('id','desc')->paginate(5);

         return view('patient.appointments',compact('patient','appointments'));
     }

     public function patient_appointments_pending(Request $request,$id)
     {
       $patient = patient::find($id);
       // dd(Carbon::now());
       $appointments = event::where('patient_id', $id)->where('dateStart','<', Carbon::now())->orderBy('id','desc')->paginate(5);
       $pending = 'Pendiente';
         return view('patient.appointments',compact('patient','appointments','pending'));
     }

     public function patient_appointments_unrated(Request $request,$id)
     {
       $patient = patient::find($id);
       $appointments = event::where('patient_id', $id)->whereNull('calification')->orderBy('id','desc')->paginate(5);
        $unrated = 'Sin Calificar';
         return view('patient.appointments',compact('patient','appointments','unrated'));
     }

    public function create()
    {
        return view('patient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function patient_register_view(Request $request){
       return view('patient.patient_register');
     }
     public function patient_register(Request $request){
       $request->validate([
         'identification'=>'required|unique:patients',
         'gender'=>'required',
         'name'=>'required',
         'lastName'=>'required',
         'phone1'=>'required|numeric',
         'phone2'=>'numeric|nullable',
         'email'=>'required|email|unique:patients',
         'password'=>'required',
       ]);

       $code = str_random(25);
       $patient = new patient;
       $patient->fill($request->all());
       $patient->confirmation_code = $code;
       $patient->save();
       $user = new User;
       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = bcrypt($request->password);
       $user->patient_id = $patient->id;

       $user->role = 'Paciente';
       $user->save();
       $role = Role::where('name','patient')->first();

       $user->attachRole($role);

       Mail::send('mails.confirmPatient',['patient'=>$patient,'code'=>$code,'user'=>$user], function($msj) use ($patient){
          $msj->subject('Médicos Si');
          $msj->to('eavc53189@gmail.com');

        });

        return redirect()->route('successRegPatient',$patient->id);
     }

     public function successRegPatient($id)
     {
       $patient = patient::find($id);
       $user = User::where('medico_id',$id)->get();

         return view('patient.successReg')->with('user', $user)->with('patient', $patient);
     }

     public function confirmPatient($id,$code){

         $patient = patient::find($id);
         if($patient->confirmation_code == $code){
             $patient->confirmation_code = Null;
             $patient->stateConfirm = 'mailConfirmed';
             $patient->save();

             return redirect()->route('home')->with('confirmMedico', 'confirmMedico');
     }else{
       $patient->save();
        return redirect()->route('successRegPatient',$patient->id)->with('warning', 'No se pudo verificar la autenticacion del usuario,por favor presione el boton "Reenviar Correo de Confirmación" para intentarlo Nuevamente.');
     }
   }

    public function store(Request $request)
    {
      $request->validate([
        'identification'=>'required|unique:patients',
        'gender'=>'required',
        'name'=>'required',
        'lastName'=>'required',
        'phone1'=>'required|numeric',
        'phone2'=>'numeric|nullable',
        'email'=>'required|email|unique:patients',
        'password'=>'required',
      ]);

      $patient = new patient;
      $patient->fill($request->all());
      $patient->save();

      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->patient_id = $patient->id;
      $user->role = 'Paciente';

      $user->save();
      $role = Role::where('name','patient')->first();

      $user->attachRole($role);
       return redirect()->route('patient.index')->with('success', 'Se ha registrado un nuevo Paciente de Forma Satisfactoria');
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
    public function edit($id)
    {
      $patient = patient::find($id);
        return view('patient.edit')->with('patient', $patient);
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
          'email'=>'required',
          'identification'=>'required',
            'gender'=>'required',
            'name'=>'required',
            'lastName'=>'required',
            'phone1'=>'required|numeric',
            'phone2'=>'numeric|nullable',
            'password'=>'nullable',

        ]);

      $user = User::where('patient_id',$id)->first();

      $patient = patient::find($id);
      $name = $patient->name.' '.$patient->lastName;

      if($request->email != $user->email){
        $request->validate([
          'email'=>'required|unique:users|unique:patients'

        ]);

      }

      if($request->identification != $patient->identification){
        $request->validate([
        'identification'=>'unique:patients',
        ]);

      }



        $patient->fill($request->all(),['except'=>['email']]);

        $patient->save();


        $user->name = $request->name;

        if($request->password != Null){
            $user->password = bcrypt($request->password);
        }

          $user->email = $request->email;
        $user->save();


        return redirect()->route('patient.index')->with('success', 'Los datos del Paciente: '.$name.' han sido Actualizados.');
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

    public function delete_patient_doctors($id)
    {
        $pd = patients_doctor::find($id);
        $medico = medico::find($pd->medico_id);
        $pd->delete();

        return back()->with('danger', 'El Médico: '.$medico->name.' '.$medico->lastName.' ha sido Eliminado de tu lista de Médicos');
    }

    public function address_patient($id){
      $patient = patient::find($id);
      $countries = country::orderBy('name','asc')->pluck('name','name');
      $states = state::orderBy('name','asc')->pluck('name','name');
      $cities = city::orderBy('name','asc')->pluck('name','name');

      return view('patient.edit_address',compact('countries','states','cities','patient'));
    }

    public function patient_store_address(Request $request,$id){

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

           $Coordinates = Geocoder::getCoordinatesForAddress($request->country.','.$request->city.','.$request->colony.','.$request->street.','.$request->number_ext);

          // $state = state::where('name',$request->state)->first();
          //
          // $city = city::where('name',$request->city)->first();

          $patient = patient::find($id);
          // if($medico->stateConfirm != 'data_primordial_complete' and $medico->stateConfirm != 'complete'){
          //   return redirect()->route('data_primordial_medico',$id)->with('warning', 'Debes rellenar los siguietnes Datos para Poder acceder a otros paneles de tu cuenta.');
          // }

          $patient->country = $request->country;
          $patient->state = $request->state;
          $patient->city = $request->city;

          $patient->postal_code = $request->postal_code;
          $patient->colony = $request->colony;
          $patient->street = $request->street;
          $patient->number_ext = $request->number_ext;
          $patient->number_int = $request->number_int;
          $patient->longitud = $Coordinates['lng'];
          $patient->latitud = $Coordinates['lat'];
          if($patient->stateConfirm != 'complete'){
            $patient->stateConfirm = 'complete';
            $patient->save();
            return redirect()->route('home')->with('success', '!Bienvendi@¡ los datos de su dirección han sido guardados con exito');
          }

          $patient->save();

          return back();


    }

    public function stipulate_appointment($id){
      $medico = medico::find($id);

      return view('patient.stipulate_appointment',compact('medico'));
    }
}
