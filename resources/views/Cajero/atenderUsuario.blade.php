@extends('Cajero/masterCajero')

@section('contenidoCajero')

<?php 

      $dato = Session::get('matriz');
      $indice=sizeof($dato);

      $dato2 =Session::get('personas');
      $indice2=sizeof($dato2);

?>
 @if(Session::has('personas'))
<div class="row">
   <div class="col-6 col-md-2">
  <div class="row justify-content-md" style="position: absolute;">
        <div class="card text-white bg-success " style="max-width: 40rem;padding-top: 100px;padding-bottom: 100px">
             <div class="card-header">
               <center><img src="imagenes/vacio.jpg" width="100"></center>
             </div>
             <div class="card-body">
              <center><h3 class="card-title">Informacion Cajero:</h3>
               <h4 class="card-title">Nombre: <?php echo($dato[$indice-1]['nombre'])?> 
                <br> Cedula:   <?php echo($dato[$indice-1]['cedula'])?></h4>
               <p class="card-text"></p></center>
             </div>

           </div>  
  </div>
  </div>
   <div class="col-md-auto" style="padding-left: 400px;padding-top: 50px">

  
      <div class="card text-white bg-primary mb-3" style="max-width: 60rem;padding-left: 60px;padding-right: 60px;">
        <div class="card-body">
          <h3 class="card-title " >Usuario</h3>
          <p class="card-text" style="background-color: #F9E79F   ">
            <h5 class="card-title">Nombre: <?php echo($dato2[$indice2-1]['nombre'])?> 
                <br> Apellido:   <?php echo($dato2[$indice2-1]['apellido'])?>
                 <br> Cedula:   <?php echo($dato2[$indice2-1]['cedula'])?>
                 <br> Turno:   <?php echo($dato2[$indice2-1]['turno'])?>
              </h5>
             <form action="{{ url('cajero')}}" method="POST">
              {{ csrf_field()}}
               <center><input type="checkbox" name="atender" value="si">Llamar Cliente<br>
               <br><br><button type="submit" class="btn btn-primary">Atender</button></center>
             </form>
             <form action="{{ url('noCajero')}}" method="POST">
              {{ csrf_field()}}
               <center><input type="checkbox" name="atender" value="si">Pasar Turno<br>
               <br><br><button type="submit" class="btn btn-primary">Aceptar</button></center>
             </form>
          <!--  Nombre: <?php// echo($personas[$indice-1]['nombre'])?>
            Apellido: <?php// echo($personas[$indice-1]['apellido'])?>
            Cedula: <?php //echo($personas[$indice-1]['tipoDocumento'] )?>  <?php //echo($personas[$indice-1]['cedula'])?>
            Prioridad: <?php// echo($personas[$indice-1]['tipoDocumento'] )?> 
            TipoTurno' <?php //echo($personas[$indice-1]['tipoDocumento'] )?> 
            Turno'  //echo($personas[$indice-1]['tipoDocumento'] )-->
          </p>
        </div>
      </div>           
    </div>
    
  </div>




   </div>
</div>
@else   
<div class="row">
   <div class="col-6 col-md-2">
  <div class="row justify-content-md" style="position: absolute;">
        <div class="card text-white bg-success " style="max-width: 40rem;padding-top: 100px;padding-bottom: 100px">
             <div class="card-header">
               <center><img src="imagenes/vacio.jpg" width="100"></center>
             </div>
             <div class="card-body">
              <center><h3 class="card-title">Informacion Cajero:</h3>
               <h4 class="card-title">Nombre: <?php echo($dato[$indice-1]['nombre'])?> 
                <br> Cedula:   <?php echo($dato[$indice-1]['cedula'])?></h4>
               <p class="card-text"></p></center>
             </div>

           </div>  
  </div>
  </div>
   <div class="col-md-auto" style="padding-left: 200px;padding-top: 50px">

  
      <div class="card text-white bg-primary mb-3" style="max-width: 60rem;padding-left: 60px;padding-right: 60px;">
        <div class="card-body">
          <h3 class="card-title " >Usuario</h3>
          <p class="card-text" style="background-color: #F9E79F   ">
            <h5 class="card-title">Nombre: 
                <br> Apellido:   
                 <br> Cedula:   
               <br> Turno: 
                <br>
                <br>

                <h2>EL BANCO ESTA VACIO</h2>
           </h5>
             <!--<form action="{{ url('cajero')}}" method="POST">
              {{ csrf_field()}}
               <center><input type="checkbox" name="atender" value="si">Llamar Cliente<br>
               <br><br><button type="submit" class="btn btn-primary">Atender</button></center>
             </form>
             <form action="{{ url('noCajero')}}" method="POST">
              {{ csrf_field()}}
               <center><input type="checkbox" name="atender" value="si">Pasar Turno<br>
               <br><br><button type="submit" class="btn btn-primary">Aceptar</button></center>
             </form>
            Nombre: <?php// echo($personas[$indice-1]['nombre'])?>
            Apellido: <?php// echo($personas[$indice-1]['apellido'])?>
            Cedula: <?php //echo($personas[$indice-1]['tipoDocumento'] )?>  <?php //echo($personas[$indice-1]['cedula'])?>
            Prioridad: <?php// echo($personas[$indice-1]['tipoDocumento'] )?> 
            TipoTurno' <?php //echo($personas[$indice-1]['tipoDocumento'] )?> 
            Turno'  //echo($personas[$indice-1]['tipoDocumento'] )-->
          </p>
        </div>
      </div>           
    </div>
    
  </div>




   </div>
</div>

      
  
@endif
     
      
 
  



@stop