<hr>
<div class="row justify-content-center mb-2">
  <div class="col-8 -auto">
    <div class="row">
      <div class="col-lg-2 col-6">
        <a href="{{route('medico_appointments_patient',['medico_id'=>$medico->id,'patient_id'=>$patient['id']])}}" class="btn btn-secondary btn-lg"><i class="far fa-calendar-alt"></i></a>
      </div>
      <div class="col-lg-2 col-6">
        <a href="{{route('notes_patient',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" class="btn btn-secondary btn-lg"><i class="fas fa-notes-medical"></i></a>
      </div>
      <div class="col-lg-2 col-12">
        <a href="{{route('medico_stipulate_appointment',['m_id'=>$medico->id,'p_id'=>$patient])}}" class="btn btn-secondary btn-lg"><i class="far fa-calendar-check"></i></a>
      </div>
      <div class="col-lg-2 col-12">
        <a href="{{route('medico_patients',$medico->id)}}" class="btn btn-secondary btn-lg"><i class="fas fa-users"></i></a>
      </div>
    </div>
  </div>
</div>
<hr>
