<?php
class DBconfig  {
    protected $serverName;
    protected $userName;
    protected $dbpassword;
    protected $dbName;
    
    
    function __construct(){
        $this->serverName="localhost:3308";
        $this->userName="root";
        $this->dbpassword="";
        $this->dbName="magebit";

    }
    
}
?>