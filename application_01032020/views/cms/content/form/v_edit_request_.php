<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-20" id="back_btn">
                <a href="<?= site_url('home') ?>" style="font-size: 12;font-family: Roboto"><b><i class="ti-arrow-left"></i>&nbsp;&nbsp; Back</b></a>
            </div>
            <h4 class="page-title"><?php echo $page_title;?></h4>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <form class="form-horizontal" method="post" enctype="multipart/form-data" name="request_do" id="request_do" role="form" data-parsley-validate>
                    <input type="hidden" name="id_header" value="<?= $request["id_reqdo_header"] ?>" id="id_header">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Request Details</legend>
                        <br>
                        <div class="form-group row">
                            <label for="requestor_role" class="col-sm-2 col-form-label">Requestor <span style="color: red">*</span></label>
                            <div class="col-sm-3" style="display: flex;">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="input[status_requestor]" id="cargo" onclick="CheckRequestor();"
                                            <?=$request['status_requestor']=="1" ? "checked" : ""?> value="1">Cargo Owner
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="input[status_requestor]" id="freight" onclick="CheckRequestor();"
                                            <?=$request['status_requestor']=="2" ? "checked" : ""?> value="2">Freight Forwarder
                                    </label>
                                </div>
                            </div>
                            <?php
                            if ($request['filepath_requestor']!="") { ?>
                                <div class="col-md-1">
                                    <a href="https://apps1.insw.go.id/upload/requestor/<?=$request['filepath_requestor']?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a>
                                    <input type="hidden" id="cek_file_forwarder" value="<?=$request['filepath_requestor']?>">
                                    <!-- <a href="<?=base_url('/'.$request['filepath_requestor'])?>" target="_blank" class="btn btn-info btn-sm" role="button">Show file</a> -->
                                </div>
                            <?php }?>
                            <div class="col-md-3" style="display: flex;align-self: center;">
                                <input type="file" name="filepath_requestor" id="forwarder_file" style="display:none;" class="form-control-file" accept="application/pdf"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="npwp" class="col-sm-2 col-form-label">NPWP <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input id="npwp" name="input[npwp_requestor]" type="text" placeholder="..." required class="form-control" value="<?= $request["npwp_requestor"] ?>" readonly>
                            </div>
                            <label for="nib" class="col-sm-1 col-form-label">NIB <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="input[nib_requestor]" required parsley-type="text" class="form-control" id="nib" placeholder="" value="<?= $request["nib_requestor"] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="requestor_name" class="col-sm-2 col-form-label">Requestor Name <span style="color: red">*</span></label>
                            <div class="col-sm-3">
                                <input id="requestor_name" name="input[nama_requestor]" type="text" placeholder="" required class="form-control" value="<?= $request["nama_requestor"] ?>" readonly>
                            </div>
                            <label for="requestor_address" class="col-sm-2 col-form-label">Requestor Address <span style="color: red">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="input[alamat_requestor]" required parsley-type="text" class="form-control" id="requestor_address" placeholder="" value="<?= $request["alamat_requestor"] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping" class="col-sm-2 col-form-label">Shipping Line <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control select2" name="shipping_line" required id="shipping_line" placeholder="Please Select" value="<?= $request["kd_shippingline"] ?>">
                                    <option></option>
                                    <?php
                                    foreach ($shipping as $ship ) {?>
                                        <option value="<?php echo $ship['kode'];?>">
                                            <?php echo $ship['kode'].' - '.$ship['uraian'] ; ?>
                                        </option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <label for="exp_date" class="col-sm-2 col-form-label">DO Expired Date Request</label>
                            <div class="col-sm-2">
                                <input type="text" name="input[tglexpreqdo]" parsley-type="text" class="form-control" id="exp_date" placeholder="" value="<?= $request["tglexpdo"] ?>">
                            </div>
                            <label for="Payment" class="col-sm-2 col-form-label">Term of Payment <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control select2" name="input[carabayar]" placeholder="Please Select" id="carabayar" >
                                    <option></option>
                                    <option value="1">Cash</option>
                                    <option value="2">Credit</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bill" class="col-sm-2 col-form-label">Bill of Lading No <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="input[nobl]" data-parsley-required="true" class="form-control" id="bill" placeholder="Please insert your BL number" value="<?= $request["nobl"] ?>">
                            </div>
                            <label for="bill_date" class="col-sm-1 col-form-label">BL Date <span
                                    style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="input[tglbl]" required parsley-type="date" class="form-control date" id="bill_date" placeholder="..." value="<?= $request["tglreqbl"] ?>">
                            </div>
                            <label for="BL Type" class="col-sm-1 col-form-label">BL Type <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control select2" name="input[jenisbl]" placeholder="Please Select" id="jenisbl" required onchange="type_bl()">
                                    <option></option>
                                    <option value="1">Original</option>
                                    <option value="2">Seawaybill</option>
                                    <option value="3">Telex</option>
                                </select>
                            </div>
                            <?php
                            if ($request['filepath_bl']!="") { ?>
                                <div class="col-md-1">
                                    <a href="https://apps1.insw.go.id/upload/bl/<?=$request['filepath_bl'] ?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a>
                                    <!-- <a href="<?=base_url('/'.$request['filepath_bl'])?>" target="_blank" class="btn btn-info btn-sm" role="button">Show file</a> -->
                                    <input type="hidden" id="filepath_bl" value="<?=$request['filepath_bl'] ?>">
                                </div>
                            <?php }?>
                            <div class="col-md-1" style="display: flex;align-self: center;">
                                <input type="file" name="filepath_bl" id="bl_file" class="form-control-file" accept="application/pdf"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="vessel" class="col-sm-2 col-form-label">Vessel <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="input[nama_vessel]" data-parsley-required="true" class="form-control" id="vessel" value="<?= $request["nama_vessel"]?>">
                            </div>
                            <label for="voyage" class="col-sm-1 col-form-label">Voyage Number <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="input[nomor_voyage]" data-parsley-required="true" class="form-control" id="voyage" value="<?= $request["nomor_voyage"] ?>" maxlength="10">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Parties Details</legend>
                        <div class="form-group row">
                            <label for="shipper_name" class="col-sm-2 col-form-label">Shipper Name <span style="color: red">*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="input[nama_consignor]" required parsley-type=" text" class="form-control" id="requestor_address" placeholder="i.e  PT. SARANA JAYA" value="<?= $request["nama_consignor"] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="consignee_name" class="col-sm-2 col-form-label">Consignee Name <span style="color: red">*</span></label>
                            <div class="col-sm-3">
                                <input id="consignee_name" name="input[nama_consignee]" type="text" placeholder="i.e  PT. SARANA JAYA" required class="form-control" value="<?= $request["nama_consignee"] ?>">
                            </div>
                            <label for="consignee_npwp" class="col-sm-1 col-form-label">NPWP <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="input[npwp_consignee]" required parsley-type="text" class="form-control" id="npwp_consignee" placeholder="i.e  483281234567810" maxlength="15" value="<?= $request["npwp_consignee"] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="notify_name" class="col-sm-2 col-form-label">Notify Party Name <span style="color: red">*</span></label>
                            <div class="col-sm-3">
                                <input id="notify_name" name="input[nama_notifyparty]" type="text" placeholder="i.e  PT. SARANA JAYA" required class="form-control" value="<?= $request["nama_notifyparty"] ?>">
                            </div>
                            <label for="npwp_notify" class="col-sm-1 col-form-label">NPWP</label>
                            <div class="col-sm-2">
                                <input type="text" name="input[npwp_notifyparty]"  class="form-control" id="npwp_notify" placeholder="i.e  483281234567810" maxlength="15" value="<?= $request["npwp_notifyparty"] ?>">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Container Detail</legend>
                        <div class="form-group">
                            <div class="col-md-1" style="display: flex; justify-content: flex-start;">
                                <button class="btn btn-sm btn-success" type="button" id="addrow">Add</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <th width="20%">Container No</th>
                                    <th width="20%">Seal No</th>
                                    <th width="20%">Size & Type</th>
                                    <th width="20%">Gross Weight</th>
                                    <th width="20%">Ownership</th>
                                    <th width="15%">Action</th>
                                </thead>
                                <tbody id="tbody_container">
                                    <?php
                                    if ($container!="") { 
                                        $no = 0;
                                    ?>
                                    <?php
                                        $no=0;
                                        foreach ($container as $con) { ?>
                                            <tr>
                                                <td width="10%">
                                                    <input type="text" id="container_no" name="no_container[]" class="form-control" data-error="This field is required" placeholder="" value="<?= $con["no_container"] ?>" />
                                                </td>
                                                <td>
                                                    <input type="text" id="seal_no" name="seal_no[]" class="form-control" data-error="This field is required" placeholder="" value="<?= $con["no_seal"] ?>" />
                                                </td>
                                                <td>
                                                    <select class="form-control select2" name="size_type[]"
                                                        id="size_type<?=$no?>">
                                                        <option></option>
                                                        <?php
                                                        foreach ($sizeType as $size_type) {?>
                                                            <option value="<?php echo $size_type['ukcont']."-".$size_type['kdtipecont'];?>">
                                                                <?php echo $size_type['ukcont'].' - '.$size_type['kdtipecont'] ; ?>
                                                            </option>
                                                        <?php }?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="form-group row" style="margin-bottom: 0 !important;">
                                                        <div class="col-sm-8">
                                                            <input id="gross_weight" name="gross_weight[]" type="text" placeholder="..." required class="form-control" value="<?= $con["gross_weight"] ?>">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <select class="form-control select2" name="gross_weight_satuan[]" id="gross_weight_satuan<?=$no?>">
                                                                <option></option>
                                                                <option value="TNE">TNE</option>
                                                                <option value="KGM">KGM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> <select class="form-control select2" name="ownership[]" id="ownership<?=$no?>">
                                                        <option></option>
                                                        <option value="1">COC</option>
                                                        <option value="2">SOC</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="button" class="delete_container btn btn-sm btn-danger" value="Delete">
                                                </td>
                                            </tr>
                                            <?php 
                                            $no++;
                                        }
                                    }else { ?>
                                        <tr>
                                            <td width="10%">
                                                <input type="text" id="container_no" name="no_container[]" class="form-control" data-error="This field is required" required value="" placeholder="" />
                                            </td>
                                            <td>
                                                <input type="text" id="seal_no" name="seal_no[]" class="form-control" data-error="This field is required" value="" placeholder="" required />
                                            </td>
                                            <td>
                                                <select class="form-control select2" name="size_type[]">
                                                    <option></option>
                                                    <?php
                                                    foreach ($sizeType as $size_type) {?>
                                                        <option value="<?php echo $size_type['ukcont']."-".$size_type['kdtipecont'];?>">
                                                            <?php echo $size_type['ukcont'].' - '.$size_type['kdtipecont'] ; ?>
                                                        </option>
                                                    <?php }?>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="form-group row" style="margin-bottom: 0 !important;">
                                                    <div class="col-sm-8">
                                                        <input id="gross_weight" name="gross_weight[]" type="text" placeholder="..." required class="form-control">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-control select2" name="gross_weight_satuan[]">
                                                            <option></option>
                                                            <option value="TNE">TNE</option>
                                                            <option value="KGM">KGM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td> <select class="form-control select2" name="ownership[]">
                                                    <option></option>
                                                    <option value="1">COC</option>
                                                    <option value="2">SOC</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-success" type="button" id="addrow">Add</button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Place / Location</legend>
                        <div class="form-group row">
                            <label for="shipper_name" class="col-sm-2 col-form-label">Place of Loading <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control select2" id="negara">
                                    <option></option>
                                    <?php
                                    foreach ($negara as $ngr ) {?>
                                        <option value="<?php echo $ngr['kdedi'];?>">
                                            <?php echo $ngr['kdedi'].' - '.$ngr['uredi'] ; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="shipper_name" class="col-sm-2 col-form-label">Port of Loading <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control select2" name="input[pel_muat]" id="pel_ln" required>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipper_name" class="col-sm-2 col-form-label">Place of Discharge <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control select2" name="input[pel_bongkar]" id="select_discharge" required>
                                    <option></option>
                                    <?php
                                    foreach ($pel_dn['pelabuhan'] as $pel) {?>
                                        <option value="<?php echo $pel['kdedi'];?>">
                                            <?php echo $pel['kdedi'].' - '.$pel['uredi'] ; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label for="shipper_name" class="col-sm-2 col-form-label">Place of Destination <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control select2" name="input[pel_tujuan]" id="select_destination" required>
                                    <option></option>
                                    <?php
                                    foreach ($pel_dn['pelabuhan'] as $pel) {?>
                                        <option value="<?php echo $pel['kdedi'];?>">
                                            <?php echo $pel['kdedi'].' - '.$pel['uredi'] ; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border" id="payment">
                        <legend class="scheduler-border">Payment Detail</legend>
                        <div class="form-group">
                            <div class="col-md-1" style="display: flex;justify-content: flex-start;">
                                <input type="button" class="btn btn-sm btn-success" value="Add" id="add_payment">
                            </div>
                        </div>
                        <?php
                        if ($payment!="") {
                            $no=0;
                            foreach ($payment as $pay) { 
                                $invoice_date = $pay["tgl_dok"] ? date('m/d/Y',strtotime($pay["tgl_dok"])) : '';
                        ?>
                                <div class="form-group row">
                                    <label class="col-sm-1 col-form-label" for="invoice_no">Invoice No<span class="text-danger">*</span></label>
                                    <div class="col-md-1">
                                        <input type="text" id="invoice_no" name="invoice_no[]" class="form-control" required="true" data-error="This field is required" placeholder="" value="<?= $pay["no_dok"] ?>" />
                                    </div>
                                    <label class="col-sm-0 col-form-label " for="invoice_date">Date</label>
                                    <div class="col-md-1">
                                        <input type="text" id="invoice_date" name="invoice_date[]" class="form-control date"  placeholder="" value="<?= $invoice_date ?>" />
                                    </div>
                                    <label class="col-sm-0 col-form-label " for="select_total">Total</label>
                                    <div class="col-md-1">
                                        <select class="form-control select2" name="kd_val[]" id="kd_val<?php echo $no ;?>">
                                            <option></option>
                                            <option>IDR</option>
                                            <option>USD</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" id="total" name="nilai[]" class="form-control" placeholder="" value="<?= $pay["nilai"] ?>" />
                                    </div>
                                    <label class="col-sm-0 col-form-label" for="bank">Bank A/C</label>
                                    <div class="col-md-1">
                                        <select class="form-control select2" name="kd_bank[]" id="kd_bank<?php echo $no ;?>">
                                            <option></option>
                                            <?php
                                            foreach ($bank as $bnk) {?>
                                                <option value="<?php echo $bnk['kd_bank'];?>">
                                                    <?php echo $bnk['nm_bank'] ; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" id="telpon" name="no_rekening[]" class="form-control" placeholder="" value="<?= $pay["no_rekening"] ?>" />
                                    </div>
                                    <?php
                                    if ($pay['filepath_buktibayar'] != "") { ?>
                                        <div class="col-md-1" style="display: block;align-self: center;text-align: center;">
                                            <a href="https://apps1.insw.go.id/upload/payment/<?=$pay['filepath_buktibayar'] ?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a>
                                           <!--  <a href="<?=base_url('/'.$pay['filepath_buktibayar'])?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a> -->
                                        </div>
                                    <?php }?>
                                    <div class="col-md-1" style="display: flex; align-self: center;">
                                        <input type="hidden" name="file_buktibayar[]" value="<?=$pay['filepath_buktibayar']?>">
                                        <input type="hidden" name="file_buktibayar_meta[]" value="<?=$pay['filepath_buktibayar_meta']?>">
                                        <input type="file" name="filepath_buktibayar[]" id="filepayment" value="<?=$pay['filepath_buktibayar']?>" accept="application/pdf"/>
                                    </div>
                                    <div class="col-md-1" style="display: block; align-self: right; text-align: right;">
                                        <input class="delete_payment btn btn-sm btn-danger" type="button" id="delete_payment" value="Delete">
                                    </div>
                                </div>
                                <?php 
                                $no+=1;
                            }
                        }
                        ?>

                    </fieldset>
                    <fieldset class="scheduler-border" id="document">
                        <legend class="scheduler-border">Supporting Document</legend>
                        <div class="form-group">
                            <div class="col-md-1" style="display: flex;justify-content: flex-start;">
                                <input type="button" class="btn btn-sm btn-success" value="Add" id="add_document">
                            </div>
                        </div>
                        <?php
                        if ($document!="") {
                            $no=0;
                            foreach ($document as $doc) { 
                                $date_dok = $doc["tgl_dok"] ? date('m/d/Y',strtotime($doc["tgl_dok"])) : '';
                        ?>
                        <div class="form-group row">
                            <label for="type" class="col-sm-1 col-form-label">Doc Type</label>
                            <div class="col-sm-2">
                                <select class="form-control select2" name="jenis_dok[]" required="true" data-error="This field is required" id="jenis_dok<?php echo $no ;?>">
                                    <option>-</option>
                                    <option value="4">Letter of Indemnity (LOI)</option>
                                    <option value="5">Surat Peminjaman Kontainer</option>
                                    <option value="6">ID Penerima Kuasa</option>
                                    <option value="9">Lainnya</option>
                                </select>
                            </div>
                            <label for="No_document" class="col-sm-1 col-form-label" style="text-align: center;">Doc No<span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="no_dok[]" parsley-type="text" class="form-control" id="bill" placeholder="" value="<?= $doc["no_dok"] ?>" required>
                            </div>
                            <label for="bill_date" class="col-sm-1 col-form-label" style="text-align: center;">Date</label>
                            <div class="col-sm-2">
                                <input type="text" name="tgl_dok[]" parsley-type="date" class="form-control date" id="dok_date" placeholder="mm/dd/yyyy" value="<?= $date_dok ?>" required>
                            </div>
                            <?php
                                if ($doc['filepath_dok'] != "") { ?>
                                    <div class="col-md-1" style="display: block;align-self: center;text-align: center;">
                                        <a href="https://apps1.insw.go.id/upload/dokumen/<?=$doc['filepath_dok'] ?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a>
                                       <!--  <a href="<?=base_url('/'.$pay['filepath_dok'])?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a> -->
                                    </div>
                            <?php }?>
                            <div class="col-md-1" style="display: flex; align-self: center;">
                                <input type="hidden" name="file_dok[]" value="<?=$doc['filepath_dok']?>">
                                <input type="hidden" name="file_dok_meta[]" value="<?=$doc['filepath_dok_meta']?>">
                                <input type="file" name="filepath_dok[]" id="filepath_dok" class="form-control-file" class="form-control" value="<?=$doc['filepath_dok'] ?>" accept="application/pdf"/>
                            </div>
                            <div class="col-md-1" style="display: block;align-self: center;text-align: center;">
                                <input type="button" class="delete_document btn btn-sm btn-danger" value="Delete" id="delete_document">
                            </div>
                            <br>
                        </div>
                         <?php 
                                $no+=1;
                            }
                        }
                        ?>
                    </fieldset>
                    </fieldset>
                    <br>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"></legend>
                        <br><br>
                        <div class="form-group form-actions">
                            <div class="col-md-12 offset-md-5">
                                <button type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing..." class="btn btn-info btn-loading" id="Btn<?= $btn ?>" data-toggle="tooltip" title="Process Form" name="button" value="edit"><i class="fa fa-save"></i> Save
                                </button>
                                <a type="button" class="btn btn-warning" data-toggle="tooltip" title="Cancel" href="<?=base_url()?>"><i class="fa fa-close"></i> Cancel</a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
<!-- end container -->
<script type="text/javascript">
    // function CheckBayar(){
    //     if (document.getElementById("carabayar").value=="1") {
    //         document.getElementById('invoice_no').setAttribute('required','required');
    //         document.getElementById('invoice_date').setAttribute('required','required');
    //         document.getElementById('kd_val').setAttribute('required','required');
    //         document.getElementById('kd_bank').setAttribute('required','required');
    //         document.getElementById('total').setAttribute('required','required');
    //         document.getElementById('no_rekening').setAttribute('required','required');
    //         document.getElementById('filepayment').setAttribute('required','required');
    //     } else {
    //         document.getElementById('invoice_no').removeAttribute('required');
    //         document.getElementById('invoice_date').removeAttribute('required');
    //         document.getElementById('kd_val').removeAttribute('required');
    //         document.getElementById('kd_bank').removeAttribute('required');
    //         document.getElementById('total').removeAttribute('required');
    //         document.getElementById('no_rekening').removeAttribute('required');
    //         document.getElementById('filepayment').removeAttribute('required');
    //     }
    // }

    function type_bl(){
        var jenisbl = document.getElementById("jenisbl").value;
        var str,
            element = document.getElementById('filepath_bl');
            if (element != null) {
                str = element.value;
            }
            else {
                str = null;
            }
        
        if (jenisbl == "1" && str == null ) {
            document.getElementById('bl_file').setAttribute('required','required');
        } else {
            document.getElementById('bl_file').removeAttribute('required');
        }
    }


    function CheckRequestor() {
        var file_forwarder,
            element_forwarder = document.getElementById('cek_file_forwarder');
            if (element_forwarder != null) {
                file_forwarder = element_forwarder.value;
            }
            else {
                file_forwarder = null;
            }
        if (document.getElementById('freight').checked) {
            document.getElementById('forwarder_file').style.display = 'block';
            if (file_forwarder== null) {
                document.getElementById("forwarder_file").setAttribute('required','required');
            }else{
                document.getElementById("forwarder_file").removeAttribute('required');
            }
            
        }else { 
            document.getElementById('forwarder_file').style.display = 'none';
            document.getElementById("forwarder_file").removeAttribute('required');
        }
    }

    CheckRequestor();

    $(document).ready(function(){
        $('.select2').select2({
            placeholder: "Please Select"
        });

        $("input[name='nilai[]']").on({
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() { 
                formatCurrency($(this), "blur");
            }
        });

        function formatNumber(n) {
            // format number 1000000 to 1,234,567
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }

        function formatCurrency(input, blur) {
            // appends $ to value, validates decimal side
            // and puts cursor back in right position.
          
            // get input value
            var input_val = input.val();
          
            // don't validate empty input
            if (input_val === "") { return; }
          
            // original length
            var original_len = input_val.length;

            // initial caret position 
            var caret_pos = input.prop("selectionStart");
            
            // check for decimal
            if (input_val.indexOf(".") >= 0) {
                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);
                
                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                    right_side += "00";
                }
                
                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val = left_side + "." + right_side;
            }else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = formatNumber(input_val);
                input_val = input_val;
                
                // final formatting
                if (blur === "blur") {
                    input_val += ".00";
                }
            }
            // send updated string to input
            input.val(input_val);

            // put caret back in the right position
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }

        var counter = 0;
        $("#addrow").on("click", function () {
            var nomer = counter+2;
            var newRow = $("<tr>");
            var cols = "";

            
            cols += '<td><input type="text" id="container_no" name="no_container[]" class="form-control"  data-error="This field is required" value="" placeholder="i.e MSKU123456"/></td>';
            cols += '<td><input type="text" id="seal_no" name="seal_no[]" class="form-control"  data-error="This field is required" value="" placeholder="i.e SEAL123456"/></td>';
            cols += '<td><select class="form-control select2" name="size_type[]"><option></option>';
                <?php
                    foreach ($sizeType as $size_type) {?>
                        cols+='<option value="<?php echo $size_type['ukcont']."-".$size_type['kdtipecont'];?>"> <?php echo $size_type['ukcont'].' - '.$size_type['kdtipecont'] ; ?></option>';
                <?php }?>
            cols += '</select></td>';
            cols += '<td><div class="form-group row" style="margin-bottom: 0 !important;"><div class="col-sm-8"><input id="gross_weight" name="gross_weight[]" type="text" placeholder="i.e 100.01" required class="form-control"></div><div class="col-sm-4"><select class="form-control select2" name="gross_weight_satuan[]"><option></option><option>TNE</option><option>KGM</option></select></div></div></td>';
            cols += '<td><select class="form-control select2" name="ownership[]"><option></option><option value="1">COC</option><option value="2">SOC</option></select></td>';
            cols += '<td align="center"><input type="button" class="delete_container btn btn-sm btn-danger"  value="Delete"></td>';
            newRow.append(cols);
            $("#tbody_container").append(newRow);
            $('.select2').select2({
                placeholder: "Please Select"
            });
            counter++;
        });

        $("#tbody_container").on("click", ".delete_container", function (event) {
            $(this).closest("tr").remove();       
            counter -= 1
        });

        var count = 0;
        $("#add_payment").on("click", function () {
            var newPay = $("#payment");
            var cols = "";
            cols += '<div class="form-group row">';
            cols += '<label class="col-sm-1 col-form-label" for="invoice_no" >Invoice No</label><div class="col-md-1"><input type="text" id="invoice_no" name="invoice_no[]" class="form-control"  value="" placeholder="" required="true" data-error="This field is required" /></div>';
            cols += '<label class="col-sm-0 col-form-label " for="invoice_date" >Date</label><div class="col-md-1"><input type="text" id="invoice_date" name="invoice_date[]" class="form-control date"   placeholder="mm/dd/yyyy" required/></div>';
            cols += '<label class="col-sm-0 col-form-label " for="total">Total</label><div class="col-md-1"><select class="form-control select2" name="kd_val[]" required><option></option><option>IDR</option><option>USD</option></select></div>';
            cols += '<div class="col-md-2"><input type="text" id="invoice_total" name="nilai[]" class="form-control" value="" placeholder="" data-parsley-trigger="input" data-type="currency" required/></div>';
            cols += '<label class="col-sm-0 col-form-label" for="kode_bank">Bank A/C</label><div class="col-md-1"><select class="form-control select2" name="kd_bank[]" required><option></option>';
             <?php
              foreach ($bank as $bnk) {?>
                    cols += '<option value="<?php echo $bnk['kd_bank'];?>"> <?php echo $bnk['nm_bank'] ; ?></option>';
            <?php }?> 
            cols += '</select></div>';       
            cols += '<div class="col-md-2"><input type="text" id="rekening" name="no_rekening[]" class="form-control"  data-error="This field is required" value="" placeholder=""/></div>';
            cols += '<div class="col-md-1" style="display: flex; align-self: center;"><input type="file" name="filepath_buktibayar[]" id="filepayment"/></div>';
            cols += '<div class="col-md-1" style="display: block;align-self: center;text-align: right;"><input class="delete_payment btn btn-sm btn-danger" type="button" id="delete_payment" value="Delete"/></div>';
            cols += '</div>';
            
            newPay.append(cols);
            $('.select2').select2({
                placeholder: "Please Select"
            });

            $(".date").datepicker({
                autoclose: true
            });

            $("input[name='nilai[]']").on({
                keyup: function() {
                    formatCurrency($(this));
                },
                blur: function() { 
                    formatCurrency($(this), "blur");
                }
            });
            count++;
        });

        $("#payment").on("click", ".delete_payment", function (event) {
            $(this).closest("div.form-group").remove();
        });

        $("#add_document").on("click", function () {
            var newDoc = $("#document");
            var cols = "";
            cols += '<div class="form-group row">';
            cols += '<label for="type" class="col-sm-1 col-form-label">Doc Type</label><div class="col-sm-2"><select class="form-control select2" name="jenis_dok[]" required><option></option><option value="4">Letter of Indemnity (LOI)</option><option value="5">Suarat Peminjaman Kontainer</option><option value="6">ID Penerima Kuasa</option><option value="9">Lainnya</option></select></div>';
            cols += '<label for="No_document" class="col-sm-1 col-form-label" style="text-align: center;">Doc No</label><div class="col-sm-2"><input type="text" name="no_dok[]" class="form-control" id="bill" placeholder="" required></div>';
            cols += '<label for="bill_date" class="col-sm-1 col-form-label" style="text-align: center;">Date</label><div class="col-sm-2"><input type="text" name="tgl_dok[]"  class="form-control date" id="bill_date" placeholder="mm/dd/yyyy" required></div>';
            cols += '<div class="col-md-2" style="display: flex; align-self: center;"><input type="file" name="filepath_dok[]" id="filepath_dok" class="form-control-file" required/></div>';
            cols += '<div class="col-md-0" style="display: block;align-self: center;text-align: center;"><input class="delete_document btn btn-sm btn-danger" type="button" id="delete_document" value="Delete"/></div>';
            cols += '</div>';
            newDoc.append(cols);
            $('.select2').select2({
                placeholder: "Please Select"
            });

            $(".date").datepicker({
                autoclose: true
            });

            count++;
        });

        $("#document").on("click", ".delete_document", function (event) {
            $(this).closest("div.form-group").remove();       
        });


        $("input[name='nilai[]']").on({
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() { 
                formatCurrency($(this), "blur");
            }
        });
    });
</script>
<script type="text/javascript">
    var dateToday = new Date();
    var tomorrow = new Date();
    tomorrow.setDate(dateToday.getDate()+1);
    $(function () {
        $('.date').datepicker({
            autoclose: true
        });
        $('#request_do').parsley();

        $("#exp_date").datepicker({
            autoclose: true,
            startDate: tomorrow
        });
    });

    $(document).ready(function() {



        $('#negara').change(function(){ 
            var id=$(this).val();
            $.ajax({
                url : "<?php echo site_url('C_cargo/getDataPelln');?>",
                method : "POST",
                data : {id_negara: id},
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    html += '<option></option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].kdedi+'>'+data[i].kdedi+"-"+data[i].uredi+'</option>';
                    }
                    $('#pel_ln').html(html);
                    $("#pel_ln").val('<?php echo $request["pel_muat"]?>').attr('selected', true).trigger("change");
                }
            });
            return false;
        });



        $.expr[':'].textEquals = $.expr[':'].textEquals || $.expr.createPseudo(function(arg) {
            let newArg = arg;
        
            if (arg.match(/[-()]/))
                newArg = arg.replace(/[^\w\s]/gi, '');
                return function(elem) {
                    let newElem = $(elem).text();
                    if ($(elem).text().match(/[-()]/))
                        newElem = $(elem).text().replace(/[^\w\s]/gi, '');
                    return newElem.match("^" + newArg + "$");
                };
        });
        $("#select_discharge").val('<?php echo $request["pel_bongkar"]?>').attr('selected', true).trigger("change");
        $("#select_destination").val('<?php echo $request["pel_tujuan"]?>').attr('selected', true).trigger("change");
        $("#shipping_line").val('<?php echo $request["kd_shippingline"]?>').attr('selected', true).trigger("change");
        $("#carabayar").val('<?php echo $request["carabayar"]?>').attr('selected', true).trigger("change");
        $("#jenisbl").val('<?php echo $request["jenisbl"]?>').attr('selected', true).trigger("change");
        $("#negara").val('<?php echo substr($request["pel_muat"], 0,2)?>').attr('selected', true).trigger("change");

        
        
        <?php $i=0; foreach($payment as $pay){ ?>
            $("#kd_val<?=$i?>").val('<?php echo $pay["kd_val"]?>').attr('selected', true).trigger("change");
            $("#kd_bank<?=$i?>").val('<?php echo $pay["kd_bank"]?>').attr('selected', true).trigger("change");
        <?php $i++;} ?>

         <?php $i=0; foreach($container as $con){ ?>
            $("#gross_weight_satuan<?=$i?>").val('<?php echo $con["gross_weight_satuan"]?>').attr('selected', true).trigger("change");
            $("#ownership<?=$i?>").val('<?php echo $con["ownership"]?>').attr('selected', true).trigger("change");
            $("#size_type<?=$i?>").val('<?php echo $con["uk_container"]."-".$con["tipe_container"]?>').attr('selected', true).trigger("change");
        <?php $i++;} ?>

        <?php $i=0; foreach($document as $doc){ ?>
            $("#jenis_dok<?=$i?>").val('<?php echo $doc["jenis_dok"]?>').attr('selected', true).trigger("change");
        <?php $i++;} ?>

        

        $("#BtnEdit").click(function (e) {
            e.preventDefault();
            var form = $('#request_do')[0];
            var formData = new FormData(form);
            formData.append('action', 'edit');
            
            //validasi if freight forwarder, required LOI
            var requestor = $('input[name="input[status_requestor]"]:checked').val();
            var values = document.getElementsByName("jenis_dok[]"),i;
            var ownership = document.getElementsByName("ownership[]"),i;
            var carabayar = $('#carabayar').val();;
            var payment = document.getElementsByName("invoice_no[]"),i;

            
            for (i = 0; i < values.length; i++) {
                var x = 0;
                if (values[i].value == "4") {
                    var cek_loi = x + 1; 
                }   
            }

            for (i = 0; i < ownership.length; i++) {
                var y = 0;
                if (ownership[i].value == "1") {
                    var cek_ownership = y + 1; 
                }   
            }

            for (i = 0; i < values.length; i++) {
                var z = 0;
                if (values[i].value == "5") {
                    var cek_spk = z + 1; 
                }   
            }

            for (i = 0; i < payment.length; i++) {
                var j = 0;
                if (payment[i].value != "") {
                    var cek_payment = j + 1; 
                }   
            }


            if (requestor == '2' && cek_loi == undefined) {
                alert('Please Entry Letter of Indemnity');
                return false;
            }

            if (cek_ownership != undefined  && cek_spk == undefined) {
                alert('Please Entry Surat Peminjaman Container');
                return false;
            }
            
            if (carabayar == "1"  && cek_payment == undefined) {
                swal({type: 'error',
                            title:'',
                            'text':'Please Entry Payment Detail'
                        });
                return false;
            }

            $('#request_do').parsley().validate();

            if ($('#request_do').parsley().isValid()){
                $.ajax({
                    url: '<?php echo site_url('C_cargo/editRequest');?>',
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
    });

    function validate_loi(){
        var requestor = document.getElementsByName("input[status_requestor]")[0].value;
        throw new Error(requestor);
    }

    function validate_spk(){
        alert('spk');
        return false;
    }
</script>