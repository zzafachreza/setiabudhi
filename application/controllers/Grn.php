<?php

class Grn extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Grn';
			$this->load->view('header',$data);
			$this->load->view('grn/view');
			$this->load->view('footer');
		}
	}

	function getSales(){


			$this->load->view('grn/getSales');
		
	}

	function download(){

		$this->load->view('grn/download');
	}
}