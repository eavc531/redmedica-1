@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Configurar Nota: "{{$note->title}}" </h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
@include('medico.includes.main_medico_patients')
<div id="content">

</div>



@endsection

@section('scriptJS')
  <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
  <script type="text/javascript">

        $(document).ready(function(){
          content();
        });

        function content(){
          route = "{{route('note_config_ajax')}}";
          note_id = "{{$note->id}}";
          medico_id = "{{$medico->id}}";
          patient_id = "{{$patient->id}}";
          $.ajax({
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           type:'post',
           url:route,
           data:{note_id:note_id,medico_id:medico_id,patient_id:patient_id},
           error:function(error){
             console.log(error);
          },
          success:function(result){
            $('#content').html(result);
          }
        });
        }
        function active(result){
          element_id = result;
          route = "{{route('active_element')}}";
          $.ajax({
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           type:'post',
           url:route,
           data:{element_id:element_id},
           error:function(error){
             console.log(error);
          },
          success:function(result){
            console.log(result);
            content();
          }
        });
        }




  </script>

@endsection
