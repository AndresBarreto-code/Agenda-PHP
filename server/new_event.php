<?php
    require("recursos/access.php");
    $conexion = new ConectorDB();
    $response['Conexion'] = $conexion->initConexion('agenda');
    if($response['Conexion']=='agenda'){
        session_start();
        if(isset($_SESSION['username'])){
            $response['msg']='OK';
            $id=$_SESSION['id'];
        }else{
            $response['msg']='Sesion invalida';
        }
        if($_POST['allDay']){
            $params=["title","start","allDay","id_user"];
            $values=["'".$_POST['titulo']."'",
                    "'".$_POST['start_date']."'",
                    "'1'",
                    "'".$id."'"];
        }else{
            $params=["title","start","startTime","end","endTime","allDay","id_user"];
            $values=["'".$_POST['titulo']."'",
                    "'".$_POST['start_date']."'",
                    "'".$_POST['start_hour']."'",
                    "'".$_POST['end_date']."'",
                    "'".$_POST['end_hour']."'",
                    "'0'",
                    "'".$id."'"];
        }
        $response['msg'] = $conexion->insert('events',$params,$values);
    }else{
        $response['msg'] = "Problemas con la conexion a la base datos";
    }
    echo json_encode($response);
    $conexion->closeConexion();  
 ?>
