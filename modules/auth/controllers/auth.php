<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MX_Controller {

	private $_menus;
	private $_backendmenus;
	private $_session;
	private $_theme;
	private $_layout;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		//Load Model Front End
		$this->load->model('home/home_model');
	}

	protected function frontend(){

		$this->_menus = $this->init->getMenuFrontend();
		$this->_theme = $this->template->set_theme($this->init->getDefaultTPL());
		$this->_layout = $this->template->set_layout('default');
	}

	public function index(){		
		if($this->init->restrictip()){
			redirect(base_url('auth/backstage'));
		}else{
			redirect(base_url('auth/user'));
		}
	}

	function backstage(){
		if ($this->init->restrictip()) {
			if(isset($this->session->userdata['sessionData']['logged']) && $this->session->userdata['sessionData']['logged']) {
				redirect(base_url('home/dashboard'));
			}
    		//Pengecekan post data
			$data = array();
			if($post = $this->input->post()){
				// echo "<pre>";print_r($post);print_r($_POST);die;
				$useridentity = isset($post['identity'])?$post['identity']:'';
				$password     = isset($post['userpass'])?$post['userpass']:'';
				$captcha = isset($post['captcha'])?$post['captcha']:'';

				$error = false;
				$this->session->set_flashdata('login_data_username', $useridentity);
				
				// if($captcha=='') {
				// 	$error = true; $this->session->set_flashdata('login_empty_captcha', 1);
				// } else {
				// 	if($captcha!=$this->session->userdata('captcha')) {
				// 		$error = true; $this->session->set_flashdata('login_match_captcha', 1);
				// 	}
				// }
				if($error) {
					redirect(base_url('auth/backstage'));
				} else {
					$checkidentity = $this->auth_model->checkidentity($useridentity)->row_array();
					$logincheck = $this->auth_model->checklogin($useridentity, md5(base64_encode($password)))->row_array(); 
					if(count($logincheck)>0){

    				//Create Session login
						$arrSes = array(
							'logged' 		=> true,
							'sess_alert' 	=> 1,
							'groupID'		=> $logincheck['group_id'],
							'userID'		=> $logincheck['user_id'],
							'userName'		=> $logincheck['user_name'],
							'userEmail'		=> $logincheck['user_email'],
							'groupNm'		=> $logincheck['group_name'],
							'Lastlogin'		=> $logincheck['user_last_login']
							);

						$this->session->set_userdata('sessionData', $arrSes);

						$sesslog = $this->session->userdata['sessionData'];
						$ip      = $this->input->ip_address();
						$datalog = array();
						$datalog = array(
							'logactivity_user_id'		=> $sesslog['userID'],
							'logactivity_time' 			=> date("Y-m-d H:i:s"),
							'logactivity_from'			=> $ip,
							'logactivity_type_action'	=> '99',
							'logactivity_text'			=> ' success login into backstage Panel.',
							'logactivity_status'		=> 1
							);

						$insert = $this->auth_model->insertLog($datalog);
						$this->session->set_flashdata('suksesLogin', 'Selamat datang kembali '.ucfirst($sesslog['userName']).' ke halaman administrasi website, silahkan pilih menu sebelah kiri.');
						redirect(base_url('home/dashboard'));
					}else{

						if($useridentity=='' && $password=='' && $captcha==''){
							$this->session->set_flashdata('error', 'Whoops!, Semua field wajib diisi.');
							redirect(base_url('auth/backstage'));
						}

						if(md5(base64_encode($password))!=$checkidentity['user_password'] && $useridentity !=$checkidentity['user_name']){
							$this->session->set_flashdata('error', 'Whoops!, Salah Username / Password, atau username belum di daftarkan. Silahkan hubungi Admin Sistem.');
							redirect(base_url('auth/backstage'));
						}
						if(md5(base64_encode($password))!=$checkidentity['user_password']){
							$this->session->set_flashdata('error', 'Whoops!, Password yang anda masukan salah.');
							redirect(base_url('auth/backstage'));
						}
					}
				}
			}else{
				$this->template->set_layout('login');
				$this->template->build('template');
			}
		}else{
			redirect(base_url('auth/user'));
		}
	}

	function user(){
		if($post = $this->input->post()){

		}else{
			$this->frontend();
			$this->template->title('Login User', $this->init->getSettingVal('gen_site_name'))
						   ->set('modul', $this->_menus)
						   ->set('psb_agenda', $this->home_model->getHomeAgenda()->result_array())
						   ->set('contents','auth/user')
						   ->build('template');
		}
	}

	function userpsb(){
		if($post = $this->input->post()){

		}else{
			$this->frontend();
			$this->template->title('Login User', $this->init->getSettingVal('gen_site_name'))
						   ->set('modul', $this->_menus)
						   ->set('psb_agenda', $this->home_model->getHomeAgenda()->result_array())
						   ->set('contents','psb/login_user')
						   ->build('template');
		}
	}

	public function captcha() {
		$this->load->library('captcha');
		$this->captcha->CreateImage();
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('auth'));
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */