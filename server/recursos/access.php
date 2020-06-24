<?php
    class ConectorDB{
        private $host;
        private $user;
        private $password;
        private $conexion;

        function __construct($host = "localhost", $user = "agenda_user", $password = "12345NextU"){
            $this->host = $host;
            $this->user = $user;
            $this->password = $password;
        }
        function initConexion($db_name = "agenda"){
            $this->conexion = new mysqli($this->host,$this->user,$this->password,$db_name);
            if($this->conexion->connect_error){
                return "Error: ".$conexion->connect_error;
            }else{
                return "Ok";
            }
        }
        function eQuery($query){
            return $this->conexion->query($query);
        }
        function closeConexion(){
            $this->conexion->close();
        }
        function insert($table,$params,$values){
            $query="INSERT INTO "
                    .$table." (".implode(', ',$params).") ".
                    "VALUES (".implode(', ',$values).")";
            $response = $this->conexion->query($query);
            if($response != true){
                return "Error: Verifique los parametros y sus reglas, verifique que no existan parametros duplicados.";
            }else{
                return "Ok";
            }
        }
        

    }
    
?>