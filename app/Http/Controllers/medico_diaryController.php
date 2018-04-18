<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\month;
use Auth;
use App\medico;
use App\event;
class medico_diaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function medico_schedule($id)
     {
       $medico = medico::find($id);
       return view('medico.panel.schedule')->with('medico', $medico);
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

       $lunes = event::where('title','lunes')->orderBy('end','asc')->get();
       $martes = event::where('title','martes')->orderBy('end','asc')->get();
       $miercoles = event::where('title','miercoles')->orderBy('end','asc')->get();
       $jueves = event::where('title','jueves')->orderBy('end','asc')->get();
       $viernes = event::where('title','viernes')->orderBy('end','asc')->get();
       $sabado = event::where('title','sabado')->orderBy('end','asc')->get();
       $domingo = event::where('title','domingo')->orderBy('end','asc')->get();


       return view('medico.panel.diary')->with('medico', $medico)->with('lunes', $lunes)->with('martes', $martes)->with('miercoles', $miercoles)->with('jueves', $jueves)->with('viernes', $viernes)->with('sabado', $sabado)->with('domingo', $domingo);
       // ->with($months, 'months');
     }

     public function medico_diary_events($id)
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

     public function medico_schedule_store(Request $request)
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

         $schedule = new event;

         if($request->title == 0){
          $schedule->title = 'domingo';
          $schedule->dow = 0;

         }elseif($request->title == 1){
           $schedule->title = 'lunes';
           $schedule->dow = 1;

         }elseif($request->title == 2){
           $schedule->title = 'martes';
           $schedule->dow = 2;

         }elseif($request->title == 3){
           $schedule->title = 'miercoles';
           $schedule->dow = 3;

         }elseif($request->title == 4){
           $schedule->title = 'jueves';
           $schedule->dow = 4;

         }elseif($request->title == 5){
           $schedule->title = 'viernes';
           $schedule->dow = 5;

         }elseif($request->title == 6){
           $schedule->title = 'sabado';
           $schedule->dow = 6;
         }

         $schedule->eventType = 'horario';
         $schedule->start = $start;
         $schedule->end = $end;


         $schedule->hourStart = $request->hourStart;
         $schedule->minsStart = $request->minsStart;
         $schedule->hourEnd = $request->hourEnd;
         $schedule->minsEnd = $request->minsEnd;

         $schedule->color = 'orange';
         $schedule->rendering = 'background';
         $schedule->medico_id = $request->medico_id;
         $schedule->save();

         return redirect()->route('medico_schedule',$request->medico_id)->with('success2','Nuevas horas asignadas al dia: '.$schedule->title);

     }


    public function store(Request $request)
    {

        $request->validate([
          'title'=>'required',
          'eventType'=>'required',
          'date_start'=>'required',
        ]);

        $hourStart = $request->hourStart.':'.$request->minsStart.':'.'00';

        $start = $request->date_start.' '.$request->hourStart.':'.$request->minsStart.':'.'00';

        if($request->date_End == Null){
          $date_End = $request->date_start;
        }else{
          $date_End = $request->date_End;
        }

        if($request->hourEnd == '--' or $request->minsEnd == '--'){
          $hourEnd = $request->hourStart.':'.$request->minsStart.':'.'00';
          $end = $date_End.' '.$request->hourStart.':'.$request->minsStart.':'.'00';

        }else{
          $end = $date_End.' '.$request->hourEnd.':'.$request->minsEnd.':'.'00';
          $hourEnd = $request->hourEnd.':'.$request->minsEnd.':'.'00';
        }

      //  \Carbon\Carbon::parse()
        $event = new event;
        $event->title = $request->title;
        $event->eventType = $request->eventType;
        $event->start = $start;
        $event->end = $end;

        $event->dateStart = $request->date_start;
        $event->dateEnd = $date_End;
        $event->hourStart = $request->hourStart;
        $event->minsStart = $request->minsStart;
        $event->hourEnd = $request->hourEnd;
        $event->minsEnd = $request->minsEnd;
        // $event->hourStart = $hourStart;
        // $event->hourEnd = $hourEnd;

        if($request->eventType == 'Normal'){
          $event->color = 'blue';
        }elseif($request->eventType == 'Importante'){
          $event->color = 'red';
        }elseif($request->eventType == 'Recordatorio'){
          $event->color = 'yellow';
        }

        $event->medico_id = $request->medico_id;
        $event->save();

        return redirect()->route('medico_diary',$request->medico_id)->with('success2','Nuevo Evento Guardado');

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

    public function update(Request $request, $id)
    {



      $hourStart = $request->hourStart.':'.$request->minsStart.':'.'00';

      $start = $request->date_start.' '.$request->hourStart.':'.$request->minsStart.':'.'00';

      if($request->date_End == Null){
        $date_End = $request->date_start;
      }else{
        $date_End = $request->date_End;
      }

      if($request->hourEnd == '--' or $request->minsEnd == '--'){
        $hourEnd = $request->hourStart.':'.$request->minsStart.':'.'00';
        $end = $date_End.' '.$request->hourStart.':'.$request->minsStart.':'.'00';

      }else{

        $end = $date_End.' '.$request->hourEnd.':'.$request->minsEnd.':'.'00';

        $hourEnd = $request->hourEnd.':'.$request->minsEnd.':'.'00';
      }

    //  \Carbon\Carbon::parse()
      $event = event::find($request->event_id);
      $event->title = $request->title;
      $event->eventType = $request->eventType;
      $event->start = $start;
      $event->end = $end;

      $event->dateStart = $request->date_start;
      $event->dateEnd = $date_End;
      $event->hourStart = $request->hourStart;
      $event->minsStart = $request->minsStart;
      $event->hourEnd = $request->hourEnd;
      $event->minsEnd = $request->minsEnd;
      // $event->hourStart = $hourStart;
      // $event->hourEnd = $hourEnd;

      if($request->eventType == 'Normal'){
        $event->color = 'blue';
      }elseif($request->eventType == 'Importante'){
        $event->color = 'red';
      }elseif($request->eventType == 'Recordatorio'){
        $event->color = 'yellow';
      }

      $event->medico_id = $request->medico_id;
      $event->save();

      return redirect()->route('medico_diary',$request->medico_id)->with('success','Nuevo Evento Guardado');

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
        return back()->with('success', 'evento Eliminado');
    }
}
