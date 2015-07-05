<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Init{

	private $_ci;

	function __construct($config = array())
	{
		$this->_ci =& get_instance();

	}

	public function checkauth(){
		if($this->_ci->session->userdata['sessionData']=='') {
			redirect($this->_ci->config->config['base_url'].'auth');
			die();
		}
	}

	function getSettingVal($codesetting){
		$result = $this->_ci->db->select('setting_value')->where('setting_code', $codesetting)->get('awncms_setting')->result_array();
		foreach ($result as $value) {
			return $value['setting_value'];
		}
	}

	function getDefaultTPL(){
		$result = $this->_ci->db->select('setting_value')->where('setting_code', 'gen_theme')->get('awncms_setting')->row_array();
		return $result['setting_value'];
	}

	public function restrictip(){
		
		//Pengecekan IP address Client
		if (isset($_SERVER['REMOTE_ADDR']) && isset($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} else if (isset($_SERVER['REMOTE_ADDR'])) {
			$ip = $_SERVER['REMOTE_ADDR'];
		} else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}

		//Pengecekan Ip client dengan yang ada didatabase
		$pecahArrIp = array();
		$iparray = self::getSettingVal('sec_allowed_backend'); 
		$ipAddrarray = $iparray;
		$pecahArrIp = explode(",", $ipAddrarray);
		
		if (in_array($ip, $pecahArrIp)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

		private function getMenuBackend_db(){
		
		return $getData = $this->_ci->db->select('module.modules_id, module.modules_name, module.modules_icon, menu_child.menu_id, (CASE WHEN menu_child.menu_parent_id is null THEN menu_parent.menu_parent_id ELSE menu_child.menu_parent_id END) as parent_id, (CASE WHEN menu_child.menu_parent_id is null THEN menu_parent.menu_url ELSE menu_child.menu_url END) as menu_link, menu_child.menu_name,menu_child.menu_icon')
						  ->join('awncms_menu as menu_parent', 'menu_parent.menu_modules_id = module.modules_id', 'inner')
						  ->join('awncms_menu as menu_child', 'menu_child.menu_parent_id = menu_parent.menu_id', 'left')
						  ->where('module.modules_status', 1)
						  ->where('menu_parent.menu_parent_id', 0)
						  ->where('menu_parent.menu_status', 1)
						  ->where('menu_parent.menu_type', 1)
						  ->where('module.modules_type', 1)
						  ->where('menu_parent.menu_visibility', 1)
						  ->where('(CASE WHEN menu_child.menu_parent_id is null THEN 1 ELSE menu_child.menu_status END) = 1')
						  ->order_by('module.modules_order', 'ASC')
						  ->order_by('menu_child.menu_order', 'ASC')
						  ->order_by('menu_parent.menu_order', 'ASC')
						  ->get('awncms_modules as module');	
	}

	function getMenusBackend(){
		$menus  = self::getMenuBackend_db()->result_array();
		$temp_modules = array();
		foreach($menus as $km => $kv) {
			if(!array_key_exists($kv['modules_id'], $temp_modules)) {
				$temp_modules[$kv['modules_id']] = array();
			}
			if(!array_key_exists('module_id', $temp_modules[$kv['modules_id']])) {
				$temp_modules[$kv['modules_id']] = array(
						'module_id'		=> $kv['modules_id'],
						'module_name'	=> $kv['modules_name'],
						'module_icon'	=> $kv['modules_icon'],
						'module_link'	=> ''
					);
			}
			if($kv['parent_id']==0) {
				$temp_modules[$kv['modules_id']]['module_link'] = $kv['menu_link'];
			} else {
				$temp_modules[$kv['modules_id']]['menus'][] = array(
						'menu_id'		=> $kv['menu_id'],
						'menu_name'		=> $kv['menu_name'],
						'menu_link'		=> $kv['menu_link'],
						'menu_icon'		=> $kv['menu_icon']
					);

			}
		}
		$modules = array();
		foreach($temp_modules as $tmv) {
			$modules[] = $tmv;
		}
		return $modules;
	}


	private function getMenuFrontend_db(){
		
		return $getData = $this->_ci->db->select('module.modules_id, module.modules_name, module.modules_icon, menu_child.menu_id, (CASE WHEN menu_child.menu_parent_id is null THEN menu_parent.menu_parent_id ELSE menu_child.menu_parent_id END) as parent_id, (CASE WHEN menu_child.menu_parent_id is null THEN menu_parent.menu_url ELSE menu_child.menu_url END) as menu_link, menu_child.menu_name,menu_child.menu_icon')
						  ->join('awncms_menu as menu_parent', 'menu_parent.menu_modules_id = module.modules_id', 'inner')
						  ->join('awncms_menu as menu_child', 'menu_child.menu_parent_id = menu_parent.menu_id', 'left')
						  ->where('module.modules_status', 1)
						  ->where('menu_parent.menu_parent_id', 0)
						  ->where('menu_parent.menu_status', 1)
						  // ->where('menu_parent.menu_type', 2)
						  // ->where('menu_child.menu_type', 2)
						  ->where('module.modules_type', 2)
						  ->where('menu_parent.menu_visibility', 1)
						  ->where('(CASE WHEN menu_child.menu_parent_id is null THEN 1 ELSE menu_child.menu_status END) = 1')
						  ->order_by('module.modules_order', 'ASC')
						  ->order_by('menu_child.menu_order', 'ASC')
						  ->order_by('menu_parent.menu_order', 'ASC')
						  ->get('awncms_modules as module');	
	}

	function getMenuFrontend(){
		$menus  = self::getMenuFrontend_db()->result_array();
		$temp_modules = array();
		foreach($menus as $km => $kv) {
			if(!array_key_exists($kv['modules_id'], $temp_modules)) {
				$temp_modules[$kv['modules_id']] = array();
			}
			if(!array_key_exists('module_id', $temp_modules[$kv['modules_id']])) {
				$temp_modules[$kv['modules_id']] = array(
						'module_id'		=> $kv['modules_id'],
						'module_name'	=> $kv['modules_name'],
						'module_icon'	=> $kv['modules_icon'],
						'module_link'	=> ''
					);
			}
			if($kv['parent_id']==0) {
				$temp_modules[$kv['modules_id']]['module_link'] = $kv['menu_link'];
			} else {
				$temp_modules[$kv['modules_id']]['menus'][] = array(
						'menu_id'		=> $kv['menu_id'],
						'menu_name'		=> $kv['menu_name'],
						'menu_link'		=> $kv['menu_link'],
						'menu_icon'		=> $kv['menu_icon']
					);

			}
		}
		$modules = array();
		foreach($temp_modules as $tmv) {
			$modules[] = $tmv;
		}
		return $modules;
	}
}