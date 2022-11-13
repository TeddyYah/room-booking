<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Role_model extends CI_Model
{
    public function editRole($id)
    {
        return $this->db->where('id_Role', $id)
            ->get('role')->row();
    }

    public function updateRole($id, $data)
    {
        return $this->db->where('id_Role', $id)
            ->update('role', $data);
    }
    
    public function deleteRole($id)
    {
        return $this->db->where('id_Role', $id)
            ->delete('role');
    }
}