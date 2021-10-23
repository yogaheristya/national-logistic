<table class="table table-stripped dt-responsive nowrap" id="request_do" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th style="width:5px;">Request Number</th>
      <th>Request Time</th>
      <th>BL Number</th>
      <th>BL Date</th>
      <th>Requestor Name</th>
      <th>Shipping Line</th>
      <th>Status</th>
      <th style="text-align: center">Action</th>
    </tr>
  </thead>   
  <tbody>
    <?php
      $i = 0;
      foreach ($ListData as $list) { 
        $tgl_bl = $list["tglbl"] ? date('Y-m-d',strtotime($list["tglbl"])) : '';
      ?>
      <tr>
        <td class="table-row-left"><?=$list["noreqdo"]?></td>
        <td class="tglreqdo table-row-left"><?=$list["tglreqdo"]?></td>
        <td class="nobl table-row-left"><?=$list["nobl"]?></td>
        <td class="table-row-left"><?= $tgl_bl ?></td>
        <td class="table-row-left"><?=$list["nama_requestor"]?></td>
        <td class="table-row-center"><?=$list["kd_shippingline"]?></td>
      <!--   <td><a href="javascript:void(0)" onclick="showDetail('<?php echo $list["id_reqdo_header"] ?>')"><i class="ti-arrow-circle-right"></i></a> <?=$list["uraian"]?></td> -->
         <!-- <td><a style="cursor: pointer;" href="javascript:void(0)" onclick="showDetail('<?php echo $list["id_reqdo_header"] ?>','row<?=$i?>')" ><i class="ti-arrow-circle-right"></i></a> <?=$list["uraian"]?></td> -->
        <td class="details-control table-row-left table-link"><a><i class="ti ti-arrow-circle-right"></i></a> <?=$list["uraian"]?></td>
        <td class="table-row-center">
          <?php
            if ($this->session->userdata('group')!= '1280') {
                    if ($list["statusreqdo"] != '100' AND $list['statusreqdo'] != '203') {?>
                        <a href="<?php echo base_url()?>index.php/detail-request/<?=$list["id_reqdo_header"]?>"><i class="ti-eye"></i></a>
                    <?php } else { ?>
                    <a href="javascript:void(0)" onclick="editRequest(<?=$list["id_reqdo_header"]?>)"><i class="ti-pencil"></i></a>&nbsp;
                    <a href="javascript:void(0)" onclick="deleteRequest(<?=$list["id_reqdo_header"]?>)"><i class="ti-trash"></i></a>&nbsp;
                    <a href="javascript:void(0)" onclick="sendRequest(<?=$list["id_reqdo_header"]?>)"><i class="ti-share"></i></a>
                <?php } ?>
            <?php } else { ?>
                    <a href="<?php echo base_url()?>index.php/detail-request/<?=$list["id_reqdo_header"]?>"><i class="ti-eye"></i></a>
             <?php } ?>
        </td>
      </tr>
      <!-- <tr id="row<?=$i?>" style="display:none;">
      </tr> -->
      <?php $i++;}
    ?>             
  </tbody>
</table>

<script>

$(function() {
    var table = $("#request_do").DataTable({
         "order": [[1, "desc" ]],
    });

    $('#request_do tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        var nobl = $(this).closest("tr").find('.nobl').text();
        var tglreqdo = $(this).closest("tr").find('.tglreqdo').text();
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
            $(".ti",this).removeClass("ti-arrow-circle-down");
            $(".ti",this).addClass("ti-arrow-circle-right");
        }else {
            // Open this row
            statusReqdo(row.child, nobl, tglreqdo);
            tr.addClass('shown');
            $(".ti",this).removeClass("ti-arrow-circle-right");
            $(".ti",this).addClass("ti-arrow-circle-down");
        }
    });
});
function statusReqdo( callback,nobl,tglreqdo) {
     $.ajax({
        url :site_url +'/C_cargo/getDetailStatus/'+nobl+'/'+tglreqdo,
        type :'POST',
        dataType: "json",
        success: function (data) {
        //menghitung jumlah data
        jmlData = data.length;
        content = ""
        content += 
        "<table class='table table-stripped dt-responsive nowrap' width='100%' style='padding-left:50px; width: 50%; float: right;'>"
        +"<thead class='thead-dark'>"    
        +"<tr>"
        +"<td class=\"table-row-right\">STATUS</td>"
        +"<td>TIME</td>"
        +"<td class=\"table-row-left\">REMARK</td>"
        +"</tr>"
        +"</thead>"
        
        //variabel untuk menampung tabel yang akan digenerasikan
        for(a = 0; a < jmlData; a++){
            //mencetak baris baru
            var ket =  data[a]["keterangan"];
            if(ket != null) { // Covers 'undefined' as well
                var remark = ket;
            } else {
                var remark = "";
            }
            content += "<tr>"
                        //mencetak uraian
                        + "<td class=\"table-row-right\">" + data[a]["uraian"] + "</td>"
                        //mencetak created date
                        + "<td>" + data[a]["created_date"] + "</td>"
                        //mencetak keterangan 
                        + "<td class=\"table-row-left\">" + remark + "</td>"
                        //tutup baris baru
                        + "<tr/>";
        }
        +"</table>"
        // $('#'+row).html(data);
        callback($(content)).show();
        }
    });
}

</script>

<script type="text/javascript">
function showDetail(id,row){
    var row = row;
    var x = document.getElementById(row);
   
    if (x.style.display === "none") {
        x.style.display = "";
        // $('#'+show).find('i').addClass('fa fa-minus').removeClass('fa fa-plus');
    }else {
        x.style.display = "none";
        // $('#'+show).find('i').addClass('fa fa-plus').removeClass('fa fa-minus');
    }
    var id = id;
    $.ajax({
        url :site_url +'/C_cargo/getDetailStatus/'+id,
        type :'POST',
        data : row,
        success: function (data) {
            $('#'+row).html(data);
        }
    });
}

function sendRequest(id){
    swal({
        title: "Are you sure?",
        text: "You will send this request!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes, Send It !",
        }).then(function () {
                var id_reqdo_header= id;
                $.ajax({
                url: '<?php echo site_url('C_cargo/sendRequestByTable');?>',
                data: 'id='+id_reqdo_header,
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
}

function editRequest(id){
    window.location.href = "<?php echo site_url('open-form/');?>"+id;
}

function deleteRequest(id){
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this data",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        }).then(function () {
                var id_reqdo_header= id;
                $.ajax({
                url: '<?php echo site_url('C_cargo/deleteRequest');?>',
                data: 'id='+id_reqdo_header,
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
}
</script>