<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\medico;
use App\User;
use App\medicalCenter;
use App\patient;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Request;
class LoginController extends Controller
{

    public function loginRedirect(){

      if(Auth::user()->hasRole('medico')){
        $medico = medico::find(Auth::user()->medico_id);
        if($medico->stateConfirm == 'medium'){
          return redirect()->route('data_primordial_medico',$medico->id);
        }elseif($medico->stateConfirm == 'complete'){
          return redirect()->route('medico_diary',$medico->id);
        }else{
          Auth::logout();
          return redirect()->route('successRegMedico',$medico->id)->with('warning', 'Su Cuenta no esta "Verificada", debes confirmar el mensaje de confirmacion, enviado a tu email asociado a tu cuenta MédicosSi, si no ha llegado el mesaje solicita reenvio de email con el boton "Reenviar Correo de Confirmacion". en la aprte de abajo de este panel.');
        }

      }elseif(Auth::user()->hasRole('medical_center')){
        $medical_center = medicalCenter::find(Auth::user()->medical_center_id);

        if($medical_center->statuss == 'mailConfirmed'){
          return redirect()->route('data_primordial_medical_center',$medical_center->id);
        }elseif($medical_center->statuss == 'complete'){
          return redirect()->route('medical_center_panel',$medical_center->id);
        }elseif($medical_center->statuss == Null){
          Auth::logout();
          return redirect()->route('successRegMedicalCenter',$medical_center->id);
        }
      }elseif(Auth::user()->role == 'Administrador'){
          return redirect()->route('home');
      }elseif(Auth::user()->role == 'Promotor'){
          return redirect()->route('panel_control_promoters',Auth::user()->promoter->id);
      }elseif(Auth::user()->role == 'Paciente'){
        if(Auth::user()->patient->stateConfirm == 'mailConfirmed'){
          return redirect()->route('address_patient',Auth::user()->patient->id)->with('success', 'Bienvendi@: '.Auth::user()->patient->name.' '.Auth::user()->patient->lastName.' antes de Continuar por favor agrega los datos correspondientes a tu dirección.');
        }elseif(Auth::user()->patient->stateConfirm == 'complete'){
          return back();
        }elseif(Auth::user()->patient->stateConfirm == Null){
          $patient = patient::find(Auth::user()->patient_id);
          Auth::logout();
          return redirect()->route('successRegPatient',$patient->id)->with('warning', 'Aun no has confirmado tu cuenta, para ello debes ingresar al correo  asociado a tu cuenta MédicosSi, y aceptar el mensaje de confirmación, si aun no recibes el correo reintenta el envio del mismo a travez del boton "Reenviar correo de confirmacion", mostrado a continuacion.   ');
        }

      }else{
        Auth::logout();

        return redirect()->route('home');
      }

    }

    public function login2(){
      $credentials = $this->validate(request(),[
        'email'=>'email|required|string',
        'password'=> 'required|string'
      ]);

     if(Auth::attempt($credentials)){
       return response()->json('true');
     }
     return response()->json('false');

    }

    public function logout(){
      Auth::logout();
      return redirect()->route('home');
    }

    public function verifySession(){
      if(Auth::check() == false){
        return response()->json('session_of');
      }elseif(Auth::user()->role != 'Paciente'){
        return response()->json('no_patient');
      }else {
        return response()->json('session_on');
      }

    }
}
