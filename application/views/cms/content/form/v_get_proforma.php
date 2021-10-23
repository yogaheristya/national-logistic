<div class="container-fluid">
<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-20">
                <a href="<?= site_url('home') ?>" style="font-size: 12;font-family: Roboto"><b><i class="ti-arrow-left"></i>&nbsp;&nbsp; Back</b></a>
        </div>     	
        <h4 class="page-title" style="color: red;">Proforma</h4>
    </div>
</div>
<?php if ($proforma['STATUS']!="TRUE") {?>
<div class="row">
    <div class="col-sm-12">
        <p><?=$proforma['MESSAGE']?></p>
    </div>
</div>
    
<?php } else {?>

<div class="row">
	<div class="col-sm-12">
		<div class="card m-b-20">
    		<div class="card-body">
    			<fieldset>
                        <div class="form-group row">
                            <label for="shipper_name" class="col-sm-2 col-form-label">Nama Pelanggan </label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$proforma['DETAIL_BILLING']['CUST_NAME']?></label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label">Nomor Dokumen</label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$proforma['DETAIL_BILLING']['NO_DOCUMENT']?></label>
                        </div>
                        <div class="form-group row">
                            <label for="consignee_name" class="col-sm-2 col-form-label">NPWP</label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$proforma['DETAIL_BILLING']['NPWP']?></label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label">Nomor Invoice </label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$proforma['DETAIL_BILLING']['INVOICE_NO']?></label>
                        </div>
                        <div class="form-group row">
                            <label for="notify_name" class="col-sm-2 col-form-label">ID Kapal </label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$proforma['DETAIL_BILLING']['SHIP_ID']?></label>
                            <label for="npwp_notify" class="col-sm-2 col-form-label">Tipe Transaksi</label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$proforma['DETAIL_BILLING']['TRANSACTIONS_NAME']?></label>
                        </div>
                        <div class="form-group row">
                            <label for="notify_name" class="col-sm-2 col-form-label">Nomor DO</label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$proforma['DETAIL_BILLING']['DO_NBR']?></label>
                            <label for="npwp_notify" class="col-sm-2 col-form-label">Pajak Pembayaran</label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$proforma['DETAIL_BILLING']['PPN']?> </label>
                        </div>   
                </fieldset>
                <button onclick="myFunction('<?=$proforma['DETAIL_BILLING']['LINK_PRO']?>')">View Proforma</button>
    		</div>
    	</div>
		<!-- <object width="400px" height="400px" data="http://ebilling.tpkkoja.co.id/NiBS/invoice/getProforma.php?proforma=202003121202"></object> -->
		<!-- <iframe src="<?=$proforma['DETAIL_BILLING']['LINK_PRO']?>" style="width: 100%;height: 100%;border: none;"></iframe> -->
	</div>
</div>
<?php } ?>


</div>

<script>
function myFunction(url) {
 var link = url;
 window.open(link, '_blank');
}
</script>