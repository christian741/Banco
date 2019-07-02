@extends('Administrador/masterAdmin')

@section('contenido')

<?php 

      $dato = Session::get('matriz');
      $indice=sizeof($dato);

      $cont=0;

?>


<div class="row">
   <div class="col-6 col-md-12">

<div class="conteiner-fluid" style="background-color:#922B21;color: white">
  <br>
  <br>ATENDIDOS
  <br>
</div>
     
<table class="table table-hover">
  <thead style="background-color: #922B21  ;color: white;">
    <tr>
      <th scope="col">indice</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Cedula</th>
      <th scope="col">Fecha</th>
      <th scope="col">Tipo Turno</th>
      <th scope="col">Prioridad</th>
      <th scope="col" style="background-color: #E67E22  ;color: white;">Cedula</th>
      <th scope="col" style="background-color: #E67E22  ;color: white;">Nombre</th>
    </tr>
  </thead>
  <tbody>
   @foreach($total_atendidos as $key => $value)

      @foreach($total_usuarios as $key1 => $value1)

      @foreach($total_cajeros as $key2 => $value2)

    <tr class="table-success">
    <th scope="row" style="background-color:#F5B7B1   ">{{$cont++}}</th>
        @if(strcmp($value['id_usuario'],$value1['cedula']) && strcmp($value['id_cajero'],$value2['cedula']) )
    
          <td style="background-color:#F5B7B1   ">{{$value1['nombre']}}</td>
          <td style="background-color: #F5B7B1  ">{{$value1['apellido']}}</td>
          <td style="background-color: #F5B7B1  ">{{$value1['cedula']}}</td>
          <td style="background-color: #F5B7B1  ">{{$value1['fecha']}}</td>
          <td style="background-color: #F5B7B1  ">{{$value1['tipoTurno']}}</td>
           <td style="background-color: #F5B7B1    ">{{$value1['prioridad']}}</td>
           <td style="background-color: #F0B27A  ">{{$value2['cedula']}}</td>
           <td style="background-color: #F0B27A  ">{{$value2['nombre']}}</td>
         @endif


          @endforeach
       @endforeach
    </tr>
    @endforeach
  </tbody>
</table> 


   </div>
</div>



<div class="row">
   <div class="col-6 col-md-12">

<div class="conteiner-fluid" style="background-color:#229954  ;color: white">
  <br>
  <br>NO ATENDIDOS
  <br>
</div>
     
<table class="table table-hover">
  <thead style="background-color: #229954    ;color: white;">
    <tr>
      <th scope="col">indice</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Cedula</th>
      <th scope="col">Fecha</th>
      <th scope="col">Tipo Turno</th>
      <th scope="col">Prioridad</th>
      <th scope="col" style="background-color: #F1C40F      ;color: white;">Cedula</th>
      <th scope="col" style="background-color: #F1C40F      ;color: white;">Nombre</th>
    </tr>
  </thead>
  <tbody>
   @foreach($total_noatendidos as $key => $value)

      @foreach($total_usuarios as $key1 => $value1)

      @foreach($total_cajeros as $key2 => $value2)

    <tr class="table-success">
    <th scope="row" style="background-color: #ABEBC6 ">{{$cont++}}</th>
        @if(strcmp($value['id_usuario'],$value1['cedula']) && strcmp($value['id_cajero'],$value2['cedula']) )
    
          <td style="background-color:#ABEBC6    ">{{$value1['nombre']}}</td>
          <td style="background-color:#ABEBC6    ">{{$value1['apellido']}}</td>
          <td style="background-color: #ABEBC6   ">{{$value1['cedula']}}</td>
          <td style="background-color: #ABEBC6   ">{{$value1['fecha']}}</td>
          <td style="background-color: #ABEBC6   ">{{$value1['tipoTurno']}}</td>
           <td style="background-color: #ABEBC6     ">{{$value1['prioridad']}}</td>
           <td style="background-color: #F9E79F     ">{{$value2['cedula']}}</td>
           <td style="background-color: #F9E79F     ">{{$value2['nombre']}}</td>
         @endif


          @endforeach
       @endforeach
    </tr>
    @endforeach
  </tbody>
</table> 


   </div>
</div>



@stop