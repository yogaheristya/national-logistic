<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_auth extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_login','login');
        require_once(APPPATH.'libraries/nusoap/lib/nusoap.php');
    }
	public function index()
	{
		// $this->load->view('welcome_message');
		if ($this->session->userdata('logged_in')) {
			$group = $this->session->userdata('group');
			if ($group=='1180' OR $group=='1200' OR $group=='1280') {
				$data = array(
					'_content' => 'cms/content/front/v_cargo'
				);
			} elseif ($group=='1181' OR $group=='1201') {
				$data = array(
						'_content' => 'cms/content/front/v_shipping'
				);
			} 	
			// $data = array(
			// 	'_content' => 'cms/content/front/v_cargo'
			// );
			$this->load->view('cms/v_base',$data);
		} else{
			$this->load->view('login/v_login');
		}
        
	}

	public function do_login(){
		$result = $this->login->do_login();
		$captchaInput = $this->input->post('inputCaptcha');
        	$sessCaptcha = $this->session->userdata('captchaCode');
		
		if (strtoupper($captchaInput) == $sessCaptcha) {
			if ($result['status']) {
				$newdata = array(
					'group' => $result["F_GROUP"] ,
					'username' => $result["F_USERNAME"],
					'F_npwp' => $result["F_npwp"],
                    'F_perusahaan' => $result["F_perusahaan"],
                    'F_alamat' => $result["F_alamat"],
                    'shipping' => $result["F_shipping"],
                    'nib' =>$result["F_nib"],
                    'userid'=>$result["userid"],
					'logged_in' =>TRUE
				);
				$this->session->set_userdata($newdata);
				$return = "msg#success#Login Successfully#" . site_url();
			} else {
				$this->session->unset_userdata('captchaCode');
				$return = "msg#error#".$result['message']."#".site_url();
			}
		} else {
			$this->session->unset_userdata('captchaCode');
			$return = "msg#error#Captcha Tidak Cocok#".site_url();
		}

		echo $return;

	}


	public function nle()
	{
		if (isset($_GET['token'])) {
			$token = $_GET['token'];
			$valid = $this->login->cekAuth($token);
			$pecah = explode('.', $token);
			$userEnc  	= $pecah[1];
			$userDec	=  base64_decode($userEnc);
			$userJson	= json_decode($userDec,TRUE);
			$userlogin	= $userJson['sub'];
			if ($valid == 'valid') {
				if ($userlogin != "") {
					$sql = "SELECT b.idgroup, a.fullname,c.nmorg,c.almorg,c.noidorg,c.noppjk,d.nama_perusahaan,d.npwp, d.nib,a.userid FROM tbluser a 
                        LEFT JOIN tblgroupuser  b ON a.userid = b.userid 
                        LEFT JOIN tblorganization c ON a.orgid = c.orgid
                        LEFT JOIN registrasi.treg_dataumum d ON d.npwp = c.noidorg
                        WHERE userlogin = '".$userlogin."'";
					$qry = $this->db->query($sql);
					$row = $qry->row_array();
					$F_GROUP = $row["idgroup"];
        			$F_USERNAME = $row["fullname"];
        			$F_npwp = $row["noidorg"];
        			$F_perusahaan = $row["nmorg"];
        			$F_alamat = $row["almorg"];
        			$F_nib = $row["nib"];
        			$F_shipping= $row["noppjk"];
        			$userid= $row["userid"];

        			$newdata = array(
						'group' => $F_GROUP ,
						'username' => $F_USERNAME,
						'F_npwp' => $F_npwp,
                    	'F_perusahaan' => $F_perusahaan,
                    	'F_alamat' => $F_alamat,
                    	'shipping' => $F_shipping,
                    	'nib' =>$F_nib,
                    	'userid'=>$userid,
						'logged_in' =>TRUE
					);

					if ($F_GROUP=='1180' OR $F_GROUP=='1200' OR $F_GROUP=='1280'OR $F_GROUP=='1181' OR $F_GROUP=='1201') {
						$this->session->set_userdata($newdata);
						redirect('https://apps1.insw.go.id/national-logistic/', 'refresh');
					} else{
						$this->load->view('login/v_login');
					}	
			
				} else {

					$this->load->view('login/v_login');
				}
			} else {
				$this->load->view('login/v_login');
			}

		} else {
			$this->load->view('login/v_login');
		}
        
	}

	public function createCaptcha()
    {
		
		$listKota= array(
            'INDONESIA','ARMENIA','SINGAPORE','NETHERLANDS','ANTARTICA','AUSTRALIA','BELGIUM','BAHRAIN','CANADA','JAPAN','SWITZERLAND','CHINA','EGYPT','MALAYSIA'
        );
        shuffle($listKota);
        $strRnd = strtoupper($listKota[0]);
        // Setting Captcha to Session
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', strtoupper($strRnd));
        $arrColor = array(array(113, 193, 217), array(76, 175, 80), array(221, 77, 64), array(190, 144, 212));
        $arrColorSelect = $arrColor[array_rand($arrColor)];
        $font = '/assets/fonts/Duality.ttf';
        // $font = 'D:\wamp64\www\INSW\dashboard_handler\assets\fonts\Duality.ttf';
        $image = imagecreatetruecolor(250, 50);
        $color = imagecolorallocate($image, $arrColorSelect[0], $arrColorSelect[1], $arrColorSelect[2]);
        imagesavealpha($image, true);
        $trans_colour = imagecolorallocatealpha($image, 0, 0, 0, 127);
        imagefill($image, 0, 0, $trans_colour);
        $red = imagecolorallocate($image, 255, 0, 0);
        imagefilledellipse($image, 400, 300, 400, 300, $red);
        $white = imagecolorallocate($image, 231, 235, 238);
        imagettftext($image, 20, 0, 10, 40, $color, $font, $strRnd);
        header("Content-type: image/png");
		return imagepng($image);
	// 	$vals = array(
	// 		'word'          => 'Random word',
	// 		'img_path'      => 'assets/captcha/',
	// 		'img_url'       => base_url().'index.php/assets/captcha/',
	// 		'font_path'     => '/assets/fonts/Duality.ttf',
	// 		'img_width'     => '150',
	// 		'img_height'    => 30,
	// 		'expiration'    => 7200,
	// 		'word_length'   => 8,
	// 		'font_size'     => 16,
	// 		'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
	
	// 		// White background and border, black text and red grid
	// 		'colors'        => array(
	// 				'background' => array(255, 255, 255),
	// 				'border' => array(255, 255, 255),
	// 				'text' => array(0, 0, 0),
	// 				'grid' => array(255, 40, 40)
	// 		)
	// );
	
	// $cap = create_captcha($vals);
	// echo $cap['image'];
	// }
	}


public function logout()
  {
  	// $sessID = $this->session->userdata('sessID');
  	if(isset($_SESSION['sessID'])){
        $client = new nusoap_client('http://123.231.237.22/TPSOnlineServices/server.php?wsdl');
		$logout_params = array('Username' => 'INSW', 'Password' => 'INSW123','fstream'=> '{"SESSIONID":"'.$sessID.'"}');
		$result = $client->call('AUTH_GetLogOut', $logout_params);
		$this->session->sess_destroy();
   }else{
		$this->session->sess_destroy();      
   }    
    redirect(base_url());
  }

}
