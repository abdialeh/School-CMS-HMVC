<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Content_model extends CI_Model{


	function getTypeContent(){
		$this->db->order_by('type_name', 'asc');
		return $this->db->get_where('awncms_content_type', array('type_status' => 1));
	}
}