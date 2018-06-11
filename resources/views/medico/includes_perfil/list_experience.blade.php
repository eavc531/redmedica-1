{{-- Botones redes sociales. --}}

<div class="row">
  <div class="col-lg-8 col-12 m-auto">
    <div class="card">


      <ul class="list-group">
        @foreach ($experiences as $experience)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{$experience->name}}
            <button onclick="medico_experience_delete('{{$experience->id}}')" class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></button>
          </li>
        @endforeach
      </ul>

      {{-- //pagiate_ajax --}}

      @if($experiences->count() == 6 or $page > 1)
      <div class="card-footer">
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item"><button class="page-link" onclick="paginate_experience('Ant')">Ant.</button></li>
            <input type="hidden" name="" value="{{$number = 0}}">
            @for ($i = 0; $i < $cant_page; $i++)
              <input type="hidden" name="" value="{{$page}}" id="page_exp">
              <input type="hidden" name="" value="{{$number = $number + 1}}">
              @if($number == $page)
                <li class="page-item"><button class="page-link  bg-primary text-white" onclick="paginate_experience('{{$number}}')">{{$number}}</button></li>
              @else
                <li class="page-item"><button class="page-link" onclick="paginate_experience('{{$number}}')">{{$number}}</button></li>
              @endif
            @endfor
            <li class="page-item"><button class="page-link" onclick="paginate_experience('Sig')">Sig.</button></li>
          </ul>
        </nav>
      </div>
    @endif
    {{-- //pagiate_ajax --}}

    </div>
  </div>
</div>
