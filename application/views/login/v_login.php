<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>LNSW - National Logistic </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=base_url()?>/assets/images/favicon.ico">

         <!-- Sweet Alert css -->
        <link href="<?=base_url()?>/assets/plugins/sweet-alert/sweetalert2.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="<?=base_url()?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="<?=base_url()?>/assets/js/modernizr.min.js"></script>

    </head>

    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <!-- <a href="index.html" class="logo"><span>Admin<span>to</span></span></a>
                <h5 class="text-muted mt-0 font-600">Responsive Admin Dashboard</h5> -->
            </div>
        	<div class="m-t-40 card-box">
                <img src="<?php echo base_url('assets/images/logo.png')?>" width="300px" style="width:100%" alt="">
                <div class="p-20">
                    <form class="form-horizontal m-t-20" id="formLogin" method="POST">

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" name="username" placeholder="Username">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" name="password" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <img id="captchaImg" src="" alt="Captcha" style="border:1px solid #E3E3E3; width:340px;" title="Click to refresh captha image.">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="text" class="form-control" placeholder="Captcha" name="inputCaptcha">
                            </div>
                        </div>
                        


                        <!-- <div class="form-group ">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-custom">
                                    <input id="checkbox-signup" type="checkbox">
                                    <label for="checkbox-signup">
                                        Remember me
                                    </label>
                                </div>

                            </div> -->
                        </div>

                        <div class="form-group text-center m-t-30">
                            <div class="col-xs-12">
                                <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit" onclick="return SignIn('formLogin');">Log In</button>
                            </div>
                        </div>

                        <!-- <div class="form-group m-t-30 mb-0">
                            <div class="col-sm-12">
                                <a href="page-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                            </div>
                        </div> -->
                    </form>

                </div>
            </div>
            <!-- end card-box-->
            <div class="text-center">
                <p class="text-muted mt-0 font-600">Copyright &#169; LNSW 2020. All Rights Reserved.</p>
            </div>
        </div>
        <!-- end wrapper page -->


        <script type="text/javascript">
        var base_url = "<?=base_url()?>";
        var site_url = "<?=site_url()?>";
        </script>
        <!-- jQuery  -->
        <script src="<?=base_url()?>/assets/js/jquery.min.js"></script>
        <script src="<?=base_url()?>/assets/js/popper.min.js"></script>
        <script src="<?=base_url()?>/assets/js/bootstrap.min.js"></script>
        <script src="<?=base_url()?>/assets/js/waves.js"></script>
        <script src="<?=base_url()?>/assets/js/jquery.slimscroll.js"></script>

         <!-- Sweet Alert Js  -->
        <script src="<?=base_url()?>/assets/plugins/sweet-alert/sweetalert2.min.js"></script>
        <script src="<?=base_url()?>/assets/pages/jquery.sweet-alert.init.js"></script>

        <!-- App js -->
        <script src="<?=base_url()?>/assets/js/jquery.core.js"></script>
        <script src="<?=base_url()?>/assets/js/jquery.app.js"></script>

       
        <script type="text/javascript">
  function SignIn(FormId) {
    $.ajax({
        type: 'POST',
        url: site_url + "/C_auth/do_login",
        data: 'InputAction=SignIn&' + $('#' + FormId).serialize(),
        success: function (data) {
            var arrData = data.split("#");
            if (arrData[0] === "msg") {
                swal({type: arrData[1],title:'','text':arrData[2]});
                if (arrData[3] !== "" && typeof arrData[3] !== 'undefined') {
                    setTimeout(function () {
                        location.href = arrData[3];
                    }, 3000);
                }

            } else {
                swal({type: 'warning',title:'','text':arrData[2]});
            }
            return false;
        },
        error: function () {
            swal({type: 'error',title:'GATEWAY','text':arrData[2]});
        },
        complete: function () {
            
        },
        beforeSend: function () {
            
        }

    });
    return false;
  }
</script>
<script type="text/javascript">
$(document).ready(function () {

getCaptcha();

function getCaptcha() { 
    // $('#captchaImg').attr('src', 'http://localhost/INSW/dashboard_handler/index.php/captcha')
    $('#captchaImg').attr('src', '<?php base_url()?>/national-logistic/index.php/C_auth/createCaptcha');
}
    $('#captchaImg').click(function (e) { 
      e.preventDefault();
      getCaptcha();
    });
});
</script>

</html>
	
	</body>
</html>