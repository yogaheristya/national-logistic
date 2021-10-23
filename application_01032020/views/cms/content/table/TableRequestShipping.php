<table class="table table-stripped dt-responsive nowrap" id="request_do_ship" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th style="width:5px;">Request Number</th>
      <th>Request Date</th>
      <th>BL Number</th>
      <th>BL Date</th>
      <th>Requestor Name</th>
      <th>Shipping Line</th>
      <th>Place of Discharge</th>
      <th>Status</th>
      <th style="text-align: center">Action</th>
    </tr>
  </thead>   
  <tbody>
    <?php
      foreach ($ListData as $list) { ?>
      <tr>
        <td class="table-row-left"><?=$list["noreqdo"]?></td>
        <td class="tglreqdo table-row-left"><?=$list["tglreqdo"]?></td>
        <td class="nobl table-row-left"><?=$list["nobl"]?></td>
        <td class="table-row-left"><?=$list["tglbl"] ? date('Y-m-d',strtotime($list["tglbl"])) : ''?></td>
        <td class="table-row-left"><?=$list["nama_requestor"]?></td>
        <td class="table-row-center"><?=$list["kd_shippingline"]?></td>
        <td class="table-row-center"><?=$list["pel_bongkar"]?></td>
        <td class="details-request table-link"><a><i class="ti ti-arrow-circle-right"></i></a> <?=$list["uraian"]?></td>
        <td align="center">
            <a href="<?php echo base_url()?>index.php/C_shipping/getFormRequest/<?=$list["id_reqdo_header"]?>"><i class="ti-pencil-alt"></i></a>
        </td>
      </tr> 
      </tr> 
      <?php }
      ?>        
  </tbody>
</table>

<script>
  function format ( callback, nobl,tglreqdo) {
     $.ajax({
        url :site_url +'/C_shipping/getDetailStatus/'+nobl+'/'+tglreqdo,
        type :'POST',
        dataType: "json",
        success: function (data) {
        // console.log(data);
        //menghitung jumlah data
        jmlData = data.length;
        content = ""
        content += 
        "<table class='table table-stripped dt-responsive nowrap' width='100%' style='padding-left:50px; width: 50%; float: right;'>"
        +"<thead class='thead-dark'>"    
        +"<tr>"
        +"<td class=\"table-row-right\">STATUS</td>"
        +"<td>TIME</td>"
        +"</tr>"
        +"</thead>"
        
        //variabel untuk menampung tabel yang akan digenerasikan
        for(a = 0; a < jmlData; a++){
            //mencetak baris baru
            content += "<tr>"
                        //mencetak nama instansi
                        + "<td class=\"table-row-right\">" + data[a]["uraian"] + "</td>"
                        //mencetak jumlah laporan "belum"
                        + "<td>" + data[a]["created_date"] + "</td>"
                        //tutup baris baru
                        + "<tr/>";
        }
        +"</table>"
        // $('#'+row).html(data);
        callback($(content)).show();
        }
    });
}

$(function() {
    var table = $("#request_do_ship").DataTable({
         "order": [[1, "desc" ]],
    });

    $('#request_do_ship tbody').on('click', 'td.details-request', function () {
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
            format(row.child, nobl,tglreqdo);
            tr.addClass('shown');
            $(".ti",this).removeClass("ti-arrow-circle-right");
            $(".ti",this).addClass("ti-arrow-circle-down");
        }
    });
});
</script>
<script type="text/javascript">
  function sendRequest(id){
    swal({
        title: "Are you sure?",
        text: "You will send this request!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, send it!",
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
</script>