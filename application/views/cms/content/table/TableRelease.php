<table class="table table-stripped dt-responsive nowrap" id="release_do" cellspacing="0" width="100%">
  <!-- yoga 08-04-2021 -->
  <div class="row d-flex justify-content-between">
    <div class="row form-group">
      <label class="col-sm-5 col-form-label">Jenis Cargo</label>
      <div class="col-sm-7">
        <select id="selectcargoRelease" onchange="selectCargoRelease()" class="form-control">
          <option value="kontainer">
            Kontainer
          </option>
          <option value="nonkontainer">
            Non Kontainer
          </option>
        </select>
      </div>
    </div>
    <div id="buttonrequest" style="display: none;" class="form-group">
      <button type="button" class="btn btn-primary" style="margin-right: 20px;">Request</button>
    </div>
  </div>
  <!-- yoga 08-04-2021 -->
  <thead>
    <tr>
      <th></th>
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
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
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

<!--YJX tambah modal -->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="requestModalLabel">Masukkan Detail Transportasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formRequest" method="post" enctype="multipart/form-data" name="search_truck" role="form">
          <input type="Hidden" name="noreqdo" id="noreqdo" value="">
          <input type="Hidden" name="idreqdo" id="idreqdo" value="">
          <input type="hidden" name="carrierId" id="carrierId" value="">
          <input type="hidden" name="codeplat" id="codeplat" value="">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Truck License Plate</label>
            <div class="col-sm-6">
              <input id="plattruk" type="text" class="form-control" placeholder="License Plate" name="plattruk" />
            </div>
            <div class="col-sm-2">
              <button id="search_truck" type="button" class="btn btn-primary"><i class="ti-search"></i></button>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Owner Name</label>
            <div class="col-sm-8">
              <input id="ownername" type="text" class="form-control" name="ownername" readonly />
              <small class="form-text text-muted"></small>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Carrier Name</label>
            <div class="col-sm-8">
              <input id="carriername" type="text" class="form-control" name="carriername" readonly />
              <small class="form-text text-muted"></small>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Driver's Name</label>
            <div class="col-sm-8">
              <input id="drivername" type="text" class="form-control" name="drivername" readonly />
              <small class="form-text text-muted"></small>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Jenis Truk</label>
            <div class="col-sm-8">
              <input id="jenistruk" type="text" class="form-control" name="jenistruk" readonly />
              <small class="form-text text-muted"></small>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Driver's Phone Number</label>
            <div class="col-sm-8">
              <input id="driverphone" type="text" class="form-control" name="driverphone" placeholder="Driver's Phone Number" />
              <small class="form-text text-muted"></small>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button id="btnRequest" type="button" class="btn btn-primary" disabled>Request</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--- modal -->
