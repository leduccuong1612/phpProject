<?php 
namespace App\Config;
class Route
{
	public function manager()
	{	
		require 'app/Controller/Controller_Manager.php';
	}
	public function guest()
	{	
		require 'app/Controller/Controller_Guest.php';
	}
	public function __call($req,$res){
		echo 'Method khong ton tai';
	}
}
$route = new Route;
$c = $_GET['controller'] ?? 'manager';
$route->$c();