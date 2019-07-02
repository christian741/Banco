<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\usuarios;
use\Session;
use App\no_atendido;
use App\atendido;
use App\cajeros;
use\SplDoublyLinkedList;
use\SplFixedArray;

class personas extends Controller
{
   
    public function datosRegistrados(Request  $request){//,personas $acumulador){

    	$nombre= $request->input('nombre');
        $apellido= $request->input('apellido');
        $tipoDocumento =$request->input('tipoDocumento');
        $numeroDocumento= $request->input('cedula');
        $prioridad= $request->input('prioridad');
        $tipoTurno= $request->input('tipoTurno');
        $fecha_actual = date('Y-m-d'); 

        

        $prioridad1="1. Mujer Embarazada";
        $prioridad2="2. Persona de tercera edad";
        $prioridad3="3. Persona con discapacidad";
        $prioridad4="4. Afiliado";
        $prioridad5="5. Mujer";     
        $prioridad6="6. Hombre";  

       
         $usuarios1= new usuarios;
         $dataUsuarios = usuarios::all();
        $acumulador=sizeof($dataUsuarios);

    

        if (strcmp($prioridad1,$prioridad )===0) {
            $acumulador++;
            $turno="A".$acumulador;
        }
        elseif (strcmp($prioridad2,$prioridad )===0) {
            $acumulador++;
            $turno="B".$acumulador;
        }elseif (strcmp($prioridad3,$prioridad )===0) {
            $acumulador++;
            $turno="C".$acumulador;
        }elseif (strcmp($prioridad4,$prioridad )===0) {
            $acumulador++;
            $turno="D".$acumulador;
        }elseif (strcmp($prioridad5,$prioridad )===0) {
            $acumulador++;
            $turno="E".$acumulador;
        }elseif (strcmp($prioridad6,$prioridad )===0) {
            $acumulador++;
            $turno="F".$acumulador;
        }
         $idUsuario=$dataUsuarios->count();
         $idUsuario++;
         $usuarios1['id_usuario']= $idUsuario;
         $usuarios1['cedula']= $numeroDocumento;
         $usuarios1['tipo_documento']= $tipoDocumento;
         $usuarios1['nombre']=$nombre;
         $usuarios1['apellido']=$apellido;
         $usuarios1['turno']= $turno;
         $usuarios1['fecha']=$fecha_actual;
         $usuarios1['tipoTurno']=$tipoTurno;
         $usuarios1['prioridad']=$prioridad;
         $usuarios1->save();
        // Si ya habia ingresado datos
if(Session::has('personas')){
            
            $datoPersonas = Session::get('personas');
            $datoPersonas[] = array( 

                 'nombre'=>$nombre,
                 'apellido'=>$apellido,
                 'tipoDocumento'=>$tipoDocumento,
                 'cedula'=>$numeroDocumento,
                 'prioridad'=>$prioridad,
                 'tipoTurno'=>$tipoTurno,
                 'fecha_actual'=>$fecha_actual,
                 'turno'=>$turno,

            );
            Session::put('personas', $datoPersonas);  
            //Se inserto un nuevo valor


//Transfiero a una matriz auxiliar el contenido de mi Session  
$auxMatriz=Session::get('personas');

$long=sizeof($auxMatriz);

//Organización por prioridad
for ($i=1; $i <$long ; $i++) { 
   for ($j=1; $j <$long ; $j++) { 
         //si el elemento de la izquierda es mayor al elemento de la derecha
         if ($auxMatriz[$j-1]['prioridad']>$auxMatriz[$j]['prioridad']) {

            echo "aca llegue si organiza";
            //paso a un auxiliar
           $auxNom=$auxMatriz[$j-1]['nombre'];  
           $auxApl=$auxMatriz[$j-1]['apellido'];
           $auxtipoDoc=$auxMatriz[$j-1]['tipoDocumento'];
           $auxCed=$auxMatriz[$j-1]['cedula'];
           $auxPri=$auxMatriz[$j-1]['prioridad'];
           $auxTipoTur=$auxMatriz[$j-1]['tipoTurno'];
           $auxfecha=$auxMatriz[$j-1]['fecha_actual'];
           $auxTurn=$auxMatriz[$j-1]['turno'];
           // en mi posicion de la izquierda lleno con lo de siguiente posicion
           $auxMatriz[$j-1]['nombre']=$auxMatriz[$j]['nombre'];
           $auxMatriz[$j-1]['apellido']=$auxMatriz[$j]['apellido'];
           $auxMatriz[$j-1]['tipoDocumento']=$auxMatriz[$j]['tipoDocumento'];
           $auxMatriz[$j-1]['cedula']=$auxMatriz[$j]['cedula'];
           $auxMatriz[$j-1]['prioridad']=$auxMatriz[$j]['prioridad'];
           $auxMatriz[$j-1]['tipoTurno']=$auxMatriz[$j]['tipoTurno'];
           $auxMatriz[$j-1]['fecha_actual']=$auxMatriz[$j]['fecha_actual'];
           $auxMatriz[$j-1]['turno']=$auxMatriz[$j]['turno'];
           //Y a la pos de la derecha le lleno con lo que era de la pos izq
           $auxMatriz[$j]['nombre']=$auxNom;  
           $auxMatriz[$j]['apellido']=$auxApl;
           $auxMatriz[$j]['tipoDocumento']=$auxtipoDoc;
           $auxMatriz[$j]['cedula']=$auxCed;
           $auxMatriz[$j]['prioridad']=$auxPri;
           $auxMatriz[$j]['tipoTurno']=$auxTipoTur;
           $auxMatriz[$j]['fecha_actual']=$auxfecha;
           $auxMatriz[$j]['turno']=$auxTurn;

         }
     }  

}

    //lleno mi matriz con la matriz organizada 
      Session::put('personas', $auxMatriz);
      

 //si no es el primer dato que ingresare                  
}else{
         $matrizPersonas[]=array(
                  'nombre'=>$nombre,
                 'apellido'=>$apellido,
                 'tipoDocumento'=>$tipoDocumento,
                 'cedula'=>$numeroDocumento,
                 'prioridad'=>$prioridad,
                 'tipoTurno'=>$tipoTurno,
                 'fecha_actual'=>$fecha_actual,
                 'turno'=>$turno,
          );
        Session::put('personas',$matrizPersonas);

        
    }

    $datosAtendidos = atendido::all();
  $datosUsuarios = usuarios::all();
  $datosNoAtendidos = no_atendido::all();

       $usuariosAtendidos=[
            'total_atendidos'=>$datosAtendidos,
            'total_usuarios'=>$datosUsuarios,
            'total_noatendidos'=>$datosNoAtendidos,
        ];
    return view('pantallaTurnos',$usuariosAtendidos);
    //Session::forget('personas');
}


public function llamarPersona(Request $request) {


  $atender=$request->input('atender');

  if ($atender=='si') {

    if(Session::has('personas')){       
    
        $listaAux = new SplDoublyLinkedList();
        $auxMatriz=Session::get('personas'); //Paso los datos a una lista
    
      //Lleno la lista uno a uno con los datos de la session
        for ($i=0; $i <sizeof($auxMatriz) ; $i++) { 
          $listaAux->push($auxMatriz[$i]);
          $listaAux->next();  
        }
        $index=0;  



        $clienteAtendido=$listaAux->offsetget($index);//atrapo al cliente 
       

        $auxCajero=Session::get('matriz');

        $indexCajero=sizeof($auxCajero);
        $indexCliente=sizeof($auxMatriz);

        $atendidoCliente = new atendido;
        $dataUsuarios = atendido::all();
        $idAtendido=$dataUsuarios->count();
        $idAtendido++;

        $atendidoCliente['id_atendidos']= $idAtendido;


        $atendidoCliente['id_cajero']=(int)$auxMatriz[$indexCliente-1]['cedula'];
        $atendidoCliente['id_usuario']=(int)$auxCajero[$indexCajero-1]['cedula'];

         $atendidoCliente->save();

        
        $listaAux->offsetUnset($index);//lo borro de mi lista

      if ($listaAux->isEmpty()) {//si la lista esta vacía 
          Session::forget('personas');    

      }else{//De lo contrario relleno mi session con los datos de mi lista
        
        $listaAux->rewind();
        $matrizActualizada;//Envío una matriz

        for ($i=0; $i <sizeof($listaAux) ; $i++) { 
          $matrizActualizada[$i]=$listaAux->offsetget($i);
        }        
      
          Session::put('personas',$matrizActualizada);  
      }

      $datosAtendidos = atendido::all();
  $datosUsuarios = usuarios::all();
  $datosNoAtendidos = no_atendido::all();

       $usuariosAtendidos=[
            'total_atendidos'=>$datosAtendidos,
            'total_usuarios'=>$datosUsuarios,
            'total_noatendidos'=>$datosNoAtendidos,
        ];


     

    return view('Cajero/reporteCajeros',$usuariosAtendidos);
}else{ 

  return view('Cajero/bancoVacio');
}  
       
  }else{  
        return view('Cajero/atenderUsuario');
  }

}

public function noAtenderPersona(Request $request) {


  $atender=$request->input('atender');

  if ($atender=='si') {

    if(Session::has('personas')){       
    
        $listaAux = new SplDoublyLinkedList();
        $auxMatriz=Session::get('personas'); //Paso los datos a una lista
    
      //Lleno la lista uno a uno con los datos de la session
        for ($i=0; $i <sizeof($auxMatriz) ; $i++) { 
          $listaAux->push($auxMatriz[$i]);
          $listaAux->next();  
        }
        $index=0;  

        $clienteAtendido=$listaAux->offsetget($index);//atrapo al cliente 
        $cajero=Session::get('matriz');


        $indexCliente= sizeof($auxMatriz);
        $indexCajero=sizeof($cajero);

        $atendidoCliente = new no_atendido;
        $idAtendido=$dataUsuarios->count();
        $idAtendido++;
        $atendidoCliente['id_no_atendidos']= $idAtendido;
        $atendidoCliente['id_cajero']=(int)$auxMatriz[$indexCliente-1]['cedula'];
        $atendidoCliente['id_usuario']= (int)$auxCajero[$indexCajero-1]['cedula'];

         $atendidoCliente->save();

        
        $listaAux->offsetUnset($index);//lo borro de mi lista

      if ($listaAux->isEmpty()) {//si la lista esta vacía 
          Session::forget('personas');    

      }else{//De lo contrario relleno mi session con los datos de mi lista
        
        $listaAux->rewind();
        $matrizActualizada;//Envío una matriz

        for ($i=0; $i <sizeof($listaAux) ; $i++) { 
          $matrizActualizada[$i]=$listaAux->offsetget($i);
        }        
      
          Session::put('personas',$matrizActualizada);  
      }

     

    return view('Cajero/cajeroOcupado');
}else{ 

  return view('Cajero/bancoVacio');
  }  
       
  }else{  
        return view('Cajero/atenderUsuario');
  }

}

public function traerCajero (){

  $datosAtendidos = atendido::all();
  $datosUsuarios = usuarios::all();
  $datosNoAtendidos = no_atendido::all();

       $usuariosAtendidos=[
            'total_atendidos'=>$datosAtendidos,
            'total_usuarios'=>$datosUsuarios,
            'total_noatendidos'=>$datosNoAtendidos,
        ];


     

    return view('Cajero/reporteCajeros',$usuariosAtendidos);

}
    
}
