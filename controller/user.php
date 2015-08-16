<?php
class user extends spController
{
	public function __construct(){
		  parent::__construct(); // 要先启动父类的构造函数
		 if($_SESSION['user']==""){
				 $this->jump(spUrl('main', 'login'));
		 }
  }
	function dashboard(){
		dump($_SESSION['user']);
		$this->display("view/index.php");
	}
	function getUserJsonBySessionID(){
		$user = spClass("m_user");
		$conditions = array("id" => $_SESSION['user']['id']);
		$records = $user->find($conditions);
		$invite_code=$this->encryptEmail($_SESSION['user']['id']);
		//$invent_code=mcrypt_encrypt(MCRYPT_RIJNDAEL_256, "6461772803150152", $_SESSION['user']['id'], MCRYPT_MODE_CBC,"8105547186756005");
		//dump($invent_code);
		if($records){

			$records['code']=$invite_code;
			echo json_encode($records);
		}else{
			echo "0";
		}

	}

	 function encryptEmail($orginalEmail) {
        $date = date("Ymd H:i:s",time());
        $orginalEmail = $orginalEmail."&".$date;
        $encrypttedEmail = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, "6461772803150152", $orginalEmail, MCRYPT_MODE_CBC,"8105547186756005");
        //$encrypttedEmail = $orginalEmail;
        $encrypttedEmail = base64_encode($encrypttedEmail);
        $encrypttedEmail = urlencode($encrypttedEmail);
        return $encrypttedEmail;
    }
	//登录
	function login(){
		$user = spClass("m_user");
		$email=$this->spArgs("email"); // 用spArgs接收spUrl传过来的ID
		$password=$this->spArgs("password");
		$result = $user->login($email, $password);
		if($result){
			echo json_encode(array(
				'status'=>0
			));
		}else{
			echo json_encode(array(
				'status'=>1
			));
		}


	}

	//校验密码是否一致
	function checkPass($password, $passwordInDb) {
		$passwordAfter = $this->hashPass($password);
		return $passwordAfter == $passwordInDb;
	}

	//充值
    function recharge() {
        $this->display("recharge.php");
    }

    //对原始密码加密
    function hashPass($originalPass) {
    	return md5($originalPass);
    }

    //注册
    function register(){
	    $user = spClass("m_user");

			$email = $this->spArgs("email"); // 用spArgs接收spUrl传过来的ID
			$password = $this->spArgs("password");
			$name = $this->spArgs("name");

			$message  = array();
			if(strlen($name)<4 || strlen($name)>20){
				array_push($message, 'Name should be 4-20 long');
			}
			if(strlen($password)<4 || strlen($password)>20){
				array_push($message, 'Password should be 4-20 long');
			}
			$email_result = $user->checkEmail($email);
			if($email_result){
				array_push($message, 'Account with such email already exists!');
			}
			$name_result = $user->checkName($name);
			if($name_result){
				array_push($message, 'Account with such name already exists!');
			}
			if(!$email_result && !$name_result){
				$newrow = array(
		            "email" => $email ,
		            "password" => $password,
		            "name" => $name,
		        );
			}
			if(count($message)>0){
				$result = 1;
			}else{
				$result = 0;
			}
			echo json_encode(array(
				'status' => $result,
				'message' => $message
			));
    }

    //验证邮箱
    function verify(){
    	$user = spClass("user");
    	$email=$this->spArgs("ticket"); // 用spArgs接收spUrl传过来的email
    	$email=$this->decryptEmail($email);
    	$conditions = array("email"=>$email); // 查找email是$email的记录
        $newrow = array(
                'verify' => 1,  // 然后将这条记录的name改成“喜羊羊”
        );
        $user->update($conditions, $newrow); // 更新记录
        $this->jump(spUrl('sub', 'dashboard'));
    }
    //解密获取加密字符串中的email
    function decryptEmail($crypttedEmail) {
    	$emailContainer = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, "6461772803150152", base64_decode(urldecode($crypttedEmail)), MCRYPT_MODE_CBC,"8105547186756005");
    	$elements = explode("&", $emailContainer);
    	return $elements[0];
    }

    function checkSession(){
    	if(isset($_SESSION['user'])){
    		echo 1;
    	}else{
    		echo 0;
    	}
    }
    //保存设置
    function save(){
    	$user = spClass("user");
    	$id=$_SESSION['user']['id'];
    	$phone=$this->spArgs("phone"); // 用spArgs接收spUrl传过来的email// 用spArgs接收spUrl传过来的email
    	$account=$this->spArgs("account");//提现账号
		$type=$this->spArgs("type");//身份类型
		$payment=$this->spArgs("payment");//身份类型
    	$conditions = array("id"=>$id); // 查找email是$email的记录
        $newrow = array(
                'mobilephone' => $phone,  // 然后将这条记录的name改成“喜羊羊”
                'account' => $account,
                'type' => $type,
                'payment'=>$payment,
        );
        $checkconditions = array("mobilephone" => $phone);
		$result = $user->findAll($checkconditions);
        if($phone!=$_SESSION['user']['mobilephone']){
			if($result){
				echo "操作失败：该手机号码已经被注册！";
	        }else{
	        	$user->update($conditions, $newrow); // 更新记录
	        	$_SESSION['user']['type']=$type;
		        echo "1"; // 首页
	        }
	    }else{
	    		$user->update($conditions, $newrow); // 更新记录
	    		$_SESSION['user']['type']=$type;
	        	echo "1"; // 首页
	    }

    }
    function changePassword(){
    	$user = spClass("user");
    	$id=$_SESSION['user']['id'];
    	$oldPassword=$this->hashPass($this->spArgs("oldPassword")); // 用spArgs接收spUrl传过来的email// 用spArgs接收spUrl传过来的email
    	$newPassword=$this->hashPass($this->spArgs("newPassword"));//提现账号
    	$conditions = array("id"=>$id,"password"=>$oldPassword); // 查找email是$email的记录
        $newrow = array(
                'password' => $newPassword,  // 然后将这条记录的name改成“喜羊羊”
        );
		$result = $user->findAll($conditions);
			if(!$result){
				echo "操作失败：旧密码错误！请检查后重新输入";
	        }else{
	        	$user->update($conditions, $newrow); // 更新记录
		        $_SESSION['user']['password'] = $newPassword;
		        echo "1"; // 首页
	        }

    }

    //上传头像
    function uploadHeadimg(){
    	$filename=$_FILES['file']['name'];
        $ext=end(explode('.', $filename));
	  	$arg = array(
		APP_PATH.'/img/head/',
		$_SESSION["user"]["id"]
		);
		$upFlie=spClass("uploadFile", $arg); // 注意第二个参数是数组
	    $result=$upFlie->upload_file($_FILES['file']);
	    $msg=$upFlie->errmsg;
	    if($result){
	    	$user = spClass("user");
	    	$id=$_SESSION['user']['id'];
	    	$conditions = array("id"=>$id); // 查找email是$email的记录
	        $newrow = array(
	                'headimg' => $id.".".$ext,  // 然后将这条记录的name改成“喜羊羊”
	        );
	        $user->update($conditions, $newrow); // 更新记录
	        $_SESSION['user']['headimg'] = $id.".".$ext;
	     echo "true";
	    }else {
	     echo "操作失败：".$msg;
	    }

    }

    //切换身份
    function changeIdentity(){

    	if($_SESSION['user']['type']==0){
    		$_SESSION['user']['type'] = 1;
    		$this->jump(spUrl('sub', 'sitemanage')); // 跳转到首页
    	}else{
    		$_SESSION['user']['type'] = 0;
    		$this->jump(spUrl('sub', 'product')); // 跳转到首页
    	}
    	//$this->jump($_SERVER['HTTP_REFERER']);跳转到之前的页面

    }
    //找回密码
    function forget(){
    	$user = spClass("user");
		$email=$this->spArgs("email"); // 用spArgs接收spUrl传过来的ID
		$conditions = array("email" => $email);
		$result = $user->find($conditions);
		if($result){
			$mail = spClass('spEmail');
	        $email=$this->spArgs("email"); // 用spArgs接收spUrl传过来的email


	        $password = $this->create_password(12);
		    $newPassword=$this->hashPass($password);
		    $newrow = array(
	                'password' => $newPassword,  // 然后将这条记录的name改成“喜羊羊”
	        );
	        $user->update($conditions, $newrow); // 更新记录
	        $tool = spClass('tool');
            $addition='<p>此密码是由系统随机生成，请尽快<a href="http://www.eadmarket.com/main/login.html">登录系统</>后重新修改密码</p>';
            $mailsubject = "广告市场-找回密码";//邮件主题
            $mailbody = '<h4><span style="font-weight:bold;"> 您的账户当前密码是：</span></h4><p> <span style="color:red;">'.$password.'</span></p>'.$addition;//邮件内容
            $result=$tool->sendEmail($email, $mailsubject, $mailbody);

	        if($result){
	        	echo "successful";
	        }else{
	        	echo "未知原因导致邮件发送失败！";
	        }
		}else{
			echo "该邮箱尚未注册！";
		}

    }
    function create_password($pw_length = 8)
	{
		$randpwd='';
	    for ($i = 0; $i < 12; $i++)
		    {
		        $randpwd .= chr(mt_rand(33, 126));
		    }
	    return $randpwd;
	}
}
