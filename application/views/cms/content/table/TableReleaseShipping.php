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
      <th>Status</th>
      <th style="text-align: center">Action</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

<script>
  $(document).ready(function() {
    $(function() {
      var table = $("#release_do").DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
          url: site_url + '/C_shipping/getTableRelease/',
          method: "POST",
          "data": function(data) {
            data.no_bl = $('#no_bl').val();
          }
        },
        columnDefs: [{
            className: "tglreqdo",
            "targets": [1]
          },
          {
            className: "nobl",
            "targets": [2]
          },
          {
            className: "tglakhir",
            "targets": [6]
          },
          {
            className: "table-row-center",
            "targets": [7]
          },
          {
            className: "table-row-center",
            "targets": [8]
          },
          {
            className: "details-release table-row-left table-link",
            "targets": [9]
          }, {
            orderable: false,
            "targets": [10]
          }
        ]

      });
      $('#btn-search').click(function() { //button filter event click
        table.ajax.reload(); //just reload table
      });

      $('#btn-reset').click(function() { //button reset event click
        $('#search')[0].reset();
        table.ajax.reload(); //just reload table
      });
      $('#release_do tbody').on('click', 'td.details-release', function() {
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
          format_release(row.child, nobl, tglakhir);
          tr.addClass('shown');
          $(".ti", this).removeClass("ti-arrow-circle-right");
          $(".ti", this).addClass("ti-arrow-circle-down");
        }
      });

    });



    function format_release(callback, nobl, tglakhir, tglreq) {
      $.ajax({
        url: site_url + '/C_shipping/getDetailStatusRelease',
        data: {
          nobl: nobl,
          tglakhir: tglakhir,
          tglreq: tglreq
        },
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
</script>