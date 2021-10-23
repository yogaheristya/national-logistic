<style type="text/css">
  #loginPopup {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
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
      .form-container input[type=text], .form-container input[type=password] {
      width: 100%;
      padding: 10px;
      margin: 5px 0 22px 0;
      border: none;
      background: #eee;
      }
      /* When the inputs get focus, do something */
      .form-container input[type=text]:focus, .form-container input[type=password]:focus {
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
      margin-bottom:10px;
      opacity: 0.8;
      }
      /* Style cancel button */
      .form-container .cancel {
      background-color: #cc0000;
      }
      /* Hover effects for buttons */
      .form-container .btn:hover, .open-button:hover {
      opacity: 1;
      }
</style>

<table class="table table-stripped dt-responsive nowrap" id="request_sp2" cellspacing="0" width="100%">
  <thead>
    <tr>
        <th style="width:5px;">Request Number</th>
        <th>Request Time</th>
        <th>BL Number</th>
        <th>BL date</th>
        <th>DO Number</th>
        <th>DO Release Date</th>
        <th>DO Exp Date</th>
        <th>Shipping Line</th>
        <th>Terminal Operator</th>
        <th class="table-row-center">Status</th>
        <th style="text-align: center">Action</th>
    </tr>
  </thead>   
  <tbody> 
  </tbody>
</table>

<div id="loginPopup">
      <div class="form-popup" id="popupForm">
        <form class="form-container" id="form_container">
          <label for="username">
          <strong>Username</strong>
          </label>
          <input type="Hidden" name="id_reqdo_header" id='id_reqdo_header' value="">
          <input type="text" id="username" placeholder="Username" name="username" required>
          <label for="username">
          <strong>Password</strong>
          </label><br>
          <input type="text" id="password" placeholder="Password" name="password" required>
          <button type="button" class="btn" onclick="getContainerSP2()">Submit</button>
          <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
      </div>
    </div>


<script>
function getContainerSP2(){
    var base_url = '<?php echo site_url(); ?>';
    var id_reqdo_header = $("#id_reqdo_header").val();
    var datastring = $("#form_container").serialize();
    $.ajax({
      url: '<?php echo site_url('C_spp/cekRelasi');?>',
      data: datastring,
      type: 'POST',
      dataType : 'json',
      success: function (data) {
        var status = data.STATUS
        if (status === "TRUE") {
          ShowLoadingWait(true);
          setTimeout(function () {
               location.href = base_url + '/C_spp/getFormContainer/'+id_reqdo_header;
          }, 3000);
          // window.location.href= base_url + '/C_spp/getFormContainer/'+id_reqdo_header;// you just need to add this event on success call.
          //   var formatDate= arrData[1];
          //   $('#datepicker').datepicker({
          //     endDate: new Date(formatDate)
          //   });
          // $("#myModal").modal('show')
          // loadContainer(id_reqdo_header);
            
        } else if(status === "PROFORMA"){
            var link = data.url_proforma
            window.open(link, '_blank');
        }else{
         swal({type: 'error',
                title:'',
                'text':'data tidak ditemukan'
            });
        }
        
      },
      error: function () {
        swal({type: 'error',
        title:'',
        'text':'please contact administrator'
        });
      },
      complete: function () {
      },
      beforeSend: function () {
      }
    });
  }
  function getFormUser(id_reqdo_header){
   document.getElementById("loginPopup").style.display="block";
   $("#id_reqdo_header").val(id_reqdo_header);
  }

  function closeForm() {
        document.getElementById("loginPopup").style.display= "none";
  }

  function getDetailSP2(id_reqdo_header){
    var base_url = '<?php echo site_url(); ?>';  
    $.ajax({
      url: '<?php echo site_url('C_spp/cekDetailSP2');?>',
      data: {id: id_reqdo_header},
      type: 'POST',
      success: function (data) {
        var arrData = data.split("#");
        if (arrData[0] === "success") {
            window.location.href= base_url + '/C_spp/getFormDetailSP2/'+id_reqdo_header;
        } else{
         swal({type: 'error',
                title:'',
                'text': arrData[1]
            });
        }
        
      },
      error: function () {
        swal({type: 'error',
        title:'',
        'text':'please contact administrator'
        });
      },
      complete: function () {
      },
      beforeSend: function () {
      }
    });
  }

  function getSP2(id_reqdo_header){
    var base_url = '<?php echo site_url(); ?>';
    $.ajax({
      url: '<?php echo site_url('C_spp/getSP2');?>',
      data: {id: id_reqdo_header},
      type: 'POST',
      dataType : 'json',
      success: function (data) {
        if (data.status = "TRUE") {
          var link = data.LINK
          window.open(link,'','location=yes,height=570,width=520,scrollbars=yes,status=yes');return false;
      } else {
          swal({type: 'error',
          title:'',
          'text':'Expired'
          });
      }
        
      },
      error: function () {
        swal({type: 'error',
        title:'',
        'text':'please contact administrator'
        });
      },
      complete: function () {
      },
      beforeSend: function () {
      }
    });
  }

  function releaseSP2(id_reqdo_header){
    var base_url = '<?php echo site_url(); ?>';
    $.ajax({
      url: '<?php echo site_url('C_spp/releaseSP2');?>',
      data: {id: id_reqdo_header},
      type: 'POST',
      success: function (data) {
        var arrData = data.split("#");
          swal({type: arrData[0],
            title:'',
            'text':arrData[1]});
            if (arrData[2] !== "" && typeof arrData[2] !== 'undefined') {
              setTimeout(function () {
               location.href = arrData[2];
              }, 3000);
            }
        return false;
      },
      error: function () {
        swal({type: 'error',
        title:'',
        'text':'please contact administrator'
        });
      },
      complete: function () {
      },
      beforeSend: function () {
      }
    });
  }

  function ShowLoadingWait(display) {
    if (display) {
        swal({
            title: '',
            text : 'Loading Please Wait',
            imageUrl: base_url + '/assets/images/285.gif',
            showConfirmButton: false
            
        });
    } else {
        swal.close();
    }
    //code
}

$(document).ready(function() {

    $(function() {
    var table = $("#request_sp2").DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
        url: site_url +'/C_cargo/getTableRequestSP2/',
        method: "POST"
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

    $('#request_sp2 tbody').on('click', 'td.details-release', function () {
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
            format_request_sp2(row.child, nobl,tglreq);
            tr.addClass('shown');
            $(".ti",this).removeClass("ti-arrow-circle-right");
            $(".ti",this).addClass("ti-arrow-circle-down");
        }
    });

});



  function format_request_sp2 ( callback, nobl,tglreq) {
     $.ajax({
        url :site_url +'/C_cargo/getDetailStatusSP2/'+nobl+'/'+tglreq,
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