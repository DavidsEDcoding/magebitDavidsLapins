<?php 
include_once("app/config/DBconfig.php");

class Database extends DBconfig{
    public $con;
    function __construct(){
        $db=new Dbconfig();
        $this->con= new mysqli($db->serverName, $db->userName, $db->dbpassword,$db->dbName);
    }

    function select($query){
        $result=array();
        $rows=$this->con->query($query);
        while ($obj = $rows->fetch_object()) {
            array_push($result,$obj);
        }
        return $result;
    }    

    function execSQL($query){
       if (!$this->con->query($query)) {
            printf("Error message: %s\n", $this->con->error_list);
        }
    }
    
}

?>
