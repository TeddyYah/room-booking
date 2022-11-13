<?php

// untuk login 
function is_logged_in()
{
    $ci = get_instance();
    // jika tidak ada session username 
    if (!$ci->session->userdata('username')) {
        $ci->session->set_flashdata('login-failed-3', 'Gagal');
        redirect('auth');
    }
    else {
        $role_id = $ci->session->userdata('id_role');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id_menu'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'id_role' => $role_id,
            'id_menu' => $menu_id
        ]);

        // var_dump($userAccess);
        // die;

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('id_role', $role_id);
    $ci->db->where('id_menu', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}