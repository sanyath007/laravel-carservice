<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
    <head>
        <title>ใบขออนุญาตใช้รถยนต์ส่วนกลาง</title>
        <meta content="MSHTML 6.00.2900.5726" name=GENERATOR>
        <meta http-equiv=Content-Type content="text/html; charset=utf-8">
        <link href="print_php_files/styles.css" type=text/css rel=stylesheet>
        
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
                    MARGIN: 0px; 
                    HEIGHT: 100%
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
        </style>
        
        <script language=JavaScript src="print_php_files/script.js"></script>
        <script language=JavaScript>
            // window.print();
        </script>
            
    </head>

    <body>
        <?php
        $tmp30 = 0;
        $tmp31 = 0;
        $tmp32 = 0;
        $tmp36 = 0;
        $tmp10 = 0;
        $tmpOth = 0;
        
        // Set connect db
        $db = new PDO("mysql:host=localhost; dbname=vehicle_db; charset=utf8", 'root', '1');
        $db->exec("set names utf8");
        $db->exec("COLLATE utf8_general_ci");

        $sql = "select * from changwat where chw_id IN (SELECT changwat from locations) ";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);            
        foreach ($row as $ch) {
        	echo $ch['chw_id']. '-' .$ch['changwat']. '<br>';
        }

        $sql = "select * from reservations where from_date BETWEEN '2017-10-01' AND '2018-09-21'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $r) {
            $loc_list = "";
            $locations = explode(',', $r['location']);

            // foreach ($locations as $l) {
                $sql = "select l.*, c.changwat as chwname, a.amphur as ampname, t.tambon as tamname
                        from locations l 
                        left join changwat c on (l.changwat=c.chw_id)
                        left join amphur a on (l.amphur=a.id)
                        left join tambon t on (l.tambon=t.id)
                        where (l.id=:id)";
                $stmt = $db->prepare($sql);
                // $stmt->bindValue(':id', $l);
                $stmt->bindValue(':id', $locations[0]);
                $stmt->execute();
                $loc = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($loc['changwat']=='30') {
                	$tmp30 = $tmp30 + 1;
                } else if ($loc['changwat']=='31') {
                	$tmp31 = $tmp31 + 1;
                } else if ($loc['changwat']=='32') {
                	$tmp32 = $tmp32 + 1;
                } else if ($loc['changwat']=='36') {
                	$tmp36 = $tmp36 + 1;
                } else if ($loc['changwat']=='10' || $loc['changwat']=='11' || $loc['changwat']=='12' || $loc['changwat']=='13') {
                	$tmp10 = $tmp10 + 1;
                } else {
                	$tmpOth = $tmpOth + 1;
                }
            // }
        }

        echo 'นครราชสีมา = '.$tmp30. '<br>';
        echo 'บุรีรัมย์ = '.$tmp31. '<br>';
        echo 'สุรินทร์ = '.$tmp32. '<br>';
        echo 'ชัยภูมิ = '.$tmp36. '<br>';
        echo 'กทม. = '.$tmp10. '<br>';
        echo 'อื่นๆ = '.$tmpOth;
    ?>
    </body>
</html>