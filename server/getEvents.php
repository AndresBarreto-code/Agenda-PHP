<?php
    require('recursos/access.php');
    function getDataEvent($id=106){
        $conexion = new ConectorDB();
        $response['Conexion'] = $conexion->initConexion('agenda');
        if($response['Conexion']=='agenda'){
            $rows=$conexion->getRegisterBy('events','id_user',$id,'id,title,start,end,startTime,endTime,allDay');
            $elements=array();
            foreach($rows as $element){
                $arrayE=array();
                $arrayE["id"]=$element['id'];
                $arrayE["title"]=$element['title'];
                $arrayE["start"]=$element['start'].' '.rtrim(rtrim($element['startTime'],'00'),':');
                $arrayE["end"]=$element['end'].' '.rtrim(rtrim($element['endTime'],'00'),':');
                if($element['allDay']==1){
                    $arrayE["allDay"]=true;
                }else{
                    $arrayE["allDay"]=false;
                }
                array_push($elements,$arrayE);
            }
        }else{
            $elements = 'Error en conexion';
        }
        return $elements;
        $conexion->closeConexion();  
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
