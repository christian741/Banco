@extends('master')

@section('contenido')
<?php 
	
		$dato = Session::get('personas');
    $cont=1;
 
 ?>

 @if($total_usuarios!=null)


<table class="table table-hover">
  
        
  <thead style="background-color: #2980B9  ;color: white;">
    <tr>
     
      <th scope="col">Numero</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Tipo de Documento</th>
      <th scope="col">Cedula</th>
      <th scope="col">Prioridad</th>
      <th scope="col">Tipo Turno</th>
      <th scope="col">Fecha</th>
      <th scope="col">Turno</th>
 
     
    </tr>
  </thead>
  <tbody>
    @foreach($total_usuarios as $key1 => $array)
    <tr class="table-success">
  <th scope="row">{{$cont++}}</th>
   
        <td>{{$array['nombre']}}</td>
        <td>{{$array['apellido']}}</td>
        <td>{{$array['tipo_documento']}}</td>
        <td>{{$array['cedula']}}</td>
        <td>{{$array['prioridad']}}</td>
         <td>{{$array['tipoTurno']}}</td>
          <td>{{$array['fecha']}}</td>
           <td>{{$array['turno']}}</td>


    </tr>
    @endforeach
  </tbody>

      
</table> 
 
@else

<table class="table table-hover">
  <thead style="background-color: #2980B9  ;color: white;">
    <tr>
     
       <th scope="col">Vacio</th>
      <th scope="col">Vacio</th>
      <th scope="col">Vacio</th>
      <th scope="col">Vacio</th>
     
    </tr>
  </thead>
  <tbody>
  <tr class="table-success">
      <th scope="row">vacio</th>
      <th scope="row">Vacio</th>
      <th scope="row">Vacio</th>
      <th scope="row">Vacio</th>
      
    </tr>
  </tbody>
</table>

@endif




@stop