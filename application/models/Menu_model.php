<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                  FROM `user_sub_menu` JOIN `user_menu`
                  ON `user_sub_menu`.`id_menu` = `user_menu`.`id_menu`
                ";
        return $this->db->query($query)->result_array();
    }
    public function editMenu($id)
    {
        return $this->db->where('id_menu', $id)
            ->get('user_menu')->row();
    }

    public function updateMenu($id, $data)
    {
        return $this->db->where('id_menu', $id)
            ->update('user_menu', $data);
    }
    
    public function deleteMenu($id)
    {
        return $this->db->where('id_menu', $id)
            ->delete('user_menu');
    }

    public function editSubMenu($id)
    {
        return $this->db->where('id_sub_menu', $id)
            ->get('user_sub_menu')->row();
    }

    public function updateSubMenu($id, $data)
    {
        return $this->db->where('id_sub_menu', $id)
            ->update('user_sub_menu', $data);
    }
    
    public function deleteSubMenu($id)
    {
        return $this->db->where('id_sub_menu', $id)
            ->delete('user_sub_menu');
    }
}