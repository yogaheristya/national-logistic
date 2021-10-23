<div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-20">
                            <a href="<?= site_url('home') ?>" style="font-size: 12;font-family: Roboto"><b><i class="ti-arrow-left"></i>&nbsp;&nbsp; Back</b></a>
                        </div>
                        <h4 class="page-title"><?php echo $page_title;?></h4>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card-box">
                            <!-- <h4 class="header-title m-t-0 m-b-30">Request DO</h4> -->
                            <form class="form-horizontal"  method="post" enctype="multipart/form-data" name="extend_request" id="extend_request" role="form" data-parsley-validate novalidate >

                        <fieldset class="scheduler-border">
                            <input id="id_reqdo_header" type="hidden"  name="id_reqdo_header" class="form-control" value="<?= $data_header["id_reqdo_header"] ?>" readonly>
                            <legend class="scheduler-border">Request Details</legend>
                                <br>
                                <div class="form-group row" >
                                    <input id="status_requestor" type="hidden"  name="input[status_requestor]" class="form-control" value="<?= $data_header["status_requestor"] ?>">
                                    <label for="requestor_role" class="col-sm-2 col-form-label">Requestor <span style="color: red">*</span></label>
                                    <div class="col-sm-3" style="display: flex;">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" id="cargo" onclick="CheckRequestor();" <?=$data_header['status_requestor']=="1" ? "checked" : ""?> value="1" disabled>Cargo Owner
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" id="freight" onclick="CheckRequestor();" value="2" <?=$data_header['status_requestor']=="2" ? "checked" : ""?> disabled>Freight Forwarder
                                        </label>
                                    </div>
                                    </div>

                                    <?php
                                    if ($data_header['filepath_requestor']!="") { ?>
                                        <div class="col-md-0" style="display: flex;align-self: center;">
                                            <a href="https://apps1.insw.go.id/upload/requestor/<?=$data_header['filepath_requestor']?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a>
                                            <input type="hidden" name="input[filepath_requestor]" value="<?=$data_header['filepath_requestor']?>">
                                            <input type="hidden" name="input[filepath_requestor_meta]" value="<?=$data_header["filepath_requestor_meta"]?>">
                                            <!-- <a href="<?=base_url('/'.$data_header['filepath_requestor'])?>" target="_blank" class="btn btn-info btn-sm" role="button">Show file</a> -->
                                        </div>
                                    <?php }?>
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="npwp" class="col-sm-2 col-form-label">NPWP <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input id="npwp_requestor" type="text"  name="input[npwp_requestor]" class="form-control" value="<?= $data_header["npwp_requestor"] ?>" readonly>
                                    </div>
                                    <label for="nib" class="col-sm-1 col-form-label">NIB <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input id="nib" type="text"  class="form-control" name="input[nib_requestor]" value="<?= $data_header["nib_requestor"] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="requestor_name" class="col-sm-2 col-form-label">Requestor Name <span style="color: red">*</span></label>
                                    <div class="col-sm-3">
                                       <input id="nama_requestor" type="text"  class="form-control" name="input[nama_requestor]" value="<?= $data_header["nama_requestor"] ?>" readonly>
                                    </div>
                                    <label for="requestor_address" class="col-sm-2 col-form-label">Requestor Address <span style="color: red">*</span></label>
                                    <div class="col-sm-5">
                                        <input id="alamat_requestor" type="text"  class="form-control" name="input[alamat_requestor]" value="<?= $data_header["alamat_requestor"] ?>" readonly>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="shipping" class="col-sm-2 col-form-label">Shipping Line <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input id="shipping" type="text"  class="form-control" value="<?= $data_header["uraian"] ?>" readonly>
                                        <input type="hidden" name="input[kd_shippingline]" value="<?= $data_header['kd_shippingline']?>"> 
                                    </div>
                                    <label for="exp_date" class="col-sm-2 col-form-label">DO Expired Date Request <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input type="text"  name='tglexpreqdo' class="form-control" id="exp_date" value="<?= $data_header["tglexpreqdo"] ? date('m/d/Y',strtotime($data_header["tglexpreqdo"])) : '';?>" required>
                                    </div>
                                    <label for="Payment" class="col-sm-2 col-form-label">Term of Payment <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <select class="form-control select2" name="input[carabayar]" placeholder="Please Select" id="carabayar" required >
                                            <option></option>
                                            <option value="1">Cash</option>
                                            <option value="2">Credit</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="bill" class="col-sm-2 col-form-label">Bill of Lading No <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input id="nobl" type="text"  class="form-control" name="input[nobl]" value="<?= $data_header["nobl"] ?>" readonly>
                                    </div>
                                    <label for="bill_date" class="col-sm-1 col-form-label">BL Date <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input id="tglbl" type="text"  class="form-control" value="<?= $data_header["tglbl"] ? date('m/d/Y',strtotime($data_header["tglbl"]) ) : '';?>" readonly>
                                        <input type="hidden" name="tglbl" value="<?=$data_header['tglbl']?>">
                                    </div>
                                    <label for="BL Type" class="col-sm-1 col-form-label">BL Type <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                      <?php 
                                            if ($data_header["jenisbl"]=='1') { ?>
                                                <input id="jenisbl" type="text"  class="form-control" value="Original" readonly>
                                            <?php } elseif($data_header["jenisbl"]=='2'){?>
                                                <input id="jenisbl" type="text"  class="form-control" value="Seawaybill" readonly>
                                            <?php } elseif ($data_header["jenisbl"]=="3") {?>
                                                    <input id="jenisbl" type="text"  class="form-control" value="Telex" readonly>
                                            <?php } elseif ($data_header["jenisbl"]=="") {?>
                                                    <input id="jenisbl" type="text"  class="form-control" value="-" readonly>
                                            <?php }
                                        ?>
                                    </div>
                                    <input type="hidden" name="input[jenisbl]" value="<?= $data_header['jenisbl']?>">
                                    <?php
                                    if ($data_header['filepath_bl']!="") { ?>
                                        <div class="col-md-0" style="display: flex;align-self: center;">
                                            <!-- <a href="<?=base_url('/'.$data_header['filepath_bl'])?>" target="_blank" class="btn btn-info btn-sm" role="button" >Show file</a> -->
                                            <a href="https://apps1.insw.go.id/upload/bl/<?=$data_header['filepath_bl'] ?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a>
                                            <input type="hidden" name="input[filepath_bl]" value="<?=$data_header['filepath_bl']?>">
                                            <input type="hidden" name="input[filepath_bl_meta]" value="<?=$data_header["filepath_bl_meta"]?>">
                                        </div>
                                    <?php }?>
                            
                                </div>

                                <div class="form-group row">
                                    <label for="request_no" class="col-sm-2 col-form-label">Vessel Name <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input type="text" name="input[nama_vessel]" parsley-type="text" class="form-control" id="nama_vessel"  value="<?= $data_header["nama_vessel"] ?>" readonly>
                                    </div>
                                    <label for="voyage_no" class="col-sm-1 col-form-label">Voyage Number <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input type="text" name="input[nomor_voyage]" parsley-type="text" class="form-control" id="nomor_voyage"  value="<?= $data_header["nomor_voyage"] ?>" readonly>
                                    </div>
                                    <label for="call_sign" class="col-sm-1 col-form-label">Call Sign <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input type="text" name="input[callsign]" parsley-type="text" class="form-control" id="callsign"  value="<?= $data_header["callsign"] ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for=request_no class="col-sm-2 col-form-label">DO Release Number</label>
                                    <div class="col-sm-2">
                                        <input type="text" name="input[nodo]" class="form-control" value="<?=$data_header['nodo']?>" readonly>
                                    </div>
                                    <label for="date" class="col-sm-1 col-form-label">DO Release Date</label>
                                    <div class="col-sm-2">
                                        <input type=text name="input[tgldoawal]"  class="form-control" id="tglrelease" value="<?= $data_header["tgldoawal"] ? date('m/d/Y',strtotime($data_header['tgldoawal'])) : '' ?>" readonly>
                                    </div>
                                    <label for="date" class="col-sm-1 col-form-label">DO Expired Date</label>
                                    <div class="col-sm-2">
                                        <input type="text" name="input[tgldoakhir]" id="tgldoakhir" class="form-control" value="<?= $data_header["tgldoakhir"] ? date('m/d/Y',strtotime($data_header['tgldoakhir'])) : ''?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="terminal" class="col-sm-2 col-form-label">Terminal Operator <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                            <input type="hidden" name="input[kd_terminal]" value="<?= $data_header["kd_terminal"] ?>">
                                            <?php 
                                            if ($data_header["kd_terminal"]=='JICT') { ?>
                                                <input id="kd_terminal" type="text"  class="form-control" value="Jakarta International Container Terminal" readonly>
                                            <?php } elseif($data_header["kd_terminal"]=='KOJA'){?>
                                                <input id="kd_terminal" type="text"  class="form-control" value="KOJA" readonly>
                                            <?php } elseif ($data_header["kd_terminal"]=="TEMAL") {?>
                                                    <input id="kd_terminal" type="text"  class="form-control" value="Mustika Alam Nusantara" readonly>
                                            <?php } elseif ($data_header["kd_terminal"]=="TPS") {?>
                                                    <input id="kd_terminal" type="text"  class="form-control" value="Terminal Peti Kemas Surabaya" readonly>
                                            <?php }
                                        ?>
                                    </div>

                                   <?php if ($data_header['pin_number']!="") { ?>
                                        <label for="call_sign" class="col-sm-1 col-form-label" id="label_pin" style="display: none;">Pin Number</label>
                                        <div class="col-sm-2" id="input_pin" style="display: none;">
                                            <input type="text" name="input[pin_number]" class="form-control" id="pin_number" placeholder="Please insert pin number" value="<?= $data_header["pin_number"]?>" readonly>
                                        </div>
                                    <?php }?>
                                </div>
                        </fieldset>

                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Parties Details</legend><br>
                                <div class="form-group row" >
                                    <label for="shipper_name" class="col-sm-2 col-form-label">Shipper Name <span style="color: red">*</span></label>
                                    <div class="col-sm-3">
                                        <input id="shipper" type="text" name="input[nama_consignor]" class="form-control" value="<?= $data_header["nama_consignor"] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="consignee_name" class="col-sm-2 col-form-label">Consignee Name <span style="color: red">*</span></label>
                                    <div class="col-sm-3">
                                        <input id="nama_consignee" type="text"  name="input[nama_consignee]" class="form-control" value="<?= $data_header["nama_consignee"] ?>" readonly>
                                    </div>
                                    <label for="consignee_npwp" class="col-sm-1 col-form-label">NPWP <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input id="npwp_consignee" type="text"  name="input[npwp_consignee]" class="form-control" value="<?= $data_header["npwp_consignee"] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="notify_name" class="col-sm-2 col-form-label">Notify Party Name <span style="color: red">*</span></label>
                                    <div class="col-sm-3">
                                       <input id="nama_notifyparty" type="text" name="input[nama_notifyparty]" class="form-control" value="<?= $data_header["nama_notifyparty"] ?>" readonly>
                                    </div>
                                    <label for="npwp_notify" class="col-sm-1 col-form-label">NPWP <span style="color: red">*</span></label>
                                    <div class="col-sm-2">
                                        <input id="npwp_notifyparty" type="text"  name="input[npwp_notifyparty]" class="form-control" value="<?= $data_header["npwp_notifyparty"] ?>" readonly>
                                    </div>
                                </div>
                        </fieldset>
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
                                    $seal_no = 0;
                                        foreach ($data_container as $container) {

                                            $html = '<tr>';
                                            $html .= '<input type="hidden" name="numCont[]" value="'.$seal_no.'">';
                                            $html  .='<td style="text-align: center;">'.$i.'</td>';
                                            $html .='<td width="10%"><label class="col-sm-12 col-form-label">'.$container["no_container"].'</label></td>';
                                            // $html .='<td width="10%"><label class="col-sm-12 col-form-label">'.$container["no_seal"].'</label></td>';
                                            $html .='<td width="10%">';
                                            
                                            foreach ($container[0] as $seal) {
                                                $html .='<label class="col-sm-12 col-form-label">'.$seal.'</label>'; 
                                                $html .='<input type="hidden" id="seal_no_'.$seal_no.'[]" name="seal_no_'.$seal_no.'[]" value="'.$seal.'">';
                                            }
                                            $html .='<td width="10%"><label class="col-sm-12 col-form-label">'.$container["uk_container"].'&nbsp;&nbsp;'.$container["tipe_container"].'</label></td>';
                                            $html .='<td width="10%"><label class="col-sm-12 col-form-label">'.$container["gross_weight"].'&nbsp;&nbsp;&nbsp;&nbsp;'.$container["gross_weight_satuan"].'</label></td>';
                                            if ($container["ownership"]=='1') {
                                                $html .='<td width="10%"><label class="col-sm-12 col-form-label">SOC</label></td>';
                                            } elseif($container["ownership"]=='2') {
                                                $html .='<td width="10%"><label class="col-sm-12 col-form-label">COC</label></td>';
                                            } else{
                                                $html .='<td width="10%"><label class="col-sm-12 col-form-label">-</label></td>';
                                            }
                                            $html .='<td data-toggle="collapse" data-target="#row'.$i.'" style="cursor: pointer;"><i class="ti-arrow-circle-right"></i></a></td>';
                                            $html .='</tr>';
                                            $html .= '<tr class="collapse" id="row'.$i.'">';
                                            $html .= '<td></td>';
                                            $html .= '<td colspan="7">';
                                            $html .= '<div class="form-group row">';
                                            $html .= '<label for="npwp_depo" class="col-sm-1 col-form-label" style="text-align: right;">NPWP</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" id="npwp_depo" value="'.$container["npwp_depo"].'" readonly name="npwp_depo[]">
                                                        </div>';
                                            $html .= '<label for="nama_depo" class="col-sm-1 col-form-label" style="text-align: right;">Name</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" id="nama_depo" placeholder="" value="'.$container["nama_depo"].'" readonly name="nama_depo[]">
                                                        </div>';
                                            $html .= '<label for="phone_no" class="col-sm-1 col-form-label" style="text-align: right;">Phone No.<span style="color: red">*</span></label>
                                                        <div class="col-sm-3">
                                                            <input type="text" id="telp_depo" class="form-control" value="'.$container["telp_depo"].'" readonly name="telp_depo[]">
                                                        </div>';
                                            $html .= '</div>';
                                            
                                            $html .= '<div class="form-group row" >
                                                    <label for="nama_depo" class="col-sm-1 col-form-label" style="text-align: right;">Address</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" id="alamat_depo" class="form-control" value="'.$container["alamat_depo"].'" readonly name="alamat_depo[]">
                                                    </div>

                                                    <label for="nama_depo" class="col-sm-1 col-form-label" style="text-align: right;">City</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" id="kota_depo" class="form-control" value="'.$container["kota_depo"].'" readonly name="kota_depo[]">
                                                    </div>
                                    
                                                    <label for="nama_depo" class="col-sm-1 col-form-label" style="text-align: right;">Postal Code</label>
                                                    <div class="col-sm-3">
                                                        <input type="text"  id="kdpos_depo" class="form-control" value="'.$container["kdpos_depo"].'" readonly name="kdpos_depo[]">
                                                    </div>
                                                    </div>';
                                            
                                            echo $html; ?>
                                                    <input type="hidden" class="form-control" placeholder="" value="<?=$container["no_container"]?>" readonly name="no_container[]">
                                                    <input type="hidden" class="form-control" placeholder="" value="<?=$container["no_seal"]?>" readonly name="no_seal[]">
                                                    <input type="hidden" class="form-control" placeholder="" value="<?=$container["uk_container"]?>" readonly name="uk_container[]">
                                                    <input type="hidden" class="form-control" placeholder="" value="<?=$container["tipe_container"]?>" readonly name="tipe_container[]">
                                                    <input type="hidden" class="form-control" placeholder="" value="<?=$container["gross_weight"]?>" readonly name="gross_weight[]">
                                                    <input type="hidden" class="form-control" placeholder="" value="<?=$container["gross_weight_satuan"]?>" readonly name="gross_weight_satuan[]">
                                                    <input type="hidden" class="form-control" placeholder="" value="<?=$container["ownership"]?>" readonly name="ownership[]">
                                            <?php $i++;$seal_no++;
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
                                        <input type="hidden" class="form-control" placeholder="" value="<?= $data_place["muat"]["pel_muat"]?>" readonly name="input[pel_muat]">
                                    </div>
                                </div>
                                 <div class="form-group row" >
                                    <label for="shipper_name" class="col-sm-2 col-form-label">Place of Discharge</label>
                                    <div class="col-sm-2">
                                        <input id="nama_consignee" type="text"  class="form-control" value="<?= $data_place["bongkar"]["pel_bongkar"]." - ".$data_place["bongkar"]["uredi"] ?>" readonly>
                                        <input type="hidden" class="form-control" placeholder="" value="<?= $data_place["bongkar"]["pel_bongkar"]?>" readonly name="input[pel_bongkar]">
                                    </div>
                                </div>
                                 <div class="form-group row" >
                                    <label for="shipper_name" class="col-sm-2 col-form-label">Place of Destination</label>
                                    <div class="col-sm-2">
                                        <input id="nama_consignee" type="text"  class="form-control" value="<?= $data_place["tujuan"]["pel_tujuan"]." - ".$data_place["tujuan"]["uredi"] ?>" readonly>
                                        <input type="hidden" class="form-control" placeholder="" value="<?= $data_place["tujuan"]["pel_tujuan"]?>" readonly name="input[pel_tujuan]">
                                    </div>
                                </div>
                                
                      </fieldset>
                        <fieldset class="scheduler-border" id="payment">
                            <legend class="scheduler-border">Payment Details</legend><br>
                            <div class="form-group">
                                <div class="col-md-1" style="display: flex;justify-content: flex-start;">
                                    <input type="button" class="btn btn-sm btn-success" value="Add" id="add_payment">
                                </div>
                            </div>
                      <?php
                        if (count($data_payment)  > 0) {  ?>
                         
                    <?php foreach ($data_payment as $payment) { ?>
                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label" for="telpon" >Invoice No<span class="text-danger">*</span></label>
                                <div class="col-md-1">
                                    <input type="text" class="form-control" name="invoice_no[]"  data-error="This field is required" value="<?= $payment["no_dok"]?>" readonly/>
                                </div>
                            
                                <label class="col-sm-0 col-form-label " for="telpon" >Date<span class="text-danger">*</span></label>
                                <div class="col-md-1">
                                    <input type="text" id="invoice_date" class="form-control" name="invoice_date[]" value="<?= date('Y-m-d',strtotime($payment["tgl_dok"]) );?>" readonly/>
                                </div>
                            
                                <label class="col-sm-0 col-form-label " for="select total">Total<span class="text-danger">*</span></label>
                                <div class="col-md-1">
                                    <input type="text" class="form-control"  name="kd_val[]" data-error="This field is required" value="<?= $payment["kd_val"]?>" readonly/>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control"  name="nilai[]" data-error="This field is required" value="<?= $payment["nilai"]?>" readonly/>
                                </div>
                              
                                <label class="col-sm-0 col-form-label" for="bank" >Bank A/C<span class="text-danger">*</span></label>
                                <div class="col-md-2">
                                  <input type="text" class="form-control" data-error="This field is required" value="<?= $payment["nm_bank"]?>"  readonly/>
                                  <input type="hidden" name="kd_bank[]" value="<?= $payment['kd_bank']?>">
                                </div>
                                <div class="col-md-1">
                                  <input type="text" class="form-control"  data-error="This field is required" value="<?= $payment["no_rekening"]?>" readonly/>
                                  <input type="hidden" name="no_rekening[]" value="<?=$payment["no_rekening"]?>">
                                </div>
                          
                                <div class="col-md-2">
                                <?php
                                            if ($payment['filepath_buktibayar']!="") { ?>
                                                <a href="https://apps1.insw.go.id/upload/payment/<?=$payment['filepath_buktibayar'] ?>" target="_blank" class="btn btn-info btn-sm" role="button">Show File</a>
                                                <!-- <a href="<?=base_url('/'.$payment['filepath_buktibayar'])?>" target="_blank" class="btn btn-info btn-sm" role="button">Show file</a> -->
                                        <?php }
                                        ?>
                                <input type="hidden" name="file_buktibayar[]" value="<?=$payment["filepath_buktibayar"]?>">
                                <input type="hidden" name="filepath_buktibayar_meta[]" value="<?=$payment["filepath_buktibayar_meta"]?>">
                                <input type="file" name="filepath_buktibayar[]" style="display:none">
                                </div>
 
                            
                            </div>        
                    <?php       } ?>
                       
                    <?php } ?>
                     </fieldset>


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
                            <input type="hidden" name="jenis_dok[]" parsley-type="text" class="form-control" id="jenis_dok" placeholder="" value="<?= $doc["jenis_dok"] ?>" readonly>
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
                                        <input type="hidden" name="filepath_dok[]" value="<?=$doc["filepath_dok"]?>">
                                        <input type="hidden" name="filepath_dok_meta[]" value="<?=$doc["filepath_dok_meta"]?>">
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

                </fieldset>
                <div class="form-group form-actions">
                    <div class="col-md-12 offset-md-5">
                        <button type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing..." class="btn btn-info btn-loading" id="BtnRequestExtend" data-toggle="tooltip" title="Process Form"><i class="fa fa-arrow-right"></i> 
                            Request
                        </button>
                        <a type="button" class="btn btn-warning" data-toggle="tooltip" title="Cancel" href="<?=base_url()?>"><i class="fa fa-close"></i> Cancel</a>
                    </div>
                </div>
            </form>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->


                


            </div> <!-- end container -->





<script type="text/javascript">
var dateToday = new Date();
var tomorrow = new Date();
tomorrow.setDate(dateToday.getDate()+1);
$(function () {
    //Initialize Select2 Elements
    // $('.select2').select2();
    $('.select2').select2({
        placeholder: "Please Select"
    });
    $('form').parsley();
    
    $("#exp_date").datepicker({
            autoclose: true,
            startDate: tomorrow
    });
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

$("#carabayar").val('<?php echo $data_header["carabayar"]?>').attr('selected', true).trigger("change");


$("#add_payment").on("click", function () {
        var newPay = $("#payment");
        var cols = "";
        cols += '<div class="form-group row">';
        cols += '<label class="col-sm-1 col-form-label" for="invoice_no" >Invoice No<span style="color: red">*</span></label><div class="col-md-1"><input type="text" id="invoice_no" name="invoice_no[]" class="form-control"   value="" placeholder="" required/></div>';
        cols += '<label class="col-sm-0 col-form-label " for="invoice_date" >Date<span style="color: red">*</span></label><div class="col-md-1"><input type="text" id="invoice_date" name="invoice_date[]" class="form-control date"   placeholder="mm/dd/yyyy" required/></div>';
        cols += '<label class="col-sm-0 col-form-label " for="total">Total<span style="color: red">*</span></label><div class="col-md-1"><select class="form-control select2" name="kd_val[]" required><option></option><option>IDR</option><option>USD</option></select></div>';
        cols += '<div class="col-md-2"><input type="text" id="invoice_total" name="nilai[]" class="form-control" value="" placeholder="" data-parsley-trigger="input" data-type="currency" required/></div>';
        cols += '<label class="col-sm-0 col-form-label" for="kode_bank">Bank A/C <span style="color: red">*</span></label><div class="col-md-1"><select class="form-control select2" name="kd_bank[]" required><option></option>';
             <?php
              foreach ($bank as $bnk) {?>
                    cols += '<option value="<?php echo $bnk['kd_bank'];?>"> <?php echo $bnk['nm_bank'] ; ?></option>';
            <?php }?> 
        cols += '</select></div>';       
        cols += '<div class="col-md-2"><input type="text" id="rekening" name="no_rekening[]" class="form-control"  data-error="This field is required" value="" placeholder="" required/></div>';
        cols += '<div class="col-md-1" style="display: flex; align-self: center;"><input type="file" name="filepath_buktibayar[]" id="filepayment" accept="application/pdf" required/></div>';
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
            
        });

        $("#payment").on("click", ".delete_payment", function (event) {
            $(this).closest("div.form-group").remove();       
        });
  
  $("#BtnRequestExtend").click(function (e) {
            e.preventDefault();
            var form = $('#extend_request')[0];
            var formData = new FormData(form);
            formData.append('action', 'edit');
            $('#extend_request').parsley().validate();

            if ($('#extend_request').parsley().isValid()){
                swal({
                    title: "Are you sure?",
                    text: "You will send this request extend",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, send it!",
                }).then(function () {
                    $.ajax({
                        url: '<?php echo site_url('C_cargo/extendRequest');?>',
                        data: formData,
                        type: 'POST',
                        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
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
                                'text':arrData[2]});
                        },
                        complete: function () {
                        },
                        beforeSend: function () {
                        }
                    });
                    return false;
                });
            }else {
                console.log(' tidak valid');
            }
        });
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

</script>