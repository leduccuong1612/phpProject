<?php 
namespace App\Config;
use \PDO;
class Database {
    public $db;
    
	public function __construct(){
		$this->db = $this->connection();
    }
    
	public function __destruct(){
		$this->db = null;
    }
    
	private function connection(){		
		    $dbh = new PDO('mysql:host=127.0.0.1;dbname=leduccuong;charset=utf8', 'root', 'z123x456');
			$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		    return $dbh;
	}

}