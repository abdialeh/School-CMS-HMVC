<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('urutan_otomatis')){
	function urutan_otomatis($nomor){
		// $nomor = "";
		
		if($nomor==0){
			$nomor=$nomor+1;
		}else{
			$nomor=$nomor-1;
		}

	    switch (strlen($nomor))
	    {
	    case 1 : $noUrutan = "0000".$nomor; break;
	    case 2 : $noUrutan = "000".$nomor; break;
	    case 3 : $noUrutan = "00".$nomor; break;
	    case 4 : $noUrutan = "0".$nomor; break;
	    default: $noUrutan = $nomor;   
	    }      
	    return $noUrutan;
	}
}

if(!function_exists('urutanPendaftaran')){
	function urutanPendaftaran(){
	    $querycount="SELECT MAX(pendaftar_id) AS LastID FROM awncms_sekolah_psb_pendaftar";
	    $result=mysql_query($querycount) or die(mysql_error());
	    $row=mysql_fetch_array($result, MYSQL_ASSOC);
	    return $row['LastID'];
	}
}

if(!function_exists('indonesiaCurrencyFormat')){
	function indonesiaCurrencyFormat($nilai){
		$desimal = "2";
		$pemisah1 = ".";
		$pemisah2 = ",";
		$hasil   = "";
		if($nilai!=''){
			$hasil   = "Rp. ".number_format($nilai, $desimal, $pemisah2, $pemisah1)." -";
		}else{
			echo "nilai tidak boleh kosong";
		}

		return $hasil;
	}
}

if(!function_exists('hitung_hari')){
	function hitung_hari($hari1, $hari2){
		$numberDays     = "";
		if($hari1!='' &&  $hari2!=''){
			$startTimeStamp = strtotime($hari1);
			$endTimeStamp 	= strtotime($hari2);
			$timeDiff 		= abs($endTimeStamp - $startTimeStamp);
			$numberDays 	= $timeDiff/86400;  // 86400 seconds in one day
			$numberDays 	= intval($numberDays);
		}

		return $numberDays;
	}
}

if(!function_exists('getPasswordHash')){
	define('K_STRONG_PASSWORD_ENCRYPTION', true);

	function getPasswordHash($password) {
		if (defined('K_STRONG_PASSWORD_ENCRYPTION') AND K_STRONG_PASSWORD_ENCRYPTION) {
			$pswlen = strlen($password);
			$salt = (2 * $pswlen);
			for ($i = 0; $i < $pswlen; ++$i) {
				$salt += (($i + 1) * ord($password[$i]));
			}
			$hash = '$'.$salt.'#'.strrev($password).'$';
			return md5($hash);
		}
		return md5($password);
	}
}

if(!function_exists('F_getRandomOTPkey')){
	function F_getRandomOTPkey() {
		// dictionary
		$dict = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
		$key = '';
		// generate a 16 char random secret key
		for ($i = 0; $i < 16; ++$i) {
			$key .= $dict[(rand(0, 31))];
		}
		return $key;
	}
}
/**
 * Decode a Base32 encoded string.
 * @param $code (string) Base32 code to be decoded.
 * @return Decoded key.
 */

if(!function_exists('F_decodeBase32')){
	function F_decodeBase32($code) {
		// dictionary
		$dict = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
		// remove invalid chars
		$code = preg_replace('/[^'.$dict.']+/', '', $code);
		$n = 0;
		$j = 0;
		$bin = '';
		$len = strlen($code);
		// for each char on code
		for ($c = 0; $c < $len; ++$c) {
			$n = ($n << 5);
			$n = ($n + strpos($dict, $code[$c]));
			$j = ($j + 5);
			if ($j >= 8) {
				$j = ($j - 8);
				$bin .= chr(($n & (0xFF << $j)) >> $j);
			}
		}
		return $bin;
	}
}
/**
 * Get a One Time Password for the specified secret key.
 * @param $otpkey (string) One Time Password secret key.
 * @param $mtime (int) Reference time in microseconds.
 * @return OTP
 */
if(!function_exists('F_getOTP')){
	function F_getOTP($otpkey, $mtime=0) {
		// get binary key
		$binkey = F_decodeBase32($otpkey);
		// get the current timestamp (the one time password changes every 30 seconds)
		if ($mtime == 0) {
			$mtime = microtime(true);
		}
		$time = floor($mtime / 30);
		// convert timestamp into a binary string of 8 bytes
		$bintime = pack('N*', 0).pack('N*', $time);
		// calculate the SHA1 hash
		$hash = hash_hmac('sha1', $bintime, $binkey, true);
		// get offset
		$offset = (ord($hash[19]) & 0xf);
		// one time password
		$otp = ((((ord($hash[($offset + 0)]) & 0x7f) << 24 )
			| ((ord($hash[($offset + 1)]) & 0xff) << 16 )
			| ((ord($hash[($offset + 2)]) & 0xff) << 8 )
			| (ord($hash[($offset + 3)]) & 0xff)) % pow(10, 6));
		return $otp;
	}
}