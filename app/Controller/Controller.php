<?php
namespace App\Controller;
class Controller
{
    protected function loadView($path,$data=[]){
        extract($data);        
		require_once $path.'.php';
	}
}
