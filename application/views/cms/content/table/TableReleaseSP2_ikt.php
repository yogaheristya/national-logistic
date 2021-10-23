<style type="text/css">
  #loginPopup {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    padding-top: 100px;
    /* Location of the box */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4);
    /* Black w/ opacity */
  }

  /* Fix the button on the left side of the page */
  .open-btn {
    display: flex;
    justify-content: left;
  }

  /* Style and fix the button on the page */
  .open-button {
    background-color: #1c87c9;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    opacity: 0.8;
    position: fixed;
  }

  /* Hide the Popup form */
  .form-popup {
    border: 2px solid #666;
    z-index: 9;
    max-width: 300px;
    margin: 0 auto;
  }

  /* Styles for the form container */
  .form-container {
    max-width: 300px;
    padding: 20px;
    background-color: #fff;
  }

  /* Full-width for input fields */
  .form-container input[type=text],
  .form-container input[type=password] {
    width: 100%;
    padding: 10px;
    margin: 5px 0 22px 0;
    border: none;
    background: #eee;
  }

  /* When the inputs get focus, do something */
  .form-container input[type=text]:focus,
  .form-container input[type=password]:focus {
    background-color: #ddd;
    outline: none;
  }

  /* Style submit/login button */
  .form-container .btn {
    background-color: #188AE2;
    color: #fff;
    padding: 12px 20px;
    border: none;
    cursor: pointer;
    width: 100%;
    margin-bottom: 10px;
    opacity: 0.8;
  }

  /* Style cancel button */
  .form-container .cancel {
    background-color: #cc0000;
  }

  /* Hover effects for buttons */
  .form-container .btn:hover,
  .open-button:hover {
    opacity: 1;
  }
</style>

<div id="dataModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title mt-0" id="judul">Detail SP2</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
      </div>
      <input type="hidden" name="" id="post_parameter">
      <div class="modal-body" id="tabledata">
      </div>

    </div>
  </div>
</div>

<table class="table table-stripped dt-responsive nowrap" id="release_sp2_ikt" cellspacing="0" width="100%">

  <thead id="table_header">
    <tr>
      <th>Request Number</th>
      <th>Request Time</th>
      <th>BL Number</th>
      <th>Shipping Line</th>
      <th>Terminal Operator</th>
      <th class="table-row-center">Status</th>
      <th style="text-align: center">Action</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>


<script>
  $(document).ready(function() {

    $(function() {
      var table = $("#release_sp2_ikt").DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
          url: site_url + '/C_cargo/getTableReleaseSP2ikt/',
          method: "POST",
          data: function(data) {
            data.cargo = $('#cargorelease').val();
          }
        },
        columnDefs: [{
            className: "tglreqdo",
            "targets": [1],
          },
          {
            className: "nobl",
            "targets": [0]
          },
          {
            className: "details-release table-row-left table-link",
            "targets": [5]
          }, {
            orderable: false,
            "targets": [6]
          }
        ]
      });


      $('#release_sp2_ikt tbody').on('click', 'td.details-release', function() {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var nobl = $(this).closest("tr").find('.nobl').text();
        var tglreq = $(this).closest("tr").find('.tglreqdo').text();
        var tglakhir = $(this).closest("tr").find('.tglakhir').text();
        if (row.child.isShown()) {
          // This row is already open - close it
          row.child.hide();
          tr.removeClass('shown');
          $(".ti", this).removeClass("ti-arrow-circle-down");
          $(".ti", this).addClass("ti-arrow-circle-right");
        } else {
          // Open this row
          format_release_sp2(row.child, nobl, tglreq);
          tr.addClass('shown');
          $(".ti", this).removeClass("ti-arrow-circle-right");
          $(".ti", this).addClass("ti-arrow-circle-down");
        }
      });

    });



    function format_release_sp2(callback, nobl, tglreq) {
      $.ajax({
        url: site_url + '/C_cargo/getDetailStatusReleaseSP2_NonContainer/' + nobl + '/' + tglreq,
        type: 'POST',
        dataType: "json",
        success: function(data) {
          // console.log(data);
          //menghitung jumlah data
          jmlData = data.length;
          content = ""
          content +=
            "<table class='table table-stripped dt-responsive nowrap' width='100%' style='padding-left:50px; width: 50%; float: right;'>" +
            "<thead class='thead-dark'>" +
            "<tr>" +
            "<td class=\"table-row-right\">STATUS</td>" +
            "<td>TIME</td>" +
            "<td class=\"table-row-left\">REMARK</td>" +
            "</tr>" +
            "</thead>"

          //variabel untuk menampung tabel yang akan digenerasikan
          for (a = 0; a < jmlData; a++) {
            //mencetak baris baru
            var ket = data[a]["keterangan"];
            if (ket != null) { // Covers 'undefined' as well
              var remark = ket;
            } else {
              var remark = "";
            }
            content += "<tr>"
              //mencetak nama instansi
              +
              "<td class=\"table-row-right\">" + data[a]["uraian"] + "</td>"
              //mencetak jumlah laporan "belum"
              +
              "<td>" + data[a]["created_date"] + "</td>"
              //mencetak keterangan 
              +
              "<td class=\"table-row-left\">" + remark + "</td>"
              //tutup baris baru
              +
              "<tr/>";
          } +
          "</table>"
          // $('#'+row).html(data);
          callback($(content)).show();
        }
      });
    }
  });

  function getDetailSP2ikt(id) {
    $.ajax({
      url: '<?php echo site_url('C_spp/ikt_detailrelease'); ?>',
      method: "POST",
      data: 'id=' + id,
      success: function(data) {
        $('#tabledata').html(data);
        $('#dataModal').modal("show");
      },
    });
  }
</script>