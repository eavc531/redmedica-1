@extends('layouts.app')

@section('content')
<section class="box-register">
  <div class="container">
   <div class="register">
    <div class="row">
      <div class="col-10 mb-3">
      <h2 class="text-center font-title">Calificar Médico: {{$medico->name}} {{$medico->lastName}} </h2>
    </div>
    <div class="col-1 text-right">
      {{-- <a href="{{route('patient_appointments',patient_id)}}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-2"></i>Atras</a> --}}
    </div>
  </div>
   <h5>Ya has Calificado al Médico: {{$medico->name}} {{$medico->lastName}}, pero puedes cambiar tu opinion respecto a tu ultima cita si asi lo prefieres.</h5>

   @if($count_rate == 0)
     <div class="card" id="create">
       {!!Form::model($you_rate,['route'=>'store_rate_comentary','method'=>'POST'])!!}
       {{Form::hidden('medico_id',$medico->id,['class'=> 'mr-1'])}}
       {{Form::hidden('patient_id',$patient->id,['class'=> 'mr-1'])}}
       <p class="m-0">Calificación sobre el servicio del Médico: {{$medico->name}} {{$medico->lastName}}</p>
       <div class="row p-3">
         <div class="col-12 col-lg nopadding">
           <input id="super-admin" checked=false name="rate" value="1" type="radio">  Muy Malo
         </div>
         <div class="col-12 col-lg nopadding">
           {{Form::radio('rate',2,['class'=> 'mr-1'])}}  Malo
         </div>
         <div class="col-12 col-lg nopadding">
           {{Form::radio('rate',3,['class'=> 'mr-1'])}}  Regular
         </div>
         <div class="col-12 col-lg nopadding">
          {{Form::radio('rate',4,['class'=> 'mr-1'])}}  Bueno
        </div>
        <div class="col-12 col-lg nopadding">
          <input id="super-admin" checked='false' name="rate" value="5" type="radio"> Muy Bueno
        </div>

      </div>
      <div class="form-group">
       <label for="" class="font-title-grey">Comentario:</label>
       {!!Form::textarea('comentary',null,['class'=>'form-control','style'=>'height:100px'])!!}
       <input type="submit" name="" value="Guardar" class="btn btn-primary" disabled>

       <a href="{{route('patient_appointments',Auth::user()->patient_id)}}" class="btn btn-secondary">cancelar</a>
        {{Form::close()}}
     </div>

    </div>
    @else

    <div class="card" id="edit">
      {!!Form::model($you_rate,['route'=>'store_rate_comentary','method'=>'POST'])!!}

      <p class="m-0">Tu Calificación otorgada al Médico: {{$medico->name}} {{$medico->lastName}}</p>
      <div class="form-inline">
        <span class="mr-2">Puntaje que otorgaste al Médico: </span> @include('patient.star_rate')
      </div>
     <div class="form-group">
      <label for="" class="font-title-grey">Comentario:</label>
      {!!Form::textarea('comentary',null,['class'=>'form-control','style'=>'height:100px','disabled'])!!}
      <button onclick="editar()" type="button" name="button" class="btn btn-success">Editar</button>

      <a href="{{route('patient_appointments',Auth::user()->patient_id)}}" class="btn btn-secondary">cancelar</a>
       {{Form::close()}}
    </div>

   </div>



   <div class="card" id="create" style="Display:none">
     {!!Form::model($you_rate,['route'=>'store_rate_comentary','method'=>'POST'])!!}
     {{Form::hidden('medico_id',$medico->id,['class'=> 'mr-1'])}}
     {{Form::hidden('patient_id',$patient->id,['class'=> 'mr-1'])}}
     {{Form::hidden('event_id',$event->id,['class'=> 'mr-1'])}}

     <p class="m-0">otorgar Calificación al Médico: {{$medico->name}} {{$medico->lastName}}</p>
     <div class="row p-3">
       <div class="col-12 col-lg nopadding">
         {{Form::radio('rate',1,['class'=> 'mr-1'])}}  Pesimo
       </div>
       <div class="col-12 col-lg nopadding">
         {{Form::radio('rate',2,['class'=> 'mr-1'])}}  Malo
       </div>
       <div class="col-12 col-lg nopadding">
         {{Form::radio('rate',3,['class'=> 'mr-1'])}}  Regular
       </div>
       <div class="col-12 col-lg nopadding">
        {{Form::radio('rate',4,['class'=> 'mr-1'])}}  Bueno
      </div>
      <div class="col-12 col-lg nopadding">
        {{Form::radio('rate',5,['class'=> 'mr-1'])}}  Muy Bueno
      </div>

    </div>
    <div class="form-group">
     <label for="" class="font-title-grey">Comentario:</label>
     {!!Form::textarea('comentary',null,['class'=>'form-control','style'=>'height:100px'])!!}
     <input type="submit" name="" value="Guardar" class="btn btn-primary">

     <a href="{{route('patient_appointments',Auth::user()->patient_id)}}" class="btn btn-secondary">cancelar</a>
      {{Form::close()}}
   </div>

  </div>
  @endif


</div>
</div>
</div>
</div>
</section>
@endsection

@section('scriptJS')
  <script type="text/javascript">
    function editar(){
      $('#create').show();
      $('#edit').hide();

    }

  </script>

@endsection
