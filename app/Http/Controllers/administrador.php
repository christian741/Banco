<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\Session;
use App\no_atendido;
use App\atendido;
use App\cajeros;
use App\usuarios;



class administrador extends Controller
{
     public function datosRegistrados(Request  $request){

         $datosCajeros = cajeros::all();
               $datosAtendidos = atendido::all();
               $datosUsuarios = usuarios::all();
               $datosNoAtendidos = no_atendido::all();

               $usuariosAtendidos=[
                   'total_atendidos'=>$datosAtendidos,
                   'total_usuarios'=>$datosUsuarios,
                   'total_cajeros'=>$datosCajeros ,
                   'total_noatendidos'=>$datosNoAtendidos,
                   
               ];

    	$correo = $request->input('correo');
        $password= $request->input('password');
        

        $correoReal="Administrador@gmail.com";
        $passwordReal="1234";

       
       
        if(strcmp($correo, $correoReal) === 0 && strcmp($password, $passwordReal)===0){
            
            if(Session::has('matriz')==false){
            $nombre="Steven";
             $foto="imagenes/administrador.png";

            if(Session::has('matriz')){
            
            //agrega un nuevo elemento
            $dato = Session::get('matriz');
            $dato[] = array( //lo agrega a la matriz
                'correo'=>$correo,
                'password'=>$password,
                'nombre'=>$nombre,
                'foto'=>$foto,
                
            );


           
            Session::put('matriz',$dato); 
            
            
            }else{

               $matriz[]=array(
                    'correo'=>$correo,
                    'password'=>$password,
                    'nombre'=>$nombre,
                    'foto'=>$foto,
                    
                );
                Session::put('matriz',$matriz);


            }
              
                return view('Administrador/reportesAdmin',$usuariosAtendidos);
            }else{

               $datosCajeros = cajeros::all();
               $datosAtendidos = atendido::all();
               $datosUsuarios = usuarios::all();
               $datosNoAtendidos = no_atendido::all();

               $usuariosAtendidos=[
                   'total_atendidos'=>$datosAtendidos,
                   'total_usuarios'=>$datosUsuarios,
                   'total_cajeros'=>$datosCajeros ,
                   'total_noatendidos'=>$datosNoAtendidos,
                   
               ];
                return view('Administrador/reportesAdmin',$usuariosAtendidos);
            }

        }else{
            
        Session::forget('matriz');
        

        $dataCategoria = cajeros::all();
        $array=$dataCategoria->toArray();
        
        for ($i=0; $i <sizeof($array) ; $i++) { 
            $valor=$array[$i];

            if (strcmp($valor['correo'],$correo)===0 && strcmp($valor['password'],$password)===0){



                if (Session::has('matriz')==false) {
                     
                 if(Session::has('matriz')){
            
                        $dato = Session::get('matriz');
                        $dato[] = array(
                            'cedula'=>$valor['cedula'],
                            'nombre'=>$valor['nombre'],
                            'apellido'=>$valor['apellido'],
                            'correo'=>$valor['correo'],
                            'password'=>$valor['password'],
                            'foto'=>$valor['foto']
                            
                        );                     

                        
                        
                        Session::put('matriz', $dato);  
                                        
                 }else{
                        $dato1[] = array(
                           'cedula'=>$valor['cedula'],
                            'nombre'=>$valor['nombre'],
                            'apellido'=>$valor['apellido'],
                            'correo'=>$valor['correo'],
                            'password'=>$valor['password'],
                            'foto'=>$valor['foto'],
                            
                        );         
                    
                      Session::put('matriz',$dato1);
                      
                 }
                    return view ('Cajero/atenderUsuario');
                
                }else{
                    return view ('Cajero/atenderUsuario');
                }
 
            }
            
        }
              return view ('Administrador/formularioAdministradorError');
        }
       
    }

    public function CerrarSesion(Request  $request){
        if (Session::has('matriz')) {
            Session::forget('matriz');  
             Session::forget('personas');  

        }
        return view('inicio');
    }

    public function CrearCajero(Request  $request){

        $cedula= $request->input('cedula');
        $nombre= $request->input('nombre');
        $apellido= $request->input('apellido');
        $correo= $request->input('correo');
        $password= $request->input('password');

        
        
        /* $file = var_dump($request->file('imagen'));
        //SE OBTIENE EL NOMBRE ORIGINAL DEL ARCHIVO
        $nombre = $file->getClientOriginalName();
        //SE ALMACENA EL ARCHIVO EN EL DISCO
        \Storage::disk('local')->put($nombre , \File::get($file));*/

        
        
        
 
         $cajero = new cajeros ;
         $cajero ['cedula']= $cedula;
         $cajero ['nombre']= $nombre;
         $cajero ['apellido']=$apellido;
         $cajero ['correo']= $correo;
         $cajero ['password']=$password;
         $cajero ['foto']="imagenes/vacio.jpg";
         $cajero ->save();

        return view('Administrador/formularioCajero');
        
    }

    public function traerDatos(){
        $datosCajeros = cajeros::all();
        $datosAtendidos = atendido::all();
        $datosUsuarios = usuarios::all();
        $datosNoAtendidos = no_atendido::all();

        $usuariosAtendidos=[
            'total_atendidos'=>$datosAtendidos,
            'total_usuarios'=>$datosUsuarios,
            'total_cajeros'=>$datosCajeros ,
            'total_noatendidos'=>$datosNoAtendidos,
            
        ];
        return view('',$usuariosAtendidos);

    }
    public function traerUsuario(){
      
        $datosUsuarios = usuarios::all();
       

        $usuariosAtendidos=[
            
            'total_usuarios'=>$datosUsuarios,
          
            
        ];

     

        return view('pantallaTurnos',$usuariosAtendidos);

    }

}
