<?php
ob_start();
session_start();
require_once dirname(__FILE__).'../../config/Database.php';
class User extends Database{

    public function getAllUser(){
        $query = "SELECT * from users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
          $data = array();
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
          }
        }
        return json_encode($data);
    }

    public function getUser($id){
        $query = "SELECT * from users where id='".$id."'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $password = $row['$password'];
    }

    public function register($name, $email, $phone, $password){
        $hashpassword = md5($password);

        $query = "SELECT * FROM users where email='".$email."'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
          $data['status'] = 'failed';
          $data['msg'] ='The Email is already exist';
        }
        else
        {
          $query = "INSERT INTO  users SET name = '".$name."', email = '".$email."', phone = '".$phone."', password = '".$hashpassword."'";
          $stmt = $this->conn->prepare($query);

          if($stmt->execute())
          {
            $data['status'] = 'success';
            $data['msg'] = 'Successfully Register';
          }
        }
        
        return json_encode($data);
    }

    public function login($email, $password){
      $hashpassword = md5($password);

      $query = "SELECT * FROM users where email ='".$email."'";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if($stmt->rowCount() > 0 )
      {
          if($hashpassword == $row['password']){
            $_SESSION['sid'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['phone'] = $row['phone'];

            $data['status'] = 'success';
            $data['msg'] = $_SESSION['name'];
          }else{
            $data['status'] = 'failed';
            $data['msg'] = 'Password did not Match';
          }
      }else
      {
        $data['status'] = 'failed';
        $data['msg'] = 'Email is not register';
      }
      return json_encode($data);
  }

    public function deleteUser($id){
      $query = "DELETE from users where id='".$id."'";
      $stmt = $this->conn->prepare($query);
      
      if($stmt->execute()){
        $data['status'] = 'success';
        $data['msg'] = 'Successfully Deleted';
      }else{
        $data['status'] = 'failed';
        $data['msg'] = 'error';
      }
      return json_encode($data);
  }

    public function updateUser($name, $email, $phone, $password, $id){
      $query = "UPDATE users SET name = '".$name."', email = '".$email."', phone = '".$phone."', password = '".$hashpassword."' where id='".$id."'";
      $stmt = $this->conn->prepare($query);
      
      if($stmt->execute()){
        $data['status'] = 'success';
        $data['msg'] = 'Successfully Updated';
      }else{
        $data['status'] = 'failed';
        $data['msg'] = 'error';
      }
      return json_encode($data);
  }

}
