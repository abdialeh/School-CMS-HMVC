<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends MX_Controller {
	private $_session;
	private $_menus;
	private $default_order = "agenda_datetime";
	private $limit = "10";

	public function __construct()
	{
		parent::__construct();
		$this->load->model('content_model');
		$this->load->model('auth/auth_model');
	}

	public function admin($action=false,$iddata=false){
		$this->_session = $this->template->set('session',$this->session->userdata('sessionData'));
		$this->_menus = $this->init->getMenusBackend();
		$this->init->checkauth();
		if(! $this->init->restrictip()){
			redirect(base_url('error/forbidden'));
		}

		if($action==''){
			redirect(base_url('content/admin/list'));
		}

		switch ($action) {
			case 'list':
					$this->template->title('Backend Dashboard', $this->init->getSettingVal('gen_site_name'))
								   ->set_breadcrumb('Home', base_url('home/dashboard'))
								   ->set_breadcrumb('Konten', '#')
								   ->set('pagedesc', 'Manajemen Konten <small>Pengelolaan Konten Instansi</small>')
								   ->set('modul', $this->_menus)
								   ->set('content','konten/lists')
								   ->build('template');
			break;
			case 'json':
				// print_r($this->template->single());die;
			    parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
				$order_field = array(
					'agenda_id',
					'agenda_title',
					'agenda_desc'
					);

				//don't edit me, pengaturan json untuk menampilkan data di datatable
				$order_key = (!$this->input->get('iSortCol_0'))?0:$this->input->get('iSortCol_0');
				$order = (!$this->input->get('iSortCol_0'))?$this->default_order:$order_field[$order_key];
				$sort = (!$this->input->get('sSortDir_0'))?'desc':$this->input->get('sSortDir_0');
				$search = (!$this->input->get('sSearch'))?'':$this->input->get('sSearch');

				$limit = (!$this->input->get('iDisplayLength'))?$this->limit:$this->input->get('iDisplayLength');
				$start = (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');
				$data['no'] = $start+1;
				$data['sEcho'] = (!$this->input->get('sEcho'))?0:$this->input->get('sEcho');
				$count_tmp = $this->agenda_model->count_all(1,$search,$order_field)->result();
				$data['iTotalRecords'] = count($count_tmp);
				$data['iSortingCols'] = (!$this->input->get('iSortingCols_2'))?2:$this->input->get('iSortingCols_2');
				
				//load data supplier dari database
				$data['listAgenda'] = $this->agenda_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field, 1)->result();

				$data['callback'] = $this->input->get('callback');

				$results['sEcho'] = $data['sEcho'];
				// $results['iSortingCols'] = $data['iSortingCols'];
				$results['iTotalRecords'] = $results['iTotalDisplayRecords'] = $data['iTotalRecords'];
				if(count($data['listAgenda'])>0)
				{
					$i=0;

					foreach($data['listAgenda'] as $agenda)
					{	
						$nomor     		= '<div style="text-align:center;">'.$data['no'].'</a>';
						$d 				= new DateTime($agenda->agenda_datetime);
						$timestamp 		= $d->getTimestamp(); // Unix timestamp
						$agendaDate 	= $d->format('Y-m-d'); // 2003-10-16
						
						$tgl 			= ($agenda->agenda_datetime!='0000-00-00 00:00:00' && $agenda->agenda_datetime!='')?tgl_indo(date('Y-m-d', strtotime($agenda->agenda_datetime))).' '.date('h:i A', strtotime($agenda->agenda_datetime)):'<div style="text-align:center;">-</div>';
						$status 		= (date('Y-m-d') > $agendaDate)?'<center><span class="label label-warning">Tidak Aktif</span></center>':'<center><span class="label label-success">Aktif</span></center>';
						$action 		= '<div style="text-align:center;">';
						$action    	   .= '<a href="'.base_url('agenda/admin/update/'.base64_encode($agenda->agenda_id)).'" class="btn btn-success"><i class="fa fa-edit"></i></a>';
						$action    	   .= "&nbsp;&nbsp;";
						$action    	   .= '<a href="'.base_url('agenda/admin/read/'.base64_encode($agenda->agenda_id)).'" class="btn btn-info" title="Detil Agenda"><i class="fa fa-search-plus"></i></a>';
						$action        .= "</div>";
						$results['aaData'][$i] = array(
							$nomor,
							$agenda->agenda_title,
							$agenda->agenda_place,
							$tgl,
							$status,
							$action
							);

						$data['no']++;
						++$i;
					}
				} else {
					for($i=0;$i<7;++$i) {
						$results['aaData'][0][$i] = '';
					}

				}

				print($data['callback'].json_encode($results));

				// $this->template->single('contents/agenda/list.json', $data);
			break;
			case 'add':
				if($add = $this->input->post()){

					$datainsert = array();
					$agenda_code = 'agenda_'.date('Ymdhis');
					$judul = ($add['agenda_nama']!=='')?$add['agenda_nama']:'-';
					$tempat = ($add['agenda_tempat']!=='')?$add['agenda_tempat']:'-';
					$waktu = ($add['agenda_datetime']!=='')?$add['agenda_datetime']:'-';
					$keterangan = ($add['agenda_keterangan']!=='')?$add['agenda_keterangan']:'-';

					$datainsert = array(
										'agenda_code'				=> $agenda_code,
										'agenda_title'				=> $judul,
										'agenda_place'				=> $tempat,
										'agenda_desc'				=> $keterangan,
										'agenda_datetime'			=> $waktu,
										'agenda_create_by'			=> $this->session->userdata['sessionData']['userID'],
										'agenda_create_datetime'	=> date('Y-m-d H:i:s'),
										'agenda_status'=>1
										);
					$this->agenda_model->add($datainsert);
					$sesslog = $this->session->userdata['sessionData'];
					$ip      = $this->input->ip_address();
					$datalog = array();
					$datalog = array(
						'logactivity_user_id'		=> $sesslog['userID'],
						'logactivity_time' 			=> date("Y-m-d H:i:s"),
						'logactivity_from'			=> $ip,
						'logactivity_type_action'	=> '1',
						'logactivity_text'			=> '{"agenda_code":"'.$agenda_code.'","agenda_title":"'.$judul.'","agenda_place":"'.$tempat.'","agenda_desc":"'.$keterangan.'","agenda_datetime":"'.$waktu.'","agenda_create_by":"'.$sesslog['userID'].'","agenda_create_datetime":"'.date('Y-m-d H:i:s').'","agenda_status":"1"}',
						'logactivity_status'		=> 1
						);

					$insert = $this->auth_model->insertLog($datalog);
					$this->session->set_flashdata('sukses_insert', 'Data konten berhasil disimpan ke database.');
					redirect(base_url('content/admin/list'));
				}else{
					$this->template->title('Backend Dashboard', $this->init->getSettingVal('gen_site_name'))
								   ->set_breadcrumb('Dashboard', base_url('home/dashboard'))
								   ->set_breadcrumb('Daftar Konten', base_url('content/admin'))
								   ->set_breadcrumb('Tambah Konten', '#')
								   ->set('pagedesc', 'Manajemen Konten <small>Pengelolaan Konten Instansi</small>')
								   ->set('modul', $this->_menus)
								   ->set('ContentType', $this->content_model->getTypeContent()->result_array())
								   ->set('content','konten/add')
								   ->build('template');
				}
			break;
			case 'update':
				if($action=='' && $iddata==''){
					redirect(base_url('content/admin/list'));
				}

				//Config Upload Gambar
				$this->load->library('upload');
				$this->upload->initialize(array(
					'upload_path'   => './upload/image/agenda/',
					'allowed_types' => 'gif|jpg|png|jpeg',
					'max_size'		=> '5000',
					'max_width'		=> '0',
					'max_height'	=> '0',
					'encrypt_name'	=> TRUE
					));

				if($update =$this->input->post()){
					$dataupdate = array();

					if($_FILE['agenda_img']['name'][0]==''){
						$dataupdate = array(
							'agenda_title' => $update['agenda_nama'],
							'agenda_place' => $update['agenda_tempat'],
							'agenda_desc' => $update['agenda_keterangan'],
							'agenda_datetime' => $update['agenda_datetime'],
							'agenda_modify_by' => $this->session->userdata['sessionData']['userID'],
							'agenda_modify_datetime' => date('Y-m-d H:i:s'),
							'agenda_status' => $update['agenda_status']

						);
						$this->agenda_model->update(base64_decode($iddata), $dataupdate);

						$sesslog = $this->session->userdata['sessionData'];
						$ip      = $this->input->ip_address();
						$datalog = array();
						$datalog = array(
							'logactivity_user_id'		=> $sesslog['userID'],
							'logactivity_time' 			=> date("Y-m-d H:i:s"),
							'logactivity_from'			=> $ip,
							'logactivity_type_action'	=> '2',
							'logactivity_text'			=> '{"agenda_title":"'.$update['agenda_nama'].'","agenda_place":"'.$update['agenda_tempat'].'","agenda_desc":"'.$update['agenda_keterangan'].'","agenda_datetime":"'.$update['agenda_datetime'].'","agenda_modify_by":"'.$sesslog['userID'].'","agenda_modify_datetime":"'.date('Y-m-d H:i:s').'","agenda_status":"'.$update['agenda_status'].'"}',
							'logactivity_status'		=> 1
							);

						$insert = $this->auth_model->insertLog($datalog);
						$this->session->set_flashdata('sukses_insert', 'Data agenda berhasil diperbaharui dan disimpan ke database.');
						redirect(base_url('agenda/admin/list'));
					}else{
						if(!$this->upload->do_multi_upload('agenda_img')){
							$this->template->title('Backend Dashboard', $this->init->getSettingVal('gen_site_name'))
										   ->set_breadcrumb('Dashboard', base_url('home/dashboard'))
										   ->set_breadcrumb('Daftar Agenda', base_url('agenda/admin'))
										   ->set_breadcrumb('Edit Agenda', '#')
										   ->set('pagedesc', 'Manajemen Agenda <small>Pengelolaan Agenda Instansi</small>')
										   ->set('modul', $this->_menus)
										   ->set('getPhotos', $this->agenda_model->getphoto(base64_decode($iddata))->result_array())
										   ->set('getOneData', $this->agenda_model->getReadAgenda(base64_decode($iddata))->row_array())
										   ->set('gagal', array('error' => $this->upload->display_errors()))
										   ->set('content','agenda/update')
										   ->build('template');
						}else{
							//Start Insert Photo Agenda
							$dataphoto = array();
							$upl = $this->upload->get_multi_upload_data();
							
							for ($i=0; $i < count($upl); $i++) { 
								$dataphoto[] = array(
									'agenda_image_agenda_id' => $iddata,
									'agenda_image_file' => $upl[$i]['file_name'],
									'agenda_image_cover' => isset($update['is_cover_album'][$i])?$update['is_cover_album'][$i]:'-',
									'agenda_image_desc' => isset($update['keterangan_gbr'][$i])?$update['keterangan_gbr'][$i]:'-',
									'agenda_image_status' => 1
									);
							}
						}
					}
				}else{
					$this->template->title('Backend Dashboard', $this->init->getSettingVal('gen_site_name'))
								   ->set_breadcrumb('Dashboard', base_url('home/dashboard'))
								   ->set_breadcrumb('Daftar Agenda', base_url('agenda/admin'))
								   ->set_breadcrumb('Edit Agenda', '#')
								   ->set('pagedesc', 'Manajemen Agenda <small>Pengelolaan Agenda Instansi</small>')
								   ->set('modul', $this->_menus)
								   ->set('getPhotos', $this->agenda_model->getphoto(base64_decode($iddata))->result_array())
								   ->set('getOneData', $this->agenda_model->getReadAgenda(base64_decode($iddata))->row_array())
								   ->set('gagal','')
								   ->set('content','agenda/update')
								   ->build('template');
				}

			break;
			case 'read':
				if($action=='' && $iddata==''){
					redirect(base_url('agenda/admin/list'));
				}	
			break;
		}
	}

	public function index()
	{
		
	}

}

/* End of file  */
/* Location: ./application/controllers/ */