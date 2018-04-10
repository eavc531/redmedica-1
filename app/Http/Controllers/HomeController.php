<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\User;
use App\medico;
use App\medicalCenter;
use App\specialty;
use App\medico_specialty;
use DB;
use Auth;
use Geocoder;
use Illuminate\Pagination\LengthAwarePaginator;
class HomeController extends Controller
{
    public function home(){
      $medicos_json = '';
      if(auth::check()){
        $user = user::find(Auth::user()->id);
        return view('home.home')->with('user', $user)->with('medicos_json', $medicos_json);
      }

      return view('home.home')->with('medicos_json', $medicos_json);;

    }

    public function tolist(Request $request){
      // medico::where('name','LIKE','%'.$request->search.'%')->

      $request->validate([
        'typeSearch'=>'required'
      ]);

      $searchActive = 'Active';

      if($request->typeSearch == 'Dentistas'){
        $medicos2 = DB::table('medicos')
              ->leftJoin('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
              ->select('medicos.*','medico_specialties.specialty')
              ->where('specialty_category','Dentistas')
              ->paginate(10);

        $medicosCount2 = DB::table('medicos')
              ->join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
              ->select('medicos.*','medico_specialties.specialty')
              ->where('specialty_category','Dentistas')
              //->distinct() // el count no nota la diferencia del distinct
              ->count();


          return view('home.home')->with('medicos2', $medicos2)->with('medicosCount2', $medicosCount2)->with('searchActive', $searchActive)->with('search', $request->typeSearch);
      }

      if($request->typeSearch == 'Terapeutas y Nutricion'){
        $medicos2 = DB::table('medicos')
              ->leftJoin('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
              ->select('medicos.*','medico_specialties.specialty')
              ->where('specialty_category','Terapeutas y Nutricion')
              ->paginate(10);

        $medicosCount2 = DB::table('medicos')
              ->join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
              ->select('medicos.*','medico_specialties.specialty')
              ->where('specialty_category','Terapeutas y Nutricion')
              //->distinct() // el count no nota la diferencia del distinct
              ->count();


          return view('home.home')->with('medicos2', $medicos2)->with('medicosCount2', $medicosCount2)->with('searchActive', $searchActive)->with('search', $request->typeSearch);
      }

      if($request->typeSearch == 'Medico'){
        $medicos = medico::where('name','LIKE','%'.$request->search.'%')->orWhere('lastName','LIKE','%'.$request->search.'%')->paginate(9);
        $medicosCount = medico::where('name','LIKE','%'.$request->search.'%')->orWhere('lastName','LIKE','%'.$request->search.'%')->count();

        return view('home.home')->with('medicos', $medicos)->with('medicosCount', $medicosCount)->with('searchActive', $searchActive)->with('search', $request->search);
      }

      if($request->typeSearch == 'Centro Medico'){
        $medicalCenters = medicalCenter::where('name','LIKE','%'.$request->search.'%')->orderBy('name','asc')->paginate(10);
        $medicalCentersCount = medicalCenter::where('name','LIKE','%'.$request->search.'%')->count();

        return view('home.home')->with('medicalCenters', $medicalCenters)->with('medicalCentersCount', $medicalCentersCount)->with('searchActive', $searchActive)->with('search', $request->search);
      }

      if($request->typeSearch == 'Especialidad'){
        $specialties = specialty::where('name','LIKE','%'.$request->search.'%')->orderBy('name','asc')->paginate(10);
         $specialtyCount = specialty::where('name','LIKE','%'.$request->search.'%')->count();

          return view('home.home')->with('specialties', $specialties)->with('specialtyCount', $specialtyCount)->with('searchActive', $searchActive)->with('search', $request->search);
      }

      if($request->typeSearch == 'Medicos y Especialistas'){

        $medicos2 = DB::table('medicos')
              ->leftJoin('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
              ->select('medicos.*','medico_specialties.specialty')
              ->where('specialty_category','Medicos y Especialistas')
              ->paginate(10);

        $medicosCount2 = DB::table('medicos')
              ->join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
              ->select('medicos.*','medico_specialties.specialty')
              ->where('specialty_category','Medicos y Especialistas')
              //->distinct() // el count no nota la diferencia del distinct
              ->count();


          return view('home.home')->with('medicos2', $medicos2)->with('medicosCount2', $medicosCount2)->with('searchActive', $searchActive)->with('search', $request->typeSearch);
      }

    }






    public function tolist2(Request $request){

      $dist = 20200;
    $myCoordinates = Geocoder::getCoordinatesForAddress('mexicali,mexico');

      //$CoordinatesMedic = Geocoder::getCoordinatesForAddress('tijuana,mexico');

      $medicos = DB::table('medicos')
            //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
            ->Join('cities', 'medicos.city_id', '=', 'cities.id')
            ->Join('states', 'medicos.state_id', '=', 'states.id')
            ->select('medicos.*','cities.longitud as longitud','cities.latitud as latitud','cities.name as cityName','states.name as stateName')
            ->get();

           //dd($medicos->cityName);


            $data = [];

            //ordenar array

            foreach ($medicos as $medico) {
              //Haversine

              $myLat = -115.45;
              //deg2rad($myCoordinates['lat']);
              $myLng = 	32.62;
              //deg2rad($myCoordinates['lng']);

              $medicLat = deg2rad($medico->latitud);
              $medicLng = deg2rad($medico->longitud);

              $latDelta = $medicLat - $myLat;
              $lonDelta = $medicLng - $myLng;

              $earthRadius = 6371; //en km

              $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
              cos($myLat) * cos($medicLat) * pow(sin($lonDelta / 2), 2)));
              $distCalculate =  $angle * $earthRadius;

              if($dist > $distCalculate){

                $data[$medico->id] = ['id'=>$medico->id,'name'=>$medico->name,'lastName'=>$medico->lastName,'cityName'=>$medico->cityName,'stateName'=>$medico->stateName,'dist'=>$distCalculate];

              }
            }


            //$array = collect($array)->sortBy('count')->reverse()->toArray();

            //Convertir array a encode jason y poder manipular con javascript
      //$medicos_json = json_encode($data);

      $currentPage = LengthAwarePaginator::resolveCurrentPage();
      $col = new Collection($data);
      $perPage = 5;
      $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();

      $medicosCerc = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);

      $medicosCerc->setPath(route('tolist2'));

      $medicosCercCount = count($medicosCerc);


      return view('home.home')->with('medicosCerc', $medicosCerc)->with('data', $data)->with('medicosCercCount', $medicosCercCount)->with('search', $request->typeSearch);

    }

