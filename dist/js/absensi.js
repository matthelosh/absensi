$(document).ready(function() {
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

});