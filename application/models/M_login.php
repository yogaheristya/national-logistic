<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function do_login()
    {

        // Sanitasi input menggunakan library custom "Sanitation.php"
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $sql1 = "SELECT F_VERIFYUSER('$username','$password')";
        $sql2 = "SELECT b.idgroup, a.fullname,c.nmorg,c.almorg,c.noidorg,c.noppjk,d.nama_perusahaan,d.npwp, d.nib,a.userid FROM tbluser a 
                        LEFT JOIN tblgroupuser  b ON a.userid = b.userid 
                        LEFT JOIN tblorganization c ON a.orgid = c.orgid
                        LEFT JOIN registrasi.treg_dataumum d ON d.npwp = c.noidorg
                        WHERE userlogin = '$username'"; 

        $qry1 = $this->db->query($sql1);
        $qry2 = $this->db->query($sql2);

        $row1 = $qry1->row_array();
        $row2 = $qry2->row_array();
        
        $F_VERIFYUSER = $row1["f_verifyuser"];
        $F_GROUP = $row2["idgroup"];
        $F_USERNAME = $row2["fullname"];
        $F_npwp = $row2["noidorg"];
        $F_perusahaan = $row2["nmorg"];
        $F_alamat = $row2["almorg"];
        $F_nib = $row2["nib"];
        $kode_shippingline = $row2["noppjk"];
        $userid= $row2["userid"];
        if($F_VERIFYUSER != "9"){   
            if($F_GROUP != '1180' && $F_GROUP != '1181' && $F_GROUP!='1200' && $F_GROUP!='1201' && $F_GROUP!='1280'){                    
                $result = array(
                    'status' => false,
                    'message' => 'Limited Access !',
                    'data' => null
                ); 
                return $result;
            }
            else{
                $result = array(
                    'status' => true,
                    'message' => 'Login Success !',
                    'F_GROUP' => $F_GROUP,
                    'F_USERNAME' => $F_USERNAME,
                    'F_npwp' => $F_npwp,
                    'F_nib' =>$F_nib,
                    'F_perusahaan' => $F_perusahaan,
                    'F_alamat' => $F_alamat,
                    'F_shipping' => $kode_shippingline,
                    'userid' => $userid
                );
                
                return $result;                   
            }                
        }
        else{
            $result = array(
                'status' => false,
                'message' => 'Login Gagal !',
                'data' => null
            );
            return $result;
        }

        print_r($result);die('test');	
        // pg_close(); 
    }

    public function cekAuth($token){
        $curl = curl_init();
        $url = "http://10.1.6.153/api/NLE/dosp/checkAuth";
        $authorization = "Authorization: Bearer ".$token;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                $authorization
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}

/* End of file M_auth.php */
