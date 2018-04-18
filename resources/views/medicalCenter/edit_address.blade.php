@extends('layouts.app')

@section('content')
<section class="box">
  <div class="row">
<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Editar Datos de Centro Médico</h2>
  </div>
</div>
    {!!Form::model($medicalCenter,['route'=>['medical_center_update_address',$medicalCenter],'method'=>'update'])!!}


<div class="row my-3">
  <div class="col-lg-3 col-12">
    <div class="form-group row">
      <label for="" class="col-4 col-form-label">Pais</label>
     {{Form::select('country',['Mexíco'=>'Mexíco'],null,['class'=>'form-control'])}}
    </div>
  </div>
  <div class="col-lg-3 col-12">
    <div class="form-group row">
      <label for="" class="col-4 col-form-label">Estado</label>
      {{Form::select('state',$states,null,['class'=>'form-control','id'=>'state','placeholder'=>'opciones'])}}
    </div>
  </div>
  <div class="col-lg-3 col-12">
    <div class="form-group row">
      <label for="" class="col-4 col-form-label">Ciudad</label>
      {{Form::select('city',$cities,null,['class'=>'form-control','id'=>'city','placeholder'=>'opciones'])}}
    </div>
  </div>
  <div class="col-lg-3 col-12">
    <div class="form-group row">
      <label for="" class="col-4 col-form-label" >Codigo Postal</label>
      {{Form::number('postal_code',null,['class'=>'form-control'])}}
    </div>
  </div>
</div>
<div class="row mt-2">
  <div class="col-lg-3 col-12">
    <div class="form-group row">
      <label for="" class="col-4 col-form-label" >Colonia</label>
      {{Form::text('colony',null,['class'=>'form-control'])}}
    </div>
  </div>
  <div class="col-lg-3 col-12">
    <div class="form-group row">

     <label for="[object Object]">Calle/Av (especifique)</label>
    {{Form::text('street',null,['class'=>'form-control'])}}
    </div>
  </div>
  <div class="col-lg-3 col-12">
    <div class="form-group row">
      <label for="" class="col-lg-7 col-12 col-form-label">Numero Externo</label>
       {{Form::text('number_ext',null,['class'=>'form-control'])}}
    </div>
  </div>
  <div class="col-lg-3 col-12">
    <div class="form-group row">
      <label for="" class="col-lg-7 col-12 col-form-label">Numero Interno</label>
      {{Form::text('number_int',null,['class'=>'form-control','id'=>'input2'])}}
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-6 col-12 mt-2">
    <a href="{{route('medicalCenter.edit',$medicalCenter->id)}}" class="btn btn-primary btn-block">Cancelar</a>
  </div>
  <div class="col-lg-6 col-12 mt-2">
    <button type="submit" class="btn-config-green btn btn-block">Guardar</button>
  </div>
</div>
{!!Form::close()!!}

    <div class="mt-4">
      <input type="text" name="" value="" id="input">
      <button type="button" name="button" id="find">test</button>
      <div class="mt-3" id="my_input" style="height:400px;width:600px">

      </div>
    </div>


</div>
</div>
</section>





</div>

@endsection

@section('scriptJS')

  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDh9hTFPYHnnfVtoHSXysAdzQjmxKuZd3s"></script>
  <script src="{{asset('geocoder_autocomplete\jquery.geocomplete.js')}}"></script>
<script type="text/javascript">

$(document).ready(function(){


  $("#input").geocomplete({
    map:"#my_input"
  });

});

$("#find").click(function(){
  $("input").trigger("geocode");
});


/////////////////////////////

$('#state').on('change', function() {

state = $('#state').val();

route = "{{route('inner_cities_select3')}}";
$.ajax({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  type:'post',
  url: route,
  data:{name:state},
  success:function(result){
    console.log(result);
  $("#city").empty();
      $('#city').append($('<option>', {
         value: null,
         text: 'opciones'
     }));
         $.each(result,function(key, val){
           $('#city').append($('<option>', {
              value: val,
              text: val
          }));
         });
  },
  error:function(error){
    console.log(error);
  },
});
})

</script>
@endsection
