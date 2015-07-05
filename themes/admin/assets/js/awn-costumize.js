jQuery(document).ready(function(){
	//HTML5 EDITOR
	$('.wysihtml5').wysihtml5();

	//Mulai Notifikasi
	/*Insert*/
	if(notifInsert!=''){
		$.gritter.add({
            title: 'Notifikasi Aplikasi',
            text: notifInsert
        });
	}

	/*Update*/
	if(notifUpdate!=''){
		$.gritter.add({
            title: 'Notifikasi Aplikasi',
            text: notifUpdate
        });
	}

	/*Delete*/
	if(notifDelete!=''){
		$.gritter.add({
            title: 'Notifikasi Aplikasi',
            text: notifDelete
        });
	}

	/*Sukses Login*/
	if(notifLogin!=''){
		$.gritter.add({
            title: 'Notifikasi Aplikasi',
            text: notifLogin
        });
	}	
	//Akhir Notifikasi

	// On change Slide Toggle

      if(($(".js-check-change-cash").length > 0) && ($(".js-check-change-test").length > 0)){
	      var changeCheckboxCash = document.querySelector('.js-check-change-cash');
	      
		      changeCheckboxCash.onchange = function() {
		        var isiCash = changeCheckboxCash.checked;

		        if(isiCash==true){
		        	$('#js-check-change-cash').val('1');
		        }

		        if(isiCash==false){
		        	$('#js-check-change-cash').val('0');
		        }
		      }
		   

		  var changeCheckboxTest = document.querySelector('.js-check-change-test');
	      	
		      changeCheckboxTest.onchange = function() {
		        var isiTest = changeCheckboxTest.checked;

		        if(isiTest==true){
		        	$('#js-check-change-test').val('1');
		        }
		        if(isiTest==false){
		        	$('#js-check-change-test').val('0');
		        }
		      }

	      $('#input_rupiah').val(tandaPemisahTitik($('#inputrupiah').val()));
	      $('#input_rupiah').keyup(function(){
	      	tandaPemisahTitik($(this).val());
	      });

	      $('#input_rupiah').keyup(function(){
	      	$('#inputrupiah').val(bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah(document.getElementById('input_rupiah').value)))));
	      });
	     }
	});

 if(($(".js-check-change-cash").length > 0) && ($(".js-check-change-test").length > 0)){
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
	}

	if($('#addAgenda').length >0 || $('#updateAgenda').length >0){
		function limitText(limitField, limitCount, limitNum) {
			if (limitField.value.length > limitNum) {
					limitField.value = limitField.value.substring(0, limitNum);
				} else if(limitField.value.length>0){
					limitCount.value = limitNum - limitField.value.length;
				}else {
					limitCount.value = limitNum - limitField.value.length;
				}
		}
	}