@extends('master')

@section('contenido')

<section class="conteiner" style="padding-top: 20px;padding-right: 100px;padding-left: 100px;">
  <form action="{{ url('formularioNormal')}}" method="POST">
      {{ csrf_field()}}
     <div class="conteiner">
            <h1>Registar Turno</h1>
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
             <label for="tipoDocumento">Tipo de Documento</label>
             <select name="tipoDocumento" class="form-control">
             <option>C.C</option>
             <option>T.I</option>
             </select>
             </div>
             <div class="form-group col-md-6">
             <label for="numeroDocumento">Numero de Documento</label>
             <input type="text" name="cedula" class="form-control" id="" placeholder="Numero de Documento">
             </div>
             </div>
             </div>
             <div class="form-row">
             <div class="form-group col-md-6">
             <label for="tipoTurno">Tipo de Turno</label>
             <select name="tipoTurno" class="form-control">
             <option>1. Consignacion</option>
             <option>2. Retiro</option>
             <option>3. Consulta Administrativa</option>
             </select>
             </div>
              <div class="form-group col -md-6">
             <label for="prioridad">Tipo de Persona</label>
             <select name="prioridad" class="form-control">
             <option>1. Mujer Embarazada</option>
             <option>2. Persona de tercera edad</option>
             <option>3. Persona con discapacidad</option>
             <option>4. Afiliado</option>
             <option>5. Mujer</option>
             <option>6. Hombre</option>
             </select>
             </div>
             </div>
            <center><button type="submit" class="btn btn-outline-dark" style="padding-left: 100px;padding-right: 100px">Enviar</button ></center> 
  </form>
</section>




@stop
