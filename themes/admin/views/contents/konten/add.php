<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Agenda
                <span class="tools pull-right">
                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                 </span>
            </header>
            <div class="panel-body">
                 <div class=" form">
                    <form class="cmxform form-horizontal adminex-form" id="addContent" method="post" action="">
                        <div class="form-group ">
                            <label for="content_type" class="control-label col-lg-2">Tipe </label>
                            <div class="icheck col-sm-6">
                                <div class="square-green single-row">
                                    <?php 
                                    if(count($ContentType)>0){
                                    foreach ($ContentType as $type) {
                                        echo '<div class="radio ">
                                        <input tabindex="3" type="radio"  name="content_type" id="content_type" value="'.$type['type_id'].'">
                                        <label>'.ucfirst($type['type_name']).'</label>
                                        </div>';
                                    }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>   
                        <div class="form-group ">
                            <label for="agenda_nama" class="control-label col-lg-2">Nama/Judul</label>
                            <div class="col-lg-6">
                                <input class=" form-control" id="agenda_nama" name="agenda_nama" minlength="5" type="text" required placeholder="Ketik nama agenda ..."/>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="agenda_tempat" class="control-label col-lg-2">Tempat</label>
                            <div class="col-lg-6">
                                <input class=" form-control" id="agenda_tempat" name="agenda_tempat" minlength="5" type="text" required placeholder="Ketik tempat agenda ..."/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Waktu</label>
                            <div class="col-md-4">
                                <div data-date="<?php echo date('Y-m-d H:i:s')?>" class="input-group date form_datetime-meridian">
                                    <input type="text" class="form-control" readonly="" size="16" id="agenda_datetime" name="agenda_datetime" required>
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
onKeyUp="limitText(this.form.agenda_keterangan,this.form.countdown,200);"></textarea>
                            <span class="label label-info" style="width:100%;"> maksimal 200 karakter. Anda mempunyai &nbsp;&nbsp;<input style="width:30px;text-align:center;border:0px;" type="text" name="countdown" value="200" readonly> &nbsp;&nbsp;karakter lagi </span>    
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-success" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                <a href="<?php echo base_url('agenda/admin/list'); ?>" class="btn btn-warning" type="reset"><i class="fa fa-undo"></i>&nbsp;&nbsp;Batal</a>
                            </div>
                        </div>
                    </form>    
                </div>
        </section>
    </div>
</div>