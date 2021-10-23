<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cargo extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        require_once(APPPATH.'libraries/nusoap/lib/nusoap.php');
    }

    public function getDataTableRequest()
    {
        $this->db->select('A.*,B.uraian,C.uraian as shipping');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tbltab B','A.statusreqdo=B.kdnsw AND B.kdtab = \'D4\'','left');
        $this->db->join('tblrefshippingline C','A.kd_shippingline=C.kode','left');
        // $this->db->where('nodo is NULL', null, false);
        $this->db->where("(statusreqdo='100' OR statusreqdo='101' OR statusreqdo='110' OR statusreqdo='111' OR statusreqdo='120' OR statusreqdo='121' OR statusreqdo='203')", NULL, FALSE);
        if ($this->session->userdata('group')!= '1200' && $this->session->userdata('group')!= '1280') {
            $this->db->where('npwp_requestor',$this->session->userdata('F_npwp'));
        }
        $this->db->order_by('A.id_reqdo_header','DESC');
        $hasil = $this->db->get()->result_array();
        return $hasil;
    }

    public function getDataTableRelease()
    {
        $nobl = $this->input->post('no_bl');
        $limit = $_POST['length'];
        $offset = $_POST['start'];
        
        $this->db->select('A.*,B.uraian');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tbltab B','A.statusreqdo=B.kdnsw AND B.kdtab = \'D4\'','left');
        $this->db->where('nodo is NOT NULL', null, false);
        $this->db->where("(statusreqdo='210' OR statusreqdo='211' OR statusreqdo='212' OR statusreqdo='213' OR statusreqdo='214' OR statusreqdo='215')", NULL, FALSE);
        if($nobl) {
            $this->db->where('nobl', $nobl);
        } else {
            if ($this->session->userdata('group')!= '1200' && $this->session->userdata('group')!= '1280') {
                $this->db->where('npwp_requestor',$this->session->userdata('F_npwp'));
            } 
        }
        
        $cari = $_POST["search"]["value"];
        if (isset($_POST["search"]["value"])){
            $this->db->where("(noreqdo LIKE '%".$cari."%' OR nobl LIKE '%".$cari."%' OR nodo LIKE '%".$cari."%' OR nama_requestor LIKE '%".$cari."%' OR kd_shippingline LIKE '%".$cari."%')", NULL, FALSE);
        }
        $this->db->order_by('A.id_reqdo_header','DESC');
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST["length"],$_POST["start"]);
        }
        $hasil = $this->db->get()->result();
        return $hasil;
    }

    public function getDataTableRequestSP2()
    {
        $limit = $_POST['length'];
        $offset = $_POST['start'];
        $this->db->select('A.*,B.uraian');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tbltab B','A.statusreqdo=B.kdnsw AND B.kdtab = \'D4\'','left');
        $this->db->where('nodo is NOT NULL', null, false);
        $this->db->where("(statusreqdo='300' OR statusreqdo='310' OR statusreqdo='324' OR statusreqdo='320')", NULL, FALSE);
        if ($this->session->userdata('group')!= '1200' && $this->session->userdata('group')!= '1280') {
            $this->db->where('npwp_requestor',$this->session->userdata('F_npwp'));
        }
        $cari = $_POST["search"]["value"];
        if (isset($_POST["search"]["value"])){
            $this->db->where("(noreqdo LIKE '%".$cari."%' OR nobl LIKE '%".$cari."%' OR nodo LIKE '%".$cari."%' OR nama_requestor LIKE '%".$cari."%' OR kd_shippingline LIKE '%".$cari."%')", NULL, FALSE);
        }
        $this->db->order_by('A.id_reqdo_header','DESC');
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST["length"],$_POST["start"]);
        }
        $hasil = $this->db->get()->result();
        return $hasil;
    }

    public function getDataTableReleaseSP2()
    {
        $limit = $_POST['length'];
        $offset = $_POST['start'];
        $this->db->select('A.*,B.uraian');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tbltab B','A.statusreqdo=B.kdnsw AND B.kdtab = \'D4\'','left');
        $this->db->where('nodo is NOT NULL', null, false);
        $this->db->where("(statusreqdo='420' OR statusreqdo='430')", NULL, FALSE);
        if ($this->session->userdata('group')!= '1200' && $this->session->userdata('group')!= '1280') {
            $this->db->where('npwp_requestor',$this->session->userdata('F_npwp'));
        }
        $cari = $_POST["search"]["value"];
        if (isset($_POST["search"]["value"])){
            $this->db->where("(noreqdo LIKE '%".$cari."%' OR nobl LIKE '%".$cari."%' OR nodo LIKE '%".$cari."%' OR nama_requestor LIKE '%".$cari."%' OR kd_shippingline LIKE '%".$cari."%')", NULL, FALSE);
        }
        $this->db->order_by('A.id_reqdo_header','DESC');
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST["length"],$_POST["start"]);
        }
        $hasil = $this->db->get()->result();
        return $hasil;
    }


    public function getFilteredData()
    {
        $nobl = $this->input->post('no_bl');
        $limit = $_POST['length'];
        $offset = $_POST['start'];
        $this->db->select('A.*,B.uraian');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tbltab B','A.statusreqdo=B.kdnsw AND B.kdtab = \'D4\'','left');
        $this->db->where('nodo is NOT NULL', null, false);
        $this->db->where("(statusreqdo='210' OR statusreqdo='211' OR statusreqdo='212' OR statusreqdo='213' OR statusreqdo='214' OR statusreqdo='215')", NULL, FALSE);
        if($nobl) {
            $this->db->where('nobl', $nobl);
        } else {
            if ($this->session->userdata('group')!= '1200' && $this->session->userdata('group')!= '1280') {
                $this->db->where('npwp_requestor',$this->session->userdata('F_npwp'));
            } 
        }
        $cari = $_POST["search"]["value"];
        if (isset($_POST["search"]["value"])){
            $this->db->where("(noreqdo LIKE '%".$cari."%' OR nobl LIKE '%".$cari."%' OR nodo LIKE '%".$cari."%' OR nama_requestor LIKE '%".$cari."%' OR kd_shippingline LIKE '%".$cari."%')", NULL, FALSE);
        }
        $hasil = $this->db->get()->num_rows();
        return $hasil;
    }
 
    public function count_all()
    {
        $nobl = $this->input->post('no_bl');
        $this->db->select('count(id_reqdo_header)');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tbltab B','A.statusreqdo=B.kdnsw AND B.kdtab = \'D4\'','left');
        if($nobl) {
            $this->db->where('nobl', $nobl);
        } else {
            if ($this->session->userdata('group')!= '1200' && $this->session->userdata('group')!= '1280') {
                $this->db->where('npwp_requestor',$this->session->userdata('F_npwp'));
            } 
        }
        $this->db->where('nodo is NOT NULL', null, false);
        $this->db->where("(statusreqdo='210' OR statusreqdo='211' OR statusreqdo='212' OR statusreqdo='213' OR statusreqdo='214' OR statusreqdo='215')", NULL, FALSE);
       
        $hasil = $this->db->get()->row_array();
        return $hasil['count'];
    }

    public function getFilteredDataSP2()
    {
        $limit = $_POST['length'];
        $offset = $_POST['start'];
        $this->db->select('A.*,B.uraian');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tbltab B','A.statusreqdo=B.kdnsw AND B.kdtab = \'D4\'','left');
        $this->db->where('nodo is NOT NULL', null, false);
        $this->db->where("(statusreqdo='300' OR statusreqdo='310' OR statusreqdo='324' OR statusreqdo='320')", NULL, FALSE);
        if ($this->session->userdata('group')!= '1200' && $this->session->userdata('group')!= '1280') {
            $this->db->where('npwp_requestor',$this->session->userdata('F_npwp'));
        }
        $cari = $_POST["search"]["value"];
        if (isset($_POST["search"]["value"])){
            $this->db->where("(noreqdo LIKE '%".$cari."%' OR nobl LIKE '%".$cari."%' OR nodo LIKE '%".$cari."%' OR nama_requestor LIKE '%".$cari."%' OR kd_shippingline LIKE '%".$cari."%')", NULL, FALSE);
        }
        $hasil = $this->db->get()->num_rows();
        return $hasil;
    }
 
    public function count_all_sp2()
    {
        $this->db->select('count(id_reqdo_header)');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tbltab B','A.statusreqdo=B.kdnsw AND B.kdtab = \'D4\'','left');
        if ($this->session->userdata('group')!= '1200' && $this->session->userdata('group')!= '1280') {
            $this->db->where('npwp_requestor',$this->session->userdata('F_npwp'));
        }
        $this->db->where('nodo is NOT NULL', null, false);
        $this->db->where("(statusreqdo='300' OR statusreqdo='310' OR statusreqdo='324' OR statusreqdo='320')", NULL, FALSE);
       
        $hasil = $this->db->get()->row_array();
        return $hasil['count'];
    }

    public function getFilteredDataReleaseSP2()
    {
        $limit = $_POST['length'];
        $offset = $_POST['start'];
        $this->db->select('A.*,B.uraian');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tbltab B','A.statusreqdo=B.kdnsw AND B.kdtab = \'D4\'','left');
        $this->db->where('nodo is NOT NULL', null, false);
        $this->db->where("(statusreqdo='420' OR statusreqdo='430')", NULL, FALSE);
        if ($this->session->userdata('group')!= '1200' && $this->session->userdata('group')!= '1280') {
            $this->db->where('npwp_requestor',$this->session->userdata('F_npwp'));
        }
        $cari = $_POST["search"]["value"];
        if (isset($_POST["search"]["value"])){
            $this->db->where("(noreqdo LIKE '%".$cari."%' OR nobl LIKE '%".$cari."%' OR nodo LIKE '%".$cari."%' OR nama_requestor LIKE '%".$cari."%' OR kd_shippingline LIKE '%".$cari."%')", NULL, FALSE);
        }
        $hasil = $this->db->get()->num_rows();
        return $hasil;
    }
 
    public function count_all_Releasesp2()
    {
        $this->db->select('count(id_reqdo_header)');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tbltab B','A.statusreqdo=B.kdnsw AND B.kdtab = \'D4\'','left');
        if ($this->session->userdata('group')!= '1200' && $this->session->userdata('group')!= '1280') {
            $this->db->where('npwp_requestor',$this->session->userdata('F_npwp'));
        }
        $this->db->where('nodo is NOT NULL', null, false);
        $this->db->where("(statusreqdo='420' OR statusreqdo='430')", NULL, FALSE);
       
        $hasil = $this->db->get()->row_array();
        return $hasil['count'];
    }

    public function getDataFormDetail($id_reqdo_header)
    {
        $this->db->select('A.*,B.*');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tblrefshippingline B','A.kd_shippingline=B.kode');
        $this->db->where('id_reqdo_header',$id_reqdo_header);
        $hasil = $this->db->get()->row_array();
        return $hasil;
    }

    public function getDataFormContainer($id_reqdo_header)
    {
        // $this->db->select('A.*,B.kdnsw,B.uraian');
        // $this->db->from('tblreqdo_container A');
        // $this->db->join('tbltab B','A.ownership=B.kdnsw','left outer');
        // $this->db->where('A.id_reqdo_header',$id_reqdo_header);
        // $this->db->where('B.kdnsw','D6');
        $this->db->select('A.*');
        $this->db->from('tblreqdo_container A');
        $this->db->where('A.id_reqdo_header',$id_reqdo_header);
        $hasil = $this->db->get()->result_array();
        // print_r($data_seal);die('test');
        $container = array();
        foreach ($hasil as $data_con) {

            $id_con = $data_con["id_reqdo_container"];
            $data_seal = $this->getDataFormSeal($id_con);
            array_push($data_con, $data_seal);
            array_push($container,$data_con);       
        }

        // die('test');
        return $container;
    }

    public function getDataFormSeal($id_con)
    {
        // $this->db->select('A.*,B.kdnsw,B.uraian');
        // $this->db->from('tblreqdo_container A');
        // $this->db->join('tbltab B','A.ownership=B.kdnsw','left outer');
        // $this->db->where('A.id_reqdo_header',$id_reqdo_header);
        // $this->db->where('B.kdnsw','D6');
        $sql = "SELECT no_seal FROM tblreqdo_container_seal where id_reqdo_container = '$id_con'";
        $exec = $this->db->query($sql);
        $hasil = $exec->result_array();
        $tampung = array();
        foreach ($hasil as $h) {
            $var = '';
            foreach ($h as $ha) {
                $var = $ha;
                array_push($tampung, $var);
            }
        }

        return $tampung;
    }

    public function getDataFormPayment($id_reqdo_header){
        $this->db->select('A.*,B.*,C.nm_bank');
        $this->db->from('tblreqdo_buktibayar A');
        $this->db->join('tblreqdo_dok B','A.id_reqdo_dok = B.id_reqdo_dok');
        $this->db->join('nswdb2.ter_bank C', 'A.kd_bank = C.kd_bank','left');
        $this->db->where('id_reqdo_header',$id_reqdo_header);
        $hasil = $this->db->get()->result_array();
        return $hasil;
    }

    public function getDataFormDoc($id_reqdo_header){
        $jns = array('4', '5','6','9');
        $this->db->select('A.*');
        $this->db->from('tblreqdo_dok A');
        $this->db->where_in('A.jenis_dok', $jns);
        $this->db->where('A.id_reqdo_header',$id_reqdo_header);

        $hasil = $this->db->get()->result_array();
        return $hasil;
    }

    public function getDataShipping(){
        $hasil = $this->db->get('tblrefshippingline')->result_array();
        return $hasil;
    }


    public function getDataPel(){
        $hasil = $this->db->get('tblpeldn')->result_array();
        return $hasil;
    }

    public function getDataPelLuar($id_negara){
        $sql  = "select * from tblpelln where substring(kdedi,1,2)='$id_negara'";
        $query  = $this->db->query($sql);
        $hasil  = $query->result_array();
        return $hasil;
    }

    public function getDataNegara(){
        $hasil = $this->db->get('tblnegara')->result_array();
        return $hasil;
    }

    public function getDataBank(){
        $hasil = $this->db->get('nswdb2.ter_bank')->result_array();
        return $hasil;
    }

    public function getDataSizeType(){
        $hasil = $this->db->get('tblreftipecont')->result_array();
        return $hasil;
    }

    public function getPelMuat($id_reqdo_header){
        $this->db->select('A.pel_muat,B.uredi');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tblpelln B','A.pel_muat=B.kdedi');
        $this->db->where('id_reqdo_header',$id_reqdo_header);
        $hasil = $this->db->get()->row_array();
        return $hasil;
    }

    public function getPelBongkar($id_reqdo_header){
        $this->db->select('A.pel_bongkar,B.uredi');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tblpeldn B','A.pel_bongkar=B.kdedi');
        $this->db->where('id_reqdo_header',$id_reqdo_header);
        $hasil = $this->db->get()->row_array();
        return $hasil;
    }

    public function getPelTujuan($id_reqdo_header){
        $this->db->select('A.pel_tujuan,B.uredi');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tblpeldn B','A.pel_tujuan=B.kdedi');
        $this->db->where('id_reqdo_header',$id_reqdo_header);
        $hasil = $this->db->get()->row_array();
        return $hasil;
    }

    public function ExecDeleteRequest(){
        $id_reqdo_header = $this->input->post('id');
        $where = array("id_reqdo_header" => $id_reqdo_header);
        $exec = $this->db->delete('tblreqdo_header', $where);
        if ($exec) {
            $return = "msg#success#Request Deleted#".site_url().'/C_auth';
        } else {
            $return = "msg#success# Can't Delete Request, Please Contact Administrato#";
        }
        return $return;
    }

    public function ExecRequest(){

        $request = $this->input->post('input');
        $shipping_line = $this->input->post('shipping_line');
        // $req_no = $this->generate_request_no($shipping_line);

        $sql_func = "SELECT fgetnoreqdo('".$shipping_line."') as nomor";   
        $query_func = $this->db->query($sql_func);
        $array_func = $query_func->row_array();
        $req_no = $array_func['nomor'];

        $request['kd_shippingline'] = $shipping_line;
        $request['tglreqdo'] = date('Y-m-d H:i:s');
        $request['created_date'] = date('Y-m-d H:i:s');
        $request['created_by'] = $this->session->userdata('username');
        $action = $this->input->post('action');
        $no_bl = $request['nobl'];
        $no_container = $this->input->post('no_container');
        

        
        if ($_FILES['filepath_requestor']['name']!="") {
            $folder_path = "requestor";
            $folderName = "../upload/" . $folder_path;
            $config['upload_path']          = $folderName;
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 2048000;
            $new_name = time().$_FILES['filepath_requestor']['name'];
            $config['file_name'] = $new_name;
            if (!is_dir($folderName)) {
                mkdir($folderName, 0777, true);
                chmod($folderName, 0777);
            }

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('filepath_requestor')){
                $data = $this->upload->data();
                $file_name = $data['file_name'];
                $request["filepath_requestor"] = $file_name;
                $full_path = $data['full_path'];
                $headers = array("Content-Type:multipart/form-data"); 
                $filenya = 'https://apps1.insw.go.id/upload/meta/'.$file_name;
                $postFields = array();
                $postFields['file'] = '@' . realpath($full_path);
                $curl = curl_init("10.1.6.153/engMetadata/engine/file/updatemetadata");
                // $curl = curl_init("10.1.6.153/engMetadata/uploadFile"); 
                // curl_setopt($curl, curl_, value)
                curl_setopt($curl, CURLOPT_HTTPHEADER, array( //custom header for my api validation you can get it from $_SERVER["HTTP_X_PARAM_TOKEN"] variable
                         "Content-Type: multipart/form-data;") //setting our mime type for make it work on $_FILE variable
                    ); 
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
                curl_setopt($curl, CURLOPT_FAILONERROR, false);  
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);    
                curl_setopt($curl, CURLOPT_POST, 1);                                         
                curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields); 
                header('Content-type: multipart/form-data'); 
                $response = curl_exec($curl); 
                if (!$response) {  
                    $response = curl_error($curl);  
                } else{
                    file_put_contents( '../upload/meta_requestor/'.$file_name, $response);
                    $request["filepath_requestor_meta"] = $file_name;
                } 
                curl_close($curl);
            }
            else{
                echo $this->upload->display_errors();
            }
        } else{
            $path_forward ="";
        }

        if ($_FILES['filepath_bl']['name']!="") {
            $folder_path = "bl";
            $folderName = "../upload/" . $folder_path;
            $config2['upload_path']          = $folderName;
            $config2['allowed_types']        = 'pdf';
            $config2['max_size']             = 2048000;
            $new_name = time().$_FILES['filepath_bl']['name'];
            $config2['file_name'] = $new_name;
            if (!is_dir($folderName)) {
                mkdir($folderName, 0777, true);
                chmod($folderName, 0777);
            }

            $this->load->library('upload');
            $this->upload->initialize($config2);
            if ($this->upload->do_upload('filepath_bl')){
                $data = $this->upload->data();
                $file_name = $data['file_name'];
                $request["filepath_bl"] = $file_name;
                $full_path = $data['full_path'];
                $headers = array("Content-Type:multipart/form-data"); 
                $filenya = 'https://apps1.insw.go.id/upload/meta/'.$file_name;
                $postFields = array();
                $postFields['file'] = '@' . realpath($full_path);
                $curl = curl_init("10.1.6.153/engMetadata/engine/file/updatemetadata");
                // $curl = curl_init("10.1.6.153/engMetadata/uploadFile"); 
                // curl_setopt($curl, curl_, value)
                curl_setopt($curl, CURLOPT_HTTPHEADER, array( //custom header for my api validation you can get it from $_SERVER["HTTP_X_PARAM_TOKEN"] variable
                         "Content-Type: multipart/form-data;") //setting our mime type for make it work on $_FILE variable
                    ); 
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
                curl_setopt($curl, CURLOPT_FAILONERROR, false);  
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);    
                curl_setopt($curl, CURLOPT_POST, 1);                                         
                curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields); 
                header('Content-type: multipart/form-data'); 
                $response = curl_exec($curl); 
                if (!$response) {  
                    $response = curl_error($curl);  
                } else{
                    file_put_contents( '../upload/meta_bl/'.$file_name, $response);
                    $request["filepath_bl_meta"] = $file_name;
                } 
                curl_close($curl);
            }
            else{

                echo $this->upload->display_errors();;
            }
        } else{
             $path_bl = "";
        }

        
        //for container detail
        $no_container   = $this->input->post('no_container');
        $no_seal        = $this->input->post('seal_no');
        $gross_weight   = $this->input->post('gross_weight');
        $gross_weight_satuan = $this->input->post('gross_weight_satuan');
        $ownership      = $this->input->post('ownership');
        $size_type      = $this->input->post('size_type');
        $no_col         = $this->input->post('numCont');


        $invoice_no     = $this->input->post('invoice_no');
        $invoice_date   = $this->input->post('invoice_date');
        $kd_val         = $this->input->post('kd_val');
        $nilai          = $this->input->post('nilai');
        $kd_bank        = $this->input->post('kd_bank');
        $no_rekening    = $this->input->post('no_rekening');

        $jenis_dok      = $this->input->post('jenis_dok');
        $no_dok         = $this->input->post('no_dok');
        $tgl_dok        = $this->input->post('tgl_dok');

        
        if (is_array($request)) { 
            // $bykData    = $this->db->get_where('tblreqdo_header',array('nobl' =>$request['nobl']),'nodo IS NOT NULL')->num_rows();
            $sqlBykData = "SELECT nobl, nodo from tblreqdo_header where nobl='$no_bl' and nodo is not null";
            $queryBykData= $this->db->query($sqlBykData)->result_array();
            $bykData = count($queryBykData);
            
            if ($bykData > 0) {
                $return = "msg#warning#DO have been released, Please contact respective Shipping Line for further information#";
            } else { //close DO is not null/null
                $checkRequest    = $this->db->get_where('tblreqdo_header',array('nobl' =>$request['nobl'],'kd_shippingline'=>$request['kd_shippingline']))->num_rows();
                if ($checkRequest > 0) {
                    $return = "msg#warning#BL Number have requested, Please Check in Request Table #";
                } else {
                    if ($action== 'save') {
                        $request['statusreqdo'] = '100';
                    } elseif ($action=='send') {
                        $request['statusreqdo'] = '101';
                        $request['noreqdo'] = $req_no;
                    }

                    $exec   = $this->db->insert('tblreqdo_header', $request);
                    if ($exec) {
                        $LastId = $this->db->insert_id();
    
                        for ($i=0; $i <sizeof($no_container) ; $i++) {
                            if ($no_container[$i]!="") {
                                if ($size_type[$i]!="") {
                                    $arrSizeType = explode("-", $size_type[$i]);
                                    $arrSize = $arrSizeType[0];
                                    $arrType = $arrSizeType[1];     
                                } else{
                                    $arrSize = "";
                                    $arrType = "";
                                }
                                $gross = str_replace(",","",$gross_weight[$i]);
                                $seri = $i+1; 
                                $container_detail = array(
                                    'id_reqdo_header' => $LastId,
                                    'no_container' => $no_container[$i],
                                    'no_seal'   => $no_seal[$i],
                                    'gross_weight' => $gross,
                                    'gross_weight_satuan' => $gross_weight_satuan[$i],
                                    'ownership' => $ownership[$i],
                                    'uk_container' => $arrSize,
                                    'tipe_container' => $arrType,
                                    'seri_container' => $seri
                                );
                                $execDetailCon = $this->db->insert('tblreqdo_container',$container_detail);
                                $LastIdCon  = $this->db->insert_id();
                                $nocol = $no_col[$i];
                                $no_row = $this->input->post('seal_no_'.$nocol);
                                foreach ($no_row as $norow ) {
                                    $container_seal = array(
                                        'id_reqdo_container' => $LastIdCon,
                                        'no_seal' => $norow
                                    );
                                    $execSealCon = $this->db->insert('tblreqdo_container_seal',$container_seal);
                                }
                                
                            }
                                 
                        }

                        for ($i=0; $i < sizeof($invoice_no) ; $i++) {
                            if ($invoice_no[$i] !="") {
                                $date_invoice = date('Y-m-d',strtotime($invoice_date[$i]));
                                $sql = "INSERT INTO tblreqdo_dok (id_reqdo_header,jenis_dok,no_dok,tgl_dok) values ('".$LastId."','2','".$invoice_no[$i]."','".$date_invoice."')";
                                $execInvoice = $this->db->query($sql);
                           
                                if ($execInvoice) {
                                    $path_buktibayar = "";
                                    if ($_FILES['filepath_buktibayar']['name'][$i]!="") {
                                        $_FILES['filepath_buktibayar[]']['name'] = $_FILES['filepath_buktibayar']['name'][$i];
                                        $_FILES['filepath_buktibayar[]']['type'] = $_FILES['filepath_buktibayar']['type'][$i];
                                        $_FILES['filepath_buktibayar[]']['tmp_name'] = $_FILES['filepath_buktibayar']['tmp_name'][$i];
                                        $_FILES['filepath_buktibayar[]']['error'] = $_FILES['filepath_buktibayar']['error'][$i];
                                        $_FILES['filepath_buktibayar[]']['size'] = $_FILES['filepath_buktibayar']['size'][$i];

                                        $folder_path = "payment";
                                        $folderName = "../upload/" . $folder_path;
                                        $config3['upload_path']          = $folderName;
                                        $config3['allowed_types']        = 'pdf';
                                        $config3['max_size']             = 2048000;
                                        $new_name = time().$_FILES['filepath_buktibayar']['name'][$i];
                                        $config3['file_name'] = $new_name;
                                        if (!is_dir($folderName)) {
                                            mkdir($folderName, 0777, true);
                                            chmod($folderName, 0777);
                                        }

                                        $this->load->library('upload',$config3);
                                        $this->upload->initialize($config3);
                                        if ($this->upload->do_upload('filepath_buktibayar[]')){
                                            $data = $this->upload->data();
                                            $file_name = $data["file_name"];
                                            $path_buktibayar = $file_name;
                                            $full_path = $data['full_path'];
                                            $headers = array("Content-Type:multipart/form-data"); 
                                            $filenya = 'https://apps1.insw.go.id/upload/meta_bl/'.$file_name;
                                            $postFields = array();
                                            $postFields['file'] = '@' . realpath($full_path);
                                            $curl = curl_init("10.1.6.153/engMetadata/engine/file/updatemetadata");
                                            // $curl = curl_init("10.1.6.153/engMetadata/uploadFile"); 
                                            // curl_setopt($curl, curl_, value)
                                            curl_setopt($curl, CURLOPT_HTTPHEADER, array( //custom header for my api validation you can get it from $_SERVER["HTTP_X_PARAM_TOKEN"] variable
                                                "Content-Type: multipart/form-data;") //setting our mime type for make it work on $_FILE variable
                                            ); 
                                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
                                            curl_setopt($curl, CURLOPT_FAILONERROR, false);  
                                            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);    
                                            curl_setopt($curl, CURLOPT_POST, 1);                                         
                                            curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields); 
                                            header('Content-type: multipart/form-data'); 
                                            $response = curl_exec($curl); 
                                            if (!$response) {  
                                                $response = curl_error($curl);  
                                            } else{
                                                file_put_contents( '../upload/meta_buktibayar/'.$file_name, $response);
                                                $meta_buktibayar = $file_name;
                                            } 
                                            curl_close($curl);
                                        } else {
                                            $path_buktibayar = "";
                                            $meta_buktibayar = "";
                                        }
                                    } else{
                                        $path_buktibayar = "";
                                        $meta_buktibayar = "";
                                    }
                                
                                    $id_dok = $this->db->insert_id();
                                    $money = $nilai[$i];
                                    $moneyComma = str_replace(",",'', $money);
                                    $moneyZero = str_replace(".00",'', $moneyComma);
                                    $nilaiUang = $moneyZero;


                                    $id_dok = $this->db->insert_id();
                                    $sqlbayar = "INSERT INTO tblreqdo_buktibayar (id_reqdo_dok,kd_val,nilai,kd_bank,no_rekening,filepath_buktibayar,filepath_buktibayar_meta) values ('".$id_dok."','".$kd_val[$i]."','".$nilaiUang."','".$kd_bank[$i]."','".$no_rekening[$i]."','".$path_buktibayar."','".$meta_buktibayar."')";
                                    $execbayar = $this->db->query($sqlbayar);
                                }
                            }
                        }

                        for ($i=0; $i < sizeof($jenis_dok); $i++) {
                            if ($jenis_dok[$i]!="") {
                                $path_dok = "";
                                if ($_FILES['filepath_dok']['name'][$i]!="") {
                                    $_FILES['filepath_dok[]']['name'] = $_FILES['filepath_dok']['name'][$i];
                                    $_FILES['filepath_dok[]']['type'] = $_FILES['filepath_dok']['type'][$i];
                                    $_FILES['filepath_dok[]']['tmp_name'] = $_FILES['filepath_dok']['tmp_name'][$i];
                                    $_FILES['filepath_dok[]']['error'] = $_FILES['filepath_dok']['error'][$i];
                                    $_FILES['filepath_dok[]']['size'] = $_FILES['filepath_dok']['size'][$i];

                                    $folder_path = "dokumen";
                                    $folderName = "../upload/" . $folder_path;
                                    $config4['upload_path']          = $folderName;
                                    $config4['allowed_types']        = 'pdf';
                                    $config4['max_size']             = 2048000;
                                    $new_name = time().$_FILES['filepath_dok']['name'][$i];
                                    $config4['file_name'] = $new_name;
                                    if (!is_dir($folderName)) {
                                            mkdir($folderName, 0777, true);
                                            chmod($folderName, 0777);
                                    }

                                    $this->load->library('upload',$config4);
                                    $this->upload->initialize($config4);
                                    if ($this->upload->do_upload('filepath_dok[]')){
                                        $data = $this->upload->data();
                                        $file_name = $data["file_name"];
                                        $path_dok = $file_name;
                                        $full_path = $data['full_path'];
                                        $headers = array("Content-Type:multipart/form-data"); 
                                        $filenya = 'https://apps1.insw.go.id/upload/meta_bl/'.$file_name;
                                        $postFields = array();
                                        $postFields['file'] = '@' . realpath($full_path);
                                        $curl = curl_init("10.1.6.153/engMetadata/engine/file/updatemetadata");
                                        // $curl = curl_init("10.1.6.153/engMetadata/uploadFile"); 
                                        // curl_setopt($curl, curl_, value)
                                        curl_setopt($curl, CURLOPT_HTTPHEADER, array( //custom header for my api validation you can get it from $_SERVER["HTTP_X_PARAM_TOKEN"] variable
                                        "Content-Type: multipart/form-data;") //setting our mime type for make it work on $_FILE variable
                                        ); 
                                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
                                        curl_setopt($curl, CURLOPT_FAILONERROR, false);  
                                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);    
                                        curl_setopt($curl, CURLOPT_POST, 1);                                         
                                        curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields); 
                                        header('Content-type: multipart/form-data'); 
                                        $response = curl_exec($curl); 
                                        if (!$response) {  
                                            $response = curl_error($curl);  
                                        } else{
                                            file_put_contents( '../upload/meta_dok/'.$file_name, $response);
                                            $meta_dok = $file_name;
                                        } 
                                        curl_close($curl);
                                    } else {
                                        $path_dok = "";
                                        $meta_dok = "";
                                    }
                                } else{
                                    $path_dok = "";
                                    $meta_dok = "";
                                }


                                $date_dok = date('Y-m-d',strtotime($tgl_dok[$i]));
                                $sqldok = "INSERT INTO tblreqdo_dok (id_reqdo_header,jenis_dok,no_dok,tgl_dok,filepath_dok,filepath_dok_meta) values ('".$LastId."','".$jenis_dok[$i]."','".$no_dok[$i]."','".$date_dok."','".$path_dok."','".$meta_dok."')";
                                $execDok = $this->db->query($sqldok);
                             } 
                            
                        }     


                        if ($action== 'save') {
                            $sql1 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$LastId."','100','".$this->session->userdata('username')."',now())";
                            $exec1 = $this->db->query($sql1);
                            $return = "msg#success#Request Successfully Save#" . site_url() . '/C_auth';
                        } elseif ($action=='send') {
                            $sql1 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$LastId."','101','".$this->session->userdata('username')."',now())";
                            $exec1 = $this->db->query($sql1);


                            $return = "msg#success#Request Successfully Send#" . site_url() . '/C_auth';
                        }
                    // $return = "msg#success#Request Successfully send#" . site_url() . '/C_auth';
                } else{ //close if exec
                    $return = "msg#error#Request UnSuccessfully send#" . site_url() . '/C_auth';
                }
            }//close else bl number is requested
                
            }    
        } else { //close if request exist
            $return = "msg#error#Process Request UnSuccessfully, Your Parsing Data Not Valid";
        }

        return $return;
    }



    public function EditRequest(){

        $id_reqdo_header = $this->input->post('id_header');
        $request = $this->input->post('input');
        $shipping_line = $this->input->post('shipping_line');
        $request['kd_shippingline'] = $shipping_line;
        $request['tglreqdo'] = date('Y-m-d H:i:s');
        $action = $this->input->post('action');
       
         
        if ($_FILES['filepath_requestor']['name']!="") {
            $folder_path = "requestor";
            $folderName = "../upload/" . $folder_path;
            $config['upload_path']          = $folderName;
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 2048000;
            $new_name = time().$_FILES['filepath_requestor']['name'];
            $config['file_name'] = $new_name;
            if (!is_dir($folderName)) {
                mkdir($folderName, 0777, true);
                chmod($folderName, 0777);
            }

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('filepath_requestor')){
                $data = $this->upload->data();
                $file_name = $data['file_name'];
                $full_path = $data['full_path'];
                $headers = array("Content-Type:multipart/form-data"); 
                $filenya = 'https://apps1.insw.go.id/upload/meta/'.$file_name;
                $postFields = array();
                $postFields['file'] = '@' . realpath($full_path);
                $curl = curl_init("10.1.6.153/engMetadata/engine/file/updatemetadata");
                // $curl = curl_init("10.1.6.153/engMetadata/uploadFile"); 
                // curl_setopt($curl, curl_, value)
                curl_setopt($curl, CURLOPT_HTTPHEADER, array( //custom header for my api validation you can get it from $_SERVER["HTTP_X_PARAM_TOKEN"] variable
                         "Content-Type: multipart/form-data;") //setting our mime type for make it work on $_FILE variable
                    ); 
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
                curl_setopt($curl, CURLOPT_FAILONERROR, false);  
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);    
                curl_setopt($curl, CURLOPT_POST, 1);                                         
                curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields); 
                header('Content-type: multipart/form-data'); 
                $response = curl_exec($curl); 
                if (!$response) {  
                    $response = curl_error($curl);  
                } else{
                    file_put_contents( '../upload/meta_requestor/'.$file_name, $response);
                    $request["filepath_requestor_meta"] = $file_name;
                } 
                curl_close($curl);
                $request["filepath_requestor"] = $file_name;
            }
            else{
                $path_forward ="";
            }
        } else{
            $this->db->select('A.filepath_requestor');
            $this->db->from('tblreqdo_header A');
            $this->db->where('id_reqdo_header', $id_reqdo_header);
            $row = $this->db->get()->row_array();
            if ($row["filepath_requestor"]!="") {
                $path_forward = $row;
            } else {
             $path_forward = "";
            }
            
        }

        if ($_FILES['filepath_bl']['name']!="") {
            $folder_path = "bl";
            $folderName = "../upload/" . $folder_path;
            $config2['upload_path']          = $folderName;
            $config2['allowed_types']        = 'pdf';
            $config2['max_size']             = 10000000;
            $new_name = time().$_FILES['filepath_bl']['name'];
            $config2['file_name'] = $new_name;
            if (!is_dir($folderName)) {
                mkdir($folderName, 0777, true);
                chmod($folderName, 0777);
            }
            
            $this->load->library('upload', $config2);
            $this->upload->initialize($config2);
            if ($this->upload->do_upload('filepath_bl')){
                $data = $this->upload->data();
                $file_name = $data['file_name'];
                $full_path = $data['full_path'];
                $headers = array("Content-Type:multipart/form-data"); 
                $filenya = 'https://apps1.insw.go.id/upload/meta/'.$file_name;
                $postFields = array();
                $postFields['file'] = '@' . realpath($full_path);
                $curl = curl_init("10.1.6.153/engMetadata/engine/file/updatemetadata");
                // $curl = curl_init("10.1.6.153/engMetadata/uploadFile"); 
                // curl_setopt($curl, curl_, value)
                curl_setopt($curl, CURLOPT_HTTPHEADER, array( //custom header for my api validation you can get it from $_SERVER["HTTP_X_PARAM_TOKEN"] variable
                         "Content-Type: multipart/form-data;") //setting our mime type for make it work on $_FILE variable
                    ); 
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
                curl_setopt($curl, CURLOPT_FAILONERROR, false);  
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);    
                curl_setopt($curl, CURLOPT_POST, 1);                                         
                curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields); 
                header('Content-type: multipart/form-data'); 
                $response = curl_exec($curl); 
                if (!$response) {  
                    $response = curl_error($curl);  
                } else{
                    file_put_contents( '../upload/meta_bl/'.$file_name, $response);
                    $request["filepath_bl_meta"] = $file_name;
                } 
                curl_close($curl);
                $request["filepath_bl"] = $file_name;
            }
            else{
                $path_bl = "";
                echo $this->upload->display_errors();;
            }
        } else{
            $this->db->select('A.filepath_bl');
            $this->db->from('tblreqdo_header A');
            $this->db->where('id_reqdo_header', $id_reqdo_header);
            $row = $this->db->get()->row_array();
            if ($row!="") {
                $path_bl = $row['filepath_bl'];
            } else {
             $path_bl = "";
            }
        }
        
        //for container detail
        $no_container   = $this->input->post('no_container');
        $no_seal        = $this->input->post('seal_no');
        $gross_weight   = $this->input->post('gross_weight');
        $gross_weight_satuan = $this->input->post('gross_weight_satuan');
        $ownership      = $this->input->post('ownership');

        $invoice_no     = $this->input->post('invoice_no');
        $invoice_date   = $this->input->post('invoice_date');
        $kd_val         = $this->input->post('kd_val');
        $nilai          = $this->input->post('nilai');
        $kd_bank        = $this->input->post('kd_bank');
        $no_rekening    = $this->input->post('no_rekening');
        $size_type      = $this->input->post('size_type');
        $file_buktibayar= $this->input->post('file_buktibayar');
        $file_buktibayar_meta = $this->input->post('file_buktibayar_meta');
        $no_col = $this->input->post('numCont');

        $jenis_dok      = $this->input->post('jenis_dok');
        $no_dok         = $this->input->post('no_dok');
        $tgl_dok        = $this->input->post('tgl_dok');
        $file_dok       = $this->input->post('file_dok');
        $file_dok_meta  = $this->input->post('file_dok_meta');


        if (is_array($request)) {
            $bykData    = $this->db->get_where('tblreqdo_header',array('nobl' =>$request['nobl']),'nodo IS NOT NULL')->num_rows();
            if ($bykData > 0) {
                if ($action == 'edit') {
                    $return = "msg#warning#No Bill of Lading and DO number Already Exist, Please send Request#";
                } elseif ($action =='send' ) {
                    $data = array(
                        'noreqdo' => $req_no,
                        'statusreqdo' => $request['statusreqdo']
                    );
                    $where = array("nobl" => $request['nobl']);
                    $exec = $this->db->update('tblreqdo_header', $data, $where);
                    if ($exec) {
                        $return = "msg#success# Send Request Successfully#".site_url().'/C_auth';
                    } else {
                        $return = "msg#error# Can't Send Request, Please Contact Administrato#";
                    }
                }
                
            } else {
                $this->db->select('statusreqdo');
                $this->db->from('tblreqdo_header');
                $this->db->where('id_reqdo_header',$id_reqdo_header);
                $hasilStatus = $this->db->get()->row_array();

                if ($hasilStatus['statusreqdo']=="203") {
                    $sqlStatus = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$id_reqdo_header."','100','".$this->session->userdata('username')."',now())";
                    $execStatus = $this->db->query($sqlStatus);
                }
                
                $request["statusreqdo"] = "100";
                $where = array("id_reqdo_header" => $id_reqdo_header);
                $exec = $this->db->update('tblreqdo_header', $request, $where);

                $queryIdStatus = "SELECT id_reqdo_status from tblreqdo_status where id_reqdo_header='$id_reqdo_header' and kode_status='100' order by id_reqdo_status DESC";
                $execGetStatus = $this->db->query($queryIdStatus)->row_array();
                $id_status = $execGetStatus['id_reqdo_status'];
                $timeStatus = array('created_date'=>date('Y-m-d H:i:s'));
                $whereStatus = array("id_reqdo_status" => $id_status);
                $execStatus = $this->db->update('tblreqdo_status',$timeStatus,$whereStatus);
                if ($exec) {
                    $where = array("id_reqdo_header" => $id_reqdo_header);
                    $this->db->select('A.id_reqdo_container');
                    $this->db->from('tblreqdo_container A');
                    $this->db->where('id_reqdo_header', $id_reqdo_header);
                    $res = $this->db->get()->result_array();
                    foreach ($res as $rslt) {
                        $execDeleteSeal = $this->db->delete('tblreqdo_container_seal',$rslt);
                    }
                    $execDelete = $this->db->delete('tblreqdo_container', $where);
                    // $execDeleteSeal = $this->db->delete('tblreqdo_container_seal',$where);
                    if ($execDelete) {
                        for ($i=0; $i <count($no_container) ; $i++) {
                            if ($no_container!="") {
                                if ($size_type[$i]!="") {
                                    $arrSizeType = explode("-", $size_type[$i]);
                                    $arrSize = $arrSizeType[0];
                                    $arrType = $arrSizeType[1];     
                                } else{
                                    $arrSize = "";
                                    $arrType = "";
                                }

                            $gross = str_replace(",","",$gross_weight[$i]);
                            $seri = $i+1;    
                            $container_detail = array(
                                'id_reqdo_header' => $id_reqdo_header,
                                'no_container' => $no_container[$i],
                                'no_seal'   => $no_seal[$i],
                                'gross_weight' => $gross,
                                'gross_weight_satuan' => $gross_weight_satuan[$i],
                                'ownership' => $ownership[$i],
                                'uk_container' => $arrSize,
                                'tipe_container' => $arrType,
                                'seri_container' =>$seri
                            );
                                $execDetailCon = $this->db->insert('tblreqdo_container',$container_detail);
                                $LastIdCon  = $this->db->insert_id();
                                $nocol = $no_col[$i];
                                $no_row = $this->input->post('seal_no_'.$nocol);
                                foreach ($no_row as $norow ) {
                                    if ($norow!="") {
                                       $container_seal = array(
                                        'id_reqdo_container' => $LastIdCon,
                                        'no_seal' => $norow
                                        );
                                        $execSealCon = $this->db->insert('tblreqdo_container_seal',$container_seal);
                                    } 
                                   
                                }
                            }
                                  
                        }

                        $this->db->select('id_reqdo_dok');
                        $this->db->from('tblreqdo_dok');
                        $this->db->where('id_reqdo_header',$id_reqdo_header);
                        $id_reqdo_dok = $this->db->get()->row_array();
                        
                        $whereBayar = array("id_reqdo_dok" => $id_reqdo_dok["id_reqdo_dok"]);
                        $execDeleteBayar = $this->db->delete('tblreqdo_buktibayar', $whereBayar);

                        $whereDok = array("id_reqdo_header" => $id_reqdo_header);
                        $execDeleteDok = $this->db->delete('tblreqdo_dok', $whereDok);

                        for ($i=0; $i < sizeof($invoice_no) ; $i++) {
                            if ($invoice_no[$i]!="") {
                                $date = date('Y-m-d',strtotime($invoice_date[$i]));
                                $sql = "INSERT INTO tblreqdo_dok (id_reqdo_header,jenis_dok,no_dok,tgl_dok) values ('".$id_reqdo_header."','2','".$invoice_no[$i]."','".$date."')";
                                $execInvoice = $this->db->query($sql);
                                if ($execInvoice) {
                                    $path_buktibayar = "";
                                    if ($_FILES['filepath_buktibayar']['name'][$i]!="") {
                                        $_FILES['filepath_buktibayar[]']['name'] = $_FILES['filepath_buktibayar']['name'][$i];
                                        $_FILES['filepath_buktibayar[]']['type'] = $_FILES['filepath_buktibayar']['type'][$i];
                                        $_FILES['filepath_buktibayar[]']['tmp_name'] = $_FILES['filepath_buktibayar']['tmp_name'][$i];
                                        $_FILES['filepath_buktibayar[]']['error'] = $_FILES['filepath_buktibayar']['error'][$i];
                                        $_FILES['filepath_buktibayar[]']['size'] = $_FILES['filepath_buktibayar']['size'][$i];

                                        $config3['upload_path']          = 'assets/upload/payment/';
                                        $config3['allowed_types']        = 'pdf';
                                        $config3['max_size']             = 2048000;
                                        $new_name = time().$_FILES['filepath_buktibayar']['name'][$i];
                                        $config3['file_name'] = $new_name;

                                        $this->load->library('upload',$config3);
                                        $this->upload->initialize($config3);
                                        if ($this->upload->do_upload('filepath_buktibayar[]')){
                                            $data = $this->upload->data();
                                            $file_name = $data['file_name'];
                                            $full_path = $data['full_path'];
                                            $headers = array("Content-Type:multipart/form-data"); 
                                            $filenya = 'https://apps1.insw.go.id/upload/meta_bl/'.$file_name;
                                            $postFields = array();
                                            $postFields['file'] = '@' . realpath($full_path);
                                            $curl = curl_init("10.1.6.153/engMetadata/engine/file/updatemetadata");
                                            // $curl = curl_init("10.1.6.153/engMetadata/uploadFile"); 
                                            // curl_setopt($curl, curl_, value)
                                            curl_setopt($curl, CURLOPT_HTTPHEADER, array( //custom header for my api validation you can get it from $_SERVER["HTTP_X_PARAM_TOKEN"] variable
                                                "Content-Type: multipart/form-data;") //setting our mime type for make it work on $_FILE variable
                                            ); 
                                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
                                            curl_setopt($curl, CURLOPT_FAILONERROR, false);  
                                            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);    
                                            curl_setopt($curl, CURLOPT_POST, 1);                                         
                                            curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields); 
                                            header('Content-type: multipart/form-data'); 
                                            $response = curl_exec($curl); 
                                            if (!$response) {  
                                                $response = curl_error($curl);  
                                            } else{
                                                file_put_contents( '../upload/meta_buktibayar/'.$file_name, $response);
                                                $meta_buktibayar = $file_name;
                                            } 
                                            curl_close($curl);
                                            $path_buktibayar = $file_name;
                                        } else {
                                            $path_buktibayar = $file_buktibayar[$i];
                                            $meta_buktibayar = $file_buktibayar_meta[$i];
                                        }
                                    } else{
                                        $path_buktibayar = $file_buktibayar[$i];
                                        $meta_buktibayar = $file_buktibayar_meta[$i];
                                    }

                                    $id_dok = $this->db->insert_id();
                                    $money = $nilai[$i];
                                    $moneyComma = str_replace(",",'', $money);
                                    $moneyZero = str_replace(".00",'', $moneyComma);
                                    $nilaiUang = $moneyZero;

                                    $sql = "INSERT INTO tblreqdo_buktibayar (id_reqdo_dok,kd_val,nilai,kd_bank,no_rekening,filepath_buktibayar,filepath_buktibayar_meta) values ('".$id_dok."','".$kd_val[$i]."','".$nilaiUang."','".$kd_bank[$i]."','".$no_rekening[$i]."','".$path_buktibayar."','".$meta_buktibayar."')";
                                    $execbayar = $this->db->query($sql);
                                }
                            } 
                            
                        }


                        for ($i=0; $i < sizeof($jenis_dok); $i++) { 
                            if ($jenis_dok[$i]!="-") {
                                $path_dok = "";
                                if ($_FILES['filepath_dok']['name'][$i]!="") {
                                    $_FILES['filepath_dok[]']['name'] = $_FILES['filepath_dok']['name'][$i];
                                    $_FILES['filepath_dok[]']['type'] = $_FILES['filepath_dok']['type'][$i];
                                    $_FILES['filepath_dok[]']['tmp_name'] = $_FILES['filepath_dok']['tmp_name'][$i];
                                    $_FILES['filepath_dok[]']['error'] = $_FILES['filepath_dok']['error'][$i];
                                    $_FILES['filepath_dok[]']['size'] = $_FILES['filepath_dok']['size'][$i];

                                    $folder_path = "dokumen";
                                    $folderName = "../upload/" . $folder_path;
                                    $config4['upload_path']          = $folderName;
                                    $config4['allowed_types']        = 'pdf';
                                    $config4['max_size']             = 2048000;
                                    $new_name = time().$_FILES['filepath_dok']['name'][$i];
                                    $config4['file_name'] = $new_name;
                                    if (!is_dir($folderName)) {
                                        mkdir($folderName, 0777, true);
                                        chmod($folderName, 0777);
                                    }

                                    $this->load->library('upload',$config4);
                                    $this->upload->initialize($config4);
                                    if ($this->upload->do_upload('filepath_dok[]')){
                                        $data = $this->upload->data();
                                        $file_name = $data['file_name'];
                                        $full_path = $data['full_path'];
                                        $headers = array("Content-Type:multipart/form-data"); 
                                        $filenya = 'https://apps1.insw.go.id/upload/meta_bl/'.$file_name;
                                        $postFields = array();
                                        $postFields['file'] = '@' . realpath($full_path);
                                        $curl = curl_init("10.1.6.153/engMetadata/engine/file/updatemetadata");
                                        // $curl = curl_init("10.1.6.153/engMetadata/uploadFile"); 
                                        // curl_setopt($curl, curl_, value)
                                        curl_setopt($curl, CURLOPT_HTTPHEADER, array( //custom header for my api validation you can get it from $_SERVER["HTTP_X_PARAM_TOKEN"] variable
                                        "Content-Type: multipart/form-data;") //setting our mime type for make it work on $_FILE variable
                                        ); 
                                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
                                        curl_setopt($curl, CURLOPT_FAILONERROR, false);  
                                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);    
                                        curl_setopt($curl, CURLOPT_POST, 1);                                         
                                        curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields); 
                                        header('Content-type: multipart/form-data'); 
                                        $response = curl_exec($curl); 
                                        if (!$response) {  
                                            $response = curl_error($curl);  
                                        } else{
                                            file_put_contents( '../upload/meta_dok/'.$file_name, $response);
                                            $meta_dok = $file_name;
                                        } 
                                        curl_close($curl);
                                        $path_dok = $file_name;

                                    } else {
                                        $path_dok = $file_dok[$i];
                                        $meta_dok = $file_dok_meta[$i];
                                    }
                                } else{
                                    $path_dok = $file_dok[$i];
                                    $meta_dok = $file_dok_meta[$i];
                                }

                            $date_dok = date('Y-m-d',strtotime($tgl_dok[$i]));
                            $sqldok = "INSERT INTO tblreqdo_dok (id_reqdo_header,jenis_dok,no_dok,tgl_dok,filepath_dok,filepath_dok_meta) values ('".$id_reqdo_header."','".$jenis_dok[$i]."','".$no_dok[$i]."','".$date_dok."','".$path_dok."','".$meta_dok."')";
                            $execDok = $this->db->query($sqldok);
                            }
                            
                        }

                    }    
                    $return = "msg#success#Request Draft Updated#" . site_url() . '/C_auth';
                } else {
                    $return = "msg#error#Request UnSuccessfully Update#" . site_url() . '/C_auth';
                }
            }    
        } else{
            $return = "msg#error#Process Request UnSuccessfully, Your Parsing Data Not Valid";
        }

        return $return;
    }

    public function ExecRequestByTable(){
        $id_reqdo_header = $this->input->post('id');
        $this->db->select('noreqdo,kd_shippingline');
        $this->db->from('tblreqdo_header');
        $this->db->where('id_reqdo_header',$id_reqdo_header);
        $hasil = $this->db->get()->row_array();
        $noreqdo = $hasil['noreqdo'];
        // $req_no = $this->generate_request_no($hasil['kd_shippingline']);
        $sql_func = "SELECT fgetnoreqdo('".$hasil['kd_shippingline']."') as nomor";   
        $query_func = $this->db->query($sql_func);
        $array_func = $query_func->row_array();
        $req_no = $array_func['nomor'];
        
        if ($noreqdo!="") {
            $data = array(
                'statusreqdo' => '101'
            );
        } else{
            $data = array(
                'noreqdo' => $req_no,
                'statusreqdo' => '101'
            );
        }
        

        $where = array("id_reqdo_header" => $id_reqdo_header);
        $exec = $this->db->update('tblreqdo_header', $data, $where);
        if ($exec) {
                        $sql1 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$id_reqdo_header."','101','".$this->session->userdata('username')."',now())";
                        $exec1 = $this->db->query($sql1);
            $return = "msg#success#Request Successfully send#" . site_url() . '/C_auth';
        } else {
            $return = "msg#error#Request UnSuccessfully send#" . site_url() . '/C_auth';
        }

        return $return;
    }


    public function ExecExtend(){
        $action = $this->input->post('action');
        $id_reqdo_header           = $this->input->post('id_reqdo_header');
        $request                   = $this->input->post('input');
        $shipping_line             = $this->input->post('input[kd_shippingline]');
        // $req_no                    = $this->generate_request_no($shipping_line);
        $sql_func = "SELECT fgetnoreqdo('".$shipping_line."') as nomor";   
        $query_func = $this->db->query($sql_func);
        $array_func = $query_func->row_array();
        $req_no = $array_func['nomor'];
        $request['tglreqdo']       = date('Y-m-d H:i:s');
        $request['created_date']   = date('Y-m-d H:i:s');
        $request['created_by']     = $this->session->userdata('username');
        $request['noreqdo']        = $req_no;
        $tglexpreqdo               = $this->input->post('tglexpreqdo');
        $request['tglexpreqdo']    = date('Y-m-d',strtotime($tglexpreqdo));
        $tglbl               = $this->input->post('tglbl');
        $request['tglbl']    = date('Y-m-d',strtotime($tglbl));
        //for container detail
        $no_container   = $this->input->post('no_container');
        $no_seal        = $this->input->post('no_seal');
        $gross_weight   = $this->input->post('gross_weight');
        $gross_weight_satuan = $this->input->post('gross_weight_satuan');
        $ownership      = $this->input->post('ownership');
        $npwp_depo      = $this->input->post('npwp_depo');
        $nama_depo      = $this->input->post('nama_depo');
        $telp_depo      = $this->input->post('telp_depo');
        $alamat_depo    = $this->input->post('alamat_depo');
        $kota_depo      = $this->input->post('kota_depo');
        $kdpos_depo     = $this->input->post('kdpos_depo');
        $no_col = $this->input->post('numCont');
        //for payment detail
        $invoice_no     = $this->input->post('invoice_no');
        $invoice_date   = $this->input->post('invoice_date');
        $kd_val         = $this->input->post('kd_val');
        $nilai          = $this->input->post('nilai');
        $kd_bank        = $this->input->post('kd_bank');
        $no_rekening    = $this->input->post('no_rekening');
        $uk_container   = $this->input->post('uk_container');
        $tipe_container = $this->input->post('tipe_container');
        $file_buktibayar= $this->input->post('file_buktibayar');
        $filepath_buktibayar= $this->input->post('filepath_buktibayar');
        $file_buktibayar_meta = $this->input->post('filepath_buktibayar_meta');
        //for supporting dokumen detail
        $jenis_dok      = $this->input->post('jenis_dok');
        $no_dok         = $this->input->post('no_dok');
        $tgl_dok        = $this->input->post('tgl_dok');
        $file_dok       = $this->input->post('filepath_dok');
        $file_dok_meta  = $this->input->post('filepath_dok_meta');


        if (is_array($request)) {
            $execHeader = $this->db->insert('tblreqdo_header',$request);
            if ($execHeader) {
                $LastId = $this->db->insert_id();
                for ($i=0; $i <sizeof($no_container) ; $i++) {
                    if ($no_container[$i]!="") {
                       
                        $gross = str_replace(",","",$gross_weight[$i]);
                        $seri = $i+1; 
                        $container_detail = array(
                            'id_reqdo_header' => $LastId,
                            'no_container' => $no_container[$i],
                            'no_seal'   => $no_seal[$i],
                            'gross_weight' => $gross,
                            'gross_weight_satuan' => $gross_weight_satuan[$i],
                            'ownership' => $ownership[$i],
                            'uk_container' => $uk_container[$i],
                            'tipe_container' => $tipe_container[$i],
                            'npwp_depo' => $npwp_depo[$i],
                            'nama_depo' => $nama_depo[$i],
                            'telp_depo' => $telp_depo[$i],
                            'alamat_depo' => $alamat_depo[$i],
                            'kota_depo' => $kota_depo[$i],
                            'kdpos_depo' => $kdpos_depo[$i],
                            'seri_container' => $seri
                        );
                        $execDetailCon = $this->db->insert('tblreqdo_container',$container_detail);
                        $LastIdCon  = $this->db->insert_id();
                        $nocol = $no_col[$i];
                        $no_row = $this->input->post('seal_no_'.$nocol);
                        foreach ($no_row as $norow ) {
                            $container_seal = array(
                                'id_reqdo_container' => $LastIdCon,
                                'no_seal' => $norow
                            );
                            $execSealCon = $this->db->insert('tblreqdo_container_seal',$container_seal);
                        }
                    }             
                }

                for ($i=0; $i < sizeof($invoice_no) ; $i++) {
                    if ($invoice_no[$i] !="") {
                        $date_invoice = date('Y-m-d',strtotime($invoice_date[$i]));
                        $sql = "INSERT INTO tblreqdo_dok (id_reqdo_header,jenis_dok,no_dok,tgl_dok) values ('".$LastId."','2','".$invoice_no[$i]."','".$date_invoice."')";
                        $execInvoice = $this->db->query($sql);   
                        
                        // if ($execInvoice) {
                        //     $id_dok     = $this->db->insert_id();
                        //     $money      = $nilai[$i];
                        //     $moneyComma = str_replace(",",'', $money);
                        //     $moneyZero  = str_replace(".00",'', $moneyComma);
                        //     $nilaiUang  = $moneyZero;
                            
                        //     $id_dok     = $this->db->insert_id();
                        //     $sqlbayar   =  "INSERT INTO tblreqdo_buktibayar (id_reqdo_dok,kd_val,nilai,kd_bank,no_rekening,filepath_buktibayar) values ('".$id_dok."','".$kd_val[$i]."','".$nilaiUang."','".$kd_bank[$i]."','".$no_rekening[$i]."','".$file_buktibayar[$i]."')";
                            
                        //     $execbayar  = $this->db->query($sqlbayar);
                        // }
                        if ($execInvoice) {
                            $path_buktibayar = "";
                            if ($_FILES['filepath_buktibayar']['name'][$i]!="") {
                                $_FILES['filepath_buktibayar[]']['name'] = $_FILES['filepath_buktibayar']['name'][$i];
                                $_FILES['filepath_buktibayar[]']['type'] = $_FILES['filepath_buktibayar']['type'][$i];
                                $_FILES['filepath_buktibayar[]']['tmp_name'] = $_FILES['filepath_buktibayar']['tmp_name'][$i];
                                $_FILES['filepath_buktibayar[]']['error'] = $_FILES['filepath_buktibayar']['error'][$i];
                                $_FILES['filepath_buktibayar[]']['size'] = $_FILES['filepath_buktibayar']['size'][$i];

                                $folder_path = "payment";
                                $folderName = "../upload/" . $folder_path;
                                $config3['upload_path']          = $folderName;
                                $config3['allowed_types']        = 'pdf';
                                $config3['max_size']             = 2048000;
                                $new_name = time().$_FILES['filepath_buktibayar']['name'][$i];
                                $config3['file_name'] = $new_name;
                                if (!is_dir($folderName)) {
                                    mkdir($folderName, 0777, true);
                                    chmod($folderName, 0777);
                                }

                                $this->load->library('upload',$config3);
                                $this->upload->initialize($config3);
                                if ($this->upload->do_upload('filepath_buktibayar[]')){
                                    $data = $this->upload->data();
                                    $file_name = $data["file_name"];
                                    $path_buktibayar = $file_name;
                                    $full_path = $data['full_path'];
                                    $headers = array("Content-Type:multipart/form-data"); 
                                    $filenya = 'https://apps1.insw.go.id/upload/meta_bl/'.$file_name;
                                    $postFields = array();
                                    $postFields['file'] = '@' . realpath($full_path);
                                    $curl = curl_init("10.1.6.153/engMetadata/engine/file/updatemetadata");
                                            // $curl = curl_init("10.1.6.153/engMetadata/uploadFile"); 
                                            // curl_setopt($curl, curl_, value)
                                    curl_setopt($curl, CURLOPT_HTTPHEADER, array( //custom header for my api validation you can get it from $_SERVER["HTTP_X_PARAM_TOKEN"] variable
                                                "Content-Type: multipart/form-data;") //setting our mime type for make it work on $_FILE variable
                                    ); 
                                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
                                    curl_setopt($curl, CURLOPT_FAILONERROR, false);  
                                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);    
                                    curl_setopt($curl, CURLOPT_POST, 1);                                         
                                    curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields); 
                                    header('Content-type: multipart/form-data'); 
                                    $response = curl_exec($curl); 
                                    if (!$response) {  
                                        $response = curl_error($curl);  
                                    } else{
                                        file_put_contents( '../upload/meta_buktibayar/'.$file_name, $response);
                                        $meta_buktibayar = $file_name;
                                    } 
                                    
                                    curl_close($curl);
                                } else {
                                    $path_buktibayar = "";
                                    $meta_buktibayar = "";
                                }
                            } else{
                                $path_buktibayar = $file_buktibayar[$i];
                                $meta_buktibayar = $file_buktibayar_meta[$i];
                            }

                            $id_dok = $this->db->insert_id();
                            $money = $nilai[$i];
                            $moneyComma = str_replace(",",'', $money);
                            $moneyZero = str_replace(".00",'', $moneyComma);
                            $nilaiUang = $moneyZero;


                            $id_dok = $this->db->insert_id();
                            $sqlbayar = "INSERT INTO tblreqdo_buktibayar (id_reqdo_dok,kd_val,nilai,kd_bank,no_rekening,filepath_buktibayar,filepath_buktibayar_meta) values ('".$id_dok."','".$kd_val[$i]."','".$nilaiUang."','".$kd_bank[$i]."','".$no_rekening[$i]."','".$path_buktibayar."','".$meta_buktibayar."')";
                                $execbayar = $this->db->query($sqlbayar);
                        }
                    }
                }

                for ($i=0; $i < sizeof($jenis_dok); $i++) {
                    if ($jenis_dok[$i]!="") {
                        $date_dok = date('Y-m-d',strtotime($tgl_dok[$i]));
                        $sqldok = "INSERT INTO tblreqdo_dok (id_reqdo_header,jenis_dok,no_dok,tgl_dok,filepath_dok) values ('".$LastId."','".$jenis_dok[$i]."','".$no_dok[$i]."','".$date_dok."','".$file_dok[$i]."')";
                        $execDok = $this->db->query($sqldok);
                    } 
                            
                }

                
                $data = array(
                    'statusreqdo' => '101'
                );
                
                $where = array("id_reqdo_header" => $LastId);
                $execStatus = $this->db->update('tblreqdo_header', $data, $where);
             
                $sqlStatus = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('".$LastId."','101','".$this->session->userdata('username')."',now())";
                $execstatus = $this->db->query($sqlStatus);
                $return = "msg#success#Send Request Successful#" . site_url() . '/C_auth';
                   
            }
        } else {
            $return = "msg#error#Process Request UnSuccessful, Your Parsing Data Not Valid";
        }


        return $return;
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

    public function getDataStatus($no_bl,$tglreq){
        $tglreqdo = str_replace('%20', " ", $tglreq);
        $sql = "select id_reqdo_header from tblreqdo_header where  nobl='$no_bl' and tglreqdo='$tglreqdo'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $id_reqdo_header = $row['id_reqdo_header'];

        // $sql2 = "select A.*, B.* from tblreqdo_status A join tbltab B on A.kode_status=B.kdnsw and B.kdtab='D4' where id_reqdo_header='$id_reqdo_header'";
        $sql2 = "select B.URAIAN, to_char(A.CREATED_DATE, 'YYYY-MM-DD HH24:MI:SS') AS CREATED_DATE, A.keterangan from tblreqdo_status A join tbltab B on A.kode_status=B.kdnsw and B.kdtab='D4' where id_reqdo_header='$id_reqdo_header' ORDER BY A.id_reqdo_status DESC";
        $query2 = $this->db->query($sql2);
        $hasil = $query2->result_array();
        return $hasil;
    }

    public function getDataStatusRelease($no_bl,$tgldoakhir,$tglreq){
        if ($tgldoakhir != "") {
            $tglakhir = str_replace('%20', " ", $tgldoakhir);
            $sql = "select id_reqdo_header from tblreqdo_header where  nobl ='$no_bl' and tgldoakhir='$tglakhir'";   
        } else {
            if ($tglreq != "") {
                $tglrequest = str_replace('%20', " ", $tglreq);
                $sql = "select id_reqdo_header from tblreqdo_header where  nobl='$no_bl' and tglreqdo='$tglrequest'";
            } else {
                $sql = "select id_reqdo_header from tblreqdo_header where  nobl='$no_bl'";
            }
        }
        $query = $this->db->query($sql);
        
        $row = $query->row_array();
        $id_reqdo_header = $row['id_reqdo_header'];

        // $sql2 = "select A.*, B.* from tblreqdo_status A join tbltab B on A.kode_status=B.kdnsw and B.kdtab='D4' where id_reqdo_header='$id_reqdo_header'";
        $sql2 = "select B.URAIAN, to_char(A.CREATED_DATE, 'YYYY-MM-DD HH24:MI:SS') AS CREATED_DATE, A.keterangan from tblreqdo_status A join tbltab B on A.kode_status=B.kdnsw and B.kdtab='D4' where id_reqdo_header='$id_reqdo_header' ORDER BY A.id_reqdo_status DESC";
        $query2 = $this->db->query($sql2);
        $hasil = $query2->result_array();
        return $hasil;
    }

    public function getDataStatusSP2($no_bl,$tglreq){
        $tglreqdo = str_replace('%20', " ", $tglreq);
        $sql = "select id_reqdo_header from tblreqdo_header where  nobl='$no_bl' and tglreqdo='$tglreqdo'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $id_reqdo_header = $row['id_reqdo_header'];

        // $sql2 = "select A.*, B.* from tblreqdo_status A join tbltab B on A.kode_status=B.kdnsw and B.kdtab='D4' where id_reqdo_header='$id_reqdo_header'";
        $sql2 = "select B.URAIAN, to_char(A.CREATED_DATE, 'YYYY-MM-DD HH24:MI:SS') AS CREATED_DATE, A.keterangan from tblreqdo_status A join tbltab B on A.kode_status=B.kdnsw and B.kdtab='D4' where id_reqdo_header='$id_reqdo_header' ORDER BY A.id_reqdo_status DESC";
        $query2 = $this->db->query($sql2);
        $hasil = $query2->result_array();
        return $hasil;
    }

    public function getDataStatusReleaseSP2($no_bl,$tglreq){
        $tglreqdo = str_replace('%20', " ", $tglreq);
        $sql = "select id_reqdo_header from tblreqdo_header where  nobl='$no_bl' and tglreqdo='$tglreqdo'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $id_reqdo_header = $row['id_reqdo_header'];

        // $sql2 = "select A.*, B.* from tblreqdo_status A join tbltab B on A.kode_status=B.kdnsw and B.kdtab='D4' where id_reqdo_header='$id_reqdo_header'";
        $sql2 = "select B.URAIAN, to_char(A.CREATED_DATE, 'YYYY-MM-DD HH24:MI:SS') AS CREATED_DATE, A.keterangan from tblreqdo_status A join tbltab B on A.kode_status=B.kdnsw and B.kdtab='D4' where id_reqdo_header='$id_reqdo_header' ORDER BY A.id_reqdo_status DESC";
        $query2 = $this->db->query($sql2);
        $hasil = $query2->result_array();
        return $hasil;
    }

    public function getDataPdf($id) {

        $sql = " SELECT A.*,B.uredi as loading,C.uredi as discharge,D.uredi as destination,E.uredi as negara_muat,F.uredi as negara_bongkar,G.uredi as negara_tujuan,H.uraian from tblreqdo_header A
                left join tblpelln B on B.kdedi=A.pel_muat
                left join tblpeldn C on C.kdedi=A.pel_tujuan
                left join tblpeldn D on D.kdedi=A.pel_bongkar
                left join tblnegara E on E.kdedi=substring(A.pel_muat,1,2)
                left join tblnegara F on F.kdedi=substring(A.pel_bongkar,1,2)
                left join tblnegara G on G.kdedi=substring(A.pel_tujuan,1,2)
                left join tblrefshippingline H on H.kode = A.kd_shippingline
                where id_reqdo_header='$id'";
        $query = $this->db->query($sql);
        $arrDataHDR = $query->row_array();

        $sqlCon = "SELECT * FROM tblreqdo_container where id_reqdo_header='$id'";
        $queryCon = $this->db->query($sqlCon);
        $arrDataCon = array();
        $arrCon = $queryCon->result_array(); 
        foreach ($arrCon as $conArr) {
            $id_con = $conArr["id_reqdo_container"];
            $data_seal = $this->getDataFormSeal($id_con);
            array_push($conArr, $data_seal);
            array_push($arrDataCon,$conArr);       
        }

        $returnArray = array('dataHDR' => $arrDataHDR,'dataCon'=> $arrDataCon);
        return $returnArray;
    }

    public function ExecCoba(){
         $file = $_FILES;
         if ($_FILES['test_file']['name']!="") {
            $folder_path = "meta_buktibayar";
            $folderName = "../upload/" . $folder_path;
            $config2['upload_path']          = $folderName;
            $config2['allowed_types']        = 'pdf';
            $config2['max_size']             = 2048000;
            $new_name = time().$_FILES['test_file']['name'];
            $config2['file_name'] = $new_name;
            if (!is_dir($folderName)) {
                mkdir($folderName, 0777, true);
                chmod($folderName, 0777);
            }

            $this->load->library('upload');
            $this->upload->initialize($config2);
            if ($this->upload->do_upload('test_file')){
                $data = $this->upload->data();
                $file_name = $data['file_name'];
                $url = "10.1.6.153/engMetadata/engine/file/updatemetadata";
                $postData = array(
                    'file' => 'https://apps1.insw.go.id/upload/meta/'.$file_name
                );
                $curl = curl_init($url);  
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
                curl_setopt($curl, CURLOPT_FAILONERROR, false);  
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
                curl_setopt($curl, CURLOPT_HEADER, true);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/pdf'));   
                curl_setopt($curl, CURLOPT_POST, 1);                                         
                curl_setopt($curl, CURLOPT_POSTFIELDS, file_get_contents($postData));  
                $response = curl_exec($curl);  
                if (!$response) {  
                    $response = curl_error($curl);  
                }  
                curl_close($curl);
                print_r($response);die('coba 5');  
            }
            else{
                echo $this->upload->display_errors();
            }
        } else{
             $path_bl = "";
        }
    }

    public function req_sp2($id){
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
            $this->db->from('v_bl_sppb');
            $this->db->where('nobl', $nobl);
            $jumlah = $this->db->get()->num_rows();

            if ($jumlah > 0) {
                $hasil = "success#".$tglakhir;
            } else {
                $hasil = "error#Silahkan cek tanggal berlaku DO dan pastikan DO sudah SPPB";
            }

        }
        return $hasil;
    }

    public function EncryptedNPWP($npwp){
        $curl = curl_init();
        $url = "http://10.1.19.17/nibService/encryption/encrypt/".$npwp;

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}

/* End of file M_cargo.php */
