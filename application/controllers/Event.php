<?php

class Event extends CI_Controller
{
	public function __construct()
	{
        parent::__construct();
        is_logged_in();

		// if($this->session->userdata('id_role') > 2){
        //     redirect('auth/blocked');
		// }
	}

    public function index()
	{
		$data['title'] = 'Fastest Reservation';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

		$data['booking'] = $this->Pesanan_model->getBookedRoom1();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('event/index', $data);
		$this->load->view('templates/footer');
	}

}