    public function tolist3(Request $request){
      $dist = 20000;
    $myCoordinates = Geocoder::getCoordinatesForAddress('mexicali,mexico');
    //$CoordinatesMedic = Geocoder::getCoordinatesForAddress('tijuana,mexico');

      $medicos = DB::table('medicos')
            //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
            ->Join('cities', 'medicos.city_id', '=', 'cities.id')
            ->Join('states', 'medicos.state_id', '=', 'states.id')
            ->select('medicos.*','cities.longitud as longitud','cities.latitud as latitud','cities.name as cityName','states.name as stateName')
            ->get();

            $data = [];

            foreach ($medicos as $medico) {
              //Haversine
              $myLat = deg2rad($myCoordinates['lat']);
              $myLng = deg2rad($myCoordinates['lng']);


              $medicLat = deg2rad($medico->latitud);
              $medicLng = deg2rad($medico->longitud);

              $latDelta = $medicLat - $myLat;
              $lonDelta = $medicLng - $myLng;

              $earthRadius = 6371; //en km

              $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
              cos($myLat) * cos($medicLat) * pow(sin($lonDelta / 2), 2)));
              $distCalculate =  $angle * $earthRadius;

              if($dist > $distCalculate){

                $data[$medico->id] = ['id'=>$medico->id,'name'=>$medico->name,'lastName'=>$medico->lastName,'cityName'=>$medico->cityName,'stateName'=>$medico->stateName,'dist'=>$distCalculate,'lat'=>$medico->latitud,'lng'=>$medico->longitud];

              }
            }

            return response()->json($data);

    }

    public function prueba(){

    }
}
