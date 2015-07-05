                <div id="homeSlider" class="clearfix flexslider">

                    <div class="thumbs"></div>

                    <ul class="slides">
                        <li data-thumb="<?php echo base_url() ?>themes/smaihbatam/assets/img/slider/thumb_1.jpg"><img src="<?php echo base_url() ?>themes/smaihbatam/assets/img/slider/1.jpg" alt="Juara Cerdas Cermat"></li>
                        <li data-thumb="<?php echo base_url() ?>themes/smaihbatam/assets/img/slider/thumb_2.jpg"><img src="<?php echo base_url() ?>themes/smaihbatam/assets/img/slider/2.jpg" alt=""></li>
                    </ul>

                    <ul class="captions">
                        <li>
                            <h3>Juara <strong>Cerdas Cermat</strong></h3>
                            <p>Perjuangan para mujahidah muda kita di babak final lomba cerdas cermat tingkat SLTA se-kota Batam.</p>
                        </li>
                        <li>
                            <h3>Tasyakuran, <em>Pelepasan</em> siswa & siswi SMAIH</h3>
                            <p>Barokalloh ananda semua, semua lulus 100%</p>
                        </li>
                    </ul>

                </div>

                <div class="wrapper">

                    <div class="welcome column c-67 clearfix">
                        <h3>Sambutan Kepala Sekolah</h3>
                        <div class="cContent clearfix">
                           <img class="imgBorder" src="<?php echo base_url() ?>themes/smaihbatam/assets/img/professors/1st.jpg" title="Kepala Sekolah">
                            <div>
                                <p style="text-align:justify;">
                                   <?php echo word_limiter($sambutan, 45); ?> 
                                <a href="<?php echo base_url('about/kepsek.html'); ?>"> Selengkapnya</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="searchCourse searchCourseHome column c-33 clearfix">
                        <p><img src="<?php echo base_url() ?>themes/smaihbatam/assets/img/icons/calendar-512.png" style="margin-top:-11px;margin-left:-10px;width:50px; height:50px;" align="left">&nbsp;&nbsp;&nbsp;Agenda Kegiatan</p>

                        <div class="box" style="padding:0px 0px 0px 0px;">
                            <div class="boxInfo" style="padding:0px 0px 0px 0px;"> 
                                <div class="accordion" style="margin-top:-10px;">
                                    
                                        <?php 
                                            if(count($agenda_home)>0){
                                                foreach ($agenda_home as $agenda) {
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

                    <div class="tour column c-33 clearfix">
                        <h3>Fasilitas Kami</h3>
                        <div class="arrows"></div>
                        <div class="cContent clearfix rotator">
                            <ul class="slides">
                              <li>
                                <a href="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" rel="lightbox[facility]" class="grayColor"><img data-color="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" style="width:100%;height:100%;" src="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/tenaga_pendidik.png') ?>" class="imgBorder"></a>
                              </li>
                              <li>
                                <a href="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/gedung_mesjid.png') ?>" rel="lightbox[facility]" class="grayColor"><img data-color="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/gedung_mesjid.png') ?>" style="width:100%;height:100%;" src="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/gedung_mesjid.png') ?>" class="imgBorder"></a>
                              </li>
                              <li>
                                <a href="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/lab_komputer.png') ?>" rel="lightbox[facility]" class="grayColor"><img data-color="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/lab_komputer.png') ?>" style="width:100%;height:100%;" src="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/lab_komputer.png') ?>" class="imgBorder"></a>
                              </li>
                              <li>
                                <a href="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/lapangan_sekolah.png') ?>" rel="lightbox[facility]" class="grayColor"><img data-color="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/lapangan_sekolah.png') ?>" style="width:100%;height:100%;" src="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/lapangan_sekolah.png') ?>" class="imgBorder"></a>
                              </li>
                              <li>
                                <a href="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/perpustakaan.png') ?>" rel="lightbox[facility]" class="grayColor"><img data-color="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/perpustakaan.png') ?>" style="width:100%;height:100%;" src="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/perpustakaan.png') ?>" class="imgBorder"></a>
                              </li>
                              <li>
                                <a href="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/kantin_sekolah.png') ?>" rel="lightbox[facility]" class="grayColor"><img data-color="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/kantin_sekolah.png') ?>" style="width:100%;height:100%;" src="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/kantin_sekolah.png') ?>" class="imgBorder"></a>
                              </li>
                              <li>
                                <a href="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/ekstrakurikuler.png') ?>" rel="lightbox[facility]" class="grayColor"><img data-color="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/ekstrakurikuler.png') ?>" style="width:100%;height:100%;" src="<?php echo base_url('themes/smaihbatam/assets/img/fasilitas/ekstrakurikuler.png') ?>" class="imgBorder"></a>
                              </li>
                            </ul>
                        </div>    
                    </div>

                    <div class="news column c-33 clearfix">
                        <h3>Update News</h3>
                        <div class="arrows"></div>
                        <div class="cContent clearfix rotator">
                            <ul class="slides">
                                <li>
                                    <div class="post">
                                        <img src="<?php echo base_url() ?>themes/smaihbatam/assets/img/other/news.png" alt="">
                                        <div class="info">
                                            <a href="#"><h5>Admissions open for 2012</h5></a>
                                            <span>Posted by : admin on 07 Jan 2012</span>
                                            <p>Lorem ipsum dolor sit amet eiusmod tempor labore..</p>
                                        </div>
                                    </div>
                                        <div class="post">
                                        <img src="<?php echo base_url() ?>themes/smaihbatam/assets/img/other/news.png" alt="">
                                        <div class="info">
                                            <a href="#"><h5>Admissions open for 2012</h5></a>
                                            <span>Posted by : admin on 07 Jan 2012</span>
                                            <p>Lorem ipsum dolor sit amet eiusmod tempor labore..</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="post">
                                        <img src="<?php echo base_url() ?>themes/smaihbatam/assets/img/other/news.png" alt="">
                                        <div class="info">
                                            <a href="#"><h5>Admissions open for 2012</h5></a>
                                           <span>Posted by : admin on 07 Jan 2012</span>
                                            <p>Lorem ipsum dolor sit amet eiusmod tempor labore..</p>
                                        </div>
                                    </div>
                                        <div class="post">
                                        <img src="<?php echo base_url() ?>themes/smaihbatam/assets/img/other/news.png" alt="">
                                        <div class="info">
                                            <a href="#"><h5>Admissions open for 2012</h5></a>
                                            <span>Posted by : admin on 07 Jan 2012</span>
                                            <p>Lorem ipsum dolor sit amet eiusmod tempor labore..</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="links column c-33 clearfix">
                        <h3>Link Terkait</h3>
                        <ul class="cContent clearfix">
                            <li><a href="http://www.kemdiknas.go.id/kemdikbud/" target="_blank">Kementrian Pendidikan & Kebudayaan RI</a></li>
                            <li><a href="http://www.kemenag.go.id" target="_blank">Kementrian Agama RI</a></li>
                            <li><a href="http://www.kepriprov.go.id/home/" target="_blank">Pemda Kepulauan Riau</a></li>
                            <li><a href="http://128.199.253.143:8163/" target="_blank">Dinas Pendidikan Kota Batam</a></li>
                        </ul>
                    </div>

                    <div class="clear"></div>

                    <div class="event column c-67 clearfix">
                        <h3>Galeri Kegiatan</h3>
                        <div class="arrows"></div>
                        <div class="cContent clearfix rotator">
                            <ul class="slides">
                                <li><a href="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e1_large.jpg" rel="lightbox[events]" class="grayColor"><img data-color="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e1_large_gallery.jpg" src="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e1_gray.jpg" alt="xxxx" class="imgBorder"></a></li>
                                <li><a href="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e2_large.jpg" rel="lightbox[events]" class="grayColor"><img data-color="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e2_large_gallery.jpg" src="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e2_gray.jpg" class="imgBorder" alt=""></a></li>
                                <li><a href="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e3_large.jpg" rel="lightbox[events]" class="grayColor"><img data-color="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e3_large_gallery.jpg" src="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e3_gray.jpg" alt="xxxxSSS" class="imgBorder"></a></li>
                                <li><a href="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e4_large.jpg" rel="lightbox[events]" class="grayColor"><img data-color="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e4_large_gallery.jpg" src="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e4_gray.jpg" class="imgBorder" alt=""></a></li>
                                <li><a href="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e5_large.jpg" rel="lightbox[events]" class="grayColor"><img data-color="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e5_large_gallery.jpg" src="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e5_gray.jpg" class="imgBorder" alt=""></a></li>
                                <li><a href="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e6_large.jpg" rel="lightbox[events]" class="grayColor"><img data-color="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e6_large_gallery.jpg" src="<?php echo base_url() ?>themes/smaihbatam/assets/img/events/e6_gray.jpg" class="imgBorder" alt=""></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="featured column c-33 clearfix">
                        <h3>Yang Berulang Tahun</h3>
                        <div class="cContent">
                            <img class="imgBorder" src="<?php echo base_url() ?>themes/smaihbatam/assets/img/professors/1st.jpg" alt="">
                            <div>
                                <h5>Jason Wills</h5>
                                <p>Selamat Ulang Tahun yang ke-43</p>
                                <a href="#">Berikan Ucapan</a>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>