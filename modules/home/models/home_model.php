<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

	//Front end Model
	function getHomeAgenda(){
		$this->db->select('*');
		$this->db->where('agenda_status', 1);
		$this->db->order_by('agenda_id', 'desc');
		return $this->db->get('awncms_agenda', 5);
	}

}

/* End of file home_model.php */
/* Location: ./application/models/home_model.php */