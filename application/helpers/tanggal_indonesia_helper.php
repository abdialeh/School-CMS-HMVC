<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('tgl_indo'))
{
	function tgl_indo($tgl)
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal.' '.$bulan.' '.$tahun;
	}
}
   
if ( ! function_exists('tgl_indo_singkat'))
{
	function tgl_indo_singkat($tgls)
	{
		$ubah = gmdate($tgls, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulans = bln_singkat($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal.' '.$bulan;
	}
}

if ( ! function_exists('bulan'))
{
	function bulan($bln)
	{
		switch ($bln)
		{
			case 1:
			return "Januari";
			break;
			case 2:  
			return "Februari";
			break;
			case 3:
			return "Maret";
			break;
			case 4:
			return "April";
			break;
			case 5:
			return "Mei";
			break;
			case 6:
			return "Juni";
			break;
			case 7:
			return "Juli";
			break;
			case 8:
			return "Agustus";
			break;
			case 9:
			return "September";
			break;
			case 10:
			return "Oktober";
			break;
			case 11:
			return "November";
			break;
			case 12:
			return "Desember";
			break;
		}
	}
}

if(! function_exists('bln_singkat')){
	function bln_singkat($blns){
		switch ($blns)
		{
			case 1:
			return "Jan";
			break;
			case 2:
			return "Feb";
			break;
			case 3:
			return "Mar";
			break;
			case 4:
			return "Apr";
			break;
			case 5:
			return "Mei";
			break;
			case 6:
			return "Jun";
			break;
			case 7:
			return "Jul";
			break;
			case 8:
			return "Agust";
			break;
			case 9:
			return "Sept";
			break;
			case 10:
			return "Okt";
			break;
			case 11:
			return "Nov";
			break;
			case 12:
			return "Des";
			break;
		}	
	}
}

if ( ! function_exists('nama_hari'))
{
	function nama_hari($tanggal)
	{
		$ubah = gmdate($tanggal, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tgl = $pecah[2];
		$bln = $pecah[1];
		$thn = $pecah[0];

		$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$nama_hari = "";
		if($nama=="Sunday") {$nama_hari="Minggu";}
		else if($nama=="Monday") {$nama_hari="Senin";}
		else if($nama=="Tuesday") {$nama_hari="Selasa";}
		else if($nama=="Wednesday") {$nama_hari="Rabu";}
		else if($nama=="Thursday") {$nama_hari="Kamis";}
		else if($nama=="Friday") {$nama_hari="Jumat";}
		else if($nama=="Saturday") {$nama_hari="Sabtu";}
		return $nama_hari;
	}
}