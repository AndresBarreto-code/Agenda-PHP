<?php
    require("recursos/access.php");
    $conexion = new ConectorDB();
    $response['Conexion'] = $conexion->initConexion('agenda');
    if($response['Conexion']=='agenda'){
        session_start();
        if(isset($_SESSION['username'])){
            $id_user=$_SESSION['id'];
            $values['start']=$_POST['start_date'];
            $values['end']=$_POST['end_date'];
            $values['startTime']=$_POST['start_hour'];
            $values['endTime']=$_POST['end_hour'];
            $response['msg']=$conexion->updateByIdAndUser('events',$_POST['id'],$id_user,$values);
        }else{
            $response['msg']='Sesion invalida';
        }
    }
    echo json_encode($response);
    $conexion->closeConexion();  
 ?>
