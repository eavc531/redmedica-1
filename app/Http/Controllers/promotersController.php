<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\promoter;
use App\User;
use App\Role;
use App\medicalCenter;
use App\medico;

class promotersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function clientsPromoter($id)
     {

       $promoter = promoter::find($id);

       $medicalCenters = medicalCenter::where('id_promoter',$promoter->id_promoter)->orderBy('name','asc')->paginate(10);

       $medicos = medico::where('id_promoter',$promoter->id_promoter)->orderBy('id','desc')->paginate(10);

         return view('promoters.clientsPromoter')->with('medicalCenters', $medicalCenters)->with('medicos', $medicos)->with('promoter', $promoter);
     }

    public function index()
    {

      $promoters = promoter::orderBy('id','desc')->paginate(10);
        return view('promoters.index')->with('promoters', $promoters);
    }

    public function citiesAdmin($id)
    {
        $citiesAll = city::orderBy('name','asc')->pluck('name','name');
        $cities = cities_admin::where('administrator_id',$id)->paginate(10);

        $administrator = administrator::find($id);

        return view('administrators.citiesAdmin')->with('cities', $cities)->with('citiesAll', $citiesAll)->with('administrator', $administrator);
    }

    public function deleteCityAdmin($id)
    {

        $cities_admin = cities_admin::find($id);

        $city1 = $cities_admin->name;
        cities_admin::destroy($id);

        return back()->with('danger', 'Se ha desabilitado la ciudad '.$city1.' para este Administrador');
    }

    public function citiesAdminStore(Request $request)
    {
      $request->validate([
        'name'=>'required|unique:cities_admins',

      ]);

        $cities_admin = new cities_admin;
        $cities_admin->name = $request->name;
        $cities_admin->administrator_id = $request->administrator_id;
        $cities_admin->save();

        $administrator = administrator::find($request->administrator_id);
        return back()->with('success', 'Se a asigando una nueva ciudad al Administrador: '.$administrator->name.' '.$administrator->lastName);
    }
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('promoters.create');
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
           'id_promoter'=>'required|unique:promoters',
           'name'=>'required',
           'lastName'=>'required',
           'email'=>'required|unique:promoters|unique:users',
           'password'=>'required',
        ]);

        $promoter = new promoter;
        $promoter->fill($request->all());
        $promoter->save();

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->promoter_id = $promoter->id;
        $user->save();
        $role = Role::where('name','Admin')->first();

        $user->attachRole($role);
         return redirect()->route('promoters.index')->with('success', 'Se ha agregado un nuevo promotor de forma Satisfactoria');

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
      $medico = medico::find($id);
        return view('medico.edit')->with('medico', $medico);
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
