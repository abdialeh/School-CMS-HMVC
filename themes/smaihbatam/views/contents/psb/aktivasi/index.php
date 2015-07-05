<div class="wrapper" style="margin-top:-35px;">
	<div class="column c-67 clearfix"  style="padding-right:0px;">
		<div class="box contactUs ">
			<h4><span>Form Aktivasi Pendaftaran Siswa Baru </span></h4>
            <?php
            //Biaya Pendaftaran
            $awal = $this->init->getSettingVal('psb_reg_price');
            $random = random_string('numeric',3);
            $akhir = $awal+$random;

            $nmdepan = ($this->session->flashdata('reg_data_firstname')!='')?$this->session->flashdata('reg_data_firstname'):'';
            $nmbelakang = ($this->session->flashdata('reg_data_lastname')!='')?$this->session->flashdata('reg_data_lastname'):'-';
            $phone = ($this->session->flashdata('reg_data_telpon')!='')?$this->session->flashdata('reg_data_telpon'):'';
            $mail = ($this->session->flashdata('reg_data_email')!='')?$this->session->flashdata('reg_data_email'):'';
            $biaya =  ($this->session->flashdata('reg_data_biaya')!='')?$this->session->flashdata('reg_data_biaya'):$akhir;
            $ref   =  ($this->session->flashdata('reg_data_ref')!='')?$this->session->flashdata('reg_data_ref'):'';
            $refother  =  ($this->session->flashdata('reg_data_refother')!='')?$this->session->flashdata('reg_data_refother'):'';

            if($error!=''){
                echo "Ada kesalahan pada sistem ".$error; 
            }
            ?>
			<div class="boxInfo contactForm" style="padding:7px;">
				<form id="frm_activasi" method="post" action="" enctype="multipart/form-data">
					<div style="width:100%;">
						<label style="width:20%;">Kode Aktivasi</label>
                        <input name="kode_aktivasi" type="hidden" value="<?php echo $kode; ?>" />
                        <input style="width:77%;" id="kode_aktivasi" name="kode_aktivasish" type="text" value="<?php echo $kode; ?>" disabled/>
					</div>
                    <div style="width:100%;">
                        <label style="width:20%;">Nominal</label>
                    <input style="width:15%;text-align:center;" id="psb_reg_fee" name="psb_reg_fee" type="text" value=""/>
                    </div>
					<div style="width:100%;">
                        <label style="width:20%;">Pembayaran Dari</label>
                        <input style="width:30%;" id="no_rek_from" name="no_rek_from" type="text" placeholder="No. Rekening" value="" />
                        <input style="width:45%;" id="an_from" name="an_from" type="text" placeholder="Atas Nama" value=""/>
                    </div>
                    <div style="width:100%;">
                        <label style="width:20%;"></label>
                        <textarea style="width:77%;" cols="50" rows="3" id="kcp_from" name="kcp_from" placeholder="Nama & Alamat Kantor Cabang Pembantu lengkap"></textarea>
                    </div>
                    <div style="width:100%;">
                        <label style="width:20%;">Dokumen Bukti Pembayaran</label>
                        <input style="width:77%;" id="bukti_transfer" name="bukti_transfer[]" type="file" />
                    </div>
                    <div style="width:100%;">
                        <label style="width:20%;">Nama Lengkap Calon Siswa</label>
                        <input style="width:40%;" id="psb_calsiswa_firstName" name="psb_calsiswa_firstName" type="text" placeholder="Nama Depan" value="<?php echo $nmdepan; ?>" />
                        <input style="width:35%;" id="psb_calsiswa_lastName" name="psb_calsiswa_lastName" type="text" placeholder="Nama Belakang" value="<?php echo $nmbelakang; ?>"/>
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
						<input id="psbVerifySubmit" class="submit" type="submit" value="Konfirmasi Bayar"/>
					</div>
				</form>
                <!-- <p id="contactSuccess" class="hidden">Your message was successfuly sent! Please wait up to 24hrs until we can contact you back!</p>
				<p id="contactError" class="hidden">Please complete all the required fields properly!</p> -->
			</div>
		</div>
	</div>
	<div class="searchCourse column c-25 clearfix">
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