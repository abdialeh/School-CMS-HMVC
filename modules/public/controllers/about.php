<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	private $_menus;
	private $_theme;
	private $_layout;

	public function __construct(){
		parent::__construct();
		$this->_menus = $this->init->getMenuFrontend();
		$this->_theme = $this->template->set_theme($this->init->getDefaultTPL());
		$this->_layout = $this->template->set_layout('default');

		//Load Model
		$this->load->model('about_model');

		//Load Agenda
		$this->template->set('about_agenda', $this->about_model->getAgenda()->result_array());
		
	}

	public function kepsek(){
		$this->template->title('Tentang Kami', $this->init->getSettingVal('gen_site_name'))
					   ->set('modul', $this->_menus)
					   //Sambutan Kepsek
					   ->set('sambutan', $this->init->getSettingVal('profile_headmaster'))
					   ->set('contents','page/about/kepsek')
					   ->build('template');
	}

	public function history(){
		$this->template->title('Tentang Kami', $this->init->getSettingVal('gen_site_name'))
					   ->set('modul', $this->_menus)
					   ->set('artilogo', $this->init->getSettingVal('profile_logo_mean'))
					   ->set('sejarah', $this->init->getSettingVal('profile_history'))
					   ->set('contents','page/about/history')
					   ->build('template');
	}

	public function visimisi(){
		$this->template->title('Tentang Kami', $this->init->getSettingVal('gen_site_name'))
					   ->set('modul', $this->_menus)
					   ->set('visimisi', $this->init->getSettingVal('profile_vision_mission'))
					   ->set('contents','page/about/visimisi')
					   ->build('template');
	}

	public function facility(){
		$this->template->title('Tentang Kami', $this->init->getSettingVal('gen_site_name'))
					   ->set('modul', $this->_menus)
					   ->set('contents','page/about/facility')
					   ->build('template');
	}

	public function contact(){
		$this->template->title('Hubungi Kami', $this->init->getSettingVal('gen_site_name'))
					   ->set('modul', $this->_menus)
					   ->set('fulladdress', $this->init->getSettingVal('gen_address'))
					   ->set('phone', $this->init->getSettingVal('gen_phone_info'))
					   ->set('email', $this->init->getSettingVal('gen_email_info'))
					   ->set('contents','page/about/contact')
					   ->build('template');
	}
}

/* End of file about.php */
/* Location: ./application/controllers/about.php */