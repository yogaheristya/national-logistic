<style type="text/css">
      html,body{
         overflow-x: hidden;
      }
      fieldset.scheduler-border {
    border-top: 1px solid grey !important;
    padding: 0 0 0 0 !important;
    margin: 0 0 1.5em 0 !important;
    background-color: #F7F7F7;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
    </style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $page_title ;?></h1>
          </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Request DO</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
           <!--  <form action="<?= site_url('/post/Project') ?>" method="post" name="FProject" id="FProject" class="form-horizontal" autocomplete="off" role="form">
                <fieldset> -->
                   
                  <form class="form-horizontal" action="<?= site_url('/C_cargo/sendRequest') ?>" method="post" name="request_do" id="request_do" role="form" data-parsley-validate novalidate>
                                <div class="form-group row">
                                    <label for=request_no class="col-sm-2 col-form-label">Request No.*</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="input[request_no]" required parsley-type="text" class="form-control" id="request_no" placeholder="...">
                                    </div>
                                    <label for="date" class="col-sm-1 col-form-label">Date*</label>
                                    <div class="col-sm-4">
                                        <input type="date" name="input[request_date]" required parsley-type="date" class="form-control" id="date" placeholder="date" value="<?= $request["date"] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="npwp" class="col-sm-2 col-form-label">NPWP*</label>
                                    <div class="col-sm-4">
                                        <input id="npwp" name="input[npwp_requestor]" type="text" placeholder="..." required class="form-control" value="<?= $request["npwp"] ?>" readonly>
                                    </div>
                                    <label for="nib" class="col-sm-1 col-form-label">NIB*</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="input[nib_requestor]" required parsley-type="text" class="form-control" id="nib" placeholder="...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="requestor_name" class="col-sm-2 col-form-label">Requestor Name*</label>
                                    <div class="col-sm-9">
                                        <input id="requestor_name" name="input[nama_requestor]" type="text" placeholder="..." required class="form-control" value="<?= $request["name"] ?>" readonly>
                                    </div>
                                    
                                </div>
                                <div class="form-group row" >
                                    <label for="requestor_address" class="col-sm-2 col-form-label">Requestor Address*</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="input[alamat_requestor]" required parsley-type="text" class="form-control" id="requestor_address" placeholder="..." value="<?= $request["alamat"] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row" >
                                    <label for="requestor_role" class="col-sm-2 col-form-label">Requestor Role*</label>
                                    <div class="col-sm-2">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="input[status_requestor]" id="cargo" onclick="CheckRequestor();" value="1">Cargo Owner
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="input[status_requestor]" id="freight" onclick="CheckRequestor();" value="2">Freight Forwarder
                                        </label>
                                    </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="file" name="input[filepath_requestor]" id="forwarder_file" style="display:none;" class="form-control-file" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="shipping" class="col-sm-2 col-form-label">Shipping Line*</label>
                                    <div class="col-sm-4">
                                        <select class="form-control select2" name="input[shipping_line]">
                                            <option>-</option>
                                            <option>World Gate Line</option>
                                        </select>
                                    </div>
                                    <label for="Payment" class="col-sm-1 col-form-label">Term of Payment*</label>
                                    <div class="col-sm-4">
                                       <select class="form-control select2" name="input[carabayar]">
                                            <option>-</option>
                                            <option value="1">Cash</option>
                                            <option value="2">Credit</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row" >
                                    <label for="exp_date" class="col-sm-2 col-form-label">DO Exp Date*</label>
                                    <div class="col-sm-4">
                                        <input type="date" name="input[tgldoakhir]" required parsley-type="text" class="form-control" id="exp_date" placeholder="...">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bill" class="col-sm-2 col-form-label">Bill of Lading No*</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="input[nobl]" required parsley-type="text" class="form-control" id="bill" placeholder="...">
                                    </div>
                                    <label for="bill_date" class="col-sm-0 col-form-label">Date*</label>
                                    <div class="col-sm-2">
                                        <input type="date" name="input[tglbl]" required parsley-type="date" class="form-control" id="bill_date" placeholder="...">
                                    </div>
                                    <label for="BL Type" class="col-sm-0 col-form-label">BL Type*</label>
                                    <div class="col-sm-2">
                                       <select class="form-control select2" name="input[jenisbl]">
                                            <option>-</option>
                                            <option value="1">original</option>
                                            <option value="2">Seawaybill</option>
                                            <option value="3">Telex</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="file" name="input[filepath_bl]" id="bl_file" class="form-control-file" />
                                    </div>
                                </div>
                                

                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Parties Details</legend>
                                <div class="form-group row" >
                                    <label for="shipper_name" class="col-sm-2 col-form-label">Shipper Name*</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="input[shipper_name]" required parsley-type="text" class="form-control" id="requestor_address" placeholder="...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="consignee_name" class="col-sm-2 col-form-label">Consignee Name*</label>
                                    <div class="col-sm-4">
                                        <input id="consignee_name" name="input[nama_consignee]" type="text" placeholder="..." required class="form-control">
                                    </div>
                                    <label for="consignee_npwp" class="col-sm-1 col-form-label">NPWP*</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="input[npwp_consignee]" required parsley-type="text" class="form-control" id="npwp_consignee" placeholder="...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="notify_name" class="col-sm-2 col-form-label">Notify Party Name*</label>
                                    <div class="col-sm-4">
                                        <input id="notify_name" name="input[nama_notifyparty]" type="text" placeholder="..." required class="form-control">
                                    </div>
                                    <label for="npwp_notify" class="col-sm-1 col-form-label">NPWP*</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="input[npwp_notifyparty]" required parsley-type="text" class="form-control" id="npwp_notify" placeholder="...">
                                    </div>
                                </div>
                        </fieldset>
                        <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Container Detail</legend>
                      <div class="col-md-12">
                        <table class="table table-bordered"> 
                           <thead>
                             <th>No</th>
                             <th>Container No.</th>
                             <th>Seal No</th>
                             <th>Size & type</th>
                             <th>Gross Weight</th>
                             <th>Ownership</th>
                             <th>Condition</th>
                             <th>Action</th>
                           </thead>
                           <tbody id="tbody_container">
                            <tr>
                              <td style="text-align: center;" class="col-sm-0">1</td>
                              <td class="col-md-2"><input type="text" id="container_no" name="no_container[]" class="form-control"  data-error="This field is required" value="" placeholder=""/></td>
                              <td class="col-sm-2"><input type="text" id="seal_no" name="seal_no[]" class="form-control"  data-error="This field is required" value="" placeholder=""/></td>
                              <td class="col-sm-2"><select class="form-control select2" name="size_type[]">
                                    <option>-</option>
                                    <option>42GO- 40FT</option>
                                    <option>42GO- 20FT</option>
                                    </select>
                              </td>
                              <td class="col-sm-3" >
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <input id="gross_weight" name="gross_weight[]" type="text" placeholder="..." required class="form-control">
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control select2" name="gross_weight_satuan[]">
                                            <option>-</option>
                                            <option value="TNE">TNE</option>
                                            <option value="KGM">KGM</option>
                                        </select>
                                    </div>
                                </div>
                              </td>
                              <td class="col-sm-1">  <select class="form-control select2" name="ownership[]">
                                    <option>-</option>
                                    <option value="COC">COC</option>
                                    <option value="SOC">SOC</option>
                                    </select>
                              </td>
                               <td class="col-sm-1">  <select class="form-control select2" name="condition[]">
                                    <option>-</option>
                                    <option>FULL</option>
                                    <option>KOSONG</option>
                                    </select>
                              </td>
                              <td class="col-sm-1">
                                <button class="btn btn-success" type="button" id="addrow">Add</button>
                              </td>
                             </tr>
                           </tbody>
                           <!-- <tbody>
                              <td style="text-align: center;">2</td>
                              <td><input type="text" id="telpon" name="container_no" class="form-control"  data-error="This field is required" value="" placeholder=""/></td>
                              <td><input type="text" id="telpon" name="seal_no" class="form-control"  data-error="This field is required" value="" placeholder=""/></td>
                              <td><select class="form-control">
                                    <option>-</option>
                                    <option>42GO- 40FT</option>
                                    <option>42GO- 20FT</option>
                                    </select>
                              </td>
                              <td width="20%">
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <input id="consignee_name" type="text" placeholder="..." required class="form-control">
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control">
                                            <option>-</option>
                                            <option>IDR</option>
                                            <option>USD</option>
                                        </select>
                                    </div>
                                </div>
                              </td>
                               <td>  <select class="form-control">
                                    <option>-</option>
                                    <option>COC</option>
                                    <option>MBL</option>
                                    </select>
                              </td>
                               <td>  <select class="form-control">
                                    <option>-</option>
                                    <option>FULL</option>
                                    <option>KOSONG</option>
                                    </select>
                              </td>
                              <td>
                                <button class="btn btn-danger" type="button">Delete</button>
                              </td>
                         </table> -->

                       </table>
                         
                      </div>
                         
                    </fieldset>
                    <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Place / Location</legend>
                                <div class="form-group row" >
                                    <label for="shipper_name" class="col-sm-2 col-form-label">Place of Loading</label>
                                    <div class="col-sm-4">
                                        <select class="form-control select2" name="input[pelabuhan_muat]">
                                   <!--  <option></option>
                                    <option>CNYTN - Yantian</option>
                                    <option>IDJKT - Jakarta</option>
                                    <option>IDCKR - Cikarang</option>
                                     -->
                                            <?php
                                              foreach ($combo_pel['pelabuhan'] as $pel) {?>
                                                <option value="<?php echo $pel['kdedi'];?>"> <?php echo $pel['kdedi'].' - '.$pel['uredi'] ; ?></option>
                                              <?php }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group row" >
                                    <label for="shipper_name" class="col-sm-2 col-form-label">Place of Discharge</label>
                                    <div class="col-sm-4">

                                        <select class="form-control select2" name="input[pelabuhan_bongkar]">
                                        <?php
                                              foreach ($combo_pel['pelabuhan'] as $pel) {?>
                                                <option value="<?php echo $pel['kdedi'];?>"> <?php echo $pel['kdedi'].' - '.$pel['uredi'] ; ?></option>
                                              <?php }

                                           ?>
                                    </select>
                                    </div>
                                </div>
                                 <div class="form-group row" >
                                    <label for="shipper_name" class="col-sm-2 col-form-label">Place of Destination</label>
                                    <div class="col-sm-4">
                                        
                                        <select class="form-control select2" name="input[pelabuhan_tujuan]">
                                        </select>
                                    </div>
                                </div>
                                
                      </fieldset>
                      
                      <fieldset class="scheduler-border" id="payment">
                      <legend class="scheduler-border">Payment Detail</legend>
                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label" for="telpon" >Invoice No<span class="text-danger">*</span></label>
                            <div class="col-md-1">
                              <input type="text" id="invoice_no" name="invoice_no[]" class="form-control"  data-error="This field is required" value="" placeholder="" required="true"/>
                            </div>
                            <label class="col-sm-0 col-form-label " for="telpon" >Date<span class="text-danger">*</span></label>
                            <div class="col-md-1">
                              <input type="date" id="invoice_date" name="invoice_date[]" class="form-control"  data-error="This field is required" value="" placeholder="" required="true"/>
                            </div>
                            <label class="col-sm-0 col-form-label " for="select total">Total<span class="text-danger">*</span></label>
                          <div class="col-md-1">
                              <select class="form-control select2" name="kd_val[]">
                                    <option></option>
                                    <option>IDR</option>
                                    <option>USD</option>
                              </select>
                          </div>
                          <div class="col-md-2">
                              <input type="text" id="total" name="nilai[]" class="form-control"  data-error="This field is required" value="" placeholder="" required="true"/>
                          </div>
                          <label class="col-sm-0 col-form-label" for="bank" >Bank A/C<span class="text-danger">*</span></label>
                          <div class="col-md-1">
                              <select class="form-control select2" name="kd_bank[]">
                                    <option></option>
                                    <option>BCA</option>
                                    <option>BRI</option>
                                    <option>CIMB Bank Niaga</option>
                              </select>
                          </div>
                          <div class="col-md-1">
                              <input type="text" id="telpon" name="no_rekening[]" class="form-control"  data-error="This field is required" value="" placeholder="" required="true"/>
                          </div>
                          <div class="col-md-2">
                          <input type="file" name="filepath_buktibayar" id="filepayment" />
                          </div>
                          <div class="col-md-1">
                            <input type="button" class="btn btn-md btn-success" value="Add" id="add_payment">
                            <!-- <button class="btn-success" type="button" id="add_payment">Add</button> -->
                          </div>

                        </div>
                    </fieldset>

                    <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Supporting Document</legend>
                      <div class="form-group row">
                        <label for="type" class="col-sm-1 col-form-label">Type</label>
                        <div class="col-sm-2">
                          <select class="form-control" name="jenis_dok[]">
                            <option>-</option>
                            <option>original</option>
                          </select>
                        </div>
                        
                        <label for="No_document" class="col-sm-1 col-form-label" style="text-align: center;">NO*</label>
                        <div class="col-sm-2">
                          <input type="text" name="no_dok[]" required parsley-type="text" class="form-control" id="bill" placeholder="...">
                        </div>

                        <label for="bill_date" class="col-sm-1 col-form-label" style="text-align: center;">Date*</label>
                        <div class="col-sm-2">
                          <input type="date" name="tgl_dok" required parsley-type="date" class="form-control" id="bill_date" placeholder="...">
                        </div>
                        
                        <div class="col-md-2">
                          <input type="file" name="filepath_dok" id="fileBl" class="form-control-file" />
                        </div>
                      <br>
                    </div>
                    </fieldset>   
                      
                </fieldset>
                <div class="form-group form-actions">
                    <div class="col-md-12 offset-md-5">
                        <button type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing..." onclick="return ProcessForm('request_do')" class="btn btn-info btn-loading" id="BtnRequest" data-toggle="tooltip" title="Process Form"><i class="fa fa-arrow-right"></i> 
                            Request
                        </button>
                        <button type="reset" class="btn btn-warning" data-toggle="tooltip" title="Clear Form"><i class="fa fa-repeat"></i>Reset</button>
                    </div>
                </div>
            </form>
           
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        
      </div>
      </div>
        <!-- /.card -->
        <div class="row">
          <div class="col-md-6">
          </div>
          <!-- /.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</section>
<script type="text/javascript">

    function CheckRequestor() {
      if (document.getElementById('freight').checked) {
        document.getElementById('forwarder_file').style.display = 'block';
        document.getElementById('forwarder_file').setAttribute('required','required')
      }
        else document.getElementById('forwarder_file').style.display = 'none';
    }


    var counter = 0;
    $("#addrow").on("click", function () {
        var nomer = counter+2;
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td style="text-align: center;" class="col-sm-0">'+nomer+'</td>';
        cols += '<td class="col-md-2"><input type="text" id="container_no" name="container_no[]" class="form-control"  data-error="This field is required" value="" placeholder=""/></td>';
        cols += '<td class="col-sm-2"><input type="text" id="seal_no" name="seal_no[]" class="form-control"  data-error="This field is required" value="" placeholder=""/></td>';
        cols += '<td class="col-sm-2"><select class="form-control" name="size_type[]"><option> - </option><option>42GO- 40FT</option><option>42GO- 20FT</option></select></td>';
        cols += '<td class="col-sm-3" ><div class="form-group row"><div class="col-sm-8"><input id="gross_weight" name="gross_weight[]" type="text" placeholder="..." required class="form-control"></div><div class="col-sm-4"><select class="form-control" name="weight[]"><option></option><option>TNE</option><option>KGM</option></select></div></div></td>';
        cols += '<td class="col-sm-1">  <select class="form-control" name="ownership[]"><option>-</option><option>COC</option><option>MBL</option></select></td>';
        cols += '<td class="col-sm-1">  <select class="form-control" name="condition[]"><option>-</option><option>FULL</option><option>KOSONG</option></select></td>';

        cols += '<td><input type="button" class="delete_container btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("#tbody_container").append(newRow);
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
      $("#payment").on("click", ".delete_payment", function (event) {
        $(this).closest("div.form-group").remove();       
    });
});
</script>
<script type="text/javascript">
 function ProcessForm(FormId) {
    var btn = $("#BtnRequest")
    
    $.ajax({
        url: $("#" + FormId).attr('action'),
        type: 'POST',
        data: $("#" + FormId).serialize(),
        success: function (data) {
          

        },
        error: function (xhr, status, error) {
            var err = eval(xhr.responseText);
            ShowAlert("Data Processing ...", "Error Console,Please Contact Administrator : " + xhr.responseText.Message, "error", false, false, 3000);
        },
        complete: function () {
            btn.button('reset')
        },
        beforeSend: function () {
            btn.button('loading')
        }
    });
    return false;
  }
</script>