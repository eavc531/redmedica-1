{{-- Botones redes sociales. --}}

<div class="row">
  <div class="col-lg-8 col-12 m-auto">
    <ul class="list-group">
        @foreach ($experiences as $experience)
      <li class="list-group-item d-flex justify-content-between align-items-center">
        {{$experience->name}}
        <button onclick="medico_experience_delete('{{$experience->id}}')" class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></button>
      </li>
    @endforeach
    </ul>
  </div>
</div>
