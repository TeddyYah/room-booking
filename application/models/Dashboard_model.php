<?php

class Dashboard_model extends CI_model
{
    public function getAllAdmin()
    {
        return $this->db->where('id_role', 2)
            ->get('user')->num_rows();
    }

    public function getAllClient()
    {
        return $this->db->where('id_role', 4)
            ->get('user')->num_rows();
    }
    
    public function getAllUser()
    {
        return $this->db->where('id_role', 3)
        ->get('user')->num_rows();
    }

    public function getAccBooking()
    {
        return $this->db->where('status_bo_pj', 'Booking')
            ->get('data_pemesanan')->num_rows();
    }

    public function getAllBooking()
    {
        return $this->db->where('status_bo_pj', 'Booking')
        ->get('data_pemesanan')->num_rows();
    }

    public function getTakeVideo()
    {
        return $this->db->where('status_bo_pj', 'Take Video')
        ->get('data_pemesanan')->num_rows();
    }


    public function getDoneTake()
    {
        return $this->db->where('status_bo_pj', 'Done Take')
        ->get('data_pemesanan')->num_rows();
    }

    public function getDecBooking()
    {
        return $this->db->where('status_bo_pj', 'Ditolak')
            ->get('data_pemesanan')->num_rows();
    }
}