<!DOCTYPE html>
<html style="background-color: #fff;">
    <head>
        <?php $this->load->view('cms/shared/v_header');?>
    </head>
    <body>
        <?php $this->load->view('cms/shared/v_navbar');?>
        <div class="wrapper" style="padding-top: 90px !important;">
            <?php $this->load->view($_content);?>
        </div>
        <!-- end wrapper -->
        <!-- Footer&js -->
        <?php $this->load->view('cms/shared/v_footer');?>
    </body>
</html>