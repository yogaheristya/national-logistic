<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print


    $html = '
            <div>
                <table border="0" width="100%" align="right">
                    <tr>
                        <td>
                            <img src="'.base_url('assets/images/logo.png').'" alt="" height="90" style="padding: 0px 0px 15px 0px">
                        </td>
                        <td colspan="3" class="barcode" align="right">
                        <barcode code="apps1.insw.go.id/national-logistic/index.php/C_cargo/getPdf/'.$dataHDR['id_reqdo_header'].'" type="QR" size="1" class="barcode"></barcode>
                        </td>
                    </tr>
                </table>
                <br>
                <table style="border:1px solid black;" width="100%" cellpadding="10" cellspacing="0">
                    <tr>
                        <td  width="50%" style="border-right: 1px solid;border-bottom: 1px solid;font-size:20px;"><b>'.$dataHDR['uraian'].'</b></td>
                        <td  width="20%" style="border-bottom: 1px solid;text-align:center;font-size:18px;"><b>Delivery Order</b></td>
                        <td width="20%" style="border-left: 1px solid;border-bottom: 1px solid;"><b>BL No. </b>
                            <div>
                                <label>'.$dataHDR['nobl'].'</label>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="font-size:12px" rowspan="2"  style="border-right: 1px solid;border-bottom: 1px solid;vertical-align: text-top">
                            <i><b>Notify Party</b></i>
                            <br>
                            <div style="font-size:16px">
                                <label>'.strtoupper($dataHDR['nama_notifyparty']).'</label>
                            </div>
                            <div>
                                <label>'.$dataHDR['npwp_notifyparty'].'</label>
                            </div>
                        </td>
                        <td style="font-size:12px;border-bottom: 1px solid;">
                            <i><b>DO Number</b></i>
                            <br>
                            <div style="font-size:16px">
                                <label>'.(($dataHDR['nodo']!="") ? strtoupper($dataHDR['nodo']) : '-').'</label>
                            </div>
                        </td>
                        <td style="font-size:12px;border-bottom: 1px solid;border-left: 1px solid;">
                            <i><b>DO Expired Date</b></i>
                            <br>
                            <div style="font-size:16px">
                                <label>'.(($dataHDR['tgldoakhir']!="") ? date('Y-m-d',strtotime($dataHDR['tgldoakhir'])) : '-').'</label>
                            </div>
                        </td>
                        
                    </tr>

                    <tr>
                       <td style="font-size:12px;border-bottom: 1px solid;">
                            <i><b>Vessel</b></i>
                            <br>
                            <div style="font-size:16px">
                                <label>'.(($dataHDR['nama_vessel']!="") ? strtoupper($dataHDR['nama_vessel']) : '-').'</label>
                            </div>
                        </td>
                        <td style="font-size:12px;border-bottom: 1px solid;border-left: 1px solid;">
                            <i><b>Voyage Number</b></i>
                            <br>
                            <div style="font-size:16px">
                                <label>'.(($dataHDR['nomor_voyage']!="") ? strtoupper($dataHDR['nomor_voyage']) : '-').'</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td rowspan="2"  style="border-right: 1px solid;border-bottom: 1px solid;vertical-align: text-top;" >
                            <i><b>Consignee</b></i>
                            <br>
                            <div style="font-size:16px">
                                <label>'.strtoupper($dataHDR['nama_consignee']).'</label>
                            </div>
                            <div>
                                <label>'.$dataHDR['npwp_consignee'].'</label>
                            </div>
                        </td>
                        <td style="font-size:12px;border-bottom: 1px solid;" colspan="2">
                            <i><b>Port of Loading</b></i>
                            <div style="font-size:16px">
                                <label>'.$dataHDR['loading']." , ".$dataHDR['negara_muat'].'</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-size:12px;border-bottom: 1px solid;" width="30%" colspan="2" >
                            <i><b>Port of Discharge</b></i>
                            <br>
                            <div style="font-size:16px">
                                <label>'.$dataHDR['discharge']." , ".$dataHDR['negara_bongkar'].'</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-size:12px;vertical-align: text-top;" rowspan="2"  style="border-right: 1px solid" >
                            <i><b>Shipper/Exporter</b></i>
                            <br>
                            <div style="font-size:16px">
                                <label>'.strtoupper($dataHDR['nama_consignor']).'</label>
                            </div>
                            <div>
                                <label>'.$dataHDR['npwp_consignee'].'</label>
                            </div>
                        </td>
                        <td style="font-size:12px solid;vertical-align: text-top;" colspan="2">
                            <i><b>Port of Delivery</b></i>
                            <div style="font-size:16px">
                                <label>'.$dataHDR['destination']." , ".$dataHDR['negara_tujuan'].'</label>
                            </div>
                        </td>
                    </tr>
                </table>
                <br><br>
                
                <br>
            </div>

    ';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+