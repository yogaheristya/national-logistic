

<div class="container-fluid">
	<!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
        	
        	<h4 class="page-title" style="color: red;">Cargo Owner Access</h4>
        </div>
    </div>
    <div>
        
    </div>
    <div class="row">
    	<div class="col-sm-12">
    		<div class="card border-secondary m-b-20">
    			<div class="card-body table-responsive text-secondary">
    				<h5 data-toggle="collapse" data-target="#request" class="card-title " style="cursor: pointer;" id="icon_request">
    					<button class="btn waves-effect btn-sm" style="background-color: #293165; color: #fff;"><i class="ti ti-angle-right"></i></button> Delivery Order - <i style="color: red;">REQUEST</i>
    				</h5>
    				<div class="col-sm-12 collapse" id="request">
                        <?php
                                if ($this->session->userdata('group')!= '1280') { ?>
                                    <div class="row" style="margin-bottom: 20px;margin-left: 5px;margin-top: 20px;font-family: roboto;">
                                        <button type="button" onclick="location.href='<?=site_url("open-form")?>'" class="btn btn-icon waves-effect btn-primary" style="font-family: roboto">
                                            <i class="ti-plus">  New</i>
                                        </button>
                                    </div>
                                <?php } ?>
                        
                        <div id="DivTableRequest"></div>
                    </div>
    			</div>	
    		</div>
    	</div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
    		<div class="card border-secondary m-b-20">
    			<div class="card-body table-responsive text-secondary">
    				<h5 data-toggle="collapse" data-target="#release" class="card-title " style="cursor: pointer;" id="icon_release">
    					<button class="btn waves-effect btn-secondary btn-sm" style="background-color: #293165; color: #fff;"><i class="ti ti-angle-right"></i></button> Delivery Order - <i style="color: red;">RELEASE</i>
    				</h5>

    				<div class="col-sm-12 collapse" id="release">
                        <br>
                     <form class="form-horizontal" enctype="multipart/form-data" name="search" id="search" role="form" onsubmit="return false;">                    
                     <div class="form-group row">
                            <div class="col-sm-2"><input type="text" name="no_bl" id="no_bl" class="form-control row" placeholder="input BL number"></div>
                            <div class="col-sm-2" style="display: flex;align-self: center;">
                                <button type="button" id="btn-search" class="btn btn-md btn-info"> Search</button>&nbsp;&nbsp;
                                <button type="button" id="btn-reset" class="btn btn-md btn-warning" data-toggle="tooltip" title="Clear Search"> Reset</button>
                            </div>
                    </div>
                    </form>
                    <br>
         	 			<div id="DivTableRelease"></div>
                    </div>	
    			</div>
    		</div>
    	</div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
    		<div class="card border-secondary m-b-20">
    			<div class="card-body table-responsive text-secondary">
    				<h5 data-toggle="collapse" data-target="#SP2request" class="card-title " style="cursor: pointer;" id="icon_sp2request">
    					<button class="btn waves-effect btn-secondary btn-sm" style="background-color: #293165; color: #fff;"><i class="ti ti-angle-right"></i></button> Surat Penyerahan Peti Kemas - <i style="color: red;">REQUEST</i>
    				</h5>
    				<div class="col-sm-12 collapse" id="SP2request">
         	 		   <div id="DivTableRequestSP2"></div>
         	 	    </div>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
    		<div class="card border-secondary m-b-20">
    			<div class="card-body table-responsive text-secondary">
    				<h5 data-toggle="collapse" data-target="#SP2release" class="card-title " style="cursor: pointer;" id="icon_sp2release">
    					<button class="btn waves-effect btn-secondary btn-sm" style="background-color: #293165; color: #fff;"><i class="ti ti-angle-right"></i></button> Surat Penyerahan Peti Kemas - <i style="color: red;">RELEASE</i>
    				</h5>
    				<div class="col-sm-12 collapse" id="SP2release">
         	 		   <div id="DivTableReleaseSP2"></div>
         	 	    </div>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <button class="btn waves-effect btn-secondary btn-sm" style="background-color: #293165; color: #fff;" id="BtnSend"> NLE </button>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
</div>

