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
        $this->form_validation->set_rules('username', 'Username', 'trim');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]');

        include_once "vendor/autoload.php";

        $google_client = new Google_Client();

        $google_client->setClientId('575369702579-jg41dfipm6st9km44rhni0cbag8lre0g.apps.googleusercontent.com'); //Define your ClientID

        $google_client->setClientSecret('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'); //Define your Client Secret Key

        $google_client->setRedirectUri('http://bookingmrs.rf.gd/booked/verify_client/login'); //Define your Redirect Uri

        $google_client->addScope('email');

        $google_client->addScope('profile');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Magics Rey Studio';
            $data['url_login'] = $google_client->createAuthUrl();
            $this->load->view('auth/login', $data);
        } else {
            // jika validasi berhasil
            $this->_login();
        }
    }


    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // jika usename dan password kosong
        if (empty($username) or empty($password)) {
            $this->session->set_flashdata('login-failed-3', 'Gagal');
            redirect('auth');
        }

        // cari data di tabel user berdasarkan username 
        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($user) {
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
                    redirect('admin');
                } elseif ($data['id_role'] == 2) {
                    redirect('client');
                }
            } else {
                // jika password yg diinput tidak sesuai dengan didatabase
                $this->session->set_flashdata('login-failed-1', 'Gagal');
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
        // set validasi form
        $this->form_validation->set_rules('fullname', 'Fullname', 'required|trim|max_length[35]', [
            'required' => 'Wajib diisi !'
        ]);
        $this->form_validation->set_rules('email_pj', 'Email', 'required|trim|max_length[35]|valid_email', [
            'required' => 'Wajib diisi !'
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
        $data = [
            'id_role'       => 2,
            'username'      => htmlspecialchars($this->input->post('username')),
            "email_pj"      => htmlspecialchars($this->input->post('email_pj')),
            'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'fullname'     => htmlspecialchars($this->input->post('fullname')),
            // 'status_user'     => htmlspecialchars($this->input->post('status_user')),
            'created_at' => date('Y-m-d')

        ];
        $this->db->insert('user', $data);
        $this->session->set_flashdata('register-success', 'Berhasil');
        redirect('auth');
    }

    public function logout()
    {
        // hapus session
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('user_data');
        session_destroy();
        // tampilkan flash message
        $this->session->set_flashdata('logout-success', 'Berhasil');
        redirect('auth');
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

                $current_datetime = date('Y-m-d H:i:s');

                if ($this->mGoogleLogin->Is_already_register($data['email'])) {
                    //update data
                    $fullname = $data['given_name'] . ' ' . $data['family_name']  ;
                    $username_baru = explode('@',$data['email']);
                    $userdata = array(
                        'fullname'     => $fullname,
                        'email_pj'     => $data['email'],
                        'username'     => $username_baru[0],
                        'created_at'   => $current_datetime,
                        'id_role'      => 2
                    );

                    $this->mGoogleLogin->Update_user_data($userdata, $data['email']);
                } else {
                    //insert data
                    $fullname = $data['given_name'] . ' ' . $data['family_name']  ;
                    $username_baru = explode('@',$data['email']);
                    $userdata = array(
                        'fullname'     => $fullname,
                        'email_pj'     => $data['email'],
                        'username'     => $username_baru[0],
                        'created_at'   => $current_datetime,
                        'id_role'      => 2
                    );

                    $this->mGoogleLogin->Insert_user_data($userdata);
                }
                $this->session->set_userdata($userdata);
            }
        }
    }


    // public function logout()
    // {
    //     $this->session->unset_userdata('access_token');
    //     $this->session->unset_userdata('user_data');
    //     session_destroy();
    //     redirect('googleLogin/login');
    // }
}