$(document).ready(function() {
  if($('#agenda-table-list').length>0){
    $('#agenda-table-list').dataTable({
      "sDom": 'fCl<"clear">rtip',
      "sPaginationType": "bootstrap",
      "bProcessing": true,
      "bServerSide": true,
      "ordering": false,
      // "aaSorting": [[3, 'asc']],
      // "order": [[ 0, 'asc' ], [ 1, 'asc' ],[ 2, 'asc' ], [ 3, 'asc' ],[ 4, 'asc' ], [ 5, 'asc' ]],
      "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] },
        { "bSortable": false, "aTargets": [ 1 ] },
        { "bSortable": false, "aTargets": [ 2 ] },
        { "bSortable": false, "aTargets": [ 3 ] },
        { "bSortable": false, "aTargets": [ 4 ] },
        { "bSortable": false, "aTargets": [ 5 ] },
      ],

      "aoColumns": [
        null,
        null,
        null,
        null,
        null,
        null
      ],
      
      "sAjaxSource": BASEURL+"agenda/admin/json/1",
      "oLanguage": {
        "sZeroRecords": "Tidak ada yang cocok dengan kata kunci yang anda ketikan, coba lagi.",
        "sLengthMenu" : "Tampilkan _MENU_ data",
        "sProcessing" : "Silahkan tunggu...",
        "sInfo"       : "Menampilkan _START_ - _END_ dari total _TOTAL_ data",
        "sInfoEmpty"  : "Tidak ada data yang ditemukan",
        "emptyTable"  : "Tidak ada data untuk ditampilkan",
        "sSearch"     : "Pencarian",
        "sLoadingRecords": "Please wait - loading...",

        "oPaginate"   : {
          "sFirst"    :    "&laquo; Awal",
          "sLast"     :     "Akhir &raquo;",
          "sNext"     :     "Berikutnya &nbsp;&nbsp; <i class='fa fa-angle-right'></i>",
          "sPrevious" : "<i class='fa fa-angle-left'></i>&nbsp;&nbsp; Sebelumnya"
        }
      },
       "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
          oSettings.jqXHR = $.ajax( {
            "dataType": 'json', 
            // "type": "POST", 
            "url": sSource, 
            "data": aoData, 
            "success": fnCallback
          } );
        }
     });          
  }

  if($('#content-table-list').length>0){
    $('#content-table-list').dataTable({
      "sDom": 'fCl<"clear">rtip',
      "sPaginationType": "bootstrap",
      "bProcessing": true,
      "bServerSide": true,
      "ordering": false,
      // "aaSorting": [[3, 'asc']],
      // "order": [[ 0, 'asc' ], [ 1, 'asc' ],[ 2, 'asc' ], [ 3, 'asc' ],[ 4, 'asc' ], [ 5, 'asc' ]],
      "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] },
        { "bSortable": false, "aTargets": [ 1 ] },
        { "bSortable": false, "aTargets": [ 2 ] },
        { "bSortable": false, "aTargets": [ 3 ] },
        { "bSortable": false, "aTargets": [ 4 ] },
        { "bSortable": false, "aTargets": [ 5 ] },
      ],

      "aoColumns": [
        null,
        null,
        null,
        null,
        null,
        null
      ],
      
      "sAjaxSource": BASEURL+"content/admin/json/1",
      "oLanguage": {
        "sZeroRecords": "Tidak ada yang cocok dengan kata kunci yang anda ketikan, coba lagi.",
        "sLengthMenu" : "Tampilkan _MENU_ data",
        "sProcessing" : "Silahkan tunggu...",
        "sInfo"       : "Menampilkan _START_ - _END_ dari total _TOTAL_ data",
        "sInfoEmpty"  : "Tidak ada data yang ditemukan",
        "emptyTable"  : "Tidak ada data untuk ditampilkan",
        "sSearch"     : "Pencarian",
        "sLoadingRecords": "Please wait - loading...",

        "oPaginate"   : {
          "sFirst"    :    "&laquo; Awal",
          "sLast"     :     "Akhir &raquo;",
          "sNext"     :     "Berikutnya &nbsp;&nbsp; <i class='fa fa-angle-right'></i>",
          "sPrevious" : "<i class='fa fa-angle-left'></i>&nbsp;&nbsp; Sebelumnya"
        }
      },
       "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
          oSettings.jqXHR = $.ajax( {
            "dataType": 'json', 
            // "type": "POST", 
            "url": sSource, 
            "data": aoData, 
            "success": fnCallback
          } );
        }
     });          
  }

  if($('#ppdb-table-list').length>0){
    $('#ppdb-table-list').dataTable({
      "sDom": 'fCl<"clear">rtip',
      "sPaginationType": "bootstrap",
      "bProcessing": true,
      "bServerSide": true,
      "ordering": false,
      "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] },
        { "bSortable": false, "aTargets": [ 1 ] },
        { "bSortable": false, "aTargets": [ 2 ] },
        { "bSortable": false, "aTargets": [ 3 ] },
        { "bSortable": false, "aTargets": [ 4 ] },
      ],

      "aoColumns": [
        null,
        null,
        null,
        null,
        null
      ],
      
      "sAjaxSource": BASEURL+"psb/admin/json/1",
      "oLanguage": {
        "sZeroRecords": "Tidak ada yang cocok dengan kata kunci yang anda ketikan, coba lagi.",
        "sLengthMenu" : "Tampilkan _MENU_ data",
        "sProcessing" : "Silahkan tunggu...",
        "sInfo"       : "Menampilkan _START_ - _END_ dari total _TOTAL_ data",
        "sInfoEmpty"  : "Tidak ada data yang ditemukan",
        "emptyTable"  : "Tidak ada data untuk ditampilkan",
        "sSearch"     : "Pencarian",
        "sLoadingRecords": "Please wait - loading...",

        "oPaginate"   : {
          "sFirst"    :    "&laquo; Awal",
          "sLast"     :     "Akhir &raquo;",
          "sNext"     :     "Berikutnya &nbsp;&nbsp; <i class='fa fa-angle-right'></i>",
          "sPrevious" : "<i class='fa fa-angle-left'></i>&nbsp;&nbsp; Sebelumnya"
        }
      },
       "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
          oSettings.jqXHR = $.ajax( {
            "dataType": 'json', 
            // "type": "POST", 
            "url": sSource, 
            "data": aoData, 
            "success": fnCallback
          } );
        }
     });          
  }
});