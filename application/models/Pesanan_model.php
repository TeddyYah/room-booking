<?php

class Pesanan_model extends CI_model
{
    public function getAllPesanan()
    {
        // return $this->db->order_by("status_bo_pj DESC", "id_ps DESC")->get('data_pemesanan')->result_array();
        return $this->db->order_by("id_ps DESC", "dari_pj ASC")->get('data_pemesanan')->result_array();
    }

    public function getBookingToday($date)
    {
        return $this->db->where('tanggal_pj', $date)
        ->order_by('id_ps', 'DESC')
        ->get('data_pemesanan')->result();
    }

    public function getAllBooking($tglm, $tgls)
    {
        // $this->db->where('tanggal_pj =',$tglm);
        // $this->db->where('tanggal_pj <=',$tgls);
        // return $this->db->get('data_pemesanan')->result();
        
        return $this->db->where("tanggal_pj BETWEEN '{$tglm}' AND '{$tgls}'")
        ->order_by('tanggal_pj', 'DESC')
        ->get('data_pemesanan')->result_array();
    }

    public function getWaitingList()
    {
        return $this->db->where('status_bo_pj', 'Booking')
            ->or_where('status_bo_pj', 'Take Video')
            ->order_by('id_ps', 'DESC')
            ->order_by('status_bo_pj', 'ASC')
            ->get('data_pemesanan')->result();
    }

    public function getWaitingList1($id)
    {
        return $this->db->where('id_ps', $id);
        // $this->db->set('status_bo_pj','Expired');
        $this->db->update('data_pemesanan');
    }

    public function getBookedRoom()
    {
        return $this->db->where('status_bo_pj', 'Done Take')
        ->order_by('id_ps', 'DESC')
        ->get('data_pemesanan')->result();
    }

    public function getBookedRoom1()
    {
        return $this->db->where('status_bo_pj', 'Cancel')
        ->or_where('status_bo_pj', 'Cancel')
        ->get('data_pemesanan')->result();
    }

    public function getBookingByUser($id)
    {
        return $this->db->where('id_user', $id)
        ->order_by('tanggal_pj', 'DESC')
        ->order_by('id_ps', 'ASC')
        ->get('data_pemesanan')->result();
    }

    public function getDetailBooking($id)
    {
        return $this->db->where('id_ps', $id)
            ->get('data_pemesanan')->row();
    }

    public function getDetailBooking1($id_u)
    {
        return $this->db->where('id_user', $id_u)
            ->get('user')->row();
    }

    public function editBooking($id)
    {
        return $this->db->where('id_ps', $id)
            ->get('data_pemesanan')->row();
    }

    public function updateBooking($id, $data)
    {
        return $this->db->where('id_ps', $id)
            ->update('data_pemesanan', $data);
    }

    public function deleteBooking($id_ps)
    {
        return $this->db->where('id_ps', $id_ps)
            ->delete('data_pemesanan');
    }

    public function getPesananById($id)
    {
        return $this->db->get_where('data_pemesanan', ['id_ps' => $id])->row_array();
    }

    public function getPesananByIdUser()
    {
        // return $this->db->from('user')
        // ->join('data_pemesanan', 'data_pemesanan.id_user = user.id_user')
        // ->get()->row();

        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('data_pemesanan','data_pemesanan.id_user=user.id_user');
        $query = $this->db->get();
        return $query;

        // return $this->db->where('id_ps', $id)
        // ->get('data_pemesanan')->row();

        // $this->db->select("*");
		// $query = $this->db->get('tb_siswa')->row();
		
        // $query->tinggi_badan;
    }

    public function updateStatusBooking($id, $data)
    {
        return $this->db->where('id_ps', $id)
            ->update('data_pemesanan', $data);
    }

    // mengembalikan jadwal booked
    public function jadwalBooked($tanggal)
    {
        $this->db->select('dari_pj, sampai_pj');
        $this->db->from('data_pemesanan');
        $this->db->where('tanggal_pj', $tanggal);
        return $this->db->get()->result();
    } 

    public function jadwalBooked1()
    {
        $this->db->select('dari_pj, sampai_pj, status_bo_pj');
        $this->db->from('data_pemesanan');
        $this->db->where('status_bo_pj', 'Booking');
        $this->db->or_where('status_bo_pj', 'Take Video');
        $this->db->or_where('status_bo_pj', 'Done Take');
        return $this->db->get()->result();
    } 
    
    // public function getAllBooking($cek_tanggal)
    // {
    //     $this->db->from('data_pemesanan');
    //     $this->db->where('tanggal_pj', $cek_tanggal);
    //     return $this->db->get()->result();
    // } 
}