<?php

namespace App\Http\Controllers;
//by Jason Rizo Perez-Ripperz
use Illuminate\Http\Request;
use\Session;
use\SplDoublyLinkedList;
use\SplFixedArray;

class turnosController extends Controller{
   
public function ingresoClientes(Request $request) {
    
    //Recepción de datos desde el formulario	
    $datosCorrectos=1;
	  $nombres=$request->input('nombres');
    $apellidos=$request->input('apellidos');
    $edad=$request->input('edad');
    $edad = (int) $edad;
    $cedula=$request->input('cedula');
    $cedula= (int) $cedula;
    $ciudad=$request->input('ciudad');
    $turno=$request->input('turno');
    $prioridad=$request->input('prioridad');

	$AuxMatriz;
       
      if ($edad<18||$edad>100) {
          $datosCorrectos=0;
          return view('ErrorEdad');
        }
      
      if(Session::has('matriz')){
     //Le paso los elementos de mi Session:matriz 
    $auxMatriz=Session::get('matriz') ;
    for ($i=0; $i <sizeof($auxMatriz) ; $i++) { 
       
       if ($auxMatriz[$i]['cedula']==$cedula) {
       $encontrado=0;
       return view('ErrorCedula');
       }
     }
   }

if ($datosCorrectos==1) {
  
// Si ya habia ingresado datos
if(Session::has('matriz')){
            
            $dato = Session::get('matriz');
            $dato[] = array( //agrego un nuevo elemento a la matrix
                'nombre'=>$nombres,
                'apellido'=>$apellidos,
                'edad'=>$edad,
                'cedula'=>$cedula,
                'ciudad'=>$ciudad,
                'turno'=>$turno,
                'prioridad'=>$prioridad,
                
            );
            Session::put('matriz', $dato);  
            //Se inserto un nuevo valor


//Transfiero a una matriz auxiliar el contenido de mi Session  
$auxMatriz=Session::get('matriz');

$long=sizeof($auxMatriz);

//Organización por edad
for ($i=1; $i <$long ; $i++) { 
   for ($j=1; $j <$long ; $j++) { 
         //si el elemento de la izquierda es mayor al elemento de la derecha
         if ($auxMatriz[$j-1]['edad']>$auxMatriz[$j]['edad']) {
            //paso a un auxiliar
           $auxNom=$auxMatriz[$j-1]['nombre'];  
           $auxApl=$auxMatriz[$j-1]['apellido'];
           $auxEda=$auxMatriz[$j-1]['edad'];
           $auxCed=$auxMatriz[$j-1]['cedula'];
           $auxCiu=$auxMatriz[$j-1]['ciudad'];
           $auxTur=$auxMatriz[$j-1]['turno'];
           $auxPri=$auxMatriz[$j-1]['prioridad'];  
           // en mi posicion de la izquierda lleno con lo de siguiente posicion
           $auxMatriz[$j-1]['nombre']=$auxMatriz[$j]['nombre'];
           $auxMatriz[$j-1]['apellido']=$auxMatriz[$j]['apellido'];
           $auxMatriz[$j-1]['edad']=$auxMatriz[$j]['edad'];
           $auxMatriz[$j-1]['cedula']=$auxMatriz[$j]['cedula'];
           $auxMatriz[$j-1]['ciudad']=$auxMatriz[$j]['ciudad'];
           $auxMatriz[$j-1]['turno']=$auxMatriz[$j]['turno'];
           $auxMatriz[$j-1]['prioridad']=$auxMatriz[$j]['prioridad'];
           
           //Y a la pos de la derecha le lleno con lo que era de la pos izq
           $auxMatriz[$j]['nombre']=$auxNom;  
           $auxMatriz[$j]['apellido']=$auxApl;
           $auxMatriz[$j]['edad']=$auxEda;
           $auxMatriz[$j]['cedula']=$auxCed;
           $auxMatriz[$j]['ciudad']=$auxCiu;
           $auxMatriz[$j]['turno']=$auxTur;
           $auxMatriz[$j]['prioridad']=$auxPri;

         }
     }  

}     

//by Jason Rizo Perez-Ripperz
//Organización por prioridad
for ($i=1; $i <$long ; $i++) { 
   for ($j=1; $j <$long ; $j++) { 
         //si el elemento de la izquierda es mayor al elemento de la derecha
         if ($auxMatriz[$j-1]['prioridad']>$auxMatriz[$j]['prioridad']) {
            //paso a un auxiliar
           $auxNom=$auxMatriz[$j-1]['nombre'];  
           $auxApl=$auxMatriz[$j-1]['apellido'];
           $auxEda=$auxMatriz[$j-1]['edad'];
           $auxCed=$auxMatriz[$j-1]['cedula'];
           $auxCiu=$auxMatriz[$j-1]['ciudad'];
           $auxTur=$auxMatriz[$j-1]['turno'];
           $auxPri=$auxMatriz[$j-1]['prioridad'];  
           // en mi posicion de la izquierda lleno con lo de siguiente posicion
           $auxMatriz[$j-1]['nombre']=$auxMatriz[$j]['nombre'];
           $auxMatriz[$j-1]['apellido']=$auxMatriz[$j]['apellido'];
           $auxMatriz[$j-1]['edad']=$auxMatriz[$j]['edad'];
           $auxMatriz[$j-1]['cedula']=$auxMatriz[$j]['cedula'];
           $auxMatriz[$j-1]['ciudad']=$auxMatriz[$j]['ciudad'];
           $auxMatriz[$j-1]['turno']=$auxMatriz[$j]['turno'];
           $auxMatriz[$j-1]['prioridad']=$auxMatriz[$j]['prioridad'];
           
           //Y a la pos de la derecha le lleno con lo que era de la pos izq
           $auxMatriz[$j]['nombre']=$auxNom;  
           $auxMatriz[$j]['apellido']=$auxApl;
           $auxMatriz[$j]['edad']=$auxEda;
           $auxMatriz[$j]['cedula']=$auxCed;
           $auxMatriz[$j]['ciudad']=$auxCiu;
           $auxMatriz[$j]['turno']=$auxTur;
           $auxMatriz[$j]['prioridad']=$auxPri;

         }
     }  

}
    //lleno mi matriz con la matriz organizada 
      Session::put('matriz', $auxMatriz);
      

 //si no es el primer dato que ingresare                  
}else{
         $matriz[]=array(
            'nombre'=>$nombres,
            'apellido'=>$apellidos,
            'edad'=>$edad,
            'cedula'=>$cedula,
            'ciudad'=>$ciudad,
            'turno'=>$turno,
            'prioridad'=>$prioridad,
          );
        Session::put('matriz',$matriz);

        //Se creo la variable de session
    }

return view('index');
}//fin del if datos correctos
}//fin funcion

//By Jason Dubian Rizo Perez_ripperz
//====================================================================

public function cajeroPorPrioridad(Request $request) {


$atender=$request->input('atender');

if ($atender=='si') {

    if(Session::has('matriz')){
    
    $listaAux = new SplDoublyLinkedList();
    $auxMatriz=Session::get('matriz'); //Paso los datos a una lista
    
    //Lleno mi lista uno a uno con los datos de la session
    for ($i=0; $i <sizeof($auxMatriz) ; $i++) { 
    $listaAux->push($auxMatriz[$i]);
    $listaAux->next();  
    }
    $index=0;
    
    $clienteAtendido=$listaAux->offsetget($index);//atrapo al cliente 
    //$listaAux->shift();
    $listaAux->offsetUnset($index);//lo borro de mi lista

      if ($listaAux->isEmpty()) {//si la lista esta vacía 
        Session::forget('matriz');    
      }
     
      else{//De lo contrario relleno mi session con los datos de mi lista
        $listaAux->rewind();
        $matrizActualizada;//Envío una matriz

        for ($i=0; $i <sizeof($listaAux) ; $i++) { 
          $matrizActualizada[$i]=$listaAux->offsetget($i);
        }        
      
          Session::put('matriz',$matrizActualizada);  
      }
//=====================================================================
//by Jason Rizo Perez-Ripperz
//Manejo la sesion del cajero #2 y su listado de clientes atendidos
if(Session::has('reporteCaja2')){
            
            $dato = Session::get('reporteCaja2');
            $dato[] = $clienteAtendido; //agrego un nuevo elemento a la matriz                                 
            Session::put('reporteCaja2', $dato);  
            //Se inserto un nuevo valor

            //si no, es el primer dato que ingresare                  
  }else{

        $reporteCaja2[]=$clienteAtendido;
        
        Session::put('reporteCaja2',$reporteCaja2);
        
        //Se creo la variable de session
    }
    return view('cajero2Ocupado');
}//fin del if si matriz tiene datos

  else{   
  return view('bancoVacio');
  }  
       
}//fin del if:atender

else{//Si no presiona el boton de atender
return view('cajeros');
}

}//fin funcion

//====================================================================
//By Jason Dubian Rizo Perez_ripperz
public function cajeroPorCedula(Request $request) {


$atender=$request->input('atender');
$cedulaBuscar=$request->input('cedulaBuscar');
$encontrado=0;//no ha encontrado la cédula buscada
if ($atender=='si') {

    if(Session::has('matriz')){
    
    $listaAux = new SplDoublyLinkedList();
    $auxMatriz=Session::get('matriz'); //Paso los datos a una lista
    
    //Lleno mi lista uno a uno con los datos de la session
    for ($i=0; $i <sizeof($auxMatriz) ; $i++) { 
    $listaAux->push($auxMatriz[$i]);
    $listaAux->next();  
    }
    
    $listaAux->rewind();
    //Recorro cada nodo de mi lista
    for($i=0; $i<sizeof($listaAux);$i++){
      $array = $listaAux->offsetget($i);//extraigo ese nodo en una var.
      if ($array['cedula']==$cedulaBuscar) {//Busco la cédula
        $clienteAtendido=$listaAux->offsetget($i);//Ubico al cliente
        $index=$i;
        $encontrado=1;//encontro la cedula del cliente
      }
      $listaAux->next();//Avanzo un nodo    
     }//fin for
     

     if ($encontrado==0) {//si no encontro la cédula
       return view('cedulaNoEncontrada');
     }
    

     else{//Si encontro la cédula



    //$listaAux->shift();
    $listaAux->offsetUnset($index);//lo borro de mi lista
    $listaAux->rewind();

      if ($listaAux->isEmpty()) {//si la lista esta vacía 
          Session::forget('matriz');    
      }
     
      else{//De lo contrario relleno mi session con los datos de mi lista
      $listaAux->rewind();
        $matrizActualizada;//Envío una matriz

        for ($i=0; $i <sizeof($listaAux) ; $i++) { 
          $matrizActualizada[$i]=$listaAux->offsetget($i);
        }        
      
          Session::put('matriz',$matrizActualizada);  
      }
//By Jason Dubian Rizo Perez_ripperz
//====================================================================
  //Manejo la sesion del cajero #2 y su listado de clientes atendidos
  if(Session::has('reporteCaja1')){
            
            $dato = Session::get('reporteCaja1');
            $dato[] = $clienteAtendido; //agrego un nuevo elemento a la matriz                     

            
            
            Session::put('reporteCaja1', $dato);  
            //Se inserto un nuevo valor

            //si no, es el primer dato que ingresare                  
  }else{

        $reporteCaja1[]=$clienteAtendido;
        
        Session::put('reporteCaja1',$reporteCaja1);
        
        //Se creo la variable de session
    }

    
    return view('cajero1Ocupado');
}//Fin del else de cedula encontrada
  }//fin del if si matriz tiene datos
  

  else{
   
  return view('bancoVacio');
  }  
       
}//fin del if:atender
 else{  

  return view('cajeros');
 
 }


}//fin funcion
//By Jason Dubian Rizo Perez_ripperz
//====================================================================


public function cajeroPorEdad(Request $request) {

$atender=$request->input('atender');



if ($atender=='si') {

    if(Session::has('matriz')){
    
    $listaAux = new SplDoublyLinkedList();
    $auxMatriz=Session::get('matriz'); //Paso los datos a una lista
    
    //Lleno mi lista uno a uno con los datos de la session
    for ($i=0; $i <sizeof($auxMatriz) ; $i++) { 
    $listaAux->push($auxMatriz[$i]);
    $listaAux->next();  
    }

    $edadMayor=0;    
    $listaAux->rewind();
    //Recorro cada nodo de mi lista
    for($i=0; $i<sizeof($auxMatriz);$i++){
      $array = $listaAux->offsetget($i);//extraigo ese nodo en una var.
      if ($edadMayor<$array['edad']) {//Busco la mayor edad
          $edadMayor=$array['edad'];
          $clienteAtendido=$listaAux->offsetget($i);//Ubico al cliente
          $index=$i;
      }
      $listaAux->next();//Avanzo un nodo    
     }//fin for
    
            
    //$listaAux->shift();
    $listaAux->offsetUnset($index);//lo borro de mi lista
    

      if ($listaAux->isEmpty()) {//si la lista esta vacía 
          Session::forget('matriz');    
      }
     
    else{//De lo contrario relleno mi session con los datos de mi lista
      $listaAux->rewind();
        $matrizActualizada;//Envío una matriz

        for ($i=0; $i <sizeof($listaAux) ; $i++) { 
          $matrizActualizada[$i]=$listaAux->offsetget($i);
        }        
      
          Session::put('matriz',$matrizActualizada);  
    }
    
//By Jason Dubian Rizo Perez_ripperz
//====================================================================
  //Manejo la sesion del cajero #3 y su listado de clientes atendidos
  if(Session::has('reporteCaja3')){
            
            $dato = Session::get('reporteCaja3');
            $dato[] = $clienteAtendido; //agrego un nuevo elemento a la matriz                     

            
            
            Session::put('reporteCaja3', $dato);  
            //Se inserto un nuevo valor

            //si no, es el primer dato que ingresare                  
  }else{

        $reporteCaja3[]=$clienteAtendido;
        
        Session::put('reporteCaja3',$reporteCaja3);
        
        //Se creo la variable de session
    }

    
    return view('cajero3Ocupado');

  }//fin del if si matriz tiene datos

  else{
   
  return view('bancoVacio');
  }  
       
}//fin del if:atender


else{
                 
   return view('cajeros');            
   }//fin else





}//fin funcion
//By Jason Dubian Rizo Perez_ripperz




}//fin clase