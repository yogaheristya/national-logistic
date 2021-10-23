<div class="container-fluid">
	<!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
        	<h4 class="page-title" style="color: red;">Shipping Line Access</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card border-secondary m-b-20">
                <div class="card-body table-responsive text-secondary">
                    <h5 data-toggle="collapse" data-target="#request" class="card-title " style="cursor: pointer;" id="icon_request">
                        <button class="btn waves-effect btn-secondary btn-sm" style="background-color: #293165; color: #fff;"><i class="ti ti-angle-right"></i></button> Delivery Order - <i style="color: red;">REQUEST</i>
                    </h5>
                    
                    <div class="col-sm-12 collapse" id="request">
                        <br>
                     <form class="form-horizontal" enctype="multipart/form-data" name="search_req" id="search_req" role="form" onsubmit="return false;">                    
                     <div class="form-group row">
                            <div class="col-sm-1" class="form-control row">
                                <select class="form-control select2" name="param" id="param">
                                    <option>-</option>
                                    <option value="1">BL Number</option>
                                    <option value="3">Container No.</option>
                                    <option value="2">Name</option>
                                </select>
                            </div>
                            <div class="col-sm-2"><input type="text" name="search_req" class="form-control row" placeholder="..."></div>
                            <div class="col-sm-2" style="display: flex;align-self: center;">
                                <button type="submit" onclick="search_request('/C_shipping/LoadTableRequest','DivTableRequest','search_req')" class="btn btn-md btn-info"> Search</button>&nbsp;&nbsp;
                                <button type="reset" onclick="LoadTableRequest('/C_shipping/LoadTableRequest','DivTableRequest');" class="btn btn-md btn-warning" data-toggle="tooltip" title="Clear Search" id="btn-reset"> Reset</button>
                            </div>
                    </div>
                    </form>
                    <br>
                    <div id="DivTableRequest">
                            
                    </div>
                </div>
                </div>  
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card border-secondary m-b-20">
                <div class="card-body table-responsive text-secondary">
                    <h5 data-toggle="collapse" data-target="#release" class="card-title " style="cursor: pointer;" id="icon_release">
                        <button class="btn waves-effect btn-secondary btn-sm" style="background-color: #293165; color: #fff;"><i class="ti ti-angle-right"></i></button> Delivery Order - <i style="color: red;">RELEASE</i>
                    </h5>
                    
                    <div class="col-sm-12 collapse" id="release">
                       
                        <div id="DivTableRelease">
                            
                        </div>
                </div>  
                </div>
            </div>
        </div>
    </div>

  
    <!-- end page title end breadcrumb -->
</div>

<script type="text/javascript">
function search_request(UrlList,DivList,FormId){
    var test = $('#' + FormId).serialize();
    $.ajax({
        type: 'POST',
        url: site_url + UrlList,
        data : $('#' + FormId).serialize(), 
        success: function (data) {
                $("#" + DivList).html(data);
                return false;
        },
        error: function () {
            // ShowAlert("Display Data Processing ...", "Error Console,Please Contact Administrator", "error", false, false, 3000);
        },
        complete: function () {
            // ShowLoadingWait(false);
        },
        beforeSend: function () {
            // ShowLoadingWait(true);
        }

    });
    return false;
   }

  LoadTableRequest('/C_shipping/LoadTableRequest','DivTableRequest');

  LoadTableRelease('/C_shipping/LoadTableRelease','DivTableRelease');

  function LoadTableRequest(UrlList, DivList) {
    $("#" + DivList).html('');
    $.ajax({
        type: 'POST',
        url: site_url + UrlList,
        success: function (data) {
            if (DivList.search("DivLoad") > 0) {
                $("#" + DivList).load(data);
            } else {
                $("#" + DivList).html(data);
            }

        },
        error: function () {
            // ShowAlert("Display Data Processing ...", "Error Console,Please Contact Administrator", "error", false, false, 3000);
        },
        complete: function () {
            // ShowLoadingWait(false);
        },
        beforeSend: function () {
            // ShowLoadingWait(true);
        }

    });
    return false;
   }

   function LoadTableRelease(UrlList, DivList) {
    $("#" + DivList).html('');
    $.ajax({
        type: 'POST',
        url: site_url + UrlList,
        success: function (data) {
            if (DivList.search("DivLoad") > 0) {
                $("#" + DivList).load(data);
            } else {
                $("#" + DivList).html(data);
            }

        },
        error: function () {
            // ShowAlert("Display Data Processing ...", "Error Console,Please Contact Administrator", "error", false, false, 3000);
        },
        complete: function () {
            // ShowLoadingWait(false);
        },
        beforeSend: function () {
            // ShowLoadingWait(true);
        }

    });
    return false;
   }



</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#icon_request').click(function() {
            $(".ti",this).toggleClass("ti-angle-right ti-angle-down");
        });
        $('#icon_release').click(function() {
            $(".ti",this).toggleClass("ti-angle-right ti-angle-down");
        });
    });
    $('.select2').select2({
        placeholder: "Please Select"
    });
    $('#btn-reset').click(function() {
        $("#param").val(null).trigger("change"); 
    });
</script>