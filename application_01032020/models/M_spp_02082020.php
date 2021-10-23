<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_spp extends CI_Model {

    public function __construct()
        {
            parent::__construct();
            $this->load->database();
            require_once(APPPATH.'libraries/nusoap/lib/nusoap.php');

        }

    public function validasi($id){

        $this->db->select('A.tgldoakhir,A.nobl');
        $this->db->from('tblreqdo_header A');
        $this->db->where('id_reqdo_header', $id);
        $row = $this->db->get()->row_array();
        $exp_date = $row['tgldoakhir'];
        $tglakhir = date('m/d/Y',strtotime($row['tgldoakhir']));
        $nobl = $row['nobl'];

        $sql = "select now() as tglsekarang";
        $query = $this->db->query($sql);
        $dataQuery = $query->row_array();
        $now_date = $dataQuery['tglsekarang'];
        $tglsekarang = date('m/d/Y',strtotime($dataQuery['tglsekarang']));

        if (strtotime($exp_date) < strtotime($now_date)) {
            $hasil = "error#Silahkan cek tanggal berlaku DO dan pastikan DO sudah SPPB";
        } else{
            $this->db->select('*');
            $this->db->from('v_bl_sppb_2');
            $this->db->where('nobl', $nobl);
            $jumlah = $this->db->get()->num_rows();

            if ($jumlah > 0) {
                $sql_header = "SELECT * from tblreqdo_header where id_reqdo_header = '".$id."'";
                $exec_header = $this->db->query($sql_header)->row_array();
                $kd_shippingline = $exec_header['kd_shippingline'];
                $noreqdo = $this->generate_request_no($kd_shippingline);
                $data_header = array(
                    'noreqdo' => $noreqdo,
                    'tglreqdo' => date('Y-m-d H:i:s'),
                    'nib_requestor' => $exec_header['nib_requestor'],
                    'npwp_requestor' => $exec_header['npwp_requestor'],
                    'nama_requestor' => $exec_header['nama_requestor'],
                    'alamat_requestor' => $exec_header['alamat_requestor'],
                    'status_requestor' => $exec_header['status_requestor'],
                    'carabayar' => $exec_header['carabayar'],
                    'nobl' => $exec_header['nobl'],
                    'tglbl' => $exec_header['tglbl'],
                    'pel_muat' => $exec_header['pel_muat'],
                    'pel_bongkar' => $exec_header['pel_bongkar'],
                    'pel_tujuan' => $exec_header['pel_tujuan'],
                    'nodo' => $exec_header['nodo'],
                    'statusreqdo' => '300',
                    'tgldoawal' => $exec_header['tgldoawal'],
                    'tgldoakhir' => $exec_header['tgldoakhir'],
                    'kd_shippingline' =>$exec_header['kd_shippingline'],
                    'kd_terminal' =>$exec_header['kd_terminal'],
                    'nomor_voyage' => $exec_header['nomor_voyage'],
                    'id_vessel' => $exec_header['id_vessel'],
                    'nama_vessel' => $exec_header['nama_vessel'],
                    'created_date' => 'now()'

                );

                $insert_header = $this->db->insert('tblreqdo_header',$data_header);
                $LastId  = $this->db->insert_id();
                if ($insert_header) {
                    $sql1 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$LastId."','300','".$this->session->userdata('username')."',now())";
                    $exec1 = $this->db->query($sql1);
                    $hasil = "success#SP2 Request Berhasil#" . site_url() . '/C_auth';
                } else {
                    $hasil = "error#please call administrator";
                }
                // $LastIdCon  = $this->db->insert_id();            
                // $relasi = $this->cekRelasi();
                // if ($relasi['STATUS']==="FALSE") {
                //  $hasil = "error#".$relasi['MESSAGE'];
                // } else{
                //  $hasil = "success#".$tglakhir;
                // }
            } else {
                $hasil = "error#Silahkan cek tanggal berlaku DO dan pastikan DO sudah SPPB";
            }

        }
        return $hasil;
    }

    // public function Login()
    // {
    //  $client = new nusoap_client('http://123.231.237.22/TPSOnlineServicesUAT/server.php?wsdl');

    //  $login_params = array('Username' => 'INSW', 'Password' => 'INSW123','fstream'=> '{"PASSWORD":"202cb962ac59075b964b07152d234b70","USERNAME":"INSW"}','deviceName' => 'INSW');
    //  $result = $client->call('AUTH_GetLogin', $login_params);
    //  $arr_res = json_decode($result,TRUE);
    //  $sessID = $arr_res['SESSIONID'];
    //  $this->session->set_userdata('sessID', $sessID);
    //  $this->cekRelasi();
    // }


    public function cekRelasi(){
        $id = $this->input->post('id_reqdo_header');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $pass = md5($password);
        $this->db->select('*');
        $this->db->from('tblreqdo_header');
        $this->db->where('id_reqdo_header', $id);
        $row = $this->db->get()->row_array();
        $fl_status = $row['statusreqdo'];
        
        if ($fl_status=='324') {
            $relasi = '{"STATUS":"PROFORMA","url_proforma":"'.$row['url_proforma'].'"}';
        } else{
            if ($fl_status == '300') {
                $sql1 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$id."','301','".$this->session->userdata('username')."',now())";
                $exec1 = $this->db->query($sql1);
                $sql2 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$id."','310','".$this->session->userdata('username')."',now())";
                $exec2 = $this->db->query($sql2);
                $sql3 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$id."','311','".$this->session->userdata('username')."',now())";
                $exec3 = $this->db->query($sql3);
            }

        // $userid = $this->session->userdata('userid');
        // $this->db->select('*');
        // $this->db->from('tbluser');
        // $this->db->where('userid', $userid);
        // $user = $this->db->get()->row_array();
        // $hp = $user['hp'];
        if(isset($_SESSION['sessID'])){
            $sesId = $this->session->userdata('sessID');
        } else {
            $client = new nusoap_client('http://123.231.237.22/TPSOnlineServices/server.php?wsdl');

            $login_params = array('Username' => 'INSW', 'Password' => 'INSW123','fstream'=> '{"PASSWORD":"'.$pass.'","USERNAME":"'.$username.'"}','deviceName' => 'INSW');
            $result = $client->call('AUTH_GetLogin', $login_params);
            $arr_res = json_decode($result,TRUE);
            $sessID = $arr_res['SESSIONID'];
            $custId =$arr_res['CUST_ID'];
            $this->session->set_userdata('sessID', $sessID);
            $this->session->set_userdata('custID',$custId);
            $sesId = $this->session->userdata('sessID');
            if ($fl_status == '300') {
               $data = array(
                    'statusreqdo' => '320'
                );
                $where = array("id_reqdo_header" => $id);
                $exec = $this->db->update('tblreqdo_header', $data, $where);
                if ($exec) {
                    $sql4 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$id."','320','".$this->session->userdata('username')."',now())";
                    $exec4 = $this->db->query($sql4);
                }
            }
        }

        // $sesId = $this->session->userdata('sessID');
        // if (empty($sesId)) {
        //     $client = new nusoap_client('http://123.231.237.22/TPSOnlineServices/server.php?wsdl');

        //     $login_params = array('Username' => 'INSW', 'Password' => 'INSW123','fstream'=> '{"PASSWORD":"202cb962ac59075b964b07152d234b70","USERNAME":"INSW"}','deviceName' => 'INSW');
        //     $result = $client->call('AUTH_GetLogin', $login_params);
        //     $arr_res = json_decode($result,TRUE);
        //     $sessID = $arr_res['SESSIONID'];
        //     $this->session->set_userdata('sessID', $sessID);
        //     $sesId = $this->session->userdata('sessID');
        //     if ($fl_status == '300') {
        //        $data = array(
        //             'statusreqdo' => '320'
        //         );
        //         $where = array("id_reqdo_header" => $id);
        //         $exec = $this->db->update('tblreqdo_header', $data, $where);
        //         if ($exec) {
        //             $sql4 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$id."','320','".$this->session->userdata('username')."',now())";
        //             $exec4 = $this->db->query($sql4);
        //         }
        //     }
        // } 
        $npwp_ambil = $this->session->userdata('F_npwp');
        // $npwp_ambil = "033147794001000";
        $a  = substr($npwp_ambil,0,2);
        $b  = substr($npwp_ambil,2,3);
        $c  = substr($npwp_ambil,5,3);
        $d  = substr($npwp_ambil,8,1);
        $e  = substr($npwp_ambil,9,3);  
        $f  = substr($npwp_ambil,12,3);
        $npwp = $a.".".$b.".".$c.".".$d."-".$e.".".$f;
        $client = new nusoap_client('http://123.231.237.22/TPSOnlineServices/server.php?wsdl');
        $cus_params = array('Username' => 'INSW', 'Password' => 'INSW123','Creator'=>$sesId,'fStream'=> '{"CUST_TYPE_ID":"PPJK",
                  "DEPO_OBX":"",
                  "PARAMETER_STATUS":"",
                  "PARAMETER_EQUAL":"=",
                  "CUST_ID_PPJK":"",
                  "TERMINAL_ID":"KOJA",
                  "PARAMETER_EQUAL_CUST_TYPE":"=",
                  "PARAMETER_VALUE":"'.$npwp.'",
                  "PARAMETER_ID":"NPWP"}');
        $resCust = $client->call('MAIN_GetCustomersNew', $cus_params); //03.314.779.4-001.000
        $Custres = json_decode($resCust,TRUE);
        if ($Custres['STATUS']=="FALSE") {
            $data = array(
                    'statusreqdo' => '323'
            );
            $where = array("id_reqdo_header" => $id);
            $exec = $this->db->update('tblreqdo_header', $data, $where);
                if ($exec) {
                    $sql5 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$id."','323','".$this->session->userdata('username')."',now())";
                    $exec5 = $this->db->query($sql5);
                }
            
            $relasi = $resCust;
        } else {
            $custID  = $Custres['CUST_ID'][0];
            $relate_params = array('Username' => 'INSW', 'Password' => 'INSW123','Creator'=>$sesId,'fStream'=> '{"CUST_ID_SENDER":"'.$custID.'","CUST_ID_RECEIVER":""}');
            $result_rel = $client->call('BILLING_GetDataRelationship', $relate_params);
            $resRel = json_decode($result_rel,TRUE); 
            $relasi = $result_rel;
            // $sql6 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$id."','322','".$this->session->userdata('username')."',now())";
            // $exec6 = $this->db->query($sql6);
        }
        }
        return $relasi;

    }

    public function Logout(){
        $client = new nusoap_client('http://123.231.237.22/TPSOnlineServices/server.php?wsdl');

        $logout_params = array('Username' => 'INSW', 'Password' => 'INSW123','fstream'=> '{"SESSIONID":"1081973"}');
        $result = $client->call('AUTH_GetLogOut', $logout_params);
         print_r($result);die('test logout');
    }

    public function getContainer($id){

        // $client = new nusoap_client('http://123.231.237.22/TPSOnlineServicesUAT/server.php?wsdl');

        // $login_params = array('Username' => 'INSW', 'Password' => 'INSW123','fstream'=> '{"PASSWORD":"202cb962ac59075b964b07152d234b70","USERNAME":"INSW"}','deviceName' => 'INSW');
        // $result = $client->call('AUTH_GetLogin', $login_params);
        // $arr_res = json_decode($result,TRUE);
        // $sessID = $arr_res['SESSIONID'];
        // $this->session->set_userdata('sessID', $sessID);

        $this->db->select('A.nobl');
        $this->db->from('tblreqdo_header A');
        $this->db->where('id_reqdo_header', $id);
        $row = $this->db->get()->row_array();
        $nobl = $row['nobl'];

        if ($nobl!= '1234567890') {
            $this->db->select('*');
            $this->db->from('v_bl_sppb_2');
            $this->db->where('nobl', $nobl);
            $rowSppb = $this->db->get()->row_array();
            $nosppb = $rowSppb['nosppb'];
        } else{
            $nosppb = '555555';
        }


        
        $sesId = $this->session->userdata('sessID');
        $cusId = $this->session->userdata('custID');
        $client = new nusoap_client('http://123.231.237.22/TPSOnlineServices/server.php?wsdl');
        $con_params = array('Username' => 'INSW', 'Password' => 'INSW123','Creator'=>$sesId,'fStream'=> '{"NPWP_DEPO":"","DOCUMENT_NO":"'.$nosppb.'","CUSTOMS_DOCUMENT_ID":"1","TRANSACTIONS_TYPE_ID":"1","DOCUMENT_SHIPPING_DATE":"","DOCUMENT_DATE":"","DOCUMENT_SHIPPING_NO":"","CUST_ID_PPJK":"'.$cusId.'","TERMINAL_ID":"KOJA"}');
        $resCon = $client->call('MAIN_GetDocumentCustomsNGen', $con_params); //03.314.779.4-001.000
        $Conres = json_decode($resCon,TRUE);
        return $Conres;
    }

    public function getProforma(){
        $id = $this->input->post('id_reqdo_header');
        $cek_cont = $this->input->post('cek_cont');
        $arr_con = explode(',', $cek_cont);
        $paid = $this->input->post('paid');
        $custId = $this->input->post('cust_id');
        $no_con = array();
        $owner_con = array();
        $sender_con = array();
        $vessel_id_con = array();
        $voyage_no_con = array();
        foreach ($arr_con as $con ) {
            $tampung = explode("~", $con);
            $no_con[]=$tampung[0];
            $owner_con[]=$tampung[1];
            $sender_con[] = $tampung[2];
            $vessel_id_con[] = $tampung[3];
            $voyage_no_con[] = $tampung[4];
        }
        $no_cont  = json_encode($no_con);
        $owner = json_encode($owner_con);
        $sender = json_encode($sender_con);
        $vessel_id = json_encode($vessel_id_con);
        $voyage_no = json_encode($voyage_no_con);
        $this->db->select('*');
        $this->db->from('tblreqdo_header A');
        $this->db->where('id_reqdo_header', $id);
        $row = $this->db->get()->row_array();
        $nobl = $row['nobl'];
        $nodo = $row['nodo'];
        $tgldo = date('Y-m-d',strtotime($row['tgldoakhir']));
        $paid_thru = date('Y-m-d',strtotime($paid));

        //get data sppb
        $this->db->select('*');
        $this->db->from('v_bl_sppb');
        $this->db->where('nobl', $nobl);
        $rowSppb = $this->db->get()->row_array();
        $nosppb = $rowSppb['nosppb'];
        $tglsppb = date('Ymd',strtotime($rowSppb['tglsppb'])); 
        //get data user
        $sesId = $this->session->userdata('sessID');
        $userid = $this->session->userdata('userid');
        $this->db->select('*');
        $this->db->from('tbluser');
        $this->db->where('userid', $userid);
        $user = $this->db->get()->row_array();
        $hp = $user['hp'];
        $email = $user['email'];
        $client = new nusoap_client('http://123.231.237.22/TPSOnlineServices/server.php?wsdl');
        // $con_params = array('Username' => 'INSW', 'Password' => 'INSW123','Creator'=>$sesId,'fStream'=> '{"CERTIFICATED_ID":[""],"OLD_COMPANY_CODE":"","CUST_ID":"39161","ISO_CODE":[""],"TRANSACTIONS_TYPE_ID":"1","OVER_RIGHT":[""],"DOCUMENT_SHIPPING_NO":"HDMUAWJT0891765","OLD_VOYAGE_NO":"","START_PLUG":[],"OVER_LEFT":[""],"OWNER":["KOJA"],"PM_ID":"C","DOCUMENT_SHIPPING_DATE":"2020-03-20","VOYAGE_NO":"001","COMPANY_CODE":"KOJA","WEIGHT":[""],"CERTIFICATED_PIC":[""],"OLD_VESSEL_ID":"","IMO_CODE":[""],"UN_NUMBER":[""],"VESSEL_ID":"DUMMYK","POD":[""],"CUST_SERTIFICATED":[""],"DOCUMENT_DATE":"20200123","STOP_PLUG":[""], "CUST_ID_PPJK":"372054","POL":[""],"OLD_INVOICE_NO":"010.000-20.","EMAIL_REQ":"yoga.indra@edi-indonesia.co.id","FD":[""],"NO_CONT":'.$no_cont.',"REFEER_TEMPERATURE":[""],"VOLTAGE_PLUG":[""],"TGL_NHI":"","OLD_POD":[""],"CUSTOMS_DOCUMENT_ID":"1","NO_BL_AWB":"HDMUAWJT0891765","WEIGHT_VGM":[""],"OLD_NO_CONT":[""],"NPWP_SERTIFICATED":[""],"PHONE_REQ":"087734194342","DOCUMENT_NO":"555555","OLD_FD":[""],"OVER_FRONT":[""],"OVER_BACK":[""],"PAID_THRU":"2020-03-14","TGL_BK_SEGEL_NHI":"","QUEUE_COUNTER_ID":"9999","CUST_ID_REQ":"372054","OVER_HEIGHT":[""]}');
        $con_params = array('Username' => 'INSW', 'Password' => 'INSW123','Creator'=>$sesId,'fStream'=> '{"CERTIFICATED_ID":[""],"OLD_COMPANY_CODE":"","CUST_ID":"7130","ISO_CODE":[""],"TRANSACTIONS_TYPE_ID":"1","OVER_RIGHT":[""],"DOCUMENT_SHIPPING_NO":"DOARM00179698","OLD_VOYAGE_NO":"","START_PLUG":[],"OVER_LEFT":[""],"OWNER":["CNC"],"PM_ID":"C","DOCUMENT_SHIPPING_DATE":"2020-07-30","VOYAGE_NO":"104N","COMPANY_CODE":"HMMC","WEIGHT":[""],"CERTIFICATED_PIC":[""],"OLD_VESSEL_ID":"","IMO_CODE":[""],"UN_NUMBER":[""],"VESSEL_ID":"HYWARD","POD":[""],"CUST_SERTIFICATED":[""],"DOCUMENT_DATE":"20200727","STOP_PLUG":[""],"CUST_ID_PPJK":"404954","POL":[""],"OLD_INVOICE_NO":"010.000-20.","EMAIL_REQ":"Suci.adelia@unilever.com","FD":[""],"NO_CONT":["APZU3795907"],"REFEER_TEMPERATURE":[""],"VOLTAGE_PLUG":[""],"TGL_NHI":"","OLD_POD":[""],"CUSTOMS_DOCUMENT_ID":"1","NO_BL_AWB":"AHCM004102","WEIGHT_VGM":[""],"OLD_NO_CONT":[""],"NPWP_SERTIFICATED":[""],"PHONE_REQ":"081295413317","DOCUMENT_NO":"331875\/KPU.01\/2020","OLD_FD":[""],"OVER_FRONT":[""],"OVER_BACK":[""],"PAID_THRU":"2020-07-27","TGL_BK_SEGEL_NHI":"","QUEUE_COUNTER_ID":"9999","CUST_ID_REQ":"404954","OVER_HEIGHT":[""]}');
        print_r($con_params);
        $resBill = $client->call('BILLING_ConfirmTransaction', $con_params); //03.314.779.4-001.000
        $Billres = json_decode($resBill,TRUE);
        if ($Billres['STATUS']!="TRUE") {
            $balikan = $resBill;
        } else{
            $id_transaction = $Billres["TRANSACTION_ID"];
            $bill_params = array('Username' => 'INSW', 'Password' => 'INSW123','Creator'=>$sesId,'fStream'=>'{"TRANSACTION_ID":"'.$id_transaction.'"}');
            $get_bill = $client->call('BILLING_GetBilling', $bill_params);
            $arr_bill = json_decode($get_bill,TRUE);
            $pro_params = array('Username' => 'INSW', 'Password' => 'INSW123','Creator'=>$sesId,'fStream'=> '{"TRANSACTION_ID":"'.$id_transaction.'"}');
            $resPro = $client->call('BILLING_GetProforma', $pro_params);
            if ($arr_bill['STATUS']== "TRUE") {
                $data = array(
                    'statusreqdo' => '324',
                    'url_proforma' => $arr_bill['DETAIL_BILLING']['LINK_PRO'],
                    'url_invoice' => $arr_bill['DETAIL_BILLING']['LINK'],
                    'no_proforma' => $arr_bill['DETAIL_BILLING']['PROFORMA_INVOICE_NO'],
                    'data_proforma' => $get_bill
                );
                $where = array("id_reqdo_header" => $id);
                $exec = $this->db->update('tblreqdo_header', $data, $where);
                $sql = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$id."','324','".$this->session->userdata('username')."',now())";
                $exec = $this->db->query($sql);
            }
            $balikan = json_encode($arr_bill);
        }
        
        return $balikan;
    }

    public function getFormProforma($id_reqdo_header){
        $id = $id_reqdo_header;
        $this->db->select('*');
        $this->db->from('tblreqdo_header A');
        $this->db->where('id_reqdo_header', $id);
        $row = $this->db->get()->row_array();
        $data_proforma = $row['data_proforma'];
        $data = json_decode($data_proforma,TRUE);
        return $data;
    }


    public function releaseSP2($id){
        $userid = $this->session->userdata('userid');
        $this->db->select('*');
        $this->db->from('tbluser');
        $this->db->where('userid', $userid);
        $user = $this->db->get()->row_array();
        $hp = $user['hp'];
        if(isset($_SESSION['sessID'])){
            $sesId = $this->session->userdata('sessID');
        } else {
             $client = new nusoap_client('http://123.231.237.22/TPSOnlineServices/server.php?wsdl');

            $login_params = array('Username' => 'INSW', 'Password' => 'INSW123','fstream'=> '{"PASSWORD":"202cb962ac59075b964b07152d234b70","USERNAME":"'.$hp.'"}','deviceName' => 'INSW');
            $result = $client->call('AUTH_GetLogin', $login_params);
            $arr_res = json_decode($result,TRUE);
            $sessID = $arr_res['SESSIONID'];
            $this->session->set_userdata('sessID', $sessID);
            $sesId = $this->session->userdata('sessID');
        }
        $this->db->select('*');
        $this->db->from('tblreqdo_header A');
        $this->db->where('id_reqdo_header', $id);
        $row = $this->db->get()->row_array();
        $nopro = $row['no_proforma'];

        $client = new nusoap_client('http://123.231.237.22/TPSOnlineServices/server.php?wsdl');
        $params = array('Username' => 'INSW', 'Password' => 'INSW123','Creator'=>$sesId,'fStream'=> '{"TRANSACTIONS_TYPE_ID":"","PROFORMA_INVOICE_NO":"'.$nopro.'","INVOICE_NO":""}');

        $res = $client->call('BILLING_GetBillingDetail', $params);
        $arr_res = json_decode($res,TRUE);
        if ($arr_res['STATUS']=="TRUE") {
            if (empty($arr_res['DETAIL_BILLING']['INVOICE_NO'])) {
                $hasil = "error#Silahkan Melakukan Pembayaran";
            } else{
                $data = array(
                    'statusreqdo' => '420'
                );
                $where = array("id_reqdo_header" => $id);
                $exec = $this->db->update('tblreqdo_header', $data, $where);
                    if ($exec) {
                        $sql1 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$id."','325','".$this->session->userdata('username')."',now())";
                        $exec1 = $this->db->query($sql1);
                        $sql2 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$id."','400','".$this->session->userdata('username')."',now())";
                        $exe2 = $this->db->query($sql2);
                        $sql3 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$id."','410','".$this->session->userdata('username')."',now())";
                        $exec3 = $this->db->query($sql3);
                        $sql4 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$id."','411','".$this->session->userdata('username')."',now())";
                        $exec4 = $this->db->query($sql4);
                        $sql5 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$id."','420','".$this->session->userdata('username')."',now())";
                        $exec5 = $this->db->query($sql5);
                        $hasil = "success#Berhasil Release#" . site_url() . '/C_auth';
                    } else {
                        $hasil = "error#Belum Berhasil Release#" . site_url() . '/C_auth';
                }
            }
        } else{
           $hasil = "error#".$arr_res['MESSAGE']; 
        }
        

        return $hasil;


    }

    public function getSP2($id){
        $this->db->select('A.*');
        $this->db->from('tblreqdo_header A');
        $this->db->where('id_reqdo_header', $id);
        $row = $this->db->get()->row_array();
        $proforma = json_decode($row['data_proforma'],TRUE);
        $cont = $proforma['DETAIL_BILLING']['NO_CONT'];
        $con = json_encode($cont);
        $pro = $row['no_proforma'];
        // print_r($cont);die('test');

        $jsonData = '{"CONTAINER":'.$con.',"PROFORMA":"'.$pro.'","ACTION":"V"}';
        $coba = urlencode($jsonData);
        $ch = curl_init();
            // Disable SSL verification
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_URL, "http://123.231.237.4/cms-kiosk/app/module/eticketqr?ID=".$coba."&FILENAME=eticket&METHOD=F");            
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function generate_request_no($ship){
        $date = date("Ymd");
        $sql = "SELECT right(noreqdo,4),created_date from tblreqdo_header where substring(noreqdo,1,4)='LNSW' order by id_reqdo_header desc";
        $query = $this->db->query($sql);
        $row = $query->row_array();


        $nomor = intval($row['right']);
        $created_dt = $row['created_date'];
        $created_date = date('Y-m-d',strtotime($created_dt));
        $now_date = date('Y-m-d');

        if ($created_date!=$now_date) {
            $request_no = '0000';
            // $req_no = $nomor+1;
            // $request_no = sprintf("%04s",$req_no);
        } else{
            $req_no = $nomor+1;
            $request_no = sprintf("%04s",$req_no);
        }
        
        $kode = 'LNSW'.$date.$ship.'1'.$request_no;
        return $kode;
    }

    public function getDataDetailSP2($id_reqdo_header)
    {
        $this->db->select('A.*,B.*');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tblrefshippingline B','A.kd_shippingline=B.kode');
        $this->db->where('id_reqdo_header',$id_reqdo_header);
        $hasil['header'] = $this->db->get()->row_array();
        $hasil['detail'] = json_decode($hasil['header']['data_proforma'],TRUE);
        return $hasil;
    }

    public function cekDetailSP2($id_reqdo_header)
    {
        $this->db->select('*');
        $this->db->from('tblreqdo_header A');
        $this->db->where('id_reqdo_header',$id_reqdo_header);
        $hasil = $this->db->get()->row_array();
        $status = $hasil['statusreqdo'];
        if ($status == '324' or $status == '420') {
             $return = "success#";
        } else {
            $return = "error#Silahkan Ajukan Proforma";   
        }
        return $return;
    }
    

}

/* End of file M_spp.php */
/* Location: ./application/models/M_spp.php */
?>