<?php

class Cndn extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | CNDN';
			$this->load->view('header',$data);
			$this->load->view('cndn/view');
			$this->load->view('footer');
		}
	}

	function paymnet(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | CNDN';
			$this->load->view('header',$data);
			$this->load->view('cndn/payment');
			$this->load->view('footer');
		}
	}


	function pa(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Purchase Advance';
			$this->load->view('header',$data);
			$this->load->view('cndn/pa');
			$this->load->view('footer');
		}
	}

	function sa(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Sales Advance';
			$this->load->view('header',$data);
			$this->load->view('cndn/sa');
			$this->load->view('footer');
		}
	}

		function va(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Analisa Voucher';
			$this->load->view('header',$data);
			$this->load->view('cndn/va');
			$this->load->view('footer');
		}
	}



	function download(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Download';
			$this->load->view('cndn/download');
		}
	}

	function downloadpa(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Download';
			$this->load->view('cndn/downloadpa');
		}
	}

	function downloadsa(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Download';
			$this->load->view('cndn/downloadsa');
		}
	}


	function downloadva(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Download';
			$this->load->view('cndn/downloadva');
		}
	}


	function pembelian(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Analisa Pembelian';
			$this->load->view('header',$data);
			$this->load->view('cndn/pembelian');
			$this->load->view('footer');
		}
	}

		function downloadpembelian(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Download';
			$this->load->view('cndn/downloadpembelian');
		}
	}


		function service(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana |PO Biaya';
			$this->load->view('header',$data);
			$this->load->view('cndn/service');
			$this->load->view('footer');
		}
	}

		function downloadservice(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Download';
			$this->load->view('cndn/downloadservice');
		}
	}


	 function inv(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana |PO Biaya';
			$this->load->view('header',$data);
			$this->load->view('cndn/inv');
			$this->load->view('footer');
		}
	}

		function downloadinv(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Download';
			$this->load->view('cndn/downloadinv');
		}
	}

}