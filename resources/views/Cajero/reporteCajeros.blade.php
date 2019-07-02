@extends('Cajero/masterCajero')

@section('contenidoCajero')

<?php 
    $dato = Session::get('matriz');
    $indice=sizeof($dato);
    $cont=0;


?>

<div class="conteiner-fluid" style="background-color:#5499C7;color: white">
  <br>
  <br>ATENDIDOS
  <br>
</div>

     
<table class="table table-hover">
  <thead style="background-color: #AED6F1 ;">
    <tr>
     
      <th scope="col">Numero</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Cedula</th>
      <th scope="col">Fecha</th>
      <th scope="col">Tipo Turno</th>
      <th scope="col">Prioridad</th>
      
      
      
 
     
    </tr>
  </thead>
  <tbody>
    @foreach($total_atendidos as $key => $value)

      @foreach($total_usuarios as $key1 => $value1)

    <tr class="table-success">
    <th scope="row">{{$cont++}}</th>
        @if(strcmp($value['id_usuario'],$value1['cedula']) && strcmp($value['id_cajero'],$dato[$indice-1]['cedula']) )
    
          <td>{{$value1['nombre']}}</td>
          <td>{{$value1['apellido']}}</td>
          <td>{{$value1['cedula']}}</td>
          <td>{{$value1['fecha']}}</td>
          <td>{{$value1['tipoTurno']}}</td>
           <td>{{$value1['prioridad']}}</td>
         @endif

       @endforeach
    </tr>
    @endforeach
  </tbody>

      
</table> 
<div class="conteiner-fluid" style="background-color:#F5B041;color: white">
  <br>
  <br>NO ATENDIDOS
  <br>
</div>
<table class="table table-hover">
  <thead style="background-color: #FAD7A0 ;">
    <tr>
     
      <th scope="col">Numero</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Cedula</th>
      <th scope="col">Fecha</th>
      <th scope="col">Tipo Turno</th>
      <th scope="col">Prioridad</th>
      
      
      
 
     
    </tr>
  </thead>
  <tbody>
    @foreach($total_noatendidos as $key => $value)

      @foreach($total_usuarios as $key1 => $value1)

    <tr class="table-success">
    <th scope="row">{{$cont++}}</th>
        @if(strcmp($value['id_usuario'],$value1['cedula']) && strcmp($value['id_cajero'],$dato[$indice-1]['cedula']) )
    
          <td>{{$value1['nombre']}}</td>
          <td>{{$value1['apellido']}}</td>
          <td>{{$value1['cedula']}}</td>
          <td>{{$value1['fecha']}}</td>
          <td>{{$value1['tipoTurno']}}</td>
           <td>{{$value1['prioridad']}}</td>
         @endif

       @endforeach
    </tr>
    @endforeach
  </tbody>

      
</table> 
   








@stop