<?php
namespace App\Controller;

require 'app/Model/Model_Post.php';
require 'app/Controller/Controller.php';
use App\Model\Model_Post;
use App\Controller\Controller;


class Controller_Manager extends Controller{
    private $db;
    public function __construct(){
        $this->db = new Model_Post;
    }  
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
        $this->loadView("app/View/BackEnd(Manager)/index", $data);
    }

    public function new()
    { 
        $this->loadView('app/View/BackEnd(Manager)/add_post');
    }
    public function pagination()
    { 
        $this->loadView('app/View/BackEnd(Manager)/pagination');
    }

    public function create()
    {
        if (isset($_POST['btnSubmit']) && isset($_FILES['image'])) {

            $title = $_POST['title'] ?? '';
            $title = strip_tags($title);
           
            $description = $_POST['description'] ?? '';                                         
           
			$status = $_POST['status'] ?? '';
            $status  = is_numeric($status) ? $status : '';
                       
            $extension = explode('.', $_FILES['image']['name']);
            $image =rand() . '.' . $extension[1];
            $destination = $_SERVER['DOCUMENT_ROOT'].'/phpExercise/project1/app/public/picture/'.$image; 
            move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            $this->db->create($title,$description,$image,$status);
			header('Location: http://localhost:8080/phpExercise/project1/index.php'); 
        } else{
            echo "file not found";
        }   
		
	}
    public function edit()
    {
        $id = $_GET['id'] ?? '';
        $id = is_numeric($id) ? $id : 0;
		$data['post'] = $this->db->getById($id);
		$this->loadView('app/View/BackEnd(Manager)/edit_post',$data);	
    }

    public function update()
    {
        if (isset($_POST['btnUpdate'])) {
            $id = $_POST['id'] ?? '';
            $id = is_numeric($id) ? $id : 0;

            $title = $_POST['title'] ?? '';
            $title = strip_tags($title);
           
            $description = $_POST['description'] ?? '';                                         
           
			$status = $_POST['status'] ?? '';
            $status  = is_numeric($status) ? $status : '';

            if(!isset($_FILES['image'])){
                $image = "empty";
                $this->db->update($title,$description,$image,$status,$id);
            }
            else{
                $extension = explode('.', $_FILES['image']['name']);
                $image =rand() . '.' . $extension[1];
                $destination = $_SERVER['DOCUMENT_ROOT'].'/phpExercise/project1/app/public/picture/'.$image;
                move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                $this->db->update($title,$description,$image,$status,$id);
            }
			header('Location: http://localhost:8080/phpExercise/project1/index.php');
        } else{
            echo "file not found";
        }   
    }

    public function post()
    {
        $id = $_GET['id'];
        $data['post'] = $this->db->getById($id);
        $this->loadView('app/View/BackEnd(Manager)/post', $data);
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->db->delete($id);
        header('Location: http://localhost:8080/phpExercise/project1/index.php');
    }
}

$post = new Controller_Manager;
$m = $_GET['method'] ?? 'index';
$post->$m();