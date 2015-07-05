<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading custom-tab">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#registrasi" data-toggle="tab">
                            <i class="fa fa-file"></i>
                            Registrasi
                        </a>
                    </li>
                    <li class="">
                        <a href="#calon-siswa" data-toggle="tab">
                            <i class="fa fa-user"></i>
                            Pendaftar
                        </a>
                    </li>
                    <li class="">
                        <a href="#pembayaran" data-toggle="tab">
                            <i class="fa fa-money"></i>
                            Pembayaran
                        </a>
                    </li>
                    <span style="float:right;margin-top:11px;"><a class="btn" style="background-color:transparent;color:#000;" href=""><i class="fa fa-edit"></i> &nbsp;&nbsp; Edit Data</a></span>
                </ul>
            </header>
            <div class="panel-body">
                <div class=" form">
                    <form class="cmxform form-horizontal adminex-form" id="updatePsb" method="post" action="" enctype="multipart/form-data">
                    	<div class="tab-content">
                            <div class="tab-pane active" id="registrasi">
                            	<form action="#" class="form-horizontal">

                                    <?php 
                                    if(count($getOneRegister)>0 && count($getOneUser)>0){ ?>
                                    <fieldset>
                                        <legend><h5>Data Akun Sistem</h5></legend>
                                        <div class="col-md-6">    
                                            <ul class="p-info">
                                                <li>
                                                    <div class="title">Nama user</div>
                                                    <div class="desk"><?php echo $getOneUser['user_name'] ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Email</div>
                                                    <div class="desk"><?php echo $getOneUser['user_email'] ?></div>
                                                </li>
                                                <?php if($getOneUser['user_status']==''){ ?>
                                                    <li>
                                                        <div class="title">Status</div>
                                                        <div class="desk"><span class="label label-warning">Belum Aktif</span></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Keterangan</div>
                                                        <div class="desk"><span class="label label-warning">- Baru melakukan Registrasi PPDB SMAIH BATAM <?php echo date('Y'); ?>&nbsp;&nbsp;<br />&nbsp;&nbsp;- Belum melakukan pembayaran pendaftaran</span></div>
                                                    </li>
                                                <?php }elseif($getOneUser['user_status']=='0'){ ?>
                                                    <li>
                                                        <div class="title">Status</div>
                                                        <div class="desk"><span class="label label-warning">Belum Aktif</span></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Keterangan</div>
                                                        <div class="desk"><span class="label label-warning">Belum melakukan test online dan belum dinyatakan lulus</span></div>
                                                    </li>
                                                <?php }elseif($getOneUser['user_status']=='99'){ ?>
                                                    <li>
                                                        <div class="title">Status</div>
                                                        <div class="desk"><span class="label label-danger">Tidak Aktif</span></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Keterangan</div>
                                                        <div class="desk"><span class="label label-danger">Karena dinyatakan tidak lulus seleksi ujian</span></div>
                                                    </li>
                                                <?php }else{ ?>
                                                    <li>
                                                        <div class="title">Status</div>
                                                        <div class="desk"><span class="label label-success">Aktif</span></div>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>    
                                    </fieldset><br /><br />
                                    <fieldset>
                                        <legend><h5>Data Registran</h5></legend>
                                        <div class="col-md-6">    
                                            <ul class="p-info">
                                                <li>
                                                    <div class="title">Nama Registran</div>
                                                    <div class="desk"><?php echo $getOneRegister['psb_reg_firstname'].' '.$getOneRegister['psb_reg_lastname'] ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Kode Registrasi</div>
                                                    <div class="desk"><?php echo $getOneRegister['psb_reg_code'] ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">No. Telp./HP</div>
                                                    <div class="desk"><?php echo $getOneRegister['psb_reg_mobile'] ?></div>
                                                </li>

                                                <?php if($getOneRegister['psb_reg_to_rekening']=='' && $getOneRegister['psb_reg_from_rekening']==''){ ?>
                                                <li>
                                                    <div class="title">Jumlah yang harus bayar</div>
                                                    <div class="desk"><?php echo indonesiaCurrencyFormat($getOneRegister['psb_reg_price_uniq']); ?></div>
                                                </li>
                                                <?php }else{ ?>
                                                <li>
                                                    <div class="title">Jumlah yang telah dibayar</div>
                                                    <div class="desk"><?php echo indonesiaCurrencyFormat($getOneRegister['psb_reg_price_uniq']); ?></div>
                                                </li>
                                                <?php } ?>

                                                <?php if($getOneRegister['psb_reg_status']=='0'){ ?>
                                                    <li>
                                                        <div class="title">Status</div>
                                                        <div class="desk"><span class="label label-warning">Belum Aktif</span></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Keterangan</div>
                                                        <div class="desk"><span class="label label-warning">- Baru melakukan Registrasi pada <?php echo tgl_indo(date('Y-m-d', strtotime($getOneRegister['psb_reg_date_create']))).' '.date('h:i A', strtotime($getOneRegister['psb_reg_date_create'])); ?>&nbsp;&nbsp;<br />&nbsp;&nbsp;- Belum melakukan pembayaran pendaftaran</span></div>
                                                    </li>
                                                <?php }elseif($getOneRegister['psb_reg_status']=='99'){ ?>
                                                    <li>
                                                        <div class="title">Status</div>
                                                        <div class="desk"><span class="label label-danger">Tidak Aktif</span></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Keterangan</div>
                                                        <div class="desk"><span class="label label-danger">Karena dinyatakan tidak lulus seleksi ujian</span></div>
                                                    </li>
                                                <?php }else{ ?>
                                                    <li>
                                                        <div class="title">Status</div>
                                                        <div class="desk"><span class="label label-sukses">Aktif</span></div>
                                                    </li>
                                                <?php } ?>

                                            </ul>
                                        </div>
                                    </fieldset>
                                        
                                    <?php } ?>
                                </form>
                            </div>
                            <div class="tab-pane" id="calon-siswa">
                                <?php if(count($getOneCalonSiswa)>0){ ?>
                                    <div class="col-md-7">    
                                        <ul class="p-info">
                                    <?php if($getOneCalonSiswa['pendaftar_nama_depan'] == '' && $getOneCalonSiswa['pendaftar_nama_belakang'] == '' && $getOneCalonSiswa['pendaftar_status'] == '0'){ ?>
                                        <li>
                                            <div class="title">Status</div>
                                            <div class="desk"><span class="label label-warning">Belum ada data calon siswa</span></div>
                                        </li>
                                        <li>
                                            <div class="title">Keterangan</div>
                                            <div class="desk"><span class="label label-warning">Belum melakukan pembayaran pendaftaran</span></div>
                                        </li>
                                    <?php }else{ ?> 
                                            <fieldset>
                                                <legend><h5>Data Calon Siswa</h5></legend>
                                            
                                                <li>
                                                    <div class="title">No. Pendaftaran</div>
                                                    <div class="desk"><?php echo ($getOneCalonSiswa['pendaftar_nomor']!='')?$getOneCalonSiswa['pendaftar_nomor']:'-'; ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Nama Calon Siswa</div>
                                                    <div class="desk"><?php echo $getOneCalonSiswa['pendaftar_nama_depan'].' '.$getOneCalonSiswa['pendaftar_nama_belakang']; ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Jenis Kelamin</div>
                                                    <div class="desk"><?php echo ($getOneCalonSiswa['pendaftar_jkelamin']!='')?($getOneCalonSiswa['pendaftar_jkelamin']=='L')?'Laki-Laki':'Perempuan':'-'; ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Tempat & Tanggal Lahir</div>
                                                    <div class="desk">
                                                        <?php 
                                                            $pecahTtl = explode(',', $getOneCalonSiswa['pendaftar_ttl']);
                                                            echo ($getOneCalonSiswa['pendaftar_ttl']!='')?$pecahTtl[0].','.tgl_indo($pecahTtl[1]):'-'; 
                                                        ?>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Asal Sekolah</div>
                                                    <div class="desk"><?php echo ($getOneCalonSiswa['pendaftar_asal_sekolah']!='')?$getOneCalonSiswa['pendaftar_asal_sekolah']:'-'; ?> <br />dengan no. peserta UAN <?php echo ($getOneCalonSiswa['pendaftar_nopeserta_unsmp']!='')?$getOneCalonSiswa['pendaftar_nopeserta_unsmp']:'-'; ?></div>
                                                </li>
                                                <li>
                                                    <div class="title">Alamat Lengkap</div>
                                                    <div class="desk"><?php echo ($getOneCalonSiswa['pendaftar_alamat_sekarang']!='')?$getOneCalonSiswa['pendaftar_alamat_sekarang']:'-'; ?></div>
                                                </li>
                                            </fieldset><br /><br />
                                            <fieldset>
                                                <legend><h5>Data Orang Tua Calon Siswa</h5></legend>
                                                <li>
                                                    <div class="title">Nama Ayah</div>
                                                    <div class="desk">
                                                        <?php 
                                                            $pecahDataAyah = explode('|', $getOneCalonSiswa['pendaftar_data_ortu_ayah']);
                                                            echo ($getOneCalonSiswa['pendaftar_data_ortu_ayah']!='')?$pecahDataAyah[0]:'-'; 
                                                        ?>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Telp./HP Ayah</div>
                                                    <div class="desk">
                                                        <?php 
                                                            echo ($getOneCalonSiswa['pendaftar_data_ortu_ayah']!='')?$pecahDataAyah[1]:'-'; 
                                                        ?>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Nama Ibu</div>
                                                    <div class="desk">
                                                        <?php 
                                                            $pecahDataIbu = explode('|', $getOneCalonSiswa['pendaftar_data_ortu_ibu']);
                                                            echo ($getOneCalonSiswa['pendaftar_data_ortu_ibu']!='')?$pecahDataIbu[0]:'-'; 
                                                        ?>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Telp./HP Ibu</div>
                                                    <div class="desk">
                                                        <?php 
                                                            echo ($getOneCalonSiswa['pendaftar_data_ortu_ibu']!='')?$pecahDataIbu[1]:'-'; 
                                                        ?>
                                                    </div>
                                                </li>
                                            </fieldset><br /><br />
                                            <fieldset>
                                                <legend><h5>Data Opini Calon Pendaftar</h5></legend>
                                                Jika diterima di SMA Integral Hidayatullah Batam,
                                                <li>
                                                    <div class="title">Sistem yang diikuti</div>
                                                    <div class="desk">
                                                        <?php 
                                                            $pecahDataSistem = explode('|', $getOneCalonSiswa['pendaftar_opini_sistem_diikuti']);
                                                            echo ($getOneCalonSiswa['pendaftar_opini_sistem_diikuti']!='')?($pecahDataSistem[0]==1)?'Full day school (tidak menginap di Asrama)':'Boarding school (menginap di Asrama)<br /><b>Alasan :</b><br />'.$pecahDataSistem[1]:'-';
                                                        ?>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Jurusan yang diminati</div>
                                                    <div class="desk">
                                                        <?php 
                                                            $pecahDataJurusan = explode('|', $getOneCalonSiswa['pendaftar_opini_jurusan_diminati']);
                                                            echo ($getOneCalonSiswa['pendaftar_opini_jurusan_diminati']!='')?($pecahDataJurusan[0]==1)?'MIA (Matematika dan Ilmu-ilmu Alam)':'IIS (Ilmu-ilmu Sosial)<br /><b>Alasan :</b><br />'.$pecahDataJurusan[1]:'-';
                                                        ?>
                                                    </div>
                                                </li>
                                            </fieldset>    
                                    <?php } ?>
                                        </ul>
                                    </div>
                            	<?php } ?>
                            </div>
                            <div class="tab-pane" id="pembayaran">
                            	
                                <!--body wrapper start-->
                                        <div class="col-sm-12">
                                            <div class="timeline">
                                                <article class="timeline-item alt">
                                                    <div class="text-right">
                                                        <div class="time-show first">
                                                            <a href="#" class="btn btn-primary">Historical</a>
                                                        </div>
                                                    </div>
                                                </article>
                                                <article class="timeline-item alt">
                                                    <div class="timeline-desk">
                                                        <div class="panel">
                                                            <div class="panel-body">
                                                                <span class="arrow-alt"></span>
                                                                <span class="timeline-icon"></span>
                                                                <?php if($getOneRegister['psb_reg_date_create']!=''): ?>
                                                                    <span class="timeline-date"><?php echo date('h:i A', strtotime($getOneRegister['psb_reg_date_create'])); ?></span>
                                                                    <h1 class="red"><?php echo tgl_indo(date('Y-m-d', strtotime($getOneRegister['psb_reg_date_create']))).' '.date('h:i A', strtotime($getOneRegister['psb_reg_date_create'])); ?></h1>
                                                                    <p>Orang Tua/Wali Mendaftar PPDB SMA IH 2015 </p>
                                                                <?php else: ?>
                                                                    <span class="timeline-date">-</span>
                                                                    <h1 class="green">-</h1>
                                                                    <p>-</p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                                <article class="timeline-item alt">
                                                    <div class="timeline-desk">
                                                        <div class="panel">
                                                            <div class="panel-body">
                                                                <span class="arrow-alt"></span>
                                                                <span class="timeline-icon"></span>
                                                                <?php 
                                                                    if($getOneRegister['psb_reg_date_update']!=''): 
                                                                        $pecahUpdate = explode('|', $getOneRegister['psb_reg_date_update']);
                                                                ?>
                                                                    <span class="timeline-date"><?php echo date('h:i A', strtotime($pecahUpdate[0])); ?></span>
                                                                    <h1 class="red"><?php echo tgl_indo(date('Y-m-d', strtotime($pecahUpdate[0]))).' '.date('h:i A', strtotime($pecahUpdate[0])); ?></h1>
                                                                    <p>Orang Tua/Wali Melakukan aktivasi akun dengan mentransfer sejumlah uang kepada pihak sekolah/yayasan untuk biaya pendaftaran.</p>
                                                                <?php else: ?>
                                                                    <span class="timeline-date">-</span>
                                                                    <h1 class="green">-</h1>
                                                                    <p>-</p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                                <article class="timeline-item">
                                                    <div class="timeline-desk">
                                                        <div class="panel">
                                                            <div class="panel-body">
                                                                <span class="arrow"></span>
                                                                <span class="timeline-icon"></span>
                                                                <?php 
                                                                    $pecahUpdate = explode('|', $getOneRegister['psb_reg_date_update']);
                                                                    if(isset($pecahUpdate[1]) && $pecahUpdate[1]!=''): 
                                                                ?>
                                                                    <span class="timeline-date"><?php echo date('h:i A', strtotime($pecahUpdate[1])); ?></span>
                                                                    <h1 class="red"><?php echo tgl_indo(date('Y-m-d', strtotime($pecahUpdate[1]))).' '.date('h:i A', strtotime($pecahUpdate[1])); ?></h1>
                                                                    <p>Pihak sekolah/yayasan mengecek validasi data aktivasi dan jumlah uang yang ditransfer akun pendaftar dengan hasil <span class="light-green">VALID</span></p>
                                                                <?php else: ?>
                                                                    <span class="timeline-date">-</span>
                                                                    <h1 class="green">-</h1>
                                                                    <p>-</p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>
                                <!--body wrapper end-->

                            </div>	
                        </div>	
					</form>    
                </div>
            </div>
        </section>
    </div>
</div>