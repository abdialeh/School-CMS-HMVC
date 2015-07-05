<div class="wrapper" style="margin-top:-35px;">
	<div class="column c-67 clearfix"  style="padding-right:0px;">
		<div class="box contactUs ">
			<h4><span>Form Login User </span></h4>
            <?php
            
            $nmdepan = ($this->session->flashdata('reg_data_firstname')!='')?$this->session->flashdata('reg_data_firstname'):'';
            // $nmbelakang = ($this->session->flashdata('reg_data_lastname')!='')?$this->session->flashdata('reg_data_lastname'):'-';
            // $phone = ($this->session->flashdata('reg_data_telpon')!='')?$this->session->flashdata('reg_data_telpon'):'';
            ?>
			<div class="boxInfo contactForm" style="padding:7px;">
				<form id="frm_user_login" method="post" action="">
					
					<div style="width:100%;">
                        <label style="width:20%;">Telp/HP. </label>
                        <input style="width:40%;" id="psb_phone" name="psb_phone" type="text" placeholder="Telp./HP yang bisa dihubungi" value="<?php echo $username; ?>"/>
                    </div>
                    <div style="width:100%;">
                        <label style="width:20%;">Email </label>
                        <input style="width:40%;" id="psb_mail_addr" name="psb_mail_addr" type="password" placeholder="Alamat email yang aktif"/>
                    </div>
                    
                    <div style="width:100%;">
                        <label style="width:20%;">Kode Keamanan</label>
                        <?php $placeholder = "Masukan kode diatas..."?>
                        <input style="width:25%;" type="text" name="captcha" id="captcha" placeholder="<?php echo $placeholder; ?>" class="form-control">
                        <?php if($this->session->flashdata('reg_match_captcha')==1){ echo '<span style="font-size:10px;color:red;width:35%;">Kode keamanan yang anda masukan tidak cocok!</span>';} ?>
                    </div>
                    <!-- <div style="width:100%;">
                        <label style="width:100%;"><input type="checkbox" id="psb_cb_ok" value="1" style="width:12px;height:12px;"> Semua data yang dimasukan / diinputkan dapat dipertanggungjawabkan keasliannya.  </label>
                    </div> -->
                    
                    <div>
						<input id="loginSubmit" class="submit" type="submit" value="Login"/>
					</div>
				</form>
                <!-- <p id="contactSuccess" class="hidden">Your message was successfuly sent! Please wait up to 24hrs until we can contact you back!</p>
				<p id="contactError" class="hidden">Please complete all the required fields properly!</p> -->
			</div>
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