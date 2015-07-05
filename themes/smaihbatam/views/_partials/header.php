
<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js ie ie8"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->

    <head>

        <meta charset="utf-8">

        <title><?php echo $template['title']; ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">

        <link rel="stylesheet" href="<?php echo base_url('themes/smaihbatam/assets/css/main.css'); ?>">  
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('themes/smaihbatam/logo.png'); ?>" />
        <script type="text/javascript">
        var BASEURL = "<?php echo base_url(); ?>";
        //var sesCaptcha = "<?php echo $this->session->userdata('captcha'); ?>";
        </script>

        <!--[if lt IE 9]>
         <script src="js/html5shiv.js"></script>
        <![endif]-->

    </head>

    <body>

        <!-- SITE CONTENT -->

        <header>
            <div class="parentContainer">
                
                <div id="socialButtons">
                    
                    <a href="http://webmail.smaihbatam.sch.id" class="linked" targe="_blank">
                        <p>Layanan Email</p> 
                        <span>mail </span>
                    </a>
                    <a href="http://elearning.smaihbatam.sch.id" class="linked" targe="_blank">
                        <p>Pembelajaran Online </p> 
                        <span>Moodle</span>
                    </a>
                    <a href="<?php echo base_url('psb/home.html'); ?>" id="facebook">
                        <p>PSB Online </p> 
                        <span>psb online</span>
                    </a>
                </div>
            </div>
            <div>
        
                <div id="menu">
                    <section>
                        <a href="javascript:;" onclick="window.location='<?php echo base_url(); ?>'"><img src="<?php echo base_url('themes/smaihbatam/assets/img/logo.png'); ?>" alt=""></a>
                        <ul class="clearfix">
                        <?php 
                            if(count($modul)>0){
                                foreach ($modul as $modules) {
                                    if($modules['module_link']!=''){
                                        echo '<li>
                                                <a href="'.base_url($modules['module_link']).'">'.$modules['module_name'].'</a>
                                              </li>';
                                    }else{
                                        echo '<li>
                                                <a href="javascript:;">'.$modules['module_name'].'</a>
                                                <ul class="sub-menu">';
                                                if(isset($modules['menus'])){
                                                    foreach($modules['menus'] as $menus) {
                                                        echo '<li><a href="'.base_url($menus['menu_link']).'">'.$menus['menu_name'].'</a></li>';
                                                    }
                                                }else{
                                                  echo '<li style="display:block;background-color:#fff;"><i class=" icon-warning-sign"></i> No Submenu</li>';
                                                }
                                        echo '</ul></li>';
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </section>
                </div>
                <div id="tagline">
                    <section>
                        <a href="#">“ SMA dengan Kurikulum <strong>Berbasis Tauhid</strong> ”</a>
                    </section>
                </div>
                <div id="info">
                    <section>
                        <div>
                            <img src="<?php echo base_url('themes/smaihbatam/assets/img/phone.png'); ?>" alt="">
                            <h2>+62778-364-493</h2>
                            <h4> Kota Batam, Provinsi Kep. Riau, Indonesia.</h4>
                        </div>
                        <span class="element leftElement"></span>
                        <span class="triangle">triangle</span>
                    </section>
                </div>               
            </div>    
        </header>    

        <!-- CONTENT -->

        <div id="contentBk">
            <div id="content" class="clearfix">

            <?php

                if($this->uri->segment(1)=='about'){
                    echo '<div class="topImg clearfix">
                            <img src="'.base_url('themes/smaihbatam/assets/img/headers/header_1.jpg').'" alt="About Us">
                            <p>Tentang Kami</p>
                        </div>';
                }elseif($this->uri->segment(1)=='psb'){
                     echo '<div class="topImg clearfix">
                            <img src="'.base_url('themes/smaihbatam/assets/img/headers/header_1.jpg').'" alt="Penerimaan Siswa Baru">
                            <p>Penerimaan Siswa Baru</p>
                        </div>';
                }elseif($this->uri->segment(1)=='auth'){
                     echo '<div class="topImg clearfix">
                            <img style="width:980px;height:150px;" src="'.base_url('themes/smaihbatam/assets/img/headers/banner_awareofinternalthreat.jpg').'" alt="Login">
                        </div>';
                }
            ?>
