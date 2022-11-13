<?php

class Notif_model extends CI_model
{
    public function getAllNewNotif()
    {
        // $this->db->get_where('data_pemesanan', ['is_read' => 0])->result_array();
        $this->db->where('is_read', 0);
        $this->db->from('data_pemesanan');
        return $this->db->count_all_results();
    }

    public function getAllNotif()
    {
        return $this->db->get('notif')
        ->order_by('id_nt', 'ASC')
        ->result_array();
    }

    public function getHapusBarang($id)
    {
        $this->db->delete('tbl_barang', ['id' => $id]);
    }

    public function getNotifBaru()
    { 
        $this->db->select('*');
        $this->db->from('data_pemesanan');
        // $this->db->where('is_read', 0);
        $this->db->order_by('id_ps', 'DESC');
        $this->db->limit('3','0');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getNewNotif($id)
    {
        return $this->db->where('id_role', $id)
        ->order_by('tanggal_pj', 'DESC')
        ->order_by('id_ps', 'ASC')
        ->get('data_pemesanan')->result();
    }
}