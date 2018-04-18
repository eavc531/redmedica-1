@extends('layouts.app')

@section('content')
  <section class="section-dashboard">
    <div class="container-fluid">
      <div class="row my-4">
        <div class="col-12">
          <h4 class="font-title-blue text-center">Editar Horario</h4>
        </div>
      </div>
      <div class="my-4 card">
        <div class="form-inline">
            {!!Form::open(['route'=>['medical_center_store_schedule',$medicalCenter->id],'method'=>'post'])!!}
            Agregar Horas a dia:{{Form::select('day',['lunes'=>'lunes',
              'martes'=>'martes',
              'miércoles'=>'miércoles',
              'jueves'=>'jueves',
              'viernes'=>'viernes',
              'sabado'=>'sabado',
              'domingo'=>'domingo'],null,['placeholder'=>'opciones'])}}
        </div>
        <div class="row my-4">
          <div class="col-lg-8 m-auto">
            <div class="row">
              <div class="col-5">
                <label for="[object Object]">Hora de inicio</label>
                  <div class="form-inline">

                    {!!Form::select('hour_start',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourEndUp'])!!}
                      {!!Form::select('mins_start',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control','id'=>'minsEndUp'])!!}
                    </div>

              </div>
              <div class="col-2 text-center">
                <label for="">A</label>
              </div>
              <div class="col-5">
                  <label for="[object Object]">Hora Finalizacion</label>
                  <div class="form-inline">

                    {!!Form::select('hour_end',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourEndUp'])!!}
                    {!!Form::select('mins_end',['00'=>'00','15'=>'15','30'=>'30','45'=>'45'],null,['class'=>'form-control','id'=>'minsEndUp'])!!}
                  </div>
                    </div>

                    <div class="form-group mt-3" >
                        <input type="submit" name="" value="Guardar" class="btn btn-config-green">
                        <a href="{{route('medicalCenter.edit',$medicalCenter->id)}}" class="btn btn-primary">Cancelar</a>
                    </div>

                    {!!Form::close()!!}
              </div>
            </div>
          </div>
        </div>
      </div>
            <div class=" mt-3">
              <table class="table table-bordered">
                <thead>
                    <tr>
                      <th>Lunes</th>
                      <th>Martes</th>
                      <th>Miercoles</th>
                      <th>Jueves</th>
                      <th>Viernes</th>
                      <th>Sabado</th>
                      <th>Domingo</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      @foreach ($lunes as $day)
                        <ul>
                          <li>
                            {{$day->hour_ini}}
                                    a
                            {{$day->hour_end}}
                            <a href="{{route('medical_center_schedule_delete',$day->id)}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
                          </li>

                            <hr>
                        </ul>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($martes as $day)
                        <ul>
                          <li>
                            {{$day->hour_ini}}
                                    a
                            {{$day->hour_end}}
                            <a href="{{route('medical_center_schedule_delete',$day->id)}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
                          </li>

                            <hr>
                        </ul>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($miercoles as $day)
                        <ul>
                          <li>
                            {{$day->hour_ini}}
                                    a
                            {{$day->hour_end}}
                            <a href="{{route('medical_center_schedule_delete',$day->id)}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
                          </li>

                            <hr>
                        </ul>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($jueves as $day)
                        <ul>
                          <li>
                            {{$day->hour_ini}}
                                    a
                            {{$day->hour_end}}
                            <a href="{{route('medical_center_schedule_delete',$day->id)}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
                          </li>

                            <hr>
                        </ul>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($viernes as $day)
                        <ul>
                          <li>
                            {{$day->hour_ini}}
                                    a
                            {{$day->hour_end}}
                            <a href="{{route('medical_center_schedule_delete',$day->id)}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
                          </li>

                            <hr>
                        </ul>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($sabado as $day)
                        <ul>
                          <li>
                            {{$day->hour_ini}}
                                    a
                            {{$day->hour_end}}
                            <a href="{{route('medical_center_schedule_delete',$day->id)}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
                          </li>

                            <hr>
                        </ul>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($domingo as $day)
                        <ul>
                          <li>
                            {{$day->hour_ini}}
                                    a
                            {{$day->hour_end}}
                            <a href="{{route('medical_center_schedule_delete',$day->id)}}" style="color:red" onclick="return confirm('¿Estas Segur@ de querer eliminar este campo?')">x</a>
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
