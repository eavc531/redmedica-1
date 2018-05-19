<div class="card">
  <div class="card-header">
    <h4>{{$note->title}}</h4>

  </div>
    <div class="card-body">


{!!Form::open(['route'=>'note_config_store','method'=>'POST'])!!}
{!!Form::hidden('medico_id',$medico->id,['id'=>'testmedic'])!!}
{!!Form::hidden('note_id',$note->id)!!}
{!!Form::hidden('title',$note->title)!!}
<input type="hidden" name="" value="{{$id = 0}}">
@foreach ($note->element_note as $element)
  <input type="hidden" name="" value="{{$id = $id + 1}}">
  @if($element->show == 'yes')
  <div class="">
    <div class="form-inline bg-warning text-white">
      <h5 class="p-1">{{$element->question}} </h5> <button type="button" onclick="active({{$element->id}})" class="btn btn-primary btn-sm">desactivar</button>
    </div>
    {!!Form::textarea($element->question,$element->answer,['class'=>'form-control mt-2'])!!}
    {!!Form::hidden($element->id_css,'visible',['id'=>$element->id_css])!!}

  </div>
  @else
    <div class="">
      <div class="form-inline bg-secondary text-white">
        <h5 class="p-1">{{$element->question}} </h5> <button type="button" onclick="active({{$element->id}})" class="btn btn-primary btn-sm">activar</button>
      </div>
      {{-- {!!Form::hidden($element->question,'oculto',['id'=>$element->question])!!} --}}
        {!!Form::hidden($element->question,'oculto',['id'=>$element->option])!!}
    </div>
  @endif

@endforeach

<input type="submit" name="" value="Guardar">
{{-- <input name="mysubmit" type="submit" value="Enviar" /> --}}

{!!Form::close()!!}
  </div>
</div>

<script type="text/javascript">

if($('#signosvitales').val() == 'visible'){
  CKEDITOR.replace('signos vitales');
}
if($('#PruebasdeLaboratorio').val() == 'visible'){
  CKEDITOR.replace('Pruebas de Laboratorio');
}
</script>
