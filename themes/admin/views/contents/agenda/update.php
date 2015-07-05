<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading custom-tab">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#data-kegiatan" data-toggle="tab">
                            <i class="fa fa-calendar-o"></i>
                            Data Kegiatan
                        </a>
                    </li>
                    <li class="">
                        <a href="#foto-kegiatan" data-toggle="tab">
                            <i class="fa fa-picture-o"></i>
                            Foto Kegiatan
                        </a>
                    </li>
                </ul>
            </header>
            <div class="panel-body">
                <div class=" form">
                    <form class="cmxform form-horizontal adminex-form" id="updateAgenda" method="post" action="" enctype="multipart/form-data">
                        <div class="tab-content">
                            <div class="tab-pane active" id="data-kegiatan">
                                <div class="form-group ">
                                    <label for="agenda_nama" class="control-label col-lg-2">Nama/Judul</label>
                                    <div class="col-lg-6">
                                        <input class=" form-control" id="agenda_nama" name="agenda_nama" minlength="5" type="text" placeholder="Ketik nama agenda ..." value="<?php echo $getOneData['agenda_title']; ?>"/>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="agenda_tempat" class="control-label col-lg-2">Tempat</label>
                                    <div class="col-lg-6">
                                        <input class=" form-control" id="agenda_tempat" name="agenda_tempat" minlength="5" type="text" placeholder="Ketik tempat agenda ..." value="<?php echo $getOneData['agenda_place']; ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Waktu</label>
                                    <div class="col-md-4">
                                        <div data-date="<?php echo date('Y-m-d H:i:s A')?>" class="input-group date form_datetime-meridian">
                                            <input type="text" class="form-control" readonly="" size="16" id="agenda_datetime" name="agenda_datetime" value="<?php echo date('Y-m-d H:i A', strtotime($getOneData['agenda_datetime'])); ?>" >
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary date-reset"><i class="fa fa-times"></i></button>
                                                <button type="button" class="btn btn-success date-set"><i class="fa fa-calendar"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="agenda_keterangan" class="control-label col-lg-2">Keterangan</label>
                                    <div class="col-lg-5">
                                        <textarea class="form-control" rows="5" id="agenda_keterangan" name="agenda_keterangan" placeholder="Ketik keterangan agenda" onKeyDown="limitText(this.form.agenda_keterangan,this.form.countdown,200);" 
                                        onKeyUp="limitText(this.form.agenda_keterangan,this.form.countdown,200);"><?php echo $getOneData['agenda_desc']; ?></textarea>
                                        <span class="label label-info" style="width:100%;"> maksimal 200 karakter. Anda mempunyai &nbsp;&nbsp;<input style="width:30px;text-align:center;border:0px;" type="text" name="countdown" value="200" readonly> &nbsp;&nbsp;karakter lagi </span>    
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="agenda_status" class="control-label col-lg-2">Status</label>
                                    <div class="icheck col-sm-6">
                                        <div class="square-green single-row">
                                            <?php 
                                            $arrStat =  array('1' => 'Aktif', '0' => 'Tidak Aktif'); 
                                            foreach ($arrStat as $key => $value) {
                                                $checked = ($getOneData['agenda_status']==$key)?'checked':'';
                                                echo '<div class="radio ">
                                                <input tabindex="3" type="radio"  name="agenda_status" id="agenda_status" value="'.$key.'" '.$checked.'>
                                                <label>'.$value.'</label>
                                                </div>';
                                            }
                                            ?>
                                            
                                        </div>
                                    </div>
                                </div>   

                            </div>
                            <div class="tab-pane " id="foto-kegiatan">
                                <?php 
                                $d              = new DateTime($getOneData['agenda_datetime']);
                                    $timestamp      = $d->getTimestamp(); // Unix timestamp
                                    $agendaDate     = $d->format('Y-m-d'); // 2003-10-16

                                    if(date('Y-m-d') > $agendaDate){
                                        ?>
                                        <?php if(count($getPhotos)>0){ ?>
                                        <div class="form-group">
                                            &nbsp;&nbsp;&nbsp;<button class="btn btn-success" type="button" id="add-row-gbr"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Gambar</button>
                                            <button class="btn btn-danger" type="button" id="remove-row-gbr"><i class="fa fa-minus"></i>&nbsp;&nbsp;Hapus yang terpilih</button>
                                        </div> 

                                        <?php 
                                        $i = 1;
                                        foreach ($getPhotos as $foto) {
                                            $checked = ($foto==1)?'checked':'-';
                                            echo '<div class="form-group" data-div-id="'.$i.'">
                                            <div class="icheck col-sm-1">
                                            <div class="square-green single-row">
                                            <div class="checkbox ">
                                            <input type="checkbox" id="data-check" value="1">
                                            </div>
                                            </div>
                                            </div>
                                            <label class="control-label col-md-2">
                                            Gambar <span> '.$i.'</span>
                                            </label>
                                            <div class="controls col-md-1">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <span class="btn btn-default btn-file">
                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Pilih file</span>
                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Ganti</span>
                                            <input type="file" class="default" name="agenda_img[]" value="'.$foto['agenda_image_cover'].'"/>
                                            </span>
                                            <span class="fileupload-preview" style="margin-left:5px;"></span>
                                            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                            </div>
                                            </div>
                                            <div class="icheck col-sm-2">
                                            <div class="square-green single-row">
                                            <div class="radio ">
                                            <input tabindex="3" type="radio"  name="is_cover_album[]" id="is_cover_album" value="1" '.$checked.'>
                                            <label>Cover Album </label>
                                            </div>
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                            <input class=" form-control" id="keterangan_gbr" name="keterangan_gbr[]" type="text" placeholder="Ketik keterangan gambar ..." value="'.$foto['agenda_image_desc'].'" />
                                            </div>    
                                            </div> ';
                                            $i++;   
                                        }?>
                                        <?php }else{ ?>
                                        <div class="form-group" data-div-id="1">
                                            <label class="control-label col-md-2">
                                                Gambar Kegiatan
                                            </label>
                                            <div class="controls col-md-10">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Pilih file</span>
                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Ganti</span>
                                                        <input type="file" class="default" name="agenda_img[]" multiple=""/>
                                                    </span>
                                                    <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } } else{ echo "Foto belum bisa di tambahakan karena agenda belum dilaksanakan."; } ?>
                                    </div>

                                </div> 
                                <br>         
                                <br>         
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                        <a href="<?php echo base_url('agenda/admin/list'); ?>" class="btn btn-warning" type="reset"><i class="fa fa-undo"></i>&nbsp;&nbsp;Batal</a>
                                    </div>
                                </div>
                            </form>    
                        </div>
                    </div>
                </section>
            </div>
        </div>