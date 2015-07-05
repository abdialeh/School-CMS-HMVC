<div class="wrapper" style="margin-top:-35px;">
    <div class="column c-67 clearfix" style="padding-right:0px;">
        <div class="box">
            <h4>Sambutan Kepala Sekolah</h4>
            <div class="boxInfo">
                <a href="<?php echo base_url() ?>themes/smaihbatam/assets/img/professors/1st.jpg" rel="lightbox[kepsek]" class="grayColor" title="Wakasek">
                    <img data-color="<?php echo base_url() ?>themes/smaihbatam/assets/img/professors/1st.jpg" src="<?php echo base_url() ?>themes/smaihbatam/assets/img/professors/1st.jpg" alt="xxxx" class="imgBorder">
                </a>
                <div>
                    <p style="text-align:justify;">
                        <?php echo $sambutan; ?> 
                    </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column c-67 clearfix" style="padding-right:0px;">
                <div class="box">
                    <h4>Struktur Organisasi Sekolah</h4>
                    <div class="boxInfo">
                        <div>
                        <a href="<?php echo base_url('themes/smaihbatam/struktur.png') ?>" rel="lightbox[struktur]" class="grayColor" title="Struktur Sekolah">
                            <img data-color="<?php echo base_url('themes/smaihbatam/struktur.png') ?>" src="<?php echo base_url('themes/smaihbatam/struktur.png') ?>" style="width:100%;height:100%;">
                        </a>   
                        </div>
                    </div>
                </div>
            </div>
            <div class="searchCourse column c-25 clearfix" style="position:absolute;">
                <p><img src="<?php echo base_url() ?>themes/smaihbatam/assets/img/icons/calendar-512.png" style="margin-top:-11px;margin-left:-10px;width:50px; height:50px;" align="left">&nbsp;&nbsp;&nbsp;Agenda Kegiatan</p>
                <div class="box" style="padding:0px 0px 0px 0px;">
                    <div class="boxInfo" style="padding:0px 0px 0px 0px;"> 
                        <div class="accordion" style="margin-top:-10px;">
                            <?php 
                                if(count($about_agenda)>0){
                                    foreach ($about_agenda as $agenda) {
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
         <div class="clear"></div>

         <div class="event column c-67 clearfix">
            <h3>Staff Pengajar</h3>
            <div class="arrows"></div>
            <div class="cContent clearfix rotator">
                <ul class="slides">
                    <li><a href="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" rel="lightbox[events]" class="grayColor" title="Wakasek" title="kjskajskajsk"><img style="height:80%;width:80%;" data-color="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" src="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" alt="xxxx" class="imgBorder"></a></li>
                    <li><a href="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" rel="lightbox[events]" class="grayColor"><img style="height:80%;width:80%;" data-color="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" src="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" class="imgBorder" alt=""></a></li>
                    <li><a href="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" rel="lightbox[events]" class="grayColor"><img style="height:80%;width:80%;" data-color="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" src="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" alt="xxxxSSS" class="imgBorder"></a></li>
                    <li><a href="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" rel="lightbox[events]" class="grayColor"><img style="height:80%;width:80%;" data-color="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" src="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" class="imgBorder" alt=""></a></li>
                    <li><a href="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" rel="lightbox[events]" class="grayColor"><img style="height:80%;width:80%;" data-color="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" src="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" class="imgBorder" alt=""></a></li>
                    <li><a href="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" rel="lightbox[events]" class="grayColor"><img style="height:80%;width:80%;" data-color="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" src="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" class="imgBorder" alt=""></a></li>
                </ul>
            </div>


</div>