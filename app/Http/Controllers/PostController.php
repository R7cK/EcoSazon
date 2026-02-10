<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function Mensaje()
    {
        return "Hola desde el controlador de PostController";
    }

    public function About($param=null,$nombre=null)  
    {
       $datoss= ['parametro'=>$param,'nombre'=>$nombre];
        return view('about');
        //return wiew('about',compact('param','nombre'));
    }
    Public function Contacto()
    {
        return view('contacto',['mensaje'=>'>Esto es un mensaje']);
    }
}
