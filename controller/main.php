<?php
class main extends spController
{
	function index(){
		$this->display("view/index.php");
	}
	function login(){
		$this->display("view/login.php");
	}
	function signup(){
		$this->display("view/signup.php");
	}
}
