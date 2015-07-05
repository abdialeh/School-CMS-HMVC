<div class="wrapper" style="margin-top:-35px;">
    <div class="column c-67 clearfix" style="padding-right:0px;">
        <div class="box">
            <h4>Alur Penerimaan Siswa Baru</h4>
            <div class="boxInfo">
                <div>
                    <p style="text-align:justify;">
                    <?php echo $psb_alur; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <br>
        <div class="box">
            <h4>Syarat Pendaftaran</h4>
            <div class="boxInfo">
                <div>
                    <p style="text-align:justify;">
                        <?php echo $psb_syarat; ?>
                    </p>
                </div>
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
<!-- 
    <div class="clear"></div>

    <div class="event column c-67 clearfix">
        <h3>Staff Pengajar</h3>
        <div class="arrows"></div>
        <div class="cContent clearfix rotator">
            <ul class="slides">
                <li><a href="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e1_large.jpg" rel="lightbox[events]" class="grayColor" title="Wakasek" title="kjskajskajsk"><img data-color="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e1_large_gallery.jpg" src="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e1_gray.jpg" alt="xxxx" class="imgBorder"></a></li>
                <li><a href="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e2_large.jpg" rel="lightbox[events]" class="grayColor"><img data-color="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e2_large_gallery.jpg" src="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e2_gray.jpg" class="imgBorder" alt=""></a></li>
                <li><a href="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e3_large.jpg" rel="lightbox[events]" class="grayColor"><img data-color="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e3_large_gallery.jpg" src="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e3_gray.jpg" alt="xxxxSSS" class="imgBorder"></a></li>
                <li><a href="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e4_large.jpg" rel="lightbox[events]" class="grayColor"><img data-color="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e4_large_gallery.jpg" src="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e4_gray.jpg" class="imgBorder" alt=""></a></li>
                <li><a href="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e5_large.jpg" rel="lightbox[events]" class="grayColor"><img data-color="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e5_large_gallery.jpg" src="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e5_gray.jpg" class="imgBorder" alt=""></a></li>
                <li><a href="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e6_large.jpg" rel="lightbox[events]" class="grayColor"><img data-color="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e6_large_gallery.jpg" src="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e6_gray.jpg" class="imgBorder" alt=""></a></li>
            </ul>
        </div>
    </div> -->
    </div>

    <map name="alur_psb">
    <area shape="Rect" Coords="80,80,60,60" href="<?php echo base_url('psb/register.html'); ?>"  title="Klik link berikut untuk mendaftar"> 
    <!-- <area style="border:1px solid #000; width:30px;" shape="Rect" Coords="30,30,59,59" href="http://www.hotbot.com">  -->
    </map> 