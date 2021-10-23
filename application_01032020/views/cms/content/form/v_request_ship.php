<div class="container-fluid">
                <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-20">
                <a style="font-size: 12;font-family: Roboto;cursor: pointer;color: blue;" id="btnBack"><b><i class="ti-arrow-left"></i>&nbsp;&nbsp; Back</b></a>
            </div>
            <h4 class="page-title"><?php echo $page_title;?></h4>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <!-- <h4 class="header-title m-t-0 m-b-30">Request DO</h4> -->

                <form class="form-horizontal"  method="post" enctype="multipart/form-data" name="release_do" id="release_do" role="form" data-parsley-validate novalidate >
                    <input type="hidden" name="id" value="<?php echo $data_header['id_reqdo_header']?>" id="id_reqdo_header">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Request Details</legend>
                                <br>
                                <div class="form-group row">
                                    <label for=request_no class="col-sm-2 col-form-label">Request No.</label>
                                    <div class="col-sm-2">
                                        <input id="noreqdo" type="text"  class="form-control" value="<?= $data_header["noreqdo"] ?>" readonly>
                                    </div>
                                    <label for="date" class="col-sm-1 col-form-label">Date</label>
                                    <div class="col-sm-2">
                                        <input id="tglreqdo" type="text"  class="form-control" value="<?= $data_header["tglreqdo"] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row" >
                                    <label for="requestor_role" class="col-sm-2 col-form-label">Requestor <span style="color: red">*</span></label>
                                    <div class="col-sm-3" style="display: flex;">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="input[status_requestor]" id="cargo" onclick="CheckRequestor();" <?=$data_header['status_requestor']=="1" ? "checked" : ""?> value="1" disabled>Cargo Owner
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="input[status_requestor]" id="freight" onclick="CheckRequestor();" value="2" <?=$data_header['status_requestor']=="2" ? "checked" : ""?> value="1" disabled>Freight Forwarder
                                        </label>
                                    </div>
                                    </div>

                                    <?php
                                    if ($data_header['filepath_requestor']!="") { ?>
                                        <div class="col-md-0" style="display: flex;align-self: center;">
                                            <a href="https://apps1.insw.go.id/upload/requestor/<?=$data_header['filepath_requestor']?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a>
                                            <!-- <a href="<?=base_url('/'.$data_header['filepath_requestor'])?>" target="_blank" class="btn btn-info btn-sm" role="button">Show file</a> -->
                                        </div>
                                    <?php }?>
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="npwp" class="col-sm-2 col-form-label">NPWP <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input id="npwp_requestor" type="text"  class="form-control" value="<?= $data_header["npwp_requestor"] ?>" readonly>
                                    </div>
                                    <label for="nib" class="col-sm-1 col-form-label">NIB <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input id="nib" type="text"  class="form-control" value="<?= $data_header["nib_requestor"] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="requestor_name" class="col-sm-2 col-form-label">Requestor Name <span style="color: red">*</span></label>
                                    <div class="col-sm-3">
                                       <input id="nama_requestor" type="text"  class="form-control" value="<?= $data_header["nama_requestor"] ?>" readonly>
                                    </div>
                                    <label for="requestor_address" class="col-sm-2 col-form-label">Requestor Address <span style="color: red">*</span></label>
                                    <div class="col-sm-5">
                                        <input id="alamat_requestor" type="text"  class="form-control" value="<?= $data_header["alamat_requestor"] ?>" readonly>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="shipping" class="col-sm-2 col-form-label">Shipping Line <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input id="shipping" type="text"  class="form-control" value="<?= $data_header["uraian"] ?>" readonly>
                                    </div>
                                    <label for="exp_date" class="col-sm-2 col-form-label">DO Expired Date Request <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input id="doreqexp" type="text"  class="form-control" value="<?= date('Y-m-d',strtotime($data_header["tglexpreqdo"]) );?>" readonly>
                                    </div>
                                    <label for="Payment" class="col-sm-2 col-form-label">Term of Payment <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                       <?php 
                                            if ($data_header["carabayar"]=='1') { ?>
                                                <input id="cash" type="text"  class="form-control" value="Cash" readonly>
                                            <?php } elseif($data_header["carabayar"]=='2'){?>
                                                <input id="cash" type="text"  class="form-control" value="Credit" readonly>
                                            <?php } elseif ($data_header["carabayar"]=="") {?>
                                                    <input id="cash" type="text"  class="form-control" value="-" readonly>
                                            <?php }
                                        ?>
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="bill" class="col-sm-2 col-form-label">Bill of Lading No <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input id="nobl" type="text"  class="form-control" value="<?= $data_header["nobl"] ?>" readonly>
                                    </div>
                                    <label for="bill_date" class="col-sm-1 col-form-label">BL Date <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input id="tglbl" type="text"  class="form-control" value="<?= date('Y-m-d',strtotime($data_header["tglbl"]) );?>" readonly>
                                    </div>
                                    <label for="BL Type" class="col-sm-1 col-form-label">BL Type <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                      <?php 
                                            if ($data_header["jenisbl"]=='1') { ?>
                                                <input id="cash" type="text"  class="form-control" value="Original" readonly>
                                            <?php } elseif($data_header["jenisbl"]=='2'){?>
                                                <input id="cash" type="text"  class="form-control" value="Seawaybill" readonly>
                                            <?php } elseif ($data_header["jenisbl"]=="3") {?>
                                                    <input id="cash" type="text"  class="form-control" value="Telex" readonly>
                                            <?php } elseif ($data_header["jenisbl"]=="") {?>
                                                    <input id="cash" type="text"  class="form-control" value="-" readonly>
                                            <?php }
                                        ?>
                                    </div>
                                    <?php
                                    if ($data_header['filepath_bl']!="") { ?>
                                        <div class="col-md-0" style="display: flex;align-self: center;">
                                             <a href="https://apps1.insw.go.id/upload/bl/<?=$data_header['filepath_bl'] ?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a>
                                            <!-- <a href="<?=base_url('/'.$data_header['filepath_bl'])?>" target="_blank" class="btn btn-info btn-sm" role="button" >Show file</a> -->
                                        </div>
                                    <?php }?>
                            
                                </div>

                                <div class="form-group row">
                                    <label for="request_no" class="col-sm-2 col-form-label">Vessel Name <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input type="text" name="nama_vessel"  class="form-control" id="nama_vessel" placeholder="Please Insert your Vessel Name" value="<?= $data_header["nama_vessel"] ? $data_header["nama_vessel"] : '' ?>">
                                    </div>
                                    <label for="voyage_no" class="col-sm-1 col-form-label">Voyage Number <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input type="text" name="nomor_voyage" class="form-control" id="nomor_voyage" placeholder="Please insert your Voyage Number" value="<?= $data_header["nomor_voyage"] ? $data_header["nomor_voyage"] : '' ?>">
                                    </div>
                                    <label for="call_sign" class="col-sm-1 col-form-label">Call Sign <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input type="text" name="callsign" required parsley-type="text" class="form-control" id="callsign" placeholder="Please insert callsign " value="<?= $data_header["callsign"] ? $data_header["callsign"] : ''?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for=request_no class="col-sm-2 col-form-label">DO Release Number <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input type="text" name="nodo" required parsley-type="text" class="form-control" id="nodo" placeholder="Please Insert your DO Number" value="<?= $data_header["nodo"] ? $data_header["nodo"] : '' ?>" <?php echo $data_header["nodo"] ? 'readonly' : '' ?>>
                                    </div>
                                    <label for="date" class="col-sm-1 col-form-label">DO Release Date <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input type="date" name="tgldoawal" required parsley-type="date" class="form-control" id="tglrelease" placeholder="date" value="">
                                    </div>
                                    <label for="date" class="col-sm-1 col-form-label">DO Expired Date <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input type="date" name="tgldoakhir" required parsley-type="date" class="form-control" id="tgldoakhir" placeholder="date" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="terminal" class="col-sm-2 col-form-label">Terminal Operator <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <select class="form-control select2" name="terminal" placeholder="Please Select" onchange="cek_pin()" id="terminal" required>
                                            <option value=""> - </option>
                                            <option value="JICT">JICT - JAKARTA INTERNATIONAL CONTAINER TERMINAL</option>
                                            <option value="KOJA">KOJA - KOJA</option>
                                            <option value="TEMAL">TEMAL - MUSTIKA ALAM NUSANTARA</option>
                                            <option value="TPS">TPS - TERMINAL PETI KEMAS SURABAYA</option>
                                             <option value="IKT">IKT - INDONESIA KENDARANN TERMINAL</option>
                                        </select>
                                    </div>
                                    
                                    <label for="call_sign" class="col-sm-1 col-form-label" id="label_pin" style="display: none;">Pin Number</label>
                                    <div class="col-sm-2" id="input_pin" style="display: none;">
                                        <input type="text" name="pin_number" class="form-control" id="pin_number" placeholder="Please insert pin number" value="">
                                    </div>
                                    
                                </div>
                        </fieldset>
                        
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Parties Details</legend><br>
                                <div class="form-group row" >
                                    <label for="shipper_name" class="col-sm-2 col-form-label">Shipper Name <span style="color: red">*</span></label>
                                    <div class="col-sm-3">
                                        <input id="shipper" type="text"  class="form-control" value="<?= $data_header["nama_consignor"] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="consignee_name" class="col-sm-2 col-form-label">Consignee Name <span style="color: red">*</span></label>
                                    <div class="col-sm-3">
                                        <input id="nama_consignee" type="text"  class="form-control" value="<?= $data_header["nama_consignee"] ?>" readonly>
                                    </div>
                                    <label for="consignee_npwp" class="col-sm-1 col-form-label">NPWP <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input id="npwp_consignee" type="text"  class="form-control" value="<?= $data_header["npwp_consignee"] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="notify_name" class="col-sm-2 col-form-label">Notify Party Name <span style="color: red">*</span></label>
                                    <div class="col-sm-3">
                                       <input id="nama_notifyparty" type="text"  class="form-control" value="<?= $data_header["nama_notifyparty"] ?>" readonly>
                                    </div>
                                    <label for="npwp_notify" class="col-sm-1 col-form-label">NPWP <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input id="npwp_notifyparty" type="text"  class="form-control" value="<?= $data_header["npwp_notifyparty"] ?>" readonly>
                                    </div>
                                </div>
                        </fieldset>

                    <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Container Detail</legend>
                      <br>
                      <div class="col-md-12">
                        <table class="table table-bordered" style="text-align: center;"> 
                           <thead>
                             <th width="5%">No.</th>
                             <th width="20%">Container No.</th>
                             <th width="20%">Seal No</th>
                             <th width="20%">Size & type</th>
                             <th width="20%">Gross Weight</th>
                             <th width="20%">Ownership</th>
                             <!-- <th>Condition</th> -->
                             <th width="15%">Detail</th>
                           </thead>
                           <tbody id="tbody_container">

                <?php
                    if ($data_container !="") {?>
                     <?php
                        $i=1;
                        foreach ($data_container as $container) { 
                             ?>
                            <tr>
                                <td><?=$i?></td>
                                <td width="10%"><label class="col-sm-12 col-form-label"><?= $container["no_container"]?></label></td>
                                <td width="10%">
                                    <?php
                                        foreach ($container["0"] as $con) { ?>
                                             <label class="col-sm-12 col-form-label"><?= $con?></label>
                                        <?php }
                                    ?>
                                </td>
                                <td width="10%"><label class="col-sm-12 col-form-label"><?= $container["uk_container"]?>&nbsp;-&nbsp;<?= $container['tipe_container']?></label></td>
                                <td width="10%"><label class="col-sm-12 col-form-label"><?= $container["gross_weight"]?>&nbsp;&nbsp;&nbsp;&nbsp;<?= $container["gross_weight_satuan"]?></label></td>
                                <?php if ($container["ownership"]=='1') { ?>
                                        <td width="10%"><label class="col-sm-12 col-form-label">COC</label></td>
                                <?php } elseif($container["ownership"]=='2') { ?>
                                        <td width="10%"><label class="col-sm-12 col-form-label">SOC</label></td>
                                <?php } else { ?>
                                        <td width="10%"><label class="col-sm-12 col-form-label">-</label></td>
                                <?php } ?>
                                <td data-toggle="collapse" data-target="#row<?=$i?>" style="cursor: pointer;"><i class="ti-arrow-circle-right"></i></a></td>
                            </tr>
                            <tr class="collapse" id="row<?=$i?>">
                            <td colspan="7">
                                <input type="hidden" name="id_container[]" value="<?= $container["id_reqdo_container"] ?>">
                                <div class="form-group row" >
                                    <label for="npwp_depo" class="col-sm-1 col-form-label" style="text-align: right;">NPWP</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="npwp_depo[]" class="form-control" id="npwp_depo" placeholder="i.e. 809765123456178" maxlength="15" value="<?= $container["npwp_depo"] ? $container["npwp_depo"] : '' ?>">
                                    </div>
                                    <label for="nama_depo" class="col-sm-1 col-form-label" style="text-align: right;">Name</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="nama_depo[]" parsley-type="text" class="form-control" id="nama_depo" placeholder="i.e. PT DEPO NUSANTARA JAYA" value="<?= $container["nama_depo"] ? $container["nama_depo"] : '' ?>">
                                    </div>
                                    <label for="phone_no" class="col-sm-1 col-form-label" style="text-align: right;">Phone No.<span style="color: red">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="text" name="telp_depo[]" required parsley-type="text" class="form-control" id="telp_depo" placeholder="i.e. 02131232133" value="<?= $container["telp_depo"] ? $container["telp_depo"] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row" >
                                    <label for="nama_depo" class="col-sm-1 col-form-label" style="text-align: right;">Address</label>
                                    <div class="col-sm-3">
                                        <!-- <input type="date" name="input['alamat_depo'][]" required parsley-type="text" class="form-control" id="alamat_depo" placeholder=""> -->
                                        <!-- <textarea class="form-control" name="alamat_depo[]"></textarea> -->
                                        <input type="text" name="alamat_depo[]" parsley-type="text" class="form-control" id="alamat_depo" placeholder="i.e. KOJA, JAKARTA UTARA" value="<?= $container["alamat_depo"] ? $container["alamat_depo"] : '' ?>">
                                    </div>
                                    <label for="nama_depo" class="col-sm-1 col-form-label" style="text-align: right;">City</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="kota_depo[]" parsley-type="text" class="form-control" id="kota_depo" placeholder="i.e. JAKARTA" value="<?= $container["kota_depo"] ? $container["kota_depo"] : '' ?>">
                                    </div>
                                    <label for="nama_depo" class="col-sm-1 col-form-label" style="text-align: right;">Postal Code</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="kdpos_depo[]" parsley-type="text" class="form-control" id="kdpos_depo" placeholder="i.e. 505162" maxlength="5" value="<?= $container["kdpos_depo"] ? $container["kdpos_depo"] : '' ?>">
                                    </div>
                                </div>
                                <!-- <div class="form-group row" >
                                    <label for="nama_depo" class="col-sm-2 col-form-label">Postal Code</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="kdpos_depo[]" parsley-type="text" class="form-control" id="kdpos_depo" placeholder="">
                                    </div>
                                    <label for="nama_depo" class="col-sm-1 col-form-label">Phone No.<span style="color: red">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="telp_depo[]" required parsley-type="text" class="form-control" id="telp_depo" placeholder="">
                                    </div>
                                </div> -->
                            </td>
                        </tr> 
                     <?php $i++;
                        }
                        
                    }
                ?>            
                   
                        </tbody>
                    </table>
                         
                </div>
                         
            </fieldset>
                    <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Place / Location</legend><br>
                                <div class="form-group row" >
                                    <label for="shipper_name" class="col-sm-2 col-form-label">Place of Loading</label>
                                    <div class="col-sm-2">
                                        <input id="nama_consignee" type="text"  class="form-control" value="<?= $data_place["muat"]["pel_muat"]." - ".$data_place["muat"]["uredi"] ?>" readonly>
                                    </div>
                                </div>
                                 <div class="form-group row" >
                                    <label for="shipper_name" class="col-sm-2 col-form-label">Place of Discharge</label>
                                    <div class="col-sm-2">
                                        <input id="nama_consignee" type="text"  class="form-control" value="<?= $data_place["bongkar"]["pel_bongkar"]." - ".$data_place["bongkar"]["uredi"] ?>" readonly>
                                    </div>
                                </div>
                                 <div class="form-group row" >
                                    <label for="shipper_name" class="col-sm-2 col-form-label">Place of Destination</label>
                                    <div class="col-sm-2">
                                        <input id="nama_consignee" type="text"  class="form-control" value="<?= $data_place["tujuan"]["pel_tujuan"]." - ".$data_place["tujuan"]["uredi"] ?>" readonly>
                                    </div>
                                </div>
                                
                      </fieldset>
                    <?php
                        if (count($data_payment)  > 0) {  ?>
                            <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Payment Details</legend><br><br>
                    <?php foreach ($data_payment as $payment) { ?>
                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label" for="telpon" >Invoice No<span class="text-danger">*</span></label>
                                <div class="col-md-1">
                                    <input type="text" class="form-control"  data-error="This field is required" value="<?= $payment["no_dok"]?>" readonly/>
                                </div>
                            
                                <label class="col-sm-0 col-form-label " for="telpon" >Date<span class="text-danger">*</span></label>
                                <div class="col-md-1">
                                    <input type="text" id="invoice_date" class="form-control" value="<?= date('Y-m-d',strtotime($payment["tgl_dok"]) );?>" readonly/>
                                </div>
                            
                                <label class="col-sm-0 col-form-label " for="select total">Total<span class="text-danger">*</span></label>
                                <div class="col-md-1">
                                    <input type="text" class="form-control"  data-error="This field is required" value="<?= $payment["kd_val"]?>" readonly/>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control"  data-error="This field is required" value="<?= $payment["nilai"]?>" readonly/>
                                </div>
                              
                                <label class="col-sm-0 col-form-label" for="bank" >Bank A/C<span class="text-danger">*</span></label>
                                <div class="col-md-2">
                                  <input type="text" class="form-control"  data-error="This field is required" value="<?= $payment["nm_bank"]?>"  readonly/>
                                </div>
                                <div class="col-md-1">
                                  <input type="text" class="form-control"  data-error="This field is required" value="<?= $payment["no_rekening"]?>" readonly/>
                                </div>
                          
                                <div class="col-md-2">
                                <?php
                                            if ($payment['filepath_buktibayar']!="") { ?>
                                                <a href="https://apps1.insw.go.id/upload/payment/<?=$payment['filepath_buktibayar'] ?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a>
                                                <!-- <a href="<?=base_url('/'.$payment['filepath_buktibayar'])?>" target="_blank" class="btn btn-info btn-sm" role="button">Show file</a> -->
                                        <?php }
                                        ?>
                                </div>
 
                            
                            </div>        
                    <?php       } ?>
                        </fieldset>
                    <?php } ?>


                    <?php
                        if (count($data_doc)>0) { ?>
                            <fieldset class="scheduler-border" id="document">
                            <legend class="scheduler-border">Supporting Document</legend>
                            <?php $no=0;
                            foreach ($data_doc as $doc) { 
                                $date_dok = $doc["tgl_dok"] ? date('m/d/Y',strtotime($doc["tgl_dok"])) : '';
                        ?>
                     
                        <div class="form-group row">
                            <label for="type" class="col-sm-1 col-form-label">Doc Type</label>
                            <div class="col-sm-2">
                                <?php 
                                    if ($doc["jenis_dok"]=='4') { ?>
                                        <input id="cash" type="text"  class="form-control" value="Letter of Indemnity (LOI)" readonly>
                                    <?php } elseif($doc["jenis_dok"]=='5'){?>
                                        <input id="cash" type="text"  class="form-control" value="Surat Peminjaman Kontainer" readonly>
                                    <?php } elseif ($doc["jenis_dok"]=="6") {?>
                                        <input id="cash" type="text"  class="form-control" value="ID Penerima Kuasa" readonly>
                                    <?php } elseif ($doc["jenis_dok"]=="9") {?>
                                        <input id="cash" type="text"  class="form-control" value="Lainnya" readonly>
                                    <?php }
                                ?>
                            </div>
                            <label for="No_document" class="col-sm-1 col-form-label" style="text-align: center;">Doc No<span style="color: red">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="no_dok[]" parsley-type="text" class="form-control" id="bill" placeholder="" value="<?= $doc["no_dok"] ?>" readonly>
                            </div>
                            <label for="bill_date" class="col-sm-1 col-form-label" style="text-align: center;">Date</label>
                            <div class="col-sm-2">
                                <input type="text" name="tgl_dok[]" parsley-type="date" class="form-control date" id="dok_date" placeholder="mm/dd/yyyy" value="<?= $date_dok ?>" readonly>
                            </div>
                            <?php
                                if ($doc['filepath_dok'] != "") { ?>
                                    <div class="col-md-1" style="display: block;align-self: center;text-align: center;">
                                        <!-- <a href="<?=base_url('/'.$doc['filepath_dok'])?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a> -->
                                        <a href="https://apps1.insw.go.id/upload/dokumen/<?=$doc['filepath_dok'] ?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a>
                                    </div>
                            <?php }?>
                            <br>
                        </div>
                         <?php 
                                $no+=1;
                            }
                        }
                        ?>
                    </fieldset>
                    
            <fieldset class="action-border">
                <legend class="action-border">Action</legend>
                <div class="form-group row" >
                    <div class="col-sm-12" style="padding-left: 50px;">
                            <div class="form-check-inline">
                                <div class="col-md-12">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="acceptance" id="accept" value="1">
                                    Release DO
                                    </label>
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="acceptance" id="reject" value="2">
                                    Reject Request DO
                                    </label>
                                </div>
                                
                            </div>
                    </div>
                </div>
                <div class="form-group row" >
                    <div class="col-sm-6" style="padding-left: 50px;">
                            <textarea class="form-control" name="keterangan"></textarea>
                    </div>
                </div>
            </fieldset>                
                <div class="form-group form-actions">
                    <div class="col-md-12 offset-md-5">
                        <button type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing..." class="btn btn-info btn-loading" id="BtnProccess" data-toggle="tooltip" title="Process Form"><i class="fa fa-arrow-right"></i> 
                            Process
                        </button>
                        <a type="button" class="btn btn-warning" data-toggle="tooltip" title="Cancel Process" id="btnCancel"><i class="fa fa-close"></i>&nbsp;&nbsp;Cancel</a>
                    </div>
                </div>
            </form>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->


                


            </div> <!-- end container -->


