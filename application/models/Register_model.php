<?php

class Register_model extends CI_Model{

	function insert($username,$password,$nama_lengkap){

		$sql = "INSERT INTO users(username,password,nama_lengkap,level) VALUES('$username','$password','$nama_lengkap','Member')";
		if($this->db->query($sql)){
			echo 200;
		}
		

	}




}