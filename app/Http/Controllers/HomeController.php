<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Pagina;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('hello');
    }


    public function empresa()
    {
        $datos["nombre"]="ECOSAZÓN";
        $datos["fecha"]="2024-06-12";
        $datos["actividad"]="Comida Casera a Domicilio";
        $datos["descripcion_about"]="Empresa dedicada al desarrollo de aplicaciones web y soluciones digitales.";
        $datos["texto_ejemplo"]="En Empresa, nos especializamos en crear experiencias digitales innovadoras que impulsan el éxito de nuestros clientes en el mundo en línea.";


        //$usuario=new Pagina();
        //$datos["listadoUsuarios"]=$usuario->ObtenerListado();
        return view('empresa',$datos);
    }

   
}
