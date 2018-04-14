@extends('layouts.app')

@section('content')
  <section class="box-register">
    <div class="row">
  <div class="row">
    <div class="col-12 mb-3">
      <h2 class="text-center font-title">Editar Datos de Centro Médico</h2>
    </div>
  </div>
        {!!Form::model($medicalCenter,['route'=>['medical_center_edit_data_update',$medicalCenter],'method'=>'update'])!!}


            <div class="col-lg-6 col-12">
              <div class="form-group">
                  <label for="">Nombre de la Institución o Centro Medico</label>
                {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Centro Medico'])}}

                </div>
                <div class="form-group">
                    <label for="">Nombre del Administrador</label>
                  {{Form::text('nameAdmin',null,['class'=>'form-control','placeholder'=>'Nombre del Administrador'])}}
                </div>

            </div>
            <div class="col-lg-6 col-12">


                <div class="form-group">
                    <div class="form-group">
                      <label for="">Email de la institución (opcional)</label>
                      {{Form::text('email_institution',null,['class'=>'form-control'])}}
                    </div>
                </div>
                <div class="form-group">
                  <label for="">Teléfono del Administrador</label>
                  {{Form::text('phone_admin',null,['class'=>'form-control'])}}
                 </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">
                <label for="">Licencia sanitaria</label>
                {{Form::text('sanitary_license',null,['class'=>'form-control'])}}
              </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">
                <label for="">Id del Centro Medico</label>
                {{Form::text('id_medicalCenter',null,['class'=>'form-control'])}}
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">
                <label for="">Telefono de Oficina 1</label>
                {{Form::text('phone',null,['class'=>'form-control'])}}
              </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">
                <label for="">Telefono de Oficina 2</label>
                {{Form::text('phone2',null,['class'=>'form-control'])}}
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">

                <a href="{{route('medicalCenter.edit',$medicalCenter->id)}}" class="btn btn-primary btn-block">Cancelar</a>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">

                {{Form::submit('Guardar',['class'=>'btn btn-config-green btn-block'])}}
              </div>
            </div>
          </div>
          {!!Form::close()!!}

      </div>
    </section>
@endsection