<script type="text/javascript">

    function cek_pin(){
        if (document.getElementById("terminal").value=="TPS") {
            document.getElementById('label_pin').style.display='block';
            document.getElementById('input_pin').style.display='block';
            document.getElementById('input_pin').setAttribute('required','required');

        } else {
            document.getElementById('label_pin').style.display='none';
            document.getElementById('input_pin').style.display='none';
            document.getElementById('input_pin').removeAttribute('required');
        }
    }

    $(function () {
        $('input[name="acceptance"]').change(function () {
             if($("#accept").is(':checked')) {
                    $('#nodo').attr('required', true);
                    $('#tglrelease').attr('required', true);
                    $('input[name="telp_depo[]"]').attr('required', true);
                    $('#tgldoakhir').attr('required',true);
            } else {
                $('#nodo').removeAttr('required');
                $('#tglrelease').removeAttr('required');
                $('input[name="telp_depo[]"]').removeAttr('required');
                $('#tgldoakhir').removeAttr('required');
            }
        });
    });

    function showdetail(coba){
        var row = "row"+coba;
        var x = document.getElementById(`${row}`);
        if (x.style.display === "none") {
            x.style.display = "";
         // $('#'+show).find('i').addClass('fa fa-minus').removeClass('fa fa-plus');
        } else {
            x.style.display = "none";
        } 
    }
