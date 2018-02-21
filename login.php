<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  	<!-- Ionicons -->
  	<!-- <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css"> -->
  	<style>
  		
		body, html {
		    height: 100%;
		    background-repeat: no-repeat;
		background: rgb(185,210,224); /* Old browsers */
		background: -moz-radial-gradient(center, ellipse cover,  rgba(185,210,224,1) 0%, rgba(187,214,228,1) 0%, rgba(186,211,225,1) 15%, rgba(186,211,225,1) 38%, rgba(169,199,215,1) 68%, rgba(169,199,215,1) 68%, rgba(169,199,215,1) 82%, rgba(158,191,208,1) 100%); /* FF3.6-15 */
		background: -webkit-radial-gradient(center, ellipse cover,  rgba(185,210,224,1) 0%,rgba(187,214,228,1) 0%,rgba(186,211,225,1) 15%,rgba(186,211,225,1) 38%,rgba(169,199,215,1) 68%,rgba(169,199,215,1) 68%,rgba(169,199,215,1) 82%,rgba(158,191,208,1) 100%); /* Chrome10-25,Safari5.1-6 */
		background: radial-gradient(ellipse at center,  rgba(185,210,224,1) 0%,rgba(187,214,228,1) 0%,rgba(186,211,225,1) 15%,rgba(186,211,225,1) 38%,rgba(169,199,215,1) 68%,rgba(169,199,215,1) 68%,rgba(169,199,215,1) 82%,rgba(158,191,208,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b9d2e0', endColorstr='#9ebfd0',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

		}

		.login_box{
		    background:#f7f7f7;
		    border:3px solid #F4F4F4;
		    padding-left: 15px;
		    margin-bottom:25px;
		    }
		.input_title{
		    color:rgba(164, 164, 164, 0.9);
		    padding-left:3px;
		        margin-bottom: 2px;
		    }

		hr{
		    width:100%;
		}
		    
		.welcome{
		    font-family: "myriad-pro",sans-serif;
		    font-style: normal;
		    font-weight: 100;
		    color:#FFFFFF;
		    margin-bottom:25px;
		    margin-top:50px;

		}

		.login_title{
		    font-family: "myriad-pro",sans-serif;
		    font-style: normal;
		    font-weight: 100;
		    color:rgba(164, 164, 164, 0.44);
		}

		.card-container.card {
		    max-width: 350px;

		}

		.btn {
		    font-weight: 700;
		    height: 36px;
		    -moz-user-select: none;
		    -webkit-user-select: none;
		    user-select: none;
		    cursor: default;
		    border-radius:0;
		    background:#43A6EB;
		    height: 55px;
		    margin-bottom:10px;
		}

		/*
		 * Card component
		 */
		.card {
		    background-color: #FFFFFF;
		    /* just in case there no content*/
		    padding: 1px 25px 30px;
		    margin: 0 auto 25px;
		    margin-top: 15%x;
		    /* shadows and rounded borders */
		    -moz-border-radius: 2px;
		    -webkit-border-radius: 2px;
		    border-radius: 2px;
		    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		}

		.profile-img-card {
		    width: 96px;
		    height: 96px;
		    margin: 0 auto 10px;
		    display: block;
		    -moz-border-radius: 50%;
		    -webkit-border-radius: 50%;
		    border-radius: 50%;
		}

		/*
		 * Form styles
		 */
		.profile-name-card {
		    font-size: 16px;
		    font-weight: bold;
		    text-align: center;
		    margin: 10px 0 0;
		    min-height: 1em;
		}

		.reauth-email {
		    display: block;
		    color: #404040;
		    line-height: 2;
		    margin-bottom: 10px;
		    font-size: 14px;
		    text-align: center;
		    overflow: hidden;
		    text-overflow: ellipsis;
		    white-space: nowrap;
		    -moz-box-sizing: border-box;
		    -webkit-box-sizing: border-box;
		    box-sizing: border-box;
		}

		.form-signin #inputEmail,
		.form-signin #inputPassword {
		    direction: ltr;
		    height: 44px;
		    font-size: 16px;
		}

		.form-signin input[type=email],
		.form-signin input[type=password],
		.form-signin input[type=text],
		.form-signin button {
		    width: 100%;
		    display: block;

		    z-index: 1;
		    position: relative;
		    -moz-box-sizing: border-box;
		    -webkit-box-sizing: border-box;
		    box-sizing: border-box;
		}

		.form-signin .form-control:focus {
		    border-color: rgb(104, 145, 162);
		    outline: 0;
		    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
		    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
		}

		.btn.btn-signin {
		    /*background-color: #4d90fe; */
		    background-color: rgb(104, 145, 162);
		    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
		    padding: 0px;
		    font-weight: 700;
		    font-size: 14px;
		    height: 36px;
		    -moz-border-radius: 3px;
		    -webkit-border-radius: 3px;
		    border-radius: 3px;
		    border: none;
		    -o-transition: all 0.218s;
		    -moz-transition: all 0.218s;
		    -webkit-transition: all 0.218s;
		    transition: all 0.218s;
		}

		.btn.btn-signin:hover,
		.btn.btn-signin:active,
		.btn.btn-signin:focus {
		    background-color: rgb(12, 97, 33);
		}

		.forgot-password {
		    color: rgb(104, 145, 162);
		}

		.forgot-password:hover,
		.forgot-password:active,
		.forgot-password:focus{
		    color: rgb(12, 97, 33);
		}
  	</style>
</head>
<body>
    <div class="container">
    <h1 class="welcome text-center">Selamat Datang<br> <small>Absensi Siswa SMKN 10 Malang</small></h1>
        <div class="card card-container">
        <h2 class='login_title text-center'>Login</h2>
        <hr>

            <form class="form-signin">
                <div class="form-group">
                	<input type="text" class="form-control" id="nip" name="nip", placeholder="Masukkan User atau NIP">
                	<div id="nip-msg" style="display:none; color: red; text-align: center"></div>
                </div>
                <div class="form-group">
                	<input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Kata Kunci">
                	<div id="password-msg" style="display:none; color: red; text-align: center"></div>
                </div>
                <div class="form-group">
                	<select name="level" id="level" class="form-control">
                		<option value="0">--Pilih Tipe Pengguna--</option>
                		<option value="1">Admin</option>
                		<option value="2">Guru</option>
                		<option value="3">Wali Kelas</option>
                		<option value="4">Kepala Sekolah</option>
                	</select>
                	<div id="level-msg" style="display:none; color: red; text-align: center"></div>
                </div>
                <div class="form-group">
                	<button class="btn btn-large btn-primary" type="submit">MASUK</button>
                </div>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->


	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- <script src="https://use.typekit.net/ayg4pcz.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script> -->
    <script>
    	$(document).ready(function() {

    		$("#nip").change(function(event) {
    			$('#nip-msg').fadeOut('fast');
    		});
    		$("#password").change(function(event) {
    			$('#password-msg').fadeOut('fast');
    		});
    		$("#level").change(function(event) {
    			$('#level-msg').fadeOut('fast');
    		});



    		$('.form-signin').submit(function(e) {
    			e.preventDefault();
    			var dataLogin = $('.form-signin').serialize();
    			// console.log(dataLogin);
    			if($('#nip').val() == '' ){
    				$("#nip-msg").fadeIn(500).html('<h4>Masukkan NIP / Username</h4>');
    				$('#nip').focus();
    				return false;
    			} else if ($('#password').val() == '') {
    				$("#password-msg").fadeIn(500).html('<h4>Masukkan Password</h4>')
    				$('#password').focus();
    				return false;
    			} else if ($('#level').val() == '0') {
    				$('#level-msg').fadeIn(500).html('<h4>Pilih Level Pengguna</h4>')
    				$('#level').focus();
    				return false;
    			}
    			$.ajax({
    				url: 'loginProcess.php',
    				type: 'post',
    				data: dataLogin,
    				success: function(res) {
						// console.log(res);
    					if ( res == 'valid') {
							window.location.href = 'index.php';
						} else if ( res == 'invalid') {
							$('#password-msg').fadeIn(350).html('<h4>Kata Kunci tidak sesuai. Mohon ulangi lagi.');
						} else if ( res === 'no_user' ) {
							$("#nip-msg").fadeIn(500).html('<h4>Anda belum terdaftar ke Sistem. Harap hubungi Admin.</h4>');
						} else if ( res == 'invalid_level') {
							$('#level-msg').fadeIn(500).html('<h4>Pilihan Level Pengguna tidak sesuai.</h4>')
							$('#level').focus();
						}
    				}
    			});

    		});
    	});
    </script>
</body>
</html>