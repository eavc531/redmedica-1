<?php

namespace App\Http\Controllers;
use App\patient;
use App\user;
use App\role;
use Illuminate\Http\Request;

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
}
