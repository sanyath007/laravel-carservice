<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
    <head>
        <title>ใสรุปรายงานการใช้น้ำมันเชื้อเพลิง</title>
        <meta content="MSHTML 6.00.2900.5726" name="GENERATOR">
        <meta http-equiv=Content-Type content="text/html; charset=utf-8">
        <!-- <link href="print_php_files/styles.css" type="text/css" rel="stylesheet" media="screen"> -->

        <style type=text/css>
            body {
                PADDING-RIGHT: 0px; 
                PADDING-LEFT: 0px; 
                PADDING-BOTTOM: 0px; 
                MARGIN: 0px; 
                PADDING-TOP: 0px;
                background-color: #ffffff;
                height: 842px;
            }
            a:link {
                COLOR: #0000ff; 
                TEXT-DECORATION: none
            }
            a:visited {
                COLOR: #005ca2; 
                TEXT-DECORATION: none
            }
            a:active {
                COLOR: #0099ff; 
                TEXT-DECORATION: underline
            }
            a:hover {
                COLOR: #0099ff; 
                TEXT-DECORATION: underline
            }
            @media Print {
                div.page {
                    margin: 0px; 
                    height: 100%;
                    page-break-before: always;
                }

                body {
                    -webkit-print-color-adjust: exact;
                }
            }
            .UnderLine {
                FONT-WEIGHT: normal;
                MARGIN: 1px;
                COLOR: #0000ff;
                BORDER-TOP-STYLE: none;
                BORDER-BOTTOM: black 1px dotted;
                FONT-FAMILY: "TH SarabunPSK";
                BORDER-RIGHT-STYLE: none;
                BORDER-LEFT-STYLE: none;
                HEIGHT: 18px;
                TEXT-ALIGN: center
            }
            .UnderLineLeft {
                FONT-WEIGHT: normal; 
                MARGIN: 1px; 
                COLOR: #0000ff; 
                BORDER-TOP-STYLE: none; 
                BORDER-BOTTOM: black 1px dashed; 
                FONT-FAMILY: "TH SarabunPSK"; 
                BORDER-RIGHT-STYLE: none; 
                BORDER-LEFT-STYLE: none; 
                HEIGHT: 18px; 
                TEXT-ALIGN: left
            }
            .formthaitext {
                FONT-WEIGHT: bold; 
                FONT-SIZE: 15px; 
                COLOR: #000000; 
                FONT-FAMILY: "TH SarabunPSK";
            }
            .textform {
                FONT-SIZE: 11px; 
                COLOR: #000000; 
                FONT-FAMILY: Verdana
            }
            .thaitext {
                FONT-SIZE: 13px; 
                COLOR: #000000; 
                FONT-FAMILY: "TH SarabunPSK";
            }
            .thaitext_small {
                FONT-SIZE: 10px; 
                COLOR: #000000; 
                FONT-FAMILY: "TH SarabunPSK";
            }
            .headthaitext {
                FONT-SIZE: 15px; 
                COLOR: #000000; 
                FONT-FAMILY: "TH SarabunPSK";
            }
            .CordiaUPC {
                FONT-SIZE: 12px; 
                COLOR: #000000; 
                FONT-FAMILY: "TH SarabunPSK";
            }
            .buntuekkorkuam {
                font-size: 29pt; 
                color: #000000; 
                font-family: "TH SarabunPSK"; 
                font-weight:bold;  
                margin-left: -100px;
            }
            .txt-content {
                font-size: 16pt; 
                color: #000000; 
                font-family: "TH SarabunPSK";
            }
            .trh1 {
                height: 30px;
            }
            .trh0 {
                height: 5px;
            }
            p {
                font-size: 16pt; 
                color: #000000; 
                font-family: "TH SarabunPSK"; 
                font-weight: normal;
            }
            .p16 {
                font-size: 16pt; 
                color: #000000; 
                font-family: "TH SarabunPSK"; 
                font-weight: bold;
            }
            .p18 {
                font-size: 18pt; 
                color: #000000; 
                font-family: "TH SarabunPSK"; 
                font-weight: bold;
            }
            .p20 {
                font-size: 20pt; 
                color: #000000; 
                font-family: "TH SarabunPSK"; 
                font-weight: bold;
            }
            .formnumber {
                font-size: 11pt; 
                color: #000000; 
                font-family: "TH SarabunPSK"; 
                font-weight: bold;
                text-align: center;
                border: 1px solid #000000;
                padding: 0 5 0 5px;
            }
            .indent {
                margin-left: 94px;
            }
            .indent2 {
                margin-left: 30px;
            }
            .hasborder { border:1px solid #F00;  }
            .table {
                border: 1px solid #000000;
                border-collapse: collapse;
            }

            p.MsoNormal, li.MsoNormal, div.MsoNormal,span.MsoNormal {
                border-bottom: 1px dashed #000000;
                margin-top:0cm;
                margin-right:0cm;
                margin-bottom:10.0pt;
                margin-left:0cm;
                line-height:115%;
                font-size:16pt;
                font-family:"TH SarabunPSK";
            }
            .UnderlineTagp {
                border-bottom: 1px dashed #000000; 
                padding: 0px; 
                margin:0px;
                height: 20px
            }

            .datatable {
                border-collapse: collapse; 
                border: 1px solid black;
                font-family:"TH SarabunPSK";
                font-size:16pt;
            }
        </style>
        
        <script language=JavaScript src="print_php_files/script.js"></script>
        <script language=JavaScript>
            // window.print();
        </script>
            
    </head>

    <body>
        <?php
            // Set connect db
            $db = new PDO("mysql:host=localhost; dbname=vehicle_db; charset=utf8", 'root', '4621008811');
            $db->exec("set names utf8");
            $db->exec("COLLATE utf8_general_ci");
            
            // Set the PDO error mode to exception
            $sql = "select 
                    DATE_FORMAT(vf.bill_date,'%d') AS date,
                    DATE_FORMAT(vf.bill_date,'%m') AS month,
                    DATE_FORMAT(vf.bill_date,'%Y')+543 AS year, 
                    vf.id, vf.department, vf.vehicle_id, vf.fuel_type_id, vf.bill_no, vf.bill_date,  
                    vf.volume, vf.unit_price, vf.total, vf.job_desc, vf.remark, v.reg_no
                    FROM vehicle_fuel vf LEFT JOIN vehicles v ON (vf.vehicle_id=v.vehicle_id)
                    WHERE (vf.bill_date BETWEEN '" .$_GET['_month']. "-16' AND '" .$_GET['_month']. "-31') 
                    AND (vf.status NOT IN ('2','3'))
                    ORDER BY vf.bill_no";

            $stmt = $db->prepare($sql);
            // $stmt->bindValue(':id', $_GET['id']);

            try {
                $stmt->execute();
            } catch (PDOException $e) {
               echo $e->getMessage();
            }

            $vehicle_type = [
                '1' => 'รถกระบะ', 
                '2' => 'รถตู้ 12 ที่นั่ง', 
                '3' => 'รถพยาบาล'
            ];
            
            $_month = explode('-', $_GET['_month']);
        ?>
        <div class="page" align="center">
            <div style="width: 740px; margin-left: 30px; margin-right: 15px; margin-top: 0px; padding: 5px;">
                <div style="padding: 0 5 0 5px;">

<!--                    <table width="100%">
                        <tr>
                            <td width="527"></td>
                            <td>
                                <p align="right" class="formnumber">QF-ICT-45 <br> updated 20/10/2559</p>
                            </td>
                        </tr>
                    </table>-->

                    <table width="100%" border="0">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <b class="p20"><center>สรุปรายงานการใช้น้ำมันเชื้อเพลิง   รอบวันที่ 1-16 <?=thaimonth($_month[1]). ' ' .(((int)$_month[0]) + 543); ?>
                                    <br>งานยานพาหนะ  กลุ่มงานบริหารทั่วไป  โรงพยาบาลเทพรัตน์นครราชสีมา</center></b>
                                </td>
                            </tr>                            
                            <!-- <tr class="trh1">
                                <td width="80%">
                                    <p style="margin-left: 230px;">
                                        ประจำวันที่
                                        <?php echo (int)$fuel['date']; ?>  <?php echo thaimonth($fuel['month']); ?>  <?php echo $fuel['year']; ?>
                                    </p>
                                </td>
                                <td style="text-align: right;">
                                    <p>เลขที่ <?php echo $fuel['invoice_no'] ?> </p>
                                </td>
                            </tr> -->
                            
                            <!-- <tr class="trh1">
                                <td colspan="2">
                                    <p>
                                        <b class="p18">เรียน</b>&nbsp;&nbsp;ผู้อำนวยการโรงพยาบาลเทพรัตน์นครราชสีมา
                                    </p>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div><!-- /HEADER -->
                
                <div style="padding: 0 5 5 5px;"><!-- DETAIL -->
                    <table width="100%">
                        <tr>
                            <td>
                                
                                <table border="1" width="100%" class="datatable">
                                    <tr>
                                        <th style="width: 4%; text-align: center;">ลำดับ</th>
                                        <th style="width: 14%; text-align: center;">วันที่</th>
                                        <th style="width: 11%; text-align: center;">ทะเบียนรถ</th>
                                        <th style="width: 12%; text-align: center;">เลขบิล</th>
                                        <th style="width: 10%; text-align: center;">จำนวนลิตร</th>
                                        <th style="width: 10%; text-align: center;">ราคา/ลิตร</th>
                                        <th style="width: 12%; text-align: center;">ราคารวม</th>
                                        <th style="text-align: center;">งานที่ปฏิบัติ</th>
                                        <!-- <th>หมายเหตุ</th> -->
                                    </tr>
                                    <?php 
                                        $cx = 0;
                                        $tmpVolume = 0;
                                        $tmpUnitPrice = 0;
                                        $tmpTotal = 0;
                                        $fuels = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($fuels as $fuel) :
                                            if ($fuel['department'] == 1) :
                                                $tmpVolume += (float)$fuel['volume'];
                                                $tmpUnitPrice += (float)$fuel['unit_price'];
                                                $tmpTotal += (float)$fuel['total'];  
                                                // Set the PDO error mode to exception
                                                // $sql = "select * from sentout_daily_detail 
                                                //         where (sentout_daily_id=:fuelid) 
                                                //         and (sentout_type_id=:sentouttypeid) ";

                                                // $stmt = $db->prepare($sql);
                                                // $stmt->bindValue(':fuelid', $fuel['id']);
                                                // $stmt->bindValue(':sentouttypeid', $sentoutType['sentout_type_id']);
                                                // $stmt->execute();
                                                // $detail = $stmt->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                            <tr>
                                                <td style="text-align: center;"><?=++$cx ?></td>
                                                <td style="text-align: center;"><?=$fuel['bill_date'] ?></td>
                                                <td style="text-align: center;">
                                                    <?=$fuel['reg_no'] ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?=$fuel['bill_no'] ?>
                                                </td>
                                                <td style="text-align: center;"><?=$fuel['volume'] ?></td>
                                                <td style="text-align: center;"><?=$fuel['unit_price'] ?></td>
                                                <td style="text-align: center;"><?=number_format($fuel['total'],2) ?></td>
                                                <td style="padding: 2px;"><?=$fuel['job_desc'] ?></td>
                                            </tr>

                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <tr>
                                        <td style="text-align: center;" colspan="4">รวม</td>
                                        <td style="text-align: center;"><?=number_format($tmpVolume,2) ?></td>
                                        <td style="text-align: center;"><?=number_format($tmpUnitPrice,2) ?></td>
                                        <td style="text-align: center;"><?=number_format($tmpTotal,2) ?></td>
                                        <td style="background-color: #848484 !important;" colspan="2"></td>
                                    </tr>

                                </table>
                                         
                            </td>
                        </tr>               
                    </table><br>

                    <table width="100%" border="0">
                        <tbody>
                            <tr>
                                <td width="50%" style="vertical-align: top;">
                                    <p style="margin: 5 0 0 15px; padding: 2px; font-weight: bold;">
                                        พนักงานขับรถยนต์
                                    </p>
                                    <p style="margin: 5 0 0 15px; padding: 2px;">
                                        ลงชื่อ............................  ลงชื่อ............................
                                    </p>
                                    <p style="margin: 5 0 0 15px; padding: 2px;">
                                        ลงชื่อ............................  ลงชื่อ............................
                                    </p>
                                    <p style="margin: 5 0 0 15px; padding: 2px;">
                                        ลงชื่อ............................  ลงชื่อ............................
                                    </p>
                                    <p style="margin: 5 0 0 15px; padding: 2px;">
                                        ลงชื่อ............................  ลงชื่อ............................
                                    </p>                                               
                                </td>
                                <td width="50%" style="vertical-align: top;">
                                    <p style="margin: 5 0 0 15px; padding: 2px; font-weight: bold;">
                                        &nbsp;
                                    </p>
                                    <p style="margin: 5 0 0 40px; padding: 0px;">
                                        ลงชื่อ.....................................................ผู้จัดทำ
                                    </p>
                                    <p style="margin: -3 2 2 -5px; padding: 0px; text-align: center;">
                                        (&nbsp;&nbsp;&nbsp;นางวิภา&nbsp;&nbsp;พยอมใหม่&nbsp;&nbsp;&nbsp;)
                                    </p>
                                    <p style="margin: -3 2 2 105px; padding: 0px;">
                                        เจ้าพนักงานธุรการ
                                    </p><br>

                                    <p style="margin: 5 0 0 40px; padding: 0px;">
                                        ลงชื่อ.....................................................ผู้ตรวจสอบ
                                    </p>
                                    <p style="margin: -3 2 2 0px; padding: 0px; text-align: center;">
                                        (&nbsp;&nbsp;&nbsp;นายสัญญา&nbsp;&nbsp;ธรรมวงษ์&nbsp;&nbsp;&nbsp;)
                                    </p>
                                    <p style="margin: -3 2 2 75px; padding: 0px;">
                                        นักจัดการงานทั่วไปปฏิบัติการ
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table><br>                    
                
                </div><!-- /DETAIL -->

            </div> <!-- end page -->
        </div>  <!-- end page -->

        <!-- วัดบูรพ์ -->
        <div class="page" align="center">
            <div style="width: 740px; margin-left: 30px; margin-right: 15px; margin-top: 0px; padding: 5px;">
                <div style="padding: 0 5 0 5px;">

<!--                    <table width="100%">
                        <tr>
                            <td width="527"></td>
                            <td>
                                <p align="right" class="formnumber">QF-ICT-45 <br> updated 20/10/2559</p>
                            </td>
                        </tr>
                    </table>-->

                    <table width="100%" border="0">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <b class="p20"><center>สรุปรายงานการใช้น้ำมันเชื้อเพลิง   รอบวันที่ 1-16 <?=thaimonth($_month[1]). ' ' .(((int)$_month[0]) + 543); ?>
                                    <br>ศูนย์สุขภาพชุมชนเมือง 3 วัดบูรพ์  โรงพยาบาลเทพรัตน์นครราชสีมา</center></b>
                                </td>
                            </tr>                            
                            <!-- <tr class="trh1">
                                <td width="80%">
                                    <p style="margin-left: 230px;">
                                        ประจำวันที่
                                        <?php echo (int)$fuel['date']; ?>  <?php echo thaimonth($fuel['month']); ?>  <?php echo $fuel['year']; ?>
                                    </p>
                                </td>
                                <td style="text-align: right;">
                                    <p>เลขที่ <?php echo $fuel['invoice_no'] ?> </p>
                                </td>
                            </tr> -->
                            
                            <!-- <tr class="trh1">
                                <td colspan="2">
                                    <p>
                                        <b class="p18">เรียน</b>&nbsp;&nbsp;ผู้อำนวยการโรงพยาบาลเทพรัตน์นครราชสีมา
                                    </p>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div><!-- /HEADER -->
                
                <div style="padding: 0 5 5 5px;"><!-- DETAIL -->
                    <table width="100%">
                        <tr>
                            <td>
                                
                                <table border="1" width="100%" class="datatable">
                                    <tr>
                                        <th style="width: 4%; text-align: center;">ลำดับ</th>
                                        <th style="width: 14%; text-align: center;">วันที่</th>
                                        <th style="width: 11%; text-align: center;">ทะเบียนรถ</th>
                                        <th style="width: 12%; text-align: center;">เลขบิล</th>
                                        <th style="width: 10%; text-align: center;">จำนวนลิตร</th>
                                        <th style="width: 10%; text-align: center;">ราคา/ลิตร</th>
                                        <th style="width: 12%; text-align: center;">ราคารวม</th>
                                        <th style="text-align: center;">งานที่ปฏิบัติ</th>
                                        <!-- <th>หมายเหตุ</th> -->
                                    </tr>
                                    <?php 
                                        $cx = 0;
                                        $tmpVolume = 0;
                                        $tmpUnitPrice = 0;
                                        $tmpTotal = 0;
                                        foreach ($fuels as $fuel) :
                                            if ($fuel['department'] == 2) :
                                                $tmpVolume += (float)$fuel['volume'];
                                                $tmpUnitPrice += (float)$fuel['unit_price'];
                                                $tmpTotal += (float)$fuel['total'];
                                    ?>
                                                <tr>
                                                    <td style="text-align: center;"><?=++$cx ?></td>
                                                    <td style="text-align: center;"><?=$fuel['bill_date'] ?></td>
                                                    <td style="text-align: center;">
                                                        <?=$fuel['reg_no'] ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?=$fuel['bill_no'] ?>
                                                    </td>
                                                    <td style="text-align: center;"><?=$fuel['volume'] ?></td>
                                                    <td style="text-align: center;"><?=$fuel['unit_price'] ?></td>
                                                    <td style="text-align: center;"><?=number_format($fuel['total'],2) ?></td>
                                                    <td style="padding: 2px;"><?=$fuel['job_desc'] ?></td>
                                                </tr>

                                            <?php endif ?>
                                    <?php endforeach; ?>

                                    <tr>
                                        <td style="text-align: center;" colspan="4">รวม</td>
                                        <td style="text-align: center;"><?=number_format($tmpVolume,2) ?></td>
                                        <td style="text-align: center;"><?=number_format($tmpUnitPrice,2) ?></td>
                                        <td style="text-align: center;"><?=number_format($tmpTotal,2) ?></td>
                                        <td style="background-color: #848484 !important;" colspan="2"></td>
                                    </tr>

                                </table>
                                         
                            </td>
                        </tr>               
                    </table><br>

                    <table width="100%" border="0">
                        <tbody>
                            <tr>
                                <td width="50%" style="vertical-align: top;">
                                    <p style="margin: 5 0 0 15px; padding: 2px; font-weight: bold;">
                                        พนักงานขับรถยนต์
                                    </p>
                                    <p style="margin: 5 0 0 40px; padding: 0px;">
                                        ลงชื่อ.....................................................ผู้จัดทำ
                                    </p>
                                    <p style="margin: -3 2 2 -35px; padding: 0px; text-align: center;">
                                        (&nbsp;&nbsp;&nbsp;นายสมควร&nbsp;&nbsp;ปวงกลาง&nbsp;&nbsp;&nbsp;)
                                    </p>
                                    <p style="margin: -3 2 2 105px; padding: 0px;">
                                        พนักงานขับรถยนต์
                                    </p><br>                                           
                                </td>
                                <td width="50%" style="vertical-align: top;">
                                    <p style="margin: 5 0 0 15px; padding: 2px; font-weight: bold;">
                                        &nbsp;
                                    </p>
                                    <p style="margin: 5 0 0 40px; padding: 0px;">
                                        ลงชื่อ.....................................................ผู้จัดทำ
                                    </p>
                                    <p style="margin: -3 2 2 -5px; padding: 0px; text-align: center;">
                                        (&nbsp;&nbsp;&nbsp;นางวิภา&nbsp;&nbsp;พยอมใหม่&nbsp;&nbsp;&nbsp;)
                                    </p>
                                    <p style="margin: -3 2 2 105px; padding: 0px;">
                                        เจ้าพนักงานธุรการ
                                    </p><br>

                                    <p style="margin: 5 0 0 40px; padding: 0px;">
                                        ลงชื่อ.....................................................ผู้ตรวจสอบ
                                    </p>
                                    <p style="margin: -3 2 2 0px; padding: 0px; text-align: center;">
                                        (&nbsp;&nbsp;&nbsp;นายสัญญา&nbsp;&nbsp;ธรรมวงษ์&nbsp;&nbsp;&nbsp;)
                                    </p>
                                    <p style="margin: -3 2 2 75px; padding: 0px;">
                                        นักจัดการงานทั่วไปปฏิบัติการ
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table><br>                    
                
                </div><!-- /DETAIL -->

            </div> <!-- end page -->
        </div>  <!-- end page -->

        <!-- ราชภัฎ -->
        <div class="page" align="center">
            <div style="width: 740px; margin-left: 30px; margin-right: 15px; margin-top: 0px; padding: 5px;">
                <div style="padding: 0 5 0 5px;">

<!--                    <table width="100%">
                        <tr>
                            <td width="527"></td>
                            <td>
                                <p align="right" class="formnumber">QF-ICT-45 <br> updated 20/10/2559</p>
                            </td>
                        </tr>
                    </table>-->

                    <table width="100%" border="0">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <b class="p20"><center>สรุปรายงานการใช้น้ำมันเชื้อเพลิง   รอบวันที่ 1-16 <?=thaimonth($_month[1]). ' ' .(((int)$_month[0]) + 543); ?>
                                    <br>ศูนย์สุขภาพชุมชนเมือง 9 ราชภัฎ  โรงพยาบาลเทพรัตน์นครราชสีมา</center></b>
                                </td>
                            </tr>                            
                            <!-- <tr class="trh1">
                                <td width="80%">
                                    <p style="margin-left: 230px;">
                                        ประจำวันที่
                                        <?php echo (int)$fuel['date']; ?>  <?php echo thaimonth($fuel['month']); ?>  <?php echo $fuel['year']; ?>
                                    </p>
                                </td>
                                <td style="text-align: right;">
                                    <p>เลขที่ <?php echo $fuel['invoice_no'] ?> </p>
                                </td>
                            </tr> -->
                            
                            <!-- <tr class="trh1">
                                <td colspan="2">
                                    <p>
                                        <b class="p18">เรียน</b>&nbsp;&nbsp;ผู้อำนวยการโรงพยาบาลเทพรัตน์นครราชสีมา
                                    </p>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div><!-- /HEADER -->
                
                <div style="padding: 0 5 5 5px;"><!-- DETAIL -->
                    <table width="100%">
                        <tr>
                            <td>
                                
                                <table border="1" width="100%" class="datatable">
                                    <tr>
                                        <th style="width: 4%; text-align: center;">ลำดับ</th>
                                        <th style="width: 14%; text-align: center;">วันที่</th>
                                        <th style="width: 11%; text-align: center;">ทะเบียนรถ</th>
                                        <th style="width: 12%; text-align: center;">เลขบิล</th>
                                        <th style="width: 10%; text-align: center;">จำนวนลิตร</th>
                                        <th style="width: 10%; text-align: center;">ราคา/ลิตร</th>
                                        <th style="width: 12%; text-align: center;">ราคารวม</th>
                                        <th style="text-align: center;">งานที่ปฏิบัติ</th>
                                        <!-- <th>หมายเหตุ</th> -->
                                    </tr>
                                    <?php 
                                        $cx = 0;
                                        $tmpVolume = 0;
                                        $tmpUnitPrice = 0;
                                        $tmpTotal = 0;
                                        foreach ($fuels as $fuel) :
                                            if ($fuel['department'] == 3) :
                                                $tmpVolume += (float)$fuel['volume'];
                                                $tmpUnitPrice += (float)$fuel['unit_price'];
                                                $tmpTotal += (float)$fuel['total'];
                                    ?>
                                                <tr>
                                                    <td style="text-align: center;"><?=++$cx ?></td>
                                                    <td style="text-align: center;"><?=$fuel['bill_date'] ?></td>
                                                    <td style="text-align: center;">
                                                        <?=$fuel['reg_no'] ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?=$fuel['bill_no'] ?>
                                                    </td>
                                                    <td style="text-align: center;"><?=$fuel['volume'] ?></td>
                                                    <td style="text-align: center;"><?=$fuel['unit_price'] ?></td>
                                                    <td style="text-align: center;"><?=number_format($fuel['total'],2) ?></td>
                                                    <td style="padding: 2px;"><?=$fuel['job_desc'] ?></td>
                                                </tr>

                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <tr>
                                        <td style="text-align: center;" colspan="4">รวม</td>
                                        <td style="text-align: center;"><?=number_format($tmpVolume,2) ?></td>
                                        <td style="text-align: center;"><?=number_format($tmpUnitPrice,2) ?></td>
                                        <td style="text-align: center;"><?=number_format($tmpTotal,2) ?></td>
                                        <td style="background-color: #848484 !important;" colspan="2"></td>
                                    </tr>

                                </table>
                                         
                            </td>
                        </tr>               
                    </table><br>

                    <table width="100%" border="0">
                        <tbody>
                            <tr>
                                <td width="50%" style="vertical-align: top;">
                                    <p style="margin: 5 0 0 15px; padding: 2px; font-weight: bold;">
                                        พนักงานขับรถยนต์
                                    </p>
                                    <p style="margin: 5 0 0 40px; padding: 0px;">
                                        ลงชื่อ.....................................................ผู้จัดทำ
                                    </p>
                                    <p style="margin: -3 2 2 -35px; padding: 0px; text-align: center;">
                                        (&nbsp;&nbsp;&nbsp;นางสิรินทร&nbsp;&nbsp;พิเศษพงษา&nbsp;&nbsp;&nbsp;)
                                    </p>
                                    <p style="margin: -3 2 2 50px; padding: 0px;">
                                        เจ้าพนักงานทันตสาธารณสุขชำนาญงาน
                                    </p><br>                                           
                                </td>
                                <td width="50%" style="vertical-align: top;">
                                    <p style="margin: 5 0 0 15px; padding: 2px; font-weight: bold;">
                                        &nbsp;
                                    </p>
                                    <p style="margin: 5 0 0 40px; padding: 0px;">
                                        ลงชื่อ.....................................................ผู้จัดทำ
                                    </p>
                                    <p style="margin: -3 2 2 -5px; padding: 0px; text-align: center;">
                                        (&nbsp;&nbsp;&nbsp;นางวิภา&nbsp;&nbsp;พยอมใหม่&nbsp;&nbsp;&nbsp;)
                                    </p>
                                    <p style="margin: -3 2 2 105px; padding: 0px;">
                                        เจ้าพนักงานธุรการ
                                    </p><br>

                                    <p style="margin: 5 0 0 40px; padding: 0px;">
                                        ลงชื่อ.....................................................ผู้ตรวจสอบ
                                    </p>
                                    <p style="margin: -3 2 2 0px; padding: 0px; text-align: center;">
                                        (&nbsp;&nbsp;&nbsp;นายสัญญา&nbsp;&nbsp;ธรรมวงษ์&nbsp;&nbsp;&nbsp;)
                                    </p>
                                    <p style="margin: -3 2 2 75px; padding: 0px;">
                                        นักจัดการงานทั่วไปปฏิบัติการ
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table><br>                    
                
                </div><!-- /DETAIL -->

            </div> <!-- end page -->
        </div>  <!-- end page -->
        <?php
        function thainumDigit($num) {
            return str_replace(
                    array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), 
                    array("๐", "๑", "๒", "๓", "๔", "๕", "๖", "๗", "๘", "๙"), 
                    $num
            );
        }

        function thaimonth($monthparam) {
            switch ($monthparam) {
                case 1:
                    $month = 'มกราคม';
                    return $month;
                    break;
                case 2:
                    $month = 'กุมภาพันธ์';
                    return $month;
                    break;
                case 3:
                    $month = 'มีนาคม';
                    return $month;
                    break;
                case 4:
                    $month = 'เมษายน';
                    return $month;
                    break;
                case 5:
                    $month = 'พฤษภาคม';
                    return $month;
                    break;
                case 6:
                    $month = 'มิถุนายน';
                    return $month;
                    break;
                case 7:
                    $month = 'กรกฎาคม';
                    return $month;
                    break;
                case 8:
                    $month = 'สิงหาคม';
                    return $month;
                    break;
                case 9:
                    $month = 'กันยายน';
                    return $month;
                    break;
                case 10:
                    $month = 'ตุลาคม';
                    return $month;
                    break;
                case 11:
                    $month = 'พฤศจิกายน';
                    return $month;
                    break;
                case 12:
                    $month = 'ธันวาคม';
                    return $month;
                    break;
            }
        }
        ?>

    </body>
</html>