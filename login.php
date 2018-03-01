<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="dist/css/absensi.css">
  	<!-- Ionicons -->
  	<!-- <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css"> -->
  	<style>
  		
		body, html {
		    height: 100%;
		    
			background: url('bg.jpg');
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center center;
			background-attachment: fixed;
			 /* Old browsers */
			/*background: -moz-radial-gradient(center, ellipse cover,  rgba(185,210,224,1) 0%, rgba(187,214,228,1) 0%, rgba(186,211,225,1) 15%, rgba(186,211,225,1) 38%, rgba(169,199,215,1) 68%, rgba(169,199,215,1) 68%, rgba(169,199,215,1) 82%, rgba(158,191,208,1) 100%); FF3.6-15
			/background: -webkit-radial-gradient(center, ellipse cover,  rgba(185,210,224,1) 0%,rgba(187,214,228,1) 0%,rgba(186,211,225,1) 15%,rgba(186,211,225,1) 38%,rgba(169,199,215,1) 68%,rgba(169,199,215,1) 68%,rgba(169,199,215,1) 82%,rgba(158,191,208,1) 100%); /* Chrome10-25,Safari5.1-6 */
			/*background: radial-gradient(ellipse at center,  rgba(185,210,224,1) 0%,rgba(187,214,228,1) 0%,rgba(186,211,225,1) 15%,rgba(186,211,225,1) 38%,rgba(169,199,215,1) 68%,rgba(169,199,215,1) 68%,rgba(169,199,215,1) 82%,rgba(158,191,208,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
			/*filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b9d2e0', endColorstr='#9ebfd0',GradientType=1 ); IE6-9 fallback on horizontal gradient
			*/
		}

		
		.welcome {
			margin-top: 100px!important;
			color: #efefef;
			/* text-shadow: 0 0 5px rgba(0,0,0,0.7); */
			padding: 25px;
			background: #5fbc87;
			text-transform: uppercase;
		}
		.box {
			background: rgba(255, 255, 255, 0.7);
		}
		.box {
			border-top: 5px solid #569976;
		}
		.box input.form-control {
			background: rgba(255,255,255,0.8)!important;
		}
		.login_title {
			color: #666!important;
		}
		@media screen and (max-width: 412px) {
			.welcome {
				margin-top: 50px!important;
				/* color: #58b2ff; */
				/* text-shadow: 0 0 2px rgba(0,0,0,0.7); */
				font-size: 2em;
			}
		}
  	</style>
</head>
<body>
    <div class="container col-sm-4 col-sm-offset-4">
		<h1 class="welcome text-center">Absensi Siswa SMKN 10 Malang</h1>
		<div class="box">
			<div class="box-header">
				<h2 class='login_title text-center'> <i class="fa fa-lock"></i> Masuk</h2>
			</div>
			<div class="box-body">
				<form class="form-signin">
					<div class="form-group">
						<input type="text" class="form-control" id="nip" name="nip", placeholder="Masukkan User atau NIP">
						<div id="nip-msg" style="display:none; color: red; text-align: center"></div>
					</div>
					<div class="form-group">
						<input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Kata Kunci">
						<div id="password-msg" style="display:none; color: red; text-align: center"></div>
					</div>
					<!-- <div class="form-group">
						<select name="level" id="level" class="form-control">
							<option value="0">--Pilih Tipe Pengguna--</option>
							<option value="1">Admin</option>
							<option value="2">Guru</option>
							<option value="3">Wali Kelas</option>
							<option value="4">Kepala Sekolah</option>
						</select>
						<div id="level-msg" style="display:none; color: red; text-align: center"></div>
					</div> -->
					<div class="form-group">
						<button class="btn btn-large btn-primary center-block" type="submit">MASUK</button>
					</div>
				</form><!-- /form -->
			</div>
            
		</div>
    
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
    		// $("#level").change(function(event) {
    		// 	$('#level-msg').fadeOut('fast');
    		// });



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
				} 
				// else if ($('#level').val() == '0') {
    			// 	$('#level-msg').fadeIn(500).html('<h4>Pilih Level Pengguna</h4>')
    			// 	$('#level').focus();
    			// 	return false;
    			// }
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