$(function(){
    
    $('ul.clearfix li a').click(function(e) {
                // e.preventDefault(); // prevent the default action
                // e.stopPropagation(); // stop the click from bubbling
                $(this).closest('ul').find('.selected').removeClass('selected');
                $(this).parent().addClass('selected');
            });

    if($("#frm_register").length > 0){

        var lngthField = document.getElementById("psb_mail_addr");
        var lngth = lngthField.name.length;
        if(lngth>0){
            
            $('#psb_mail_addr').change(function(){
                var email = $('#psb_mail_addr').val();
                if(validateEmail(email) && $(this).val()!=''){
                        
                }else{
                    alert("Format alamat email yang anda masukan kurang benar. Silahkan coba lagi!");
                }
                
            });
        }

        var lngthField1 = document.getElementById("psbRegSubmit");
        var lngth1 = lngthField1.value.length;
        if(lngth1>0){
            $('#psbRegSubmit').prop('disabled',true);

        }

        $('#psb_firstName').keyup(function() {
            if ($(this).val().length<1) {
                $(this).css('border', '1px solid red');
                $(this).css('color', 'red');
                $(this).attr('placeholder', 'Field ini wajib diisi!');

            }else{
                $(this).css('border', '1px solid #E6E6E6');
                $(this).css('color', '#000');
            }    
        });

        $('#psb_phone').keyup(function() {
            if ($(this).val().length<1) {
                $(this).css('border', '1px solid red');
                $(this).css('color', 'red');
                $(this).attr('placeholder', 'Field ini wajib diisi!');

            }else{
                $(this).css('border', '1px solid #E6E6E6');
                $(this).css('color', '#000');
            }    
        });

        $('#psb_mail_addr').keyup(function() {
            if ($(this).val().length<1) {
                $(this).css('border', '1px solid red');
                $(this).css('color', 'red');
                $(this).attr('placeholder', 'Field ini wajib diisi!');

            }else{
                $(this).css('border', '1px solid #E6E6E6');
                $(this).css('color', '#000');
            }    
        });
        
        $('#psb_ref_other').hide();
        var getHiddenName = document.getElementById("hpsb_reg_fee").getAttribute("rel");
        var splitter = getHiddenName.split("|");

        $('#psb_reg_fee').val('Rp. '+tandaPemisahTitik(splitter[1]));
        $('#hpsb_reg_fee').val(splitter[1]);

        $('#psb_ref').keyup(function() {
            if($(this).val()=="4"){
                $('#psb_ref_other').show();
            }else{
                $('#psb_ref_other').hide();
            }
        });

        //Reload Captcha
        $('#reload-captcha').click(function(){
            document.getElementById('captchagbr').src=BASEURL+'psb/captcha?'+Math.random();
            document.getElementById('frm_register').focus();
        });

        $('#psb_cb_ok').click(function() {
            var email = $('#psb_mail_addr').val();
            if(validateEmail(email) && $('#psb_cb_ok').is(':checked') && $('#captcha').val()!='' && $('#psb_firstName').val()!='' && $('#psb_phone').val()!=''){
                $('#psbRegSubmit').prop('disabled',false);
            }else{
                $('#psbRegSubmit').prop('disabled',true);
            }
        });
    }
          
});

    //Google Map Contact
    if($("#pageContact").length > 0){

        $(function() {
        google.maps.event.addDomListener(window, 'load', initialize);
        $('#alamatanda').click(function() {
            $('#alamatanda').select();
        });
    });

    function initialize() {
        var directionsDisplay = new google.maps.DirectionsRenderer();
        var directionsService = new google.maps.DirectionsService();
        var mapOptions = {
            center: new google.maps.LatLng(1.048319, 103.981334),
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.HYBRID,
            disableDefaultUI: true
        };
        var map = new google.maps.Map(document.getElementById("lokasidprd"),
            mapOptions);
        var input = document.getElementById('alamatanda');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var imageyou = 'http://dprd.jabarprov.go.id/assets/images/user_home.png';
        var markeryou = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(1.048319, 103.981334),
            icon: imageyou
        });

        var geudngdprd = new google.maps.InfoWindow();
        var imagedprd = 'http://smaihbatam.sch.id/themes/smaihbatam/logo_kecil.png';
        var myLatLng = new google.maps.LatLng(1.048319, 103.981334);
        var gedungmarker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            icon: imagedprd
        });
        geudngdprd.setContent('<div style="color:#444444;"><strong>SMA Integral Hidayatullah Batam</strong>');
        geudngdprd.open(map, gedungmarker);

        directionsDisplay.setMap(map);

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            markeryou.setVisible(false);
            gedungmarker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            //alert(place.geometry.location);
            markeryou.setPosition(place.geometry.location);
            
            $('#boxlokasiqrcode').css({width:'90px','padding-right':'5px'});

            var start = place.geometry.location;
            var end = new google.maps.LatLng(1.048319, 103.981334);
            var request = {
                origin:start,
                destination:end,
                travelMode: google.maps.TravelMode.DRIVING
            };

            directionsService.route(request, function(result, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(result);
                }
            });

            markeryou.setVisible(true);
            gedungmarker.setVisible(true);

            var url = 'https://www.google.com/maps/dir/'+place.geometry.location.lat()+','+place.geometry.location.lng()+'/-6.900791,103.9813345/data=!3m1!4b1!4m4!4m3!1m0!1m0!3e0';
            var qrurl = 'http://qrfree.kaywa.com/?l=1&s=2&d=https%3A%2F%2Fwww.google.com%2Fmaps%2Fdir%2F';
            qrurl += place.geometry.location.lat()+'%2C'+place.geometry.location.lng();
            qrurl += '%2F-6.900791%2C103.9813345%2Fdata%3D%213m1%214b1%214m4%214m3%211m0%211m0%213e0';
            $('#lokasiqrcode').attr({src:''}).show();
            $('#lokasiqrcode').attr({src:qrurl});
            $('#lokasiqrcodelink').attr({href:url});

        });
    }

    }


