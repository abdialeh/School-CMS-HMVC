<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

	//Insert to logs
	function insertLog($datalog){
		return $this->db->insert('awncms_logactivity', $datalog);
	}

	function checkidentity($useridentity){
		$this->db->select('*');
		$this->db->where('user_name', $useridentity);
		return $this->db->get('awncms_users', 1, 0);
	}

	function checklogin($useridentity, $password){
		$this->db->join('awncms_usergroup', 'awncms_usergroup.group_id = awncms_users.user_group_id', 'left');
		$this->db->where('user_name', $useridentity);
		$this->db->where('user_password', $password);
		return $this->db->get('awncms_users');
	}
}

/* End of file auth_model.php */
/* Location: .//var/www/codeigniter/awncms/modules/auth/models/auth_model.php */