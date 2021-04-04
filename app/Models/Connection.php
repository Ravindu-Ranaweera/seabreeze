<?php 

class Connection {
    protected $connection;

    public function __construct() {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'seabreeze';
    
        $this->connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    }

}
