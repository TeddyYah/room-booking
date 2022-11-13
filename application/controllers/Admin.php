<?php

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

		$data['admin'] = $this->Dashboard_model->getAllAdmin();
		$data['all_user'] = $this->Dashboard_model->getAllUser();
		$data['client'] = $this->Dashboard_model->getAllClient();
		$data['booking'] = $this->Dashboard_model->getAllBooking();
		$data['take'] = $this->Dashboard_model->getTakeVideo();
		$data['done'] = $this->Dashboard_model->getDoneTake();
		$data['accepted'] = $this->Dashboard_model->getAccBooking();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/dashboard/index', $data);
		$this->load->view('templates/footer');
	}

	public function waitingBooking()
	{
		$data['title'] = 'Waiting Booking';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

		$data['booking'] = $this->Pesanan_model->getWaitingList();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/booking/waitingBooking', $data);
		$this->load->view('templates/footer');
	}

	public function detailBooking($id)
	{
		$data['title'] = 'Detail Booking';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

		$data['booking'] = $this->Pesanan_model->getDetailBooking($id);
		
		$data['notif'] = $this->Notif_model->getNotifBaru();

        $data1 = [
            'is_read' => 1
        ];
        $this->db->update('data_pemesanan', $data1, ['id_ps' => $id]);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/booking/detailBooking', $data);
		$this->load->view('templates/footer');
	}

	public function allDataBooking()
	{
		$data['title'] = 'All Data Booking';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

		$data['booking'] = $this->Pesanan_model->getBookedRoom();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/booking/allDataBooking', $data);
		$this->load->view('templates/footer');
	}

	public function viewAllCancelBooking()
	{
		$data['title'] = 'All Cancel Booking';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

		$data['booking'] = $this->Pesanan_model->getBookedRoom1();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/booking/v_all_cancel_booking', $data);
		$this->load->view('templates/footer');
	}

	public function todayBooking()
	{
		$data['title'] = 'Today Booking';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d');
		$data['booking'] = $this->Pesanan_model->getBookingToday($date);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/booking/todayBooking', $data);
		$this->load->view('templates/footer');
	}

	public function editBooking($id)
	{
		$data['title'] = 'Edit Booking';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

		$data['booking'] = $this->Pesanan_model->editBooking($id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/booking/editBooking', $data);
		$this->load->view('templates/footer');
	}

	public function takeVideo($id)
	{	
		$data = ['status_bo_pj' => 'Take Video'];

		$this->Pesanan_model->updateStatusBooking($id, $data);
		redirect('admin/waitingBooking');
	}

	public function acceptBooking($id)
	{
		// $username = $this->session->userdata('username');
	
		// $data['user'] = $this->User_model->getuser($username);
		$data['booking'] = $this->Pesanan_model->getDetailBooking($id);
		$id_user = $data['booking']->id_user;
		$data['user'] = $this->User_model->getuser1($id_user);
		// $data['jumlah'] = $this->Pesanan_model->getDetailBooking1($id3);
		$jb = $data['booking']->jumlah_booking;
		$id1 = $data['booking']->id_user;
		$ps = $data['booking']->id_ps;
		$jb1 = $data['user']->jumlah_booking;
		// $jb2 = $data['jumlah']->jumlah_booking;
		// var_dump($jb1);
		// die;
		
		$data = ['status_bo_pj' => 'Done Take'];
		$data1 = [
			'id_ps'			 => $ps,
			'jumlah_booking' 	=> $jb1 + $jb
		];
		// var_dump($id1);
		// die;

		if ($this->Pesanan_model->updateStatusBooking($id, $data)) {
			$this->db->where('id_user', $id1)->update('user', $data1);
			redirect('admin/waitingBooking');
		}

		// $data = ['status_bo_pj' => 'Done Take'];
		// $this->Pesanan_model->updateStatusBooking($id, $data);
		// redirect('admin/waitingBooking');
	}

	public function declineBooking($id)
	{
		$data['booking'] = $this->Pesanan_model->getDetailBooking($id);
		$data['reservasi'] = $this->Pesanan_model->deleteBooking($id);
		// var_dump($data['booking']->id_user);
		// die;
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$data = [
			"id_ps"				=> $data['booking']->id_ps,
			"id_user"			=> $data['booking']->id_user,
			"nama_pj" 			=> $data['booking']->nama_pj,
			"email_pj"			=> $data['booking']->email_pj,
			"tanggal_pj" 		=> $data['booking']->tanggal_pj,
			"dari_pj" 			=> $data['booking']->dari_pj,
			"sampai_pj" 		=> $data['booking']->sampai_pj,
			"judul_pj" 			=> $data['booking']->judul_pj,
			"keperluan_pj" 		=> $data['booking']->keperluan_pj,
			"status_bo_pj" 		=> "Cancel",
			"jumlah_booking" 	=> $data['booking']->jumlah_booking,
			"date_created" 		=> $data['booking']->date_created,
			"date_cancel"       => $date,
			"is_read" 			=> $data['booking']->is_read

		];
		$this->db->insert('all_data', $data);
		$this->Pesanan_model->deleteBooking($id);
		if($data['booking']->status_bo_pj == "Done Take"){
			redirect('admin/waitingBooking');
		} else {
			redirect('admin/viewAllBooking');
		}
		
		

		// if ($this->Pesanan_model->deleteBooking($id)) {
		// 	$this->db->insert('all_data', $data);
		// 	redirect('admin/waitingBooking');
		// }
	}

	public function notifikasi()
	{
		$notif_count = $this->Notif_model->getAllNewNotif();
		
        $result['notif_count'] = $notif_count;
        // $result['notif_count'] = "Berhasil direfresh secara realtime";
        echo json_encode($result);
	}

	public function notifSudahDibaca()
    {
        $all_notif = $this->Notif_model->getNotifBaru();
		
        $result['all_notif'] = $all_notif;
        // $result['notif_count'] = "Berhasil direfresh secara realtime";
        echo json_encode($result);
    }

	public function notifSudahDibacaori($id)
    {
        $data = [
            'is_read' => 1
        ];
        $this->db->update('data_pemesanan', $data, ['id_ps' => $id]);
        $this->session->set_flashdata('msg', 
        '<div class="alert alert-success">Notif berhasil diperbarui</div>');
        return redirect(base_url('admin')); 
    }

    public function notifAllReads()
    {
        $notif = $this->db->get_where('data_pemesanan', ['is_read' => 0])->result_array();

        for($i = 0; $i < count($notif); $i++)
        {
            $data = ['is_read' => 1];
            $this->db->update('data_pemesanan', $data, ['id_ps' => $notif[$i]['id_ps']]);
        }
        $this->session->set_flashdata('msg', 
        '<div class="alert alert-success">Notif berhasil diperbarui</div>');
        return redirect(base_url('admin')); 
    }

	public function hapusNotif()
    {
        $this->db->empty_table('notif');
        $this->session->set_flashdata('msg', 
        '<div class="alert alert-danger">Notif berhasil diperbarui</div>');
        return redirect(base_url('admin/notifikasi')); 
    }

}