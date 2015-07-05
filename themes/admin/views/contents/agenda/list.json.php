<?php
echo "<pre>";print_r($data);die;
$results['sEcho'] = $sEcho;
$results['iSortingCols'] = $iSortingCols;
$results['iTotalRecords'] = $results['iTotalDisplayRecords'] = $iTotalRecords;
if(count($listAgenda)>0)
{
	$i=0;

	foreach($listAgenda as $agenda)
	{	
		$nomor     		= '<div style="text-align:center;">'.$no.'</a>';
		$tgl 			= ($agenda->agenda_datetime!='0000-00-00 00:00:00' && $agenda->agenda_datetime!='')?tgl_indo(date('Y-m-d', strtotime($agenda->agenda_datetime))):'<div style="text-align:center;">-</div>';
		$action 		= '<div style="text-align:center;">';
		$action    	   .= '<a href="'.base_url('admin/agenda/update/'.base64_encode($agenda->agenda_id)).'" class="label label-success"><i class="icon-edit"></i></a>';
		$action    	   .= "&nbsp;&nbsp;";
		$action    	   .= '<a href="'.base_url('admin/agenda/read/'.base64_encode($agenda->agenda_id)).'" class="label label-warning"><i class="icon-zoom-in"></i></a>';
		$action        .= "</div>";
		$results['aaData'][$i] = array(
			$nomor,
			$agenda->agenda_title,
			$agenda->agenda_place,
			$tgl,
			$action
			);

		$no++;
		++$i;
	}
} else {
	for($i=0;$i<6;++$i) {
		$results['aaData'][0][$i] = '';
	}

}

print($callback.'('.json_encode($results).')');