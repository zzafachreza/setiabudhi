<?php

class Payment extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Create Payment';
			$this->load->view('header',$data);
			$this->load->view('payment');
			$this->load->view('footer');
		}
	}
	
	function getKontra(){

		$this->load->view('getKontra');

	}

	function save(){

	
			$this->load->view('payment_create');

	
	}

	function payment_download(){


			$data['title']='Fachreza Maulana | Download Payment';
			$this->load->view('header',$data);
			$this->load->view('payment_download');
			$this->load->view('footer');

	}
	function csv(){
		
			$this->load->view('csv');
	}

	function download(){
		$this->load->view('csv_ok');
	}
}