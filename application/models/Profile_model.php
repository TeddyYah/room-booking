<?php

class Profile_model extends CI_model
{
    public function getProfileById($id)
    {
        return $this->db->where('id_user', $id)
            ->get('user')->row();
    }

    public function updateProfile($id, $fullname, $username)
    {
        return $this->db->where('id_user', $id)
            ->set('fullname', $fullname)
            ->set('username', $username)
            ->update('user');
    }
}
