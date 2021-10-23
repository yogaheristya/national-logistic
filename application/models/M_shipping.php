<?php
defined('BASEPATH') or exit('No direct script access allowed');
//node 6 production

class M_shipping extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getDataRequest()
    {
        $search = strtolower($this->input->post('search_req'));
        $param = $this->input->post('param');

        if ($search != "" && $param == '2') {
            // $sql = "SELECT A.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where nama_requestor like '%".$search."%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in ('LSSC','GSL')
            //     UNION SELECT A.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where nama_consignee like '%".$search."%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in ('LSSC','GSL')
            //     union select A.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where nama_notifyparty like '%".$search."%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in ('LSSC','GSL')";
            $kd_shippingline = $this->session->userdata('shipping');

            // kategori kode box yang tersedia dari database
            // Bentuk data dalam array
            // $kode_box = array(51) { [0]=> array(1) { ["kode_box"]=> string(3) "ADM" } [1]=> array(1) { ["kode_box"]=> string(3) "ANL" } ...
            // Bentuk data dalam string
            // $kode_box = ADM, ANL, APL, ASL, BBN, BEN, CCL, CMA, CNC, COS, EVG, ...
            $sql1 = "SELECT kode_box FROM nswdb1.tblrefshippingline group by kode_box order by kode_box asc";
            $kode_box = $this->db->query($sql1)->result_array();

            if ($this->session->userdata('group') != '1201') {
                $status = 0;

                // Melakukan perulangan data $kode_box
                foreach ($kode_box as $key => $value) {

                    // Mencari kode_box berdasarkan kd_shippingline yang ada di session
                    if ($kd_shippingline == $value['kode_box']) {

                        // Melakukan pencarian data kode berdasarkan kelompok kode_box yang telah di temukan
                        $sql2 = "SELECT kode, kode_box FROM nswdb1.tblrefshippingline where kode_box = '" . $value['kode_box'] . "' order by kode asc";
                        $kode = $this->db->query($sql2)->result_array();
                        $data_kode = array();

                        // Membentuk hasil data $sql2 menjadi array yang di simpan di $data_kode
                        // $data_kode = ['LSSC', 'GSL']
                        foreach ($kode as $key2 => $value2) {
                            array_push($data_kode, $value2['kode']);
                        }

                        // Query lama
                        // $sql = "SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_requestor) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in ('LSSC','GSL')
                        // UNION SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_consignee) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in ('LSSC','GSL')
                        // union select A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_notifyparty) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in ('LSSC','GSL')";

                        // Query baru
                        $sql = "SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_requestor) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in " . $data_kode . "
                        UNION SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_consignee) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in " . $data_kode . "
                        union select A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_notifyparty) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in " . $data_kode;

                        $status = 1;

                        // Menghentikan proses foreach ketika kode_box telah di temukan
                        break;
                    } else {
                        $status = 0;
                    }
                }

                // $status di gunakan untuk melakukan query lama pada bagian else
                // Query lama
                // ...
                // } else {
                //     $sql = "SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_requestor) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline = '" . $kd_shippingline . "'
                //     UNION SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_consignee) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline = '" . $kd_shippingline . "'
                //     union select A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_notifyparty) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline = '" . $kd_shippingline . "'";
                // }

                if ($status == 0) {
                    $sql = "SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_requestor) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline = '" . $kd_shippingline . "'
                    UNION SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_consignee) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline = '" . $kd_shippingline . "'
                    union select A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_notifyparty) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline = '" . $kd_shippingline . "'";
                }
            } else {
                $sql = "SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_requestor) like '%" . $search . "%' and statusreqdo in ('101','111','120','121')
                UNION SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_consignee) like '%" . $search . "%' and statusreqdo in ('101','111','120','121')
                union select A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_notifyparty) like '%" . $search . "%' and statusreqdo in ('101','111','120','121')";
            }

            $order = (!empty($_POST['order'][0])) ? $_POST['order'][0] : NULL;

            if (isset($order)) {
                $order_column = $order['column'];
                $order_dir = $order['dir'];

                if ($order_column == "0") {
                    $sql .= " ORDER BY noreqdo " . $order_dir;
                } else if ($order_column == "1") {
                    $sql .= " ORDER BY tglreqdo " . $order_dir;
                } else if ($order_column == "2") {
                    $sql .= " ORDER BY nobl " . $order_dir;
                } else if ($order_column == "3") {
                    $sql .= " ORDER BY tglbl " . $order_dir;
                } else if ($order_column == "4") {
                    $sql .= " ORDER BY nama_requestor " . $order_dir;
                } else if ($order_column == "5") {
                    $sql .= " ORDER BY kd_shippingline " . $order_dir;
                } else if ($order_column == "6") {
                    $sql .= " ORDER BY pel_bongkar " . $order_dir;
                } else if ($order_column == "7") {
                    $sql .= " ORDER BY B.uraian " . $order_dir;
                }
            } else {
                $sql .= " ORDER BY id_reqdo_header DESC";
            }

            $query = $this->db->query($sql);
            $hasil = $query->result_array();
        } else {
            $this->db->select('A.*,B.uraian');
            $this->db->from('tblreqdo_header A');
            $this->db->join('tbltab B', 'A.statusreqdo=B.kdnsw AND B.kdtab = \'D4\'', 'left');
            $this->db->where_in('statusreqdo', array('101', '111', '120', '121'));
            // $this->db->where('nodo is NULL', null, false);
            if ($search != "" && $param == '1') {
                $this->db->like('lower(nobl)', $search);
            } elseif ($search != "" && $param == '3') {
                // $this->db->select('A.*');
                // $this->db->from('tblreqdo_container A');
                // $this->db->like('A.no_container', $search);
                // $cont = $this->db->get()->row_array();
                $sql_cont = "SELECT * FROM tblreqdo_container where lower(no_container) like '%" . $search . "%'";
                $query_cont = $this->db->query($sql_cont);
                $cont = $query_cont->result_array();
                if (count($cont) > 0) {
                    foreach ($cont as $con) {
                        $arr[] = $con['id_reqdo_header'];
                    }
                    $this->db->where_in('id_reqdo_header', $arr);
                } else {
                    $this->db->where('id_reqdo_header', '001');
                }
            }

            $kd_shippingline = $this->session->userdata('shipping');

            // kategori kode box yang tersedia dari database
            // Bentuk data dalam array
            // $kode_box = array(51) { [0]=> array(1) { ["kode_box"]=> string(3) "ADM" } [1]=> array(1) { ["kode_box"]=> string(3) "ANL" } ...
            // Bentuk data dalam string
            // $kode_box = ADM, ANL, APL, ASL, BBN, BEN, CCL, CMA, CNC, COS, EVG, ...
            $sql = "SELECT kode_box FROM nswdb1.tblrefshippingline group by kode_box order by kode_box asc";
            $kode_box = $this->db->query($sql)->result_array();

            if ($this->session->userdata('group') != '1201') {
                $status = 0;

                // Melakukan perulangan data $kode_box
                foreach ($kode_box as $key => $value) {

                    // Mencari kode_box berdasarkan kd_shippingline yang ada di session
                    if ($kd_shippingline == $value['kode_box']) {

                        // Melakukan pencarian data kode berdasarkan kelompok kode_box yang telah di temukan
                        $sql2 = "SELECT kode, kode_box FROM nswdb1.tblrefshippingline where kode_box = '" . $value['kode_box'] . "' order by kode asc";
                        $kode = $this->db->query($sql2)->result_array();
                        $data_kode = array();

                        // Membentuk hasil data $sql2 menjadi array yang di simpan di $data_kode
                        // $data_kode = ['LSSC', 'GSL']
                        foreach ($kode as $key2 => $value2) {
                            array_push($data_kode, $value2['kode']);
                        }

                        // Query lama
                        // $this->db->where_in('kd_shippingline', array('LSSC', 'GSL'));
                        // Query baru
                        $this->db->where_in('kd_shippingline', $data_kode);

                        $status = 1;

                        // Menghentikan proses foreach ketika kode_box telah di temukan
                        break;
                    } else {
                        $status = 0;
                    }
                }

                // $status di gunakan untuk melakukan query lama pada bagian else
                // Query lama
                // ...
                // } else {
                //     $this->db->where('kd_shippingline', $kd_shippingline);
                // }

                if ($status == 0) {
                    $this->db->where('kd_shippingline', $kd_shippingline);
                }
            }

            $cari = $_POST["search"]["value"];
            if (isset($_POST["search"]["value"])) {
                $this->db->where("(noreqdo ILIKE '%" . $cari . "%' OR nobl ILIKE '%" . $cari . "%' OR nama_requestor ILIKE '%" . $cari . "%' OR kd_shippingline ILIKE '%" . $cari . "%' OR pel_bongkar ILIKE '%" . $cari . "%')", NULL, FALSE);
            }

            $order = (!empty($_POST['order'][0])) ? $_POST['order'][0] : NULL;

            if (isset($order)) {
                $order_column = $order['column'];
                $order_dir = $order['dir'];

                if ($order_column == "0") {
                    $this->db->order_by('A.noreqdo', $order_dir);
                } else if ($order_column == "1") {
                    $this->db->order_by('A.tglreqdo', $order_dir);
                } else if ($order_column == "2") {
                    $this->db->order_by('A.nobl', $order_dir);
                } else if ($order_column == "3") {
                    $this->db->order_by('A.tglbl', $order_dir);
                } else if ($order_column == "4") {
                    $this->db->order_by('A.nama_requestor', $order_dir);
                } else if ($order_column == "5") {
                    $this->db->order_by('A.kd_shippingline', $order_dir);
                } else if ($order_column == "6") {
                    $this->db->order_by('A.pel_bongkar', $order_dir);
                } else if ($order_column == "7") {
                    $this->db->order_by('B.uraian', $order_dir);
                }
            } else {
                $this->db->order_by('A.id_reqdo_header', 'DESC');
            }

            // $this->db->order_by('A.id_reqdo_header', 'DESC');
            if ($_POST["length"] != -1) {
                $this->db->limit($_POST["length"], $_POST["start"]);
            }
            $hasil = $this->db->get()->result_array();
        }


        return $hasil;
    }

    public function getDataRelease()
    {
        $nobl = $this->input->post('no_bl');

        $limit = $_POST['length'];
        $offset = $_POST['start'];
        $this->db->select('A.*,B.uraian');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tbltab B', 'A.statusreqdo=B.kdnsw AND B.kdtab = \'D4\'', 'left');
        $kd_shippingline = $this->session->userdata('shipping');

        // kategori kode box yang tersedia dari database
        // Bentuk data dalam array
        // $kode_box = array(51) { [0]=> array(1) { ["kode_box"]=> string(3) "ADM" } [1]=> array(1) { ["kode_box"]=> string(3) "ANL" } ...
        // Bentuk data dalam string
        // $kode_box = ADM, ANL, APL, ASL, BBN, BEN, CCL, CMA, CNC, COS, EVG, ...
        $sql = "SELECT kode_box FROM nswdb1.tblrefshippingline group by kode_box order by kode_box asc";
        $kode_box = $this->db->query($sql)->result_array();

        if ($this->session->userdata('group') != '1201') {
            $status = 0;

            // Melakukan perulangan data $kode_box
            foreach ($kode_box as $key => $value) {

                // Mencari kode_box berdasarkan kd_shippingline yang ada di session
                if ($kd_shippingline == $value['kode_box']) {

                    // Melakukan pencarian data kode berdasarkan kelompok kode_box yang telah di temukan
                    $sql2 = "SELECT kode, kode_box FROM nswdb1.tblrefshippingline where kode_box = '" . $value['kode_box'] . "' order by kode asc";
                    $kode = $this->db->query($sql2)->result_array();
                    $data_kode = array();

                    // Membentuk hasil data $sql2 menjadi array yang di simpan di $data_kode
                    // $data_kode = ['LSSC', 'GSL']
                    foreach ($kode as $key2 => $value2) {
                        array_push($data_kode, $value2['kode']);
                    }

                    // Query lama
                    // $this->db->where_in('kd_shippingline', array('LSSC', 'GSL'));
                    // Query baru
                    $this->db->where_in('kd_shippingline', $data_kode);

                    $status = 1;

                    // Menghentikan proses foreach ketika kode_box telah di temukan
                    break;
                } else {
                    $status = 0;
                }
            }

            // $status di gunakan untuk melakukan query lama pada bagian else
            // Query lama
            // ...
            // } else {
            //     $this->db->where('kd_shippingline', $kd_shippingline);
            // }

            if ($status == 0) {
                $this->db->where('kd_shippingline', $kd_shippingline);
            }
        }

        if ($nobl) {
            // $this->db->where('nobl', $nobl);
            $search_values = explode(",", $nobl);
            // print_r($search_values);die(' test nobl');
            if (count($search_values) > 0) {
                foreach ($search_values as $row => $sv) {
                    $parse = preg_replace('/\s+/', '', $sv);
                    if ($row == 0) {
                        $q_explode = "nobl ILIKE '%" . $sv . "%'";
                        // $q_explode = "nobl = '" . $parse . "'";
                    } else {
                        $q_explode = $q_explode . " OR nobl ILIKE'%" . $sv . "%'";
                        // $q_explode = $q_explode." OR nobl = '" . $sv . "'";
                    }
                }
                $this->db->where($q_explode, NULL, FALSE);
            } else {
                $parse = preg_replace('/\s+/', '', $nobl);
                // print_r($_POST["search"]["value"]);die(' (ga explode)');
                // echo "No use of exploding";
                $this->db->where("nobl ILIKE '%" . $nobl . "%'", NULL, FALSE);
                // $this->db->where("nobl = '" . $parse . "'", NULL, FALSE);
            }
            // $this->db->limit($_POST["length"], $_POST["start"]);
        }
        $this->db->where('nodo is NOT NULL', null, false);
        $this->db->where('nobl is NOT NULL', null, false);
        $this->db->where("(statusreqdo='210' OR statusreqdo='211' OR statusreqdo='212' OR statusreqdo='213' OR statusreqdo='214' OR statusreqdo='215')", NULL, FALSE);

        $cari = $_POST["search"]["value"];
        if (isset($_POST["search"]["value"])) {
            $this->db->where("(noreqdo ILIKE '%" . $cari . "%' OR nobl ILIKE '%" . $cari . "%' OR nodo ILIKE '%" . $cari . "%' OR nama_requestor ILIKE '%" . $cari . "%' OR kd_shippingline ILIKE '%" . $cari . "%' OR kd_terminal ILIKE '%" . $cari . "%')", NULL, FALSE);
        }

        $order = (!empty($_POST['order'][0])) ? $_POST['order'][0] : NULL;

        if (isset($order)) {
            $order_column = $order['column'];
            $order_dir = $order['dir'];

            if ($order_column == "0") {
                $this->db->order_by('A.noreqdo', $order_dir);
            } else if ($order_column == "1") {
                $this->db->order_by('A.tglreqdo', $order_dir);
            } else if ($order_column == "2") {
                $this->db->order_by('A.nobl', $order_dir);
            } else if ($order_column == "3") {
                $this->db->order_by('A.tglbl', $order_dir);
            } else if ($order_column == "4") {
                $this->db->order_by('A.nodo', $order_dir);
            } else if ($order_column == "5") {
                $this->db->order_by('A.tgldoawal', $order_dir);
            } else if ($order_column == "6") {
                $this->db->order_by('A.tgldoakhir', $order_dir);
            } else if ($order_column == "7") {
                $this->db->order_by('A.kd_terminal', $order_dir);
            } else if ($order_column == "8") {
                $this->db->order_by('A.kd_shippingline', $order_dir);
            } else if ($order_column == "9") {
                $this->db->order_by('B.uraian', $order_dir);
            }
        } else {
            $this->db->order_by('A.id_reqdo_header', 'DESC');
        }

        if ($_POST["length"] != -1) {
            $this->db->limit($_POST["length"], $_POST["start"]);
        }
        $hasil = $this->db->get()->result();
        return $hasil;
    }

    // public function getDataRelease(){
    //     $please= $this->getDataReleaseQuery();
    //     print_r($please);die('test');
    //     if ($_POST["length"] != -1) {
    //         $this->db->limit($_POST["length"],$_POST["start"]);
    //     }
    //     $hasil = $this->db->get()->result();
    //     return $hasil;
    // }

    public function getFilteredDataRequest()
    {
        $search = strtolower($this->input->post('search_req'));
        $param = $this->input->post('param');
        $kd_shippingline = $this->session->userdata('shipping');

        if ($search != "" && $param == '2') {
            // $sql = "SELECT A.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where nama_requestor like '%".$search."%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in ('LSSC','GSL')
            //     UNION SELECT A.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where nama_consignee like '%".$search."%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in ('LSSC','GSL')
            //     union select A.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where nama_notifyparty like '%".$search."%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in ('LSSC','GSL')";

            // kategori kode box yang tersedia dari database
            // Bentuk data dalam array
            // $kode_box = array(51) { [0]=> array(1) { ["kode_box"]=> string(3) "ADM" } [1]=> array(1) { ["kode_box"]=> string(3) "ANL" } ...
            // Bentuk data dalam string
            // $kode_box = ADM, ANL, APL, ASL, BBN, BEN, CCL, CMA, CNC, COS, EVG, ...
            $sql1 = "SELECT kode_box FROM nswdb1.tblrefshippingline group by kode_box order by kode_box asc";
            $kode_box = $this->db->query($sql1)->result_array();

            if ($this->session->userdata('group') != '1201') {
                $status = 0;

                // Melakukan perulangan data $kode_box
                foreach ($kode_box as $key => $value) {

                    // Mencari kode_box berdasarkan kd_shippingline yang ada di session
                    if ($kd_shippingline == $value['kode_box']) {

                        // Melakukan pencarian data kode berdasarkan kelompok kode_box yang telah di temukan
                        $sql2 = "SELECT kode, kode_box FROM nswdb1.tblrefshippingline where kode_box = '" . $value['kode_box'] . "' order by kode asc";
                        $kode = $this->db->query($sql2)->result_array();
                        $data_kode = array();

                        // Membentuk hasil data $sql2 menjadi array yang di simpan di $data_kode
                        // $data_kode = ['LSSC', 'GSL']
                        foreach ($kode as $key2 => $value2) {
                            array_push($data_kode, $value2['kode']);
                        }

                        // Query lama
                        // $sql = "SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_requestor) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in ('LSSC','GSL')
                        // UNION SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_consignee) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in ('LSSC','GSL')
                        // union select A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_notifyparty) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in ('LSSC','GSL')";

                        // Query baru
                        $sql = "SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_requestor) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in " . $data_kode . "
                        UNION SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_consignee) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in " . $data_kode . "
                        union select A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_notifyparty) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline in " . $data_kode;

                        $status = 1;

                        // Menghentikan proses foreach ketika kode_box telah di temukan
                        break;
                    } else {
                        $status = 0;
                    }
                }

                // $status di gunakan untuk melakukan query lama pada bagian else
                // Query lama
                // ...
                // } else {
                //     $sql = "SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_requestor) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline = '" . $kd_shippingline . "'
                //     UNION SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_consignee) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline = '" . $kd_shippingline . "'
                //     union select A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_notifyparty) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline = '" . $kd_shippingline . "'";
                // }

                if ($status == 0) {
                    $sql = "SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_requestor) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline = '" . $kd_shippingline . "'
                    UNION SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_consignee) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline = '" . $kd_shippingline . "'
                    union select A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_notifyparty) like '%" . $search . "%' and statusreqdo in ('101','111','120','121') AND A.kd_shippingline = '" . $kd_shippingline . "'";
                }
            } else {
                $sql = "SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_requestor) like '%" . $search . "%' and statusreqdo in ('101','111','120','121')
                UNION SELECT A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_consignee) like '%" . $search . "%' and statusreqdo in ('101','111','120','121')
                union select A.*,B.* from tblreqdo_header A left join tbltab B on A.statusreqdo=B.kdnsw AND B.kdtab = 'D4' where lower(nama_notifyparty) like '%" . $search . "%' and statusreqdo in ('101','111','120','121')";
            }
            $sql .= " ORDER BY id_reqdo_header DESC";
            $query = $this->db->query($sql);
            $hasil = $query->num_rows();
        } else {
            $this->db->select('A.*,B.uraian');
            $this->db->from('tblreqdo_header A');
            $this->db->join('tbltab B', 'A.statusreqdo=B.kdnsw AND B.kdtab = \'D4\'', 'left');
            $this->db->where_in('statusreqdo', array('101', '111', '120', '121'));
            // $this->db->where('nodo is NULL', null, false);
            if ($search != "" && $param == '1') {
                $this->db->like('nobl', $search);
            } elseif ($search != "" && $param == '3') {
                // $this->db->select('A.*');
                // $this->db->from('tblreqdo_container A');
                // $this->db->like('A.no_container', $search);
                // $cont = $this->db->get()->row_array();
                $sql_cont = "SELECT * FROM tblreqdo_container where lower(no_container) like '%" . $search . "%'";
                $query_cont = $this->db->query($sql_cont);
                $cont = $query_cont->result_array();
                if (count($cont) > 0) {
                    foreach ($cont as $con) {
                        $arr[] = $con['id_reqdo_header'];
                    }
                    $this->db->where_in('id_reqdo_header', $arr);
                } else {
                    $this->db->where('id_reqdo_header', '001');
                }
            }

            // kategori kode box yang tersedia dari database
            // Bentuk data dalam array
            // $kode_box = array(51) { [0]=> array(1) { ["kode_box"]=> string(3) "ADM" } [1]=> array(1) { ["kode_box"]=> string(3) "ANL" } ...
            // Bentuk data dalam string
            // $kode_box = ADM, ANL, APL, ASL, BBN, BEN, CCL, CMA, CNC, COS, EVG, ...
            $sql = "SELECT kode_box FROM nswdb1.tblrefshippingline group by kode_box order by kode_box asc";
            $kode_box = $this->db->query($sql)->result_array();

            if ($this->session->userdata('group') != '1201') {
                $status = 0;

                // Melakukan perulangan data $kode_box
                foreach ($kode_box as $key => $value) {

                    // Mencari kode_box berdasarkan kd_shippingline yang ada di session
                    if ($kd_shippingline == $value['kode_box']) {

                        // Melakukan pencarian data kode berdasarkan kelompok kode_box yang telah di temukan
                        $sql2 = "SELECT kode, kode_box FROM nswdb1.tblrefshippingline where kode_box = '" . $value['kode_box'] . "' order by kode asc";
                        $kode = $this->db->query($sql2)->result_array();
                        $data_kode = array();

                        // Membentuk hasil data $sql2 menjadi array yang di simpan di $data_kode
                        // $data_kode = ['LSSC', 'GSL']
                        foreach ($kode as $key2 => $value2) {
                            array_push($data_kode, $value2['kode']);
                        }

                        // Query lama
                        // $this->db->where_in('kd_shippingline', array('LSSC', 'GSL'));
                        // Query baru
                        $this->db->where_in('kd_shippingline', $data_kode);

                        $status = 1;

                        // Menghentikan proses foreach ketika kode_box telah di temukan
                        break;
                    } else {
                        $status = 0;
                    }
                }

                // $status di gunakan untuk melakukan query lama pada bagian else
                // Query lama
                // ...
                // } else {
                //     $this->db->where('kd_shippingline', $kd_shippingline);
                // }

                if ($status == 0) {
                    $this->db->where('kd_shippingline', $kd_shippingline);
                }
            }

            $this->db->order_by('A.id_reqdo_header', 'DESC');
            $hasil = $this->db->get()->num_rows();
        }


        return $hasil;
    }

    public function getFilteredData()
    {
        $limit = $_POST['length'];
        $offset = $_POST['start'];

        // $this->db->select('A.*,B.uraian');
        // diubah menjadi
        $this->db->select('count(id_reqdo_header)');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tbltab B', 'A.statusreqdo=B.kdnsw AND B.kdtab = \'D4\'', 'left');
        $kd_shippingline = $this->session->userdata('shipping');

        // kategori kode box yang tersedia dari database
        // Bentuk data dalam array
        // $kode_box = array(51) { [0]=> array(1) { ["kode_box"]=> string(3) "ADM" } [1]=> array(1) { ["kode_box"]=> string(3) "ANL" } ...
        // Bentuk data dalam string
        // $kode_box = ADM, ANL, APL, ASL, BBN, BEN, CCL, CMA, CNC, COS, EVG, ...
        $sql = "SELECT kode_box FROM nswdb1.tblrefshippingline group by kode_box order by kode_box asc";
        $kode_box = $this->db->query($sql)->result_array();

        if ($this->session->userdata('group') != '1201') {
            $status = 0;

            // Melakukan perulangan data $kode_box
            foreach ($kode_box as $key => $value) {

                // Mencari kode_box berdasarkan kd_shippingline yang ada di session
                if ($kd_shippingline == $value['kode_box']) {

                    // Melakukan pencarian data kode berdasarkan kelompok kode_box yang telah di temukan
                    $sql2 = "SELECT kode, kode_box FROM nswdb1.tblrefshippingline where kode_box = '" . $value['kode_box'] . "' order by kode asc";
                    $kode = $this->db->query($sql2)->result_array();
                    $data_kode = array();

                    // Membentuk hasil data $sql2 menjadi array yang di simpan di $data_kode
                    // $data_kode = ['LSSC', 'GSL']
                    foreach ($kode as $key2 => $value2) {
                        array_push($data_kode, $value2['kode']);
                    }

                    // Query lama
                    // $this->db->where_in('kd_shippingline', array('LSSC', 'GSL'));
                    // Query baru
                    $this->db->where_in('kd_shippingline', $data_kode);

                    $status = 1;

                    // Menghentikan proses foreach ketika kode_box telah di temukan
                    break;
                } else {
                    $status = 0;
                }
            }

            // $status di gunakan untuk melakukan query lama pada bagian else
            // Query lama
            // ...
            // } else {
            //     $this->db->where('kd_shippingline', $kd_shippingline);
            // }

            if ($status == 0) {
                $this->db->where('kd_shippingline', $kd_shippingline);
            }
        }

        $this->db->where('nodo is NOT NULL', null, false);
        $this->db->where("(statusreqdo='210' OR statusreqdo='211' OR statusreqdo='212' OR statusreqdo='213' OR statusreqdo='214' OR statusreqdo='215')", NULL, FALSE);
        $cari = $_POST["search"]["value"];
        if (isset($_POST["search"]["value"])) {
            $this->db->where("(noreqdo LIKE '%" . $cari . "%' OR nobl LIKE '%" . $cari . "%' OR nodo LIKE '%" . $cari . "%' OR nama_requestor LIKE '%" . $cari . "%' OR kd_shippingline LIKE '%" . $cari . "%')", NULL, FALSE);
        }
        // $this->db->order_by('A.id_reqdo_header', 'DESC');
        // $hasil = $this->db->get()->num_rows();
        // return $hasil;
        $hasil = $this->db->get()->row_array();
        return $hasil['count'];
    }

    public function count_all()
    {
        $this->db->select('count(id_reqdo_header)');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tbltab B', 'A.statusreqdo=B.kdnsw AND B.kdtab = \'D4\'', 'left');
        $kd_shippingline = $this->session->userdata('shipping');

        // kategori kode box yang tersedia dari database
        // Bentuk data dalam array
        // $kode_box = array(51) { [0]=> array(1) { ["kode_box"]=> string(3) "ADM" } [1]=> array(1) { ["kode_box"]=> string(3) "ANL" } ...
        // Bentuk data dalam string
        // $kode_box = ADM, ANL, APL, ASL, BBN, BEN, CCL, CMA, CNC, COS, EVG, ...
        $sql = "SELECT kode_box FROM nswdb1.tblrefshippingline group by kode_box order by kode_box asc";
        $kode_box = $this->db->query($sql)->result_array();

        if ($this->session->userdata('group') != '1201') {
            $status = 0;

            // Melakukan perulangan data $kode_box
            foreach ($kode_box as $key => $value) {

                // Mencari kode_box berdasarkan kd_shippingline yang ada di session
                if ($kd_shippingline == $value['kode_box']) {

                    // Melakukan pencarian data kode berdasarkan kelompok kode_box yang telah di temukan
                    $sql2 = "SELECT kode, kode_box FROM nswdb1.tblrefshippingline where kode_box = '" . $value['kode_box'] . "' order by kode asc";
                    $kode = $this->db->query($sql2)->result_array();
                    $data_kode = array();

                    // Membentuk hasil data $sql2 menjadi array yang di simpan di $data_kode
                    // $data_kode = ['LSSC', 'GSL']
                    foreach ($kode as $key2 => $value2) {
                        array_push($data_kode, $value2['kode']);
                    }

                    // Query lama
                    // $this->db->where_in('kd_shippingline', array('LSSC', 'GSL'));
                    // Query baru
                    $this->db->where_in('kd_shippingline', $data_kode);

                    $status = 1;

                    // Menghentikan proses foreach ketika kode_box telah di temukan
                    break;
                } else {
                    $status = 0;
                }
            }

            // $status di gunakan untuk melakukan query lama pada bagian else
            // Query lama
            // ...
            // } else {
            //     $this->db->where('kd_shippingline', $kd_shippingline);
            // }

            if ($status == 0) {
                $this->db->where('kd_shippingline', $kd_shippingline);
            }
        }
        $this->db->where('nodo is NOT NULL', null, false);
        $this->db->where("(statusreqdo='210' OR statusreqdo='211' OR statusreqdo='212' OR statusreqdo='213' OR statusreqdo='214' OR statusreqdo='215')", NULL, FALSE);
        $hasil = $this->db->get()->row_array();
        return $hasil['count'];
    }

    public function count_all_request()
    {
        $this->db->select('count(id_reqdo_header)');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tbltab B', 'A.statusreqdo=B.kdnsw AND B.kdtab = \'D4\'', 'left');
        $this->db->where_in('statusreqdo', array('101', '111', '120', '121'));

        $kd_shippingline = $this->session->userdata('shipping');

        // kategori kode box yang tersedia dari database
        // Bentuk data dalam array
        // $kode_box = array(51) { [0]=> array(1) { ["kode_box"]=> string(3) "ADM" } [1]=> array(1) { ["kode_box"]=> string(3) "ANL" } ...
        // Bentuk data dalam string
        // $kode_box = ADM, ANL, APL, ASL, BBN, BEN, CCL, CMA, CNC, COS, EVG, ...
        $sql = "SELECT kode_box FROM nswdb1.tblrefshippingline group by kode_box order by kode_box asc";
        $kode_box = $this->db->query($sql)->result_array();

        if ($this->session->userdata('group') != '1201') {
            $status = 0;

            // Melakukan perulangan data $kode_box
            foreach ($kode_box as $key => $value) {

                // Mencari kode_box berdasarkan kd_shippingline yang ada di session
                if ($kd_shippingline == $value['kode_box']) {

                    // Melakukan pencarian data kode berdasarkan kelompok kode_box yang telah di temukan
                    $sql2 = "SELECT kode, kode_box FROM nswdb1.tblrefshippingline where kode_box = '" . $value['kode_box'] . "' order by kode asc";
                    $kode = $this->db->query($sql2)->result_array();
                    $data_kode = array();

                    // Membentuk hasil data $sql2 menjadi array yang di simpan di $data_kode
                    // $data_kode = ['LSSC', 'GSL']
                    foreach ($kode as $key2 => $value2) {
                        array_push($data_kode, $value2['kode']);
                    }

                    // Query lama
                    // $this->db->where_in('kd_shippingline', array('LSSC', 'GSL'));
                    // Query baru
                    $this->db->where_in('kd_shippingline', $data_kode);

                    $status = 1;

                    // Menghentikan proses foreach ketika kode_box telah di temukan
                    break;
                } else {
                    $status = 0;
                }
            }

            // $status di gunakan untuk melakukan query lama pada bagian else
            // Query lama
            // ...
            // } else {
            //     $this->db->where('kd_shippingline', $kd_shippingline);
            // }

            if ($status == 0) {
                $this->db->where('kd_shippingline', $kd_shippingline);
            }
        }

        $hasil = $this->db->get()->row_array();
        return $hasil['count'];
    }

    public function getDataFormDetail($id_reqdo_header)
    {
        $this->db->select('A.*,B.*');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tblrefshippingline B', 'A.kd_shippingline=B.kode');
        $this->db->where('id_reqdo_header', $id_reqdo_header);
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
        $this->db->where('A.id_reqdo_header', $id_reqdo_header);
        $hasil = $this->db->get()->result_array();
        // print_r($data_seal);die('test');
        $container = array();
        foreach ($hasil as $data_con) {

            $id_con = $data_con["id_reqdo_container"];
            $data_seal = $this->getDataFormSeal($id_con);
            array_push($data_con, $data_seal);
            array_push($container, $data_con);
        }


        // die('test');
        return $container;
    }

    //tambahan
    public function getDataFormGoods($id_reqdo_header)
    {
        // $this->db->select('A.*,B.kdnsw,B.uraian');
        // $this->db->from('tblreqdo_container A');
        // $this->db->join('tbltab B','A.ownership=B.kdnsw','left outer');
        // $this->db->where('A.id_reqdo_header',$id_reqdo_header);
        // $this->db->where('B.kdnsw','D6');
        $this->db->select('A.*');
        $this->db->from('tblreqdo_goods A');
        $this->db->where('A.id_reqdo_header', $id_reqdo_header);
        $hasil = $this->db->get()->result_array();
        // print_r($data_seal);die('test');

        // die('test');
        return $hasil;
    }

    public function getDataFormMeasurement($id_reqdo_header)
    {
        // $this->db->select('A.*,B.kdnsw,B.uraian');
        // $this->db->from('tblreqdo_container A');
        // $this->db->join('tbltab B','A.ownership=B.kdnsw','left outer');
        // $this->db->where('A.id_reqdo_header',$id_reqdo_header);
        // $this->db->where('B.kdnsw','D6');
        $this->db->select('A.*');
        $this->db->from('nswdb1.tblreqdo_measurement A');
        $this->db->where('A.id_reqdo_header', $id_reqdo_header);
        $hasil = $this->db->get()->result_array();
        // print_r($data_seal);die('test');

        // die('test');
        return $hasil;
    }
    //penutup tambahan

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

    public function getDataFormPayment($id_reqdo_header)
    {
        $this->db->select('A.*,B.*,C.nm_bank');
        $this->db->from('tblreqdo_buktibayar A');
        $this->db->join('tblreqdo_dok B', 'A.id_reqdo_dok = B.id_reqdo_dok');
        $this->db->join('nswdb2.ter_bank C', 'A.kd_bank = C.kd_bank', 'left');
        $this->db->where('id_reqdo_header', $id_reqdo_header);
        $hasil = $this->db->get()->result_array();
        return $hasil;
    }

    public function getDataFormDoc($id_reqdo_header)
    {
        $jns = array('4', '5', '6', '9', '10');
        $this->db->select('A.*');
        $this->db->from('tblreqdo_dok A');
        $this->db->where_in('A.jenis_dok', $jns);
        $this->db->where('A.id_reqdo_header', $id_reqdo_header);

        $hasil = $this->db->get()->result_array();
        return $hasil;
    }

    public function getDataPel()
    {
        $hasil = $this->db->get('tblpeldn')->result_array();
        return $hasil;
    }

    public function getDataPelLuar($id_negara)
    {
        $sql  = "select * from tblpelln where substring(kdedi,1,2)='$id_negara'";
        $query  = $this->db->query($sql);
        $hasil  = $query->result_array();
        return $hasil;
    }

    public function getDataNegara()
    {
        $hasil = $this->db->get('tblnegara')->result_array();
        return $hasil;
    }

    public function getPelMuat($id_reqdo_header)
    {
        $this->db->select('A.pel_muat,B.uredi');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tblpelln B', 'A.pel_muat=B.kdedi');
        $this->db->where('id_reqdo_header', $id_reqdo_header);
        $hasil = $this->db->get()->row_array();
        return $hasil;
    }

    public function getPelBongkar($id_reqdo_header)
    {
        $this->db->select('A.pel_bongkar,B.uredi');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tblpeldn B', 'A.pel_bongkar=B.kdedi');
        $this->db->where('id_reqdo_header', $id_reqdo_header);
        $hasil = $this->db->get()->row_array();
        return $hasil;
    }

    public function getPelTujuan($id_reqdo_header)
    {
        $this->db->select('A.pel_tujuan,B.uredi');
        $this->db->from('tblreqdo_header A');
        $this->db->join('tblpeldn B', 'A.pel_tujuan=B.kdedi');
        $this->db->where('id_reqdo_header', $id_reqdo_header);
        $hasil = $this->db->get()->row_array();
        return $hasil;
    }


    public function ExecRelease()
    {
        $acc = $this->input->post('acceptance');
        $id_reqdo_header = $this->input->post('id');
        $nodo = $this->input->post('nodo');
        $tglawal = $this->input->post('tgldoawal');
        $tgldoawal = date('Y-m-d H:i:s', strtotime($tglawal));
        $tglakhir  = $this->input->post('tgldoakhir');
        $tgldoakhir = date('Y-m-d H:i:s', strtotime($tglakhir));
        $terminal = $this->input->post('terminal');
        $id_container = $this->input->post('id_container');
        $nama_depo = $this->input->post('nama_depo');
        $npwp_depo = $this->input->post('npwp_depo');
        $alamat_depo = $this->input->post('alamat_depo');
        $kota_depo = $this->input->post('kota_depo');
        $kdpos_depo = $this->input->post('kdpos_depo');
        $telp_depo = $this->input->post('telp_depo');
        $ket = $this->input->post('keterangan');
        $callsign = $this->input->post('callsign');
        $vessel = $this->input->post('nama_vessel');
        $voyage = $this->input->post('nomor_voyage');
        $pin_number = $this->input->post('pin_number');

        if ($acc == '1') {
            $data = array(
                'nodo' => $nodo,
                'statusreqdo' => '210',
                'tgldoawal' => $tgldoawal,
                'tgldoakhir' => $tgldoakhir,
                'kd_terminal' => $terminal,
                'nama_vessel' => $vessel,
                'nomor_voyage' => $voyage,
                'callsign' => $callsign,
                'pin_number' => $pin_number
            );
            $where = array("id_reqdo_header" => $id_reqdo_header);
            $exec = $this->db->update('tblreqdo_header', $data, $where);
            for ($i = 0; $i < sizeof($id_container); $i++) {
                $container_detail = array(
                    'nama_depo' => $nama_depo[$i],
                    'npwp_depo' => $npwp_depo[$i],
                    'alamat_depo'   => $alamat_depo[$i],
                    'kota_depo' => $kota_depo[$i],
                    'kdpos_depo' => $kdpos_depo[$i],
                    'telp_depo' => $telp_depo[$i]
                );
                $whereDepo = array("id_reqdo_container" => $id_container[$i]);
                $execDepo = $this->db->update('tblreqdo_container', $container_detail, $whereDepo);
            }
            if ($exec) {
                $sql1 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date) values ('" . $id_reqdo_header . "','210','" . $this->session->userdata('username') . "',now())";
                $exec1 = $this->db->query($sql1);

                $return = "msg#success#Request Accepted#" . site_url() . '/C_auth';
            } else {
                $return = "msg#error#Request Unsuccesful, Please Contact Administrator#" . site_url() . '/C_auth';
            }
        } else {
            $data = array(
                'statusreqdo' => '203'
            );
            $where = array("id_reqdo_header" => $id_reqdo_header);
            $exec = $this->db->update('tblreqdo_header', $data, $where);
            if ($exec) {
                $sql1 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date,keterangan) values ('" . $id_reqdo_header . "','200','" . $this->session->userdata('username') . "',now(),'" . $ket . "')";
                $exec1 = $this->db->query($sql1);
                $sql2 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date,keterangan) values ('" . $id_reqdo_header . "','201','" . $this->session->userdata('username') . "',now(),'" . $ket . "')";
                $exec2 = $this->db->query($sql2);
                $sql3 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date,keterangan) values ('" . $id_reqdo_header . "','202','" . $this->session->userdata('username') . "',now(),'" . $ket . "')";
                $exec3 = $this->db->query($sql3);
                $sql4 = "INSERT INTO  nswdb1.tblreqdo_status(id_reqdo_header,kode_status,created_by,created_date,keterangan) values ('" . $id_reqdo_header . "','203','" . $this->session->userdata('username') . "',now(),'" . $ket . "')";
                $exec4 = $this->db->query($sql4);
                $return = "msg#success#Request Rejected#" . site_url() . '/C_auth';
            } else {
                $return = "msg#error#Request Unsuccesful, Please Contact Administrator#" . site_url() . '/C_auth';
            }
        }



        return $return;
    }

    public function generate_request_no($ship)
    {
        $date = date("Ymd");
        $sql = "select right(noreqdo,4),created_date from tblreqdo_header order by id_reqdo_header DESC";
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

    // public function getDataStatus($no_bl){

    //     $sql = "select id_reqdo_header from tblreqdo_header where  nobl='$no_bl'";
    //     $query = $this->db->query($sql);
    //     $row = $query->row_array();
    //     $id_reqdo_header = $row['id_reqdo_header'];

    //     $sql2 = "select A.id_reqdo_status,B.URAIAN, to_char(A.CREATED_DATE, 'MM-DD-YYYY HH24:MI:SS') AS CREATED_DATE from tblreqdo_status A join tbltab B on A.kode_status=B.kdnsw and B.kdtab='D4' where id_reqdo_header='$id_reqdo_header' ORDER BY A.id_reqdo_status DESC";
    //     $query2 = $this->db->query($sql2);
    //     $hasil = $query2->result_array();
    //     return $hasil;
    // }
    public function getDataStatus($no_bl, $tglreq)
    {
        $tglreqdo = str_replace('%20', " ", $tglreq);
        $sql = "select id_reqdo_header from tblreqdo_header where  nobl='$no_bl' and tglreqdo='$tglreqdo'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $id_reqdo_header = $row['id_reqdo_header'];

        // $sql2 = "select A.*, B.* from tblreqdo_status A join tbltab B on A.kode_status=B.kdnsw and B.kdtab='D4' where id_reqdo_header='$id_reqdo_header'";
        $sql2 = "select B.URAIAN, to_char(A.CREATED_DATE, 'MM-DD-YYYY HH24:MI:SS') AS CREATED_DATE, A.keterangan from tblreqdo_status A join tbltab B on A.kode_status=B.kdnsw and B.kdtab='D4' where id_reqdo_header='$id_reqdo_header' ORDER BY A.id_reqdo_status DESC";
        $query2 = $this->db->query($sql2);
        $hasil = $query2->result_array();
        return $hasil;
    }

    public function getDataStatusRelease($no_bl, $tgldoakhir, $tglreq)
    {
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
}

/* End of file M_auth.php */
