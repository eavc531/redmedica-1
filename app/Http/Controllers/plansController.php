<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\plan;
use App\city;
use App\cities_plan;
class plansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
