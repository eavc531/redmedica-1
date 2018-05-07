@extends('layouts.app')

@section('content')
  <section class="box-register">

		<div class="container">

			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h2 class="text-center font-title">Calificar Cita con Médico: {{$app->medico->name}} {{$app->medico->lastName}} </h2>
						<hr>
					</div>
				</div>
        <div class="row">
          <div class="col-6">

          </div>
          <div class="col-6 text-right">
            <a href="{{route('patient_appointments',$app->patient_id)}}" class="btn btn-secondary">Atras</a>
          </div>
        </div>
        <div class="row">

            <div class="card">
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

                {{--}}@isset($app->medico->phoneOffice1) Teléfono 1: {{$app->medico->phoneOffice1}}@endisset
                @isset($app->medico->phoneOffice2) Teléfono 2: {{$app->medico->phoneOffice2}}@endisset --}}

              </div>
              <div class="card-footer">
                <div class="form-group">
                  @if($app->score == Null)
                  <strong>Calificar Cita</strong>
                  @else
                  <strong>Editar Cita</strong>
                  @endif
                </div>
                {!!Form::model($app,['route'=>'store_rate_comentary','method'=>'POST'])!!}
                <div class="form-group">
                    <p>Calificación sobre el servicio del Médico: </p>
                    {{Form::radio('score',1)}} Muy Malo {{Form::radio('score',2)}} Malo {{Form::radio('score',3)}} Regular {{Form::radio('score',4)}} Bueno {{Form::radio('score',5)}} Muy Bueno
                </div>
                <div class="form-group">
                  <label for="">Comentario sobre la Cita:</label>
                  {!!Form::textarea('comentary',null,['class'=>'form-control','style'=>'height:100px'])!!}

                  <input type="hidden" name="event_id" value="{{$app->id}}">
                </div>
                  <input type="submit" name="" value="Guardar" class="btn btn-success">
                    <a href="{{route('patient_appointments',$app->patient_id)}}" class="btn btn-secondary">Cancelar</a>
                {!!Form::close()!!}
              </div>
            </div>


        </div>
			</div>
		</div>
	</section>
@endsection
