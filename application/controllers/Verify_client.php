<?php

class Verify_client extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
	}

    public function login()
    {
        include_once "vendor/autoload.php";

        $google_client = new Google_Client();

        $google_client->setClientId('xxxx xxxx xxxx xxxx'); //Define your ClientID

        $google_client->setClientSecret('xxxx xxxx xxxx xxxx'); //Define your Client Secret Key

        $google_client->setRedirectUri('http://localhost/room-booking/verify_client/login'); //Define your Redirect Uri

        $google_client->addScope('email');

        $google_client->addScope('profile');
        
        

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
                        'username'     => $username_baru[0],
                        'image'        => $data['picture'],
                        // 'created_at'   => $current_datetime,
                        'is_active'    => 1
                        // 'id_role'      => 3
                    );

                    $this->mGoogleLogin->Update_user_data($userdata, $data['email']);

                    $user = $this->db->get_where('user', ['username' => $username_baru[0]])->row_array();

                    $data = [
                        'username'     => $user['username'],
                        'id_user'      => $user['id_user'],
                        'id_role'      => $user['id_role']
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
                    // redirect('user');

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

                    $user = $this->db->get_where('user', ['username' => $username_baru[0]])->row_array();

                    $data = [
                        'username'     => $user['username'],
                        'id_user'      => $user['id_user'],
                        'id_role'      => 3
                    ];
                    // buat sesssion berdsarkan $data
                    $this->session->set_userdata($data);
                    redirect('user');
                }
                // $this->session->set_userdata($userdata);
            }
        }
    }
}