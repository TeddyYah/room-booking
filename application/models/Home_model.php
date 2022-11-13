<?php

class Home_model extends CI_model
{

    public function getWaitingStatus($id)
    {
        return $this->db->where('status_bo_pj', 'Booking')
            ->where('id_user', $id)
            ->get('data_pemesanan')->num_rows();
    }

    public function getDoneTakeByUser($id)
    {
        return $this->db->where('status_bo_pj', 'Done Take')
            ->where('id_user', $id)
            ->get('data_pemesanan')->num_rows();
    }

    public function getOnTakeVideo()
    {
        return $this->db->where('status_bo_pj', 'Take Video')
        ->order_by('dari_pj', 'ASC')
        ->limit('1','0')
        ->get('data_pemesanan')->result();
    }

    public function getSummaryBooking($id)
    {
        return $this->db->where('id_user', $id)
            ->get('data_pemesanan')->num_rows();
    }
}