<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Psb_model extends CI_Model {

	private $primary_key ="user_id";

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='desc', $search='', $fields='', $status){
		$this->db->select('awncms_sekolah_psb_reg.psb_reg_id,
							awncms_sekolah_psb_reg.psb_reg_user_id,
							awncms_sekolah_psb_reg.psb_reg_code,
							awncms_sekolah_psb_reg.psb_reg_firstname,
							awncms_sekolah_psb_reg.psb_reg_lastname,
							awncms_sekolah_psb_reg.psb_reg_email,
							awncms_sekolah_psb_reg.psb_reg_mobile,
							awncms_sekolah_psb_reg.psb_reg_price_uniq,
							awncms_sekolah_psb_reg.psb_reg_to_rekening,
							awncms_sekolah_psb_reg.psb_reg_from_rekening,
							awncms_sekolah_psb_reg.psb_reg_file_bukti_transfer,
							awncms_sekolah_psb_reg.psb_reg_ref,
							awncms_sekolah_psb_reg.psb_reg_date_create,
							awncms_sekolah_psb_reg.psb_reg_date_update,
							awncms_sekolah_psb_reg.psb_reg_status,
							awncms_users.user_id,
							awncms_users.user_name,
							awncms_users.user_email,
							awncms_users.user_activation_code,
							awncms_users.user_status,
							awncms_sekolah_psb_pendaftar.pendaftar_nama_depan,
							awncms_sekolah_psb_pendaftar.pendaftar_nama_belakang,awncms_sekolah_psb_pendaftar.pendaftar_update,awncms_sekolah_psb_pendaftar.pendaftar_status');
		$this->db->join('awncms_sekolah_psb_reg', 'awncms_sekolah_psb_reg.psb_reg_user_id = awncms_users.user_id', 'inner');
		$this->db->join('awncms_sekolah_psb_pendaftar', 'awncms_sekolah_psb_pendaftar.pendaftar_user_id = awncms_users.user_id', 'inner');
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
		return $this->db->get('awncms_users',$limit,$offset);
	}

	function count_all($status,$search='',$fields=''){
		$this->db->select('awncms_sekolah_psb_reg.psb_reg_id,
							awncms_sekolah_psb_reg.psb_reg_user_id,
							awncms_sekolah_psb_reg.psb_reg_code,
							awncms_sekolah_psb_reg.psb_reg_firstname,
							awncms_sekolah_psb_reg.psb_reg_lastname,
							awncms_sekolah_psb_reg.psb_reg_email,
							awncms_sekolah_psb_reg.psb_reg_mobile,
							awncms_sekolah_psb_reg.psb_reg_price_uniq,
							awncms_sekolah_psb_reg.psb_reg_to_rekening,
							awncms_sekolah_psb_reg.psb_reg_from_rekening,
							awncms_sekolah_psb_reg.psb_reg_file_bukti_transfer,
							awncms_sekolah_psb_reg.psb_reg_ref,
							awncms_sekolah_psb_reg.psb_reg_date_create,
							awncms_sekolah_psb_reg.psb_reg_date_update,
							awncms_sekolah_psb_reg.psb_reg_status,
							awncms_users.user_id,
							awncms_users.user_name,
							awncms_users.user_email,
							awncms_users.user_activation_code,
							awncms_users.user_status,
							awncms_sekolah_psb_pendaftar.pendaftar_nama_depan,
							awncms_sekolah_psb_pendaftar.pendaftar_nama_belakang,awncms_sekolah_psb_pendaftar.pendaftar_update,awncms_sekolah_psb_pendaftar.pendaftar_status');
		$this->db->join('awncms_sekolah_psb_reg', 'awncms_sekolah_psb_reg.psb_reg_user_id = awncms_users.user_id', 'inner');
		$this->db->join('awncms_sekolah_psb_pendaftar', 'awncms_sekolah_psb_pendaftar.pendaftar_user_id = awncms_users.user_id', 'inner');
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

		return $this->db->get('awncms_users');
	}

	//Get List Tahun Ajar

	public function getListThnAjar(){
		$this->db->where('thn_ajar_status', 1);
		$this->db->order_by('thn_ajar_id', 'asc');
		return $this->db->get('awncms_sekolah_tahun_ajar');
	} 

	//Register Input to DB
	public function regInsertUser($dataUserRegister){
		$this->db->insert('awncms_users', $dataUserRegister);
		return $this->db->insert_id();
	}
	
	public function registerInsert($dataRegister){
		$this->db->insert('awncms_sekolah_psb_reg', $dataRegister);
		return $this->db->insert_id();
	}


	public function registerCalonsiswaInsert($dataCalonSiswa){
		$this->db->insert('awncms_sekolah_psb_pendaftar', $dataCalonSiswa);
		return $this->db->insert_id();
	}

	//Insert into tbl User Ujian Online
	public function registerOnlineTest($dataUjianOnline){
		$this->db->insert('tce_users', $dataUjianOnline);
		return $this->db->insert_id();
	}

	public function registerOnlineTestGroup($dataUjianOnlineGroup){
		$this->db->insert('tce_usrgroups', $dataUjianOnlineGroup);
	}	
	

	public function updateCalonsiswa($idUser,$dataCalonSiswa){
		$this->db->where('pendaftar_user_id', $idUser);	
		$this->db->update('awncms_sekolah_psb_pendaftar', $dataCalonSiswa);
	}

	public function updateCalonsiswaStep2($id, $nomor, $idUser,$dataCalonSiswa){
		$this->db->where('pendaftar_id', $id);	
		$this->db->where('pendaftar_nomor', $nomor);	
		$this->db->where('pendaftar_user_id', $idUser);	
		$this->db->update('awncms_sekolah_psb_pendaftar', $dataCalonSiswa);
	}

	public function updateRegistran($idUser,$dataRegistran){
		$this->db->where('psb_reg_user_id', $idUser);	
		$this->db->update('awncms_sekolah_psb_reg', $dataRegistran);
	}


	function getLastIdInsert(){
		$this->db->select('MAX(psb_reg_id) AS lastID');
		return $this->db->get('awncms_sekolah_psb_reg');
	}

	function getOneDataReg($regId){
		$this->db->select('*');
		$this->db->from('awncms_sekolah_psb_reg');
		$this->db->join('awncms_users', 'user_id = psb_reg_user_id', 'left');
		$this->db->where('psb_reg_id', $regId);
		return $this->db->get();
	}

	function getUserIdByCodeActivate($code){
		$this->db->select('user_id, user_email');
		$this->db->where('user_activation_code', $code);
		return $this->db->get('awncms_users');
	}

	function updatePendaftaranPsb($conditionReg, $code, $dataPendaftaran){
		$this->db->where($conditionReg, $code);
		$this->db->update('awncms_sekolah_psb_reg', $dataPendaftaran);
	}

	function updateUserPendaftaranPsb($conditionUsr, $code, $dataUserPendaftaran){
		$this->db->where($conditionUsr, $code);
		$this->db->update('awncms_users', $dataUserPendaftaran);
	}

	function getOnePriceByCodeActivation($code){
		return $this->db->get_where('awncms_sekolah_psb_reg', array('psb_reg_code' => $code));
	}

	//GetDataBy UserID
	function getUserById($psbUserId){
		$this->db->join('awncms_usergroup', 'group_id = user_group_id', 'inner');
		return $this->db->get_where('awncms_users', array('user_id' => $psbUserId));
	}

	function getRegisterByUserId($psbUserId){
		return $this->db->get_where('awncms_sekolah_psb_reg', array('psb_reg_user_id' => $psbUserId));
	}

	function getRCalonSiswaByUserId($psbUserId){
		return $this->db->get_where('awncms_sekolah_psb_pendaftar', array('pendaftar_user_id' => $psbUserId));
	}

}

/* End of file psb_model.php */
/* Location: ./application/models/psb_model.php */