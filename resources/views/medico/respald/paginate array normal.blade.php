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


function pag_next(){
//
//    skipnow = $('#paginate_skip').val();
//    skip = parseInt(skipnow) + parseInt(2);
//    $('#paginate_skip').val(skip);
//    route = "{{route('tolist')}}";
//    var search = $('#searchVar').val();
//
//       $.ajax({
//          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//          type:'post',
//          url: route,
//          data:{search:search,skip:skip},
//          success:function(result){
//             $('#listSearchAjax').empty().html(result);
//             console.log(result);
//          },
//          error:function(error){
//             console.log(error);
//          },
//       });
//    }
//
//    function pag_prev(){
//
//       skipnow = $('#paginate_skip').val();
//
//       skip = parseInt(skipnow) - parseInt(2);
//       if(skip < 0){
//         $('#paginate_skip').val(0);
//       }else{
//         $('#paginate_skip').val(skip);
//       }
//
//       route = "{{route('tolist')}}";
//       var search = $('#searchVar').val();
//
//          $.ajax({
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             type:'post',
//             url: route,
//             data:{search:search,skip:skip},
//             success:function(result){
//                $('#listSearchAjax').empty().html(result);
//                console.log(result);
//             },
//             error:function(error){
//                console.log(error);
//             },
//          });
//       }


{{-- Busqueda Medicos por Categoria --}}
@if(isset($medicosCount2) and $medicosCount2 != 0)
  <div class="card">

    <div class="card-header">
      <a href="{{route('home')}}" class="close"><span aria-hidden="true">&times;</span></a>
      <h4>Busqueda de Medico Por Categoria: {{$search}}</h4>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <thead class="bg-primary text-white">
          <tr>
            <td>Nombre Completo</td>
            <td>Especialidad</td>
            <td>Ciudad</td>
            <td>Acciones</td>
          </tr>
        </thead>
        <tbody>
          @foreach ($medicos2 as $medico)
            <tr>
              <td>
                {{$medico->name}} {{$medico->lastName}}
              </td>
              <td>
                {{$medico->specialty}}
              </td>
              <td>
                {{$medico->city}}
              </td>
              <td>
                <a href="{{route("medico_perfil",$medico->id)}}" class="btn btn-primary">Ver Perfil</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      {{$medicos2->appends(Request::only(['typeSearch']))->links()}}
    </div>
  </div>
@elseif(isset($medicosCount2))
  <div class="card">
    <div class="card-body">
      <h5>No se Encontraron Resultados para la Busqueda de Medico: "{{$search}}"</h5>

    </div>
  </div>
@endif

{{-- Centros Medicos --}}
<div class="text-justify mt-3">
  @if(isset($medicalCentersCount) and $medicalCentersCount != 0)
    <div class="card">
      <div class="card-header">
        <a href="{{route('home')}}" class="close"><span aria-hidden="true">&times;</span></a>
        <h4>Busqueda de Centro Medico:{{$search}}</h4>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead class="bg-primary text-white">
            <tr>
              <td>Nombre</td>
              <td>Ciudad</td>
              <td>Acciones</td>
            </tr>
          </thead>
          <tbody>
            @foreach ($medicalCenters as $mC)
              <tr>
                <td>{{$mC->name}}</td>
                <td>{{$mC->city}}</td>
                <td><a href="" class="btn btn-primary"><i class="far fa-hospital" data-toggle="tooltip" data-placement="top" title="Ver Perfil"></i></a> <a href="" class="btn btn-success"><i class="fas fa-user-md" data-toggle="tooltip" data-placement="top" title="Ver Medicos"></i></a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        {{$medicalCenters->appends(Request::only(['typeSearch','search']))->links()}}
      </div>
    </div>
  @elseif(isset($medicalCentersCount))
    <div class="card">
      <div class="card-body">
        <h5>No se Encontraron Resultados para la Busqueda del Centro Medico: "{{$search}}"</h5>
        <a href="{{route('home')}}" class="close"><span aria-hidden="true">&times;</span></a>
      </div>
    </div>
  @endif

  {{-- especialidades --}}
  <div class="text-justify mt-3">
    @if(isset($specialtyCount) and $specialtyCount != 0)
      <div class="card">
        <div class="card-header">
          <a href="{{route('home')}}" class="close"><span aria-hidden="true">&times;</span></a>
          <h4>Busqueda de Especialidad Médica: {{$search}}</h4>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead class="bg-primary text-white">
              <tr>
                <td>Nombre</td>
                <td>Medicos</td>
              </tr>
            </thead>
            <tbody>
              @foreach ($specialties as $specialty)
                <tr>
                  <td>{{$specialty->name}}</td>
                  <td><a href="" class="btn btn-success"><i class="fas fa-user-md" data-toggle="tooltip" data-placement="top" title="Ver Medicos"></i></a></td>
                </tr>
              @endforeach
            </tbody>

          </table>

        </div>
        <div class="card-footer">
          {{$specialties->appends(Request::only(['typeSearch','search']))->links()}}
        </div>
      </div>

    @elseif(isset($specialtyCount) and $specialtyCount == 0)
      <div class="card">
        <div class="card-body">
          <h5>No se Encontraron Resultados para la Busqueda de Especialidad Médica: "{{$search}}"</h5>
        </div>
      </div>
    @endif

    {{-- //map  //map  //map  //map  //map  //map --}}
    <div id="map" style="width:300px">

    </div>
    @isset($medicosCercCount)
      <input type="hidden" name="" value="{{$medicosCercCount}}" id="searchCount">
    @endisset

  //PAGINATION PARA ajax
