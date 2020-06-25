<?php
    require('recursos/access.php');
    $conexion = new ConectorDB();
    $response['Conexion'] = $conexion->initConexion('agenda');
    if($response['Conexion']=='agenda'){
        $response['Crear1']=$conexion->insert('users',["mail","password","full_name","dob"],["'mail@mail.com'","'".password_hash('Apple123', PASSWORD_DEFAULT)."'","'Mail 1 Mail'","'1996-06-20'"]);
        $response['Crear2']=$conexion->insert('users',["mail","password","full_name","dob"],["'mail1@mail.com'","'".password_hash('Banana456', PASSWORD_DEFAULT)."'","'Mail 2 Mail'","'2014-07-15'"]);
        $response['Crear3']=$conexion->insert('users',["mail","password","full_name","dob"],["'mail2@mail.com'","'".password_hash('Candy789', PASSWORD_DEFAULT)."'","'Mail 3 Mail'","'2013-01-12'"]);
    } 

    echo json_encode($response);

    $conexion->closeConexion();

 ?>
