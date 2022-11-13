<?php

class Client extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

    public function edit_Profile()
	{
		if($this->session->userdata('id_role') == 3){
            redirect('auth/blocked');
		}
		$data['title'] = 'Edit Profile';
        $username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

        $this->form_validation->set_rules('fullname', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
            $this->load->view('client/profile/edit_profile', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('username');
            $fullname = $this->input->post('fullname');

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']->image;
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('profile');
                }
            }

            $this->db->set('fullname', $fullname);
            $this->db->where('username', $name);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('profile');
        }
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