// import { join } from "path";

$(document).ready(function() {

    // $("#tbl_siswa").DataTable();
    $('.dataTable').DataTable();
// Administrasi User
    $('#frm_add_user').submit(function(e) {
        e.preventDefault();
        var dataUser = $(this).serialize();
        $.ajax({
            method: 'post',
            url: 'modules/action/ad_user.php?mod=add',
            data: dataUser,
            success: function(res) {
                console.log(res);
            }
        });
    });

    $('.deactivate_user').click(function(e) {
        e.preventDefault();
        var uname = $(this).closest('tr').find('td.uname').text();
        var oyi = confirm('Yakin ingin me-non-aktifkan '+ uname +'?');
        if(oyi) {
            $.ajax({
                method: 'post',
                url: 'modules/action/ad_user.php?mod=deactivate',
                data: {'uname': uname},
                success: function(res) {
                    location.reload();
                    setTimeout(function() {
                        alert(res);
                    }, 1000);
                }
            });
        } else {
            return false;
        }
    });
    $('.activate_user').click(function(e) {
        e.preventDefault();
        var uname = $(this).closest('tr').find('td.uname').text();
        var oyi = confirm('Yakin mengaktifkan user '+ uname +'?');
        if ( oyi ) {
            $.ajax({
                method: 'post',
                url: 'modules/action/ad_user.php?mod=activate',
                data: {'uname': uname},
                success: function(res) {
                    location.reload();
                    setTimeout(function() {
                        alert(res);
                    }, 1000);
                    
                }
            });
        } else {
            return false;
        }
    });

    $('.edit_user').click(function(e) {
        e.preventDefault();
        var uname = $(this).closest('tr').find('td.uname').text();
        // alert(uname);
        $.ajax({
            method: 'post',
            url: 'modules/action/ad_user.php?mod=edit',
            data: {'uname': uname},
            dataType: 'json',
            success: function(res) {
                $('#mdal_edit_user #username').text(res.nama);
                $('#mdal_edit_user #edit_uname').val(res.uname);
                $('#mdal_edit_user #edit_nama').val(res.nama);
                $('#mdal_edit_user #edit_email').val(res.email);
                $('#mdal_edit_user #edit_hp').val(res.hp);
                $('#mdal_edit_user').modal();
            }
        });
        // $('#mdal_edit_user #edit_uname').text(uname);
        // $('#mdal_edit_user').modal();
    });

    $('#frm_edit_user').on('submit', function(e) {
        e.preventDefault();
        var data_edit = $(this).serialize();
        $.ajax({
            method: 'post',
            url: 'modules/action/ad_user.php?mod=update',
            data: data_edit,
            success: function(res) {
                alert(res);
                $('#mdal_edit_user').modal('hide');
            }
        });
    });

// Administrasi Kelas

    // Tambah Kelas
    $('#btn_add_kelas').click(function(e) {
        e.preventDefault();
        $('#mode_form').text('Tambah Kelas');
        $('#mode_aksi').text('add_kelas');
        $('#mdal_frm_kelas').find('#btn_kelas').addClass('btn_add_kelas').text('Tambah');
        $('#mdal_frm_kelas').find('form').addClass('frm_add_kelas');
        $('#mdal_frm_kelas').removeClass('mdl_edit_kelas').addClass('mdl_add_kelas').modal(500);
    });

    $('.btn_edit_kelas').click(function(e) {
        e.preventDefault();
        var kode_kelas = $(this).closest('tr').find('td.kode_kelas').text();
        $("#idkelas").val(kode_kelas);
        $.ajax({
            method: 'post',
            url: 'modules/action/adm_kelas.php?mod=edit_kelas',
            data: {'kode_kelas': kode_kelas},
            dataType: 'json',
            success: function(res) {
               
                // console.log(res);

                $('#mode_form').text('Edit Kelas');
                $('#mode_aksi').text('update_kelas');
                $('#mdal_frm_kelas').find('#btn_kelas').addClass('btn_add_kelas').text('Perbarui');
                $('#mdal_frm_kelas').find('form').addClass('frm_edit_kelas');
                $('#mdal_frm_kelas').removeClass('mdl_add_kelas').addClass('mdl_edit_kelas').modal(500);
                $("#kode_kelas").val(res.kode_kelas);
                $("#nama_kelas").val(res.kelas);
                $("#wali_kelas").val(res.wali_kelas);

              
            }
        });
        
    });

    $('#frm_kelas').on('submit', function(e) {
        e.preventDefault();
        var mode = $('#mode_aksi').text();
        // alert(mode);
        var data = $(this).serialize();
        $.ajax({
            method: 'post',
            url: 'modules/action/adm_kelas.php?mod='+mode,
            data: data,
            dataType: 'json',
            success: function(res) {
                alert(res.msg);
                setTimeout(function() {
                    location.reload();
                }, 500);
                
            }
        });
    });


    // Togle aktif
    $('.deactivate_kelas').click(function(e) {
        e.preventDefault();
        var kode_kelas = $(this).closest('tr').find('td.kode_kelas').text();
        var oyi = confirm('Yakin ingin me-non-aktifkan '+ kode_kelas +'?');
        if(oyi) {
            $.ajax({
                method: 'post',
                url: 'modules/action/adm_kelas.php?mod=deactivate',
                data: {'kode_kelas': kode_kelas},
                success: function(res) {
                    alert(res);
                    location.reload();
                   
                    // console.log(res);
                }
            });
        } else {
            return false;
        }
    });
    $('.activate_kelas').click(function(e) {
        e.preventDefault();
        var kode_kelas = $(this).closest('tr').find('td.kode_kelas').text();
        var oyi = confirm('Yakin mengaktifkan user '+ kode_kelas +'?');
        if ( oyi ) {
            $.ajax({
                method: 'post',
                url: 'modules/action/adm_kelas.php?mod=activate',
                data: {'kode_kelas': kode_kelas},
                success: function(res) {
                    alert(res);
                    location.reload();
                    
                    // console.log(res);
                }
            });
        } else {
            return false;
        }
    });

// Administrasi Mapel
    $('#btn_add_mapel').click(function(e) {
        e.preventDefault();
        $('#mode_form').text('Tambah Mapel');
        $('#mode_aksi').text('add_mapel');
        $('#mdal_frm_mapel').find('#btn_mapel').addClass('btn_add_mapel').text('Tambah');
        $('#mdal_frm_mapel').find('form').addClass('frm_add_mapel');
        $('#mdal_frm_mapel').removeClass('mdl_edit_mapel').addClass('mdl_add_mapel').modal(500);
    });

    $('.btn_edit_mapel').click(function(e) {
        e.preventDefault();
        var kode_mapel = $(this).closest('tr').find('td.kode_mapel').text();

        // alert(kode_mapel);
        $("#idmapel").val(kode_mapel);
        $.ajax({
            method: 'post',
            url: 'modules/action/adm_mapel.php?mod=edit_mapel',
            data: {'kode_mapel': kode_mapel},
            dataType: 'json',
            success: function(res) {
            
                // console.log(res);

                $('#mode_form').text('Edit Mapel');
                $('#mode_aksi').text('update_mapel');
                $('#mdal_frm_mapel').find('#btn_mapel').addClass('btn_add_mapel').text('Perbarui');
                $('#mdal_frm_mapel').find('form').addClass('frm_edit_mapel');
                $('#mdal_frm_mapel').removeClass('mdl_add_mapel').addClass('mdl_edit_mapel').modal(500);
                $("#kode_mapel").val(res.kode_mapel);
                $("#nama_mapel").val(res.mapel);

            
            }
        });
        
    });

    $('#frm_mapel').on('submit', function(e) {
        e.preventDefault();
        var mode = $('#mode_aksi').text();
        // alert(mode);
        var data = $(this).serialize();
        $.ajax({
            method: 'post',
            url: 'modules/action/adm_mapel.php?mod='+mode,
            data: data,
            dataType: 'json',
            success: function(res) {
                if (res.kode == 'dbl_data') {
                    alert(res.msg);
                    return false;
                } else if (res.kode == 'db_error') {
                    alert(res.msg);
                    return false;
                } else if (res.kode == 'sip') {
                    alert(res.msg);
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                }
            }
        });
    });


    // Togle aktif Mapel
    $('.deactivate_mapel').click(function(e) {
        e.preventDefault();
        var kode_mapel = $(this).closest('tr').find('td.kode_mapel').text();
        var oyi = confirm('Yakin ingin me-non-aktifkan '+ kode_mapel +'?');
        if(oyi) {
            $.ajax({
                method: 'post',
                url: 'modules/action/adm_mapel.php?mod=deactivate',
                data: {'kode_mapel': kode_mapel},
                success: function(res) {
                    alert(res);
                    location.reload();
                
                    // console.log(res);
                }
            });
        } else {
            return false;
        }
    });
    $('.activate_mapel').click(function(e) {
        e.preventDefault();
        var kode_mapel = $(this).closest('tr').find('td.kode_mapel').text();
        var oyi = confirm('Yakin mengaktifkan user '+ kode_mapel +'?');
        if ( oyi ) {
            $.ajax({
                method: 'post',
                url: 'modules/action/adm_mapel.php?mod=activate',
                data: {'kode_mapel': kode_mapel},
                success: function(res) {
                    alert(res);
                    location.reload();
                    
                    // console.log(res);
                }
            });
        } else {
            return false;
        }
    });

// Administrasi Siswa
    $("#btn_add_siswa").click(function(e) {
        e.preventDefault();
        $.ajax({
            method: 'post',
            url: 'modules/action/adm_kelas.php?mod=get_kelas',
            data: {'mode': 'add'},
            // dataType: 'json',
            success: function(res){
                $('#kode_kelas').html(res);
            }
        });
        $('#mode_form').text('Tambah Siswa');
        $('#mode_aksi').text('add_siswa');
        $('#mdal_frm_siswa').find('#btn_siswa').addClass('btn_add_siswa').text('Tambah');
        $('#mdal_frm_siswa').find('form').addClass('frm_add_siswa');
        $('#mdal_frm_siswa').removeClass('mdl_edit_siswa').addClass('mdl_add_siswa').modal(500);
    });

    $('.btn_edit_siswa').click(function(e) {
        e.preventDefault();
        var nis = $(this).closest('tr').find('td.nis').text();

        // alert(kode_mapel);
        $("#idsiswa").val(nis);
        $.ajax({
            method: 'post',
            url: 'modules/action/adm_siswa.php?mod=edit_siswa',
            data: {'nis': nis},
            dataType: 'json',
            success: function(res) {
            
                console.log(res);
                var kelas = res.kelas;
                $.ajax({
                    method: 'post',
                    url: 'modules/action/adm_kelas.php?mod=get_kelas',
                    data: {'nis': nis, 'mode': 'edit', 'kelas': kelas},
                    success: function(res) {
                        $('#kode_kelas').html(res);
                    }
                });

                $('#mode_form').text('Edit siswa');
                $('#mode_aksi').text('update_siswa');
                $('#mdal_frm_siswa').find('#btn_siswa').addClass('btn_add_siswa').text('Perbarui');
                $('#mdal_frm_siswa').find('form').addClass('frm_edit_siswa');
                $('#mdal_frm_siswa').removeClass('mdl_add_siswa').addClass('mdl_edit_siswa').modal(500);
                $("#idsiswa").val(res.nis);
                $("#nis").val(res.nis);
                $("#nama_siswa").val(res.nama);
                $("#hp").val(res.hp);

            
            }
        });
        
    });

    $('#frm_siswa').on('submit', function(e) {
        e.preventDefault();
        var mode = $('#mode_aksi').text();
        // alert(mode);
        var data = $(this).serialize();
        console.log(data);
        $.ajax({
            method: 'post',
            url: 'modules/action/adm_siswa.php?mod='+mode,
            data: data,
            dataType: 'json',
            success: function(res) {
                if (res.kode == 'dbl_data') {
                    alert(res.msg);
                    return false;
                } else if (res.kode == 'db_error') {
                    alert(res.msg);
                    return false;
                } else if (res.kode == 'sip') {
                    alert(res.msg);
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                } else if (res.kode == 'testing') {
                    alert(res.msg);
                }
            }
        });
    });

    // Toggle Active Siswa

    $('.deactivate_siswa').click(function(e) {
        e.preventDefault();
        var nis = $(this).closest('tr').find('td.nis').text();
        var oyi = confirm('Yakin ingin me-non-aktifkan '+ nis +'?');
        if(oyi) {
            $.ajax({
                method: 'post',
                url: 'modules/action/adm_siswa.php?mod=deactivate',
                data: {'nis': nis},
                success: function(res) {
                    alert(res);
                    location.reload();
                
                    // console.log(res);
                }
            });
        } else {
            return false;
        }
    });
    $('.activate_siswa').click(function(e) {
        e.preventDefault();
        var nis = $(this).closest('tr').find('td.nis').text();
        var oyi = confirm('Yakin mengaktifkan user '+ nis +'?');
        if ( oyi ) {
            $.ajax({
                method: 'post',
                url: 'modules/action/adm_siswa.php?mod=activate',
                data: {'nis': nis},
                success: function(res) {
                    alert(res);
                    location.reload();
                    
                    // console.log(res);
                }
            });
        } else {
            return false;
        }
    });

// Administrasi Rombel
    $("#btn_add_rombel").on('click', function(e) {
        e.preventDefault();
        $('#mode_form').text('Tambah Rombel');
        $('#mode_aksi').text('add_rombel');
        $('#mdal_rombel').find('#btn_rombel').addClass('btn_add_rombel').text('Tambah');
        $('#mdal_rombel').find('form').addClass('frm_add_rombel');
        $('#mdal_rombel').removeClass('mdl_edit_rombel').addClass('mdl_add_rombel').modal(500);

    });

    // Form Edit Rombel
    $('.btn_edit_rombel').click(function(e){
        e.preventDefault();
        var idRombel = $(this).closest('tr').find('td.idRombel').text();
        $.ajax({
            method: 'post',
            url: 'modules/action/adm_rombel.php?mod=edit_rombel',
            data: {'idRombel': idRombel},
            dataType: 'json',
            success: function(res) {

                $('#mode_form').text('Edit Rombel');
                $('#mode_aksi').text('upd_rombel');
                $('#mdal_rombel').find('#btn_rombel').addClass('btn_edit_rombel').text('Perbarui');
                $('#mdal_rombel').find('form').addClass('frm_edit_rombel');
                $('#mdal_rombel').removeClass('mdl_add_rombel').addClass('mdl_edit_rombel').modal(500);
                $('#koderombel').val(res.id);
                $('#idrombel').val(res.id);
                $('#nama_rombel').val(res.nama_rombel);
                $('#nip_wali').val(res.wali);
            }
        });
    });

    // Update Rombel
    // $('.frm_edit_rombel').on('submit', function(e) {
    //     e.preventDefault();

    // });
    function list_member(idRombel) {
        $.ajax({
            method: 'post',
            url: 'modules/action/adm_rombel.php?mod=get_member',
            data: {'idRombel': idRombel},
            success: function(res) {
                $("#list_member").html(res);
            }
        });
    }

    function non_member() {
        $.ajax({
            method: 'post',
            url: 'modules/action/adm_rombel.php?mod=get_siswas',
            success: function(res) {
                console.log(res);
                $("#list_siswas").html(res);
            }
        });
    }
    $(".btn_mng_member").click(function(e) {
        e.preventDefault();
        var idRombel = $(this).closest('tr').find('td.idRombel').text();

        list_member(idRombel);
        non_member();
        $.ajax({
            method: 'post',
            url: 'modules/action/adm_rombel.php?mod=get_rombel',
            data: {'idRombel': idRombel},
            success: function(res) {
                $("#get_rombel_mng").html(res);
            }
        });
       
        $("#idRombel").text(idRombel);
        $('.member').html('<strong>'+idRombel.toUpperCase()+'</strong>');
        $("#mdal_mng_rombel").modal(500);
    });
    // Add Rombel
    $("#form_rombel").submit(function(e) {
        e.preventDefault();
        var data = $(this).serialize(),
            mod = $("#mode_aksi").text();
        // alert(mod);
        $.ajax({
            method: 'post',
            url: 'modules/action/adm_rombel.php?mod='+mod,
            data: data,
            dataType: 'json',
            success: function(res) {
                if (res.kode == 'dbl_data' || res.kode == 'db_error') {
                    alert(res.msg);
                    return false;
                } else if (res.kode == 'saved') {
                    alert(res.msg);
                    location.reload();
                }
            }
        });
    });

    // Toggle Aktifasi Rombel
    $('.deactivate_rombel').click(function(e) {
        e.preventDefault();
        var id = $(this).closest('tr').find('td.idRombel').text();
        var oyi = confirm('Yakin ingin me-non-aktifkan Rombel '+ id +'?');
        // alert(id);
        if(oyi) {
            $.ajax({
                method: 'post',
                url: 'modules/action/adm_rombel.php?mod=deactivate',
                data: {'id': id},
                success: function(res) {
                    alert(res);
                    location.reload();
                
                    // console.log(res);
                }
            });
        } else {
            return false;
        }
    });
    $('.activate_rombel').click(function(e) {
        e.preventDefault();
        var id = $(this).closest('tr').find('td.idRombel').text();
        var oyi = confirm('Yakin mengaktifkan Rombel '+ id +'?');
        if ( oyi ) {
            $.ajax({
                method: 'post',
                url: 'modules/action/adm_rombel.php?mod=activate',
                data: {'id': id},
                success: function(res) {
                    alert(res);
                    location.reload();
                    
                    // console.log(res);
                }
            });
        } else {
            return false;
        }
    });

    // Manajemen Anggota Rombel
    
    // Pilih Semua Siswa
    $("#pilih_al_siswas").on('click', function(e) {
        if($(this).is(':checked', true)) {
            $('.siswa_check').prop('checked', true);
        } else {
            $('.siswa_check').prop('checked', false);
        }
        $("#siswa_dipilih").html($("input.siswa_check:checked").length+" orang.");

       
    });
    // Pilih beberapa siswa
    $("#list_siswas").on('click', '.siswa_check', function() {
        $("#siswa_dipilih").html($("input.siswa_check:checked").length+" orang.");

    });

    // Pilih Semua member
    $("#pilih_al_members").on('click', function(e) {
        if($(this).is(':checked', true)) {
            $('.member_check').prop('checked', true);
        } else {
            $('.member_check').prop('checked', false);
        }
        $("#member_dipilih").html($("input.member_check:checked").length+" orang.");
        toggle_rombel();
    });

     // Pilih beberapa member
    $("#list_member").on('click', '.member_check', function() {
        $("#member_dipilih").html($("input.member_check:checked").length+" orang.");
        toggle_rombel();
    });

    // Toggle dorpdown rombel
    function toggle_rombel() {
        if($("input.member_check:checked").length > 0 ) {
            $("#get_rombel_mng").prop('disabled', false);
        } else {
            $("#get_rombel_mng").prop('disabled', true);
        }
        
    }

    // Masukkan ke dalam ROmbel
    $("#add_to_rombel").click(function() {
        var siswas = [];
        var idRombel = $("#idRombel").text();
        $("input.siswa_check:checked").each(function() {
            siswas.push($(this).data('nis-siswa'));
            
        });
        // console.log(siswas);
        if ( siswas.length < 1 ) {
            alert('Pilih Siswa yang mau dimasukkan rombel');
        } else {
            // var selected_siswas = siswas.join(",");
            $.ajax({
                method: 'post',
                url: 'modules/action/adm_rombel.php?mod=insert_to_rombel',
                data: {'nis':siswas,'idRombel':idRombel},
                cache: false,
                success: function(res) {
                    // console.log(res.substr(0,6));
                    if (res.substr(0,6) == 'sukses') {
                        alert(res.substr(0,6))
                        list_member(idRombel);
                        non_member();
                        $("#siswa_dipilih").html($("input.siswa_check:checked").length+" orang.");
                    } else if (res == 'gagal') {
                        alert('Gagal pindahkan siswa');
                    }
                }
            });
            
        }
        // alert(idRombel);
    });

    $("#rem_from_rombel").click(function() {
        var members = [];
        var idRombel = $("#idRombel").text();
        $("input.member_check:checked").each(function() {
            members.push($(this).data('nis-member'));
            
        });
        // console.log(siswas);
        if ( members.length < 1 ) {
            alert('Pilih Siswa yang mau dikeluarkan dari rombel');
        } else {
            // var selected_siswas = siswas.join(",");
            $.ajax({
                method: 'post',
                url: 'modules/action/adm_rombel.php?mod=rem_from_rombel',
                data: {'nis':members,'idRombel':idRombel},
                cache: false,
                success: function(res) {
                    // console.log(res.substr(0,6));
                    if (res.substr(0,6) == 'sukses') {
                        alert(res.substr(0,6))
                        list_member(idRombel);
                        non_member();
                        $("#get_rombel_mng").prop("disabled", true);
                        $("#member_dipilih").html($("input.member_check:checked").length+" orang.");
                    } else if (res == 'gagal') {
                        alert('Gagal pindahkan siswa');
                    }
                }
            });
            
        }
    });
    // Memindahkan siswa
    $("#move_from_rombel").click(function(e) {
        var members = [];
        var idRombel = $("#get_rombel_mng").val();
        $("input.member_check:checked").each(function() {
            members.push($(this).data('nis-member'));
            
        });
        // console.log(siswas);
        if ( members.length < 1 ) {
            alert('Pilih Siswa yang mau dipindahkan dari rombel');
        } else {
            // var selected_siswas = siswas.join(",");
            $.ajax({
                method: 'post',
                url: 'modules/action/adm_rombel.php?mod=move_from_rombel',
                data: {'nis':members,'idRombel':idRombel},
                cache: false,
                success: function(res) {
                    console.log(res);
                    console.log(res.substr(0,6));
                    if (res.substr(0,6) == 'sukses') {
                        alert(res.substr(0,6))
                        list_member(idRombel);
                        non_member();
                        $("#member_dipilih").html($("input.member_check:checked").length+" orang.");
                        $("#get_rombel_mng").prop("disabled", true);
                    } else if (res == 'gagal') {
                        alert('Gagal pindahkan siswa');
                    }
                }
            });
            
        }
    });
    
});