<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\plan;
use App\city;
use App\cities_plan;
use App\medico;
use App\specialty;
//use App\specialty_category;

class plansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  

     public function planes_medic($id){
       $medico = medico::find($id);

       $specialty = specialty::where('name', $medico->specialty)->first();


       if($specialty->specialty_category->name != 'Medicos y Especialistas'){
         $plan_basico = plan::where('name','Plan Basico')->where('applicable','!=','Medicos y Especialistas' )->where('applicable','!=','Nucleos Medicos')->first();

          $plan_mi_agenda = plan::where('name','Plan Mi Agenda')->where('applicable','!=','Medicos y Especialistas' )->where('applicable','!=','Nucleos Medicos')->first();

          $plan_profesional = plan::where('name','Plan Profesional')->where('applicable','!=','Medicos y Especialistas' )->where('applicable','!=','Nucleos Medicos')->first();

          $plan_platino = plan::where('name','Plan Platino')->where('applicable','!=','Medicos y Especialistas' )->where('applicable','!=','Nucleos Medicos')->first();



       }else{

         $plan_basico = plan::where('name','Plan Basico')->where('applicable',$specialty->specialty_category->name )->first();

         $plan_mi_agenda = plan::where('name','Plan Mi Agenda')->where('applicable', $specialty->specialty_category->name)->first();

         $plan_profesional = plan::where('name','Plan Profesional')->where('applicable', $specialty->specialty_category->name)->first();

         $plan_platino = plan::where('name','Plan Platino')->where('applicable', $specialty->specialty_category->name)->first();

       }


       return view('plans.professional-promotions',compact('plan_mi_agenda','plan_profesional','plan_platino'));
     }

     public function planes(){
       return view('plans.professional-promotions');
     }

    public function index()
    {
        $plans1 = plan::where('applicable','Medicos y Especialistas')->get();

        $plans2 = plan::where('applicable','Medicina Alternativa, Psicologos y Terapeutas')->get();

        $plans3 = plan::where('applicable','Nucleos Medicos')->get();

        return view('plans.index')->with('plans1', $plans1)->with('plans2', $plans2)->with('plans3', $plans3);

    }

    public function deleteCityplan($id)
    {
        $cities_plan = cities_plan::find($id);
        $city1 = $cities_plan->name;
        cities_plan::destroy($id);

        return back()->with('danger', 'Se ha desabilitado la ciudad '.$city1.' para este Plan');
    }


    public function citiesPlansStore(Request $request)
    {
      $request->validate([
        'name'=> 'required|'.Rule::unique('cities_plans')->where('plan_id',$request->plan_id),
      ]);

        $city = new cities_plan;
        $city->name = $request->name;
        $city->plan_id = $request->plan_id;
        $city->save();

        $plan = plan::find($request->plan_id);
        return back()->with('success', 'Se a asigando una nueva ciudad al Plan: '.$plan->name);
    }

      public function citiesPlans($id)
      {
          $citiesAll = city::orderBy('name','asc')->pluck('name','name');
          $citiesPlans = cities_plan::where('plan_id',$id)->paginate(10);

          $plan = plan::find($id);

          return view('plans.citiesPlans')->with('citiesPlans', $citiesPlans)->with('citiesAll', $citiesAll)->with('plan', $plan);
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
    public function store(Request $request)
    {
        $request->validate([
          'price'=>'required|numeric'
        ]);

        $plan = plan::find($request->plan_id);
        $plan->price = $request->price;
        $plan->save();

        return back()->with('success', 'El precio del plan: '.$plan->name.' ha sido Cambiado con Exito');
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
