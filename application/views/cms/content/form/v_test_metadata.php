
<div class="row">
	<div class="col-sm-12">
    	<div class="btn-group pull-right m-t-20">
        	<a href="<?= site_url('home') ?>" style="font-size: 12;font-family: Roboto"><b><i class="ti-arrow-left"></i>&nbsp;&nbsp; Back</b></a>
        </div>
    	<h4 class="page-title"><?php echo $page_title;?></h4>
    </div>
</div>
<div class="row">
	<form>
		<input type="file" name="test_file" accept="application/pdf">
		<button>Submit</button>
	</form>
</div>
<script type="text/javascript">
	        $("#BtnMeta").click(function (e) {
            e.preventDefault();
            var form = $('#metadata')[0];
            var formData = new FormData(form);

            $('#metadata').parsley().validate();

            if ($('#metadata').parsley().isValid()){
                $.ajax({
                    url: '<?php echo site_url('C_cargo/execCoba');?>',
                    data: formData,
                    type: 'POST',
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS
                    success: function (data) {
                        var arrData = data.split("#");
                        if (arrData[0] === "msg") {
                            swal({type: arrData[1],
                                title:'',
                                'text':arrData[2]
                            });
                            if (arrData[3] !== "" && typeof arrData[3] !== 'undefined') {
                                setTimeout(function () {
                                    location.href = arrData[3];
                                }, 3000);
                            }
                        }else {
                            swal({type: 'warning',
                                title:'',
                                'text':arrData[2]
                            });
                        }
                        return false;
                    },
                    error: function () {
                        swal({type: 'error',
                            title:'',
                            'text':arrData[2]
                        });
                    },
                    complete: function () {
                    },
                    beforeSend: function () {
                    }
                });
            }else {
                console.log(' tidak valid');
            }
        });
</script>