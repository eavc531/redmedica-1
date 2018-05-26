<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\month;
use Auth;
use App\medico;
use App\patient;
use App\event;
use App\patients_doctor;

use Mail;
class medico_diaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function event_personal_store(Request $request)
     {

       $request->validate([
         'title'=>'required',
         'date_start'=>'required',
         'hourStart'=>'required',
         'minsStart'=>'required',
         'hourEnd'=>'required',
         'minsEnd'=>'required',
       ]);

       $hour_start1 = $request->hourStart.':'.$request->minsStart;
       $hour_end1 = $request->hourEnd.':'.$request->minsEnd;

       $hourStart = $request->hourStart.':'.$request->minsStart.':'.'00';
       $start = $request->date_start.' '.$request->hourStart.':'.$request->minsStart.':'.'00';


       if($request->date_End == Null){
         $date_End = $request->date_start;
       }else{
         $date_End = $request->date_End;
       }

       if($request->hourEnd == Null or $request->minsEnd == Null){
         $hourEnd = $request->hourStart.':'.$request->minsStart.':'.'00';
         $end = $date_End.' '.$request->hourStart.':'.$request->minsStart.':'.'00';
       }else{
         $end = $date_End.' '.$request->hourEnd.':'.$request->minsEnd.':'.'00';
         $hourEnd = $request->hourEnd.':'.$request->minsEnd.':'.'00';
       }

       $day1 = \Carbon\Carbon::parse($start)->dayOfWeek;

       $hour_start2 = \Carbon\Carbon::parse($start)->format('H:i');
       $hour_end2 = \Carbon\Carbon::parse($end)->format('H:i');


       if($day1 == 1){
         $day = 'lunes';
       }
       if($day1 == 2){
         $day = 'martes';
       }
       if($day1 == 3){
         $day = 'miercoles';
       }
       if($day1 == 4){
         $day = 'jueves';
       }
       if($day1 == 5){
         $day = 'viernes';
       }
       if($day1 == 6){
         $day = 'sabado';
       }
       if($day1 == 0){
         $day = 'domingo';
       }

       $comprobar_horario = event::where('medico_id',$request->medico_id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$hour_start2)->where('end','>=',$hour_start2)->count();

       $comprobar_horario2 = event::where('medico_id',$request->medico_id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$hour_end2)->where('end','>=',$hour_end2)->count();

       if($comprobar_horario == 0 or $comprobar_horario2 == 0){
         return response()->json('fuera de horario');
       }

       $comprobar_disponibilidad = event::where('medico_id',$request->medico_id)->whereNull('rendering')->where('start','<=',$start)->where('end','>',$start)->count();

      $comprobar_disponibilidad2 = event::where('medico_id',$request->medico_id)->whereNull('rendering')->where('start','<',$end)->where('end','>=',$end)->count();

      if($comprobar_disponibilidad != 0 or $comprobar_disponibilidad2 != 0){
        return response()->json('ya existe');
      }

       $event = new event;
       $event->medico_id = $request->medico_id;
       $event->title = $request->title;
       $event->description = $request->description;
       $event->start = $start;
       $event->end = $end;
       $event->save();

       return response()->json('okxxx');

     }
     public function medico_app_details($id,$p_id,$app_id){
         $app = event::find($app_id);
       return view('medico.medico_app_details',compact('app'));
     }

     public function edit_appointment($id,$p_id,$app_id)
    {
      $app = event::find($app_id);
      $medico = medico::find($id);
      $patient =  patient::find($p_id);

      ///////igual
      $lunes = event::where('medico_id',$id)->where('title','lunes')->orderBy('end','asc')->get();
      $martes = event::where('medico_id',$id)->where('title','martes')->orderBy('end','asc')->get();
      $miercoles = event::where('medico_id',$id)->where('title','miercoles')->orderBy('end','asc')->get();
      $jueves = event::where('medico_id',$id)->where('title','jueves')->orderBy('end','asc')->get();
      $viernes = event::where('medico_id',$id)->where('title','viernes')->orderBy('end','asc')->get();
      $sabado = event::where('medico_id',$id)->where('title','sabado')->orderBy('end','asc')->get();
      $domingo = event::where('medico_id',$id)->where('title','domingo')->orderBy('end','asc')->get();

      // event::max('');
      $countEventSchedule = event::where('medico_id',$id)->where('eventType','horario')->max('end');
      if($countEventSchedule != 0){

        $lunes1 = event::where('medico_id',$id)->where('title','lunes')->max('end');
        $martes1 = event::where('medico_id',$id)->where('title','martes')->orderBy('end','asc')->max('end');
        $miercoles1 = event::where('medico_id',$id)->where('title','miercoles')->orderBy('end','asc')->max('end');
        $jueves1 = event::where('medico_id',$id)->where('title','jueves')->orderBy('end','asc')->max('end');
        $viernes1 = event::where('medico_id',$id)->where('title','viernes')->orderBy('end','asc')->max('end');
        $sabado1 = event::where('medico_id',$id)->where('title','sabado')->orderBy('end','asc')->max('end');
        $domingo1 = event::where('medico_id',$id)->where('title','domingo')->orderBy('end','asc')->max('end');

        $max_hour = max($lunes1,$martes1,$miercoles1,$jueves1,$viernes1,$sabado1,$domingo1);


        $lunes2 = event::where('medico_id',$id)->where('title','lunes')->min('start');
        $martes2 = event::where('medico_id',$id)->where('title','martes')->min('start');
        $miercoles2 = event::where('medico_id',$id)->where('title','miercoles')->min('start');
        $jueves2 = event::where('medico_id',$id)->where('title','jueves')->min('start');
        $viernes2 = event::where('medico_id',$id)->where('title','viernes')->min('start');
        $sabado2 = event::where('medico_id',$id)->where('title','sabado')->min('start');
        $domingo2 = event::where('medico_id',$id)->where('title','domingo')->min('start');
        $array = [$lunes2,$martes2,$miercoles2,$jueves2,$viernes2,$sabado2,$domingo2];
        $array = array_diff($array, array(null));
        $min_hour = min($array);

        $lunes3 = event::where('medico_id',$id)->where('title','lunes')->count();
        if($lunes3 == 0){
          $lunes3 = 1;
        }else{
          $lunes3 = null;
        }

        $martes3 = event::where('medico_id',$id)->where('title','martes')->count();
        if($martes3 == 0){
          $martes3 = 2;
        }else{
          $martes3 = null;
        }

        $miercoles3 = event::where('medico_id',$id)->where('title','miercoles')->count();
        if($miercoles3 == 0){
          $miercoles3 = 3;
        }else{
          $miercoles3 = null;
        }
        $jueves3 = event::where('medico_id',$id)->where('title','jueves')->count();
        if($jueves3 == 0){
          $jueves3 = 4;
        }else{
          $jueves3 = null;
        }
        $viernes3 = event::where('medico_id',$id)->where('title','viernes')->count();
        if($viernes3 == 0){
          $viernes3 = 5;
        }else{
          $viernes3 = null;
        }
        $sabado3 = event::where('medico_id',$id)->where('title','sabado')->count();
        if($sabado3 == 0){
          $sabado3 = 6;
        }else{
          $sabado3 = null;
        }
        $domingo3 = event::where('medico_id',$id)->where('title','domingo')->count();
        if($domingo3 == 0){
          $domingo3 = 0;
        }else{
          $domingo3 = null;
        }

        $days_hide = ['lunes'=>$lunes3,'martes'=>$martes3,'miercoles'=>$miercoles3,'jueves'=>$jueves3,'viernes'=>$viernes3,'sabado'=>$sabado3,'domingo'=>$domingo3];
        ///////igual

        return view('medico.patient.edit_appointment')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('min_hour', $min_hour)->with('max_hour', $max_hour)->with('days_hide', $days_hide)->with('countEventSchedule', $countEventSchedule)->with('patient', $patient)->with('app', $app)->with('mode', 'edition');

      }
      return view('medico.patient.edit_appointment')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('countEventSchedule', $countEventSchedule)->with('patient',$patient)->with('app', $app)->with('mode', 'edition');
      // ->with($months, 'months');
    }

     public function medico_stipulate_appointment($id,$p_id)
       {
         // $months = month::where('user_id',Auth::user()->id)->get();
         $medico = medico::find($id);
         $patient =  patient::find($p_id);

         $lunes = event::where('medico_id',$id)->where('title','lunes')->orderBy('end','asc')->get();
         $martes = event::where('medico_id',$id)->where('title','martes')->orderBy('end','asc')->get();
         $miercoles = event::where('medico_id',$id)->where('title','miercoles')->orderBy('end','asc')->get();
         $jueves = event::where('medico_id',$id)->where('title','jueves')->orderBy('end','asc')->get();
         $viernes = event::where('medico_id',$id)->where('title','viernes')->orderBy('end','asc')->get();
         $sabado = event::where('medico_id',$id)->where('title','sabado')->orderBy('end','asc')->get();
         $domingo = event::where('medico_id',$id)->where('title','domingo')->orderBy('end','asc')->get();

         // event::max('');
         $countEventSchedule = event::where('medico_id',$id)->where('eventType','horario')->max('end');
         if($countEventSchedule != 0){

           $lunes1 = event::where('medico_id',$id)->where('title','lunes')->max('end');
           $martes1 = event::where('medico_id',$id)->where('title','martes')->orderBy('end','asc')->max('end');
           $miercoles1 = event::where('medico_id',$id)->where('title','miercoles')->orderBy('end','asc')->max('end');
           $jueves1 = event::where('medico_id',$id)->where('title','jueves')->orderBy('end','asc')->max('end');
           $viernes1 = event::where('medico_id',$id)->where('title','viernes')->orderBy('end','asc')->max('end');
           $sabado1 = event::where('medico_id',$id)->where('title','sabado')->orderBy('end','asc')->max('end');
           $domingo1 = event::where('medico_id',$id)->where('title','domingo')->orderBy('end','asc')->max('end');

           $max_hour = max($lunes1,$martes1,$miercoles1,$jueves1,$viernes1,$sabado1,$domingo1);

           $lunes2 = event::where('medico_id',$id)->where('title','lunes')->min('start');
           $martes2 = event::where('medico_id',$id)->where('title','martes')->min('start');
           $miercoles2 = event::where('medico_id',$id)->where('title','miercoles')->min('start');
           $jueves2 = event::where('medico_id',$id)->where('title','jueves')->min('start');
           $viernes2 = event::where('medico_id',$id)->where('title','viernes')->min('start');
           $sabado2 = event::where('medico_id',$id)->where('title','sabado')->min('start');
           $domingo2 = event::where('medico_id',$id)->where('title','domingo')->min('start');
           $array = [$lunes2,$martes2,$miercoles2,$jueves2,$viernes2,$sabado2,$domingo2];
           $array = array_diff($array, array(null));
           $min_hour = min($array);

           $lunes3 = event::where('medico_id',$id)->where('title','lunes')->count();
           if($lunes3 == 0){
             $lunes3 = 1;
           }else{
             $lunes3 = null;
           }

           $martes3 = event::where('medico_id',$id)->where('title','martes')->count();
           if($martes3 == 0){
             $martes3 = 2;
           }else{
             $martes3 = null;
           }

           $miercoles3 = event::where('medico_id',$id)->where('title','miercoles')->count();
           if($miercoles3 == 0){
             $miercoles3 = 3;
           }else{
             $miercoles3 = null;
           }
           $jueves3 = event::where('medico_id',$id)->where('title','jueves')->count();
           if($jueves3 == 0){
             $jueves3 = 4;
           }else{
             $jueves3 = null;
           }
           $viernes3 = event::where('medico_id',$id)->where('title','viernes')->count();
           if($viernes3 == 0){
             $viernes3 = 5;
           }else{
             $viernes3 = null;
           }
           $sabado3 = event::where('medico_id',$id)->where('title','sabado')->count();
           if($sabado3 == 0){
             $sabado3 = 6;
           }else{
             $sabado3 = null;
           }
           $domingo3 = event::where('medico_id',$id)->where('title','domingo')->count();
           if($domingo3 == 0){
             $domingo3 = 0;
           }else{
             $domingo3 = null;
           }

           $days_hide = ['lunes'=>$lunes3,'martes'=>$martes3,'miercoles'=>$miercoles3,'jueves'=>$jueves3,'viernes'=>$viernes3,'sabado'=>$sabado3,'domingo'=>$domingo3];

           return view('medico.stipulate_appointment')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('min_hour', $min_hour)->with('max_hour', $max_hour)->with('days_hide', $days_hide)->with('countEventSchedule', $countEventSchedule)->with('patient', $patient);

         }
         return view('medico.stipulate_appointment')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('countEventSchedule', $countEventSchedule)->with('patient',$patient);
         // ->with($months, 'months');
       }

     public function appointment_store(Request $request)
     {

       $request->validate([
         'title'=>'required',
         'date_start'=>'required',
         'hourStart'=>'required',
         'minsStart'=>'required',
         'hourEnd'=>'required',
         'minsEnd'=>'required',
         'payment_method'=>'required',
       ]);

       $hour_start1 = $request->hourStart.':'.$request->minsStart;
       $hour_end1 = $request->hourEnd.':'.$request->minsEnd;

       //fecha completa
       $hourStart = $request->hourStart.':'.$request->minsStart.':'.'00';
       $start = $request->date_start.' '.$request->hourStart.':'.$request->minsStart.':'.'00';

       if($request->date_End == Null){
         $date_End = $request->date_start;
       }else{
         $date_End = $request->date_End;
       }

       if($request->hourEnd == Null or $request->minsEnd == Null){
         $hourEnd = $request->hourStart.':'.$request->minsStart.':'.'00';
         $end = $date_End.' '.$request->hourStart.':'.$request->minsStart.':'.'00';

       }else{
         $end = $date_End.' '.$request->hourEnd.':'.$request->minsEnd.':'.'00';
         $hourEnd = $request->hourEnd.':'.$request->minsEnd.':'.'00';
       }

       $day1 = \Carbon\Carbon::parse($start)->dayOfWeek;
       $hour_start2 = \Carbon\Carbon::parse($start)->format('H:i');
       $hour_end2 = \Carbon\Carbon::parse($end)->format('H:i');

       if($day1 == 1){
         $day = 'lunes';
       }
       if($day1 == 2){
         $day = 'martes';
       }
       if($day1 == 3){
         $day = 'miercoles';
       }
       if($day1 == 4){
         $day = 'jueves';
       }
       if($day1 == 5){
         $day = 'viernes';
       }
       if($day1 == 6){
         $day = 'sabado';
       }
       if($day1 == 0){
         $day = 'domingo';
       }

       $comprobar_horario = event::where('medico_id',$request->medico_id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$hour_start2)->where('end','>=',$hour_start2)->count();

       $comprobar_horario2 = event::where('medico_id',$request->medico_id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$hour_end2)->where('end','>=',$hour_end2)->count();

       if($comprobar_horario == 0 or $comprobar_horario2 == 0){
         return response()->json('fuera de horario');
       }

       $comprobar_disponibilidad = event::where('medico_id',$request->medico_id)->whereNull('rendering')->where('start','<=',$start)->where('end','>',$start)->count();

      $comprobar_disponibilidad2 = event::where('medico_id',$request->medico_id)->whereNull('rendering')->where('start','<',$end)->where('end','>=',$end)->count();

      if($comprobar_disponibilidad != 0 or $comprobar_disponibilidad2 != 0){
        return response()->json('ya existe');
      }

       $event = new event;
       //$event->price = $request->price;
       $event->payment_method = $request->payment_method;
       // $event->description = $request->description;
       $event->title = $request->title;
       $event->start = $start;
       $event->end = $end;

       $event->dateStart = $request->date_start;
       $event->dateEnd = $date_End;
       // if($request->title == 'Ambulatoria'){
       //   $event->color = 'rgb(40, 130, 55)';
       // }elseif($request->title == 'Externa o a Domicilio'){
       //   $event->color = 'rgb(241, 80, 0)';
       // }elseif($request->title == 'Urgencias'){
       //   $event->color = 'rgb(0, 190, 241)';

       if($request->title == 'Cita por Internet'){
         $event->color = 'rgb(35, 44, 173)';
       }else{
         $event->color = 'rgb(151, 166, 232)';
       }


       if(Auth::check() and Auth::user()->role == 'Paciente'){
           $event->namePatient = Auth::user()->patient->name.' '.Auth::user()->patient->lastName;
           $event->patient_id = Auth::user()->patient->id;
           $event->medico_id = $request->medico_id;
           $patient = patient::find($request->patient_id);
           $event->namePatient = $patient->name.' '.$patient->lastName;
           $event->stipulated = "Paciente";
           $event->notification = "not_see";
        }elseif (Auth::check() and Auth::user()->role == 'medico') {
           $event->patient_id = $request->patient_id;
           $event->medico_id = $request->medico_id;
           $patient = patient::find($request->patient_id);
           $event->namePatient = $patient->name.' '.$patient->lastName;
           $event->stipulated = "Medico";
        }
       $event->hour_start = $hourStart;
       $event->hour_end = $hourEnd;

       $event->save();

       $patients_doctorsCount = patients_doctor::where('patient_id',$request->patient_id)->where('medico_id',$request->medico_id)->count();

       if($patients_doctorsCount == 0){
         $patients_doctors = new patients_doctor;
         $patients_doctors->patient_id = $request->patient_id;
         $patients_doctors->medico_id = $request->medico_id;
         $patients_doctors->save();
       }

       $medico = medico::find($request->medico_id);
       $count_notifications = event::where('medico_id',$request->medico_id)->where('notification','not_see')->count();
       $medico->notification_number = $count_notifications;
       $medico->save();
       $patient = patient::find($request->patient_id);


       if($event->stipulated == 'medico'){
         Mail::send('mails.med_notification_patient_appointment',['medico'=>$medico,'patient'=>$patient,'event'=>$event],function($msj) use($patient){
            $msj->subject('Médicos Si');
            $msj->to('eavc53189@gmail.com');
          });

         Mail::send('mails.med_notification_medico_appointment',['medico'=>$medico,'patient'=>$patient,'event'=>$event],function($msj) use($medico){
            $msj->subject('Médicos Si');
            $msj->to('testprogramas531@gmail.com');
          });


         return response()->json('Se ha agendado Una Cita "'.$request->title.'" con el Paciente: '.$patient->name.' '.$patient->lastName.' para la fecha: '.$request->date_start.' y hora: '.$hourStart.'.');
       }

       Mail::send('mails.notification_patient_appointment',['medico'=>$medico,'patient'=>$patient,'event'=>$event],function($msj) use($patient){
          $msj->subject('Médicos Si');
          $msj->to('eavc53189@gmail.com');
        });

       Mail::send('mails.notification_medico_appointment',['medico'=>$medico,'patient'=>$patient,'event'=>$event],function($msj) use($medico){
          $msj->subject('Médicos Si');
          $msj->to('testprogramas531@gmail.com');
        });


       return response()->json('Se ha agendado Una Cita "'.$request->title.'" con el Médico: '.$medico->name.' '.$medico->lastName.' para la fecha: '.$request->date_start.' y hora: '.$hourStart.'.');
     }

     public function stipulate_appointment($id)
     {
       // $months = month::where('user_id',Auth::user()->id)->get();
       $medico = medico::find($id);

       $lunes = event::where('medico_id',$id)->where('title','lunes')->orderBy('end','asc')->get();
       $martes = event::where('medico_id',$id)->where('title','martes')->orderBy('end','asc')->get();
       $miercoles = event::where('medico_id',$id)->where('title','miercoles')->orderBy('end','asc')->get();
       $jueves = event::where('medico_id',$id)->where('title','jueves')->orderBy('end','asc')->get();
       $viernes = event::where('medico_id',$id)->where('title','viernes')->orderBy('end','asc')->get();
       $sabado = event::where('medico_id',$id)->where('title','sabado')->orderBy('end','asc')->get();
       $domingo = event::where('medico_id',$id)->where('title','domingo')->orderBy('end','asc')->get();

       // event::max('');
       $countEventSchedule = event::where('medico_id',$id)->where('eventType','horario')->max('end');
       if($countEventSchedule != 0){

         $lunes1 = event::where('medico_id',$id)->where('title','lunes')->max('end');
         $martes1 = event::where('medico_id',$id)->where('title','martes')->orderBy('end','asc')->max('end');
         $miercoles1 = event::where('medico_id',$id)->where('title','miercoles')->orderBy('end','asc')->max('end');
         $jueves1 = event::where('medico_id',$id)->where('title','jueves')->orderBy('end','asc')->max('end');
         $viernes1 = event::where('medico_id',$id)->where('title','viernes')->orderBy('end','asc')->max('end');
         $sabado1 = event::where('medico_id',$id)->where('title','sabado')->orderBy('end','asc')->max('end');
         $domingo1 = event::where('medico_id',$id)->where('title','domingo')->orderBy('end','asc')->max('end');

         $max_hour = max($lunes1,$martes1,$miercoles1,$jueves1,$viernes1,$sabado1,$domingo1);


         $lunes2 = event::where('medico_id',$id)->where('title','lunes')->min('start');
         $martes2 = event::where('medico_id',$id)->where('title','martes')->min('start');
         $miercoles2 = event::where('medico_id',$id)->where('title','miercoles')->min('start');
         $jueves2 = event::where('medico_id',$id)->where('title','jueves')->min('start');
         $viernes2 = event::where('medico_id',$id)->where('title','viernes')->min('start');
         $sabado2 = event::where('medico_id',$id)->where('title','sabado')->min('start');
         $domingo2 = event::where('medico_id',$id)->where('title','domingo')->min('start');
         $array = [$lunes2,$martes2,$miercoles2,$jueves2,$viernes2,$sabado2,$domingo2];
         $array = array_diff($array, array(null));
         $min_hour = min($array);

         $lunes3 = event::where('medico_id',$id)->where('title','lunes')->count();
         if($lunes3 == 0){
           $lunes3 = 1;
         }else{
           $lunes3 = null;
         }

         $martes3 = event::where('medico_id',$id)->where('title','martes')->count();
         if($martes3 == 0){
           $martes3 = 2;
         }else{
           $martes3 = null;
         }

         $miercoles3 = event::where('medico_id',$id)->where('title','miercoles')->count();
         if($miercoles3 == 0){
           $miercoles3 = 3;
         }else{
           $miercoles3 = null;
         }
         $jueves3 = event::where('medico_id',$id)->where('title','jueves')->count();
         if($jueves3 == 0){
           $jueves3 = 4;
         }else{
           $jueves3 = null;
         }
         $viernes3 = event::where('medico_id',$id)->where('title','viernes')->count();
         if($viernes3 == 0){
           $viernes3 = 5;
         }else{
           $viernes3 = null;
         }
         $sabado3 = event::where('medico_id',$id)->where('title','sabado')->count();
         if($sabado3 == 0){
           $sabado3 = 6;
         }else{
           $sabado3 = null;
         }
         $domingo3 = event::where('medico_id',$id)->where('title','domingo')->count();
         if($domingo3 == 0){
           $domingo3 = 0;
         }else{
           $domingo3 = null;
         }

         $days_hide = ['lunes'=>$lunes3,'martes'=>$martes3,'miercoles'=>$miercoles3,'jueves'=>$jueves3,'viernes'=>$viernes3,'sabado'=>$sabado3,'domingo'=>$domingo3];

         return view('patient.stipulate_appointment')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('min_hour', $min_hour)->with('max_hour', $max_hour)->with('days_hide', $days_hide)->with('countEventSchedule', $countEventSchedule);

       }
       return view('patient.stipulate_appointment')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('countEventSchedule', $countEventSchedule);
       // ->with($months, 'months');
     }

     public function medico_schedule($id)
     {
       $medico = medico::find($id);
       $lunes = event::where('medico_id',$id)->where('title', 'lunes')->orderBy('start','asc')->get();
       $martes = event::where('medico_id',$id)->where('title', 'martes')->orderBy('start','asc')->get();
       $miercoles = event::where('medico_id',$id)->where('title', 'miercoles')->orderBy('start','asc')->get();
       $jueves = event::where('medico_id',$id)->where('title', 'jueves')->orderBy('start','asc')->get();
       $viernes = event::where('medico_id',$id)->where('title', 'viernes')->orderBy('start','asc')->get();
       $sabado = event::where('medico_id',$id)->where('title', 'sabado')->orderBy('start','asc')->get();
       $domingo = event::where('medico_id',$id)->where('title', 'domingo')->orderBy('start','asc')->get();

       return view('medico.panel.schedule')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo);

     }

     public function medico_business_hours($id)
     {
       $data = event::where('medico_id',$id)->where('rendering', 'background')->get(['start','end','dow','color','hourStart','hourEnd','minsStart','minsEnd','id']);
       // return view('fullCalendar.fullCalendar');
        return Response()->json($data);
     }

     public function medico_diary($id)
     {
       // $months = month::where('user_id',Auth::user()->id)->get();
       $medico = medico::find($id);

       $lunes = event::where('medico_id',$id)->where('title','lunes')->orderBy('end','asc')->get();
       $martes = event::where('medico_id',$id)->where('title','martes')->orderBy('end','asc')->get();
       $miercoles = event::where('medico_id',$id)->where('title','miercoles')->orderBy('end','asc')->get();
       $jueves = event::where('medico_id',$id)->where('title','jueves')->orderBy('end','asc')->get();
       $viernes = event::where('medico_id',$id)->where('title','viernes')->orderBy('end','asc')->get();
       $sabado = event::where('medico_id',$id)->where('title','sabado')->orderBy('end','asc')->get();
       $domingo = event::where('medico_id',$id)->where('title','domingo')->orderBy('end','asc')->get();

       // event::max('');
       $countEventSchedule = event::where('medico_id',$id)->where('eventType','horario')->max('end');
       if($countEventSchedule != 0){

         $lunes1 = event::where('medico_id',$id)->where('title','lunes')->max('end');
         $martes1 = event::where('medico_id',$id)->where('title','martes')->orderBy('end','asc')->max('end');
         $miercoles1 = event::where('medico_id',$id)->where('title','miercoles')->orderBy('end','asc')->max('end');
         $jueves1 = event::where('medico_id',$id)->where('title','jueves')->orderBy('end','asc')->max('end');
         $viernes1 = event::where('medico_id',$id)->where('title','viernes')->orderBy('end','asc')->max('end');
         $sabado1 = event::where('medico_id',$id)->where('title','sabado')->orderBy('end','asc')->max('end');
         $domingo1 = event::where('medico_id',$id)->where('title','domingo')->orderBy('end','asc')->max('end');

         $max_hour = max($lunes1,$martes1,$miercoles1,$jueves1,$viernes1,$sabado1,$domingo1);

         $lunes2 = event::where('medico_id',$id)->where('title','lunes')->min('start');
         $martes2 = event::where('medico_id',$id)->where('title','martes')->min('start');
         $miercoles2 = event::where('medico_id',$id)->where('title','miercoles')->min('start');
         $jueves2 = event::where('medico_id',$id)->where('title','jueves')->min('start');
         $viernes2 = event::where('medico_id',$id)->where('title','viernes')->min('start');
         $sabado2 = event::where('medico_id',$id)->where('title','sabado')->min('start');
         $domingo2 = event::where('medico_id',$id)->where('title','domingo')->min('start');

         $array = [$lunes2,$martes2,$miercoles2,$jueves2,$viernes2,$sabado2,$domingo2];
         $array = array_diff($array, array(null));
         $min_hour = min($array);

         $lunes3 = event::where('medico_id',$id)->where('title','lunes')->count();
         if($lunes3 == 0){
           $lunes3 = 1;
         }else{
           $lunes3 = null;
         }

         $martes3 = event::where('medico_id',$id)->where('title','martes')->count();
         if($martes3 == 0){
           $martes3 = 2;
         }else{
           $martes3 = null;
         }

         $miercoles3 = event::where('medico_id',$id)->where('title','miercoles')->count();
         if($miercoles3 == 0){
           $miercoles3 = 3;
         }else{
           $miercoles3 = null;
         }
         $jueves3 = event::where('medico_id',$id)->where('title','jueves')->count();
         if($jueves3 == 0){
           $jueves3 = 4;
         }else{
           $jueves3 = null;
         }
         $viernes3 = event::where('medico_id',$id)->where('title','viernes')->count();
         if($viernes3 == 0){
           $viernes3 = 5;
         }else{
           $viernes3 = null;
         }
         $sabado3 = event::where('medico_id',$id)->where('title','sabado')->count();
         if($sabado3 == 0){
           $sabado3 = 6;
         }else{
           $sabado3 = null;
         }
         $domingo3 = event::where('medico_id',$id)->where('title','domingo')->count();
         if($domingo3 == 0){
           $domingo3 = 0;
         }else{
           $domingo3 = null;
         }

         $days_hide = ['lunes'=>$lunes3,'martes'=>$martes3,'miercoles'=>$miercoles3,'jueves'=>$jueves3,'viernes'=>$viernes3,'sabado'=>$sabado3,'domingo'=>$domingo3];

         return view('medico.panel.diary')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('min_hour', $min_hour)->with('max_hour', $max_hour)->with('days_hide', $days_hide)->with('countEventSchedule', $countEventSchedule);

       }

       return view('medico.panel.diary')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo)->with('countEventSchedule', $countEventSchedule);
       // ->with($months, 'months');
     }

     public function medico_diary_events($id)
     {
       $data = event::where('medico_id',$id)->get();

       // return view('fullCalendar.fullCalendar');
        return Response()->json($data);
     }

     public function medico_diary_events2($id)
     {
       $data = event::where('medico_id',$id)->get();

       // return view('fullCalendar.fullCalendar');
        return Response()->json($data);
     }

     public function medico_diary_fullscreen($id)
     {

       $medico = medico::find($id);
       return view('medico.diary.fullscreen')->with('medico', $medico);

     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function medico_schedule_delete($id){
       //day::destroy($id);

       $day = event::find($id);
       $day->delete();

       return back()->with('danger', 'se a eliminado horas de la columna: '.$day->name);
     }

     public function medico_schedule_store(Request $request,$id)
     {


         $request->validate([
           'day'=>'required',
         ]);

         //dd($request->all());
         $medicalCenter = medico::find($id);
         $schedule = new event;

         if($request->day == 'domingo'){
          $schedule->title = 'domingo';
          $schedule->dow = 0;

        }elseif($request->day == 'lunes'){

           $schedule->title = 'lunes';
           $schedule->dow = 1;

         }elseif($request->day == 'martes'){
           $schedule->title = 'martes';
           $schedule->dow = 2;

         }elseif($request->day == 'miercoles'){

           $schedule->title = 'miercoles';
           $schedule->dow = 3;

         }elseif($request->day == 'jueves'){
           $schedule->title = 'jueves';
           $schedule->dow = 4;

         }elseif($request->day == 'viernes'){
           $schedule->title = 'viernes';
           $schedule->dow = 5;

         }elseif($request->day == 'sabado'){
           $schedule->title = 'sabado';
           $schedule->dow = 6;
         }

         $schedule->color = 'rgba(162, 231, 50, 0.64)';

         $schedule->rendering = 'background';
         $schedule->medico_id = $id;
         $schedule->eventType = 'horario';
         $schedule->title = $request->day;
         $schedule->start = $request->hour_start.':'.$request->mins_start;
         $schedule->end = $request->hour_end.':'.$request->mins_end;
         $schedule->save();

         return back()->with('success', 'Se a han agregado nuevas horas al dia: '.$request->day);

     }

     public function store_event_personal(Request $request)
     {
       //return response()->json('diary');
         $request->validate([
           // 'title'=>'required',
           'title'=>'required',
           'date_start'=>'required',
           'hourStart'=>'required',
           'minsStart'=>'required',
         ]);

         $hour_start1 = $request->hourStart.':'.$request->minsStart;

         $hour_end1 = $request->hourEnd.':'.$request->minsEnd;

         $comprobar_horario = event::where('medico_id',$request->medico_id)->where('rendering', 'background')->where('start','<=',$hour_start1)->where('end','>=',$hour_start1)->count();

         $comprobar_horario2 = event::where('medico_id',$request->medico_id)->where('rendering', 'background')->where('start','<=',$hour_end1)->where('end','>=',$hour_end1)->count();

         if($comprobar_horario == 0 or $comprobar_horario2 == 0){
           return response()->json('fuera del horario');
         }

         //dd($request->description);
         //dd($request->eventType);
         $hourStart = $request->hourStart.':'.$request->minsStart.':'.'00';

         $start = $request->date_start.' '.$request->hourStart.':'.$request->minsStart.':'.'00';

         if($request->date_End == Null){
           $date_End = $request->date_start;
         }else{
           $date_End = $request->date_End;
         }

         if($request->hourEnd == Null or $request->minsEnd == Null){
           $hourEnd = $request->hourStart.':'.$request->minsStart.':'.'00';
           $end = $date_End.' '.$request->hourStart.':'.$request->minsStart.':'.'00';

         }else{
           $end = $date_End.' '.$request->hourEnd.':'.$request->minsEnd.':'.'00';
           $hourEnd = $request->hourEnd.':'.$request->minsEnd.':'.'00';
         }

         $event = new event;
         $event->price = $request->price;
         $event->title = $request->title;
         $event->description = $request->description;
         $event->title = $request->title;
         $event->start = $start;
         $event->end = $end;

         $event->dateStart = $request->date_start;
         $event->dateEnd = $date_End;

         if($request->title == 'Cita Medica'){
           $event->color = 'rgb(40, 130, 55)';
         }elseif($request->title == 'Cita Medica Importante'){
           $event->color = 'rgb(241, 80, 0)';
         }elseif($request->title == 'Consulta Medica'){
           $event->color = 'rgb(0, 190, 241)';
         }elseif($request->title == 'Consulta Medica Importante'){
           $event->color = 'rgb(141, 13, 201)';
         }elseif($request->title == 'Recordatorio'){
           $event->color = 'rgb(129, 231, 39)';
         }

         $event->medico_id = $request->medico_id;
         $event->save();

         return response()->json('ok');

     }

    public function store(Request $request)
    {

      //return response()->json('diary');
        $request->validate([
          // 'title'=>'required',
          'title'=>'required',
          'date_start'=>'required',
          'hourStart'=>'required',
          'minsStart'=>'required',
        ]);

        $hour_start1 = $request->hourStart.':'.$request->minsStart;

        $hour_end1 = $request->hourEnd.':'.$request->minsEnd;

        $comprobar_horario = event::where('medico_id',$request->medico_id)->where('rendering', 'background')->where('start','<=',$hour_start1)->where('end','>=',$hour_start1)->count();

        $comprobar_horario2 = event::where('medico_id',$request->medico_id)->where('rendering', 'background')->where('start','<=',$hour_end1)->where('end','>=',$hour_end1)->count();

        if($comprobar_horario == 0 or $comprobar_horario2 == 0){
          return response()->json('fuera del horario');
        }

        //dd($request->description);
        //dd($request->eventType);
        $hourStart = $request->hourStart.':'.$request->minsStart.':'.'00';

        $start = $request->date_start.' '.$request->hourStart.':'.$request->minsStart.':'.'00';

        if($request->date_End == Null){
          $date_End = $request->date_start;
        }else{
          $date_End = $request->date_End;
        }

        if($request->hourEnd == Null or $request->minsEnd == Null){
          $hourEnd = $request->hourStart.':'.$request->minsStart.':'.'00';
          $end = $date_End.' '.$request->hourStart.':'.$request->minsStart.':'.'00';

        }else{
          $end = $date_End.' '.$request->hourEnd.':'.$request->minsEnd.':'.'00';
          $hourEnd = $request->hourEnd.':'.$request->minsEnd.':'.'00';
        }

        $event = new event;
        $event->price = $request->price;
        $event->title = $request->title;
        $event->description = $request->description;
        $event->title = $request->title;
        $event->start = $start;
        $event->end = $end;

        $event->dateStart = $request->date_start;
        $event->dateEnd = $date_End;

        if($request->title == 'Cita Medica'){
          $event->color = 'rgb(40, 130, 55)';
        }elseif($request->title == 'Cita Medica Importante'){
          $event->color = 'rgb(241, 80, 0)';
        }elseif($request->title == 'Consulta Medica'){
          $event->color = 'rgb(0, 190, 241)';
        }elseif($request->title == 'Consulta Medica Importante'){
          $event->color = 'rgb(141, 13, 201)';
        }elseif($request->title == 'Recordatorio'){
          $event->color = 'rgb(129, 231, 39)';
        }

        $event->medico_id = $request->medico_id;
        $event->save();

        return response()->json('ok');

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

     public function medico_business_hours_update(Request $request)
     {

         $request->validate([
           'hourStart'=>'required',
           'minsStart'=>'required',
           'hourEnd'=>'required',
           'minsEnd'=>'required',
         ]);
         //if($request->)
         $start = $request->hourStart.':'.$request->minsStart;
         $end = $request->hourEnd.':'.$request->minsEnd;
         $schedule = event::find($request->event_id);
         $schedule->start = $start;
         $schedule->end = $end;
         $schedule->save();

         return redirect()->route('medico_schedule',$request->medico_id)->with('success2','horas Editadas para el dia: '.$schedule->title);

     }

     public function update_event(Request $request)
     {

       $hour_start1 = $request->hourStart.':'.$request->minsStart;

       $hour_end1 = $request->hourEnd.':'.$request->minsEnd;

       $comprobar_horario = event::where('medico_id',$request->medico_id)->where('rendering', 'background')->where('start','<=',$hour_start1)->where('end','>=',$hour_start1)->count();

       $comprobar_horario2 = event::where('medico_id',$request->medico_id)->where('rendering', 'background')->where('start','<=',$hour_end1)->where('end','>=',$hour_end1)->count();


       if($comprobar_horario == 0 or $comprobar_horario2 == 0){

         if($request->ajax()){
            return response()->json('fuera del horario');
         }else{
           return back()->with('warning', 'Imposible Cambiar a la Fecha seleccionada, esta fuera del horario establecido.');
         }

       }

     $hourStart = $request->hourStart.':'.$request->minsStart.':'.'00';

     $start = $request->date_start.' '.$request->hourStart.':'.$request->minsStart.':'.'00';

     if($request->date_End == Null){
       $date_End = $request->date_start;
     }else{
       $date_End = $request->date_End;
     }

     if($request->hourEnd == '--' or $request->minsEnd == '--' or $request->hourEnd == Null or $request->minsEnd == Null){
       $hend = null;
       $mend = null;
       $hourEnd = $request->hourStart.':'.$request->minsStart.':'.'00';
       $end = $date_End.' '.$request->hourStart.':'.$request->minsStart.':'.'00';

     }else{
       $hend = $request->hourEnd;
       $mend = $request->minsEnd;
       $end = $date_End.' '.$request->hourEnd.':'.$request->minsEnd.':'.'00';
       $hourEnd = $request->hourEnd.':'.$request->minsEnd.':'.'00';
     }

   //  \Carbon\Carbon::parse()

     $event = event::find($request->event_id);
     $before_date = $event->start;
     $event->title = $request->title;
     $event->title = $request->title;
     $event->start = $start;
     $event->end = $end;
     $event->payment_method = $request->payment_method;
     $event->dateStart = $request->date_start;
     $event->dateEnd = $date_End;

     if($request->title == 'Cita por Internet'){
       $event->color = 'rgb(35, 44, 173)';
     }else{
       $event->color = 'rgb(151, 166, 232)';
     }

     if($request->state == 'Cerrada y Cobrada'){
       $event->color = 'rgb(247, 215, 43)';
     }elseif($request->state == 'pre-pagada'){
       $event->color = 'rgb(214, 50, 50)';
     }

     $event->state = $request->state;
     $event->medico_id = $request->medico_id;
     $event->save();

     $patient = patient::find($event->patient_id);
     $medico = medico::find($event->medico_id);
     if($start != $before_date){

       Mail::send('mails.med_notification_patient_appointment_change',['medico'=>$medico,'patient'=>$patient,'event'=>$event,'before_date'=>$before_date],function($msj) use($patient){
          $msj->subject('Notificación Cambio de Fecha de Cita, Médicos Si');
          $msj->to('eavc53189@gmail.com');
        });

       Mail::send('mails.med_notification_medico_appointment_change',['medico'=>$medico,'patient'=>$patient,'event'=>$event,'before_date'=>$before_date],function($msj) use($medico){
          $msj->subject('Notificación Cambio de Fecha de Cita, Médicos Si');
          $msj->to('testprogramas531@gmail.com');
        });

        if($request->ajax()){
           return response()->json('fecha_editada');
        }

       return redirect()->route('medico_app_details',['m_id'=>$request->medico_id,'p_id'=>$event->patient_id,'app_id'=>$event->id])->with('success','Se ha cambiado la "Hora/Fecha" de la consulta con Exito. Se ha enviado un correo al Paciente: "'.$event->namePatient.'" para notificarle del cambio de la consulta.');


     }

     if($request->ajax()){
        return response()->json('ok');
     }

     return redirect()->route('medico_app_details',['m_id'=>$request->medico_id,'p_id'=>$event->patient_id,'app_id'=>$event->id])->with('success','La Consulta ha sido editada con exito');

     }

    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        event::destroy($request->event_id);
        return back()->with('danger', 'Evento Eliminado con Exito');
    }

    public function delete_event(Request $request)
    {
      $fecha = event::find($request->event_id);
        event::destroy($request->event_id);

        return response()->json('Se ha eliminado un evento correspondiente a la fecha: '.$fecha->start);
    }

    public function delete_event2($id)
    {
      $event = event::find($id);
        event::destroy($id);

        return redirect()->route('medico_appointments_patient',['m_id'=>$event->medico_id,'p_id'=>$event->patient_id])->with('danger','Se ha eliminado una Cita con el paciente: '.$event->medico->name.' '.$event->medico->lastName.' correspondiente a la fecha: '.$event->start);
    }

    public function compare_hours(Request $request,$id)
    {
      if($request->day == 1){
        $day = 'lunes';
      }

      if($request->day == 2){
        $day = 'martes';
      }
      if($request->day == 3){
        $day = 'miercoles';
      }
      if($request->day == 4){
        $day = 'jueves';
      }
      if($request->day == 5){
        $day = 'viernes';
      }
      if($request->day == 6){
        $day = 'sabado';
      }
      if($request->day == 0){
        $day = 'domingo';
      }

      $event = event::where('medico_id',$id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$request->hour_start)->where('end','>=',$request->hour_start)->count();

      $event2 = event::where('medico_id',$id)->where('title', $day)->where('rendering', 'background')->where('start','<=',$request->hour_end)->where('end','>=',$request->hour_end)->count();

      if($event == 0 or $event2 == 0){
        return response()->json('fuera de horario');
      }else{
        return response()->json('ok');
      }


    }
}
