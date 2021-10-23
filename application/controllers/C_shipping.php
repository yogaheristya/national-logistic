<?php
defined('BASEPATH') or exit('No direct script access allowed');
//5
class C_shipping extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_shipping', 'shipping');
        $this->load->library('pdf');
    }

    public function getFormRequest($id_reqdo_header)
    {


        $data_header        = $this->shipping->getDataFormDetail($id_reqdo_header);
        $data_container     = $this->shipping->getDataFormContainer($id_reqdo_header);
        $data_place["muat"]    = $this->shipping->getPelMuat($id_reqdo_header);
        $data_place["bongkar"] = $this->shipping->getPelBongkar($id_reqdo_header);
        $data_place["tujuan"]  = $this->shipping->getPelTujuan($id_reqdo_header);
        $data_payment          = $this->shipping->getDataFormPayment($id_reqdo_header);
        $data_doc              = $this->shipping->getDataFormDoc($id_reqdo_header);
        //tambahan
        $data_goods = $this->shipping->getDataFormGoods($id_reqdo_header);
        $data_measurement = $this->shipping->getDataFormMeasurement($id_reqdo_header);
        //penutup tambahan

        // print_r($data_place);die('test');
        if ($this->session->userdata('logged_in')) {
            $id_negara  = $this->input->post('id');
            $page_title = "Form Request DO";
            $this->db->select('statusreqdo');
            $this->db->from('tblreqdo_header');
            $this->db->where('id_reqdo_header', $id_reqdo_header);
            $status = $this->db->get()->row_array();

            $statusreqdo = array(
                'statusreqdo' => '111'
            );

            $where = array("id_reqdo_header" => $id_reqdo_header);
            $exec = $this->db->update('tblreqdo_header', $statusreqdo, $where);
            $data = array(
                'page_title' => $page_title,
                '_content' => 'cms/content/form/v_request_ship',
                'data_header'    => $data_header,
                'data_container' => $data_container,
                'data_place' => $data_place,
                'data_payment' => $data_payment,
                'data_doc'     => $data_doc,
                'data_goods' => $data_goods,
                'data_measurement' => $data_measurement
            );
            $this->load->view('cms/v_base', $data);
        } else {
            $this->load->view('login/v_login');
        }
    }

    public function getFormRelease($id_reqdo_header)
    {

        $data_header        = $this->shipping->getDataFormDetail($id_reqdo_header);
        $data_container     = $this->shipping->getDataFormContainer($id_reqdo_header);
        $data_place["muat"]    = $this->shipping->getPelMuat($id_reqdo_header);
        $data_place["bongkar"] = $this->shipping->getPelBongkar($id_reqdo_header);
        $data_place["tujuan"]  = $this->shipping->getPelTujuan($id_reqdo_header);
        $data_payment          = $this->shipping->getDataFormPayment($id_reqdo_header);
        $data_doc = $this->shipping->getDataFormDoc($id_reqdo_header);
        // print_r($data_place);die('test');
        if ($this->session->userdata('logged_in')) {
            $id_negara  = $this->input->post('id');
            $page_title = "Form Release DO";

            $data = array(
                'page_title' => $page_title,
                '_content' => 'cms/content/form/v_release_do',
                'data_header'    => $data_header,
                'data_container' => $data_container,
                'data_place' => $data_place,
                'data_payment' => $data_payment,
                'data_doc' => $data_doc
            );

            $this->load->view('cms/v_base', $data);
        } else {
            $this->load->view('login/v_login');
        }
    }

    public function LoadTableRequest()
    {
        $this->load->view('cms/content/table/TableRequestShipping');
    }

    public function LoadTableRelease()
    {
        $this->load->view('cms/content/table/TableReleaseShipping');
    }

    public function getTableRequest()
    {
        $data = array();
        $dataRequest = $this->shipping->getDataRequest();

        $counter = 0;
        foreach ($dataRequest as $items) {
            $row = array();

            if ($dataRequest[$counter]["nobl"] != "" && $dataRequest[$counter]["tglreqdo"] != "") {
                $noblku = $dataRequest[$counter]["nobl"];
                $tglreqdoku =  $dataRequest[$counter]["tglreqdo"];
                $statusku = $this->shipping->getDataStatus($noblku, $tglreqdoku);
                $length = count($statusku);
                if ($length > 0) {
                    $dataRequest[$counter]['uraian'] = $statusku[0]['uraian'];
                } else {
                    $dataRequest[$counter]['uraian'] = "";
                }
            }

            $row[] = $items['noreqdo'];
            $row[] = $items['tglreqdo'];
            $row[] = $items['nobl'];
            $row[] = $items["tglbl"] ? date('Y-m-d', strtotime($items["tglbl"])) : '';
            $row[] = $items['nama_requestor'];
            $row[] = $items['kd_shippingline'];
            $row[] = $items['pel_bongkar'];
            $row[] = '<a class="table-row-left"><i class="ti ti-arrow-circle-right"></i></a>&nbsp;' . $dataRequest[$counter]['uraian'];
            $row[] = '<td align="center"><a href="' . base_url() . 'index.php/C_shipping/getFormRequest/' . $items["id_reqdo_header"] . '"><i class="ti-pencil-alt"></i></a></td>';

            $data[] = $row;
            $counter++;
        }

        $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $this->shipping->count_all_request(),
            "recordsFiltered" => $this->shipping->getFilteredDataRequest(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function getTableRelease()
    {
        $data = array();
        $dataRelease = $this->shipping->getDataRelease();

        foreach ($dataRelease as $items) {

            $no_bl = $items->nobl;  //DONLE-46 Header status not synchronize with detail
            $tglreq = $items->tglreqdo;
            $tgldoakhir = $items->tgldoakhir;
            $statusku = $this->shipping->getDataStatusRelease($no_bl, $tgldoakhir, $tglreq);
            $uraian = $statusku[0]["uraian"];
            $row = array();
            $row[] = $items->noreqdo;
            $row[] = '<td class="tglreqdo table-row-left">' . $items->tglreqdo . '</td>';
            $row[] = '<td class="nobl table-row-left">' . $items->nobl . '</td>';
            $row[] = $items->tglbl;
            $row[] = $items->nodo;
            $row[] = $items->tgldoawal;
            $row[] = $items->tgldoakhir;
            // $row[] = $items->nama_requestor;
            $row[] = $items->kd_terminal;
            $row[] = $items->kd_shippingline;
            $row[] = '
                    <a class="table-row-left"><i class="ti ti-arrow-circle-right"></i></a>&nbsp;' . $uraian . '';
            $row[] = '<td class="table-row-center">

            <a href="' . base_url() . 'index.php/detail-release/' . $items->id_reqdo_header . '" data-toggle="tooltip" title="view detail"><i class="ti-eye"></i></a>
            &nbsp;
            <a href="' . base_url() . 'index.php/open-pdf/' . $items->id_reqdo_header . '" target="_blank" data-toggle="tooltip" title="Print Pdf"><i class="ti-printer"></i></a>
            &nbsp;
        </td>';
            $data[] = $row;
        }

        $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $this->shipping->count_all(),
            "recordsFiltered" => $this->shipping->getFilteredData(),
            "data" => $data
        );
        echo json_encode($output);
    }


    public function sendRequest()
    {

        $hasil = $this->shipping->ExecRequest();
        echo $hasil;
    }

    public function execRelease()
    {

        $hasil = $this->shipping->ExecRelease();
        echo $hasil;
    }

    public function sendRequestByTable()
    {
        $hasil = $this->shipping->ExecRequestByTable();
        echo $hasil;
    }

    public function getDataPelln()
    {
        $id_negara = $this->input->post('id');
        $pel_luar = $this->shipping->getDataPelLuar($id_negara);
        echo json_encode($pel_luar);
    }

    public function generate_request_no($ship)
    {
        $date = date("Ymd");
        $sql = "SELECT right(noreqdo,4),created_date from tblreqdo_header where substring(noreqdo,1,4)='LNSW' order by id_reqdo_header desc";
        $query = $this->db->query($sql);
        $row = $query->row_array();

        $nomor = intval($row['right']);
        $created_dt = $row['created_date'];
        $created_date = date('Y-m-d', strtotime($created_dt));
        $now_date = date('Y-m-d');

        if ($created_date != $now_date) {
            $request_no = '0000';
            // $req_no = $nomor+1;
            // $request_no = sprintf("%04s",$req_no);
        } else {
            $req_no = $nomor + 1;
            $request_no = sprintf("%04s", $req_no);
        }

        $kode = 'LNSW' . $date . $ship . '1' . $request_no;
        return $kode;
    }

    function getPdf()
    {
        $pdf = $this->pdf->load('"en-GB-x","A4","","",1,1,1,1,6,3');
        $html = '<h1>TEST Saja</h1>';
        $pdf->AddPage('L');
        $pdf->WriteHTML($html);
        $pdf->Output('do.pdf', 'I');
    }

    // public function getDetailStatus($nobl){

    //     $no_bl = $nobl;
    //     $data_status = $this->shipping->getDataStatus($no_bl);
    //     echo json_encode($data_status);
    // }
    public function getDetailStatus($nobl, $tglreqdo)
    {
        // $no_bl = $nobl;
        // $tglreq = $tglreqdo;
        $no_bl = $this->input->post('nobl');
        $tglreq = $this->input->post('tglreqdo');
        
        $data_status = $this->shipping->getDataStatus($no_bl, $tglreq);
        echo json_encode($data_status);
    }

    public function getDetailStatusRelease()
    {
        $no_bl = $this->input->post('nobl');
        $tgldoakhir = $this->input->post('tglakhir');
        $tglreq = $this->input->post('tglreq');
        $data_status = $this->shipping->getDataStatusRelease($no_bl, $tgldoakhir, $tglreq);
        // $data_status = $this->shipping->getDataStatusRelease($no_bl, $tgldoakhir);
        echo json_encode($data_status);
    }

    public function backStatus()
    {
        $id_reqdo_header = $this->input->post('id');
        $data = array('statusreqdo' => '101');
        $where = array('id_reqdo_header' => $id_reqdo_header);
        $exec = $this->db->update('tblreqdo_header', $data, $where);
        $return = site_url();
        echo $return;
    }
}
