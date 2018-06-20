<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medico extends Model
{
    protected $fillable = [
      'identification',
      'name',
      'lastName',
      'gender',
      'email',
      'password',
      'city_id',
      'state_id',
      'medicalCenter_id',
      'phone',
      'facebook',
      'id_promoter',
      'stateConfirm',
      'showNumber',
      'showNumberOffice',
      'phoneOffice1',
       'phoneOffice2',
       'specialty',
       'sub_specialty',
       'country',
    ];

    public function medico_specialty(){
       return $this->hasMany('App\medico_specialty');
    }

    public function scopeSearchMedico($query, $search){
      return $query->where('name','LIKE','%'.$search.'%')->orWhere('lastName','%'.$search.'%');
   }



}
