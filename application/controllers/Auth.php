<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mGoogleLogin');
        date_default_timezone_set("Asia/Jakarta");
    }
    
    public function index()
    {
        if (($this->session->userdata('username')) && ($this->session->userdata('id_role') == 1)){
            redirect('super_admin');
        } else if (($this->session->userdata('username')) && ($this->session->userdata('id_role') == 2)){
            redirect('admin');
        } else if (($this->session->userdata('username')) && ($this->session->userdata('id_role') == 3)){
            redirect('user');
        } else if (($this->session->userdata('username')) && ($this->session->userdata('id_role') == 4)){
            redirect('user');
        }

        $this->form_validation->set_rules('username', 'Username', 'trim');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]');

        include_once "vendor/autoload.php";

        $google_client = new Google_Client();

        $google_client->setClientId('xxxx xxxx xxxx xxxx'); //Define your ClientID

        $google_client->setClientSecret('xxxx xxxx xxxx xxxx'); //Define your Client Secret Key

        $google_client->setRedirectUri('http://localhost/room-booking/verify_client/login'); //Define your Redirect Uri

        $google_client->addScope('email');

        $google_client->addScope('profile');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Booking-Room';
            $data['url_login'] = $google_client->createAuthUrl();
            $this->load->view('auth/login', $data);
        } else {
            // jika validasi berhasil
            $this->_login();
        }
    }


    private function _login()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        // jika usename dan password kosong
        if (empty($username) or empty($password)) {
            $this->session->set_flashdata('login-failed-3', 'Gagal');
            redirect('auth');
        }

        // cari data di tabel user berdasarkan username 
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        // var_dump($user);
        // die;
         // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
            // jika password yg diinput sesuai dgn didatabase
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'id_user' => $user['id_user'],
                        'id_role'  => $user['id_role']
                    ];
                    // buat sesssion berdsarkan $data
                    $this->session->set_userdata($data);
                    if ($data['id_role'] == 1) {
                        redirect('super_admin');
                    } elseif ($data['id_role'] == 2) {
                        redirect('admin');
                    } elseif ($data['id_role'] == 3) {
                        redirect('user');
                    } elseif ($data['id_role'] == 4) {
                        redirect('user');
                    }
                } else {
                    // jika password yg diinput tidak sesuai dengan didatabase
                    $this->session->set_flashdata('login-failed-1', 'Gagal');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', 
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>This email has not been activated!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</spam></button>
                </div>');
                redirect('auth');

            }
        } else {
            // jika username dan passsword salah
            $this->session->set_flashdata('login-failed-2', 'Gagal');
            redirect('auth');
        }
    }

    public function register()
    {
        if (($this->session->userdata('username')) && ($this->session->userdata('id_role') == 1)){
            redirect('super_admin');
        } else if (($this->session->userdata('username')) && ($this->session->userdata('id_role') == 2)){
            redirect('admin');
        } else if (($this->session->userdata('username')) && ($this->session->userdata('id_role') == 3)){
            redirect('user');
        } else if (($this->session->userdata('username')) && ($this->session->userdata('id_role') == 4)){
            redirect('user');
        }
        
        if ($this->session->userdata('username')) {
            redirect('user');
        }
        // set validasi form
        $this->form_validation->set_rules('fullname', 'Fullname', 'required|trim|max_length[35]', [
            'required' => 'Wajib diisi !'
        ]);
        $this->form_validation->set_rules('email_pj', 'Email', 'required|trim|max_length[35]|valid_email|is_unique[user.email_pj]', [
            'required' => 'Wajib diisi !',
            'is_unique' => 'Email telah terdaftar !'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[6]|max_length[20]|is_unique[user.username]', [
            'required' => 'Wajib diisi !',
            'is_unique' => 'Username telah terdaftar !',
            'min_length' => 'Minimal 6 karakter !',
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
        // $this->form_validation->set_rules('status_user', 'Status', 'required', [
        //     'required' => 'Wajib diisi !',
        // ]);

        // jika validasi gagal
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration';
            $this->load->view('auth/register', $data);
        } else {
            // jika validasi benar
            $this->register_act();
        }
    }


    public function register_act()
    {
        date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d');
        $email = $this->input->post('email_pj', true);
        $data = [
            'id_role'       => 4,
            'username'      => htmlspecialchars($this->input->post('username', true)),
            "email_pj"      => htmlspecialchars($email),
            // 'image'         => 'default.jpg',
            'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'fullname'     => htmlspecialchars($this->input->post('fullname', true)),
            // 'status_user'     => htmlspecialchars($this->input->post('status_user')),
            'is_active'    => 0,
            'id_ps'       => 0,
            'jumlah_booking' => 0,
            'created_at' => $date

        ];

        // siapkan token
        $token = base64_encode(random_bytes(32)); //fungsi punya bawaan php.net
        $user_token = [
            'email_pj' => $email,
            'token' => $token,
            'date_created' => time()
        ];

        $this->db->insert('user', $data);
        $this->db->insert('user_token', $user_token);
        
        $this->_sendEmail($token, 'verify');
        $this->session->set_flashdata('register-success', 'Berhasil');
        redirect('auth');
    }

    private function _sendEmail($token, $type) //kalo ga bisa, matiin dlu anti virusnya
    {
        {
            $config = [
                'protocol'  => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_user' => 'your email',
                'smtp_pass' => 'your password',
                'smtp_port' => 465,
                'mailtype'  => 'html',
                'charset'   => 'utf-8',
                'newline'   => "\r\n"
            ];
    
            $this->email->initialize($config);
    
            $this->email->from($this->input->post('email'));
            $this->email->to('email@gmail.com', 'room-booking');
    
            if ($type == 'verify') {
                $this->email->subject('Account Verification');
                $this->email->message('Click this link to verify you account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
            } else if ($type == 'forgot') {
                $this->email->subject('Reset Password');
                $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
            }
    
            if ($this->email->send()) {
                return true;
            } else {
                echo $this->email->print_debugger();
                die;
            }
        }
    }


    public function verify()
    {
        $email = $this->input->get('email_pj');
        $token = $this->input->get('token');
        
        $user = $this->db->get_where('user', ['email_pj' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email_pj', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email_pj' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login.</div>');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email_pj' => $email]);
                    $this->db->delete('user_token', ['email_pj' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired.</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong token.</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email.</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        // hapus session
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('user_data');
        $this->session->set_flashdata('logout-success', 'Berhasil');
        redirect('auth');
        session_destroy();
        // tampilkan flash message
        // $this->session->set_flashdata('logout-success', 'Berhasil');
        // redirect('auth');
    }

    public function login2()
    {
        include_once "vendor/autoload.php";

        $google_client = new Google_Client();  

        if (isset($_GET["code"])) {
            $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

            if (!isset($token["error"])) {
                $google_client->setAccessToken($token['access_token']);

                $this->session->set_userdata('access_token', $token['access_token']);

                $google_service = new Google_Service_Oauth2($google_client);

                $data = $google_service->userinfo->get();
                date_default_timezone_set('Asia/Jakarta');
                $current_datetime = date('Y-m-d H:i:s');

                if ($this->mGoogleLogin->Is_already_register($data['email'])) {
                    //update data
                    $fullname = $data['given_name'] . ' ' . $data['family_name']  ;
                    $username_baru = explode('@',$data['email']);
                    $userdata = array(
                        'fullname'     => $fullname,
                        'email_pj'     => $data['email'],
                        'image'        => $data['picture'],
                        'username'     => $username_baru[0],
                        // 'created_at'   => $current_datetime,
                        'is_active'    => 1
                        // 'id_role'      => 3
                    );

                    $this->mGoogleLogin->Update_user_data($userdata, $data['email']);
                } else {
                    //insert data
                    $fullname = $data['given_name'] . ' ' . $data['family_name']  ;
                    $username_baru = explode('@',$data['email']);
                    $userdata = array(
                        'fullname'     => $fullname,
                        'email_pj'     => $data['email'],
                        'image'        => $data['picture'],
                        'username'     => $username_baru[0],
                        'created_at'   => $current_datetime,
                        'is_active'    => 1,
                        'id_role'      => 3
                    );

                    $this->mGoogleLogin->Insert_user_data($userdata);
                }
                $this->session->set_userdata($userdata);
            }
        }
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email_pj', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('auth/forgot-password', $data);
        } else {
            $email = $this->input->post('email_pj');
            $user = $this->db->get_where('user', ['email_pj' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email_pj' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered or activated!</div>');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email_pj');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email_pj' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token.</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[8]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('auth/change-password', $data);
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email_pj', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->db->delete('user_token', ['email_pj' => $email]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login.</div>');
            redirect('auth');
        }
    }
}