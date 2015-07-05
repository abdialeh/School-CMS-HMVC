<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MX_Controller {

	private $_session;
	private $_menus;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('setting_model');
		$this->_session = $this->template->set('session',$this->session->userdata('sessionData'));
		$this->_menus = $this->init->getMenusBackend();

		$this->init->checkauth();
		if(! $this->init->restrictip()){
			redirect(base_url('error/forbidden'));
		}
	}

	public function index()
	{
		redirect(base_url('settings/general'));
	}

	public function general(){
		$this->load->library('upload');
		$config['upload_path'] = './upload/image/';
		$config['allowed_types'] = 'png';
		$config['max_size']  = '500';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['overwrite']   = TRUE;
		$config['encrypt_name']   = TRUE;
		$this->upload->initialize($config);

		if($post_array = $this->input->post()){
			if($_FILES['gen_logo']['name']!=''){
				if ( ! $this->upload->do_upload('gen_logo')){
					$this->template->title('General Setting', $this->init->getSettingVal('gen_site_name'))
						   ->set_breadcrumb('Home', base_url('dashboard/backstage'))
						   ->set_breadcrumb('General Setting', '#')
						   ->set('pagedesc', 'General Setting <small>Setting global Aplikasi</small>')
						   ->set('modul', $this->_menus)
						   ->set('error', array('error' => $this->upload->display_errors()))
						   ->set('get_field', $this->setting_model->getSetGeneral()->result_array())
						   ->set('content','setting/general')
						   ->build('template');
				}else{
					
					$arr_update 	= array();
					$gbrlogo		= array('upload_data' => $this->upload->data());
					$arr_foto       = array(
						'setting_code' => 'gen_logo',
					    'setting_value' => $gbrlogo['upload_data']['file_name']
						);

					foreach($post_array as $key => $value){
					    $arr_update[] = array(
					        'setting_code' => $key,
					        'setting_value' => $value
					    );
					}
					$arr_update[] = $arr_foto;
					$pathlogo = './upload/image/';
					$getlogo = $this->db->select('setting_value')->where('setting_code','gen_logo')->get('awncms_setting')->row_array();
					@unlink($pathlogo.$getlogo['setting_value']);
					$updateGen = $this->setting_model->doupdate($arr_update);
					$this->session->set_flashdata('sukses_update', 'General Setting success updated and save into database.');
					redirect(base_url('settings/general'));
				}

			}else{
				$arr_update = array();
				foreach($post_array as $key => $value){
				    $arr_update[] = array(
				        'setting_code' => $key,
				        'setting_value' => $value
				    );
				}
				$updateGen = $this->setting_model->doupdate($arr_update);
				$this->session->set_flashdata('sukses_update', 'General Setting success updated and save into database.');
				redirect(base_url('settings/general'));
			}
			
		}else{
			$this->template->title('General Setting', $this->init->getSettingVal('gen_site_name'))
						   ->set_breadcrumb('Home', base_url('dashboard/backstage'))
						   ->set_breadcrumb('General Setting', '#')
						   ->set('pagedesc', 'General Setting <small>Setting global Aplikasi</small>')
						   ->set('modul', $this->_menus)
						   ->set('error', '')
						   ->set('get_field', $this->setting_model->getSetGeneral()->result_array())
						   ->set('getlogo', $this->setting_model->getlogo()->row_array())
						   ->set('content','setting/general')
						   ->build('template');
		}
	}

	public function security(){
		if($post_array = $this->input->post()){
			$arr_update 	= array();
			foreach($post_array as $key => $value){
			    $arr_update[] = array(
			        'setting_code' => $key,
			        'setting_value' => $value
			    );
			}
			$updateGen = $this->setting_model->doupdate($arr_update);
			$this->session->set_flashdata('sukses_update', 'Security Setting success updated and save into database.');
			redirect(base_url('settings/security'));
		}else{
			$this->template->title('Security Setting', $this->init->getSettingVal('gen_site_name'))
						   ->set_breadcrumb('Home', base_url('dashboard/backstage'))
						   ->set_breadcrumb('Security Setting', '#')
						   ->set('pagedesc', 'Security Setting <small>Setting Pengamanan Aplikasi</small>')
						   ->set('modul', $this->_menus)
						   ->set('get_field', $this->setting_model->getSetSecurity()->result_array())
						   ->set('content','setting/security')
						   ->build('template');
		}
	}

	public function profile(){
		if($post_array = $this->input->post()){
			$arr_update 	= array();
			foreach($post_array as $key => $value){
			    $arr_update[] = array(
			        'setting_code' => $key,
			        'setting_value' => $value
			    );
			}
			$updateGen = $this->setting_model->doupdate($arr_update);
			$this->session->set_flashdata('sukses_update', 'Profile Setting success updated and save into database.');
			redirect(base_url('settings/profile'));
		}else{
			$this->template->title('Profile Setting', $this->init->getSettingVal('gen_site_name'))
						   ->set_breadcrumb('Home', base_url('home/dashboard'))
						   ->set_breadcrumb('Profile Setting', '#')
						   ->set('pagedesc', 'Profil Setting <small>Setting Profil Instansi</small>')
						   ->set('modul', $this->_menus)
						   ->set('get_field', $this->setting_model->getSetProfile()->result_array())
						   ->set('content','setting/profile')
						   ->build('template');
		}
	}

	public function psb(){
		if($post_array = $this->input->post()){
			// echo "<pre>";print_r($_POST);print_r($post_array);die;
			$arr_update 	= array();
			foreach($post_array as $key => $value){
			    $arr_update[] = array(
			        'setting_code' => $key,
			        'setting_value' => $value
			    );
			}
			$updatePsb = $this->setting_model->doupdate($arr_update);
			$this->session->set_flashdata('sukses_update', 'Profile Setting success updated and save into database.');
			redirect(base_url('settings/psb'));
		}else{
			$this->template->title('PSB Setting', $this->init->getSettingVal('gen_site_name'))
						   ->set_breadcrumb('Home', base_url('home/dashboard'))
						   ->set_breadcrumb('PSB Setting', '#')
						   ->set('pagedesc', 'PSB Setting <small>Setting Penerimaan Siswa Baru Aplikasi</small>')
						   ->set('modul', $this->_menus)
						   ->set('get_field', $this->setting_model->getSetPsb()->result_array())
						   ->set('content','setting/psb')
						   ->build('template');
		}
	}

}
/* End of file settings.php */
/* Location: .//var/www/codeigniter/awncms/modules/settings/controllers/settings.php */