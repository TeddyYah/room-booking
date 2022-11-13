<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
}

    public function index()
    {
        $data['title'] = 'Menu Management';
        $username = $this->session->userdata('username');
        $data['user'] = $this->User_model->getuser($username);

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            // $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', 
            '<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>Data berhasil ditambahkan!</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</spam></button>
            </div>');
            redirect('menu');
        }
    }

    public function editMenu($id)
	{
		$data['title'] = 'Edit Menu';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

		$data['menu'] = $this->Menu_model->editMenu($id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('menu/editmenu', $data);
		$this->load->view('templates/footer');
	}

	public function updateMenu($id)
	{
        $this->form_validation->set_rules('menu', 'Menu', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->editMenu($id);
		} else {
			$data = ["menu" => $this->input->post('menu', true)];
			$this->Menu_model->updateMenu($id, $data);
			$this->session->set_flashdata('message', 
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Data berhasil diubah ^^</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</spam></button>
            </div>');
			redirect('menu');
		}
	}

    public function deleteMenu($id)
	{
		$this->Menu_model->deleteMenu($id);
		redirect('menu');
	}

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $username = $this->session->userdata('username');
        $data['user'] = $this->User_model->getuser($username);
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('id_menu', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'id_menu' => $this->input->post('id_menu'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', 
            '<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>Data berhasil ditambahkan!</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</spam></button>
            </div>');
            redirect('menu/submenu');
        }
    }

    public function editSubMenu($id)
	{
		$data['title'] = 'Edit Sub Menu';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);
        
        $data['subMenu'] = $this->Menu_model->getSubMenu();
        $data['edit'] = $this->db->get('user_menu')->result_array();
		$data['menu'] = $this->Menu_model->editSubMenu($id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('menu/editsubmenu', $data);
		$this->load->view('templates/footer');
	}

	public function updateSubMenu($id)
	{
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('id_menu', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');
        
		if ($this->form_validation->run() == FALSE) {
			$this->editSubMenu($id);
		} else {
			$data = [
				"title" => $this->input->post('title', true),
				"id_menu" => $this->input->post('id_menu', true),
				"url" => $this->input->post('url', true),
				"icon" => $this->input->post('icon', true),
			];
			$this->Menu_model->updateSubMenu($id, $data);
			$this->session->set_flashdata('message',  
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Data berhasil diubah ^^</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</spam></button>
            </div>');
			redirect('menu/submenu');
		}
	}

    public function deleteSubMenu($id)
	{
		$this->Menu_model->deleteSubMenu($id);
		redirect('menu/submenu');
	}
}