@extends('layouts.app')

@section('content')

<section class="section-dashboard">
  <div class="container-fluid">
    <div class="row my-4">
      <div class="col-lg-11 col-10">
        <h3 class="font-title text-center">Editar Horario</h3>
      </div>
      <div class="col-lg-1 col-1 text-right">
        <a href="{{route('medico_diary',$medico->id)}}" data-toggle="tooltip" data-placement="top" title="Atras" name="button" class="btn"><i class="fas fa-arrow-left mr-2"></i></a>
      </div>
    </div>
    <div class="my-4 card p-3">
      @if(Session::Has('day'))
          <input type="hidden" name="" value="{!!$day = Session::get('day')!!}">
      @else
        <input type="hidden" name="" value="{!!$day = Null!!}">
      @endif
      {!!Form::open(['route'=>['medico_schedule_store',$medico->id],'method'=>'post'])!!}
      <div class="row">
        <label for="" class="col-form-label col-sm-3 font-title">Agregar Horas a dia:</label>
        <div class="col-sm-3 text-center">{{Form::select('day',['lunes'=>'lunes',
          'martes'=>'martes',
          'miercoles'=>'miércoles',
          'jueves'=>'jueves',
          'viernes'=>'viernes',
          'sabado'=>'sabado',
          'domingo'=>'domingo','lunes a viernes'=>'lunes a viernes','lunes a sabado'=>'lunes a sabado'],$day,['placeholder'=>'opciones', 'class' => 'form-control'])}}</div>
        </div>
        <div class="row my-4">
          <div class="col-lg-8 m-auto">
            <div class="row">
              <div class="col-5 text-center">
                <label for="[object Object]" class="font-title-blue">Hora de inicio</label>
                <div class="row">
                  <div class="col-lg-6 col-12 col-sm-6 p-1 text-center"> {!!Form::select('hour_start',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourEndUp'])!!}</div>
                  <div class="col-lg-6 col-12 col-sm-6 p-1 text-center"> {!!Form::select('mins_start',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control','id'=>'minsEndUp'])!!}</div>
               </div>

             </div>
             <div class="col-2 text-center">
              <label for="" class="font-title-blue">A</label>
            </div>
            <div class="col-5 text-center">
              <label for="[object Object]" class="font-title-blue">Hora Finalizacion</label>
              <div class="row">
                <div class="col-lg-6 col-sm-6 col-12  p-1 text-center">{!!Form::select('hour_end',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourEndUp'])!!}</div>
                <div class="col-lg-6 col-sm-6 col-12  p-1 text-center">{!!Form::select('mins_end',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control','id'=>'minsEndUp'])!!}</div>
              </div>
            </div>
          </div>
          <div class="row mt-3" >
            <div class="col-6 text-center">
              <a href="{{route('medico_diary',$medico->id)}}" class="btn-block btn btn-secondary">Cancelar</a>
            </div>
            <div class="col-6 text-center">
              <input type="submit" name="" value="Guardar" class="btn-block btn btn-primary">
            </div>
          </div>
          {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
  <div class=" mt-3">
    <table class="table table-responsive table-config">
      <thead class="thead-color">
        <tr>
          <th class="text-center">Lunes</th>
          <th class="text-center">Martes</th>
          <th class="text-center">Miercoles</th>
          <th class="text-center">Jueves</th>
          <th class="text-center">Viernes</th>
          <th class="text-center">Sabado</th>
          <th class="text-center">Domingo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            @foreach ($lunes as $day)
            <ul>
              <li>
                {{$day->start}}
                a
                {{$day->end}}
                <a href="{{route('medico_schedule_delete',$day->id)}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
              </li>
              <hr>
            </ul>
            @endforeach
          </td>
          <td>
            @foreach ($martes as $day)
            <ul>
              <li>
                {{$day->start}}
                a
                {{$day->end}}
                <a href="{{route('medico_schedule_delete',$day->id)}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
              </li>
              <hr>
            </ul>
            @endforeach
          </td>
          <td>
            @foreach ($miercoles as $day)
            <ul>
              <li>
                {{$day->start}}
                a
                {{$day->end}}
                <a href="{{route('medico_schedule_delete',$day->id)}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
              </li>

              <hr>
            </ul>
            @endforeach
          </td>
          <td>
            @foreach ($jueves as $day)
            <ul>
              <li>
                {{$day->start}}
                a
                {{$day->end}}
                <a href="{{route('medico_schedule_delete',$day->id)}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
              </li>

              <hr>
            </ul>
            @endforeach
          </td>
          <td>
            @foreach ($viernes as $day)
            <ul>
              <li>
                {{$day->start}}
                a
                {{$day->end}}
                <a href="{{route('medico_schedule_delete',$day->id)}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
              </li>

              <hr>
            </ul>
            @endforeach
          </td>
          <td>
            @foreach ($sabado as $day)
            <ul>
              <li>
                {{$day->start}}
                a
                {{$day->end}}
                <a href="{{route('medico_schedule_delete',$day->id)}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
              </li>

              <hr>
            </ul>
            @endforeach
          </td>
          <td>
            @foreach ($domingo as $day)
            <ul>
              <li>
                {{$day->start}}
                a
                {{$day->end}}
                <a href="{{route('medico_schedule_delete',$day->id)}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
              </li>
              <hr>
            </ul>
            @endforeach
          </td>
        </tr>
      </tbody>
      <tfoot>

      </tfoot>
    </table>
  </div>
</div>
</div>
</div>
</section>

@endsection