function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function validateEmail(email) { 
 var regex_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;
 return regex_email.test(email);
}

//Format Rupiah
    function tandaPemisahTitik(b){
        var _minus = false;
        if (b<0) _minus = true;
        b = b.toString();
        b=b.replace(".","");
        b=b.replace("-","");
        c = "";
        panjang = b.length;
        j = 0;
        for (i = panjang; i > 0; i--){
             j = j + 1;
             if (((j % 3) == 1) && (j != 1)){
               c = b.substr(i-1,1) + "." + c;
             } else {
               c = b.substr(i-1,1) + c;
             }
        }
        if (_minus) c = "-" + c ;
        return c;
    }

    function numbersonly(ini, e){
        if (e.keyCode>=49){
            if(e.keyCode<=57){
            a = ini.value.toString().replace(".","");
            b = a.replace(/[^\d]/g,"");
            b = (b=="0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);
            ini.value = tandaPemisahTitik(b);
            return false;
            }
            else if(e.keyCode<=105){
                if(e.keyCode>=96){
                    //e.keycode = e.keycode - 47;
                    a = ini.value.toString().replace(".","");
                    b = a.replace(/[^\d]/g,"");
                    b = (b=="0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);
                    ini.value = tandaPemisahTitik(b);
                    //alert(e.keycode);
                    return false;
                    }
                else {return false;}
            }
            else {
                return false; }
        }else if (e.keyCode==48){
            a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
            b = a.replace(/[^\d]/g,"");
            if (parseFloat(b)!=0){
                ini.value = tandaPemisahTitik(b);
                return false;
            } else {
                return false;
            }
        }else if (e.keyCode==95){
            a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
            b = a.replace(/[^\d]/g,"");
            if (parseFloat(b)!=0){
                ini.value = tandaPemisahTitik(b);
                return false;
            } else {
                return false;
            }
        }else if (e.keyCode==8 || e.keycode==46){
            a = ini.value.replace(".","");
            b = a.replace(/[^\d]/g,"");
            b = b.substr(0,b.length -1);
            if (tandaPemisahTitik(b)!=""){
                ini.value = tandaPemisahTitik(b);
            } else {
                ini.value = "";
            }
            
            return false;
        } else if (e.keyCode==9){
            return true;
        } else if (e.keyCode==17){
            return true;
        } else {
            //alert (e.keyCode);
            return false;
        }

    }

    function bersihPemisah(ini){
        a = ini.toString().replace(".","");
        //a = a.replace(".","");
        return a;
    }