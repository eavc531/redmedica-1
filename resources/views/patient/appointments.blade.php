@extends('layouts.app')

@section('content')
  <section class="box-register">

		<div class="container">

			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h2 class="text-center font-title">Citas Médicas @if(isset($pending)){{$pending}}@elseif(isset($unrated)){{$unrated}}@endif</h2>
						<hr>
					</div>
				</div>
        <div class="mb-2">
          <a href="{{route('patient_appointments',$patient->id)}}" class="btn btn-primary">Todas</a>
          <a href="{{route('patient_appointments_pending',$patient->id)}}" class="btn btn-primary">Pendientes</a>
          <a href="{{route('patient_appointments_unrated',$patient->id)}}" class="btn btn-primary">Sin Calificar</a>
        </div>
        @if($appointments->first() != Null)
        <div class="row">
          @foreach ($appointments as $app)
            <div class="card mb-2" style="width:100%">
              <div class="card-body">
                <p>Tipo de Cita: {{$app->title}}</p>
                <p>Medico: <a href="{{route('medico.edit',$app->medico->id)}}"><strong>{{$app->medico->name}} {{$app->medico->lastName}}</strong></a></p>
                <p>Especialidad del Medico: {{$app->medico->scpecialty}}</p>
                @isset($app->descriptión)
                <p>Mensaje o descriptión: {{$app->descriptión}}</p>
                @endisset
                <p>Fecha: {{\Carbon\Carbon::parse($app->hour_start)->format('d-m-Y')}}</p>
                <p>Hora: {{\Carbon\Carbon::parse($app->hour_start)->format('H:i')}}</p>
                <p>Estado: {{$app->state}}</p>
                <p>Estrellas Otorgadas: {{$app->score}}</p>
                <p>Calificación: {{$app->calification}}</p>
                <p>Comentario al Respecto: {{$app->comentary}}</p>

                <a href="{{route('rate_appointment',$app->id)}}" class="btn btn-success">Calificar Cita</a>

              </div>

            </div>
          @endforeach
          <div class="card-heading">
            {{$appointments->appends(Request::all())->links()}}
          </div>
        </div>
      @else
        <div class="text-center">
          <h4 class="text-primary">No ahi registro de Citas Agendadas</h4>
        </div>

      @endif
			</div>
		</div>
	</section>
@endsection
