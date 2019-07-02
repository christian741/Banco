@extends('Administrador/masterAdmin')
@section('contenido')
<?php 

      $dato = Session::get('matriz');
      $indice=sizeof($dato);

?>
<div class="row">
   <div class="col-6 col-md-2">
  <div class="row justify-content-md" style="position: absolute;">
        <div class="card text-white bg-danger " style="max-width: 40rem;padding-top: 130px;padding-bottom: 130px">
             <div class="card-header">
               <center><img src="imagenes/administrador.png" width="100"></center>
             </div>
             <div class="card-body">
              <center><h3 class="card-title">Informacion Administrador:</h3>
               <h4 class="card-title">Nombre: <?php echo($dato[$indice-1]['nombre'])?> 
             
               <p class="card-text"></p></center>
             </div>

           </div>  
  </div>
  </div>
   <div class="col-6 col-md-10">

    
     <section class="conteiner" style="padding-top: 20px;padding-right: 100px;padding-left: 100px;">
  
    {!! Form::open(['url' => 'RegistrarCajero','files' => true,'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
    {!! csrf_field() !!}
     <div class="conteiner">
            <h1>CAJERO</h1>
          </div>
        <div class="form-row">
           
             <div class="form-group col-md-6">
             <label for="nombre">Nombre</label>
             <input type="text" name="nombre" class="form-control" id="" placeholder="Nombre">
             </div>
             <div class="form-group col-md-6">
             <label for="apellido">Apellido</label>
             <input type="text" name="apellido" class="form-control" id="" placeholder="Apellido">
             </div>
             </div>
             <div class="form-row">
             <div class="form-group col -md-6">
             <label for="correo">Correo</label>
             <input type="email" name="correo" class="form-control" id="" placeholder="Correo">
             </div>
             <div class="form-group col-md-6">
             <label for="cedula">Cedula</label>
             <input type="text" name="cedula" class="form-control" id="" placeholder="Cedula">
             </div>
             </div>
             <div class="form-row">
             
            <div class="form-group col-md-6">
             <label for="password">Password</label>
             <input type="text" name="password" class="form-control" id="" placeholder="Password">
             </div>
         </div>
            
            <button type="submit" class="btn btn-outline-danger" style="padding-left: 100px;padding-right: 100px">Registrar</button>
  {!! Form::close() !!}
</section>

   </div>
</div>

		
             

@stop