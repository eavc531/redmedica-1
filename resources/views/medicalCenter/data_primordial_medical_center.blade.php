@extends('layouts.app')

@section('content')
<section class="box-register">
  <div class="row">
    <div class="col-12 text-right">
      <div class="btn-group " role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary">1</button>
        <button type="button" class="btn btn-secondary">2</button>
        <button type="button" class="btn btn-config-blue">3</button>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="register">
      <div class="row">
        <div class="col-12 mb-3">
          <h5>Bienevenido: {{$medicalCenter->nameAdmin}} </h5>
          <p>Por Favor rellene los datos a continuación, requeridos para poder gestionar correctamente todas las funciones de nuestro  sistema.</p>
        </div>
      </div>


        {!!Form::model($medicalCenter,['route'=>['medicalCenter.update',$medicalCenter],'method'=>'PUT'])!!}

          <div class="row">
            <div class="col-lg-6 col-12">
              <div class="form-group">
                  <label for="">Nombre dform-title e la Institución o Centro Medico</label>
                {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Centro Medico'])}}

                </div>
                <div class="form-group">
                    <label for="">Nombre dform-title el Administrador</label>
                  {{Form::text('nameAdmin',null,['class'=>'form-control','placeholder'=>'Nombre del Administrador'])}}
                </div>

            </div>
            <div class="col-lg-6 col-12">


                <div class="form-group">
                    <div class="form-group">
                      <label for="">Email dform-title e la institución (opcional)</label>
                      {{Form::text('email_institution',null,['class'=>'form-control'])}}
                    </div>
                </div>
                <div class="form-group">
                  <label for="">Teléfono dform-title el Administrador</label>
                  {{Form::text('phone_admin',null,['class'=>'form-control'])}}
                 </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">
                <label for="">Licencia sform-title anitaria</label>
                {{Form::text('sanitary_license',null,['class'=>'form-control'])}}
              </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">
                <label for="">Id dform-title el Centro Medico</label>
                {{Form::text('id_medicalCenter',null,['class'=>'form-control'])}}
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">
                <label for="">Telefono dform-title e Oficina 1</label>
                {{Form::text('phone',null,['class'=>'form-control'])}}
              </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">
                <label for="">Telefono dform-title e Oficina 2</label>
                {{Form::text('phone2',null,['class'=>'form-control'])}}
              </div>
            </div>
          </div>


            <label for="" class="form-title m-3"><strong>Dirección de la Institución o Centro Médico</strong></label>


          <div class="row my-3">
            <div class="col-lg-3 col-12">
              <div class="form-group row">
                <label for="" class="form-title col-4 col-form-label">Pais</label>
               {{Form::select('country',['Mexíco'=>'Mexíco'],null,['class'=>'form-control'])}}
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group row">
                <label for="" class="form-title col-4 col-form-label">Estado</label>
                {{Form::select('state',$states,null,['class'=>'form-control','id'=>'state','placeholder'=>'opciones'])}}
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group row">
                <label for="" class="form-title col-4 col-form-label">Ciudad</label>
                {{Form::select('city',$cities,null,['class'=>'form-control','id'=>'city','placeholder'=>'opciones'])}}
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group row">
                <label for="" class="form-title col-4 col-form-label" >Codigo Postal</label>
                {{Form::number('postal_code',null,['class'=>'form-control'])}}
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-lg-3 col-12">
              <div class="form-group row">
                <label for="" class="form-title col-4 col-form-label" >Colonia</label>
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
                <label for="" class="form-title col-lg-7 col-12 col-form-label">Numero Externo</label>
                 {{Form::text('number_ext',null,['class'=>'form-control'])}}
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group row">
                <label for="" class="form-title col-lg-7 col-12 col-form-label">Numero Interno</label>
                {{Form::text('number_int',null,['class'=>'form-control'])}}
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-12 mt-2">

            </div>
            <div class="col-lg-6 col-12 mt-2">
              <button type="submit" class="btn-config-green btn btn-block">Guardar</button>
            </div>
          </div>
         {!!Form::close()!!}
    </div>
  </div>
</section>
@endsection

@section('scriptJS')

  <script type="text/javascript">

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
