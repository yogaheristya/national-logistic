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
                <!-- <h4 class="header-title m-t-0 m-b-30">Request DO</h4> -->
                <form class="form-horizontal" method="post" enctype="multipart/form-data" name="request_do" id="request_do" role="form" data-parsley-validate novalidate>

                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Request Details</legend>
                        <br>
                        <div class="form-group row">
                            <label for=request_no class="col-sm-2 col-form-label">Request No.</label>
                            <div class="col-sm-2">
                                <input id="noreqdo" type="text" class="form-control" value="<?= $data_header["noreqdo"] ?>" readonly>
                            </div>
                            <label for="date" class="col-sm-1 col-form-label">Date</label>
                            <div class="col-sm-2">
                                <input id="tglreqdo" type="text" class="form-control" value="<?= $data_header["tglreqdo"] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="requestor_role" class="col-sm-2 col-form-label">Requestor <span style="color: red">*</span></label>
                            <div class="col-sm-3" style="display: flex;">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="input[status_requestor]" id="cargo" onclick="CheckRequestor();" <?= $data_header['status_requestor'] == "1" ? "checked" : "" ?> value="1" disabled>Cargo Owner
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="input[status_requestor]" id="freight" onclick="CheckRequestor();" value="2" <?= $data_header['status_requestor'] == "2" ? "checked" : "" ?> value="1" disabled>Freight Forwarder
                                    </label>
                                </div>
                            </div>

                            <?php
                            if ($data_header['filepath_requestor_meta'] != "") { ?>
                                <div class="col-md-0" style="display: flex;align-self: center;">
                                    <a href="https://apps1.insw.go.id/upload/meta_requestor/<?= $data_header['filepath_requestor_meta'] ?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a>
                                    <!-- <a href="<?= base_url('/' . $data_header['filepath_requestor']) ?>" target="_blank" class="btn btn-info btn-sm" role="button">Show file</a> -->
                                </div>
                            <?php } ?>

                        </div>
                        <div class="form-group row">
                            <label for="npwp" class="col-sm-2 col-form-label">NPWP <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input id="npwp_requestor" type="text" class="form-control" value="<?= $data_header["npwp_requestor"] ?>" readonly>
                            </div>
                            <label for="nib" class="col-sm-1 col-form-label">NIB <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input id="nib" type="text" class="form-control" value="<?= $data_header["nib_requestor"] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="requestor_name" class="col-sm-2 col-form-label">Requestor Name <span style="color: red">*</span></label>
                            <div class="col-sm-3">
                                <input id="nama_requestor" type="text" class="form-control" value="<?= $data_header["nama_requestor"] ?>" readonly>
                            </div>
                            <label for="requestor_address" class="col-sm-2 col-form-label">Requestor Address <span style="color: red">*</span></label>
                            <div class="col-sm-5">
                                <input id="alamat_requestor" type="text" class="form-control" value="<?= $data_header["alamat_requestor"] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shipping" class="col-sm-2 col-form-label">Shipping Line <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input id="shipping" type="text" class="form-control" value="<?= $data_header["uraian"] ?>" readonly>
                            </div>
                            <label for="exp_date" class="col-sm-2 col-form-label">DO Expired Date Request <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input id="doreqexp" type="text" class="form-control" value="<?= $data_header["tglexpreqdo"] ? date('d/m/Y', strtotime($data_header["tglexpreqdo"])) : ''; ?>" readonly>
                            </div>
                            <label for="Payment" class="col-sm-2 col-form-label">Term of Payment <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <?php
                                if ($data_header["carabayar"] == '1') { ?>
                                    <input id="cash" type="text" class="form-control" value="Cash" readonly>
                                <?php } elseif ($data_header["carabayar"] == '2') { ?>
                                    <input id="cash" type="text" class="form-control" value="Credit" readonly>
                                <?php } elseif ($data_header["carabayar"] == "") { ?>
                                    <input id="cash" type="text" class="form-control" value="-" readonly>
                                <?php }
                                ?>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="bill" class="col-sm-2 col-form-label">Bill of Lading No <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input id="nobl" type="text" class="form-control" value="<?= $data_header["nobl"] ?>" readonly>
                            </div>
                            <label for="bill_date" class="col-sm-1 col-form-label">BL Date <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input id="tglbl" type="text" class="form-control" value="<?= $data_header["tglbl"] ? date('d/m/Y', strtotime($data_header["tglbl"])) : ''; ?>" readonly>
                            </div>
                            <label for="BL Type" class="col-sm-1 col-form-label">BL Type <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <?php
                                if ($data_header["jenisbl"] == '1') { ?>
                                    <input id="cash" type="text" class="form-control" value="Original" readonly>
                                <?php } elseif ($data_header["jenisbl"] == '2') { ?>
                                    <input id="cash" type="text" class="form-control" value="Seawaybill" readonly>
                                <?php } elseif ($data_header["jenisbl"] == "3") { ?>
                                    <input id="cash" type="text" class="form-control" value="Telex" readonly>
                                <?php } elseif ($data_header["jenisbl"] == "") { ?>
                                    <input id="cash" type="text" class="form-control" value="-" readonly>
                                <?php }
                                ?>
                            </div>
                            <?php
                            if ($data_header['filepath_bl_meta'] != "") { ?>
                                <div class="col-md-0" style="display: flex;align-self: center;">
                                    <!-- <a href="<?= base_url('/' . $data_header['filepath_bl']) ?>" target="_blank" class="btn btn-info btn-sm" role="button" >Show file</a> -->
                                    <a href="https://apps1.insw.go.id/upload/meta_bl/<?= $data_header['filepath_bl_meta'] ?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a>
                                </div>
                            <?php } ?>

                        </div>

                        <div class="form-group row">
                            <label for="request_no" class="col-sm-2 col-form-label">Vessel Name <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="nama_vessel" required parsley-type="text" class="form-control" id="nama_vessel" value="<?= $data_header["nama_vessel"] ?>" readonly>
                            </div>
                            <label for="voyage_no" class="col-sm-1 col-form-label">Voyage Number <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="nomor_voyage" required parsley-type="text" class="form-control" id="nomor_voyage" value="<?= $data_header["nomor_voyage"] ?>" readonly>
                            </div>
                            <label for="call_sign" class="col-sm-1 col-form-label">Call Sign <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="callsign" required parsley-type="text" class="form-control" id="callsign" value="<?= $data_header["callsign"] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for=request_no class="col-sm-2 col-form-label">DO Release Number</label>
                            <div class="col-sm-2">
                                <input type="text" name="nodo" class="form-control" value="<?= $data_header['nodo'] ?>" readonly>
                            </div>
                            <label for="date" class="col-sm-1 col-form-label">DO Release Date</label>
                            <div class="col-sm-2">
                                <input type=text name="tgldo" class="form-control" id="tglrelease" value="<?= date('d/m/Y', strtotime($data_header['tgldoawal'])) ?>" readonly>
                            </div>
                            <label for="date" class="col-sm-1 col-form-label">DO Expired Date</label>
                            <div class="col-sm-2">
                                <input type="text" name="tgldoakhir" id="tgldoakhir" class="form-control" value="<?= date('d/m/Y', strtotime($data_header['tgldoakhir'])) ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="terminal" class="col-sm-2 col-form-label">Terminal Operator <span style="color: red">*</span></label>
                            <div class="col-sm-2">

                                <?php
                                if ($data_header["kd_terminal"] == 'JICT') { ?>
                                    <input id="cash" type="text" class="form-control" value="Jakarta International Container Terminal" readonly>
                                <?php } elseif ($data_header["kd_terminal"] == 'KOJA') { ?>
                                    <input id="cash" type="text" class="form-control" value="KOJA" readonly>
                                <?php } elseif ($data_header["kd_terminal"] == "TEMAL") { ?>
                                    <input id="cash" type="text" class="form-control" value="Mustika Alam Nusantara" readonly>
                                <?php } elseif ($data_header["kd_terminal"] == "TPS") { ?>
                                    <input id="cash" type="text" class="form-control" value="Terminal Peti Kemas Surabaya" readonly>
                                <?php }
                                ?>
                            </div>

                            <?php if ($data_header['pin_number'] != "") { ?>
                                <label for="call_sign" class="col-sm-1 col-form-label" id="label_pin" style="display: none;">Pin Number</label>
                                <div class="col-sm-2" id="input_pin" style="display: none;">
                                    <input type="text" name="pin_number" class="form-control" id="pin_number" placeholder="Please insert pin number" value="<?= $data_header["pin_number"] ?>" readonly>
                                </div>
                            <?php } ?>
                        </div>
                    </fieldset>

                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Parties Details</legend><br>
                        <div class="form-group row">
                            <label for="shipper_name" class="col-sm-2 col-form-label">Shipper Name <span style="color: red">*</span></label>
                            <div class="col-sm-3">
                                <input id="shipper" type="text" class="form-control" value="<?= $data_header["nama_consignor"] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="consignee_name" class="col-sm-2 col-form-label">Consignee Name <span style="color: red">*</span></label>
                            <div class="col-sm-3">
                                <input id="nama_consignee" type="text" class="form-control" value="<?= $data_header["nama_consignee"] ?>" readonly>
                            </div>
                            <label for="consignee_npwp" class="col-sm-1 col-form-label">NPWP <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input id="npwp_consignee" type="text" class="form-control" value="<?= $data_header["npwp_consignee"] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="notify_name" class="col-sm-2 col-form-label">Notify Party Name <span style="color: red">*</span></label>
                            <div class="col-sm-3">
                                <input id="nama_notifyparty" type="text" class="form-control" value="<?= $data_header["nama_notifyparty"] ?>" readonly>
                            </div>
                            <label for="npwp_notify" class="col-sm-1 col-form-label">NPWP <span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input id="npwp_notifyparty" type="text" class="form-control" value="<?= $data_header["npwp_notifyparty"] ?>" readonly>
                            </div>
                        </div>
                    </fieldset>

                    <!-- container -->
                    <?php if ($data_header['cargo_type'] != "3") { ?>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Container Detail</legend><br>
                            <div class="col-md-12">
                                <table class="table table-bordered" style="text-align: center;">
                                    <thead>
                                        <th width="5%">No</th>
                                        <th width="20%">Container No.</th>
                                        <th width="20%">Seal No</th>
                                        <th width="20%">Size & Type</th>
                                        <th width="20%">Gross Weight</th>
                                        <th width="20%">Ownership</th>
                                        <!-- <th>Condition</th> -->
                                        <th width="15%">Detail</th>
                                    </thead>
                                    <tbody id="tbody_container">
                                        <?php
                                        if ($data_container != "") {
                                            $i = 1;
                                            foreach ($data_container as $container) {
                                                $html = '<tr>';
                                                $html  .= '<td style="text-align: center;">' . $i . '</td>';
                                                $html .= '<td width="10%"><label class="col-sm-12 col-form-label">' . $container["no_container"] . '</label></td>';
                                                $html .= '<td width="10%">';
                                                foreach ($container[0] as $seal) {
                                                    $html .= '<label class="col-sm-12 col-form-label">' . $seal . '</label>';
                                                }
                                                $html .= '</td>';
                                                $html .= '<td width="10%"><label class="col-sm-12 col-form-label">' . $container["uk_container"] . '&nbsp;&nbsp;' . $container["tipe_container"] . '</label></td>';
                                                $html .= '<td width="10%"><label class="col-sm-12 col-form-label">' . $container["gross_weight"] . '&nbsp;&nbsp;&nbsp;&nbsp;' . $container["gross_weight_satuan"] . '</label></td>';
                                                if ($container["ownership"] == '1') {
                                                    $html .= '<td width="10%"><label class="col-sm-12 col-form-label">COC</label></td>';
                                                } elseif ($container["ownership"] == '2') {
                                                    $html .= '<td width="10%"><label class="col-sm-12 col-form-label">SOC</label></td>';
                                                } else {
                                                    $html .= '<td width="10%"><label class="col-sm-12 col-form-label">-</label></td>';
                                                }
                                                $html .= '<td data-toggle="collapse" data-target="#row' . $i . '" style="cursor: pointer;"><i class="ti-arrow-circle-right"></i></a></td>';
                                                $html .= '</tr>';
                                                $html .= '<tr class="collapse" id="row' . $i . '">';
                                                $html .= '<td></td>';
                                                $html .= '<td colspan="7">';
                                                $html .= '<div class="form-group row">';
                                                $html .= '<label for="npwp_depo" class="col-sm-1 col-form-label" style="text-align: right;">NPWP</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" id="npwp_depo" value="' . $container["npwp_depo"] . '" readonly>
                                                        </div>';
                                                $html .= '<label for="nama_depo" class="col-sm-1 col-form-label" style="text-align: right;">Name</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" id="nama_depo" placeholder="" value="' . $container["nama_depo"] . '" readonly>
                                                        </div>';
                                                $html .= '<label for="phone_no" class="col-sm-1 col-form-label" style="text-align: right;">Phone No.<span style="color: red">*</span></label>
                                                        <div class="col-sm-3">
                                                            <input type="text" id="telp_depo" class="form-control" value="' . $container["telp_depo"] . '" readonly>
                                                        </div>';
                                                $html .= '</div>';

                                                $html .= '<div class="form-group row" >
                                                    <label for="nama_depo" class="col-sm-1 col-form-label" style="text-align: right;">Address</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" id="alamat_depo" class="form-control" value="' . $container["alamat_depo"] . '" readonly>
                                                    </div>

                                                    <label for="nama_depo" class="col-sm-1 col-form-label" style="text-align: right;">City</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" id="kota_depo" class="form-control" value="' . $container["kota_depo"] . '" readonly>
                                                    </div>
                                    
                                                    <label for="nama_depo" class="col-sm-1 col-form-label" style="text-align: right;">Postal Code</label>
                                                    <div class="col-sm-3">
                                                        <input type="text"  id="kdpos_depo" class="form-control" value="' . $container["kdpos_depo"] . '" readonly>
                                                    </div>
                                                    </div>';

                                                echo $html;

                                                $i++;
                                            }
                                        }

                                        ?>


                                    </tbody>

                                </table>

                            </div>

                        </fieldset>
                    <?php } ?>

                    <!-- non-container -->

                    <?php if ($data_header['cargo_type'] == "3") { ?>
                        <div id="noncontainer-ship">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">Cargo Detail</legend>
                                <br>
                                <div class="col-md-12">
                                    <table class="table table-bordered" style="text-align: center;">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align:middle" width="5%" rowspan="2">No</th>
                                                <th style="vertical-align:middle" width="20%" rowspan="2">Description of Goods</th>
                                                <th width="15%" rowspan="1" colspan="2">Package</th>
                                                <th width="15%" rowspan="1" colspan="2">Gross Weight</th>
                                                <th width="15%" rowspan="1" colspan="2">Measurement</th>
                                            </tr>
                                            <tr>
                                                <th width="10%">Quantity</th>
                                                <th width="10%">Satuan</th>
                                                <th width="10%">Quantity</th>
                                                <th width="10%">Satuan</th>
                                                <th width="10%">Volume</th>
                                                <th width="10%">Satuan</th>

                                            </tr>


                                            <?php
                                            if ($data_goods != "") {
                                                $i = 0;
                                                foreach ($data_goods as $goods) {
                                                    $html = '<tr>';
                                                    $html  .= '<td style="text-align: center;">' . $goods['id_goods'] . '</td>';
                                                    $html .= '<td width="10%"><label class="col-sm-12 col-form-label">' . $goods["goods_desc"] . '</label></td>';
                                                    $html .= '<td width="10%"><label class="col-sm-12 col-form-label">' . $data_measurement[$i]["package_qty"] . '</label></td>';
                                                    $html .= '<td width="10%"><label class="col-sm-12 col-form-label">' . $data_measurement[$i]["package_uom"] . '</label></td>';
                                                    $html .= '<td width="10%"><label class="col-sm-12 col-form-label">' . $data_measurement[$i]["gross_qty"] . '</label></td>';
                                                    $html .= '<td width="10%"><label class="col-sm-12 col-form-label">' . $data_measurement[$i]["gross_uom"] . '</label></td>';
                                                    $html .= '<td width="10%"><label class="col-sm-12 col-form-label">' . $data_measurement[$i]["measurement_qty"] . '</label></td>';
                                                    $html .= '<td width="10%"><label class="col-sm-12 col-form-label">' . $data_measurement[$i]["measurement_uom"] . '</label></td>';

                                                    echo $html;

                                                    $i++;
                                                }
                                            }

                                            ?>

                                        </thead>
                                    </table>
                                </div>
                            </fieldset>
                        </div>
                    <?php } ?>


                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Place / Location</legend><br>
                        <div class="form-group row">
                            <label for="shipper_name" class="col-sm-2 col-form-label">Place of Loading</label>
                            <div class="col-sm-2">
                                <input id="nama_consignee" type="text" class="form-control" value="<?= $data_place["muat"]["pel_muat"] . " - " . $data_place["muat"]["uredi"] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipper_name" class="col-sm-2 col-form-label">Place of Discharge</label>
                            <div class="col-sm-2">
                                <input id="nama_consignee" type="text" class="form-control" value="<?= $data_place["bongkar"]["pel_bongkar"] . " - " . $data_place["bongkar"]["uredi"] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipper_name" class="col-sm-2 col-form-label">Place of Destination</label>
                            <div class="col-sm-2">
                                <input id="nama_consignee" type="text" class="form-control" value="<?= $data_place["tujuan"]["pel_tujuan"] . " - " . $data_place["tujuan"]["uredi"] ?>" readonly>
                            </div>
                        </div>

                    </fieldset>
                    <?php
                    if (count($data_payment)  > 0) {  ?>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Payment Details</legend><br><br>
                            <?php foreach ($data_payment as $payment) { ?>
                                <div class="form-group row">
                                    <label class="col-sm-1 col-form-label" for="telpon">Invoice No<span class="text-danger">*</span></label>
                                    <div class="col-md-1">
                                        <input type="text" class="form-control" data-error="This field is required" value="<?= $payment["no_dok"] ?>" readonly />
                                    </div>

                                    <label class="col-sm-0 col-form-label " for="telpon">Date<span class="text-danger">*</span></label>
                                    <div class="col-md-1">
                                        <input type="text" id="invoice_date" class="form-control" value="<?= date('d/m/Y', strtotime($payment["tgl_dok"])); ?>" readonly />
                                    </div>

                                    <label class="col-sm-0 col-form-label " for="select total">Total<span class="text-danger">*</span></label>
                                    <div class="col-md-1">
                                        <input type="text" class="form-control" data-error="This field is required" value="<?= $payment["kd_val"] ?>" readonly />
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" data-error="This field is required" value="<?= $payment["nilai"] ?>" readonly />
                                    </div>

                                    <label class="col-sm-0 col-form-label" for="bank">Bank A/C<span class="text-danger">*</span></label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" data-error="This field is required" value="<?= $payment["nm_bank"] ?>" readonly />
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" class="form-control" data-error="This field is required" value="<?= $payment["no_rekening"] ?>" readonly />
                                    </div>

                                    <div class="col-md-2">
                                        <?php
                                        if ($payment['filepath_buktibayar_meta'] != "") { ?>
                                            <a href="https://apps1.insw.go.id/upload/meta_buktibayar/<?= $payment['filepath_buktibayar_meta'] ?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a>
                                            <!-- <a href="<?= base_url('/' . $payment['filepath_buktibayar']) ?>" target="_blank" class="btn btn-info btn-sm" role="button">Show file</a> -->
                                        <?php }
                                        ?>
                                    </div>


                                </div>
                            <?php       } ?>
                        </fieldset>
                    <?php } ?>


                    <?php
                    if (count($data_doc) > 0) { ?>
                        <fieldset class="scheduler-border" id="document">
                            <legend class="scheduler-border">Supporting Document</legend>
                            <?php $no = 0;
                            foreach ($data_doc as $doc) {
                                $date_dok = $doc["tgl_dok"] ? date('m/d/Y', strtotime($doc["tgl_dok"])) : '';
                            ?>

                                <div class="form-group row">
                                    <label for="type" class="col-sm-1 col-form-label">Doc Type</label>
                                    <div class="col-sm-2">
                                        <?php
                                        if ($doc["jenis_dok"] == '4') { ?>
                                            <input id="cash" type="text" class="form-control" value="Letter of Indemnity (LOI)" readonly>
                                        <?php } elseif ($doc["jenis_dok"] == '5') { ?>
                                            <input id="cash" type="text" class="form-control" value="Surat Peminjaman Kontainer" readonly>
                                        <?php } elseif ($doc["jenis_dok"] == "6") { ?>
                                            <input id="cash" type="text" class="form-control" value="ID Penerima Kuasa" readonly>
                                        <?php } elseif ($doc["jenis_dok"] == "10") { ?>
                                            <input id="cash" type="text" class="form-control" value="VIN" readonly>
                                        <?php } elseif ($doc["jenis_dok"] == "9") { ?>
                                            <input id="cash" type="text" class="form-control" value="Lainnya" readonly>
                                        <?php }
                                        ?>
                                    </div>
                                    <label for="No_document" class="col-sm-1 col-form-label" style="text-align: center;">Doc No<span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input type="text" name="no_dok[]" parsley-type="text" class="form-control" id="bill" placeholder="" value="<?= $doc["no_dok"] ?>" readonly>
                                    </div>
                                    <label for="bill_date" class="col-sm-1 col-form-label" style="text-align: center;">Date</label>
                                    <div class="col-sm-2">
                                        <input type="text" name="tgl_dok[]" parsley-type="date" class="form-control date" id="dok_date" placeholder="mm/dd/yyyy" value="<?= date('d/m/Y', strtotime($date_dok)); ?>" readonly>
                                    </div>
                                    <?php
                                    if ($doc['filepath_dok_meta'] != "") { ?>
                                        <div class="col-md-1" style="display: block;align-self: center;text-align: center;">
                                            <!-- <a href="<?= base_url('/' . $doc['filepath_dok']) ?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a> -->
                                            <a href="https://apps1.insw.go.id/upload/dokumen/<?= $doc['filepath_dok_meta'] ?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a>
                                        </div>
                                    <?php } ?>
                                    <br>
                                </div>
                        <?php
                                $no += 1;
                            }
                        }
                        ?>
                        </fieldset>

                        </fieldset>
                        <div class="form-group form-actions">
                            <div class="col-md-12 offset-md-5">
                                <!-- <button type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing..." class="btn btn-info btn-loading" id="BtnRequest" data-toggle="tooltip" title="Process Form"><i class="fa fa-arrow-right"></i> 
                            Request
                        </button> -->
                                <a href="<?php echo base_url() ?>index.php/C_cargo/getPdf/<?= $data_header["id_reqdo_header"] ?>" target="_blank" type="button" class="btn btn-info btn-loading">Preview PDF</a>
                            </div>
                        </div>
                </form>
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->





