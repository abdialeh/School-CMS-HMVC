<div class="wrapper" style="margin-top:-35px;">
  <div id="pageContact" class="column c-67 clearfix" style="padding-right:0px;">
    <div class="box">
      <h4>Kontak Kami</h4>
      <div class="boxInfo" style="padding:0px;">
        <table width="100%" style="background:#f5f5f5;">
          <tbody><tr>
            <td height="90px" valign="bottom" style="padding:5px;">
              <h5><b>Ke Kampus SMA IH BATAM?</b> Masukkan Lokasi Anda:<br></h5>
              
              <input id="alamatanda" type="text" style="border-radius:0px;padding:5px;width:95%;" placeholder="Masukan lokasi anda sekarang" autocomplete="off">
            </td>
            <td id="boxlokasiqrcode" width="0px;" style="padding-left:0px;padding-top:10px;">
              <a id="lokasiqrcodelink" href="javascript:void(0);" target="_blank"><img id="lokasiqrcode" style="display:none;" src="" width="95px"></a>
            </td>
          </tr>
        </tbody></table>  

        <div style="overflow:hidden;height:250px;border:3px solid #eeeeee;">
          <div id="lokasidprd" style="height:257px;"></div>
        </div>   
      </div>
    </div>
  </div>

  <div class="column c-25 clearfix" style="position:absolute;">
    <div class="box" style="padding:0px 0px 0px 0px;">
      <h4>Alamat Kami</h4>
      <div class="boxInfo" style="padding:0px 0px 0px 0px;"> 
        <p style="text-align:left; margin-left:5px;margin-right:3px;margin-top:7px;margin-bottom:7px;">

          <?php 
          echo $fulladdress.'<br />'.$phone.','.$email;
          ?>
        </p>
      </div>
    </div>
  </div>
</div>


</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>