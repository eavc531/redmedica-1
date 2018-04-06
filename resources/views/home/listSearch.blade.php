<div class="text-justify">
  @if($medicosCount != 0)
  <h3>Medicos</h3>
  <table class="table table-bordered">
    <thead class="bg-primary text-white">
      <tr>
        <td>Nombre Completo</td>
        <td>Especialidad</td>
        <td>Teléfonos</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($medicos as $medico)
        <tr>
          <td>{{$medico->name}} {{$medico->lastName}}</td>
          <td>
            <ul>
            @foreach ($medico->medico_specialty as $specialty)
                <li>{{$specialty->specialty}}</li>
            @endforeach
            </ul>
          </td>
          <td>
            <ul>
              @isset($medico->phone)
                <li>{{$medico->phone}}</li>
              @endisset
              @isset($medico->phone)
                <li>{{$medico->phoneOffice1}}</li>

              @endisset
              @isset($medico->phone)
                <li>{{$medico->phoneOffice2}}</li>

              @endisset


            </ul>
          </td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td>{{$medicos->links()}}</td>
      </tr>
    </tfoot>
  </table>
  @endif

  @if($medicalCentersCount != 0)
  <h3>Centros Medicos</h3>
  <table class="table table-bordered">
    <thead class="bg-primary text-white">
      <tr>
        <td>Nombre</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($medicalCenters as $mC)
        <tr>
          <td>{{$mC->name}}</td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td>{{$medicalCenters->links()}}</td>
      </tr>
    </tfoot>
  </table>
@endif

@if($specialtyCount != 0)
<h3>Especialidades Médicas</h3>
<table class="table table-bordered">
  <thead class="bg-primary text-white">
    <tr>
      <td>Nombre</td>
    </tr>
  </thead>
  <tbody>
    @foreach ($specialties as $specialty)
      <tr>
        <td>{{$specialty->name}}</td>
      </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <td>{{$specialties->links()}}</td>
    </tr>
  </tfoot>
</table>
@endif
</div>
