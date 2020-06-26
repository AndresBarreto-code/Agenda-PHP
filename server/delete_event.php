<?php
    require('recursos/access.php');
    $conexion = new ConectorDB();
    $response['Conexion']=$conexion->initConexion('agenda');
    if($response['Conexion']=='agenda'){
        session_start();
        if(isset($_SESSION['username'])){
            $response['msg']=$conexion->deleteByIdAndUser('events',$_POST['id'],$_SESSION['id']);
        }else{
            $response['msg']='Sesion invalida';
        }
    }else{
        $response['msg']='Error al conectar con la base de datos';
    }
    $conexion->closeConexion();  
    echo json_encode($response);
 ?>
