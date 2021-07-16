<?php

class Store extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | PRINT POP';
			$this->load->view('header',$data);
			$this->load->view('store/list');
			$this->load->view('footer');
	
		}
	}


// discount

	function print_pop(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$data['title']='Fachreza Maulana | PRINT POP';
			$this->load->view('store/pop');
	
		}
	}

// generate kupon

	// discount

	function kupon(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | PRINT KUPON';
			$this->load->view('header',$data);
			$this->load->view('store/kupon');
			$this->load->view('footer');
	
		}
	}

	// discount

	function kupon_print(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$data['title']='Fachreza Maulana | PRINT POP';
			$this->load->view('store/kupon_print');
	
		}
	}






		function disc_print_a5_lan(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$data['title']='Fachreza Maulana | PRINT POP';
			$this->load->view('store/disc_print_a5_lan');
	
		}
	}

	
		function disc_print_a5_pot(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$data['title']='Fachreza Maulana | PRINT POP';
			$this->load->view('store/disc_print_a5_pot');
	
		}
	}

			function disc_print_a4_pot(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$data['title']='Fachreza Maulana | PRINT POP';
			$this->load->view('store/disc_print_a4_pot');
	
		}
	} 


	function disc_print_a4_lan(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$data['title']='Fachreza Maulana | PRINT POP';
			$this->load->view('store/disc_print_a4_lan');
	
		}
	}


	// amount

		function disc_print_pop2(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$data['title']='Fachreza Maulana | PRINT POP';
			$this->load->view('store/pop2');
	
			}
		}



		function print_pop3(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$data['title']='Fachreza Maulana | PRINT POP';
			$this->load->view('store/pop3');
	
			}
		}




		function disc_print_a5_pot2(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$data['title']='Fachreza Maulana | PRINT POP';
			$this->load->view('store/disc_print_a5_pot2');
	
			}
		}

			function disc_print_a5_pot3(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$data['title']='Fachreza Maulana | PRINT POP';
			$this->load->view('store/disc_print_a5_pot3');
	
			}
		}

		

			function disc_print_a5_lan2(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$data['title']='Fachreza Maulana | PRINT POP';
			$this->load->view('store/disc_print_a5_lan2');
	
			}
		}

				function disc_print_a5_lan3(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$data['title']='Fachreza Maulana | PRINT POP';
			$this->load->view('store/disc_print_a5_lan3');
	
			}
		}

		

		function disc_print_a4_pot2(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$data['title']='Fachreza Maulana | PRINT POP';
			$this->load->view('store/disc_print_a4_pot2');
	
			}
		}

			function disc_print_a4_pot3(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$data['title']='Fachreza Maulana | PRINT POP';
			$this->load->view('store/disc_print_a4_pot3');
	
			}
		}

		
		

			function disc_print_a4_lan2(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$data['title']='Fachreza Maulana | PRINT POP';
			$this->load->view('store/disc_print_a4_lan2');
	
			}
		}

		
				function disc_print_a4_lan3(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$data['title']='Fachreza Maulana | PRINT POP';
			$this->load->view('store/disc_print_a4_lan3');
	
			}
		}


		function getSKU(){

	
			$this->load->view('store/getSKU');
	
			
		}


		function kosong(){

			$data['title']='Fachreza Maulana | BARANG KOSONG';
			$this->load->view('header',$data);
			$this->load->view('koneksi');

			$this->load->view('store/kosong');
			$this->load->view('footer');

		}


		function kosong_cari(){

			$data['title']='Fachreza Maulana | BARANG KOSONG';
			$this->load->view('header',$data);
			$this->load->view('koneksi');

			$this->load->view('store/kosong_cari');
			$this->load->view('footer');

		}

			function kosong_detail(){

			$data['title']='Fachreza Maulana | BARANG KOSONG';
			$this->load->view('header',$data);
			$this->load->view('koneksi');

			$this->load->view('store/kosong_detail');
			$this->load->view('footer');

		}

			function kosong_detail_prch(){

			$data['title']='Fachreza Maulana | BARANG KOSONG';
			$this->load->view('header',$data);
			$this->load->view('koneksi');

			$this->load->view('store/kosong_detail_prch');
			$this->load->view('footer');

		}



		function kosong_add(){

			$data['title']='Fachreza Maulana | BARANG KOSONG';
			$this->load->view('header',$data);
			$this->load->view('koneksi');

			$this->load->view('store/kosong_add');
			$this->load->view('footer');

		}


			function kosong_edit_prch(){

			$data['title']='Fachreza Maulana | BARANG KOSONG';
			$this->load->view('header',$data);
			$this->load->view('koneksi');

			$this->load->view('store/kosong_edit_prch');
			$this->load->view('footer');

		}

			function kosong_edit(){

			$data['title']='Fachreza Maulana | BARANG KOSONG';
			$this->load->view('header',$data);
			$this->load->view('koneksi');

			$this->load->view('store/kosong_edit');
			$this->load->view('footer');

		}



		function kosong_print(){

			$data['title']='Fachreza Maulana | BARANG KOSONG';
			$this->load->view('koneksi');
			$this->load->view('phpqrcode/qrlib');
			$this->load->view('barcode');
			$this->load->view('store/kosong_print');


		}

			function kosong_detail_print(){


			$data['title']='Fachreza Maulana | BARANG KOSONG';
			$this->load->view('header',$data);
			$this->load->view('koneksi');
			$this->load->view('phpqrcode/qrlib');
			$this->load->view('barcode');
			$this->load->view('store/kosong_print_prch');


		}

			function kosong_list(){

			$data['title']='Fachreza Maulana | BARANG KOSONG';
			$this->load->view('koneksi');
			$this->load->view('store/kosong_list');


		}



			function kosong_get(){

			$data['title']='Fachreza Maulana | BARANG KOSONG';
			$this->load->view('koneksi');
			$this->load->view('store/kosong_get');


		}

				function kosong_list2(){

			$data['title']='Fachreza Maulana | BARANG KOSONG';
			$this->load->view('koneksi');
			$this->load->view('store/kosong_list2');


		}


			function kosong_save(){

			$data['title']='Fachreza Maulana | BARANG KOSONG';
			$this->load->view('koneksi');
			$this->load->view('store/kosong_save');


		}

		function kosong_hapus(){

			$data['title']='Fachreza Maulana | BARANG KOSONG';
			$this->load->view('koneksi');
			$this->load->view('store/kosong_hapus');


		}

		function kosong_hapus_all(){

			$this->load->view('store/kosong_hapus_all');

		}

		function kosong_update(){
			$this->load->view('store/kosong_update');
		}

		function kosong_status(){
			$data['title']='Fachreza Maulana | BARANG KOSONG';
			$this->load->view('header',$data);
			$this->load->view('koneksi');
			$this->load->view('store/kosong_status');
		}

			function kosong_update_status(){
			$this->load->view('store/kosong_update_status');
		}

	function kosong_update_keterangan(){
			$this->load->view('store/kosong_update_keterangan');
		}

				function kosong_prch(){

			$data['title']='Fachreza Maulana | BARANG KOSONG';
			$this->load->view('header',$data);
			$this->load->view('koneksi');

			$this->load->view('store/kosong_prch');
			$this->load->view('footer');

		}



		function cek(){
			$data['title']='Fachreza Maulana | CEK HARGA BARANG';
			$this->load->view('header',$data);
			$this->load->view('koneksi');
			$this->load->view('phpqrcode/qrlib.php');
			$this->load->view('barcode');
			$this->load->view('store/cek');
		}


		function cek_data(){
			
			$this->load->view('barcode');
			$this->load->view('phpqrcode/qrlib.php');
			$this->load->view('store/cek_data');
		}


		function cek_inventory(){
			$data['title']='Fachreza Maulana | CEK HARGA BARANG';
			$this->load->view('header',$data);
			$this->load->view('koneksi');
			$this->load->view('phpqrcode/qrlib.php');
			$this->load->view('barcode');
			$this->load->view('store/cek_inventory');
		}
		function cek_data_inventory(){
			
			$this->load->view('barcode');
			$this->load->view('phpqrcode/qrlib.php');
			$this->load->view('store/cek_data_inventory');
		}



		


		
		

}