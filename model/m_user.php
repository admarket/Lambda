<?php
class m_user extends spModel
{
  var $pk = "id";
  var $table = "user";

  /**
   * login user by email and password
   */
  public function login($email, $password) {
      $password = $this->hashPass($password);
      $conditions = array(
        "email" => $email,
        "password" => $password,
       );
      $result = $this->findAll($conditions);
      if (count($result) > 0) {
        	$_SESSION['user'] = $result[0];
          return true;
      }else{
        return false;
      }

  }
  //encrypt password
  function hashPass($originalPass) {
    return md5($originalPass);
  }
  /**
   * add user by email and password
   */
  public function add($new_user){
    $new_user['password'] = $this->hashPass($new_user['password']);
    $result = $this->create($new_user);
    return $result;
  }

  /**
   * check email exist or not
   */
  public function checkEmail($email){
    $condition = array("email" => $email);
    $result = $this->findAll($condition);
    if (count($result)>0) {
      return true;
    }else{
      return false;
    }
  }

  /**
   * check name exist or not
   */
  public function checkName($name){
    $condition = array("name" => $name);
    $result = $this->findAll($condition);
    if (count($result)>0) {
      return true;
    }else{
      return false;
    }
  }
}
