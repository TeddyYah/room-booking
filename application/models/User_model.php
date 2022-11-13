<?php

class User_model extends CI_model
{
    public function getUser($username)
    {
        return $this->db->where('username', $username)
            ->get('user')->row();
    }

    public function getUser1($id_user)
    {
        return $this->db->where('id_user', $id_user)
            ->get('user')->row();
    }

    public function getAllDataUsers()
    {
        return $this->db->from('user')
        ->join('data_pemesanan', 'data_pemesanan.id_user = user.id_user')
        ->get()->result();
    }

    public function getAllUsers() {
        return $this->db->from('user')
        ->join('role', 'role.id_role = user.id_role')
        ->order_by('created_at', 'DESC')
        ->get()->result();
    }

    public function deleteUser($id)
    {
        return $this->db->where('id_user', $id)
            ->delete('user');
    }

    public function detailUser($id)
    {
        return $this->db->where('id_user', $id)
            ->get('user')->row();
    }

    public function editUser($id)
    {
        return $this->db->where('id_user', $id)
            ->get('user')->row();
    }

    public function updateUser($id, $data)
    {
        return $this->db->where('id_user', $id)
            ->update('user', $data);
    }
}