<?php

class Profile extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		// is_logged_in();
	}
    
    public function index()
    {
        $data['title'] = 'My Profile';
        $username = $this->session->userdata('username');
        $data['user'] = $this->User_model->getuser($username);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('profile/index', $data);
        $this->load->view('templates/footer');
    }

    public function editProfile($id)
    {
        $data['title'] = 'Edit Profile';
        $username = $this->session->userdata('username');
        $data['user'] = $this->User_model->getuser($username);

        $data['member'] = $this->Profile_model->getProfileById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('profile/edit-profile', $data);
        $this->load->view('templates/footer');
    }

    public function updateProfile($id)
    {
        $this->form_validation->set_rules('fullname', 'Fullname', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->editProfile($id);
        } else {
            $id = $this->input->post('id_user');
            $fullname =  $this->input->post('fullname');

            // $this->Profile_model->updateProfile($fullname, $username, $id);
            $this->db->where('id_user', $id)
                ->set('fullname', $fullname)
                ->update('user');
            $this->session->set_flashdata('update-success', 'Berhasil');
            redirect('profile');
        }
    }

    public function editPassword($id)
    {
        $data['title'] = 'Edit Password';
        $username = $this->session->userdata('username');
        $data['user'] = $this->User_model->getuser($username);

        $data['member'] = $this->Profile_model->getProfileById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('profile/edit-password', $data);
        $this->load->view('templates/footer');
    }

    public function updatePassword($id)
    {
        $this->form_validation->set_rules('old_password', 'Old Password', 'required|trim');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|trim');
        $this->form_validation->set_rules('repeat_password', 'Repeat Password', 'required|trim');
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim|min_length[8]');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[8]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            // $this->load->view('templates/topbar', $data);
            $this->load->view('client/profile/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']->password)) {
                $this->session->set_flashdata('message', 
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Wrong current password!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</spam></button>
                </div>');
                redirect('profile/changepassword');

            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', 
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>New password cannot be the same as current password!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</spam></button>
                    </div>');
                    redirect('profile/changepassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Password changed!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</spam></button>
                    </div>');
                    redirect('profile/changepassword');
                }
            }
        }
    }
}