</div>

        <!-- FOOTER -->

        <footer>

            <div class="stripe clearfix">
                <div class="twitter">
                    <img src="<?php echo base_url('themes/smaihbatam/assets/img/twitter.png'); ?>" title="Pengumuman Sekolah">
                    <ul id="js-pengumuman" class="js-hidden">
                        <li class="news-item">
                            <div class="post clearfix">
                                <div class="info" style=" margin-left:-15px;font-size:12px;color:#fff;border:0px solid #fff;width:119%;height:60px;margin-top:10px;">
                                    <p style="width:100%;"><span>Posted on 07 jan 2012</span> - <a href="#">Lorem ipsum dolor sit amet set Lorem ipsum dolor sit amet set Lorem ipsum ipsum dolor sit amet set Lorem ipsum</a></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    
                </div>
                </div>
            </div>

            <!-- <div class="mail">
                <div>
                    <div class="mailInfo">
                        <div>
                            <h4>Langganan Informasi</h4>
                            <input id="mailInput" type="text" />
                            <input id="mailSubmit" type="submit" value="Go"/>
                        </div>
                    </div>
                    <span class="triangle">triangle</span>
                    <span class="element rightElement"></span>
                </div>
            </div>  -->

            <div id="footerContent" >
                <section>
                    <div class="clearfix">

                        <div class="links column c-30 clearfix ">
                            <h3>Blog Terbaru</h3>
                            <ul>
                                <li><a href="#">After Graduation</a></li>
                                <li><a href="#">Continuing Education</a></li>
                                <li><a href="#">Introducing Genetic</a></li>
                                <li><a href="#">Celebrating Founder's Day</a></li>
                                <li><a href="#">Celebrating Founder's Day</a></li>
                            </ul>
                        </div>

                        <div class="news column c-40 clearfix">
                            <h3>Testimoni Anda</h3>
                            <?php 
                                $mailgravatar       = $this->session->userdata['sessionData']['userEmail'];
                                $gravatar_profile   = $this->gravatar->get_profile_data($mailgravatar);
                                $getGravatar        = $this->gravatar->get($mailgravatar);
                                
                                $avatar             = "";
                                if(isset($gravatar_profile['id'])){
                                    $avatar         = $gravatar_profile['thumbnailUrl'];
                                }else{

                                    $avatar         = $getGravatar;
                                }
                            ?>
                            <div class="clearfix">
                                <ul id="js-news" class="js-hidden">
                                    <li class="news-item">
                                        <div class="post clearfix">
                                            <img src="img/other/news.png" alt="">
                                            <div class="info">
                                                <a href="#"><h5>Admissions open for 2012</h5></a>
                                                <span>Posted on 07 jan 2012</span>
                                                <p>Lorem ipsum dolor sit amet set..</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="news-item">
                                        <div class="post clearfix ">
                                            <img src="img/other/news.png" alt="">
                                            <div class="info">
                                                <a href="#"><h5>Admissions open for 2012</h5></a>
                                                <span>Posted on 07 jan 2012</span>
                                                <p>Lorem ipsum dolor sit amet set..</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="contact column c-30 clearfix ">
                            <h3>Buku Tamu / Testimonial</h3>
                            <input name="nama" id="name" type="text" placeholder="Nama anda"/>
                            <input name="email" id="mail" type="text" placeholder="Email anda"/>
                            <textarea name="pesan" id="message" placeholder="Pesan anda"></textarea>
                            
                            <input id="submit" class="submit" type="submit" value="Kirim"/>
                        </div>
                    </div>
                    <div id="bottomFooter">
                        <p>&copy;  <?php echo $this->init->getSettingVal('gen_meta_author').' - '.date('Y'); ?>. All Rights Reserved</p>
                        <div>
                            <ul id="social" >
                                <li><a href="https://twitter.com/SMAIHBatam" id="finalTwitter">twitter</a></li>
                                <li><a href="https://www.facebook.com/smaih.batam" id="finalFacebook">facebook</a></li>
                                <!-- <li><a href="#" id="finalFlickr">flickr</a></li> -->
                                <li><a href="http://smaihbatam.sch.id/rss" id="finalRss">rss</a></li>
                            </ul>
                            <!-- <ul id="legal">
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms &amp; Condition</a></li>
                            </ul> -->
                        </div>
                    </div>
                </section>
            </div>
        </footer>

        <!-- END SITE CONTENT -->

        <script src="<?php echo base_url('themes/smaihbatam/assets/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('themes/smaihbatam/assets/js/jquery.flexslider-min.js'); ?>"></script>
        <script src="<?php echo base_url('themes/smaihbatam/assets/js/lightbox.js'); ?>"></script>
        <script src="<?php echo base_url('themes/smaihbatam/assets/js/scripts.js'); ?>"></script>
        <script src="<?php echo base_url('themes/smaihbatam/assets/js/awn.customize.js'); ?>"></script>
        <script src="<?php echo base_url('themes/smaihbatam/assets/js/jquery.ticker.js'); ?>"></script>
        </body>

        <script type="text/javascript">
            $(function () {
                $('#js-pengumuman').ticker({
                    titleText: ' ',
                    controls: false,        // Whether or not to show the jQuery News Ticker controls
                    displayType: 'reveal', // Animation type - current options are 'reveal' or 'fade'
                    direction: 'ltr',       // Ticker direction - current options are 'ltr' or 'rtl'
                    fadeInSpeed: 600,
                    fadeOutSpeed: 300
                });
                $('#js-news').ticker({
                    titleText: ' ',
                    controls: false,        // Whether or not to show the jQuery News Ticker controls
                    displayType: 'fade', // Animation type - current options are 'reveal' or 'fade'
                    direction: 'ltr',       // Ticker direction - current options are 'ltr' or 'rtl'
                    fadeInSpeed: 600,
                    fadeOutSpeed: 300
                });
            });
        </script>
</html>