<?php namespace App\Http\Controllers;
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
use App\state;
use App\city;
use App\consulting_room;
use Illuminate\Pagination\LengthAwarePaginator;
      class HomeController extends Controller
      {

        public function __construct(){
          $states = state::orderby('name','asc')->pluck('name','id');
          $cities = city::orderby('name','asc')->pluck('name','name');
          $this->states = $states;
          $this->cities = $cities;

        }
        public function home(){
          // $myCoordinates = Geocoder::getCoordinatesForAddress('calle paez,1404');
          // dd($myCoordinates);
          $medicos_json = '';
          if(auth::check()){
            $user = user::find(Auth::user()->id);
            return view('home.home')->with('user', $user)->with('medicos_json', $medicos_json)->with('states', $this->states)->with('cities',$this->cities);
          }

          return view('home.home')->with('medicos_json', $medicos_json)->with('states', $this->states)->with('cities',$this->cities);

        }


        public function calculate_dist_to_array($medicos,$dist){
          $data = [];
          //ordenar array

          foreach ($medicos as $medico) {
            //Haversine

            $myLat = deg2rad(32.62);
            //$myLat = deg2rad($myCoordinates['lat']);

            $myLng = deg2rad(-115.4522623);
            //$myLng = deg2rad($myCoordinates['lng']);

            $medicLat = deg2rad($medico->latitud);
            $medicLng = deg2rad($medico->longitud);

            $latDelta = $medicLat - $myLat;
            $lonDelta = $medicLng - $myLng;

            $earthRadius = 6371; //en km

            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($myLat) * cos($medicLat) * pow(sin($lonDelta / 2), 2)));
            $distCalculate =  $angle * $earthRadius;

            if($dist > $distCalculate or $dist == Null){
              $consulting_room = consulting_room::where('medico_id',$medico->id)->get()->toArray();

              $data[$medico->id] = ['id'=>$medico->id,'name'=>$medico->name,'lastName'=>$medico->lastName,'cityName'=>$medico->cityName,'stateName'=>$medico->stateName,'dist'=>$distCalculate,'consulting_room'=>$consulting_room,'specialty'=>$medico->specialty,'sub_specialty'=>$medico->sub_specialty
            ];

            }
          }
          return $data;
        }

        public function create_array_medicos($medicos){

          $data = [];
          foreach ($medicos as $medico) {
          $consulting_room = consulting_room::where('medico_id',$medico->id)->get()->toArray();

          $data[$medico->id] = ['id'=>$medico->id,'name'=>$medico->name,'lastName'=>$medico->lastName,'cityName'=>$medico->cityName,'stateName'=>$medico->stateName,'consulting_room'=>$consulting_room,'specialty'=>$medico->specialty,'sub_specialty'=>$medico->sub_specialty];
          }
          return $data;
        }

        public function paginate_custom($data,$currentPage){

          $col = new Collection($data);
          $perPage = 4;
          $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
          $medicosCerc = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
          $medicosCerc->setPath(route('tolist2'));
          return $medicosCerc;
        }

        public function tolist2(Request $request){

          if(isset($request->typeSearchSpecialty)){ //necesario
            $typeSearchSpecialty = $request->typeSearch2;
          }else{
            $typeSearchSpecialty = null;
          }

          //**Especialidad medica
          if($request->typeSearch == 'Especialidad Medica' or $request->typeSearch2 == 'Especialidad Medica'){
            //**Especialidad medica x ciudad**/
            if($request->city != null){
              if($request->city != 'ciudad'){

                $medicos = DB::table('medicos')
                //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
                ->Join('cities', 'medicos.city_id', '=', 'cities.id')
                ->Join('states', 'medicos.state_id', '=', 'states.id')
                ->select('medicos.*','cities.longitud as longitud','cities.latitud as latitud','cities.name as cityName','states.name as stateName')
                ->where('medicos.specialty','=',$request->search)
                ->Where('cities.name','=',$request->city)
                ->get();


                  $data = HomeController::create_array_medicos($medicos);
                  $currentPage = LengthAwarePaginator::resolveCurrentPage();
                  $medicosCerc = HomeController::paginate_custom($data,$currentPage);
                  $medicosCercCount = count($medicosCerc);

                  return view('home.home')->with('medicosCerc', $medicosCerc)->with('data', $data)->with('medicosCercCount', $medicosCercCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('states', $this->states)->with('cities',$this->cities);
              }
            }
            //**Especialidad medica por distancia**///
            $dist = $request->dist;

            $medicos = DB::table('medicos')
            //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
            ->Join('cities', 'medicos.city_id', '=', 'cities.id')
            ->Join('states', 'medicos.state_id', '=', 'states.id')
            ->select('medicos.*','cities.longitud as longitud','cities.latitud as latitud','cities.name as cityName','states.name as stateName')
            ->where('medicos.specialty','=',$request->search)
            ->orWhere('medicos.sub_specialty','=',$request->search)
            ->get();

            //dd($medicos->cityName);
          $data = HomeController::calculate_dist_to_array($medicos,$dist);
          $currentPage = LengthAwarePaginator::resolveCurrentPage();
          $medicosCerc = HomeController::paginate_custom($data,$currentPage);
          $medicosCercCount = count($medicosCerc);

          return view('home.home')->with('medicosCerc', $medicosCerc)->with('data', $data)->with('medicosCercCount', $medicosCercCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('states', $this->states)->with('cities',$this->cities);
        }

        //NOMBRE/celdula DEL MEDICO//NOMBRE DEL MEDICO//NOMBRE DEL MEDICO
          //**Especialidad medica x CIUDAD**/
        if($request->typeSearch == 'Nombre/Cedula del Medico'){


          if($request->city != null){
            if($request->city != 'ciudad'){

              $medicos = DB::table('medicos')
              //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
              ->Join('cities', 'medicos.city_id', '=', 'cities.id')
              ->Join('states', 'medicos.state_id', '=', 'states.id')
              ->select('medicos.*','cities.longitud as longitud','cities.latitud as latitud','cities.name as cityName','states.name as stateName')
              //->where('cities.name','=',$request->city)
              ->where('medicos.name','LIKE','%'.$request->search.'%')
              ->orWhere('medicos.lastName','LIKE','%'.$request->search.'%')
              ->orWhere('medicos.identification','LIKE','%'.$request->search.'%')
              ->get();


              $data = [];
              foreach ($medicos as $medico) {

                if($medico->cityName == $request->city){
                  $consulting_room = consulting_room::where('medico_id',$medico->id)->get()->toArray();

                  $data[$medico->id] = ['id'=>$medico->id,'name'=>$medico->name,'lastName'=>$medico->lastName,'cityName'=>$medico->cityName,'stateName'=>$medico->stateName,'specialty'=>$medico->specialty,'sub_specialty'=>$medico->sub_specialty,'consulting_room'=>$consulting_room
                ];
                }
              }


              $currentPage = LengthAwarePaginator::resolveCurrentPage();
              $medicosCerc = HomeController::paginate_custom($data,$currentPage);
              $medicosCercCount = count($medicosCerc);

              return view('home.home')->with('medicosCerc', $medicosCerc)->with('data', $data)->with('medicosCercCount', $medicosCercCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('typeSearchSpecialty', $typeSearchSpecialty)->with('states', $this->states)->with('cities',$this->cities);

            }

            }

          }

          //busqueda nombre
        $dist = $request->dist;

        $medicos = DB::table('medicos')
        //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
        ->Join('cities', 'medicos.city_id', '=', 'cities.id')
        ->Join('states', 'medicos.state_id', '=', 'states.id')
        ->select('medicos.*','cities.longitud as longitud','cities.latitud as latitud','cities.name as cityName','states.name as stateName')
        ->where('medicos.name','LIKE','%'.$request->search.'%')
        ->orWhere('medicos.lastName','LIKE','%'.$request->search.'%')
        ->get();


      $data = HomeController::calculate_dist_to_array($medicos,$dist);

      $data = collect($data)->sortBy('dist')->toArray();

      $currentPage = LengthAwarePaginator::resolveCurrentPage();
      $medicosCerc = HomeController::paginate_custom($data,$currentPage);
      $medicosCercCount = count($medicosCerc);

      return view('home.home')->with('medicosCerc', $medicosCerc)->with('data', $data)->with('medicosCercCount', $medicosCercCount)->with('search', $request->search)->with('currentPage', $currentPage)->with('typeSearchSpecialty', $typeSearchSpecialty)->with('states', $this->states)->with('cities',$this->cities);
    //fin NOMBRE/CEDULA MEDIC

      }

      public function tolist3(Request $request){
        $numberPageNow = ($request->numberPageNow * 4) -4;


        $dist = $request->dist;
        //$myCoordinates = Geocoder::getCoordinatesForAddress('mexicali,mexico');

        //$CoordinatesMedic = Geocoder::getCoordinatesForAddress('tijuana,mexico');

        $medicos = DB::table('medicos')
        //->Join('medico_specialties', 'medicos.id', '=', 'medico_specialties.medico_id')
        ->Join('cities', 'medicos.city_id', '=', 'cities.id')
        ->Join('states', 'medicos.state_id', '=', 'states.id')
        ->select('medicos.*','cities.longitud as longitud','cities.latitud as latitud','cities.name as cityName','states.name as stateName')
        ->where('medicos.name','LIKE','%'.$request->search.'%')
        ->orWhere('medicos.lastName','LIKE','%'.$request->search.'%')
        ->get();

        //dd($medicos->cityName);


        $data = [];

        //ordenar array

        foreach ($medicos as $medico) {
          //Haversine


          $myLat = deg2rad(32.62);
          //$myLat = deg2rad($myCoordinates['lat']);

          $myLng = deg2rad(-115.4522623);
          //$myLng = deg2rad($myCoordinates['lng']);

          $medicLat = deg2rad($medico->latitud);
          $medicLng = deg2rad($medico->longitud);

          $latDelta = $medicLat - $myLat;
          $lonDelta = $medicLng - $myLng;

          $earthRadius = 6371; //en km

          $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
          cos($myLat) * cos($medicLat) * pow(sin($lonDelta / 2), 2)));
          $distCalculate =  $angle * $earthRadius;


          if($dist > $distCalculate){

            $data[$medico->id] = ['id'=>$medico->id,'name'=>$medico->name,'lastName'=>$medico->lastName,'cityName'=>$medico->cityName,'stateName'=>$medico->stateName,'dist'=>$distCalculate,'lng'=>$medico->longitud,'lat'=>$medico->latitud];

          }
        }

        $data = collect($data)->sortBy('dist')->toArray();
        $data = array_slice($data,$numberPageNow, 4);
        return response()->json($data);

      }


      public function specialtyList1(Request $request){
        $specialties = specialty::where('specialty_category_id',1)->orderBy('name','asc')->get();
        $specialtiesCount = specialty::where('specialty_category_id',1)->count();
        $category = $request->typeSearch;
        return view('home.home')->with('specialties', $specialties)->with('specialtiesCount', $specialtiesCount)->with('category', $category)->with('states', $this->states)->with('cities',$this->cities);
      }

      public function specialtyList2(Request $request){
        $specialties = specialty::where('specialty_category_id',2)->orderBy('name','asc')->get();
        $specialtiesCount = specialty::where('specialty_category_id',2)->count();
        $category = $request->typeSearch;
        return view('home.home')->with('specialties', $specialties)->with('specialtiesCount', $specialtiesCount)->with('category', $category)->with('states', $this->states)->with('cities',$this->cities);
      }

      public function specialtyList3(Request $request){
        $specialties = specialty::where('specialty_category_id',3)->orderBy('name','asc')->get();
        $specialtiesCount = specialty::where('specialty_category_id',3)->count();
        $category = $request->typeSearch;
        return view('home.home')->with('specialties', $specialties)->with('specialtiesCount', $specialtiesCount)->with('category', $category)->with('states', $this->states)->with('cities',$this->cities);
      }

      public function specialtyList4(Request $request){
        $specialties = specialty::where('specialty_category_id',4)->orderBy('name','asc')->get();
        $specialtiesCount = specialty::where('specialty_category_id',4)->count();
        $category = $request->typeSearch;
        return view('home.home')->with('specialties', $specialties)->with('specialtiesCount', $specialtiesCount)->with('category', $category)->with('states', $this->states)->with('cities',$this->cities);
      }


      public function prueba(){

      }
}
