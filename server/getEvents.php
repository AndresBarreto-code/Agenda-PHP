<?php
    require('recursos/access.php');
    function getDataEvent($id=106){
        $conexion = new ConectorDB();
        $response['Conexion'] = $conexion->initConexion('agenda');
        if($response['Conexion']=='agenda'){
            $rows=$conexion->getRegisterBy('events','id_user',$id,'id,title,start,end,startTime,endTime,allDay');
        }else{
            $rows = 'Error en conexion';
        }
        return $rows;
    }
    session_start();
    if(isset($_SESSION['username'])){
        $response['msg']='OK';
        $response['eventos']=getDataEvent($_SESSION['id']);
    }else{
        $response['msg']='Sesion invalida';
    }
    echo json_encode($response);
 ?>
