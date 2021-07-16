<?php

class Antre extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Antrian Supplier';
			$this->load->view('header',$data);
			$this->load->view('antre/view');
			$this->load->view('footer');
		}
	}

	function detail(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | Antrian Supplier Detail';
			$this->load->view('header',$data);
			$this->load->view('antre/data');
			$this->load->view('footer');
		}
	}

	function get_po(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$this->load->view('antre/list');
	
		}
	}


		function data_po2(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$this->load->view('antre/data_po2');
	
		}
	}

	function insert_antrian(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$this->load->view('antre/add');
	
		}
	}

	function get_antrian(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$this->load->view('antre/data_antrian');
	
		}
	}


		function update_status(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$this->load->view('antre/update');
	
		}
	}

	function suara(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$this->load->view('antre/suara');
	
		}
	}



	function suara2(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$this->load->view('antre/suara2');
	
		}
	}

			function download(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$this->load->view('antre/download');
	
		}
	}


		function retur(){

				$SUPPLIER_ID = $this->uri->segment(3);
				$data['SUPPLIER_ID'] = $SUPPLIER_ID;
				$this->load->view('antre/retur',$data);



		}


		function retur_detail(){
				$NO_RETUR = $this->uri->segment(3);
				$data['NO_RETUR'] = $NO_RETUR;
				$this->load->view('antre/retur_detail',$data);
		}

		function hapus(){
			$ID = $this->uri->segment(3);
			$data['ID'] = $ID;
			$this->load->view('antre/hapus',$data);
			redirect('antre/detail');
		}

		function laporan(){
			$data['title']='Fachreza Maulana | Antrian Supplier';
			$this->load->view('header',$data);
			$this->load->view('antre/laporan');
			$this->load->view('footer');
		}

		function download_laporan(){

			$this->load->view('antre/download_laporan');
		
		}

		function analisa(){
			$data['title']='Fachreza Maulana | Analisa Antrian';
			$this->load->view('header',$data);
			$this->load->view('antre/analisa');
			$this->load->view('footer');
		}



	function get_data_po(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$this->load->view('antre/data_po');
	
		}
	}


	function hapus_po(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$this->load->view('antre/hapus_po');
	
		}
	}



	function exp(){
		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$data['title']='Fachreza Maulana | Product Expired';
			$this->load->view('header',$data);
			$this->load->view('antre/exp');
			$this->load->view('footer');
	
		}
	}


	function alias(){
		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$data['title']='Fachreza Maulana | Supplier Alias';
			$this->load->view('header',$data);
			$this->load->view('antre/alias');
			$this->load->view('footer');
	
		}
	}


	function insert_alias(){
		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$this->load->view('antre/insert_alias');
		
	
		}
	}

	function hapus_alias(){
		$ID = $this->uri->segment(3);
			$data['ID'] = $ID;
			$this->load->view('antre/hapus_alias',$data);
			redirect('antre/alias');
	}


	function alias_add(){
		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$data['title']='Fachreza Maulana | Supplier Alias';
			$this->load->view('header',$data);
			$this->load->view('antre/alias_add');
			$this->load->view('footer');
	
		}
	}

	function exp_add(){
		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$data['title']='Fachreza Maulana | Product Expired';
			$this->load->view('header',$data);
			$this->load->view('antre/exp_add');
			$this->load->view('footer');
	
		}
	}

	function hapus_exp(){
		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$ID = $this->uri->segment(3);
			$data['ID'] = $ID;
			$this->load->view('antre/exp_hapus',$data);
			redirect('antre/exp');

	
		}
	}

	function get_sku(){
		
		$this->load->view('antre/get_sku');
	}

	function insert(){
		$this->load->view('antre/insert');
	}


	function serah(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$data['title']='Fachreza Maulana | Serah Terima';
			$this->load->view('header',$data);
			$this->load->view('antre/serah');
			$this->load->view('footer');
	
		}
	}





	function serah_add(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$data['title']='Fachreza Maulana | Serah Terima';
			$this->load->view('header',$data);
			$this->load->view('antre/serah_add');
			$this->load->view('footer');
	
		}
	}

	function serah_view(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$data['title']='Fachreza Maulana | Serah Terima';
			$this->load->view('barcode');
			$this->load->view('phpqrcode/qrlib.php');
			$this->load->view('header',$data);
			$this->load->view('antre/serah_view');
			$this->load->view('footer');
	
		}
	}


	function kirim(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$data['title']='Fachreza Maulana | Print Alamat Supplier';
			$this->load->view('header',$data);
			$this->load->view('antre/kirim');
			$this->load->view('footer');
	
		}
	}



	function kirim_print(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$data['title']='Fachreza Maulana | Print Alamat Supplier';
			$this->load->view('barcode');
			$this->load->view('phpqrcode/qrlib.php');
			$this->load->view('header',$data);
			$this->load->view('antre/kirim_print');
			$this->load->view('footer');
	
		}
	}

	function tolak(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$data['title']='Fachreza Maulana | Print Tolakan Barang';
			$this->load->view('header',$data);
			$this->load->view('antre/tolak');
			$this->load->view('footer');
	
		}
	}



	function tolak_print(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
	
			$data['title']='Fachreza Maulana | Print Tolakan Barang';
			$this->load->view('barcode');
			$this->load->view('phpqrcode/qrlib.php');
			$this->load->view('header',$data);
			$this->load->view('antre/tolak_print');
			$this->load->view('footer');
	
		}
	}

	
}