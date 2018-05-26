@extends('layouts.app')

@section('content')
<section class="box-register">
  <div class="container">
   <div class="register">
    <div class="row">
      <div class="col-12 mb-3">
        <h2 class="text-center font-title">Calificar Médico: {{$medico->name}} {{$medico->lastName}} </h2>
      </div>
    </div>


    @if($count_rate == 0)
    <div class="card mt-3" id="create">
     {!!Form::model($you_rate,['route'=>'store_rate_comentary','method'=>'POST'])!!}
     {{Form::hidden('medico_id',$medico->id,['class'=> 'mr-1'])}}
     {{Form::hidden('patient_id',$patient->id,['class'=> 'mr-1'])}}
     {{Form::hidden('event_id',$event->id,['class'=> 'mr-1'])}}
     <div class="card-header card-edit">
       <p class="">Calificación sobre el servicio del Médico: {{$medico->name}} {{$medico->lastName}}</p>
     </div>
     <div class="row my-2">
      <div class="col-12 col-lg text-center">
       <input id="super-admin" id="radio1" checked=false name="rate" value="1" type="radio">  <br>
       <label for="radio1" class="font-title-grey"> Muy Malo</label>
     </div>
     <div class="col-12 col-lg text-center">
       {{Form::radio('rate',2,['class'=> 'mr-1', 'id' => 'radio2', 'name'=> 'gender'])}}  <br>
       <label for="radio2" class="font-title-grey"> Malo</label>
     </div>
     <div class="col-12 col-lg text-center">
       {{Form::radio('rate',3,['class'=> 'mr-1', 'id' => 'radio3', 'name'=> 'gender'])}}  <br>
       <label for="radio3" class="font-title-grey">Regular</label>
     </div>
     <div class="col-12 col-lg text-center">
      {{Form::radio('rate',4,['class'=> 'mr-1', 'id' => 'radio4', 'name'=> 'gender'])}} <br>
      <label for="radio4" class="font-title-grey">Bueno</label>
    </div>
    <div class="col-12 col-lg text-center">
      <input id="super-admin" checked='false' name="rate" value="5" type="radio"> <br>
      <label for="radio5" class="font-title-grey">Muy Bueno</label>
    </div>
  </div>
  <div class="form-group">
    <div class="col-12">
     <label for="" class="font-title-blue">Comentario:</label>
     {!!Form::textarea('comentary',null,['class'=>'form-control','style'=>'height:100px'])!!}
   </div>
   <div class="col-12 mt-2 d-flex">
    <input type="submit" name="" value="Guardar" class="btn btn-success mr-2">
    <a href="{{route('patient_appointments',Auth::user()->patient_id)}}" class="btn btn-secondary">cancelar</a>
  </div>
</div>
{{Form::close()}}

</div>
@else
<p class="font-title-grey">Ya has Calificado al Médico: {{$medico->name}} {{$medico->lastName}}, pero puedes cambiar tu opinion respecto a tu ultima cita si asi lo prefieres.</p>
<div class="row mt-3">
  <div class="col-lg-8 m-lg-auto col-sm-8 m-sm-auto col-12">
    <div class="card box-shadow" id="edit">
      {!!Form::model($you_rate,['route'=>'store_rate_comentary','method'=>'POST'])!!}
      <div class="card-edit card-header">
        <h5 class="" style="font-size: 18px;">Tu Calificación otorgada al Médico: {{$medico->name}} {{$medico->lastName}}</h5>
      </div>
      <div class="card-body form-inline">
        <span class="mr-2">Puntaje que otorgaste al Médico: </span> @include('patient.star_rate')
      </div>
      <div class="col-12 form-group">
        <label for="" class="font-title-grey">Comentario:</label>
        {!!Form::textarea('comentary',null,['class'=>'form-control','style'=>'height:100px','disabled'])!!}
        <div class="mt-3 form-inline">
          <button onclick="editar()" type="button" name="button" class="btn btn-success mr-2">Editar</button>
          <a href="{{route('patient_appointments',Auth::user()->patient_id)}}" class="btn btn-secondary">cancelar</a>
        </div>
        {{Form::close()}}
      </div>
    </div>
  </div>
</div>



<div class="card mt-3" id="create" style="Display:none">
    
 {!!Form::model($you_rate,['route'=>'store_rate_comentary','method'=>'POST'])!!}
 {{Form::hidden('medico_id',$medico->id,['class'=> 'mr-1'])}}
 {{Form::hidden('patient_id',$patient->id,['class'=> 'mr-1'])}}
 {{Form::hidden('event_id',$event->id,['class'=> 'mr-1'])}}
 <div class="card-header card-edit">
   <p class="">Calificación sobre el servicio del Médico: {{$medico->name}} {{$medico->lastName}}</p>
 </div>
 <div class="row my-2">
  <div class="col-12 col-lg text-center">
   <input id="super-admin" id="radio1" checked=false name="rate" value="1" type="radio">  <br>
   <label for="radio1" class="font-title-grey"> Muy Malo</label>
 </div>
 <div class="col-12 col-lg text-center">
   {{Form::radio('rate',2,['class'=> 'mr-1', 'id' => 'radio2', 'name'=> 'gender'])}}  <br>
   <label for="radio2" class="font-title-grey"> Malo</label>
 </div>
 <div class="col-12 col-lg text-center">
   {{Form::radio('rate',3,['class'=> 'mr-1', 'id' => 'radio3', 'name'=> 'gender'])}}  <br>
   <label for="radio3" class="font-title-grey">Regular</label>
 </div>
 <div class="col-12 col-lg text-center">
  {{Form::radio('rate',4,['class'=> 'mr-1', 'id' => 'radio4', 'name'=> 'gender'])}} <br>
  <label for="radio4" class="font-title-grey">Bueno</label>
</div>
<div class="col-12 col-lg text-center">
  <input id="super-admin" checked='false' name="rate" value="5" type="radio"> <br>
  <label for="radio5" class="font-title-grey">Muy Bueno</label>
</div>
</div>
<div class="form-group">
<div class="col-12">
 <label for="" class="font-title-blue">Comentario:</label>
 {!!Form::textarea('comentary',null,['class'=>'form-control','style'=>'height:100px'])!!}
</div>
<div class="col-12 mt-2 d-flex">
<input type="submit" name="" value="Guardar" class="btn btn-success mr-2">
<a href="{{route('patient_appointments',Auth::user()->patient_id)}}" class="btn btn-secondary">cancelar</a>
</div>
</div>
{{Form::close()}}

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
