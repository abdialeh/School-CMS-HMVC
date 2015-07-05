<div class="wrapper" style="margin-top:-35px;">
	<div class="column c-67 clearfix"  style="padding-right:0px;">
		<div class="box contactUs ">
			<h4><span>Aktivasi Pembayaran Pendaftaran Siswa Baru Sukses</span></h4>
            
			<div class="boxInfo contactForm" style="padding:7px;color:#CCF2A2;">
                <p>Aktivasi Pembayaran Registrasi Siswa baru berhasil diproses. Silahkan cek email anda dan lakukan aktivasi selama 1-3x24 jam</p>
				<p></p>
                <p style="text-align:right;font-weight:bold;font-size:12px;">Terimakasih, Salam hangat</p>
                <p style="text-align:right;font-weight:bold;font-size:12px;">Panitia Pelaksanan PPDB SMA Integral Hidayatullah</p>
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