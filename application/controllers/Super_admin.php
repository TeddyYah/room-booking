<?php

class Super_Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

    public function index()
	{
		$data['title'] = 'Users Management';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

		$data['member'] = $this->User_model->getAllUsers();

		$this->load->view('templates/header',  $data);
		$this->load->view('templates/sidebar');
		$this->load->view('super_admin/user/index', $data);
		$this->load->view('templates/footer');
	}

	public function validateUser()
	{
		// set validasi form
        $this->form_validation->set_rules('fullname', 'Fullname', 'required|trim|max_length[35]', [
            'required' => 'Wajib diisi !'
        ]);
        $this->form_validation->set_rules('email_pj', 'Email', 'required|trim|max_length[35]|valid_email|is_unique[user.email_pj]', [
            'required' => 'Wajib diisi !',
            'is_unique' => 'Email telah terdaftar !'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|max_length[20]|is_unique[user.username]', [
            'required' => 'Wajib diisi !',
            'is_unique' => 'Username telah terdaftar !',
            'min_length' => 'Minimal 4 karakter !',
            'max_length' => 'Maksimal 20 karakter !'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|matches[repeat_password]', [
            'required' => 'Wajib diisi !',
            'matches' => 'Password tidak sama !',
            'min_length' => 'Minimal 8 karakter !'
        ]);
        $this->form_validation->set_rules('repeat_password', 'Repeat Password', 'required|trim|matches[password]', [
            'required' => 'Wajib diisi !',
            'matches' => 'Password tidak sama !',
        ]);
	}

	public function addUser()
	{
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

		$this->validateUser();

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Add User';
			$this->load->view('templates/header',  $data);
			$this->load->view('templates/sidebar');
			$this->load->view('super_admin/user/add-user', $data);
			$this->load->view('templates/footer');
		} else {
			date_default_timezone_set('Asia/Jakarta');
			$date = date('Y-m-d');
			$data = [
				'id_role'       => $this->input->post('role'),
				'username'   	=> htmlspecialchars($this->input->post('username')),
				"email_pj"      => htmlspecialchars($this->input->post('email_pj', true)),
				'password'   	=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'fullname'   	=> htmlspecialchars($this->input->post('fullname')),
				// 'status_user'     => htmlspecialchars($this->input->post('status_user')),
				'is_active'    => 1,
				'id_ps'       => 0,
				'jumlah_booking' => 0,
				'created_at' 	=> $date
			];
			$this->db->insert('user', $data);
			$this->session->set_flashdata('add-success', 'Berhasil');
			redirect('super_admin');
		}
	}

	public function detailUser($id)
	{
		$data['title'] = 'Detail User';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

		$data['member'] = $this->User_model->detailUser($id);
		$this->load->view('templates/header',  $data);
		$this->load->view('templates/sidebar');
		$this->load->view('super_admin/user/detail-user', $data);
		$this->load->view('templates/footer');
	}

	public function editUser($id)
	{
		$data['title'] = 'Edit User';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

		$data['member'] = $this->User_model->editUser($id);
		$this->load->view('templates/header',  $data);
		$this->load->view('templates/sidebar');
		$this->load->view('super_admin/user/edit-user', $data);
		$this->load->view('templates/footer');
	}

	public function updateUser($id)
	{
		$this->form_validation->set_rules('id_role', 'Role', 'required', [
			'required' => 'Wajib diisi !'
		]);
		$this->form_validation->set_rules('fullname', 'Fullname', 'required', [
			'required' => 'Wajib diisi !'
		]);

		if ($this->form_validation->run() == false) {
			$this->editUser($id);
		} else {
			$data = [
				'id_role'       => $this->input->post('id_role'),
				'fullname'   => htmlspecialchars($this->input->post('fullname'))
			];
			$this->User_model->updateUser($id, $data);
			$this->session->set_flashdata('update-success', 'Berhasil');
			redirect('super_admin');
		}
	}

	public function deleteUser($id)
	{
		$this->User_model->deleteUser($id);
		redirect('super_admin');
	}

	public function role()
    {
        $data['title'] = 'Role';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

        $data['role'] = $this->db->get('role')->result_array();

		$this->form_validation->set_rules('nama_role', 'Nama Role', 'required');

        if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			// $this->load->view('templates/topbar', $data);
			$this->load->view('super_admin/role/role', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->insert('role', ['nama_role' => $this->input->post('nama_role')]);
			$this->session->set_flashdata('message', 
			'<div class="alert alert-primary alert-dismissible fade show" role="alert">
			<strong>Data berhasil ditambahkan!</strong> 
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</spam></button>
			</div>');
			redirect('super_admin/role/');
		}
    }

	public function editRole($id)
	{
		$data['title'] = 'Edit Role';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

		$data['role'] = $this->Role_model->editRole($id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('super_admin/role/edit-role', $data);
		$this->load->view('templates/footer');
	}

	public function updateRole($id)
	{
        $this->form_validation->set_rules('nama_role', 'Nama Role', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->editRole($id);
		} else {
			$data = ["nama_role" => $this->input->post('nama_role', true)];
			$this->Role_model->updateRole($id, $data);
			$this->session->set_flashdata('message', 
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Data berhasil diubah ^^</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</spam></button>
            </div>');
			redirect('super_admin/role/');
		}
	}

    public function deleteRole($id)
	{
		$this->Role_model->deleteRole($id);
		redirect('super_admin/role/');
	}


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

        $data['role'] = $this->db->get_where('role', ['id_role' => $role_id])->row_array();

        $this->db->where('id_menu !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/topbar', $data);
        $this->load->view('super_admin/role/role-access', $data);
        $this->load->view('templates/footer');
    }

	public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'id_role' => $role_id,
            'id_menu' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', 
		'<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong>Access Changed!</strong> 
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</spam></button>
		</div>');
    }
}