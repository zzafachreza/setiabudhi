<?php


class Hrms extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	function data_karyawan(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{
			$data['title']='Fachreza Maulana | HRMS';
			$this->load->view('header',$data);
			$this->load->view('hrms/data_karyawan');
			$this->load->view('footer');
		}
	}

	function view_karyawan(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{

			$data['IDPegawai'] = $this->uri->segment(3);
			$data['title']='Fachreza Maulana | HRMS';
			$this->load->view('header',$data);
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$this->load->view('hrms/view_karyawan');
			$this->load->view('footer');
		}
	}

		function print_karyawan(){

		if (!isset($_SESSION['username'])) {
			redirect('login');
		}else{


			$data['IDPegawai'] = $this->uri->segment(3);
			$data['title']='Fachreza Maulana | HRMS';
			$this->load->view('phpqrcode/qrlib');
			$this->load->view('barcode');
			// $this->load->view('header',);
			$this->load->view('hrms/print_karyawan',$data);
	
		}
	}

		function absen(){



			$data['title']='Fachreza Maulana | HRMS ABSEN';
			
			$this->load->view('phpqrcode/qrlib');
			$this->load->view('barcode');
			 $this->load->view('header',$data);
			$this->load->view('hrms/absen_karyawan');
	
		
	}

			function cron(){



			$data['title']='Fachreza Maulana | HRMS ABSEN';
			
			$this->load->view('phpqrcode/qrlib');
			$this->load->view('barcode');
			 $this->load->view('header',$data);
			$this->load->view('hrms/cron');
	
		
	}


	 function email(){



			$this->load->view('hrms/email');
	
		
	}




	function jam(){
		date_default_timezone_set("Asia/Jakarta");
		echo date('H:i:s');
	}


function Indonesia3Tgl($tanggal){
  $namaBln = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", 
           "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
           
  $tgl=substr($tanggal,8,2);
  $bln=substr($tanggal,5,2);
  $thn=substr($tanggal,0,4);
  $tanggal ="$tgl ".$namaBln[$bln]." $thn";
  return $tanggal;
}



	function tgl(){

		date_default_timezone_set("Asia/Jakarta");

		$now = date('Y-m-d');
$day = date('D', strtotime($now));
$dayList = array(
	'Sun' => 'Minggu',
	'Mon' => 'Senin',
	'Tue' => 'Selasa',
	'Wed' => 'Rabu',
	'Thu' => 'Kamis',
	'Fri' => 'Jumat',
	'Sat' => 'Sabtu'
);



		 $namaBln = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", 
           "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
           
			  $tgl=substr(date('Y-m-d'),8,2);
			  $bln=substr(date('Y-m-d'),5,2);
			  $thn=substr(date('Y-m-d'),0,4);
			 echo  $dayList[$day].", ".$tanggal ="$tgl ".$namaBln[$bln]." $thn";


		
		
	}


	function get_karyawan(){

			$data['ID'] = $_POST['ID'];
			$data['TIPE'] = $_POST['TIPE'];
			$data['title']='Fachreza Maulana | HRMS';
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$this->load->view('hrms/get_karyawan',$data);
	}


		function get_jadwal(){
		
			$data['ID'] = $_POST['ID'];
			$data['TIPE'] = $_POST['TIPE'];
			$data['title']='Fachreza Maulana | HRMS';
			$this->load->view('phpqrcode/qrconfig');
			$this->load->view('barcode');
			$this->load->view('hrms/get_jadwal',$data);
	}




}