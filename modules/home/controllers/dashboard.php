<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	private $_menus;
	private $_session;

	public function __construct()
	{
		parent::__construct();
		$this->_session = $this->template->set('session',$this->session->userdata('sessionData'));
		$this->_menus = $this->init->getMenusBackend();
		$this->init->checkauth();
		if(! $this->init->restrictip()){
			redirect(base_url('error/forbidden'));
		}
	}

	public function index()
	{
		$this->template->title('Dashboard Aplikasi', $this->init->getSettingVal('gen_meta_author'));
		$this->template->set_layout('dashboard')
					   ->set_breadcrumb('Dashboard', '#')
					   ->set('modul', $this->_menus);
		$this->template->build('template');
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */