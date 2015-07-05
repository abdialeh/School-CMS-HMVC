<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Form Update PSB Setting
            </header>
            <div class="panel-body">
                <form  action="" method="post" class="cmxform form-horizontal adminex-form">
                    <?php 
                        if(count($get_field)>0){
                            foreach ($get_field as $psb) {
                                if($psb['setting_code']=='psb_event_year'){
                                    echo '<div class="form-group ">
                                            <label for="username" class="control-label col-lg-3">'.$psb['setting_name'].'</label>
                                            <div class="col-lg-3">
                                                <input type="text" name="'.$psb['setting_code'].'" placeholder="Masukan Tahun Ajaran" class="form-control" value="'.$psb['setting_value'].'">
                                            </div>
                                        </div>';
                                }
                                elseif($psb['setting_code']=='psb_reg_cash'){
                                    $checked = ($psb['setting_value']==1)?'checked':'';
                                    echo '<div class="form-group ">
                                            <label for="username" class="control-label col-lg-3">'.$psb['setting_name'].'</label>
                                            <div class="col-lg-9">
                                                <input type="hidden" id="js-check-change-cash" name="'.$psb['setting_code'].'" value="'.$psb['setting_value'].'">
                                                <div class="slide-toggle">
                                                    <div>
                                                        <input id="'.$psb['setting_code'].'" type="checkbox" class="js-switch js-check-change-cash" '.$checked.'/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                }elseif($psb['setting_code']=='psb_reg_test'){
                                    $checked = ($psb['setting_value']==1)?'checked':'';
                                    echo '<div class="form-group ">
                                            <label for="username" class="control-label col-lg-3">'.$psb['setting_name'].'</label>
                                            <div class="col-lg-9">
                                                <input type="hidden" id="js-check-change-test" name="'.$psb['setting_code'].'" value="'.$psb['setting_value'].'">
                                                <div class="slide-toggle">
                                                    <div>
                                                        <input id="'.$psb['setting_code'].'" type="checkbox" class="js-switch js-check-change-test" '.$checked.'/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                }elseif($psb['setting_code']=='psb_event_start'){
                                    echo '<div class="form-group ">
                                            <label for="username" class="control-label col-lg-3">'.$psb['setting_name'].'</label>
                                            <div class="col-lg-3">
                                                <input type="text" name="'.$psb['setting_code'].'" placeholder="Format : tahun-bulan-tanggal" data-mask="9999-99-99" class="form-control" value="'.$psb['setting_value'].'">
                                            </div>
                                        </div>';
                                }elseif($psb['setting_code']=='psb_event_end'){
                                    echo '<div class="form-group ">
                                            <label for="username" class="control-label col-lg-3">'.$psb['setting_name'].'</label>
                                            <div class="col-lg-3">
                                                <input type="text" name="'.$psb['setting_code'].'" placeholder="Format : tahun-bulan-tanggal" data-mask="9999-99-99" class="form-control"  value="'.$psb['setting_value'].'">
                                            </div>
                                        </div>';
                                }elseif($psb['setting_code']=='psb_reg_price'){
                                    echo '<div class="form-group ">
                                            <label for="username" class="control-label col-lg-3">'.$psb['setting_name'].'</label>
                                            <div class="col-lg-3">
                                                <input type="hidden" id="inputrupiah"  name="'.$psb['setting_code'].'" value="'.$psb['setting_value'].'">
                                                <input type="text" id="input_rupiah" onkeydown="return numbersonly(this, event);" placeholder="Masukan Harga Pendaftaran" class="form-control" value="'.$psb['setting_value'].'">
                                            </div>
                                        </div>';
                                }elseif($psb['setting_code']=='psb_inf_umum_alur'){
                                    echo '<div class="form-group ">
                                            <label for="username" class="control-label col-lg-3">'.$psb['setting_name'].'</label>
                                            <div class="col-lg-9">
                                                <textarea class=" col-md-12 wysihtml5 form-control" name="'.$psb['setting_code'].'" rows="9">'.$psb['setting_value'].'</textarea>
                                            </div>
                                        </div>';
                                }elseif($psb['setting_code']=='psb_inf_umum_syarat'){
                                    echo '<div class="form-group ">
                                            <label for="username" class="control-label col-lg-3">'.$psb['setting_name'].'</label>
                                            <div class="col-lg-9">
                                                <textarea class=" col-md-12 wysihtml5 form-control" name="'.$psb['setting_code'].'" rows="9">'.$psb['setting_value'].'</textarea>
                                            </div>
                                        </div>';
                                }                            
                            }
                        } 
                    ?>
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