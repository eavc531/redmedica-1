@extends('layouts.app')

@section('content')

<div class="row mt-4">
  <div class="col-12">
    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Tipo de Consultorio</label>
      <div class="col-8">
        {!!Form::open(['route'=>'consulting_room.store','method'=>'POST'])!!}
        <div class="m-3">
          {{Form::radio('type','Medicina General o Familiar')}}
          <span for=""> Medicina General o Familiar </span>
          {{Form::radio('type','Consultorio de Especialidades')}}
          <span for="">Consultorio de Especialidades</span>

          {{Form::radio('type','Consultorio Odontologia')}}
          <span for="">Consultorio Odontologia</span>

          <div class="form-inline">
            {{Form::radio('type','other')}}
            <span for="">Otro tipo de Consulta Especifique: </span>{!!Form::text('other',null,['class'=>'form-control'])!!}
          </div>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Nombre del Consultorio</label>
      <div class="col-8">
        {!!Form::text('tradeName',null,['class'=>'form-control'])!!}
      </div>
    </div>
    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Dirección</label>
      <div class="col-8">
        {!!Form::text('addres',null,['class'=>'form-control'])!!}

        </div>
    </div>

    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Numero Ext</label>
      <div class="col-8">
        {!!Form::text('numberExt',null,['class'=>'form-control'])!!}

        </div>
    </div>

    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Numero Int</label>
      <div class="col-8">
        {!!Form::text('numberInt',null,['class'=>'form-control'])!!}

        </div>
    </div>

    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Colonia</label>
      <div class="col-8">
        {!!Form::text('colony',null,['class'=>'form-control'])!!}

        </div>
    </div>

    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Ciudad</label>
      <div class="col-8">
        {!!Form::text('city',null,['class'=>'form-control'])!!}

        </div>
    </div>

    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Estado</label>
      <div class="col-8">
        {!!Form::text('state',null,['class'=>'form-control'])!!}

        </div>
    </div>

    <div class="form-group row">
      <label for="example-text-input" class="col-3 col-form-label">Estado</label>
      <div class="col-8">
        {!!Form::text('passwordUnique',null,['class'=>'form-control'])!!}

        </div>
    </div>
        {!!Form::hidden('medico_id',$medico_id)!!}

    <button type="submit" name="button">Registrar</button>

    <button name="button">Cancelar</button>
    {!!Form::close()!!}
  </div>
</div>
@endsection