<script>
  function draftSP2(id_reqdo_header) {
    $.ajax({
      url: '<?php echo site_url('C_spp/request'); ?>',
      data: {
        id: id_reqdo_header
      },
      type: 'POST',
      success: function(data) {
        var arrData = data.split("#");
        if (arrData[0] === "success") {
          swal({
            type: arrData[0],
            title: '',
            'text': arrData[1]
          });
          //   var formatDate= arrData[1];
          //   $('#datepicker').datepicker({
          //     endDate: new Date(formatDate)
          //   });
          // $("#myModal").modal('show')
          // loadContainer(id_reqdo_header);
          if (arrData[2] !== "" && typeof arrData[2] !== 'undefined') {
            setTimeout(function() {
              location.href = arrData[2];
            }, 3000);
          }

        } else {
          swal({
            type: 'error',
            title: '',
            'text': arrData[1]
          });
        }

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
  }

  // function loadContainer(id_reqdo_header){
  //   $.ajax({
  //     url: '<?php echo site_url('C_spp/getContainer'); ?>',
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
  //     url: '<?php echo site_url('C_spp/chooseContainer'); ?>',
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
  function selectCargoRelease(x) {
    var x = document.getElementById("selectcargoRelease");
    if (x.value == "kontainer") {
      document.getElementById("buttonrequest").style.display = "none";
      console.log("ganti ke kontainer");

    } else {
      document.getElementById("buttonrequest").style.display = "block";
      console.log("ganti ke nonkontainer");

    }
  }
  $(document).ready(function() {

    var choose_cargo = document.getElementById("selectcargoRelease").value;

    $('#selectcargoRelease').on('change', function() {
      choose_cargo = document.getElementById("selectcargoRelease").value;
      console.log(choose_cargo + "TEST");
    });

    console.log(choose_cargo + "TEST");

    $(function() {
      var table = $("#release_do").DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
          url: site_url + '/C_cargo/getTableRelease/',
          method: "POST",
          "data": function(data) {
            data.no_bl = $('#no_bl').val();
            data.cargo = $('#selectcargoRelease').val();
          }
        },
        columnDefs: [{
            "targets": [0],
            'render': function(data, type, row, meta) {
              data = '<input type="checkbox" class="dt-checkboxes">'
              if ($('#selectcargoRelease').val() === 'kontainer') {
                data = '';
              }

              return data;
            },
            'createdCell': function(td, cellData, rowData, row, col) {
              if ($('#selectcargoRelease').val() === 'kontainer') {
                this.api().cell(td).checkboxes.disable();
              }
            },
            'checkboxes': {
              'selectRow': true
            }
          },
          {
            className: "tglreqdo",
            "targets": [2]
          },
          {
            className: "nobl",
            "targets": [3]
          },
          {
            className: "tglakhir",
            "targets": [7]
          },
          {
            className: "table-row-center",
            "targets": [8]
          },
          {
            className: "shipping table-row-center",
            "targets": [9]
          },
          {
            className: "details-release table-row-left table-link",
            "targets": [10]
          }, {
            orderable: false,
            "targets": [11]
          }
        ],
        'select': {
          'style': 'multi'
        }
      });

      $('#selectcargoRelease').change(function() { //button filter event click
        // console.log($('#selectcargo').val());
        table.draw();
      });

      $('#buttonrequest').on('click', function(e) {


        var rows_selected = table.column(0).checkboxes.selected();
        var selected_items = [];
        // Loop through to get the selected id
        $.each(rows_selected, function(index, rowId) {
          //this add selected ID as object into array
          selected_items.push({
            id: rowId
          });
        });
        //var sl_sama = true;

        //Tidak ada yang dichecklist
        if (rows_selected.length == 0) {
          swal("", "Tidak ada data yang hendak diajukan", "warning");
          return;
        }

        //get id
        var idreqdo = [];
        for (i = 0; i < selected_items.length; i++) {
          idreqdo.push(selected_items[i].id);
        }

        $.ajax({
          url: '<?php echo site_url('C_spp/ikt_cek'); ?>',
          data: {
            idreqdo: idreqdo
          },
          type: 'POST',
          success: function(data) {
            var arrData = data.split("#");
            if (arrData[0] == "error") {
              swal({
                type: 'error',
                title: '',
                'text': arrData[1]
              });
            } else {
              document.getElementById('idreqdo').value = idreqdo;
              $("#requestModal").modal("toggle");
            }
            return false
          },
          error: function() {
            swal({
              type: 'error',
              title: '',
              'text': 'Silahkan menghubungi admin'
            });
          },
          complete: function() {},
          beforeSend: function() {}
        });
        //Check Shipping Line Sama atau Tidak
        // var checkIds = [];
        // table.$('tr').each(function(index,rowhtml){
        //   var checked= $('input[type="checkbox"]:checked',rowhtml).length;
        //   if (checked==1){
        //     checkIds.push($('.shipping',rowhtml).text());
        //   }
        // });
        // for (i = 0; i < checkIds.length; i++) {

        // }




        // swal("Form Detail Transportation");

      });
      $("#requestModal").on("hidden.bs.modal", function() {
        document.getElementById('plattruk').value = '';
        document.getElementById('ownername').value = '';
        document.getElementById('carriername').value = '';
        document.getElementById('drivername').value = '';
        document.getElementById('jenistruk').value = '';
        document.getElementById('driverphone').value = '';
        document.getElementById('carrierId').value = '';
        document.getElementById('codeplat').value = '';
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
          format_release(row.child, nobl, tglakhir, tglreq);
          tr.addClass('shown');
          $(".ti", this).removeClass("ti-arrow-circle-right");
          $(".ti", this).addClass("ti-arrow-circle-down");
        }
      });

    });



    function format_release(callback, nobl, tglakhir, tglreq) {
      $.ajax({
        url: site_url + '/C_cargo/getDetailStatusRelease',
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
  $("#search_truck").click(function() {
    var plattruk = $('#plattruk').val();
    $.ajax({
      url: '<?php echo site_url('C_spp/ikt_getTruck'); ?>',
      data: {
        plat: plattruk
      },
      dataType: 'JSON',
      type: 'POST',
      success: function(data) {
        if (data.listTruck[0].carrierId != "") {
          swal({
            type: 'success',
            title: '',
            'text': 'Data Truck Ditemukan',
            timer: 3000,
          }).catch(function(timeout) {}).then(function() {
            $("#btnRequest").removeAttr("disabled");
            document.getElementById('carrierId').value = data.listTruck[0].carrierId;
            document.getElementById('codeplat').value = data.listTruck[0].code;
            document.getElementById('ownername').value = data.listTruck[0].ownerName;
            document.getElementById('carriername').value = data.listTruck[0].carrierName;
            document.getElementById('drivername').value = data.listTruck[0].name;
            document.getElementById('jenistruk').value = data.listTruck[0].description;
          })
          return false;
        } else {
          swal({
            type: 'error',
            title: '',
            'text': 'Truck Tidak ditemukan',
            timer: 3000,
          }).catch(function(timeout) {}).then(function() {
            document.getElementById('plattruk').value = '';
            document.getElementById('ownername').value = '';
            document.getElementById('carriername').value = '';
            document.getElementById('drivername').value = '';
            document.getElementById('jenistruk').value = '';
            document.getElementById('driverphone').value = '';
            document.getElementById('carrierId').value = '';
            document.getElementById('codeplat').value = '';
          })
          return false;
        }
      },
      error: function() {
        swal({
          type: 'error',
          title: '',
          'text': arrData[2]
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
  });
  $("#btnRequest").click(function() {
    var formData = $('#formRequest').serialize();
    $.ajax({
      url: '<?php echo site_url('C_spp/ikt_request'); ?>',
      data: formData,
      type: 'POST',
      success: function(data) {
        var arrData = data.split("#");
        swal({
          type: arrData[0],
          title: '',
          'text': arrData[1],
        })

        if (arrData[0] === "success") {
          setTimeout(function() {
            location.href = arrData[2];
          }, 3000);
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
      beforeSend: function() {
        swal({
          title: 'Please Wait!',
          allowOutsideClick: false
        });
        swal.showLoading();
      }
    });
  });
</script>