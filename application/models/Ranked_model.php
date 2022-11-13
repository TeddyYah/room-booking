<?php

class Ranked_model extends CI_model
{
    public function getViewRanked($id)
    {
        $this->db->select('status_bo_pj');
        $this->db->where('status_bo_pj', 'Booking');
        $this->db->where('id_user', $id);
        $query = $this->db->count_all_results('data_pemesanan');
        return $query;
    }

    public function getAllIdRanked()
    {
        $this->db->distinct();
        $this->db->select('id_user');
        $this->db->where('status_bo_pj', 'Booking');
        $query = $this->db->get('data_pemesanan')->result();
        return $query;
    }

    public function getViewBooked()
    {
        $this->db->distinct();
        $this->db->select('nama_pj');
        $this->db->where('status_bo_pj', 'Booking');
        $query = $this->db->get('data_pemesanan')->result();
        return $query;
    }

    public function viewRanked()
    {
        // $this->db->select('*');
        $this->db->from('user');
        $this->db->where('jumlah_booking >',0);
        $this->db->join('role', 'role.id_role = user.id_role');
        $this->db->order_by('jumlah_booking', 'DESC');
        $query = $this->db->get()->result();
        return $query;
    }

    public function viewRankedMax()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('jumlah_booking >',0);
        $this->db->join('role', 'role.id_role = user.id_role');
        $this->db->order_by('jumlah_booking','DESC');
        $this->db->order_by('id_ps', 'ASC');
        $this->db->limit('7','3');
        $query = $this->db->get()->result();
        return $query;
    }

    public function viewRanked1()
    {
        // SELECT * FROM tbl_mahasiswa
        // ORDER BY ipk DESC LIMIT 2, 1;

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('jumlah_booking >',0);
        $this->db->join('role', 'role.id_role = user.id_role');
        $this->db->order_by('jumlah_booking','DESC');
        $this->db->order_by('id_ps', 'ASC');
        $this->db->limit('1','0');
        $query = $this->db->get()->result();
        return $query;
    }

    public function viewRanked2()
    {
        // SELECT * FROM tbl_mahasiswa
        // ORDER BY ipk DESC LIMIT 2, 1;

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('jumlah_booking >',0);
        $this->db->join('role', 'role.id_role = user.id_role');
        $this->db->order_by('jumlah_booking','DESC');
        $this->db->order_by('id_ps', 'ASC');
        $this->db->limit('1','1');
        $query = $this->db->get()->result();
        return $query;
    }

    public function viewRanked3()
    {
        // SELECT * FROM tbl_mahasiswa
        // ORDER BY ipk DESC LIMIT 2, 1;

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('jumlah_booking >',0);
        $this->db->join('role', 'role.id_role = user.id_role');
        $this->db->order_by('jumlah_booking','DESC');
        $this->db->order_by('id_ps', 'ASC');
        $this->db->limit('1','2');
        $query = $this->db->get()->result();
        return $query;
    }
}