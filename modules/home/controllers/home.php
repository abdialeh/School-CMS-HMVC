<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	private $_menus;
	private $_theme;
	private $_layout;

	public function __construct(){
		parent::__construct();
		$this->_menus = $this->init->getMenuFrontend();
		$this->_theme = $this->template->set_theme($this->init->getDefaultTPL());
		$this->_layout = $this->template->set_layout('default');

		//Load Model
		$this->load->model('home_model');
	}

	public function index(){
		$this->template->title('Beranda', $this->init->getSettingVal('gen_site_name'))
					   ->set('modul', $this->_menus)
					   //Sambutan Kepsek
					   ->set('sambutan', $this->init->getSettingVal('profile_headmaster'))
					   //Agenda
					   ->set('agenda_home', $this->home_model->getHomeAgenda()->result_array())
					   ->set('contents','page/home/home')
					   ->build('template');
	}
		

}

/* End of file home.php */
/* Location: .//var/www/codeigniter/awncms/modules/home/controllers/home.php */