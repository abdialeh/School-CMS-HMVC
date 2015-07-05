<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Psb extends MX_Controller {

	private $_menus;
	private $_backendmenus;
	private $_session;
	private $_theme;
	private $_layout;
	private $default_order = "psb_reg_user_id";
	private $limit = "10";

	public function __construct(){
		parent::__construct();
		
		$this->load->library('captcha');
		$this->load->library('email');
		//Load Model Front End
		$this->load->model('home/home_model');
		$this->load->model('auth/auth_model');
		$this->load->model('psb_model');
	}

	protected function frontend(){

		$this->_menus = $this->init->getMenuFrontend();
		$this->_theme = $this->template->set_theme($this->init->getDefaultTPL());
		$this->_layout = $this->template->set_layout('default');
	}

	public function admin($action=false,$psbUserId=false, $psbCodeActivate=false){
		$this->_session = $this->template->set('session',$this->session->userdata('sessionData'));
		$this->_backendmenus = $this->init->getMenusBackend();
		$this->init->checkauth();
		if(! $this->init->restrictip()){
			redirect(base_url('error/forbidden'));
		}

		switch ($action) {
			case 'json':
			  	

				$order_field = array(
					'user_id',
					'psb_reg_firstname',
					'psb_reg_lastname',
					'psb_reg_code'
					);

				//don't edit me, pengaturan json untuk menampilkan data di datatable
				$order_key = (!$this->input->get('iSortCol_0'))?0:$this->input->get('iSortCol_0');
				$order = (!$this->input->get('iSortCol_0'))?$this->default_order:$order_field[$order_key];
				$sort = (!$this->input->get('sSortDir_0'))?'desc':$this->input->get('sSortDir_0');
				$search = (!$this->input->get('sSearch'))?'':$this->input->get('sSearch');

				$limit = (!$this->input->get('iDisplayLength'))?$this->limit:$this->input->get('iDisplayLength');
				$start = (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
				$data['no'] = $start+1;
				$data['sEcho'] = (!$this->input->get('callback'))?0:$this->input->get('callback');
				$count_tmp = $this->psb_model->count_all(1,$search,$order_field)->result();
				$data['iTotalRecords'] = count($count_tmp);
				
				//load data supplier dari database
				$data['listPendaftar'] = $this->psb_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field, 1)->result();

				$data['callback'] = $this->input->get('callback');

				$results['sEcho'] = $data['sEcho'];
				// $results['iSortingCols'] = $data['iSortingCols'];
				$results['iTotalRecords'] = $results['iTotalDisplayRecords'] = $data['iTotalRecords'];
				if(count($data['listPendaftar'])>0)
				{
					$i=0;

					foreach($data['listPendaftar'] as $pendaftar)
					{	
						$nomor     		= '<div style="text-align:center;">'.$data['no'].'</a>';
						// $d 				= new DateTime($agenda->agenda_datetime);
						// $timestamp 		= $d->getTimestamp(); // Unix timestamp
						// $agendaDate 	= $d->format('Y-m-d'); // 2003-10-16
						
						// $tgl 			= ($agenda->agenda_datetime!='0000-00-00 00:00:00' && $agenda->agenda_datetime!='')?tgl_indo(date('Y-m-d', strtotime($agenda->agenda_datetime))).' '.date('h:i A', strtotime($agenda->agenda_datetime)):'<div style="text-align:center;">-</div>';
						// $status 		= (date('Y-m-d') > $agendaDate)?'<center><span class="label label-warning">Tidak Aktif</span></center>':'<center><span class="label label-success">Aktif</span></center>';
						   $tanggal     = "";
						   $status      = "";
						   $action 		= "";
						if($pendaftar->psb_reg_status=='0' && $pendaftar->pendaftar_status=='0' && $pendaftar->user_status==''){
							$tanggal    = ($pendaftar->psb_reg_date_create !='0000-00-00 00:00:00' && $pendaftar->psb_reg_date_create !='')?tgl_indo(date('Y-m-d', strtotime($pendaftar->psb_reg_date_create))).' '.date('h:i A', strtotime($pendaftar->psb_reg_date_create)):'-';
							$status     = "Baru Daftar";
							$action 	= '<div style="text-align:center;">';
							
							//Hitung Jumlah hari
							$hari1 = $pendaftar->psb_reg_date_create;
							$hari2 = date('Y-m-d H:i:s');
							$jmlHari = hitung_hari($hari1, $hari2);
							
							if($jmlHari>14){
								$action    	.= '<a href="'.base_url('psb/admin/update/'.base64_encode($pendaftar->user_id).'/'.base64_encode($pendaftar->user_activation_code)).'" class="btn btn-success"><i class="fa fa-edit"></i></a>';
								$action    	.= "&nbsp;&nbsp;";
							}
							$action    	.= '<a href="'.base_url('psb/admin/read/'.base64_encode($pendaftar->user_id).'/'.base64_encode($pendaftar->user_activation_code)).'" class="btn btn-info" title="Detil Data PPDB"><i class="fa fa-search-plus"></i></a>';
							$action     .= "</div>";
						}elseif (($pendaftar->user_status=='0') && ($pendaftar->psb_reg_status=='1') && ($pendaftar->pendaftar_status=='0')) {
							$tglupdate  = explode('|', $pendaftar->psb_reg_date_update);
							$tanggal    = ($pendaftar->psb_reg_date_update!='')?tgl_indo(date('Y-m-d', strtotime($tglupdate[0]))).' '.date('h:i A', strtotime($tglupdate[0])):'<div style="text-align:center;">-</div>';
							$status     = "Sudah Aktivasi (Transfer)";
							$action 	= '<div style="text-align:center;">';
							$action    	.= '<a href="'.base_url('psb/admin/update/'.base64_encode($pendaftar->user_id).'/'.base64_encode($pendaftar->user_activation_code)).'" class="btn btn-success"><i class="fa fa-edit"></i></a>';
							$action    	.= "&nbsp;&nbsp;";
							$action    	.= '<a href="'.base_url('psb/admin/read/'.base64_encode($pendaftar->user_id).'/'.base64_encode($pendaftar->user_activation_code)).'" class="btn btn-info" title="Detil Data PPDB"><i class="fa fa-search-plus"></i></a>';
							$action     .= "</div>";
						}elseif (($pendaftar->user_status=='0') && ($pendaftar->psb_reg_status=='2') && ($pendaftar->pendaftar_status=='1')) {
							$tglupdate  = explode('|', $pendaftar->psb_reg_date_update);
							$tanggal    = ($pendaftar->psb_reg_date_update!='')?tgl_indo(date('Y-m-d', strtotime($tglupdate[1]))).' '.date('h:i A', strtotime($tglupdate[1])):'<div style="text-align:center;">-</div>';
							$status     = "Pembayaran verified";
							$action 	= '<div style="text-align:center;">';
							$action    	.= '<a href="'.base_url('psb/admin/update/'.base64_encode($pendaftar->user_id).'/'.base64_encode($pendaftar->user_activation_code)).'" class="btn btn-success"><i class="fa fa-edit"></i></a>';
							$action    	.= "&nbsp;&nbsp;";
							$action    	.= '<a href="'.base_url('psb/admin/read/'.base64_encode($pendaftar->user_id).'/'.base64_encode($pendaftar->user_activation_code)).'" class="btn btn-info" title="Detil Data PPDB"><i class="fa fa-search-plus"></i></a>';
							$action     .= "</div>";
						}elseif (($pendaftar->user_status=='0') && ($pendaftar->psb_reg_status=='2') && ($pendaftar->pendaftar_status=='2')) {
							$tglupdate  = explode('|', $pendaftar->pendaftar_update);
							$tanggal    = ($pendaftar->pendaftar_update!='')?tgl_indo(date('Y-m-d', strtotime($tglupdate[1]))).' '.date('h:i A', strtotime($tglupdate[1])):'<div style="text-align:center;">-</div>';
							$status     = "Data Pendaftar Ok";
							$action 	= '<div style="text-align:center;">';
							$action    	.= '<a href="'.base_url('psb/admin/update/'.base64_encode($pendaftar->user_id).'/'.base64_encode($pendaftar->user_activation_code)).'" class="btn btn-success"><i class="fa fa-edit"></i></a>';
							$action    	.= "&nbsp;&nbsp;";
							$action    	.= '<a href="'.base_url('psb/admin/read/'.base64_encode($pendaftar->user_id).'/'.base64_encode($pendaftar->user_activation_code)).'" class="btn btn-info" title="Detil Data PPDB"><i class="fa fa-search-plus"></i></a>';
							$action     .= "</div>";
						}elseif (($pendaftar->user_status=='0') && ($pendaftar->psb_reg_status=='2') && ($pendaftar->pendaftar_status=='3')) {
							$tglupdate  = explode('|', $pendaftar->pendaftar_update);
							$tanggal    = ($pendaftar->pendaftar_update!='')?tgl_indo(date('Y-m-d', strtotime($tglupdate[2]))).' '.date('h:i A', strtotime($tglupdate[2])):'<div style="text-align:center;">-</div>';
							$status     = "Telah Mengikuti Test";
							$action 	= '<div style="text-align:center;">';
							$action    	.= '<a href="'.base_url('psb/admin/update/'.base64_encode($pendaftar->user_id).'/'.base64_encode($pendaftar->user_activation_code)).'" class="btn btn-success"><i class="fa fa-edit"></i></a>';
							$action    	.= "&nbsp;&nbsp;";
							$action    	.= '<a href="'.base_url('psb/admin/read/'.base64_encode($pendaftar->user_id).'/'.base64_encode($pendaftar->user_activation_code)).'" class="btn btn-info" title="Detil Data PPDB"><i class="fa fa-search-plus"></i></a>';
							$action     .= "</div>";
						}elseif (($pendaftar->user_status=='1') && ($pendaftar->psb_reg_status=='2') && ($pendaftar->pendaftar_status=='4')) {
							$tglupdate  = explode('|', $pendaftar->pendaftar_update);
							$tanggal    = ($pendaftar->pendaftar_update!='')?tgl_indo(date('Y-m-d', strtotime($tglupdate[3]))).' '.date('h:i A', strtotime($tglupdate[3])):'<div style="text-align:center;">-</div>';
							$status     = "Lulus Test";
							$action 	= '<div style="text-align:center;">';
							$action    	.= '<a href="'.base_url('psb/admin/update/'.base64_encode($pendaftar->user_id).'/'.base64_encode($pendaftar->user_activation_code)).'" class="btn btn-success"><i class="fa fa-edit"></i></a>';
							$action    	.= "&nbsp;&nbsp;";
							$action    	.= '<a href="'.base_url('psb/admin/read/'.base64_encode($pendaftar->user_id).'/'.base64_encode($pendaftar->user_activation_code)).'" class="btn btn-info" title="Detil Data PPDB"><i class="fa fa-search-plus"></i></a>';
							$action     .= "</div>";
						}elseif (($pendaftar->user_status=='99') && ($pendaftar->psb_reg_status=='99') && ($pendaftar->pendaftar_status=='99')) {
							$tglupdate  = explode('|', $pendaftar->pendaftar_update);
							$tanggal    = ($pendaftar->pendaftar_update!='')?tgl_indo(date('Y-m-d', strtotime($tglupdate[4]))).' '.date('h:i A', strtotime($tglupdate[4])):'<div style="text-align:center;">-</div>';
							$status     = "Tidak Lulus Test";
							$action 	= '<div style="text-align:center;">';
							// $action    	.= '<a href="'.base_url('psb/admin/update/'.base64_encode($pendaftar->user_id).'/'.base64_encode($pendaftar->user_activation_code)).'" class="btn btn-success"><i class="fa fa-edit"></i></a>';
							// $action    	.= "&nbsp;&nbsp;";
							$action    	.= '<a href="'.base_url('psb/admin/read/'.base64_encode($pendaftar->user_id).'/'.base64_encode($pendaftar->user_activation_code)).'" class="btn btn-info" title="Detil Data PPDB"><i class="fa fa-search-plus"></i></a>';
							$action     .= "</div>";
						}

						$namaLengkap    = $pendaftar->psb_reg_firstname.' '.$pendaftar->psb_reg_lastname;
						
						$results['aaData'][$i] = array(
							$nomor,
							$namaLengkap,
							$tanggal,
							$status,
							$action
							);

						$data['no']++;
						++$i;
					}
				} else {
					for($i=0;$i<6;++$i) {
						$results['aaData'][0][$i] = '';
					}

				}

				print($data['callback'].json_encode($results));
				// $this->template->single('admin/anggota/lists.json', $data);
			break;

			case 'update':
				if($psbUserId=='' && $psbCodeActivate==''){
					redirect(base_url('psb/admin'));
				}

				if($updatePost = $this->input->post()){
					$dataPendaftar 		   = array();
					$dataRegister  		   = array();
					$dataUjianOnline       = array();
					$dataUjianOnlineGroup  = array();

					$getAuthLog 			= $this->psb_model->getUserById(base64_decode($psbUserId))->row_array();						
					$getPendaftarByUserId   = $this->psb_model->getRCalonSiswaByUserId(base64_decode($psbUserId))->row_array();
					$pecahUpdateTgl 	    = explode('|', $getPendaftarByUserId['pendaftar_update']);
					$getRegistranByUserId   = $this->psb_model->getRegisterByUserId(base64_decode($psbUserId))->row_array();
					$pecahUpdateTglRegister = explode('|', $getRegistranByUserId['psb_reg_date_update']); 
					
					$noDaftar  = $updatePost['pendaftar_dari'].'-'.$updatePost['no_pendataran_otomatis'];
					$validate  = $updatePost['paymentStatus'];

					$dataPendaftar = array(
						'pendaftar_tahun_ajar_id' => $updatePost['tahun_ajar'],
						'pendaftar_nomor' 		  => $noDaftar,
						'pendaftar_keterangan'	  => '',
						'pendaftar_update' 		  => $pecahUpdateTgl[0].'|'.date('Y-m-d H:i:s'),
						'pendaftar_status' 		  => 1
					);

					$dataRegister  = array(
						'psb_reg_date_update'	=> $pecahUpdateTglRegister[0].'|'.date('Y-m-d H:i:s'),
						'psb_reg_status' 		=> $validate
					);

					mt_srand((double) microtime() * 1000000);
					$dataUjianOnline = array(
						'user_regdate' => date('Y-m-d H:i:s'),
						'user_ip' => $this->input->ip_address(),
						'user_name' => $getAuthLog['user_name'],
						'user_email' => $getAuthLog['user_email'],
						'user_password' => getPasswordHash($getAuthLog['user_password_forget']),
						'user_regnumber' => $noDaftar,
						'user_firstname' => $getPendaftarByUserId['pendaftar_nama_depan'],
						'user_lastname' => $getPendaftarByUserId['pendaftar_nama_belakang'],
						'user_birthdate' => '',
						'user_birthplace' => '',
						'user_ssn' => random_string('numeric',9),
						'user_level' => 1,
						'user_verifycode' => md5(uniqid(mt_rand(), true)),
						'user_otpkey' => F_getRandomOTPkey()
					);

					$userIdTest = $this->psb_model->registerOnlineTest($dataUjianOnline);
					$dataUjianOnlineGroup  = array(
						'usrgrp_user_id' => $userIdTest,
						'usrgrp_group_id' => 2
					);


					$updateAdmin  = $this->psb_model->registerOnlineTestGroup($dataUjianOnlineGroup);
					$updateAdmin .= $this->psb_model->updateCalonsiswa(base64_decode($psbUserId),$dataPendaftar);
					$updateAdmin .= $this->psb_model->updateRegistran(base64_decode($psbUserId),$dataRegister);
					// if($updateAdmin){

						$isi = "Assalamu'alaikum Wr. Wb. <br />Selamat Datang di Pendaftaran Siswa Baru SMAIH BATAM";
						$isi .= "Berikut Data - Data Verifikasi Pembayaran Anda:<br /><br /> ";
						$isi .= "Nama                  : <strong>".$getRegistranByUserId['psb_reg_firstname']." ".$getRegistranByUserId['psb_reg_lastname']."</strong> <br />";
						$isi .= "Status Pembayaran     : ". ($validate==1)?'<strong>Belum diverifikasi</strong> <br />':'<strong>Sudah diverifikasi</strong> <br />';
						$isi .= "Username Online Test  :  <strong>".$getAuthLog['user_name']."</strong> <br />";
						$isi .= "Password Online Test  :  <strong>".$getAuthLog['user_password_forget']."</strong> <br />";
						
						$isi .= "Sebelum mengikuti test online silahkan lengkapi terlebih dahulu data calon siswa dengan mengunjungi <a href='".base_url('psb/activation/step-2/'.base64_encode($getAuthLog['user_activation_code']))."' target='_blank'>Halaman Berikut</a><br /> ";
						$isi .= "Dan ikuti instruksi yang ada dihalaman tersebut. Demikian informasi yang dapat kami sampaikan.<br />";
						$isi .= "Wassalamu'alaikum Wr. Wb.<br />";
						
						$this->email->from('no-reply@smaihbatam.sch.id'); // change it to yours
					    $this->email->to($getAuthLog['user_email']);// change it to yours
					    $this->email->subject('[PPDB-SMAIH-'.date('Y').'] Verifikasi Pembayaran Pendaftaran Online');
					    $this->email->message($isi);

					    //Jika Sukses
					    if($this->email->send()){
					    	// $this->email->print_debugger();
					        $this->session->set_flashdata('sukses_update', 'Data pendaftar dan data ujian oline diperbaharui dan disimpan ke database.');
							redirect(base_url('psb/admin'));
					    }else{
					     //Jika Gagal	
					     echo "Maaf ada kesalahan pada saat pemrosesan data. silahkan ulangi lagi klik <a href='javascript: window.history.go(-1)'>disini</a>";
					    }

					// }

				}

				$this->template->title('Manajemen PPDB', $this->init->getSettingVal('gen_site_name'))
							   ->set_breadcrumb('Home', base_url('home/dashboard'))
							   ->set_breadcrumb('Verify Data PPDB', '#')
							   ->set('pagedesc', 'Manajemen PPDB <small>Pengelolaan Penerimaan Siswa Baru</small>')
							   ->set('modul', $this->_backendmenus)
							   ->set('kodeAktivasi', base64_decode($psbCodeActivate))
							   ->set('userID', base64_decode($psbUserId))
							   ->set('listThnAjar', $this->psb_model->getListThnAjar()->result_array())
							   ->set('getOneUser', $this->psb_model->getUserById(base64_decode($psbUserId))->row_array())
							   ->set('getOneRegister', $this->psb_model->getRegisterByUserId(base64_decode($psbUserId))->row_array())
							   ->set('getOneCalonSiswa', $this->psb_model->getRCalonSiswaByUserId(base64_decode($psbUserId))->row_array())
							   ->set('content','psb/update')
							   ->build('template');
				
			break;

			case 'read':
				if($psbUserId=='' && $psbCodeActivate==''){
					redirect(base_url('psb/admin'));
				}

				$this->template->title('Manajemen PPDB', $this->init->getSettingVal('gen_site_name'))
							   ->set_breadcrumb('Home', base_url('home/dashboard'))
							   ->set_breadcrumb('Detail Data PPDB', '#')
							   ->set('pagedesc', 'Manajemen PPDB <small>Pengelolaan Penerimaan Siswa Baru</small>')
							   ->set('modul', $this->_backendmenus)
							   ->set('getOneUser', $this->psb_model->getUserById(base64_decode($psbUserId))->row_array())
							   ->set('getOneRegister', $this->psb_model->getRegisterByUserId(base64_decode($psbUserId))->row_array())
							   ->set('getOneCalonSiswa', $this->psb_model->getRCalonSiswaByUserId(base64_decode($psbUserId))->row_array())
							   ->set('content','psb/detail')
							   ->build('template');
			break;
			
			default:
				$this->template->title('Manajemen PPDB', $this->init->getSettingVal('gen_site_name'))
							   ->set_breadcrumb('Home', base_url('home/dashboard'))
							   ->set_breadcrumb('Daftar Pendaftar PPDB', '#')
							   ->set('pagedesc', 'Manajemen PPDB <small>Pengelolaan Penerimaan Siswa Baru</small>')
							   ->set('modul', $this->_backendmenus)
							   ->set('content','psb/list')
							   ->build('template');
			break;
		}

	}

	public function index(){
		$this->frontend();
		$this->template->title('Penerimaan Siswa Baru', $this->init->getSettingVal('gen_site_name'))
					   ->set('modul', $this->_menus)
					   ->set('psb_agenda', $this->home_model->getHomeAgenda()->result_array())
					   ->set('psb_alur', $this->init->getSettingVal('psb_inf_umum_alur'))
					   ->set('psb_syarat', $this->init->getSettingVal('psb_inf_umum_syarat'))
					   ->set('contents','psb/home')
					   ->build('template');
	}

	public function register(){
		$this->frontend();
		
		$dataRegister = array();
		$dataCalonSiswa = array();
		$dataUserRegister = array();
		$datalog = array();

		if($regpost = $this->input->post()){
			// echo "<pre>";print_r($_POST);print_r($regpost);print_r($this->session->userdata('captcha'));die;
			$firstname 	= isset($regpost['psb_firstName'])?$regpost['psb_firstName']:''; 
			$lastname 	= isset($regpost['psb_lastName'])?$regpost['psb_lastName']:''; 
			$telpon 	= isset($regpost['psb_phone'])?$regpost['psb_phone']:''; 
			$email 		= isset($regpost['psb_mail_addr'])?$regpost['psb_mail_addr']:''; 
			$referensi 	= isset($regpost['psb_ref'])?$regpost['psb_ref']:''; 
			$ref_other 	= isset($regpost['psb_ref_other'])?$regpost['psb_ref_other']:'-'; 
			$biaya 		= isset($regpost['hpsb_reg_fee'])?$regpost['hpsb_reg_fee']:''; 
			$captcha 	= isset($regpost['captcha'])?$regpost['captcha']:'';

			$error = false;
			$this->session->set_flashdata('reg_data_firstname', $firstname);
			$this->session->set_flashdata('reg_data_lastname', $lastname);
			$this->session->set_flashdata('reg_data_telpon', $telpon);
			$this->session->set_flashdata('reg_data_email', $email);
			$this->session->set_flashdata('reg_data_ref', $referensi);
			$this->session->set_flashdata('reg_data_refother', $ref_other);
			$this->session->set_flashdata('reg_data_biaya', $biaya);
			
			if($captcha!=''){
				if($captcha!=$this->session->userdata('captcha')) {
					$error = true; $this->session->set_flashdata('reg_match_captcha', 1);
				}
			}

			if($error){
				redirect(base_url('psb/register.html'));
			}else{
				$random   = random_string('alnum',5);
				$username = $firstname.random_string('alnum', 3);
				$kode     = md5($random);
				$reftxt   = $referensi.'|'.$ref_other;

				$dataUserRegister = array(
					'user_group_id' 		=> 4,
					'user_name' 			=> $username,
					'user_email' 			=> $email,
					'user_password' 		=> $kode,
					'user_password_forget' 	=> $random,
					'user_activation_code' 	=> $kode,
					'user_status' 			=> null,
					'user_is_logged_in' 	=> 0,
					'user_last_login' 		=> null
				);

				$insertRegPsbUser = $this->psb_model->regInsertUser($dataUserRegister);
				//Insert to DB
				$dataRegister = array(
					'psb_reg_code'			=> $kode,
					'psb_reg_user_id'		=> $insertRegPsbUser,
					'psb_reg_firstname'		=> $firstname,
					'psb_reg_lastname'		=> $lastname,
					'psb_reg_email'			=> $email,
					'psb_reg_mobile'		=> $telpon,
					'psb_reg_price_uniq'	=> $biaya,
					'psb_reg_date_create'   => date('Y-m-d H:i:s'),
					'psb_reg_ref'			=> $reftxt,
					'psb_reg_status'		=> 0
				);
				
				$insertRegPsb = $this->psb_model->registerInsert($dataRegister);
				$this->psb_model->registerCalonsiswaInsert($dataCalonSiswa = array('pendaftar_user_id' => $insertRegPsbUser,'pendaftar_update' => date("Y-m-d H:i:s").'|', 'pendaftar_status' => ''));
				$ip      = $this->input->ip_address();
				
				$datalog = array(
					'logactivity_user_id'		=> 000,
					'logactivity_time' 			=> date("Y-m-d H:i:s"),
					'logactivity_from'			=> $ip,
					'logactivity_type_action'	=> '1',
					'logactivity_text'			=> '{"psb_register_data":[{"psb_reg_id":"'.$insertRegPsb.'","psb_reg_code":"'.$kode.'", "psb_reg_firstname":"'.$firstname.'", "psb_reg_lastname":"'.$lastname.'", "psb_reg_email":"'.$email.'", "psb_reg_mobile":"'.$telpon.'", "psb_reg_price_uniq":"'.$biaya.'", "psb_reg_ref":"'.$reftxt.'", "psb_reg_status":"0"}], "psb_register_user_data":[{"user_id":"'.$insertRegPsbUser.'","user_group_id":"4","user_name":"'.$username.'","user_email":"'.$email.'","user_activation_code":"'.$kode.'","user_password":"'.$kode.'","user_password_forget":"'.$random.'","user_status":"0","user_is_logged_in":"0","user_last_login":"null"}]}',
					'logactivity_status'		=> 1
					);

				$insert = $this->auth_model->insertLog($datalog);
				if($insertRegPsb && $insert){
					
					//Send Register Information to Register Email 
					$getLastId = $this->psb_model->getLastIdInsert()->result_array();
					$regId = $getLastId[0]['lastID']; 
					$getOneReg = $this->psb_model->getOneDataReg($regId)->row_array();
					// echo "<pre>";print_r($regId);print_r($getOneReg);die;

					$isi = "Assalamu'alaikum Wr. Wb. <br />Selamat Datang di Pendaftaran Siswa Baru SMAIH BATAM";
					$isi .= "Berikut Data - Data Pengaktifan Akun Anda:<br /><br /> ";
					$isi .= "Nama              :<strong>".$getOneReg['psb_reg_firstname']." ".$getOneReg['psb_reg_lastname']."</strong> <br />";
					$isi .= "Username/Password : <strong>".$getOneReg['user_name']."/".$getOneReg['user_password_forget']."</strong> <br />";
					$isi .= "Biaya Registrasi  :  <strong>".$getOneReg['psb_reg_price_uniq']."</strong> <br />";
					$isi .= "Untuk Mengaktifkan akun anda silahkan melakukan transfer sebesar yang tertera diatas ke rekening kami :<br /> ";
					$isi .= "No. Rekening : <strong>304084034</strong><br /> ";
					$isi .= "Atas Nama    : <strong>Muhammad Ramli</strong><br /> ";
					$isi .= "Nama Bank    : <strong>BNI Syari'ah</strong><br /><br /> ";
					
					$isi .= "Setelah melakukan transfer silahkan mengunjungi <a href='".base_url('psb/activation/step-1/'.base64_encode($getOneReg['user_activation_code']))."' target='_blank'>Halaman Berikut</a><br /> ";
					// $isi .= "Atau konfirmasi melalui SMS/WA ke: +62 853 7431 6327<br />";
					// $isi .= "Dengan format pesan: “Telah transfer Rp.300.xxx, melalui no.rek. xxxxxxxxxx, a/n. xxxxxxxx (nama calon siswa)”<br />";
					// $isi .= "Contoh: “Telah transfer Rp.300.123, melalui no.rek. 1234567890, a/n.SISWANTO”<br /> ";
					$isi .= "Dan ikuti instruksi yang ada dihalaman tersebut. Demikian informasi yang dapat kami sampaikan.<br />";
					$isi .= "Wassalamu'alaikum Wr. Wb.<br />";
					
					$this->email->from('no-reply@smaihbatam.sch.id'); // change it to yours
				    $this->email->to($getOneReg['psb_reg_email']);// change it to yours
				    $this->email->subject('[PPDB-SMAIH-'.date('Y').'] Pendaftaran Siswa Baru');
				    $this->email->message($isi);

				    //Jika Sukses
				    if($this->email->send()){
				      $this->template->title('Form Pendaftaran Siswa Baru', $this->init->getSettingVal('gen_site_name'))
									 ->set('modul', $this->_menus)
									 ->set('psb_agenda', $this->home_model->getHomeAgenda()->result_array())
									 ->set('contents','psb/register_sukses')
									 ->build('template');
				    }else{
				     //Jika Gagal	
				     echo "Maaf ada kesalahan pada saat pemrosesan data. silahkan ulangi lagi klik <a href='javascript: window.history.go(-1)'>disini</a>";
				    }
					//echo "<pre>";print_r($getOneReg);die;
				}
			}
			
		}else{
			$this->template->title('Form Pendaftaran Siswa Baru', $this->init->getSettingVal('gen_site_name'))
					   ->set('modul', $this->_menus)
					   ->set('psb_agenda', $this->home_model->getHomeAgenda()->result_array())
					   ->set('contents','psb/register')
					   ->build('template');
		}
	}

	public function activation($step=false, $kodeAktivasi=false){
		$this->frontend();
		switch ($step) {
			case 'step-1':
				if($kodeAktivasi==''){
					redirect(base_url('psb'));
				}else{
					//Config Upload Gambar
					$this->load->library('upload');
					$this->upload->initialize(array(
						'upload_path'   => './upload/file/dokumen/bukti_transfer/',
						'allowed_types' => 'gif|jpg|png|jpeg',
						'max_size'		=> '5000',
						'max_width'		=> '0',
						'max_height'	=> '0',
						'encrypt_name'	=> TRUE
						));

					$code 		  = base64_decode($kodeAktivasi);
					if($postaktivasi = $this->input->post()){
						if($_FILES['bukti_transfer']['name'][0]!=''){
							$this->session->set_flashdata('kodeAktivasi', $code);
							
							$conditionReg = "psb_reg_code";
							$conditionUsr = "user_activation_code";

							$payfrom = $postaktivasi['no_rek_from'].'|'.$postaktivasi['an_from'].'|'.$postaktivasi['kcp_from'];
							$payto   = '304084034|Muhammad Ramli|BNI Syari\'ah';
							$getOneRegPsb = $this->db->get_where('awncms_sekolah_psb_reg', array('psb_reg_code' => $code))->row_array();

							if ( ! $this->upload->do_multi_upload('bukti_transfer')){
								$this->template->title('Aktivasi Pendaftaran Siswa Baru', $this->init->getSettingVal('gen_site_name'))
												 ->set('modul', $this->_menus)
												 ->set('psb_agenda', $this->home_model->getHomeAgenda()->result_array())
												 ->set('error',array('error' => $this->upload->display_errors()))
												 ->set('contents','psb/aktivasi/index')
												 ->build('template');
							}else{

								$upl = $this->upload->get_multi_upload_data();
								
								$dir = $upl[0]['file_path'];

								$oldFile = $upl[0]['raw_name'].$upl[0]['file_ext'];
								$newFile = $upl[0]['raw_name'].'_'.strtolower($getOneRegPsb['psb_reg_firstname']).'-'.strtolower($getOneRegPsb['psb_reg_lastname']).$upl[0]['file_ext'];

								rename($dir.$oldFile, $dir.$newFile);
								// echo "<pre>";print_r($postaktivasi);print_r($upl);die;
								$dataPendaftaran     = array();
								$dataCalonSiswa     = array();
								// $dataUserPendaftaran = array();

								$dataPendaftaran = array(
									'psb_reg_to_rekening' 			=> $payto,
									'psb_reg_from_rekening' 		=> $payfrom,
									'psb_reg_file_bukti_transfer' 	=> $newFile,
									'psb_reg_date_update' 			=> date("Y-m-d H:i:s"),
									'psb_reg_status' 				=>  1

								);

								$dataUserPendaftaran = array(
									'user_status' => 0
								);

								$getUserID 			  = $this->psb_model->getUserIdByCodeActivate($code)->row_array();
								$getCalonSiswa  	  = $this->psb_model->getRCalonSiswaByUserId($getUserID['user_id'])->row_array();
								$getupdatePecahCalsis = explode('|', $getCalonSiswa['pendaftar_update']);
								$dataCalonSiswa = array(
									'pendaftar_user_id'			=> $getUserID['user_id'],
									'pendaftar_nama_depan' 		=> $postaktivasi['psb_calsiswa_firstName'],
									'pendaftar_nama_belakang' 	=> $postaktivasi['psb_calsiswa_lastName'],
									'pendaftar_update' 			=> $getupdatePecahCalsis[0].'|'.date('Y-m-d H:i:s'),
									'pendaftar_status' 			=> 0
								); 

								$conditionReg = "psb_reg_code";
								$conditionUsr = "user_activation_code";

								$aktivasi = $this->psb_model->updateUserPendaftaranPsb($conditionUsr, $code, $dataUserPendaftaran);
								$aktivasi = $this->psb_model->updatePendaftaranPsb($conditionReg, $code, $dataPendaftaran);
								$aktivasi .= $this->psb_model->updateCalonsiswa($idcalonSiswa=$getCalonSiswa['pendaftar_id'],$dataCalonSiswa);
								
								if($aktivasi){
									$isi = 'Assalamu\'alaikum Wr. Wb. <br />Terimakasih anda telah melakukan pengaktifan akun ppdb anda dengan cara melakukan pembayaran kepada kami. <br />';
									$isi .= 'Mohon ditunggu 1-3x24 jam admin/operator PPDB kami akan melakukan validasi data atas pembayaran yang anda lakukan, apabila data berhasil atau tidak divalidasi kami akan infokan ke alamat email atau no telepon yang sudah anda daftarkan pada sistem kami. <br />';
									$isi .= "Demikian informasi yang dapat kami sampaikan.<br />";
									$isi .= "Wassalamu'alaikum Wr. Wb.<br />";
									$this->email->from('no-reply@smaihbatam.sch.id'); // change it to yours
								    $this->email->to($getUserID['user_email']);// change it to yours
								    $this->email->subject('[PPDB-SMAIH-'.date('Y').'] Aktivasi Pembayaran Pendaftaran Siswa Baru');
								    $this->email->message($isi);

								    //Jika Sukses
								    if($this->email->send()){
								      	$this->template->title('Form Pendaftaran Siswa Baru', $this->init->getSettingVal('gen_site_name'))
													 ->set('modul', $this->_menus)
													 ->set('psb_agenda', $this->home_model->getHomeAgenda()->result_array())
													 ->set('contents','psb/aktivasi_sukses')
													 ->build('template');
								    }else{
								     //Jika Gagal	
								     echo "Maaf ada kesalahan pada saat pemrosesan data. silahkan ulangi lagi klik <a href='javascript: window.history.go(-1)'>disini</a>";
								    }
								}
								// redirect(base_url('psb/activation/step-2/'.base64_encode($code)));
							}
						}
					}else{
						$this->template->title('Aktivasi Pendaftaran Siswa Baru', $this->init->getSettingVal('gen_site_name'))
									   ->set('modul', $this->_menus)
									   ->set('psb_agenda', $this->home_model->getHomeAgenda()->result_array())
									   ->set('kode', $kodeAktivasi)
									   ->set('error', '')
									   ->set('contents','psb/aktivasi/index')
								       ->build('template');
					}
				}
			break;
			case 'step-2':
			 // 	if(!isset($this->session->userdata['sessionData']['logged']) && $this->session->userdata['sessionData']['logged']=='') {
				// 	redirect(base_url('auth/userppsb?nextLogin='.$_SERVER['HTTP_REFERER']));
				// }else{
					$dataPendaftaranSiswa = array();
					$code 		  = base64_decode($kodeAktivasi);
					if($postStep2 = $this->input->post()){
						$idPendaftar 	 = $postStep2['pendaftar_id'];
						$UserIdPendaftar = $postStep2['pendaftar_user_id'];
						$nomorPendaftar  = $postStep2['psb_no_daftar'];
						$jkPendaftar 	 = $postStep2['psb_jenisKelamin'];
						$ttlPendaftar 	 = $postStep2['psb_placeBirth'].'|'.$postStep2['psb_dateBirth'];
						$assekPendaftar  = $postStep2['psb_asalSekolah'];
						$noPesUNPendaftar  = ($postStep2['psb_noPesertaUN']!='')?$postStep2['psb_noPesertaUN']:'-';
						$alamatPendaftar   = ($postStep2['pendaftar_alamat_sekarang']!='')?$postStep2['pendaftar_alamat_sekarang']:'-';
						$dataAyahNm 	   = ($postStep2['psb_namaAyah']!='')?$postStep2['psb_namaAyah']:'-';
						$dataAyahJob	   = ($postStep2['psb_jobAyah']!='')?$postStep2['psb_jobAyah']:'-';
						$dataAyahTelp 	   = ($postStep2['psb_phoneAyah']!='')?$postStep2['psb_phoneAyah']:'-';
						$dataAyahPendaftar = $dataAyahNm.'|'.$dataAyahJob.'|'.$dataAyahTelp;
						$dataIbuNm 	   	   = ($postStep2['psb_namaIbu']!='')?$postStep2['psb_namaIbu']:'-';
						$dataIbuJob	   	   = ($postStep2['psb_jobIbu']!='')?$postStep2['psb_jobIbu']:'-';
						$dataIbuTelp 	   = ($postStep2['psb_phoneIbu']!='')?$postStep2['psb_phoneIbu']:'-';
						$dataIbuPendaftar  = $dataIbuNm.'|'.$dataIbuJob.'|'.$dataIbuTelp;
						$SisChoice    	   = ($postStep2['pendaftar_sistem']!='')?$postStep2['pendaftar_sistem']:'-'; 
						$opiniSisChoice    = ($postStep2['pendaftar_opini_sistem']!='')?$postStep2['pendaftar_opini_sistem']:'-';
						$opiniSisChoiceReg = $SisChoice.'|'.$opiniSisChoice;
						$JurChoice    	   = ($postStep2['pendaftar_jurusan']!='')?$postStep2['pendaftar_jurusan']:'-';
						$opiniJurChoice    = ($postStep2['pendaftar_opini_jurusan']!='')?$postStep2['pendaftar_opini_jurusan']:'-';
						$opiniJurChoiceReg = $JurChoice.'|'.$opiniJurChoice;

						$getIdUser 	  		= $this->psb_model->getOnePriceByCodeActivation($code)->row_array();
						$getDataCalonSiswa  = $this->psb_model->getRCalonSiswaByUserId($getIdUser['psb_reg_user_id'])->row_array();

						$pecahUpdateTgl     = explode('|', $getDataCalonSiswa['pendaftar_update']);

	 					$dataPendaftaranSiswa = array(
							'pendaftar_jkelamin' 				=> $jkPendaftar,
							'pendaftar_ttl' 	 				=> $ttlPendaftar,
							'pendaftar_asal_sekolah' 			=> $assekPendaftar,
							'pendaftar_nopeserta_unsmp' 		=> $noPesUNPendaftar,
							'pendaftar_data_ortu_ayah' 			=> $dataAyahPendaftar,
							'pendaftar_data_ortu_ibu' 			=> $dataIbuPendaftar,
							'pendaftar_alamat_sekarang' 		=> $alamatPendaftar,
							'pendaftar_opini_sistem_diikuti' 	=> $opiniSisChoiceReg,
							'pendaftar_opini_jurusan_diminati' 	=> $opiniJurChoiceReg,
							'pendaftar_update' 					=> $pecahUpdateTgl[0].'|'.date('Y-m-d H:i:s'),
							'pendaftar_status'					=> 2
						);

					$this->psb_model->updateCalonsiswaStep2($idPendaftar, $nomorPendaftar, $UserIdPendaftar,$dataPendaftaranSiswa);
					// if($step2Update){
						redirect('http://psb.smaihbatam.sch.id/testonline/public/code/index.php');
					// }

					}else{
						$code 		  = base64_decode($kodeAktivasi);

						$getIdUser 	  = $this->psb_model->getOnePriceByCodeActivation($code)->row_array(); 
						$this->template->title('Data Calon Siswa', $this->init->getSettingVal('gen_site_name'))
									   ->set('modul', $this->_menus)
									   ->set('getDataCalonSiswa', $this->psb_model->getRCalonSiswaByUserId($getIdUser['psb_reg_user_id'])->row_array())
									   ->set('psb_agenda', $this->home_model->getHomeAgenda()->result_array())
									   ->set('contents','psb/aktivasi/step2')
								       ->build('template');
					}
				// }
			break;
		}
	}

	public function captcha() {
		$this->captcha->CreateImage();
	}
}