{{-- Recibo la variable mediante la directiva @props  --}}
@props(['type'])
 
<div class="alert alert-{{$type}}" role="alert" title="{{$title ?? 'No tiene valor'}}">
    <span class="font-medium"><strong>{{$title ?? 'No tiene valor'}}</strong>&nbsp;</span>{{$slot}}
</div>
{{-- Podemos definir operadores ternarios en las vistas de blade para manejar valores nulos o no definidos
    Ejemplo: {{$title ?? 'No tiene valor'}} --}}