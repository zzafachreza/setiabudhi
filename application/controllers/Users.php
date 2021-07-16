	<?php

class Users extends CI_Controller{

	function __construct(){

		parent::__construct();
		$this->load->model('Users_model');
	}

	function index(){

		$data['title']='FM | Master Users';
		$data['users'] = $this->Users_model->getData();
		$this->load->view('header',$data);
		$this->load->view('users/data');
		$this->load->view('footer');
	} //ok 


	function add(){
		$data['title']='FM | Master Users - Add';
		$this->load->view('header',$data);
		$this->load->view('users/add');
		$this->load->view('footer');
	}

	function insert(){
		$nama_lengkap = $this->input->post('nama_lengkap');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$level = $this->input->post('level');

		$passwordCrypt = sha1($password);

		$this->Users_model->insert($nama_lengkap,$username,$passwordCrypt,$level);
		redirect('users');
	}

	function delete(){
		$id = $this->uri->segment(3);
		$this->Users_model->delete($id);
		redirect('users');
	}

	function edit(){

		$id	= $this->uri->segment(3);

		$data['title']='FM | Master User - Edit';
		$hasil = $this->Users_model->getId($id);

		$data['users'] = $hasil->row_array();

		$this->load->view('header',$data);
		$this->load->view('users/edit',$data);
		$this->load->view('footer');
	}

	function detail(){
		$id	= $this->uri->segment(3);
		$data['title']='FM | Master User - Detail';
		$hasil = $this->Users_model->getId($id);

		$data['users'] = $hasil->row_array();

		$this->load->view('header',$data);
		$this->load->view('users/view',$data);
		$this->load->view('footer');
	}



	function update(){
		$id = $this->input->post('id');
		$nama_lengkap = $this->input->post('nama_lengkap');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$level = $this->input->post('level');
		$this->Users_model->update($id,$nama_lengkap,$username,$password,$level);
		redirect('users');
	}
}