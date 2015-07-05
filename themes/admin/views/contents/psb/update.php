<?php
$tglUpdatePecah = explode('|', $getOneRegister['psb_reg_date_update']);
$fromRekeningPecah   = explode('|', $getOneRegister['psb_reg_from_rekening']);
$lastname       = ($getOneRegister['psb_reg_lastname']!='')?$getOneRegister['psb_reg_lastname']:'-';
// echo "<pre>";echo $tglUpdatePecah[0]; print_r($tglUpdatePecah);die;
?>
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                Verifikasi Data Pendaftaran dan Pembayaran
            </header>
            <div class="panel-body">
                <div class="form">
                    <form class="cmxform form-horizontal adminex-form" id="verifyPpdbForm" method="post" action="">
                        <fieldset>
                            <legend><h4>Data Pendaftar</h4></legend>
                            <div class="form-group ">
                                <label for="tahun_ajar" class="control-label col-lg-2">Tahun Ajar</label>
                                <div class="col-lg-2">
                                <select class="form-control input-sm m-bot15" name="tahun_ajar" id="tahun_ajar">
                                    <option>Pilih Tahun Ajar</option>
                                    <?php 
                                        if(count($listThnAjar)>0){
                                            $curYear  = date('Y');
                                            $nextYear = $curYear+1;
                                            $currThnAjar = $curYear.'/'.$nextYear;

                                            foreach ($listThnAjar as $thnAjar) {
                                                $selected = ($currThnAjar==$thnAjar['thn_ajar_kode'])?'selected':'';
                                                echo '<option value="'.$thnAjar['thn_ajar_id'].'" '.$selected.'>'.$thnAjar['thn_ajar_kode'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="nama_lengkap" class="control-label col-lg-2">Nomor Pendaftaran</label>
                                <div class="col-lg-2">
                                <select class="form-control input-sm m-bot15" name="pendaftar_dari" id="pendaftar_dari">
                                    <option>Pendaftar dari</option>
                                    <option value="01" selected>Dalam Kota</option>
                                    <option value="02">Luar Kota</option>
                                </select>
                                </div>
                                <div class="col-lg-2">
                                    <input class="form-control" type="text" name="no_pendataran_otomatis" id="no_pendataran_otomatis" value="11002579-<?php echo urutan_otomatis(urutanPendaftaran()); ?>">
                                </div>    
                            </div>
                            <div class="form-group ">
                                <label for="nama_lengkap" class="control-label col-lg-2">Nama Lengkap</label>
                                <div class="col-lg-2">
                                    <input class="form-control " id="nama_depan" name="nama_depan" type="text" value="<?php echo $getOneCalonSiswa['pendaftar_nama_depan']; ?>"/>
                                </div>
                                <div class="col-lg-4">
                                    <input class="form-control " id="nama_belakang" name="nama_belakang" type="text"  value="<?php echo ($getOneCalonSiswa['pendaftar_nama_belakang']!='')?$getOneCalonSiswa['pendaftar_nama_belakang']:'-'; ?>"/>
                                </div>
                            </div>
                        </fieldset>
                        <br><br>
                        <fieldset>
                            <legend><h4>Data Pembayaran</h4></legend>
                            <div class="form-group ">
                                <label for="nama_lengkap" class="control-label col-lg-2">Nama Penyetor</label>
                                <div class="col-lg-4">
                                    <input class="form-control " id="nama_lkp_penyetor" name="nama_lkp_penyetor" type="text" value="<?php echo $getOneRegister['psb_reg_firstname'].' '.$lastname; ?>" readonly/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="jumlah_nominal" class="control-label col-lg-2">Nominal</label>
                                <div class="col-lg-3">
                                    <input class="form-control " id="jumlah_nominal" name="jumlah_nominal" type="text" readonly value="<?php echo indonesiaCurrencyFormat($getOneRegister['psb_reg_price_uniq']); ?>"/>
                                    <input  id="jumlah_nominalh" name="jumlah_nominalh" type="hidden" value="<?php echo $getOneRegister['psb_reg_price_uniq']; ?>"/>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="no_rek_from" class="control-label col-lg-2">Info Rek. Penyetor</label>
                                <div class="col-lg-2">
                                    <input class="form-control " id="no_rek_from" name="no_rek_from" type="text" readonly value="<?php echo $fromRekeningPecah[0]; ?>"/>
                                </div>

                                <div class="col-lg-4">
                                    <div class="input-group m-bot15">
                                        <span class="input-group-addon">A.N</span>
                                        <input type="text" class="form-control" id="an_norek_from" name="an_norek_from" readonly value="<?php echo $fromRekeningPecah[1]; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="no_rek_from" class="control-label col-lg-2"></label>
                                <div class="col-lg-10">
                                    <textarea cols="60" rows="5"><?php echo $fromRekeningPecah[2]; ?></textarea>
                                </div>   
                            </div>

                            <div class="form-group ">
                                <label for="tgl_transfer_from" class="control-label col-lg-2"></label>
                                <div class="col-lg-6">
                                    <div id="gallery" class="media-gal">
                                        <div class="images item " >
                                            <a href="#zoomGambar" data-toggle="modal">
                                                <img src="<?php echo base_url('upload/file/dokumen/bukti_transfer/'.$getOneRegister['psb_reg_file_bukti_transfer']); ?>" alt="" />
                                            </a>
                                            <p>Bukti Transfer</p>
                                        </div>
                                    </div>
                                </div>    
                            </div>    
                            <div class="form-group ">
                                <label for="tgl_transfer_from" class="control-label col-lg-2">Tanggal Transfer</label>
                                <div class="col-lg-3">
                                    <input class="form-control " id="tgl_transfer_from" name="tgl_transfer_from" type="text" value="<?php echo  tgl_indo(date('Y-m-d', strtotime($tglUpdatePecah[0]))).' '.date('H:i A', strtotime($tglUpdatePecah[0])); ?>" readonly/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status_verify" class="control-label col-lg-2">Status Pembayaran</label>
                                <div class="col-lg-10 icheck">
                                    <div class="square-green">
                                        <?php
                                            $arrVerify = array('1'=>'Not Verified', '2'=>'Verified');

                                            foreach ($arrVerify as $key => $value) {
                                                $checked = ($getOneRegister['psb_reg_status']!='0' && $getOneRegister['psb_reg_status']==$key)?'checked':'';
                                                echo '<div class="radio ">
                                                        <input tabindex="3" type="radio" value="'.$key.'"  name="paymentStatus" '.$checked.'>
                                                        <label>'.$value.'</label>
                                                      </div>';
                                            }
                                        ?>
                                        <!-- <div class="radio ">
                                            <input tabindex="3" type="radio"  name="paymentStatus">
                                            <label>Verified </label>
                                        </div>
                                        <div class="radio ">
                                            <input tabindex="3" type="radio"  name="paymentStatus">
                                            <label>Not Verified </label>
                                        </div> -->
                                    </div>
                                </div>    
                            </div>
                        </fieldset>
                        <br><br>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-success" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                <a href="http://ci.awnlabs.dev/cihmvc/psb/admin/list" class="btn btn-warning" type="reset"><i class="fa fa-undo"></i>&nbsp;&nbsp;Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="modal fade" id="zoomGambar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Perbesar Gambar</h4>
            </div>

            <div class="modal-body row">
                <img src="<?php echo base_url('upload/file/dokumen/bukti_transfer/'.$getOneRegister['psb_reg_file_bukti_transfer']); ?>" alt="" style="width:99%;height:99%;"/>
            </div>

        </div>
    </div>
</div>