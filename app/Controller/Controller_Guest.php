<?php
namespace App\Controller;

require 'app/Model/Model_Post.php';
require 'app/Controller/Controller.php';
use App\Model\Model_Post;
use App\Controller\Controller;

class Controller_Guest extends Controller{
    private $db;
    public function __construct(){
        $this->db = new Model_Post;
    }   

    // public function index()
    // {     
    //     $data['posts'] = $this->db->getAll();
    //     $this->loadView('app/View/FrontEnd(Guest)/index', $data); 
    // }

    public function index(){
        if (!isset($_GET['page'])) {
            $page = 1;
        }
        else {
            $page = $_GET['page'];
        }	
		$posts =$this->db->getAll();
        $totalRecord = count($posts);
        $postsPerPage = 3;
        $first_post_of_each_page = ($page-1)*$postsPerPage;
        $data['numberOfPages'] = ceil($totalRecord/$postsPerPage);
		$data['postsByPage'] = $this->db->getPostsByPage($first_post_of_each_page,$postsPerPage);
        $this->loadView("app/View/FrontEnd(Guest)/index", $data);
    }   
    public function post()
    {     
        $postId = $_GET['id'];
        $data['post'] = $this->db->getByid($postId);
        $this->loadView('app/View/FrontEnd(Guest)/post', $data); 
    }
}

$post = new Controller_Guest;
$m = $_GET['method'] ?? 'index';
$post->$m();