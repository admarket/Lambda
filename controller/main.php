<?php
class main extends spController
{
	function index(){
		echo "Enjoy, Speed of PHP!";
		$this->display("view/index.php");
	}
}
