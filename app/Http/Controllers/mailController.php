<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mailController extends Controller
{

   // NO ESTA AGREGADO A NADA
   public function sendMessage(Request $request)
   {
     $name = $request->name;
     $nameemail = $request->email;
     $msg = $request->msg;
     Mail::send('mail.viewmail',['name'=>$name,'nameemail'=>$nameemail,'msg'=>$msg], function($msj) use($request){
        $msj->subject('Cliente Eje Satelital: '.$request->name);
        $msj->to('testprogramas531@gmail.com');

    });
}
