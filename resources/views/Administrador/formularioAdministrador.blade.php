@extends('master')
@section('contenido')

		
             <div class="row" style="padding-left: 400px" >
		        <div class="col-md-5 col-md-offset-5">
		        	<div class="panel panel-default">
		        		<div class="panel-heading">
		        			<center><h1 class="panel-title"> Acceso al Banco</h1></center>
		        		</div>
		        		<div class="panel-body">
					          <form action="{{ url('formularioAdmin') }}" method="POST">
					             {{ csrf_field() }}

				        			 <div class="form-group">
				        			 	 <label for="correo">Correo</label>
            							 <input type="email" name="correo" class="form-control" id="" placeholder="Correo" required="">
				        			 </div>
				        			 <div class="form-group">
				        			 	 <label for="password">Contraseña</label>
            							 <input type="text" name="password" class="form-control" id="" placeholder="Contraseña" required="">
				        			 </div>
				        			  <button type="submit" class="btn btn-outline-dark  btn-block" style="padding-left: 100px;padding-right: 100px">Enviar</button>
		        			  </form>
		        		</div>
		        	</div>
		        </div>
		     </div>
		
             

@stop