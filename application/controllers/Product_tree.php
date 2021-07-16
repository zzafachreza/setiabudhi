<?php

class Product_tree extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Purchasing';
			$this->load->view('header',$data);
			$this->load->view('product_tree/view');
			$this->load->view('footer');
		}
	}

	function tree(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Purchasing';
			$this->load->view('product_tree/tree');
		}
	}

	function uom(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Purchasing';
			$this->load->view('product_tree/uom');;
		}
	}

	function barcode(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Purchasing';
			$this->load->view('product_tree/barcode');
		}
	}

	function promo(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Purchasing';
			$this->load->view('product_tree/promo');
		}
	}


	function sales(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Sales Analysis';
			$this->load->view('header',$data);
			$this->load->view('product_tree/sales');
			$this->load->view('footer');
		}
	}

		function po(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Create PO';
			$this->load->view('header',$data);
			$this->load->view('product_tree/po');
			$this->load->view('footer');
		}
	}


	function data_sales(){

	
			$this->load->view('product_tree/data_sales');
		

			
		
	}


	function download_sales(){

	
			$this->load->view('product_tree/download_sales');
		
		
	}


		function sla_excel(){

	
			$this->load->view('product_tree/sla_excel');
		
		
	}


	function sla(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Sales Analysis';
			$this->load->view('header',$data);
			$this->load->view('product_tree/sla');
			$this->load->view('footer');
		}
	}

	function pindah(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Sales Analysis';
			$this->load->view('header',$data);
			$this->load->view('product_tree/pindah');
			$this->load->view('footer');
		}
	}


	function harga(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Tarik HArga Jual';
			$this->load->view('header',$data);
			$this->load->view('product_tree/harga');
			$this->load->view('footer');
		}
	}


		function harga_excel(){

	
			$this->load->view('product_tree/harga_excel');
		
		
	}

	function getSales(){


			$this->load->view('product_tree/getSales');
		
	}

	function getSku(){


			$this->load->view('product_tree/getSku');
		
	}
	function getSkuDetail(){


			$this->load->view('product_tree/getSkuDetail');
		
	}

	


}