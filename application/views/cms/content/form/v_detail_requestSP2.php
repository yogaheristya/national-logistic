<div class="container-fluid">
<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-20">
                <a href="<?= site_url('home') ?>" style="font-size: 12;font-family: Roboto"><b><i class="ti-arrow-left"></i>&nbsp;&nbsp; Back</b></a>
        </div>     	
        <h4 class="page-title" style="color: red;">Detail</h4>
    </div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="card m-b-20">
    		<div class="card-body">
    			<fieldset class="scheduler-border">
                    <legend class="scheduler-border">Request Details</legend>
                        <div class="form-group row">
                            <label for="shipper_name" class="col-sm-2 col-form-label">Nama Request </label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$detail['header']['noreqdo']?></label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label">Tanggal Request</label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$detail['header']['tglreqdo']?></label>
                        </div>
                        <div class="form-group row">
                            <label for="consignee_name" class="col-sm-2 col-form-label">NPWP</label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$detail['header']['npwp_requestor']?></label>
                            <!-- <label for="consignee_npwp" class="col-sm-2 col-form-label">Nomor Invoice </label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$detail['header']['INVOICE_NO']?></label> -->
                        </div>
                        <!-- <div class="form-group row">
                            <label for="notify_name" class="col-sm-2 col-form-label">ID Kapal </label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$detail['header']['SHIP_ID']?></label>
                            <label for="npwp_notify" class="col-sm-2 col-form-label">Tipe Transaksi</label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$detail['header']['TRANSACTIONS_NAME']?></label>
                        </div> -->
                        <div class="form-group row">
                            <label for="notify_name" class="col-sm-2 col-form-label">Nomor DO</label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$detail['header']['nodo']?></label>
                            <label for="npwp_notify" class="col-sm-2 col-form-label">Shipping Line</label>
                            <label class="col-form-label">:</label>
                            <label for="consignee_npwp" class="col-sm-2 col-form-label"><?=$detail['header']['kd_shippingline']?> </label>
                        </div>   
                </fieldset>
                <button onclick="myProforma('<?=$detail['header']['url_proforma']?>')" style="color:blue;cursor:pointer;" >View Proforma</button>
                <button onclick="myInvoice('<?=$detail['header']['url_invoice']?>')" style="color:blue;cursor:pointer;" >View Invoice</button>
    		</div>
    	</div>
		<!-- <object width="400px" height="400px" data="http://ebilling.tpkkoja.co.id/NiBS/invoice/getProforma.php?proforma=202003121202"></object> -->
		<!-- <iframe src="<?=$proforma['DETAIL_BILLING']['LINK_PRO']?>" style="width: 100%;height: 100%;border: none;"></iframe> -->
	</div>
</div>


</div>

<script>
function myProforma(url) {
 var link = url;
 window.open(link, '_blank');
}
function myInvoice(url) {
 var link = url;
 window.open(link, '_blank');
}
</script>