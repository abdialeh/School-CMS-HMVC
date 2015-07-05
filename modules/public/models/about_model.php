<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About_model extends CI_Model {

	//Get Agenda
	function getAgenda(){
		$this->db->select('*');
		$this->db->where('agenda_status', 1);
		$this->db->order_by('agenda_id', 'desc');
		return $this->db->get('awncms_agenda', 4);
	}



}

/* End of file about_model.php */
/* Location: ./application/models/about_model.php */