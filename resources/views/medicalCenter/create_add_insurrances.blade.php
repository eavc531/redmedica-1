@extends('layouts.app')

@section('content')
<section class="box-register">
  <div class="row">


  <div class="container">
    <div class="register">
      <div class="row">
        <div class="col-12 mb-3">
          <h2 class="text-center font-title">Aseguradoras</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-12 mb-3 mt-4">
          <h5 class="text-center">Añadir aseguradora</h5>
        </div>
      </div>
      <div class="row">
        @foreach ($insurrance_show as $insurance)
        <div class="col-6 text-left mt-2">
         <div class="custom-control custom-radio">
           {!!Form::open(['route'=>['medicalCenter_store_insurrances',request()->id],'method'=>'POST'])!!}
          <input type="hidden" name="name" value="{{$insurance->name}}" class="form-control mt-2">
          <label class="custom-control-label" for="customRadio11">{{$insurance->name}}</label>
          <button type="submit" class="ml-2">agregars</button>
          {!!Form::close()!!}
        </div>
        </div>
        @endforeach
        <div class="col-6 text-left">
         <div class="custom-control">
          {!!Form::open(['route'=>['medicalCenter_store_insurrances',request()->id],'method'=>'POST'])!!}

          <input type="text" name="name" value="" class="form-control mt-2" placeholder="otra/especifique">
          <button type="submit" name="button" class="ml-2">agregar</button>
          {!!Form::close()!!}
        </div>
        </div>
    </div>

    <div class="row">
      <div class="col-12 mb-3 mt-5">
        <h5 class="text-center">Aseguradoras Aceptadas</h5>
      </div>
    </div>
    <ul class="list-group mt-3">
      @foreach ($insurances as $i)
        <li class="list-group-item d-flex justify-content-between align-items-center">
          {{$i->name}}
          <a href="{{route('delete_insurance',$i->id)}}"class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></a>
        </li>
      @endforeach
    </ul>
  </div>

  <div class="mb-3">

  </div>
    </div>
</section>
@endsection
