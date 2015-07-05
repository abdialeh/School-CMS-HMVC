<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Form Update Profil Setting
            </header>
            <div class="panel-body">
                <form  action="" method="post"  role="form" class="form-horizontal adminex-form">
                    <?php if(count($get_field)>0){ ?>
                    <header class="panel-heading custom-tab ">
                            <ul class="nav nav-tabs">
                                 <?php 
                                  
                                     foreach ($get_field as $prof_title) {
                                        if($prof_title['setting_code']=='profile_headmaster'){
                                           echo '<li class="active"><a href="#'.$prof_title['setting_code'].'" data-toggle="tab">'.$prof_title['setting_name'].'</a></li>';
                                        }else{
                                           echo '<li><a href="#'.$prof_title['setting_code'].'" data-toggle="tab">'.$prof_title['setting_name'].'</a></li>';
                                        }
                                     }   
                                  ?>
                            </ul>
                    </header>
                    <div class="panel-body">
                        <div class="tab-content">
                            <?php 
                             foreach ($get_field as $prof_tab) {
                                if($prof_tab['setting_code']=='profile_headmaster'){
                                   echo '<div class="tab-pane active" id="'.$prof_tab['setting_code'].'">
                                            <textarea class="col-md-12 wysihtml5 form-control" rows="9" name="'.$prof_tab['setting_code'].'">'.$prof_tab['setting_value'].'</textarea>
                                         </div>';
                                }else{
                                   echo '<div class="tab-pane" id="'.$prof_tab['setting_code'].'">
                                         <textarea class=" col-md-12 wysihtml5 form-control" name="'.$prof_tab['setting_code'].'" rows="9">'.$prof_tab['setting_value'].'</textarea>
                                         </div>';
                                }
                            } ?>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-success" type="submit"> <i class="fa fa-save"></i> Simpan</button>
                            <a style="text-decoration:none;" href="<?php echo current_url(); ?>" class="btn btn-warning" > <i class="fa fa-undo"></i> Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>