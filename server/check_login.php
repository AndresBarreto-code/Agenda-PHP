<?php
    require('recursos/access.php');
    $conexion = new ConectorDB();
    $response['Conexion'] = $conexion->initConexion('agenda');
    if($response['Conexion']=='agenda'){
        $response['Validation']=$conexion->validatePassword('users','mail',$_POST['username'],$_POST['password']);
        if($response['Validation']==true){
            $response['msg']='OK';
        }else{
            $response['msg']='Error in user or password';
        }
    }
    echo json_encode($response);
    $conexion->closeConexion();    
 ?>
