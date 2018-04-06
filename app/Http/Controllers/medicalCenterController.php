<?php

namespace App\Http\Controllers;
use App\user;
use Illuminate\Http\Request;
use App\medicalCenter;
use Mail;
use App\promoter;
use App\city;
use App\Role;
class medicalCenterController extends Controller
{

  public function data_primordial_medical_center($id){

    $medico = medicalCenter::find($id);
    $cities = city::all()->pluck('name','name');

   return view('medicalCenter.data_primordial_medical_center')->with('medico', $medico)->with('cities', $cities);
  }

    public function confirmMedicalCenter($id,$code){
      $medicalCenter = medicalCenter::find($id);

      if($medicalCenter->confirmation_code == $code){
          $medicalCenter->confirmation_code = null;
          $medicalCenter->confirmation_statuss = 'mailConfirmed';
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
      $cities = city::orderBy('name','asc')->pluck('name','name');
      $id_promoter = promoter::orderBy('id_promoter','desc')->pluck('id_promoter','id_promoter');
        return view('medicalCenter.create')->with('id_promoter', $id_promoter)->with('cities', $cities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $code = str_random(25);
        $request->validate([
          'id_medicalCenter'=>'unique:medical_centers',
          'name'=>'required',
          'activePlan'=>'nullable',//ARREGLAAAAAAAAAAAAAAAAAAARRRRRRRRRRRRRRRRRr
          'emailAdmin'=>'required|unique:medical_centers',
          'nameAdmin'=>'required',
          'phone'=>'required|numeric',
          'city'=>'required',
          'billingData'=>'nullable',
          'meansOfRecords'=>'nullable',
          'id_promoter'=>'nullable|numeric',
          'password'=>'required',

        ]);


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
        //
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
        //
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
