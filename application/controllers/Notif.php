<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notif extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Notifikasi';
        $username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);
		$data['bell'] = $this->Notif_model->getAllNotif();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('notif/index', $data);
		$this->load->view('templates/footer');
	}

    public function sudahDibaca($id)
    {
        $data = [
            'is_read' => 1
        ];
        $this->db->update('notif', $data, ['id_nt' => $id]);
        $this->session->set_flashdata('msg', 
        '<div class="alert alert-success">Notif berhasil diperbarui</div>');
        return redirect(base_url('notif')); 
    }

    public function diBacaSemua()
    {
        $notif = $this->db->get_where('notif', ['is_read' => 0])->result_array();

        for($i = 0; $i < count($notif); $i++)
        {
            $data = ['is_read' => 1];
            $this->db->update('notif', $data, ['id_nt' => $notif[$i]['id_nt']]);
        }
        $this->session->set_flashdata('msg', 
        '<div class="alert alert-success">Notif berhasil diperbarui</div>');
        return redirect(base_url('notif')); 
    }

    public function hapusNotif()
    {
        $this->db->empty_table('notif');
        $this->session->set_flashdata('msg', 
        '<div class="alert alert-danger">Notif berhasil diperbarui</div>');
        return redirect(base_url('notif/index')); 
    }
}
?>