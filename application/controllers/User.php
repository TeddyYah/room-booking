<?php

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Home';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);
		$id = $data['user']->id_user;

		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d');
		$data['pesanan'] = $this->Pesanan_model->getBookingToday($date);

		$data['waiting'] = $this->Home_model->getWaitingStatus($id);
		$data['done'] = $this->Home_model->getDoneTakeByUser($id);
		$data['take'] = $this->Home_model->getOnTakeVideo();
		$data['booked'] = $this->Home_model->getSummaryBooking($id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('user/home/index', $data);
		$this->load->view('templates/footer');
	}


	public function viewBooking()
	{
		$data['title'] = 'Schedule';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

		$tglm = $this->input->post('tglm', TRUE);
		$tgls = $this->input->post('tgls', TRUE);

		date_default_timezone_set('Asia/Jakarta');

		if ($tgls < $tglm){
			$this->session->set_flashdata('booking-failed9', 'Gagal');
			redirect('user/viewBooking');
		}

		// var_dump($tgls);
		// die;

		$data['pesanan'] = $this->Pesanan_model->getAllPesanan();
		if ( $this->input->post('tglm') && $this->input->post('tgls') ) {
            $data['pesanan'] = $this->Pesanan_model->getAllBooking($tglm, $tgls);
        }

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('user/booking/viewBooking', $data);
		$this->load->view('templates/footer');
	}

	public function historyBooking()
	{
		$data['title'] = 'History';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);
		$id = $data['user']->id_user;

		$data['booking'] = $this->Pesanan_model->getBookingByUser($id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('user/booking/historyBooking', $data);
		$this->load->view('templates/footer');
	}

	public function detailBooking($id)
	{
		$data['title'] = 'Detail Booking';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

		$data['booking'] = $this->Pesanan_model->getDetailBooking($id);
	
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('user/booking/detailBooking', $data);
		$this->load->view('templates/footer');
	}

	public function cancelBooking($id)
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
			redirect('user/historyBooking');
		

		// $this->Pesanan_model->deleteBooking($id);
		// redirect('user/historyBooking');
	}


	public function validateBooking()
	{
		$this->form_validation->set_rules('nama_pj', 'Nama', 'required');
		$this->form_validation->set_rules('email_pj', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('tanggal_pj', 'Tanggal','required', [
            'required' => 'Wajib diisi !',
        ]);
		$this->form_validation->set_rules('dari', 'Dari', 'required|trim|min_length[3]', [
            'required' => 'Wajib diisi !',
			'max_length' => 'Maksimal 3 karakter !'
        ]);
		$this->form_validation->set_rules('sampai', 'Sampai', 'required|trim|min_length[3]', [
            'required' => 'Wajib diisi !',
			'max_length' => 'Maksimal 3 karakter !'
        ]);
		$this->form_validation->set_rules('judul_pj', 'Judul', 'required', [
            'required' => 'Wajib diisi !',
        ]);
		$this->form_validation->set_rules('keperluan_pj', 'Keperluan', 'required', [
            'required' => 'Wajib diisi !',
        ]);
	}

	public function editBooking($id)
	{
		$data['title'] = 'Edit Booking';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

		$data['booking'] = $this->Pesanan_model->editBooking($id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('user/booking/editBooking', $data);
		$this->load->view('templates/footer');
	}

	public function updateBooking($id)
	{
		$this->validateBooking();
		if ($this->form_validation->run() == FALSE) {
			$this->editBooking($id);
		} else {
			$id = $this->input->post('id_ps', true);
			$tanggal = $this->input->post('tanggal_pj');
			$dari = $this->input->post('dari', true);
			$sampai = $this->input->post('sampai', true);
			// mulai mengubah jadwal booked
			$dataBooked = $this->Pesanan_model->jadwalBooked($tanggal);
			// var_dump( $dataBooked);
			// die;
			
			foreach ($dataBooked as $dBook)
			{
				// echo "($dBook->dari_pj $dBook->sampai_pj) ";
				if ((((strtotime("$tanggal $dari") > strtotime("$tanggal $dBook->dari_pj"))) && 
				((strtotime("$tanggal $dari") < strtotime("$tanggal $dBook->sampai_pj")) )) || 
				(((strtotime("$tanggal $sampai") > strtotime("$tanggal $dBook->dari_pj"))) && 
				((strtotime("$tanggal $sampai") < strtotime("$tanggal $dBook->sampai_pj")) )))
				{
					$this->session->set_flashdata('booking-failed1', 'Gagal');
					redirect('user/historyBooking');
				}				
			}

			// panggil fungsi callback
			$this->callBackBooking($tanggal, $dari, $sampai);

			$query = $this->db->where('tanggal_pj', $tanggal)
				->where("dari_pj BETWEEN '$dari' AND '$sampai'")
				->get('data_pemesanan');
			// cek apakah tgl & jam sudah ada di database pemesanan
			if ($query->num_rows() == true) {
				$this->session->set_flashdata('booking-failed', 'Gagal');
				redirect('user/historyBooking');
			} else {
			$data = [
				"nama_pj" => $this->input->post('nama_pj', true),
				"email_pj" => $this->input->post('email_pj', true),
				"tanggal_pj" => $tanggal,
				"dari_pj" => $dari,
				"sampai_pj" => $sampai,
				"judul_pj" => $this->input->post('judul_pj', true),
				"keperluan_pj" => $this->input->post('keperluan_pj', true),
			];
			$this->Pesanan_model->updateBooking($id, $data);
			$this->session->set_flashdata('update-booking-success', 'Berhasil');
			redirect('user/historyBooking');
		}
	}
	}


	public function callBackBooking($tanggal, $dari, $sampai)
	{
		$mulai 			= 	strtotime($dari); //jam mulai
		$waktu_mulai	= 	date('H:i', $mulai);

		$selesai 		= 	strtotime($sampai); //jam selesai\
		$waktu_selesai	= 	date('H:i', $selesai);

		$waktu_selisih = $selesai - $mulai;
		// var_dump($waktu_selisih);
		// die;

		$min = 600;
		$max = 1800;

		$timestamp1   		=   strtotime('08:00');
		$open				= 	date('H:i', $timestamp1);

		$timestamp2   		=   strtotime('18:00');
		$close 				= 	date('H:i', $timestamp2);

		$timestamp3 		=   strtotime('12:00');
		$istirahat_start 	= 	date('H:i', $timestamp3);

		$timestamp4 		=   strtotime('13:00');
		$istirahat_end		=   date('H:i', $timestamp4);

		$units = 2;

		// var_dump($selesai);
		// die;

		date_default_timezone_set('Asia/Jakarta');
		$time_now = date('H:i'); //jam saat ini
		$now = strtotime($time_now);
		$today = date('Y-m-d');

		// $post_date = '1079621429';
		// $now = time();
		// $units = 2;
		// echo timespan($post_date, $now, $units);

		

		// var_dump($now);
		// die;


		if($today == $tanggal) {
			// jika jam mulai < dari jam sekarang
			if ($waktu_mulai < $time_now) {
				$this->session->set_flashdata('booking-failed2', 'Gagal');
				redirect('user/addBooking');
			}
			// jika waktu selesai < waktu mulai
			elseif ($waktu_selesai < $waktu_mulai) {
				$this->session->set_flashdata('booking-failed3', 'Gagal');
				redirect('user/addBooking');
			}
		}

		if ($waktu_selesai < $waktu_mulai) {
			$this->session->set_flashdata('booking-failed3', 'Gagal');
			redirect('user/viewBooking');
		}
		
		// jika booking dibawah 10 menit
		elseif ($waktu_selisih < $min) {
			$this->session->set_flashdata('booking-failed4', 'Gagal');
			redirect('user/addBooking');
		}

		// jika booking dibawah 30 menit
		elseif ($waktu_selisih > $max) {
			$this->session->set_flashdata('booking-failed5', 'Gagal');
			redirect('user/addBooking');
		}
		
		// mulai mengubah jadwal booked
		$dataBooked = $this->Pesanan_model->jadwalBooked($tanggal);
		// var_dump( $dataBooked);
		// die;

		// // jika booking dijam Istirahat
		// if( $waktu_mulai == $istirahat_start or $waktu_selesai == $istirahat_end) {
		// 	$this->session->set_flashdata('booking-failed6', 'Gagal');
		// 	redirect('user/viewBooking');
		// }
		
		// jika booking dijam Istirahat
		if  (( (( ("$tanggal $waktu_mulai") > ("$tanggal $istirahat_start") )) && 
			(( ("$tanggal $waktu_mulai") < ("$tanggal $istirahat_end") )) ) || 
			( (( ("$tanggal $waktu_selesai") > ("$tanggal $istirahat_start") )) && 
			(( ("$tanggal $waktu_selesai") < ("$tanggal $istirahat_end") )) ))
		{
			$this->session->set_flashdata('booking-failed6', 'Gagal');
			redirect('user/viewBooking');
		}	

		// jika booking tidak sesuai jam operasional
		if($waktu_mulai < $open or $waktu_selesai > $close) {
			$this->session->set_flashdata('booking-failed7', 'Gagal');
			redirect('user/viewBooking');
		}

		if ($tanggal < $today){
			$this->session->set_flashdata('booking-failed8', 'Gagal');
			redirect('user/viewBooking');
		}
		// if($waktu_mulai == $waktu_selesai or $waktu_selesai == $waktu_mulai) {
		// 	$this->session->set_flashdata('booking-failed8', 'Gagal');
		// 	redirect('user/viewBooking');
		// }

	}

	public function addBooking()
	{
		$data['title'] = 'Tambah Booking Ruangan';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);
		// $jb = $data['user']->jumlah_booking;

		// var_dump($jb);
		// die;

		$this->validateBooking();

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('user/booking/addBooking', $data);
			$this->load->view('templates/footer');
		} else {
			$tanggal = $this->input->post('tanggal_pj');
			$dari = $this->input->post('dari', true);
			$sampai = $this->input->post('sampai', true);
			

			// mulai mengubah jadwal booked
			$dataBooked = $this->Pesanan_model->jadwalBooked($tanggal);
			// var_dump( $dataBooked);
			// die;
			
			foreach ($dataBooked as $dBook)
			{
				// echo "($dBook->dari_pj $dBook->sampai_pj) ";
				if ((((strtotime("$tanggal $dari") > strtotime("$tanggal $dBook->dari_pj"))) && 
				((strtotime("$tanggal $dari") < strtotime("$tanggal $dBook->sampai_pj")) )) || 
				(((strtotime("$tanggal $sampai") > strtotime("$tanggal $dBook->dari_pj"))) && 
				((strtotime("$tanggal $sampai") < strtotime("$tanggal $dBook->sampai_pj")) )))
				{
					$this->session->set_flashdata('booking-failed1', 'Gagal');
					redirect('user/viewBooking');
				}				
			}

			// panggil fungsi callback
			$this->callBackBooking($tanggal, $dari, $sampai);

			$query = $this->db->where('tanggal_pj', $tanggal)
				->where("dari_pj BETWEEN '$dari' AND '$sampai'")
				->get('data_pemesanan');
			// cek apakah tgl & jam sudah ada di database pemesanan
			if ($query->num_rows() == true) {
				$this->session->set_flashdata('booking-failed', 'Gagal');
				redirect('user/viewBooking');
			} else {
				$id =  $data['user']->id_user;
				$jb = $data['user']->jumlah_booking;
				$date = date('Y-m-d H:i:s');
				$name = $this->input->post('nama_pj', true);
				// var_dump($date);
				// die;
				$data = [
					"id_user" => $id,
					"nama_pj" => $name,
					"email_pj" => $this->input->post('email_pj', true),
					"tanggal_pj" => $tanggal,
					"dari_pj" => $dari,
					"sampai_pj" => $sampai,
					"judul_pj" => $this->input->post('judul_pj', true),
					"keperluan_pj" => $this->input->post('keperluan_pj', true),
					"status_bo_pj" => "Booking",
					"jumlah_booking" => 1,
					"date_created" => $date,
					"is_read" => 0
				];

				if ($this->db->insert('data_pemesanan', $data)) {
					// $this->db->insert('notif', $notif);
					$this->session->set_flashdata('booking-success', 'Berhasil');
					redirect('user/historyBooking');
				}
				
			}
		}
	}

	public function edit_Profile()
	{
		if($this->session->userdata('id_role') == 3){
            redirect('auth/blocked');
		}
		$data['title'] = 'Edit Profile';
        $username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);

        $this->form_validation->set_rules('fullname', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
            $this->load->view('user/profile/edit_profile', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('username');
            $fullname = $this->input->post('fullname');

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']->image;
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('profile');
                }
            }

            $this->db->set('fullname', $fullname);
            $this->db->where('username', $name);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('profile');
        }
	}
	
	public function ranked()
	{
		$data['title'] = 'Viewboard Ranked';
		$username = $this->session->userdata('username');
		$data['user'] = $this->User_model->getuser($username);
		$data['all_user'] = $this->Ranked_model->getAllIdRanked();
		$dataAllUser = [];
			foreach ($data['all_user'] as $d )
			{
			$dataAllUser[] = $d->id_user;

			}
		
		// var_dump($dataAllUser);
		// die;
		$data['ranked'] = [];
		// $dataAllRanked = [];
			foreach ($dataAllUser as $d )
			{
				$data['ranked'][] = $this->Ranked_model->getViewRanked($d);
				arsort($data['ranked']);
			}
			

		$data['view'] = $this->Ranked_model->viewRanked();
		$data['rank'] = $this->Ranked_model->viewRankedMax();
		$data['rank1'] = $this->Ranked_model->viewRanked1();
		$data['rank2'] = $this->Ranked_model->viewRanked2();
		$data['rank3'] = $this->Ranked_model->viewRanked3();
		// var_dump($data['kagami']);
		// die;

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('user/ranked/view_ranked', $data);
		$this->load->view('templates/footer');
	}

}