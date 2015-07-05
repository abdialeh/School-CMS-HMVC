<?php
// echo "<pre>"; print_r($getDataCalonSiswa);die;
?>
<div class="wrapper" style="margin-top:-35px;">
	<div class="column c-67 clearfix"  style="padding-right:0px;">
		<div class="box contactUs ">
			<h4><span>Form Data Calon Siswa Baru </span></h4>
            <?php
            // $nmdepan = ($this->session->flashdata('reg_data_firstname')!='')?$this->session->flashdata('reg_data_firstname'):'';
            // $nmbelakang = ($this->session->flashdata('reg_data_lastname')!='')?$this->session->flashdata('reg_data_lastname'):'-';
            // $phone = ($this->session->flashdata('reg_data_telpon')!='')?$this->session->flashdata('reg_data_telpon'):'';
            // $mail = ($this->session->flashdata('reg_data_email')!='')?$this->session->flashdata('reg_data_email'):'';
            // $biaya =  ($this->session->flashdata('reg_data_biaya')!='')?$this->session->flashdata('reg_data_biaya'):$akhir;
            // $ref   =  ($this->session->flashdata('reg_data_ref')!='')?$this->session->flashdata('reg_data_ref'):'';
            // $refother  =  ($this->session->flashdata('reg_data_refother')!='')?$this->session->flashdata('reg_data_refother'):'';
            if(count($getDataCalonSiswa)>0){
            ?>
			<div class="boxInfo contactForm" style="padding:7px;">
				<form id="frm_complete_calonSiswa" method="post" action="">
                        <input name="pendaftar_user_id" type="hidden" value="<?php echo ($getDataCalonSiswa['pendaftar_user_id']!='')?$getDataCalonSiswa['pendaftar_user_id']:'-'; ?>" />
                        <input name="pendaftar_id" type="hidden" value="<?php echo ($getDataCalonSiswa['pendaftar_id']!='')?$getDataCalonSiswa['pendaftar_id']:'-'; ?>" />
                    <div style="width:100%;">
                        <label style="width:20%;">No. Pendaftaran </label>
                        <input style="width:40%;" id="psb_no_daftar" name="psb_no_daftar" type="text" value="<?php echo ($getDataCalonSiswa['pendaftar_nomor']!='')?$getDataCalonSiswa['pendaftar_nomor']:'-'; ?>" readonly/>
                    </div>
					<div style="width:100%;">
						<label style="width:20%;">Nama Lengkap</label>
                        <input style="width:40%;" id="psb_firstName" name="psb_firstName" type="text" placeholder="Nama Depan" value="<?php echo $getDataCalonSiswa['pendaftar_nama_depan']; ?>" />
						<input style="width:35%;" id="psb_lastName" name="psb_lastName" type="text" placeholder="Nama Belakang" value="<?php echo ($getDataCalonSiswa['pendaftar_nama_belakang']!='')?$getDataCalonSiswa['pendaftar_nama_belakang']:'-'; ?>"/>
                    </div>
                    <div style="width:100%;">
                        <label style="width:20%;">Jenis Kelamin</label>
                        <select id="psb_jenisKelamin" name="psb_jenisKelamin" style="width:20%;">
                            <option>Pilih salah satu</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div style="width:100%;">
                        <label style="width:20%;">Tempat/Tanggal Lahir</label>
                        <input style="width:40%;" id="psb_placeBirth" name="psb_placeBirth" type="text" placeholder="Tempat Lahir" />
                        <input style="width:35%;" id="psb_dateBirth" name="psb_dateBirth" type="text" placeholder="Tanggal Lahir [Format : yyyy-mm-dd]" />
                    </div>
                    <div style="width:100%;">
                        <label style="width:20%;">Asal Sekolah</label>
                        <input style="width:40%;" id="psb_asalSekolah" name="psb_asalSekolah" type="text" placeholder="Nama Asal Sekolah" />
                        <input style="width:35%;" id="psb_noPesertaUN" name="psb_noPesertaUN" type="text" placeholder="No. Peserta UN SMP" />
                    </div>
                    <div style="width:100%;">
                        <label style="width:20%;">Alamat Sekarang</label>
                        <textarea style="width:77%;" rows="2" name="pendaftar_alamat_sekarang" id="pendaftar_alamat_sekarang" placeholder="Alamat lengkap sekarang"></textarea>
                    </div>
                    <div style="width:100%;">
                        <label style="width:20%;">Data Ayah</label>
                        <input style="width:40%;" id="psb_namaAyah" name="psb_namaAyah" type="text" placeholder="Nama Lengkap Ayah" />
                        <input style="width:35%;" id="psb_jobAyah" name="psb_jobAyah" type="text" placeholder="Pekerjaan Ayah" />
                    </div>
					<div style="width:100%;">
                        <label style="width:20%;">Telp/HP. Ayah</label>
                        <input style="width:40%;" id="psb_phoneAyah" name="psb_phoneAyah" type="text" placeholder="Telp./HP Ayah yang bisa dihubungi"/>
                    </div>
                    <div style="width:100%;">
                        <label style="width:20%;">Data Ibu</label>
                        <input style="width:40%;" id="psb_namaIbu" name="psb_namaIbu" type="text" placeholder="Nama Lengkap Ibu" />
                        <input style="width:35%;" id="psb_jobIbu" name="psb_jobIbu" type="text" placeholder="Pekerjaan Ibu" />
                    </div>
                    <div style="width:100%;">
                        <label style="width:20%;">Telp/HP. Ibu</label>
                        <input style="width:40%;" id="psb_phoneIbu" name="psb_phoneIbu" type="text" placeholder="Telp./HP Ibu yang bisa dihubungi"/>
                    </div>
                    <div style="width:100%;">
                        <label style="width:20%;">&nbsp;</label>
                        <label style="width:76%;">Jika diterima di SMA Integral Hidayatullah Batam? </label>
                    </div>
                    <div style="width:100%;margin-top:-15px;">
                        <label style="width:20%;">Sistem yang diikuti</label>
                        <input style="width:6%; float:left;height:20px;margin-top:10px;" id="pendaftar_sistem" name="pendaftar_sistem" type="text"  onkeydown="return numbersonly(this, event);" />
                        <label style="width:69%;margin-top:10px;">&nbsp;&nbsp;1.Full day school (tidak menginap di Asrama), 2. Boarding school (menginap di Asrama) </label>
                    </div>
                    <div style="width:100%;">
                        <label style="width:20%;">&nbsp;</label>
                        <textarea style="width:70%;" rows="5" name="pendaftar_opini_sistem" id="pendaftar_opini_sistem" placeholder="Alasan"></textarea>
                    </div>
                    <div style="width:100%;margin-top:-15px;">
                        <label style="width:20%;">Jurusan yang diminati</label>
                        <input style="width:6%; float:left;height:20px;margin-top:10px;" id="pendaftar_jurusan" name="pendaftar_jurusan" type="text"  onkeydown="return numbersonly(this, event);"/>
                        <label style="width:69%;margin-top:10px;">&nbsp;&nbsp;1. MIA (Matematika dan Ilmu-ilmu Alam), 2. IIS (Ilmu-ilmu Sosial) </label>
                    </div>
                    <div style="width:100%;">
                        <label style="width:20%;">&nbsp;</label>
                        <textarea style="width:70%;" rows="5" name="pendaftar_opini_jurusan" id="pendaftar_opini_jurusan" placeholder="Alasan"></textarea>
                    </div>
                    <div style="width:100%;">
                        <label style="width:20%;">&nbsp;</label>
                        <div style="height:50px;width:70%;"><img id="captchagbr" style="height:50px;margin-left:-55px;" src="<?php echo base_url('psb/captcha'); ?>"> <a href="javascript:void(0);" id="reload-captcha" style="font-size:12px;">Reload</a></div>
                    </div>
                    <div style="width:100%;">
                        <label style="width:20%;">Kode Keamanan</label>
                        <?php $placeholder = "Masukan kode diatas..."?>
                        <input style="width:25%;" type="text" name="captcha" id="captcha" placeholder="<?php echo $placeholder; ?>" class="form-control">
                        <?php if($this->session->flashdata('reg_match_captcha')==1){ echo '<span style="font-size:10px;color:red;width:35%;">Kode keamanan yang anda masukan tidak cocok!</span>';} ?>
                    </div>
                    <div style="width:100%;">
                        <label style="width:100%;"><input type="checkbox" id="psb_cb_ok" value="1" style="width:12px;height:12px;"> Semua data yang dimasukan / diinputkan dapat dipertanggungjawabkan keasliannya.  </label>
                    </div>
                    
                    <div>
						<input id="psbRegCalSisSubmit" class="submit" type="submit" value="Simpan"/>
					</div>
				</form>
                <!-- <p id="contactSuccess" class="hidden">Your message was successfuly sent! Please wait up to 24hrs until we can contact you back!</p>
				<p id="contactError" class="hidden">Please complete all the required fields properly!</p> -->
			</div>
            <?php } ?>
		</div>
	</div>
	<div class="searchCourse column c-33 clearfix">
        <p><img src="<?php echo base_url() ?>themes/smaihbatam/assets/img/icons/calendar-512.png" style="margin-top:-11px;margin-left:-10px;width:50px; height:50px;" align="left">&nbsp;&nbsp;&nbsp;Agenda Kegiatan</p>
        <div class="box" style="padding:0px 0px 0px 0px;">
            <div class="boxInfo" style="padding:0px 0px 0px 0px;"> 
                <div class="accordion" style="margin-top:-10px;">
                    <?php 
                    if(count($psb_agenda)>0){
                        foreach ($psb_agenda as $agenda) {
                            echo '<div class="box">
                            <a href="#">'.$agenda['agenda_title'].'</a>
                            <div class="boxInfo acText" style="padding:0px 1px 0px 0px;">
                            <p style="background-color:transparent;font-size:12px;font-weight:normal;"> 
                            Waktu &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.tgl_indo(date('Y-m-d', strtotime($agenda['agenda_datetime']))).'<br>
                            Tempat &nbsp;&nbsp;&nbsp;: '.$agenda['agenda_place'].'<br>
                            '.$agenda['agenda_desc'].'    
                            </p>
                            </div>
                            </div>';
                        }
                    }else{
                        echo '<div>
                        <p style="background-color:transparent;
                        font-size:12px;font-weight:normal;
                        margin:19px auto;
                        text-align: center;">
                        Maaf, data agenda belum ada.
                        </p>
                        </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>