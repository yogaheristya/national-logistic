<table class="table table-stripped dt-responsive nowrap" id="release_do" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th style="width:5px;">Request Number</th>
      <th>Request Time</th>
      <th>BL Number</th>
      <th>BL Date</th>
      <th>DO Number</th>
      <th>DO Release Date</th>
      <th>DO Exp Date</th>
      <th>Terminal Operator</th>
      <th>Shipping Line</th>
      <th class="table-row-center">Status</th>
      <th style="text-align: center">Action</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>


<div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="formContainer">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">List Container</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="card-box" id="table_container">

            </div>
          </div>
        </div>    
        
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="chooseContainer()">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </form>
  </div><!-- /.modal-dialog -->
</div>
<script>
  function draftSP2(id_reqdo_header){
    $.ajax({
      url: '<?php echo site_url('C_spp/request');?>',
      data: {id: id_reqdo_header},
      type: 'POST',
      success: function (data) {
        var arrData = data.split("#");
        if (arrData[0] === "success") {
          swal({type: arrData[0],
                                title:'',
                                'text':arrData[1]});
          //   var formatDate= arrData[1];
          //   $('#datepicker').datepicker({
          //     endDate: new Date(formatDate)
          //   });
          // $("#myModal").modal('show')
          // loadContainer(id_reqdo_header);
          if (arrData[2] !== "" && typeof arrData[2] !== 'undefined') {
                                setTimeout(function () {
                                    location.href = arrData[2];
                                }, 3000);
                            }
            
        } else{
         swal({type: 'error',
                title:'',
                'text':arrData[1]
            });
        }
        
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
  }

  // function loadContainer(id_reqdo_header){
  //   $.ajax({
  //     url: '<?php echo site_url('C_spp/getContainer');?>',
  //     data: {id: id_reqdo_header},
  //     type: 'POST',
  //     success: function (data) {
  //         $("#table_container").html(data);
  //         $("#myModal").modal('show')
  //     },
  //     error: function () {
  //       swal({type: 'error',
  //       title:'',
  //       'text':arrData[2]
  //       });
  //     },
  //     complete: function () {
  //     },
  //     beforeSend: function () {
  //     }
  //   });
  // }

  // function chooseContainer(){
  //   $.ajax({
  //     url: '<?php echo site_url('C_spp/chooseContainer');?>',
  //     data: $("#formContainer").serialize(),
  //     type: 'POST',
  //     success: function (data) {
  //         alert(data)
  //     },
  //     error: function () {
  //       swal({type: 'error',
  //       title:'',
  //       'text':arrData[2]
  //       });
  //     },
  //     complete: function () {
  //     },
  //     beforeSend: function () {
  //     }
  //   });
  // } 

  $(document).ready(function() {

    $(function() {
    var table = $("#release_do").DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
          url: site_url +'/C_cargo/getTableRelease/',
          method: "POST",
          "data": function ( data ) {
                data.no_bl = $('#no_bl').val();
          }
      },
      columnDefs: [
        { className: "tglreqdo", "targets": [ 1 ] },
        { className: "nobl", "targets": [ 2 ] },
        { className: "tglakhir", "targets": [ 6 ] },
        { className: "table-row-center", "targets": [ 7 ] },
        { className: "table-row-center", "targets": [ 8 ] },
        { className: "details-release table-row-left table-link", "targets": [ 9 ] },
      ]
    });

    $('#btn-search').click(function(){ //button filter event click
      table.ajax.reload();  //just reload table
    });
        
    $('#btn-reset').click(function(){ //button reset event click
      $('#search')[0].reset();
      table.ajax.reload();  //just reload table
    });

    $('#release_do tbody').on('click', 'td.details-release', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        var nobl = $(this).closest("tr").find('.nobl').text();
        var tglreq = $(this).closest("tr").find('.tglreqdo').text();
        var tglakhir = $(this).closest("tr").find('.tglakhir').text();
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
            $(".ti",this).removeClass("ti-arrow-circle-down");
            $(".ti",this).addClass("ti-arrow-circle-right");
        }else {
            // Open this row
            format_release(row.child, nobl,tglakhir,tglreq);
            tr.addClass('shown');
            $(".ti",this).removeClass("ti-arrow-circle-right");
            $(".ti",this).addClass("ti-arrow-circle-down");
        }
    });

});



  function format_release ( callback, nobl,tglakhir,tglreq) {
     $.ajax({
        url :site_url +'/C_cargo/getDetailStatusRelease/',
        data : {nobl : nobl, tglakhir : tglakhir,tglreq : tglreq},
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
                        //mencetak nama instansi
                        + "<td class=\"table-row-right\">" + data[a]["uraian"] + "</td>"
                        //mencetak jumlah laporan "belum"
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


    
});
</script>