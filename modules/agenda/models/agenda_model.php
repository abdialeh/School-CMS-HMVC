<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda_model extends CI_Model {

	private $primary_key = "agenda_id";

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='desc', $search='', $fields='', $status){
		$this->db->where('agenda_status',1);
		$this->db->where('agenda_datetime > 0000-00-00');
		if($search!='' AND $fields!=''){
				$likeclause = '(';
					$i=0;
					foreach($fields as $field)
					{
						if($i==count($fields)-1) {
							$likeclause .= "UPPER(".$field.") LIKE '%".strtoupper($search)."%'";
						} else {
							$likeclause .= "UPPER(".$field.") LIKE '%".strtoupper($search)."%' OR ";
						}
						++$i;
					}
					$likeclause .= ')';
		$this->db->where($likeclause);
		}

		if (empty($order_column) || empty($order_type))
		{
			$this->db->order_by($this->primary_key,'desc');
		} else {
			$this->db->order_by($order_column,$order_type);
		}
		return $this->db->get('awncms_agenda',$limit,$offset);
	}

	function count_all($status,$search='',$fields=''){
		$this->db->where('agenda_status',1);
		$this->db->where('agenda_datetime > 0000-00-00');
		if($search!='' AND $fields!='')
		{
			$likeclause = '(';
				$i=0;
				foreach($fields as $field)
				{
					if($i==count($fields)-1) {
						$likeclause .= "UPPER(".$field.") LIKE '%".strtoupper($search)."%'";
					} else {
						$likeclause .= "UPPER(".$field.") LIKE '%".strtoupper($search)."%' OR ";
					}
					++$i;
				}
				$likeclause .= ')';
			$this->db->where($likeclause);
		}

		return $this->db->get('awncms_agenda');
	}

	function getReadAgenda($id){
		return $this->db->get_where('awncms_agenda', array('agenda_id' => $id));
	}

	function add($datainsert){
		$this->db->insert('awncms_agenda', $datainsert);
	}

	function update($id, $dataupdate){
		$this->db->where('agenda_id', $id);
		$this->db->update('awncms_agenda', $dataupdate);
	}

	function add_photos($dataphotosinsert){
		$this->db->insert('awncms_agenda_images', $dataphotosinsert);
	}

	function getphoto($idagenda){
		return $this->db->get_where('awncms_agenda_images', array('agenda_image_agenda_id' => $idagenda));
	}

}

/* End of file agenda_model.php */
/* Location: .//var/www/personal/codeigniter/schoolapp/modules/agenda/models/agenda_model.php */