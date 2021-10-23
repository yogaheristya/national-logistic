<?php

// $mpdf = new mPDF('utf-8', 'A6',8,5,7,7,7,7);

// $drawPerPage = 50;
// $html = getStyle();
// $html .= '<body>';
// $html .= getHTML();
// $html .= '</div>';

// $mpdf->WriteHTML($html);

// if($mpdf->y>=219)
// {
// $mpdf->AddPage();
// }
// $mpdf->WriteHTML($ttd);

// $mpdf->Output();

$pdf = $this->pdf->load('"en-GB-x","A4","","",1,1,1,1,6,3');
$pdf->SetTitle('Document Delivery Order');
$pdf->SetAuthor('Lembaga National Single Window');
$pdf->SetSubject('Release Document Delivery Order');
$pdf->SetProtection(array('print'));
$html = getStyle();
$html .= '<body>';
$html .= getHTML($dataHDR, $dataCon);
$html .= '</div>';
$footer = getFooter();
$pdf->AddPage('P');
$pdf->WriteHTML($html);
$pdf->SetHTMLFooter($footer);
$pdf->Output('do.pdf', 'I');


function getStyle()
{
    $html = '
    <style type="text/css">

        table,tr,td{
            
        }

         .div1 {
            width: 100%;
            height: 100%;
            border: 1px solid black;
        }

        
        .line1{
            border-top:1px solid black;
            border-bottom:1px solid black;
        }
        .td1{
            width:25% 
            color:black; 
            font-size:10px;
            padding: 0px;
        }
        .td2{
            width: 5%
            color:black; 
            font-size:10px;
            padding: 0px;
        }
        .td3{
            font-size:10px;
        }
        .barcode {
            padding: 1mm;
            margin: 0;
            vertical-align: top;
            color: #000000;
        }
        .barcodecell {
            text-align: center;
            vertical-align: middle;
            padding: 0;
        }
                </style>';

    return $html;
}