</div> <!-- end container -->


<!-- Right Sidebar -->
<div class="side-bar right-bar">
    <a href="javascript:void(0);" class="right-bar-toggle">
        <i class="mdi mdi-close-circle-outline"></i>
    </a>
    <h4 class="">Notifications</h4>
    <div class="notification-list nicescroll">
        <ul class="list-group list-no-border user-list">
            <li class="list-group-item">
                <a href="#" class="user-list-item">
                    <div class="avatar">
                        <img src="assets/images/users/avatar-2.jpg" alt="">
                    </div>
                    <div class="user-desc">
                        <span class="name">Michael Zenaty</span>
                        <span class="desc">There are new settings available</span>
                        <span class="time">2 hours ago</span>
                    </div>
                </a>
            </li>
            <li class="list-group-item">
                <a href="#" class="user-list-item">
                    <div class="icon bg-info">
                        <i class="mdi mdi-account"></i>
                    </div>
                    <div class="user-desc">
                        <span class="name">New Signup</span>
                        <span class="desc">There are new settings available</span>
                        <span class="time">5 hours ago</span>
                    </div>
                </a>
            </li>
            <li class="list-group-item">
                <a href="#" class="user-list-item">
                    <div class="icon bg-pink">
                        <i class="mdi mdi-comment"></i>
                    </div>
                    <div class="user-desc">
                        <span class="name">New Message received</span>
                        <span class="desc">There are new settings available</span>
                        <span class="time">1 day ago</span>
                    </div>
                </a>
            </li>
            <li class="list-group-item active">
                <a href="#" class="user-list-item">
                    <div class="avatar">
                        <img src="assets/images/users/avatar-3.jpg" alt="">
                    </div>
                    <div class="user-desc">
                        <span class="name">James Anderson</span>
                        <span class="desc">There are new settings available</span>
                        <span class="time">2 days ago</span>
                    </div>
                </a>
            </li>
            <li class="list-group-item active">
                <a href="#" class="user-list-item">
                    <div class="icon bg-warning">
                        <i class="mdi mdi-settings"></i>
                    </div>
                    <div class="user-desc">
                        <span class="name">Settings</span>
                        <span class="desc">There are new settings available</span>
                        <span class="time">1 day ago</span>
                    </div>
                </a>
            </li>

        </ul>
    </div>
