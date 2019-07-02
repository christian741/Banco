<!DOCTYPE html>
<html lang="en">

	<meta charset="UTF-8">
	<title>Gestión de turnos</title>
  <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/plugin/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="css/plugin/datatables/dataTables.bootstrap.min.css">
  

<head>
	<nav class="navbar navbar-expand-lg navbar-dark bg-success">
	  <img class="navbar-brand" src="imagenes/logo-bogota-blanco.png"
	  ></img>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarColor01">
	    <ul class="navbar-nav mr-auto">
	      
	      <li class="nav-item active">
	           <a class="nav-link" href="Atender" style="color: white">Atender</a>
	      </li>
	      <li class="nav-item active">
	           <a class="nav-link" href="ReportesCajero" style="color: white">Reportes</a>
	      </li>
	      
	      
	    </ul>
	    
	    <li class="form-inline my-2 my-lg-0">
	      
	        <a class="nav-link" href="CerrarSesion" style="color: white">Cerrar Sesión </a>
	    </li>
	     <li class="nav-item active" style="color: white" >
	        <?php 
	      	 if(Session::has('matriz')){
	             foreach (Session::get('matriz') as $array){
	                foreach ($array as $word => $meaning){
	                
	                  if($word=='nombre'){
	                     $valor1=$meaning;
	                      echo $valor1;
	                   }
	                 }
		            }
		          }

	      	?>
	      </li>
	    
	    
  </div>
</nav>
</head>

<body style="background-color: #7DCEA0  ">

@yield('contenidoCajero')         
    
</div>




</body>

</html>