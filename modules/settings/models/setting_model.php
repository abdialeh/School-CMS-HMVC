<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_Model {
	
	//Setting General
	function getSetGeneral(){
		$this->db->select('*');
		$this->db->like('setting_code', 'gen_');
		return $this->db->get('awncms_setting');
	}

	//Setting Security
	function getSetSecurity(){
		$this->db->select('*');
		$this->db->like('setting_code', 'sec_');
		return $this->db->get('awncms_setting');
	}

	//Setting Profile
	function getSetProfile(){
		$this->db->select('*');
		$this->db->like('setting_code', 'profile_');
		return $this->db->get('awncms_setting');
	}

	//Setting PSB
	function getSetPsb(){
		$this->db->select('*');
		$this->db->like('setting_code', 'psb_');
		return $this->db->get('awncms_setting');
	}

	function doupdate($arr_update){
		$this->db->update_batch('awncms_setting', $arr_update, 'setting_code');
	}

	function getlogo(){
		$this->db->select('setting_value');
		$this->db->where('setting_code', 'gen_logo');
		return $this->db->get('awncms_setting');
	}

}

/* End of file setting_model.php */
/* Location: .//var/www/codeigniter/awncms/modules/settings/models/setting_model.php */