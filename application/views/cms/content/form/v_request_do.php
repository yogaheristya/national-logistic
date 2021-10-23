<div class="container-fluid">

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-20">
                <a href="<?= site_url('home') ?>" style="font-size: 12;font-family: Roboto"><b><i class="ti-arrow-left"></i>&nbsp;&nbsp; Back</b></a>
            </div>
            <h4 class="page-title"><?php echo $page_title; ?></h4>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <form class="form-horizontal" method="post" enctype="multipart/form-data" name="request_do" id="request_do" role="form" data-parsley-validate>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Request Details</legend>
                        <br>
                        <div class="form-group row">
                            <label for="requestor_role" class="col-sm-2 col-form-label">Requestor <span style="color: red">*</span></label>
                            <div class="col-sm-3" style="display: flex;">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="input[status_requestor]" id="cargo" onclick="CheckRequestor();" value="1" required>Cargo Owner
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="input[status_requestor]" id="freight" onclick="CheckRequestor();" value="2" required>Freight Forwarder
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3" style="display: flex;align-self: center;">
                                <input type="file" name="filepath_requestor" id="forwarder_file" style="display:none;" class="form-control-file" accept="application/pdf" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="npwp" class="col-sm-2 col-form-label">NPWP <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input id="npwp" name="input[npwp_requestor]" type="text" placeholder="..." required class="form-control" value="<?= $request["npwp"] ?>" readonly>
                            </div>
                            <label for="nib" class="col-sm-1 col-form-label">NIB <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <?php
                                if ($request['nib'] != "") { ?>
                                    <input type="text" name="input[nib_requestor]" required parsley-type="text" class="form-control" id="nib" placeholder="" maxlength="13" value="<?= $request['nib'] ?>" readonly>
                                <?php } else { ?>
                                    <input type="text" name="input[nib_requestor]" required parsley-type="text" class="form-control" id="nib" placeholder="" maxlength="13">
                                <?php }
                                ?>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="requestor_name" class="col-sm-2 col-form-label">Requestor Name <span style="color: red">*</span></label>
                            <div class="col-sm-3">
                                <input id="requestor_name" name="input[nama_requestor]" type="text" placeholder="" required class="form-control" value="<?= $request["name"] ?>" readonly>
                            </div>
                            <label for="requestor_address" class="col-sm-2 col-form-label">Requestor Address <span style="color: red">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="input[alamat_requestor]" required parsley-type="text" class="form-control" id="requestor_address" placeholder="" value="<?= $request["alamat"] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping" class="col-sm-2 col-form-label">Shipping Line <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control select2" name="shipping_line" required id="ship" placeholder="Please Select">
                                    <option></option>
                                    <?php foreach ($shipping as $ship) : ?>
                                        <option value="<?php echo $ship['kode']; ?>">
                                            <?php echo strtoupper($ship['kode']) . ' - ' . strtoupper($ship['uraian']); ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <label for="exp_date" class="col-sm-2 col-form-label">DO Expired Date Request <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="input[tglexpreqdo]" parsley-type="text" class="form-control" id="exp_date" placeholder="mm/dd/yyyy" required>
                            </div>
                            <label for="Payment" class="col-sm-2 col-form-label">Term of Payment <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control select2" name="input[carabayar]" placeholder="Please Select" id="select_bayar" onchange="CheckBayar()" required>
                                    <option></option>
                                    <option value="1">Cash</option>
                                    <option value="2">Credit</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bill" class="col-sm-2 col-form-label">Bill of Lading No <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="input[nobl]" data-parsley-required="true" class="form-control" id="bill" placeholder="Please insert your BL number">
                            </div>
                            <label for="bill_date" class="col-sm-1 col-form-label">BL Date <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="input[tglbl]" required parsley-type="date" class="form-control date" id="bill_date" placeholder="mm/dd/yyyy">
                            </div>
                            <label for="BL Type" class="col-sm-1 col-form-label">BL Type <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control select2" name="input[jenisbl]" placeholder="Please Select" id="bl_tipe" onchange="type_bl()" required>
                                    <option></option>
                                    <option value="1">Original</option>
                                    <option value="2">Seawaybill</option>
                                    <option value="3">Telex</option>
                                </select>
                            </div>
                            <div class="col-md-2" style="display: flex;align-self: center;">
                                <input type="file" name="filepath_bl" id="bl_file" class="form-control-file" accept="application/pdf" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vessel" class="col-sm-2 col-form-label">Vessel <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="input[nama_vessel]" data-parsley-required="true" class="form-control" id="vessel" placeholder="Please insert vessel name">
                            </div>
                            <label for="voyage" class="col-sm-1 col-form-label">Voyage Number <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="input[nomor_voyage]" data-parsley-required="true" class="form-control" id="voyage" placeholder="Please insert voyage number" maxlength="10">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Parties Details</legend>
                        <div class="form-group row">
                            <label for="shipper_name" class="col-sm-2 col-form-label">Shipper Name <span style="color: red">*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="input[nama_consignor]" required parsley-type="text" class="form-control" id="requestor_address" placeholder="i.e  PT. SARANA JAYA">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="consignee_name" class="col-sm-2 col-form-label">Consignee Name <span style="color: red">*</span></label>
                            <div class="col-sm-3">
                                <input id="consignee_name" name="input[nama_consignee]" type="text" placeholder="i.e  PT. SARANA JAYA" required class="form-control">
                            </div>
                            <label for="consignee_npwp" class="col-sm-1 col-form-label">NPWP <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="input[npwp_consignee]" required parsley-type="text" class="form-control" id="npwp_consignee" placeholder="i.e  483281234567810" maxlength="15">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="notify_name" class="col-sm-2 col-form-label">Notify Party Name <span style="color: red">*</span></label>
                            <div class="col-sm-3">
                                <input id="notify_name" name="input[nama_notifyparty]" type="text" placeholder="i.e  PT. SARANA JAYA" required class="form-control">
                            </div>
                            <label for="npwp_notify" class="col-sm-1 col-form-label">NPWP</label>
                            <div class="col-sm-2">
                                <input type="text" name="input[npwp_notifyparty]" class="form-control" id="npwp_notify" placeholder="i.e  483281234567810" maxlength="15">
                            </div>
                        </div>
                    </fieldset>


                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">
                            <div id="judulcontainer"> Container Detail </div>
                        </legend>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="jeniscargo" class="col-sm-2 col-form-label">Jenis Cargo<span style="color: red">*</span></label>
                                <div class="col-sm-2">
                                    <div class="col-md-12">
                                        <select class="form-control select2" name="input[cargo_type]" placeholder="Please Select" id="select_jenis" required>
                                            <option value="1" selected>Container</option>
                                            <option value="3">Non-Container</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Container -->

                        <div id="tabel_container" class="col-md-12">
                            <input type="hidden" name="numRows[]" id="numRows" value="0">

                            <table class="table table-bordered">
                                <thead>
                                    <th width="5%">No</th>
                                    <th width="20%">Container No <span style="color: red">*</span></th>
                                    <th width="20%">Seal No <span style="color: red">*</span></th>
                                    <th width="20%">Size & Type <span style="color: red">*</span></th>
                                    <th width="20%">Gross Weight <span style="color: red">*</span></th>
                                    <th width="20%">Ownership <span style="color: red">*</span></th>
                                    <th width="15%">Action</th>
                                </thead>
                                <tbody id="tbody_container">
                                    <tr>
                                        <input type="hidden" name="numCont[]" value="0">
                                        <td style="text-align: center;">1</td>
                                        <td width="10%">
                                            <input type="text" id="container_no" name="no_container[]" class="form-control" data-error="This field is required" value="" placeholder="i.e MSKU123456" required />
                                        </td>
                                        <td>
                                            <div id="rowSeal_00">
                                                <div class="form-group row" style="margin-bottom: 0 !important;">
                                                    <div class="col-sm-9">
                                                        <input type="text" id="seal_no_0" name="seal_no_0[]" class="form-control" data-error="This field is required" value="" placeholder="i.e SEAL123456" required />
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-sm btn-success" type="button" id="addseal_0" onclick="addseal(0)">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="numRowsChild_0" id="numRowsChild_0" value="0">
                                        </td>
                                        <td>
                                            <select class="form-control select2" id="size_type" name="size_type[]" required>
                                                <option></option>
                                                <?php
                                                foreach ($sizeType as $size_type) { ?>
                                                    <option value="<?php echo $size_type['ukcont'] . "-" . $size_type['kdtipecont']; ?>">
                                                        <?php echo $size_type['ukcont'] . ' - ' . $size_type['kdtipecont']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="form-group row" style="margin-bottom: 0 !important;">
                                                <div class="col-sm-8">
                                                    <input placeholder="i.e 100.01" id="gross_weight" name="gross_weight[]" type="text" class="form-control" data-parsley-trigger="keyup" data-parsley-type="number" required>
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-control select2" id="gross_weight_satuan" name="gross_weight_satuan[]" required>
                                                        <option></option>
                                                        <option value="TNE">TNE</option>
                                                        <option value="KGM">KGM</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <select class="form-control select2" id="ownership" name="ownership[]" required>
                                                <option></option>
                                                <option value="1">COC</option>
                                                <option value="2">SOC</option>
                                            </select>
                                        </td>
                                        <td align="center">
                                            <button class="btn btn-sm btn-success" type="button" id="addrow">Add</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        <!-- Non Container -->

                        <div id="tabel_noncontainer" style="display: none;" class="col-md-12">
                            <input type="hidden" name="numRows2[]" id="numRows2" value="0">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="vertical-align:middle" width="5%" rowspan="2">No</th>
                                        <th style="vertical-align:middle" width="20%" rowspan="2">Description of Goods<span style="color: red">*</span></th>
                                        <th width="15%" rowspan="1" colspan="2">Package<span style="color: red">*</span></th>
                                        <th width="15%" rowspan="1" colspan="2">Gross Weight<span style="color: red">*</span></th>
                                        <th width="15%" rowspan="1" colspan="2">Measurement<span style="color: red">*</span></th>
                                        <th style="vertical-align:middle" width="5%" rowspan="2">Action</th>
                                    </tr>
                                    <tr>
                                        <th width="10%">Quantity</th>
                                        <th width="10%">Satuan</th>
                                        <th width="10%">Quantity</th>
                                        <th width="10%">Satuan</th>
                                        <th width="10%">Volume</th>
                                        <th width="10%">Satuan</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_non_container">
                                    <tr><input type="hidden" name="numNonCont[]" value="0">
                                        <td style="text-align: center;">1</td>
                                        <td width="10%"><textarea class="form-control" id="goods_desc" name="goods_desc[]" rows="2" spellcheck="false" placeholder="Max 1024 Characters" maxlength="1024"></textarea></td>
                                        <td>
                                            <div class="form-group row" style="margin-bottom: 0 !important;">
                                                <div class="col-sm-12">
                                                    <input placeholder="i.e 100" id="package_qty" name="package_qty[]" type="text" class="form-control" data-parsley-trigger="keyup" data-parsley-type="digits">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row" style="margin-bottom: 0 !important;">
                                                <div class="col-sm-12"><select class="form-control" name="package_satuan[]" id="package_satuan">
                                                        <option value="PCE">PCE</option>
                                                        <option value="Unit">Unit</option>
                                                    </select></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row" style="margin-bottom: 0 !important;">
                                                <div class="col-sm-12"><input placeholder="i.e 100.01" id="gross_weight_non" name="gross_weight_non[]" type="text" class="form-control" data-parsley-trigger="keyup" data-parsley-type="number"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row" style="margin-bottom: 0 !important;">
                                                <div class="col-sm-12"><select class="form-control" id="gross_weight_non_satuan" name="gross_weight_non_satuan[]" required aria-hidden="true">
                                                        <option value="TNE">TNE</option>
                                                        <option value="KGM">KGM</option>
                                                    </select></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row" style="margin-bottom: 0 !important;">
                                                <div class="col-sm-12"><input placeholder="i.e 100.01" id="measurement_qty" name="measurement_qty[]" type="text" class="form-control" data-parsley-trigger="keyup" data-parsley-type="number"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row" style="margin-bottom: 0 !important;">
                                                <div class="col-sm-12"><select class="form-control" id="measurement_satuan" name="measurement_satuan[]" required aria-hidden="true">
                                                        <option value="M3">M3</option>
                                                    </select></div>
                                            </div>
                                        </td>
                                        <td align="center"><button class="btn btn-sm btn-success" type="button" id="addrow_non">Add</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </fieldset>


                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Place / Location</legend>
                        <div class="form-group row">
                            <label for="shipper_name" class="col-sm-2 col-form-label">Place of Loading <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control select2" id="negara" required>
                                    <option></option>
                                    <?php
                                    foreach ($negara as $ngr) { ?>
                                        <option value="<?php echo $ngr['kdedi']; ?>">
                                            <?php echo $ngr['kdedi'] . ' - ' . $ngr['uredi']; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <label for="shipper_name" class="col-sm-2 col-form-label">Port of Loading <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control select2" name="input[pel_muat]" id="pel_ln" required></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipper_name" class="col-sm-2 col-form-label">Place of Discharge <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control select2" name="input[pel_bongkar]" required>
                                    <option></option>
                                    <?php
                                    foreach ($pel_dn['pelabuhan'] as $pel) { ?>
                                        <option value="<?php echo $pel['kdedi']; ?>">
                                            <?php echo $pel['kdedi'] . ' - ' . $pel['uredi']; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <label for="shipper_name" class="col-sm-2 col-form-label">Place of Destination <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <select class="form-control select2" name="input[pel_tujuan]" required>
                                    <option></option>
                                    <?php
                                    foreach ($pel_dn['pelabuhan'] as $pel) { ?>
                                        <option value="<?php echo $pel['kdedi']; ?>">
                                            <?php echo $pel['kdedi'] . ' - ' . $pel['uredi']; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border" id="payment">
                        <legend class="scheduler-border">Payment Detail</legend>
                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label" for="telpon">Invoice No</label>
                            <div class="col-md-1">
                                <input type="text" id="invoice_no" name="invoice_no[]" class="form-control invoice_no" value="" placeholder="" />
                            </div>
                            <label class="col-sm-0 col-form-label " for="telpon">Date</label>
                            <div class="col-md-1">
                                <input type="text" id="invoice_date" name="invoice_date[]" class="form-control date invoice_date" value="" placeholder="mm/dd/yyyy" />
                            </div>
                            <label class="col-sm-0 col-form-label " for="select total">Total</label>
                            <div class="col-md-1">
                                <select class="form-control select2 kd_val" name="kd_val[]" id="kd_val">
                                    <option></option>
                                    <option value="IDR">IDR</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="text" id="total" name="nilai[]" class="form-control total" placeholder="" data-parsley-trigger="input" data-type="currency" />
                            </div>
                            <label class="col-sm-0 col-form-label" for="bank">Bank A/C</label>
                            <div class="col-md-1">
                                <select class="form-control select2 kd_bank" name="kd_bank[]" id="kd_bank">
                                    <option></option>
                                    <?php
                                    foreach ($bank as $bnk) { ?>
                                        <option value="<?php echo $bnk['kd_bank']; ?>"> <?php echo $bnk['nm_bank']; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="no_rekening[]" class="form-control no_rekening" data-error="This field is required" value="" placeholder="" id="no_rekening" />
                            </div>
                            <div class="col-md-1" style="display: flex; align-self: center;">
                                <input type="file" name="filepath_buktibayar[]" id="filepayment" class="filepayment" accept="application/pdf" />
                            </div>
                            <div class="col-md-1" style="display: block; align-self: center; text-align: right;">
                                <input type="button" class="btn btn-sm btn-success" value="Add" id="add_payment">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border" id="document">
                        <legend class="scheduler-border">Supporting Document</legend>
                        <div class="form-group row">
                            <label for="type" class="col-sm-1 col-form-label">Doc Type</label>
                            <div class="col-sm-2">
                                <select class="form-control select2" name="jenis_dok[]" onchange="supporting()" id="jenis_dok">
                                    <option></option>
                                    <option>-</option>
                                    <!-- <option value="1">Surat Kuasa</option>
                                    <option value="2">Invoice</option>
                                    <option value="3">Bukti Bayar</option> -->
                                    <option value="4">Letter of Indemnity (LOI)</option>
                                    <option value="5">Surat Peminjaman Kontainer</option>
                                    <option value="6">ID Penerima Kuasa</option>
                                    <option value="10">VIN</option>
                                    <option value="9">Lainnya</option>
                                </select>
                            </div>
                            <label for="No_document" class="col-sm-1 col-form-label" style="text-align: center;">Doc No</label>
                            <div class="col-sm-2">
                                <input type="text" name="no_dok[]" parsley-type="text" class="form-control" id="doc_no" placeholder="">
                            </div>
                            <label for="bill_date" class="col-sm-1 col-form-label" style="text-align: center;">Date</label>
                            <div class="col-sm-2">
                                <input type="text" name="tgl_dok[]" parsley-type="date" class="form-control date" id="doc_date" placeholder="mm/dd/yyyy">
                            </div>
                            <div class="col-md-2" style="display: flex; align-self: center;">
                                <input type="file" name="filepath_dok[]" id="filepath_dok" class="form-control-file" class="form-control" />
                            </div>
                            <div class="col-md-0" style="display: block;align-self: center;text-align: center;">
                                <input type="button" class="btn btn-sm btn-success" value="Add" id="add_document">
                            </div>
                            <br>
                        </div>
                    </fieldset>
                    </fieldset>
                    <br>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"></legend>
                        <br><br>
                        <div class="form-group form-actions">
                            <div class="col-md-12 offset-md-5">
                                <button type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing..." class="btn btn-info btn-loading" id="Btn<?= $btn ?>" data-toggle="tooltip" title="Process Form" name="button" value="save"><i class="fa fa-save"></i>
                                    <?= $btn; ?>
                                </button>
                                <button type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing..." class="btn btn-info btn-loading" id="BtnRequest" data-toggle="tooltip" title="Process Form" name="button" value="send"><i class="fa fa-arrow-right"></i>
                                    Request
                                </button>
                                <button type="reset" class="btn btn-warning" data-toggle="tooltip" title="Clear Form"><i class="fa fa-repeat"></i> Reset</button>
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
    function CheckBayar() {
        if (document.getElementById("select_bayar").value == "1") {
            $('.invoice_no').prop('required', true);
            $('.invoice_date').prop('required', true);
            $('.kd_val').prop('required', true);
            $('.kd_bank').prop('required', true);
            $('.total').prop('required', true);
            $('.no_rekening').prop('required', true);
            $('.filepayment').prop('required', true);
        } else {
            $('.invoice_no').prop('required', false);
            $('.invoice_date').prop('required', false);
            $('.kd_val').prop('required', false);
            $('.kd_bank').prop('required', false);
            $('.total').prop('required', false);
            $('.no_rekening').prop('required', false);
            $('.filepayment').prop('required', false);
        }
    }

    function supporting() {
        var jenisdok = document.getElementById("jenis_dok").value;
        if (jenisdok != "-") {
            document.getElementById('doc_no').setAttribute('required', 'required');
            document.getElementById('doc_date').setAttribute('required', 'required');
            document.getElementById('filepath_dok').setAttribute('required', 'required');
        } else {
            document.getElementById('doc_no').removeAttribute('required');
            document.getElementById('doc_date').removeAttribute('required');
            document.getElementById('filepath_dok').removeAttribute('required');
        }
    }

    function type_bl() {
        if (document.getElementById("bl_tipe").value == "1") {
            document.getElementById('bl_file').setAttribute('required', 'required');
        } else {
            document.getElementById('bl_file').removeAttribute('required');
        }
    }

    function CheckRequestor() {
        if (document.getElementById('freight').checked) {
            document.getElementById('forwarder_file').style.display = 'block';
            document.getElementById('forwarder_file').setAttribute('required', 'required');
        } else {
            document.getElementById('forwarder_file').style.display = 'none';
            document.getElementById("forwarder_file").required = false;
        }
    }

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
        if (input_val === "") {
            return;
        }

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
        } else {
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

    function addseal(rowNum) {
        var number = $("#numRowsChild_" + rowNum).val();
        var nextNum = parseInt(number) + 1;
        $('<div id="rowSeal_' + rowNum + nextNum + '"><div class="form-group row div_seal" style="margin-bottom: 0 !important;margin-top: 10px;">' +
            '<div class="col-sm-9">' +
            '<input type="text" id="seal_no_' + rowNum + nextNum + '" name="seal_no_' + rowNum + '[]" class="form-control" data-error="This field is required" value="" placeholder="i.e SEAL123456" required /></div>' +
            '<div class="col-sm-1">' +
            '<button class="btn btn-sm btn-warning" type="button" id="removeSeal_' + rowNum + nextNum + '" ' +
            'onclick="$(\'#rowSeal_' + rowNum + nextNum + '\').remove();">x</button>' +
            '</div></div></div>').insertBefore("#numRowsChild_" + rowNum);

        $("#numRowsChild_" + rowNum).val(nextNum);
    }

    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Please Select"
        });

        $('#request_do').parsley();

        var counter = 0;
        $("#addrow").on("click", function() {

            var serial = $("#numRows").val();
            var nextSerial = parseInt(serial) + 1;
            var numContainer = $("#numCont").val();
            var nextNum = parseInt(numContainer) + 1;
            var nomer = counter + 2;
            var noCol = counter + 1;
            var newRow = $("<tr>");
            var cols = "";



            cols += '<td style="text-align: center;">' + nomer + '</td>';
            cols += '<td><input type="text" id="container_no" name="no_container[]" class="form-control"  data-error="This field is required" value="" placeholder="i.e MSKU123456"/></td>';
            cols += '<td><div id="rowSeal_' + nextSerial + '"><div class="form-group row div_seal" style="margin-bottom: 0 !important;" ><div class="col-sm-9"><input type="text" id="seal_no_' + nextSerial + '" name="seal_no_' + nextSerial + '[]" class="form-control" data-error="This field is required" value="" placeholder="i.e SEAL123456" required /></div><div class="col-sm-1"><button class="btn btn-sm btn-success" type="button" id="addseal_' + nextSerial + '" onclick="addseal(' + nextSerial + ')">+</button></div></div></div><input type="hidden" name="numRowsChild_' + nextSerial + '" id="numRowsChild_' + nextSerial + '" value="1"></td>';
            cols += '<td><select class="form-control select2" name="size_type[]"><option></option>';
            <?php
            foreach ($sizeType as $size_type) { ?>
                cols += '<option value="<?php echo $size_type['ukcont'] . "-" . $size_type['kdtipecont']; ?>"> <?php echo $size_type['ukcont'] . ' - ' . $size_type['kdtipecont']; ?></option>';
            <?php } ?>
            cols += '</select></td>';
            cols += '<td><div class="form-group row" style="margin-bottom: 0 !important;"><div class="col-sm-8"><input id="gross_weight" name="gross_weight[]" type="text" placeholder="i.e 100.01" required class="form-control"></div><div class="col-sm-4"><select class="form-control select2" name="gross_weight_satuan[]"><option></option><option>TNE</option><option>KGM</option></select></div></div></td>';
            cols += '<td><select class="form-control select2" name="ownership[]"><option></option><option value="1">COC</option><option value="2">SOC</option></select></td>';
            cols += '<td align="center"><input type="button" class="delete_container btn btn-sm btn-danger"  value="Delete"></td>';
            cols += '<input type="hidden" name="numCont[]" value="' + noCol + '">';
            newRow.append(cols);
            $("#numRows").val(nextSerial);
            $("#tbody_container").append(newRow);
            $('.select2').select2({
                placeholder: "Please Select"
            });

            console.log(nextSerial);
            counter++;
        });

        //non-container
        var counter2 = 0;
        $("#addrow_non").on("click", function() {
            var serial2 = $("#numRows2").val();
            var nextSerial2 = parseInt(serial2) + 1;
            var numNonContainer = $("#numNonCont").val();
            var nextNum2 = parseInt(numNonContainer) + 1;
            var nomer2 = counter2 + 2;
            var noCol2 = counter2 + 1;
            var newRow2 = $("<tr>");
            var cols2 = "";

            cols2 += '<td style="text-align: center;">' + nomer2 + '</td>';
            cols2 += '<td width="10%"><textarea class="form-control" id="goods_desc" name="goods_desc[]" rows="2" spellcheck="false" placeholder="Max 1024 Characters" maxlength="1024"></textarea></td>';
            cols2 += '<td><div class="form-group row" style="margin-bottom: 0 !important;"><div class="col-sm-12"><input placeholder="i.e 100" id="package_qty" name="package_qty[]" type="text" class="form-control" required></div></div></td>';
            cols2 += '<td><div class="form-group row" style="margin-bottom: 0 !important;"><div class="col-sm-12"><select class="form-control" name="package_satuan[]" required><option value="PCE">PCE</option><option value="Unit">Unit</option></select></div></div></td>';
            cols2 += '<td><div class="form-group row" style="margin-bottom: 0 !important;"><div class="col-sm-12"><input placeholder="i.e 100.01" id="gross_weight_non" name="gross_weight_non[]" type="text" class="form-control" required></div></div></td>';
            cols2 += '<td><div class="form-group row" style="margin-bottom: 0 !important;"><div class="col-sm-12"><select class="form-control" name="gross_weight_non_satuan[]" required aria-hidden="true"><option value="TNE">TNE</option><option value="KGM">KGM</option></select></div></div></td>';
            cols2 += '<td><div class="form-group row" style="margin-bottom: 0 !important;"><div class="col-sm-12"><input placeholder="i.e 100.01" id="measurement_qty" name="measurement_qty[]" type="text" class="form-control" required></div> </div></td>';
            cols2 += '<td><div class="form-group row" style="margin-bottom: 0 !important;"><div class="col-sm-12"><select class="form-control" name="measurement_satuan[]" required aria-hidden="true"><option value="M3">M3</option></select></div></div></td>';
            cols2 += '<td align="center"><input type="button" class="delete_non_container btn btn-sm btn-danger"  value="Delete"></td>';
            cols2 += '<input type="hidden" name="numNonCont[]" value="' + noCol2 + '">';

            newRow2.append(cols2);
            $("#numRows2").val(nextSerial2);
            $("#tbody_non_container").append(newRow2);
            $('.select2').select2({
                placeholder: "Please Select"
            });
            counter2++;
        });

        $("#tbody_container").on("click", ".delete_container", function(event) {
            $(this).closest("tr").remove();
            counter -= 1
        });

        $("#tbody_non_container").on("click", ".delete_non_container", function(event) {
            $(this).closest("tr").remove();
            counter2 -= 1
        });

        $(".seal").on("click", ".removeseal", function(event) {
            $(this).closest("div .div_seal").remove();
        });

        var count = 0;
        $("#add_payment").on("click", function() {
            var newPay = $("#payment");
            var cols = "";
            if (document.getElementById("select_bayar").value == "1") {
                cols += '<div class="form-group row">';
                cols += '<label class="col-sm-1 col-form-label" for="invoice_no" >Invoice No</label><div class="col-md-1"><input type="text" id="invoice_no" name="invoice_no[]" class="form-control invoice_no"   value="" placeholder="" required/></div>';
                cols += '<label class="col-sm-0 col-form-label " for="invoice_date" >Date</label><div class="col-md-1"><input type="text" id="invoice_date" name="invoice_date[]" class="form-control date invoice_date"   placeholder="mm/dd/yyyy" required/></div>';
                cols += '<label class="col-sm-0 col-form-label " for="total">Total</label><div class="col-md-1"><select class="form-control select2 kd_val" name="kd_val[]" required><option></option><option>IDR</option><option>USD</option></select></div>';
                cols += '<div class="col-md-2"><input type="text" id="invoice_total" name="nilai[]" class="form-control total" value="" placeholder="" data-parsley-trigger="input" data-type="currency" required/></div>';
                cols += '<label class="col-sm-0 col-form-label" for="kode_bank">Bank A/C</label><div class="col-md-1"><select class="form-control select2 kd_bank" name="kd_bank[]" required><option></option>';
                <?php
                foreach ($bank as $bnk) { ?>
                    cols += '<option value="<?php echo $bnk['kd_bank']; ?>"> <?php echo $bnk['nm_bank']; ?></option>';
                <?php } ?>
                cols += '</select></div>';
                cols += '<div class="col-md-2"><input type="text" id="rekening" name="no_rekening[]" class="form-control no_rekening"  data-error="This field is required" value="" placeholder="" required/></div>';
                cols += '<div class="col-md-1" style="display: flex; align-self: center;"><input type="file" name="filepath_buktibayar[]" id="filepayment" class="filepayment" accept="application/pdf" required/></div>';
                cols += '<div class="col-md-1" style="display: block;align-self: center;text-align: right;"><input class="delete_payment btn btn-sm btn-danger" type="button" id="delete_payment" value="Delete"/></div>';
                cols += '</div>';
            } else {
                cols += '<div class="form-group row">';
                cols += '<label class="col-sm-1 col-form-label" for="invoice_no" >Invoice No</label><div class="col-md-1"><input type="text" id="invoice_no" name="invoice_no[]" class="form-control invoice_no"   value="" placeholder=""/></div>';
                cols += '<label class="col-sm-0 col-form-label " for="invoice_date" >Date</label><div class="col-md-1"><input type="text" id="invoice_date" name="invoice_date[]" class="form-control date invoice_date"   placeholder="mm/dd/yyyy"/></div>';
                cols += '<label class="col-sm-0 col-form-label " for="total">Total</label><div class="col-md-1"><select class="form-control select2 kd_val" name="kd_val[]"><option></option><option>IDR</option><option>USD</option></select></div>';
                cols += '<div class="col-md-2"><input type="text" id="invoice_total" name="nilai[]" class="form-control total" value="" placeholder="" data-parsley-trigger="input" data-type="currency"/></div>';
                cols += '<label class="col-sm-0 col-form-label" for="kode_bank">Bank A/C</label><div class="col-md-1"><select class="form-control select2 kd_bank" name="kd_bank[]"><option></option>';
                <?php
                foreach ($bank as $bnk) { ?>
                    cols += '<option value="<?php echo $bnk['kd_bank']; ?>"> <?php echo $bnk['nm_bank']; ?></option>';
                <?php } ?>
                cols += '</select></div>';
                cols += '<div class="col-md-2"><input type="text" id="rekening" name="no_rekening[]" class="form-control no_rekening"  data-error="This field is required" value="" placeholder=""/></div>';
                cols += '<div class="col-md-1" style="display: flex; align-self: center;"><input type="file" name="filepath_buktibayar[]" id="filepayment" class="filepayment" accept="application/pdf"/></div>';
                cols += '<div class="col-md-1" style="display: block;align-self: center;text-align: right;"><input class="delete_payment btn btn-sm btn-danger" type="button" id="delete_payment" value="Delete"/></div>';
                cols += '</div>';
            }

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



        $("#payment").on("click", ".delete_payment", function(event) {
            $(this).closest("div.form-group").remove();
        });

        $("#add_document").on("click", function() {
            var newDoc = $("#document");
            var cols = "";
            cols += '<div class="form-group row">';
            cols += '<label for="type" class="col-sm-1 col-form-label">Doc Type</label><div class="col-sm-2"><select class="form-control select2" name="jenis_dok[]" required><option></option><option value="4">Letter of Indemnity (LOI)</option><option value="5">Surat Peminjaman Kontainer</option><option value="6">ID Penerima Kuasa</option><option value="10">VIN</option><option value="9">Lainnya</option></select></div>';
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

        $("#document").on("click", ".delete_document", function(event) {
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

    $('select[id=select_jenis]').change(function() {
        var selectedJenis = $(this).val();
        if (selectedJenis == 1) {
            $('#judulcontainer').empty().append("Container Detail")
            $('#tabel_container').show();
            $('#tabel_noncontainer').hide();

            document.getElementById('container_no').setAttribute('required', 'required');
            document.getElementById('seal_no_0').setAttribute('required', 'required');
            document.getElementById('size_type').setAttribute('required', 'required');
            document.getElementById('gross_weight').setAttribute('required', 'required');
            document.getElementById('gross_weight_satuan').setAttribute('required', 'required');
            document.getElementById('ownership').setAttribute('required', 'required');

            document.getElementById('goods_desc').removeAttribute('required');
            document.getElementById('package_qty').removeAttribute('required');
            document.getElementById('package_satuan').removeAttribute('required');
            document.getElementById('gross_weight_non').removeAttribute('required');
            document.getElementById('gross_weight_non_satuan').removeAttribute('required');
            document.getElementById('measurement_qty').removeAttribute('required');
            document.getElementById('measurement_satuan').removeAttribute('required');

        } else if (selectedJenis == 3) {
            $('#judulcontainer').empty().append("Cargo Detail")
            $('#tabel_container').hide();
            $('#tabel_noncontainer').show();

            document.getElementById('goods_desc').setAttribute('required', 'required');
            document.getElementById('package_qty').setAttribute('required', 'required');
            document.getElementById('package_satuan').setAttribute('required', 'required');
            document.getElementById('gross_weight_non').setAttribute('required', 'required');
            document.getElementById('gross_weight_non_satuan').setAttribute('required', 'required');
            document.getElementById('measurement_qty').setAttribute('required', 'required');
            document.getElementById('measurement_satuan').setAttribute('required', 'required');

            document.getElementById('container_no').removeAttribute('required');
            document.getElementById('seal_no_0').removeAttribute('required');
            document.getElementById('size_type').removeAttribute('required');
            document.getElementById('gross_weight').removeAttribute('required');
            document.getElementById('gross_weight_satuan').removeAttribute('required');
            document.getElementById('ownership').removeAttribute('required');


        }
    });
</script>

<script type="text/javascript">
    var dateToday = new Date();
    var tomorrow = new Date();
    tomorrow.setDate(dateToday.getDate() + 1);
    $(function() {
        $(".date").datepicker({
            autoclose: true
        });

        $('#request_do').parsley();

        $("#exp_date").datepicker({
            autoclose: true,
            startDate: tomorrow
        });
    });

    $(document).ready(function() {
        $('#negara').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('C_cargo/getDataPelln'); ?>",
                method: "POST",
                data: {
                    id_negara: id
                },
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    html += '<option></option>';
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].kdedi + '>' + data[i].kdedi + " - " + data[i].uredi + '</option>';
                    }
                    $('#pel_ln').html(html);
                }
            });
            return false;
        });

        $("#BtnRequest").click(function(e) {
            e.preventDefault();
            var form = $('#request_do')[0];
            var formData = new FormData(form);
            formData.append('action', 'send');

            var requestor = $('input[name="input[status_requestor]"]:checked').val();
            var jenis_cargo = $('#select_jenis').val();
            var values = document.getElementsByName("jenis_dok[]"),
                i;
            var ownership = document.getElementsByName("ownership[]"),
                i;


            for (i = 0; i < values.length; i++) {
                var x = 0;
                if (values[i].value == "4") {
                    var cek_loi = x + 1;
                }
            }

            for (i = 0; i < values.length; i++) {
                var x = 0;
                if (values[i].value == "10") {
                    var cek_vin = x + 1;
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

            if (requestor == '2' && cek_loi == undefined) {
                swal({
                    type: 'error',
                    title: '',
                    'text': 'Please Entry Letter of Indemnity'
                });
                return false;
            }

            if (cek_ownership != undefined && cek_spk == undefined) {
                swal({
                    type: 'error',
                    title: '',
                    'text': 'Please Entry Surat Peminjaman Container'
                });
                return false;
            }

            if (jenis_cargo == '3' && cek_vin == undefined) {
                swal({
                    type: 'error',
                    title: '',
                    'text': 'Please Entry VIN'
                });
                return false;
            }

            $('#request_do').parsley().validate();

            if ($('#request_do').parsley().isValid()) {
                swal({
                    title: "Are you sure?",
                    text: "You will send this without save to draft!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, send it!",
                }).then(function() {
                    $.ajax({
                        url: '<?php echo site_url('C_cargo/sendRequest'); ?>',
                        data: formData,
                        type: 'POST',
                        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success: function(data) {
                            var arrData = data.split("#");
                            if (arrData[0] === "msg") {
                                swal({
                                    type: arrData[1],
                                    title: '',
                                    'text': arrData[2]
                                });
                                if (arrData[3] !== "" && typeof arrData[3] !== 'undefined') {
                                    setTimeout(function() {
                                        location.href = arrData[3];
                                    }, 3000);
                                }
                            } else {
                                swal({
                                    type: 'warning',
                                    title: '',
                                    'text': arrData[2]
                                });
                            }
                            return false;
                        },
                        error: function() {
                            var error_code = data.status;

                            swal({
                                type: 'warning',
                                title: error_code.toString(),
                                'text': "Something went wrong, please contact the admin!"
                            });
                        },
                        complete: function() {},
                        beforeSend: function() {
                            swal({
                                title: 'Please Wait!',
                                allowOutsideClick: false
                            });
                            swal.showLoading();
                        }
                    });
                    return false;
                });
            } else {
                swal({
                    type: 'warning',
                    title: '',
                    'text': 'Please re-check the mandatory field. (fields marked with *).'
                });
            }
        });

        $("#BtnSave").click(function(e) {
            e.preventDefault();
            var form = $('#request_do')[0];
            var formData = new FormData(form);
            formData.append('action', 'save');

            var requestor = $('input[name="input[status_requestor]"]:checked').val();
            var jenis_cargo = $('#select_jenis').val();
            var values = document.getElementsByName("jenis_dok[]"),
                i;
            var ownership = document.getElementsByName("ownership[]"),
                i;

            for (i = 0; i < values.length; i++) {
                var x = 0;
                if (values[i].value == "4") {
                    var cek_loi = x + 1;
                }
            }

            for (i = 0; i < values.length; i++) {
                var x = 0;
                if (values[i].value == "10") {
                    var cek_vin = x + 1;
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

            if (requestor == '2' && cek_loi == undefined) {
                swal({
                    type: 'error',
                    title: '',
                    'text': 'Please Entry Letter of Indemnity'
                });
                return false;
            }

            if (cek_ownership != undefined && cek_spk == undefined) {
                swal({
                    type: 'error',
                    title: '',
                    'text': 'Please Entry Surat Peminjaman Container'
                });
                return false;
            }

            if (jenis_cargo == '3' && cek_vin == undefined) {
                swal({
                    type: 'error',
                    title: '',
                    'text': 'Please Entry VIN'
                });
                return false;
            }

            $('#request_do').parsley().validate();

            if ($('#request_do').parsley().isValid()) {
                $.ajax({
                    url: '<?php echo site_url('C_cargo/sendRequest'); ?>',
                    data: formData,
                    type: 'POST',
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS
                    success: function(data) {
                        var arrData = data.split("#");
                        if (arrData[0] === "msg") {
                            swal({
                                type: arrData[1],
                                title: '',
                                'text': arrData[2]
                            });
                            if (arrData[3] !== "" && typeof arrData[3] !== 'undefined') {
                                setTimeout(function() {
                                    location.href = arrData[3];
                                }, 3000);
                            }
                        } else {
                            swal({
                                type: 'warning',
                                title: '',
                                'text': arrData[2]
                            });
                        }
                        return false;
                    },
                    error: function() {
                        var error_code = data.status;

                        swal({
                            type: 'warning',
                            title: error_code.toString(),
                            'text': "Something went wrong, please contact the admin!"
                        });
                    },
                    complete: function() {},
                    beforeSend: function() {
                        swal({
                            title: 'Please Wait!',
                            allowOutsideClick: false
                        });
                        swal.showLoading();
                    }
                });
            } else {
                swal({
                    type: 'warning',
                    title: '',
                    'text': 'Please re-check the mandatory field. (fields marked with *).'
                });
            }
        });

        $("#BtnEdit").click(function(e) {
            e.preventDefault();
            var form = $('#request_do')[0];
            var formData = new FormData(form);
            formData.append('action', 'edit');

            $('#request_do').parsley().validate();

            if ($('#request_do').parsley().isValid()) {
                $.ajax({
                    url: '<?php echo site_url('C_cargo/sendRequest'); ?>',
                    data: formData,
                    type: 'POST',
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS
                    success: function(data) {
                        var arrData = data.split("#");
                        if (arrData[0] === "msg") {
                            swal({
                                type: arrData[1],
                                title: '',
                                'text': arrData[2]
                            });
                            if (arrData[3] !== "" && typeof arrData[3] !== 'undefined') {
                                setTimeout(function() {
                                    location.href = arrData[3];
                                }, 3000);
                            }
                        } else {
                            swal({
                                type: 'warning',
                                title: '',
                                'text': arrData[2]
                            });
                        }
                        return false;
                    },
                    error: function() {
                        swal({
                            type: 'error',
                            title: '',
                            'text': arrData[2]
                        });
                    },
                    complete: function() {},
                    beforeSend: function() {}
                });
            } else {
                console.log(' tidak valid');
            }
        });
    });
</script>