<script type="text/javascript">
  LoadTableRequest('/C_cargo/LoadTableRequest','DivTableRequest');

  LoadTableRelease('/C_cargo/LoadTableRelease','DivTableRelease');

  LoadTableRequestSP2('/C_cargo/LoadTableRequestSP2','DivTableRequestSP2');

  LoadTableReleaseSP2('/C_cargo/LoadTableReleaseSP2','DivTableReleaseSP2');

  function release(UrlList,DivList,FormId){
    var test = $('#' + FormId).serialize();
    console.log(test)
    $.ajax({
        type: 'POST',
        url: site_url + UrlList,
        data : $('#' + FormId).serialize(), 
        success: function (data) {
                $("#" + DivList).html(data);
                return false;
        },
        error: function () {
            // ShowAlert("Display Data Processing ...", "Error Console,Please Contact Administrator", "error", false, false, 3000);
        },
        complete: function () {
            // ShowLoadingWait(false);
        },
        beforeSend: function () {
            // ShowLoadingWait(true);
        }

    });
    return false;
   }  	

  function LoadTableRequest(UrlList, DivList) {
    $("#" + DivList).html('');
    $.ajax({
        type: 'POST',
        url: site_url + UrlList,
        success: function (data) {
            if (DivList.search("DivLoad") > 0) {
                $("#" + DivList).load(data);
            } else {
                $("#" + DivList).html(data);
            }
        },
        error: function () {
            // ShowAlert("Display Data Processing ...", "Error Console,Please Contact Administrator", "error", false, false, 3000);
        },
        complete: function () {
            // ShowLoadingWait(false);
        },
        beforeSend: function () {
            // ShowLoadingWait(true);
        }
    });
    return false;
   }

   function LoadTableRelease(UrlList, DivList) {
    $("#" + DivList).html('');
    $.ajax({
        type: 'POST',
        url: site_url + UrlList,
        success: function (data) {
            if (DivList.search("DivLoad") > 0) {
                $("#" + DivList).load(data);
            } else {
                $("#" + DivList).html(data);
            }
        },
        error: function () {
            // ShowAlert("Display Data Processing ...", "Error Console,Please Contact Administrator", "error", false, false, 3000);
        },
        complete: function () {
            // ShowLoadingWait(false);
        },
        beforeSend: function () {
            // ShowLoadingWait(true);
        }
    });
    return false;
   }

   function LoadTableRequestSP2(UrlList, DivList) {
    $("#" + DivList).html('');
    $.ajax({
        type: 'POST',
        url: site_url + UrlList,
        success: function (data) {
            if (DivList.search("DivLoad") > 0) {
                $("#" + DivList).load(data);
            } else {
                $("#" + DivList).html(data);
            }
        },
        error: function () {
            // ShowAlert("Display Data Processing ...", "Error Console,Please Contact Administrator", "error", false, false, 3000);
        },
        complete: function () {
            // ShowLoadingWait(false);
        },
        beforeSend: function () {
            // ShowLoadingWait(true);
        }
    });
    return false;
   }

   function LoadTableReleaseSP2(UrlList, DivList) {
    $("#" + DivList).html('');
    $.ajax({
        type: 'POST',
        url: site_url + UrlList,
        success: function (data) {
            if (DivList.search("DivLoad") > 0) {
                $("#" + DivList).load(data);
            } else {
                $("#" + DivList).html(data);
            }
        },
        error: function () {
            // ShowAlert("Display Data Processing ...", "Error Console,Please Contact Administrator", "error", false, false, 3000);
        },
        complete: function () {
            // ShowLoadingWait(false);
        },
        beforeSend: function () {
            // ShowLoadingWait(true);
        }
    });
    return false;
   }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#icon_request').click(function() {
            $(".ti",this).toggleClass("ti-angle-right ti-angle-down");
        });
        $('#icon_release').click(function() {
            $(".ti",this).toggleClass("ti-angle-right ti-angle-down");
        });
        $('#icon_sp2request').click(function() {
            $(".ti",this).toggleClass("ti-angle-right ti-angle-down");
        });
        $('#icon_sp2release').click(function() {
            $(".ti",this).toggleClass("ti-angle-right ti-angle-down");
        });
        <?php $session_npwp=(isset($_SESSION['F_npwp']))?$_SESSION['F_npwp']:''; ?>
        var npwp='<?php echo $session_npwp;?>';
        $("#BtnSend").click(function (e) {
            ShowLoadingWait(true);
            e.preventDefault();
                $.ajax({
                   url: '<?php echo site_url('C_cargo/getEncryptedNPWP');?>',
                        data: 'npwp='+ npwp,
                        type: 'POST',
                        dataType: 'JSON',
                    success: function (data) {
                        if (data.valid) {
                            setTimeout(function () {
                                ShowLoadingWait(false);
                                window.open("https://nle.kemenkeu.go.id/index.js?enc="+data.value);
                            }, 3000);
                        }
                        else{
                           swal({type: 'error',
                                title:'',
                                'text':data.value
                            }); 
                        }
                        return false;
                    },
                    error: function () {
                        ShowLoadingWait(false);
                        swal({type: 'error',
                            title:'',
                            'text':arrData[2]});
                    },
                    complete: function () {
                    },
                    beforeSend: function () {
                    }
                });
        });

        function ShowLoadingWait(display) {
        if (display) {
            swal({
                title: '',
                text : 'Loading Please Wait',
                imageUrl: base_url + '/assets/images/285.gif',
                showConfirmButton: false,
                allowOutsideClick: false
            });
        } else {
            swal.close();
        }
    }

        
    });
</script>