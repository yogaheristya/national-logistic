<div class="container-fluid">
<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-20">
                <a href="<?= site_url('home') ?>" style="font-size: 12;font-family: Roboto"><b><i class="ti-arrow-left"></i>&nbsp;&nbsp; Back</b></a>
        </div>      
        <h4 class="page-title" style="color: red;">List Container</h4>
    </div>
</div>
<?php if ($container['STATUS']!="TRUE") {?>
<div class="row">
    <div class="col-sm-12">
        <p><?=$container['MESSAGE']?></p>
    </div>
</div>
    
<?php } else {?>
<div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card m-b-20">
            <div class="card-body">
                <!-- <form id="formContainer" method="post" action="<?php echo site_url()."/C_spp/getProforma/".$id_reqdo_header;?>" enctype="multipart/form-data"  onsubmit='return cek();' role="form"> -->
                <form id="formContainer" method="post"  enctype="multipart/form-data" role="form">
                <fieldset>
                        <input type="hidden" name="cust_id" id="cust_id" value="<?=$container['STATUS']=="TRUE" ? $container['CUST_ID'][0] : ""?>">
                        <input type="hidden" name="id_reqdo_header" id="id_reqdo_header" value="<?=$id_reqdo_header?>">
                        <div class="form-group row">
                            <label for="shipper_name" class="col-sm-2 col-form-label">NO SPPB </label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$container['STATUS']=="TRUE" ? $container['NO_SPPB'][0] : ""?></label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label">Nama Kapal</label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$container['STATUS']=="TRUE" ? $container['NM_ANGKUT'][0]: ""?></label>
                        </div>
                        <div class="form-group row">
                            <label for="consignee_name" class="col-sm-2 col-form-label">Tanggal SPPB </label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$container['STATUS']=="TRUE" ? $container['TGL_SPPB'][0]: ""?></label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label">ID Pemilik Barang </label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$container['STATUS']=="TRUE" ? $container['CUST_ID'][0]: ""?></label>
                        </div>
                        <div class="form-group row">
                            <label for="notify_name" class="col-sm-2 col-form-label">Type Dokumen </label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$container['STATUS']=="TRUE" ? $container['DOCUMENT_TYPE'][0]: ""?></label>
                            <label for="npwp_notify" class="col-sm-2 col-form-label">Nama Pemilik Barang</label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$container['STATUS']=="TRUE" ? $container['CUST_NAME'][0]: ""?></label>
                        </div>
                        <div class="form-group row">
                            <label for="notify_name" class="col-sm-2 col-form-label">Kode Dokumen </label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$container['STATUS']=="TRUE" ? $container['DOC_CODE'][0]: ""?></label>
                            <label for="npwp_notify" class="col-sm-2 col-form-label">NPWP</label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$container['STATUS']=="TRUE" ? $container['NPWP'][0]: ""?> </label>
                        </div>
                        <div class="form-group row">
                            <label for="notify_name" class="col-sm-2 col-form-label"> NO BL</label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$container['STATUS']=="TRUE" ? $container['NO_BL_AWB'][0]: ""?></label>
                        </div>
                    </fieldset>
                    <table id="tech-companies-1" class="table  table-striped">
                    <thead>
                    <tr>
                        <th class="table-row-left"><input type="checkbox" name="" id="select-all"></th>
                        <th class="table-row-left">STATUS</th>
                        <th class="table-row-left">KARANTINA</th>
                        <th class="table-row-left">NO Container</th>
                        <th class="table-row-left">NO Kapal</th>
                        <th class="table-row-left">Perkiraan Tiba</th>
                        <th class="table-row-left">Tanggal Tiba</th>
                        <th class="table-row-left">Lokasi Stacking</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        if (isset($container['NO_CONT'])) {
                            for($i=0; $i < count($container['NO_CONT']) ; $i++) { ?>
                            <?php
                                if ($container['STATUS_CONT_SPPB'][$i]!="") {
                                    $STATUS_CONT_SPPB = "Tidak bisa ditransaksi";
                                } else{
                                     $STATUS_CONT_SPPB = "Bisa ditransaksi";
                                }

                                if ($container['STATUS_KARANTINA'][$i]!="") {
                                    $STATUS_KARANTINA = "Bukan Karantina";
                                } else{
                                     $STATUS_KARANTINA = "Karantina";
                                }
                            ?>

                            <?php print_r($container['STATUS_CONT_SPPB'][$i]) ?>
                            <tr>
                                <td><input type="checkbox" name="cek_cont[]"  value="<?=$container['NO_CONT'][$i]."~".$container['OWNER'][$i]."~".$container['LINE_ID'][$i]."~".$container['VESSEL_ID'][$i]."~".$container['VOYAGE_NO'][$i]?>" class="clonecheckbox" <?=$container['STATUS_CONT_SPPB']=="" ? 'disabled': ""?>></td>
                                <td class="table-row-left"><?=$STATUS_CONT_SPPB?></td>
                                <td class="table-row-left"><?=$STATUS_KARANTINA?></td>
                                <td class="table-row-left"><?=$container['NO_CONT'][$i]?></td>
                                <td class="table-row-left"><?=$container['VOYAGE_NO'][$i]?></td>
                                <td class="table-row-left"><?=$container['ETA'][$i]?></td>
                                <td class="table-row-left"><?=$container['ATA'][$i]?></td>
                                <td class="table-row-left"><?=$container['LS_LOCATION_TYPE'][$i]?></td>
                            </tr> 
                           <?php }

                        }
                       

                        ?>
                   
                    </tbody>
                    </table>

                    <fieldset>
                        <div class="col-md-12 offset-md-4">
                        <div class="form-group row">
                            <label for="paid" class="col-sm-1 col-form-label">Paid Thru <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input id="paid" name="paid" type="text" placeholder="..." required class="form-control" value="">
                            </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <br><br>
                        <div class="form-group form-actions">
                            <div class="col-md-12 offset-md-5">
                                <button type="submit" class="btn btn-info btn-loading" id="BtnSend" data-toggle="tooltip" title="Process Form" name="button" value="send" ><i class="fa fa-arrow-right" ></i>
                                    Proses Proforma Invoice
                                </button>
                                <!-- <button type="reset" class="btn btn-warning" data-toggle="tooltip" title="Clear Form"><i class="fa fa-repeat"></i> Reset</button> -->
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
           </div>   
        </div>
    </div>
</div>
<?php } ?>
</div>
<script type="text/javascript">
    $('#select-all').click(function(event) {
        var $that = $(this);
        $(':checkbox').not("[disabled]").each(function() {
            this.checked = $that.is(':checked');
        });
    });

    $("#paid").datepicker({
            autoclose: true
    });

    // function cek() {

    // var selectedCheckbox = $('input:checkbox:checked.clonecheckbox').map(function () {
    //       return this.value;
    // }).get(); 

    
    // }

    $("#BtnSend").click(function (e) {
            e.preventDefault();
            var id_reqdo_header = $("#id_reqdo_header").val();
            var cust_id = $("#cust_id").val();
            var paid = $("#paid").val();
            var selectedCheckbox = $('input:checkbox:checked.clonecheckbox').map(function () {
                return this.value;
            }).get();
            console.log(selectedCheckbox);

            if($('.clonecheckbox:checked').length == 0) {
                swal({type: 'error',title:'','text':'Silahkan Pilih Container'});
                return false;
            } 

            $('#formContainer').parsley().validate();
            if ($('#formContainer').parsley().isValid()){
                ShowLoadingWait(true);
                $.ajax({
                   url: '<?php echo site_url('C_spp/getProforma');?>',
                        data: 'id_reqdo_header='+id_reqdo_header+'&cust_id='+cust_id+'&paid='+paid+'&cek_cont='+selectedCheckbox,
                        type: 'POST',
                        dataType: 'JSON',
                    success: function (data) {
                        if (data.STATUS === "TRUE") {
                            ShowLoadingWait(true);
                            setTimeout(function () {
                                location.href = base_url + 'index.php/C_spp/getFormProforma/'+id_reqdo_header;
                            }, 3000);
                        }
                        else{
                           swal({type: 'error',
                                title:'',
                                'text':data.MESSAGE
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
            } else{
                ShowLoadingWait(false);
                    console.log(' tidak valid');
            }
            return false;
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


    

</script>