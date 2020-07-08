<?php

namespace App\Model;
require 'config/Database.php';
include ('Post.php');

use App\Config\Database;
use App\Model\Post;
use \PDO;
class Model_Post extends Database{

    public function __construct(){
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM post";
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$data = $stmt->fetchAll(PDO::FETCH_CLASS,'App\Model\Post');
				}
			}
			$stmt->closeCursor();
        }
        return $data;	
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM post WHERE id= :id";
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$data = $stmt->fetchAll(PDO::FETCH_CLASS,'App\Model\Post');
				}
			}      
			$stmt->closeCursor();
        }
        return $data;
    }

    public function create($title,$description,$image,$status)
    {
		$create_at = date('Y-m-d H:i:s');
		$update_at = null;
		$sql = "INSERT INTO post(title,description,image,status,CREATE_AT,UPDATE_AT) VALUES (:title,:description,:image,:status,:create_at,:update_at)";
		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(':title',$title,PDO::PARAM_STR);
			$stmt->bindParam(':description',$description,PDO::PARAM_STR);
			$stmt->bindParam(':image',$image,PDO::PARAM_STR);
			$stmt->bindParam(':status',$status,PDO::PARAM_INT);
			$stmt->bindParam(':create_at',$create_at,PDO::PARAM_STR);
			$stmt->bindParam(':update_at',$update_at,PDO::PARAM_STR);
			$stmt->execute();
			$stmt->closeCursor();
        }
    }

    public function update($title,$description,$image,$status,$id)
    {
        $updated_at = date('Y-m-d H:i:s');
        if($image == "empty")
        {
            $sql = "UPDATE post SET title = :title, description = :description, status = :status, update_at = :update_at WHERE id = :id";
        }
        else 
        {
            $sql = "UPDATE post SET title = :title, description = :description, image = :image, status = :status, update_at = :update_at WHERE id = :id";
        }
        $stmt = $this->db->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(':title',$title,PDO::PARAM_STR);
            $stmt->bindParam(':description',$description,PDO::PARAM_STR);
            if($image !== "empty"){
                $stmt->bindParam(':image',$image,PDO::PARAM_STR);
            }
            $stmt->bindParam(':status',$status,PDO::PARAM_INT);
            $stmt->bindParam(':update_at',$updated_at,PDO::PARAM_STR);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
        }
    }

    public function delete($id){
		$sql = "DELETE FROM post WHERE id=:id";
		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			$stmt->execute();
			$stmt->closeCursor();
        }
    }
    public function getPostsByPage($start_from,$limit){
        $sql = "SELECT * FROM post LIMIT :start_from, :limit";
        $stmt = $this->db->prepare($sql);
        if($stmt){
            $stmt->bindParam(':start_from',$start_from,PDO::PARAM_INT);
            $stmt->bindParam(':limit',$limit,PDO::PARAM_INT);          
            if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$data = $stmt->fetchAll(PDO::FETCH_CLASS,'App\Model\Post');
				}
			}      
			$stmt->closeCursor();
        }
        return $data;
    }
}
