<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="max-w-4xl mx-auto px-4">    
        <h1>Página de Contacto</h1>
        <!-- El uso de blade nos permite poder hacer uso de algunas directivas como a continuación podemos apreciar en la siguiente línea de código -->
        <h2>{{$nombre}}</h2>
        <h2>{{$carrera}}</h2>
        <a href="{{route('vista_inicio')}}">Ir a la vista de inicio</a><br>
        <a href="{{route('contact')}}">Ir a la vista de contacto</a>
        <x-alert type='danger'>
            <x-slot name="title">
                Esto es un  mensaje de alerta obtenido desde la vista de contacto
            </x-slot>
            Contenido del alert
        </x-alert>
        <div class="row">
            <div class="col-sm-3">
               <x-card>
                    <x-slot name="title">
                        Producto #1
                    </x-slot>
                    <x-slot name="texto_tarjeta">
                        El contenido de la tarjeta va aquí
                    </x-slot>
                    <x-slot name="text_boton">
                        boton1
                    </x-slot>
               </x-card>
            </div>
 
            <div class="col-sm-3">
               <x-card>
                    <x-slot name="title">
                       Producto #2
                    </x-slot>
                    <x-slot name="texto_tarjeta">
                        El contenido de la tarjeta va aquí
                    </x-slot>
                    <x-slot name="text_boton">
                        boton2
                    </x-slot>
               </x-card>
            </div>
 
            <div class="col-sm-3">
               <x-card>
                    <x-slot name="title">
                       Producto #3
                    </x-slot>
                    <x-slot name="texto_tarjeta">
                        El contenido de la tarjeta va aquí
                    </x-slot>
                    <x-slot name="text_boton">
                        boton3
                    </x-slot>
               </x-card>
            </div>
 
            <div class="col-sm-3">
               <x-card>
                    <x-slot name="title">
                       Producto #4
                    </x-slot>
                    <x-slot name="texto_tarjeta">
                        El contenido de la tarjeta va aquí
                    </x-slot>
                    <x-slot name="text_boton">
                        boton4
                    </x-slot>
               </x-card>
            </div>
 
        </div>
    </div>
</body>
</html>