</script>
<script type="text/javascript">
$(function () {
    //Initialize Select2 Elements
    // $('.select2').select2();
    $('.select2').select2({
        placeholder: "Please Select"
    });
    $('form').parsley();
});

$(document).ready(function() {
    $.expr[':'].textEquals = $.expr[':'].textEquals || $.expr.createPseudo(function(arg) {
            let newArg = arg;
        
            if (arg.match(/[-()]/))
                newArg = arg.replace(/[^\w\s]/gi, '');
                return function(elem) {
                    let newElem = $(elem).text();
                    if ($(elem).text().match(/[-()]/))
                        newElem = $(elem).text().replace(/[^\w\s]/gi, '');
                        console.log(newElem);
                    return newElem.match("^" + newArg + "$");
                };
        });

    $("#terminal").val('<?php echo $data_header["kd_terminal"]?>').attr('selected', true).trigger("change");

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
 
                    }
                });
                return false;
            });  
  

    $("#BtnProccess").click(function (e) {
        e.preventDefault();
       
        var acc = $("input[name=acceptance]").val(); 

        var text = "";
        $('#release_do').parsley().validate();

        if ($('#release_do').parsley().isValid()){
           if($("#accept").is(':checked')) {
               text = "You will accept this request";    
            } else {
               text = "You will reject this request";
            }
        swal({
        title: "Are you sure?",
        text: text,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        }).then(function () {
                $.ajax({
                url: '<?php echo site_url('C_shipping/execRelease');?>',
                data: $("#release_do").serialize(),
                type: 'POST',
                success: function (data) {
                    var arrData = data.split("#");
                    if (arrData[0] === "msg") {
                        swal({type: arrData[1],
                            title:'',
                            'text':arrData[2]});
                        if (arrData[3] !== "" && typeof arrData[3] !== 'undefined') {
                            setTimeout(function () {
                            location.href = arrData[3];
                        }, 3000);
                    }

                    } else {
                        swal({type: 'warning',
                            title:'',
                            'text':arrData[2]});
                    }
                    return false;
                },
                error: function () {
                    swal({type: 'error',
                        title:'',
                        'text':arrData[2]});
                },
                complete: function () {
                },
                beforeSend: function () {
                }
            });
                return false;
            });
        } else{
                console.log(' tidak valid');
        }
    });

    $("#btnCancel").click(function(e){
            e.preventDefault();
            var id = $('#id_reqdo_header').val();
            $.ajax({
                url : "<?php  echo site_url('C_shipping/backStatus'); ?>",
                method :"POST",
                data : {id:id},
                success : function(data){
                    location.href = data;
                },
                error : function(){
                    location.href = data;
                }
            });
    });

    $("#btnBack").click(function(e){
            e.preventDefault();
            var id = $('#id_reqdo_header').val();
            $.ajax({
                url : "<?php  echo site_url('C_shipping/backStatus'); ?>",
                method :"POST",
                data : {id:id},
                success : function(data){
                    location.href = data;
                },
                error : function(){
                    location.href = data;
                }
            });
    });
});

</script>
<script type="text/javascript">
    $(document).ready(function(){
 
            $('#negara').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('C_cargo/getDataPelln');?>",
                    method : "POST",
                    data : {id: id},
                    dataType : 'json',
                    success: function(data){
                       
                        var html = '';
                        var i;
                        html += '<option></option>';
                        for(i=0; i<data.length; i++){
                            
                            html += '<option value='+data[i].kdedi+'>'+data[i].kdedi+"-"+data[i].uredi+'</option>';
                        }
                        $('#pel_ln').html(html);
 
                    }
                });
                return false;
            }); 
             
        });
</script>