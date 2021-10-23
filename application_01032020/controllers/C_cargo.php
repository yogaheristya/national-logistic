<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_cargo extends CI_Controller {

	public function __construct()
  {
        parent::__construct();
        $this->load->model('M_cargo','cargo');
        $this->load->library('pdf');
        $this->load->library('Pdf_do');
  }
    
    public function getForm($id=''){
		if ($this->session->userdata('logged_in')) {

			if ($id !="") {

				$id_negara  = $this->input->post('id_negara');
				$page_title = "Form Request DO";
				//get data header
            	$resData = $this->cargo->getDataFormDetail($id);
            	//get data container
            	$resData2 = $this->cargo->getDataFormContainer($id);
            	//get data buktibayar
            	$resData3 = $this->cargo->getDataFormPayment($id);
                //get data supporting Document
                $resData4 = $this->cargo->getDataFormDoc($id);
            	//get data shippingline
            	$shipping  = $this->cargo->getDataShipping();
                //get data Bank
                $bank = $this->cargo->getDataBank();
                //get Data Size Type Container
                $sizeType = $this->cargo->getDataSizeType();

            	//tanggal exp DO
            	$tglexpdate = $resData['tglexpreqdo'];
            	$expdate = date('m/d/Y',strtotime($tglexpdate));
            	$resData['tglexpdo'] = $expdate;
            	//tanggal BL
            	$tglexpdate = $resData['tglbl'];
            	$expdate = date('m/d/Y',strtotime($tglexpdate));
            	$resData['tglreqbl'] = $expdate;

            	$combo_pel['pelabuhan'] = $this->cargo->getDataPel();
            	$negara = $this->cargo->getDataNegara();
            	$data = array(
					'page_title' => $page_title,
                	'btn'       => 'Edit',
					'_content'  => 'cms/content/form/v_edit_request',
					'request'	=> $resData,
					'container' => $resData2,
					'payment'  => $resData3,
                    'document' => $resData4,
                	'pel_dn'	=> $combo_pel,
                	'negara'    => $negara,
                    'bank'      => $bank,
                	'shipping' => $shipping,
                    'sizeType' =>$sizeType

				); 
			} else{
				$id_negara  = $this->input->post('id_negara');
				$page_title = "Form Request DO";
				$request['date'] = date("m/d/Y");
				$request['name'] = $this->session->userdata('F_perusahaan');
				$request['npwp'] = $this->session->userdata('F_npwp');
				$request['alamat'] = $this->session->userdata('F_alamat');
                $request['nib']  = $this->session->userdata('nib');
				$combo_pel['pelabuhan'] = $this->cargo->getDataPel();
            	$negara = $this->cargo->getDataNegara();
            	//get data shippingline
            	$shipping = $this->cargo->getDataShipping();
                //get data Bank
                $bank = $this->cargo->getDataBank();
                //get Data Size Type Container
                $sizeType = $this->cargo->getDataSizeType();
			
				$data = array(
					'page_title' => $page_title,
                	'btn'       => 'Save',
					'_content'  => 'cms/content/form/v_request_do',
					'request'	=> $request,
                	'pel_dn'	=> $combo_pel,
                	'negara'    => $negara,
                	'shipping' => $shipping,
                    'bank'      => $bank,
                    'sizeType' =>$sizeType
				);
			}

            
			$this->load->view('cms/v_base',$data);
		} else{
			$this->load->view('login/v_login');
		}
    }

    public function getFormRelease($id_reqdo_header){

        $data_header        = $this->cargo->getDataFormDetail($id_reqdo_header);
        $data_container     = $this->cargo->getDataFormContainer($id_reqdo_header);
        $data_place["muat"]    = $this->cargo->getPelMuat($id_reqdo_header);
        $data_place["bongkar"] = $this->cargo->getPelBongkar($id_reqdo_header);
        $data_place["tujuan"]  = $this->cargo->getPelTujuan($id_reqdo_header);
        $data_payment       = $this->cargo->getDataFormPayment($id_reqdo_header);
        $data_doc = $this->cargo->getDataFormDoc($id_reqdo_header);
        // print_r($data_place);die('test');
        if ($this->session->userdata('logged_in')) {
            $id_negara  = $this->input->post('id');
            $page_title = "View DO Release";
            
            $data = array(
                'page_title' => $page_title,
                '_content' => 'cms/content/form/v_release_do',
                'data_header'    => $data_header,
                'data_container' => $data_container,
                'data_place' => $data_place,
                'data_payment'=>$data_payment,
                'data_doc' =>$data_doc
            );
            
            $this->load->view('cms/v_base',$data);
        } else{
            $this->load->view('login/v_login');
        }
    }


    public function getFormDetailRequest($id_reqdo_header){

        $data_header        = $this->cargo->getDataFormDetail($id_reqdo_header);
        $data_container     = $this->cargo->getDataFormContainer($id_reqdo_header);
        $data_place["muat"]    = $this->cargo->getPelMuat($id_reqdo_header);
        $data_place["bongkar"] = $this->cargo->getPelBongkar($id_reqdo_header);
        $data_place["tujuan"]  = $this->cargo->getPelTujuan($id_reqdo_header);
        $data_payment       = $this->cargo->getDataFormPayment($id_reqdo_header);
        $data_doc = $this->cargo->getDataFormDoc($id_reqdo_header);
        // print_r($data_place);die('test');
        if ($this->session->userdata('logged_in')) {
            $id_negara  = $this->input->post('id');
            $page_title = "View Request DO";
            
            $data = array(
                'page_title' => $page_title,
                '_content' => 'cms/content/form/v_detail_request',
                'data_header'    => $data_header,
                'data_container' => $data_container,
                'data_place' => $data_place,
                'data_payment'=> $data_payment,
                'data_doc' =>$data_doc
            );
            
            $this->load->view('cms/v_base',$data);
        } else{
            $this->load->view('login/v_login');
        }
    }

    public function getFormExtend($id_reqdo_header){

        $data_header        = $this->cargo->getDataFormDetail($id_reqdo_header);
        $data_container     = $this->cargo->getDataFormContainer($id_reqdo_header);
        $data_place["muat"]    = $this->cargo->getPelMuat($id_reqdo_header);
        $data_place["bongkar"] = $this->cargo->getPelBongkar($id_reqdo_header);
        $data_place["tujuan"]  = $this->cargo->getPelTujuan($id_reqdo_header);
        $data_payment       = $this->cargo->getDataFormPayment($id_reqdo_header);
        $data_doc = $this->cargo->getDataFormDoc($id_reqdo_header);
        //get data bank 
        $bank = $this->cargo->getDataBank();
        // print_r($data_place);die('test');
        if ($this->session->userdata('logged_in')) {
            $id_negara  = $this->input->post('id');
            $page_title = "Request Extend DO";
            
            $data = array(
                'page_title' => $page_title,
                '_content' => 'cms/content/form/v_extend_do',
                'data_header'    => $data_header,
                'data_container' => $data_container,
                'data_place' => $data_place,
                'data_payment'=> $data_payment,
                'bank'      => $bank,
                'data_doc' =>$data_doc
            );
            
            $this->load->view('cms/v_base',$data);
        } else{
            $this->load->view('login/v_login');
        }
    }



    public function LoadTableRequest(){
    	$data['ListData'] = $this->cargo->getDataTableRequest();
    	$this->load->view('cms/content/table/TableRequest',$data);
    }

    public function LoadTableRelease(){
        $this->load->view('cms/content/table/TableRelease');
    }

    public function LoadTableRequestSP2(){
        $this->load->view('cms/content/table/TableRequestSP2');
    }

    public function LoadTableReleaseSP2(){
        $this->load->view('cms/content/table/TableReleaseSP2');
    }

        public function getTableRelease()
    {
        // $coba = $this->input->post('no_bl');
        // print_r($coba);die('coba');
        $data = array();
        $dataRelease = $this->cargo->getDataTableRelease();

        foreach ($dataRelease as $items) {
            $row = array();
            $row[] = $items->noreqdo;
            $row[] = '<td class="tglreqdo table-row-left">'.$items->tglreqdo.'</td>';
            $row[] = '<td class="nobl table-row-left">'.$items->nobl.'</td>';
            $row[] = $items->tglbl;
            $row[] = $items->nodo;
            $row[] = $items->tgldoawal;
            $row[] = $items->tgldoakhir;
            $row[] = $items->kd_terminal;
            $row[] = $items->kd_shippingline;
            $row[] = '
                    <a class="table-row-left"><i class="ti ti-arrow-circle-right"></i></a>&nbsp;'.$items->uraian.'';
            if ($this->session->userdata('group')!= '1280') {
                $row[] = '<td class="table-row-center">
            
            <a href="'.base_url().'index.php/detail-release/'.$items->id_reqdo_header.'" data-toggle="tooltip" title="view detail"><i class="ti-eye"></i></a>
            &nbsp;
            <a href="'.base_url().'index.php/open-pdf/'.$items->id_reqdo_header.'" target="_blank" data-toggle="tooltip" title="Print Pdf"><i class="ti-printer"></i></a>
            &nbsp;
            <a href="'.base_url().'index.php/extend-do/'.$items->id_reqdo_header.'" data-toggle="tooltip" title="Extend DO"><i class="ti-shift-right"></i></a>
            &nbsp;
            <a data-toggle="tooltip" title="SP2" onclick="draftSP2('.$items->id_reqdo_header.')" style="color:blue;cursor:pointer;"><i class="ti-share"></i></a>
            &nbsp;
        </td>';
            } else {
                $row[] = '<td class="table-row-center">
                        <a href="'.base_url().'index.php/detail-release/'.$items->id_reqdo_header.'" data-toggle="tooltip" title="view detail"><i class="ti-eye"></i></a>&nbsp;
                </td>';
            }
            
            $data[] = $row;
        }

        $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $this->cargo->count_all(),
            "recordsFiltered" => $this->cargo->getFilteredData(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function getTableRequestSP2()
    {
        $data = array();
        $dataRelease = $this->cargo->getDataTableRequestSP2();

        foreach ($dataRelease as $items) {
            $row = array();
            $row[] = $items->noreqdo;
            $row[] = '<td class="tglreqdo table-row-left">'.$items->tglreqdo.'</td>';
            $row[] = '<td class="nobl table-row-left">'.$items->nobl.'</td>';
            $row[] = $items->tglbl;
            $row[] = $items->nodo;
            $row[] = $items->tgldoawal;
            $row[] = $items->tgldoakhir;
            $row[] = $items->kd_shippingline;
            $row[] = $items->kd_terminal;
            $row[] = '
                    <a class="table-row-left"><i class="ti ti-arrow-circle-right"></i></a>&nbsp;'.$items->uraian.'';

            if ($this->session->userdata('group')!= '1280') {
                $row[] = '<td class="table-row-center">
            
             <a data-toggle="tooltip" title="Get Container" onclick="getFormUser('.$items->id_reqdo_header.')" style="color:blue;cursor:pointer;"><i class="ti-share"></i></a>
            &nbsp;
            <a  onclick="getDetailSP2('.$items->id_reqdo_header.')" data-toggle="tooltip" title="view detail" style="color:blue;cursor:pointer;"><i class="ti-eye"></i></a>
            &nbsp;
            <a data-toggle="tooltip" title="Release SP2" onclick="releaseSP2('.$items->id_reqdo_header.')" style="color:blue;cursor:pointer;"><i class="ti-truck"></i></a>
            &nbsp;
        </td>';
            }else {
                $row[] = '<a  onclick="getDetailSP2('.$items->id_reqdo_header.')" data-toggle="tooltip" title="view detail" style="color:blue;cursor:pointer;"><i class="ti-eye"></i></a>
            &nbsp;';
            }
            
            $data[] = $row;
        }
         //<a data-toggle="tooltip" title="Get Container" onclick="getContainerSP2('.$items->id_reqdo_header.')" style="color:blue;cursor:pointer;"><i class="ti-share"></i></a>
            //&nbsp;
        // <a href="'.base_url().'index.php/detail-sp2/'.$items->id_reqdo_header.'" data-toggle="tooltip" title="view detail"><i class="ti-eye"></i></a>
        //     &nbsp;

        // <a data-toggle="tooltip" title="SP2" href="'.base_url().'index.php/C_spp/getFormContainer/'.$items->id_reqdo_header.'" ><i class="ti-share" ></i></a>
        //     &nbsp;

        $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $this->cargo->count_all_sp2(),
            "recordsFiltered" => $this->cargo->getFilteredDataSP2(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function getTableReleaseSP2()
    {
        $data = array();
        $dataRelease = $this->cargo->getDataTableReleaseSP2();

        foreach ($dataRelease as $items) {
            $row = array();
            $row[] = $items->noreqdo;
            $row[] = '<td class="tglreqdo table-row-left">'.$items->tglreqdo.'</td>';
            $row[] = '<td class="nobl table-row-left">'.$items->nobl.'</td>';
            $row[] = $items->tglbl;
            $row[] = $items->nodo;
            $row[] = $items->tgldoawal;
            $row[] = $items->tgldoakhir;
            $row[] = $items->kd_shippingline;
            $row[] = $items->kd_terminal;
            $row[] = '
                    <a class="table-row-left"><i class="ti ti-arrow-circle-right"></i></a>&nbsp;'.$items->uraian.'';
            if ($this->session->userdata('group')!= '1280') {
                $row[] = '<td class="table-row-center">
            <a  onclick="getDetailSP2('.$items->id_reqdo_header.')" data-toggle="tooltip" title="view detail" style="color:blue;cursor:pointer;"><i class="ti-eye"></i></a>
            &nbsp;
            <a data-toggle="tooltip" title="Gatepass SP2" onclick="getSP2('.$items->id_reqdo_header.')" style="color:blue;cursor:pointer;"><i class="ti-share"></i></a>
            &nbsp;
        </td>';
            } else {
                $row[] = '<a  onclick="getDetailSP2('.$items->id_reqdo_header.')" data-toggle="tooltip" title="view detail" style="color:blue;cursor:pointer;"><i class="ti-eye"></i></a>
            &nbsp;';
            }
            
            $data[] = $row;
        }

        // <a data-toggle="tooltip" title="SP2" href="'.base_url().'index.php/C_spp/getFormContainer/'.$items->id_reqdo_header.'" ><i class="ti-share" ></i></a>
        //     &nbsp;

        $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $this->cargo->count_all_Releasesp2(),
            "recordsFiltered" => $this->cargo->getFilteredDataReleaseSP2(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function sendRequest(){
        $hasil = $this->cargo->ExecRequest();
        echo $hasil;
    }

    public function extendRequest(){
        $hasil = $this->cargo->ExecExtend();
        echo $hasil;
    }

    public function editRequest(){
    	$hasil = $this->cargo->EditRequest();
    	echo $hasil;
    } 

    public function sendRequestByTable(){
        $hasil = $this->cargo->ExecRequestByTable();
        echo $hasil;
    }

    public function deleteRequest(){
    	$hasil = $this->cargo->ExecDeleteRequest();
    	echo $hasil;
    }

    public function getDataPelln(){
        $id_negara= $this->input->post('id_negara');        
        $pel_luar = $this->cargo->getDataPelLuar($id_negara);
        echo json_encode($pel_luar);
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
        // $kode = 'LNSW'.$date.$ship.'1'.$request_no;
        print_r($kode);die('test');
        return $kode;
    }

    public function getPdf($id) {

        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $this->load->model('M_cargo', 'cargo');
        $arrdata = $this->cargo->getDataPdf($id);
        $this->load->view('cms/content/pdf/release_do', $arrdata);
    }



 public function getDetailStatus($nobl,$tglreqdo){
    $no_bl = $nobl;
    $tglreq = $tglreqdo;
    $data_status = $this->cargo->getDataStatus($no_bl,$tglreq);
    echo json_encode($data_status);
  }

  public function getDetailStatusRelease(){
    $no_bl = $this->input->post('nobl');
    $tgldoakhir = $this->input->post('tglakhir');
    $tglreq = $this->input->post('tglreq');
    $data_status = $this->cargo->getDataStatusRelease($no_bl,$tgldoakhir,$tglreq);
    echo json_encode($data_status);
  }

  public function getDetailStatusSP2($nobl,$tglreqdo){
    $no_bl = $nobl;
    $tglreq = $tglreqdo;
    $data_status = $this->cargo->getDataStatusSP2($no_bl,$tglreq);
    echo json_encode($data_status);
  }

  public function getDetailStatusReleaseSP2($nobl,$tglakhir){
    $no_bl = $nobl;
    $tgldoakhir = $tglakhir;
    $data_status = $this->cargo->getDataStatusReleaseSP2($no_bl,$tgldoakhir);
    echo json_encode($data_status);
  }

  public function getDetailStatusRlease($id){
    $row = $this->input->post('row');
    $id_reqdo_header = $id;
  
  	$data_status = $this->cargo->getDataStatus($id_reqdo_header);
    $arrayLength = count($data_status);
    $content ='<td colspan="10">';
    $content .='</td>';
    $content .='<td>';
    // $content = '<div class="title_drilldown">INSW</div><BR>';
    $content .= '<table class="table table-hover" width="100%">';
    $content .= '<thead class="thead-dark">';    
    $content .= '<tr>';
    $content .= '<td>STATUS</td>';
    $content .= '<td>WAKTU</td>';
    $content .= '</tr>';
    $content .= '</thead>';

    for ($i = 0; $i < $arrayLength; $i++) {                        
        $content .= '<tr valign=\"top\">';
        $content .= '<td align=\"center\" class="" >' . $data_status[$i]['uraian'] . '</td>';
        $content .= '<td align=\"center\" class="" >' . date('Y-m-d H:i:s',strtotime($data_status[$i]['create_dt'])). '</td>';
        $content .= '</tr>';
    }
    $content .= '<tr>&nbsp;</tr>';
    $content .= '</table>';
    $content .= '</td>';
    $content .= '<td></td>';
    //die();
    print_r($content);
  }

  public function getFormCoba(){
   $data = array(
        'page_title' => 'test metadata 5',
        '_content' => 'cms/content/form/v_test_metadata',
    );
            
    $this->load->view('cms/v_base',$data);
  }

  public function execCoba(){
    $hasil = $this->cargo->ExecCoba();
    print_r($hasil);die('test5');
  }

  public function PdfCoba($id='12097'){
        $this->load->model('M_cargo', 'cargo');
        $arrdata = $this->cargo->getDataPdf($id);
        $this->load->view('cms/content/pdf/V_print_do',$arrdata);
  }

  public function sp2_req(){
    $id = $this->input->post('id');
    $hasil  = $this->cargo->req_sp2($id);
    echo $hasil;
  }

  public function cobaseal($id='19064'){
    $this->load->model('M_cargo_edit', 'cargo2');
    $data = $this->cargo2->getDataFormContainer($id);
    print_r($data);die('test');
  }
  public function getEncryptedNPWP()
  {
      $npwp = $_POST['npwp'];
      $hasil  = $this->cargo->EncryptedNPWP($npwp);
    echo $hasil;
  }
}
