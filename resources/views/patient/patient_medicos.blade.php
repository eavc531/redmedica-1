@extends('layouts.app')

@section('content')
  <section class="box-register">

		<div class="container">

			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h2 class="text-center font-title">Mis Médicos @if(isset($pending)){{$pending}}@elseif(isset($unrated)){{$unrated}}@endif</h2>
						<hr>
					</div>
				</div>
        @if($medicos->first() != Null)
        <div class="">
          @foreach ($medicos as $medico)
            <hr>
            <div class="row">

             <div class="col-8 m-auto col-sm-3 col-lg-3">
               <div class="cont-img">
                 @isset($medico['image'])
                 <img src="{{asset($medico['image'])}}" class="prof-img img-thumbnail" alt="..." >
                 @else
                 <img src="{{asset('img/profile.png')}}" class="prof-img img-thumbnail" alt="...">
                 @endisset
               </div>
             </div>
             <div class="col-12 col-sm-5 col-lg-5">
              <div class="card-body p-2">
               <h5 class="card-title title-edit">{{$medico['name']}}</h5>
               <p>Cédula: {{$medico['identification']}}</p>
               <span>Especialidad:</span> <a href="#" class="outstanding mr-2"> {{$medico['specialty']}}</a>
               <div class="star-profile">
                 <ul class="rating mt-1">
                   <li class="star container-franchise__star li-config">&starf;</li>
                   <li class="star container-franchise__star li-config">&starf;</li>
                   <li class="star container-franchise__star li-config">&starf;</li>
                   <li class="star container-franchise__star li-config">&starf;</li>
                   <li class="star container-franchise__star li-config">&starf;</li>
                 </ul>
               </div>
               <div class="row mt-3 align-self-end">
                 <div class="col-12">
                   <p class="card-text"><b>{{$medico['state']}},{{$medico['city']}}</b></p>
                 </div>
               </div>
             </div>
           </div>
           <div class="col-12 col-sm-4 col-lg-4 p-4">
             <div class="form-group">
               {{-- <label for="">Primeras visitas:<b class="price">600MXN</b></label> --}}
               <a class="" href="{{route('medico.edit',$medico['id'])}}"><i class="fas fa-cogs mr-2"></i>Ver perfíl</a>
             </div>
             <div class="form-group">
               @if(Auth::check() and Auth::user()->role == 'Paciente')
               <a href="{{route('stipulate_appointment',$medico['id'])}}" class="btn"><i class="fa fa-envelope-open mr-2"></i>Agendar cita</a>
               @else
               <button onclick="return verifySession()" class="btn"><i class="fa fa-envelope-open mr-2"></i>Agendar cita</button>
               @endif
             </div>
             <div class="form-group">

               <a href="{{route('delete_patient_doctors',$medico->patients_doctor_id)}}" class="btn btn-danger" onclick="return confirm('¿Esta Segur@ de Querer Eliminar este Médico de su lista de Médicos?')">Eliminar de la lista</a>
              {{-- <a href="" class="btn-icon"><i class="fa fa-phone mr-2"></i>Ver Telefono</a> --}}
            </div>
         </div>
       </div>
       <hr>
          @endforeach
          <div class="card-heading">
            {{$medicos->appends(Request::all())->links()}}
          </div>
        </div>
    @else
      <div class="text-center">
        <h4 class="text-primary">No ahi Historial de Médicos con que hallas Interactuado</h4>
      </div>

    @endif
			</div>
		</div>
	</section>
@endsection
