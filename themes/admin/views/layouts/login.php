<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="awnLabs">
    <link rel="shortcut icon" href="<?php echo base_url('themes/smaihbatam/favicon.ico'); ?>" type="image/png">

    <title>Login Sistem</title>

    <link href="<?php echo base_url('themes/admin/assets/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('themes/admin/assets/css/style-responsive.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('themes/admin/assets/js/gritter/css/jquery.gritter.css'); ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-body">

<div class="container">

    <form class="form-signin" action="" method="post" id="form-signin">
        <div class="form-signin-heading text-center">
            <h3 class="sign-title">Administrasi Sistem</h3>
            <img src="<?php echo base_url('upload/image/'.$this->init->getSettingVal('gen_logo')); ?>" width="118" height="113" alt=""/>
        </div>

        <?php 
            if($this->session->flashdata('error')!=''){
        ?>        
               <div style="padding:5px 5px;font-size:12px;">
                    <div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div></div>        
        <?php } ?>
        <div class="login-wrap">
            <input name="identity" type="text" class="form-control" placeholder="Masukan nama user anda ..." autofocus value="<?php echo $this->session->flashdata('login_data_username'); ?>">
            <input name="userpass"  type="password" class="form-control" placeholder="Masukan password anda ...">

            <div id="captcha">
                <?php 
                    $placeholder = "Masukan kode dibawah ...";
                    // if($this->session->flashdata('login_empty_captcha')) { 
                    //     $placeholder = "Field ini harus diisi!";
                    // }
                    
                    // if($this->session->flashdata('login_match_captcha')) {
                    //     $placeholder = "Kode tidak sesuai!";
                    // }    
                ?> 
                <input type="text" name="captcha" id="captcha" placeholder="<?php echo $placeholder; ?>" class="form-control">
                <div style="height:50px;text-align:center;"><img id="captchagbr" style="height:50px;width:200px;" src="<?php echo base_url('auth/captcha'); ?>"> <a href="javascript:void(0);" id="reload-captcha">Reload</a></div>
            </div>    
            <button class="btn btn-lg btn-login btn-block" type="submit">
                <i class="fa fa-check"></i>
            </button>

            <!-- <div class="registration">
                Not a member yet?
                <a class="" href="registration.html">
                    Signup
                </a>
            </div> -->
            <label class="checkbox">
                <a href="javascript:;" onclick="window.location='<?php echo base_url(); ?>'" style="text-decoration:none;">&laquo;&nbsp;&nbsp;Kembali ke Beranda </a>
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal" style="text-decoration:none;"> Lupa Password?</a>

                </span>
            </label>

        </div>

        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Form Lupa Password</h4>
                    </div>
                    <div class="modal-body">
                        <p>Masukan alamat email untuk membuat password baru.</p>
                        <input type="text" name="forgot_email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Batal</button>
                        <button class="btn btn-primary" type="button">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->

    </form>

</div>



<!-- Placed js at the end of the document so the pages load faster -->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="<?php echo base_url('themes/admin/assets/js/jquery-1.10.2.min.js'); ?>"></script>
<script src="<?php echo base_url('themes/admin/assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('themes/admin/assets/js/modernizr.min.js'); ?>"></script>
<script src="<?php echo base_url('themes/admin/assets/js/jquery-ui-1.9.2.custom.min.js'); ?>"></script>
<script src="<?php echo base_url('themes/admin/assets/js/jquery-migrate-1.2.1.min.js'); ?>"></script>
<script src="<?php echo base_url('themes/admin/assets/js/jquery.nicescroll.js'); ?>"></script>

<!--gritter script-->
<script src="<?php echo base_url('themes/admin/assets/js/gritter/js/jquery.gritter.js'); ?>"></script>
<script src="<?php echo base_url('themes/admin/assets/js/gritter/js/gritter-init.js'); ?>"></script>

<!--common scripts for all pages-->
<script src="<?php echo base_url('themes/admin/assets/js/scripts.js'); ?>"></script>
<script src="<?php echo base_url('themes/admin/assets/js/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo base_url('themes/admin/assets/js/validation-init.js'); ?>"></script>

<script type="text/javascript">
var BASEURL = "<?php echo base_url();?>";
$(function() {
    //Validasi Email Regex
    $('#email').keyup(function() {
            $('span.help-inline').remove();
            var inputVal = $(this).val();
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            if(!emailReg.test(inputVal)) {
                $('#email').closest('div.control-group').addClass('error');
                $('#email').closest('.control-group').removeClass('success');
                $('#email').after('<span class="help-inline">Format alamat email tidak valid</span>');
            }
        });

//Reload Captcha
$('#reload-captcha').click(function(){
    document.getElementById('captchagbr').src=BASEURL+'auth/captcha?'+Math.random();
    document.getElementById('form-signin').focus();
});
});
</script>

</body>
</html>