function getHTML($dataHDR, $dataCon)
{
    if ($dataHDR["cargo_type"] != 3) {
        $i = 0;
        $tableHead .=   '<td>Container No</td>
                            <td>Seal No</td>
                            <td>Size Type</td>
                            <td>Gross Weight</td>
                            <td>Depo Name</td>
                            <td>Phone Number</td>';

        foreach ($dataCon as $con) {
            $addHtmlDetail .= '<tr>
                            <td>' . $con["no_container"] . '</td>';
            $addHtmlDetail .= '<td>';
            foreach ($con[0] as $seal) {
                $addHtmlDetail .= '<label>' . $seal . '</label><br>';
            }
            $addHtmlDetail .= '</td>';
            $addHtmlDetail .= '<td>' . $con["uk_container"] . "-" . $con["tipe_container"] . '</td>
                            <td>' . $con["gross_weight"] . "-" . $con["gross_weight_satuan"] . '</td>
                            <td>' . $con["nama_depo"] . '</td>
                            <td>' . $con["telp_depo"] . '</td>
                          </tr>';
            $i++;
        }
    } else {
        $tableHead .=      '<tr>
                                    <th style="vertical-align:middle; border-right: 1px solid;border-bottom: 1px solid;">Description of Goods</th>
                                    <th style="border-right: 1px solid;border-bottom: 1px solid;">Package <br> (Quantity & Satuan)</th>
                                    <th style="border-right: 1px solid;border-bottom: 1px solid;">Gross Weight <br> (Quantity & Satuan)</th>
                                    <th style="border-bottom: 1px solid;">Measurement <br> (Volume & Satuan)</th>
                            </tr>';

        foreach ($dataCon as $con) {
            $addHtmlDetail .=   '<tr>' .
                '<td style="border-right: 1px solid; border-bottom: 1px solid; ">' . $con["goods_desc"] . '</td>
                 <td style="text-align: center; border-right: 1px solid; border-bottom: 1px solid;">' . $con["package_qty"] . " " . $con["package_uom"] . '</td>
                 <td style="text-align: center; border-right: 1px solid;  border-bottom: 1px solid;">' . $con["gross_qty"] . " " . $con["gross_uom"] . '</td>
                 <td style="text-align: center;  border-bottom: 1px solid;">' . $con["measurement_qty"] . " " . $con["measurement_uom"] . '</td>'
                . '</tr>';
        }
    }

    // <img src="'.base_url('assets/images/logo.png').'" alt="" height="90" style="padding: 0px 0px 15px 0px">
    $html = '
            <div>
                <table border="0" width="100%" align="right">
                    <tr>
                        <td>
                         
                        </td>
                        <td colspan="3" class="barcode" align="right">
                        <barcode code="apps1.insw.go.id/national-logistic/index.php/C_cargo/getPdf/' . $dataHDR['id_reqdo_header'] . '" type="QR" size="1" class="barcode"></barcode>
                        </td>
                    </tr>
                </table>
                <br>
                <table style="border:1px solid black;" width="100%" cellpadding="10" cellspacing="0">
                    <tr>
                        <td  width="50%" style="border-right: 1px solid;border-bottom: 1px solid;font-size:20px;"><b>' . $dataHDR['uraian'] . '</b></td>
                        <td  width="20%" style="border-bottom: 1px solid;text-align:center;font-size:18px;"><b>Delivery Order</b></td>
                        <td width="20%" style="border-left: 1px solid;border-bottom: 1px solid;"><b>BL No. </b>
                            <div>
                                <label>' . $dataHDR['nobl'] . '</label>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="font-size:12px" rowspan="2"  style="border-right: 1px solid;border-bottom: 1px solid;vertical-align: text-top">
                            <i><b>Notify Party</b></i>
                            <br>
                            <div style="font-size:16px">
                                <label>' . strtoupper($dataHDR['nama_notifyparty']) . '</label>
                            </div>
                            <div>
                                <label>' . $dataHDR['npwp_notifyparty'] . '</label>
                            </div>
                        </td>
                        <td style="font-size:12px;border-bottom: 1px solid;">
                            <i><b>DO Number</b></i>
                            <br>
                            <div style="font-size:16px">
                                <label>' . (($dataHDR['nodo'] != "") ? strtoupper($dataHDR['nodo']) : '-') . '</label>
                            </div>
                        </td>
                        <td style="font-size:12px;border-bottom: 1px solid;border-left: 1px solid;">
                            <i><b>DO Expired Date</b></i>
                            <br>
                            <div style="font-size:16px">
                                <label>' . (($dataHDR['tgldoakhir'] != "") ? date('Y-m-d', strtotime($dataHDR['tgldoakhir'])) : '-') . '</label>
                            </div>
                        </td>
                        
                    </tr>

                    <tr>
                       <td style="font-size:12px;border-bottom: 1px solid;">
                            <i><b>Vessel</b></i>
                            <br>
                            <div style="font-size:16px">
                                <label>' . (($dataHDR['nama_vessel'] != "") ? strtoupper($dataHDR['nama_vessel']) : '-') . '</label>
                            </div>
                        </td>
                        <td style="font-size:12px;border-bottom: 1px solid;border-left: 1px solid;">
                            <i><b>Voyage Number</b></i>
                            <br>
                            <div style="font-size:16px">
                                <label>' . (($dataHDR['nomor_voyage'] != "") ? strtoupper($dataHDR['nomor_voyage']) : '-') . '</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td rowspan="2"  style="border-right: 1px solid;border-bottom: 1px solid;vertical-align: text-top;" >
                            <i><b>Consignee</b></i>
                            <br>
                            <div style="font-size:16px">
                                <label>' . strtoupper($dataHDR['nama_consignee']) . '</label>
                            </div>
                            <div>
                                <label>' . $dataHDR['npwp_consignee'] . '</label>
                            </div>
                        </td>
                        <td style="font-size:12px;border-bottom: 1px solid;" colspan="2">
                            <i><b>Port of Loading</b></i>
                            <div style="font-size:16px">
                                <label>' . $dataHDR['loading'] . " , " . $dataHDR['negara_muat'] . '</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-size:12px;border-bottom: 1px solid;" width="30%" colspan="2" >
                            <i><b>Port of Discharge</b></i>
                            <br>
                            <div style="font-size:16px">
                                <label>' . $dataHDR['discharge'] . " , " . $dataHDR['negara_bongkar'] . '</label>
                            </div>
                        </td>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-size:12px;vertical-align: text-top;" rowspan="2"  style="border-right: 1px solid" >
                            <i><b>Shipper/Exporter</b></i>
                            <br>
                            <div style="font-size:16px">
                                <label>' . strtoupper($dataHDR['nama_consignor']) . '</label>
                            </div>
                            <div>
                                <label>' . $dataHDR['npwp_consignee'] . '</label>
                            </div>
                        </td>
                        <td style="font-size:12px solid;vertical-align: text-top;" colspan="2">
                            <i><b>Port of Delivery</b></i>
                            <div style="font-size:16px">
                                <label>' . $dataHDR['destination'] . " , " . $dataHDR['negara_tujuan'] . '</label>
                            </div>
                        </td>
                    </tr>
                </table>
                <br><br>
                
                <table style="border:1px solid black;" width="100%" cellpadding="10" cellspacing="0">
                    <thead>
                        <tr>
                          ' . $tableHead . '
                        </tr>
                    </thead>
                    <tbody>
                        ' . $addHtmlDetail . '
                    </tbody>
                </table>
                 
                <br>
            </div>

    ';


    return $html;
}


function getFooter()
{
    $footer = '
            <p style="font-size:8px;text-align: justify;">Disclaimer: <br>
<i>This document represents electronic data of Delivery Order based on the electronic data received by INSW from respective Shipping Line / Shipping Agency. The content of this print version only consider as valid information if it is accordance with its electronic data. You may re confirm it to the respective party for your perusal.</i></p>

    ';
    return $footer;
}
