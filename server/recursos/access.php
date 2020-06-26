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
                return $db_name;
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
                    "VALUES (".implode(', ',$values).");";
            $response = $this->conexion->query($query);
            if($response != true){
                return "Error: Verifique los parametros y sus reglas, verifique que no existan parametros duplicados.".$query;
            }else{
                return "Ok";
            }
        }
        function validatePassword($table,$nameColumnUser='user',$user,$password){
            $query="SELECT * FROM ".$table.
                    " WHERE ".$nameColumnUser."='".$user."';";
            $result = $this->conexion->query($query)->fetch_assoc();
            session_start();
            $_SESSION["id"]=$result['id'];
            $_SESSION["username"]=$result['full_name'];
            $_SESSION["dob"]=$result['dob'];

            return password_verify($password, $result['password']);
        }      
        function getRegisterBy($table,$param,$id,$valuesToRetrun='*'){
            $query="SELECT ".$valuesToRetrun." FROM ".$table." WHERE ".$param."=".$id.";";
            $result = $this->conexion->query($query);
            $values=array();
            while ($row = $result->fetch_assoc()) {
                array_push($values,$row);
            }
                    
            return $values;
        }
        function deleteByIdAndUser($table,$id,$id_user){
            $query = "DELETE FROM ".$table." WHERE id=".$id." AND id_user=".$id_user;
            $response = $this->conexion->query($query);
            if($response != true){
                return "Error: Verifique los parametros y sus reglas.".$query;
            }else{
                return "OK";
            }

        }
    }
?>