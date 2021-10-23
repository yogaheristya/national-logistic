<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_spp extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('M_spp','spp');
	}

	public function request(){
		$id = $this->input->post('id');
		$validasi = $this->spp->validasi($id);
		print_r($validasi);
	}

	public function cekRelasi(){
		$id_header = $this->input->post('id');
		$cekRelasi = $this->spp->cekRelasi($id_header);
		print_r($cekRelasi);
	}

	public function getContainer(){
		$id = $this->input->post('id');
		$data = $this->spp->getContainer($id);
		$this->load->view('cms/content/popup/container', $data);
	}

	public function getSP2(){
		$id = $this->input->post('id');
		$data = $this->spp->getSP2($id);
		echo $data;
		// echo $data;
	}

	public function releaseSP2(){
		$id = $this->input->post('id');
		$data = $this->spp->releaseSP2($id);
		echo $data;
		// echo $data;
	}

	public function cekDetailSP2(){
		$id_header = $this->input->post('id');
		$cekDetail = $this->spp->cekDetailSP2($id_header);
		print_r($cekDetail);
	}




	public function getFormContainer($id){
		if ($this->session->userdata('logged_in')) {
            $id_negara  = $this->input->post('id');
            $page_title = "List Container";
            $data_container = $this->spp->getContainer($id);
            
            $data = array(
                'page_title' => $page_title,
                '_content' => 'cms/content/form/v_get_container',
                'container' =>$data_container,
                'id_reqdo_header'=>$id
            );
            
            $this->load->view('cms/v_base',$data);
        } else{
            $this->load->view('login/v_login');
        }
	}

	public function getProforma(){
		// $data = $this->spp->getProforma();
		$hasil = $this->spp->getProforma();
		echo $hasil;
		// if ($this->session->userdata('logged_in')) {
  //           $page_title = "List Container";
  //           $data_proforma = $this->spp->getProforma();
            
  //           $data = array(
  //               'page_title' => $page_title,
  //               '_content' => 'cms/content/form/v_get_proforma',
  //               'proforma' =>$data_proforma
  //           );
            
  //           $this->load->view('cms/v_base',$data);
  //       } else{
  //           $this->load->view('login/v_login');
  //       }
	}

	public function getFormProforma($id_reqdo_header){
		// $data = $this->spp->getProforma();
		// $hasil = $this->spp->getProforma();
		// echo $hasil;
		if ($this->session->userdata('logged_in')) {
            $page_title = "List Container";
            $data_proforma = $this->spp->getFormProforma($id_reqdo_header);
            
            $data = array(
                'page_title' => $page_title,
                '_content' => 'cms/content/form/v_get_proforma',
                'proforma' =>$data_proforma
            );
            
            $this->load->view('cms/v_base',$data);
        } else{
            $this->load->view('login/v_login');
        }
	}

	

	public function getFormDetailSP2($id_reqdo_header){

        $data_detail= $this->spp->getDataDetailSP2($id_reqdo_header);
        // print_r($data_place);die('test');
        if ($this->session->userdata('logged_in')) {
            $id_negara  = $this->input->post('id');
            $page_title = "View Request DO";
            
            $data = array(
                'page_title' => $page_title,
                '_content' => 'cms/content/form/v_detail_requestSP2',
                'detail'    => $data_detail,
            );
            
            $this->load->view('cms/v_base',$data);
        } else{
            $this->load->view('login/v_login');
        }
    }

	public function logout(){
		$this->spp->logout();
	}

	public function test($id){
		print_r($id);die('asdjjadsbn');
		$data = $this->spp->getSP2('31331');
		print_r($data);die('coba');
	}

	public function ikt_cek(){
		$dataTruck  = $this->spp->ikt_cek();
		echo $dataTruck;
	}


	public function ikt_getTruck(){
		$dataTruck  = $this->spp->ikt_getTruck();
		echo $dataTruck;
	}

	public function ikt_request(){
		$dataTruck  = $this->spp->ikt_request();
		echo $dataTruck;
	}

	public function ikt_detailrelease(){
		$data['id'] = $this->input->post('id');
		$this->load->view('cms/content/popup/V_detail_release_sp2',$data);
	}

	 public function ikt_datarelease(){
        $data= $this->spp->ikt_datarelease();
        echo $data;
    }


}

/* End of file C_spp.php */
/* Location: ./application/controllers/C_spp.php */
?>