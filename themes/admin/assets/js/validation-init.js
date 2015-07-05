var Script = function () {
    $().ready(function() {
        // validate the comment form when it is submitted
        if($('#addAgenda').length>0){

            $("#addAgenda").validate({
                rules: {
                    agenda_nama: {
                        required: true,
                        minlength: 5
                    },
                    agenda_tempat: {
                        required: true,
                        minlength: 5
                    },
                    agenda_datetime: {
                        required: true
                    }
                },
                messages: {
                    agenda_nama: {
                        required: "Judul/Nama agenda tidak boleh kosong",
                        minlength: "Minimal 3 kata untuk nama/judul agenda"
                    },
                    agenda_tempat: {
                        required: "Tempat agenda tidak boleh kosong",
                        minlength: "Minimal 2 kata untuk tempat agenda"
                    },
                    agenda_datetime: {
                        required: "Waktu agenda tidak boleh kosong"
                    }
                }
            });
        }

        if($('#addContent').length>0){

            $("#addContent").validate({
                rules: {
                    content_type: {
                        required: true
                    },

                    content_nama: {
                        required: true,
                        minlength: 5
                    },
                    content_tempat: {
                        required: true,
                        minlength: 5
                    },
                    content_datetime: {
                        required: true
                    }
                },
                messages: {
                    content_type: {
                        required: "Tipe konten harus dipilih satu"
                    },
                    content_nama: {
                        required: "Judul/Nama content tidak boleh kosong",
                        minlength: "Minimal 3 kata untuk nama/judul content"
                    },
                    content_tempat: {
                        required: "Tempat content tidak boleh kosong",
                        minlength: "Minimal 2 kata untuk tempat content"
                    },
                    content_datetime: {
                        required: "Waktu content tidak boleh kosong"
                    }
                }
            });
        }
    });
}();