</div>
<!-- /Right-bar -->


<script type="text/javascript">
    function CheckRequestor() {
        if (document.getElementById('freight').checked) {
            document.getElementById('forwarder_file').style.display = 'block';
            document.getElementById('forwarder_file').setAttribute('required', 'required')
        } else document.getElementById('forwarder_file').style.display = 'none';
    }

    function showdetail(coba) {
        var row = "row" + coba;
        var x = document.getElementById(`${row}`);
        if (x.style.display === "none") {
            x.style.display = "";
            // $('#'+show).find('i').addClass('fa fa-minus').removeClass('fa fa-plus');
        } else {
            x.style.display = "none";
        }
    }


    $(document).ready(function() {

        var counter = 0;
        $("#addrow").on("click", function() {
            var nomer = counter + 2;
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td style="text-align: center;" class="col-sm-0">' + nomer + '</td>';
            cols += '<td class="col-md-2"><input type="text" id="container_no" name="container_no[]" class="form-control"  data-error="This field is required" value="" placeholder=""/></td>';
            cols += '<td class="col-sm-2"><input type="text" id="seal_no" name="seal_no[]" class="form-control"  data-error="This field is required" value="" placeholder=""/></td>';
            cols += '<td class="col-sm-2"><select class="form-control" name="size_type[]"><option> - </option><option>42GO- 40FT</option><option>42GO- 20FT</option></select></td>';
            cols += '<td class="col-sm-3" ><div class="form-group row"><div class="col-sm-8"><input id="gross_weight" name="gross_weight[]" type="text" placeholder="..." required class="form-control"></div><div class="col-sm-4"><select class="form-control" name="weight[]"><option></option><option>TNE</option><option>KGM</option></select></div></div></td>';
            cols += '<td class="col-sm-1">  <select class="form-control" name="ownership[]"><option>-</option><option>COC</option><option>MBL</option></select></td>';

            cols += '<td><input type="button" class="delete_container btn btn-md btn-danger "  value="Delete"></td>';
            newRow.append(cols);
            $("#tbody_container").append(newRow);
            counter++;
        });

        $("#tbody_container").on("click", ".delete_container", function(event) {
            $(this).closest("tr").remove();
            counter -= 1
        });
        var count = 0;
        $("#add_payment").on("click", function() {
            var newPay = $("#payment");
            var cols = "";
            cols += '<div class="form-group row">';
            cols += '<label class="col-sm-1 col-form-label" for="invoice_no" >Invoice No<span class="text-danger">*</span></label><div class="col-md-1"><input type="text" id="invoice_no" name="invoice_no[]" class="form-control"  data-error="This field is required" value="" placeholder="" required="true"/></div>';
            cols += '<label class="col-sm-0 col-form-label " for="invoice_date" >Date<span class="text-danger">*</span></label><div class="col-md-1"><input type="date" id="invoice_date" name="invoice_date[]" class="form-control"  data-error="This field is required" value="" placeholder="" required="true"/></div>';
            cols += '<label class="col-sm-0 col-form-label " for="total">Total<span class="text-danger">*</span></label><div class="col-md-1"><select class="form-control" name="currency[]"><option></option><option>IDR</option><option>USD</option></select></div>';
            cols += '<div class="col-md-2"><input type="text" id="invoice_total" name="invoice_total[]" class="form-control"  data-error="This field is required" value="" placeholder="" required="true"/></div>';
            cols += '<label class="col-sm-0 col-form-label" for="kode_bank">Bank A/C<span class="text-danger">*</span></label><div class="col-md-1"><select class="form-control" name="kode_bank[]"><option></option><option>BCA</option><option>BRI</option><option>CIMB Bank Niaga</option></select></div>';
            cols += '<div class="col-md-1"><input type="text" id="rekening" name="rekening[]" class="form-control"  data-error="This field is required" value="" placeholder="" required="true"/></div>';
            cols += '<div class="col-md-2"><input type="file" name="payment_file[]" id="filepayment" /></div>';
            cols += '<div class="col-md-1"><input class="delete_payment btn-danger" type="button" id="delete_payment" value="Delete"/></div>';
            cols += '</div>';

            newPay.append(cols);
            // $("#payment").append(newPay);
            count++;
        });
        $("#payment").on("click", ".delete_payment", function(event) {
            $(this).closest("div.form-group").remove();
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        //Initialize Select2 Elements
        // $('.select2').select2();
        $('.select2').select2({
            placeholder: "Please Select"
        });
        $('form').parsley();
    });

    $(document).ready(function() {

        $('#negara').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('C_cargo/getDataPelln'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {

                    var html = '';
                    var i;
                    html += '<option></option>';
                    for (i = 0; i < data.length; i++) {

                        html += '<option value=' + data[i].kdedi + '>' + data[i].kdedi + "-" + data[i].uredi + '</option>';
                    }
                    $('#pel_ln').html(html);

                }
            });
            return false;
        });

        $('#request_do').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo site_url('C_cargo/sendRequest'); ?>",
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {

                    var arrData = data.split("#");
                    if (arrData[0] === "msg") {
                        swal({
                            type: arrData[1],
                            title: '',
                            'text': arrData[2]
                        });
                        // Toast.fire({
                        //   type: arrData[1],
                        //   title: arrData[2]
                        //  });
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
                        // Toast.fire({
                        //   type: arrData[1],
                        //   title: arrData[2]
                        //  });
                    }
                    return false;
                },
                error: function() {
                    swal({
                        type: 'error',
                        title: 'GATEWAY',
                        'text': arrData[2]
                    });
                    // Toast.fire({
                    //       type: arrData[1],
                    //       title: arrData[2]
                    //      });
                },
                complete: function() {

                },
                beforeSend: function() {

                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#negara').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('C_cargo/getDataPelln'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {

                    var html = '';
                    var i;
                    html += '<option></option>';
                    for (i = 0; i < data.length; i++) {

                        html += '<option value=' + data[i].kdedi + '>' + data[i].kdedi + "-" + data[i].uredi + '</option>';
                    }
                    $('#pel_ln').html(html);

                }
            });
            return false;
        });

    });
</script>