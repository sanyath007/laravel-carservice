<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0032)http://job2.ocsc.go.th/print.php -->
<HTML>
<HEAD>
	<TITLE></TITLE>
	<META content="MSHTML 6.00.2900.5726" name=GENERATOR>
	<META http-equiv=Content-Type content="text/html; charset=windows-874">
	<LINK href="print_php_files/styles.css" type=text/css rel=stylesheet>

	<SCRIPT language=JavaScript src="print_php_files/script.js"></SCRIPT>

	<SCRIPT language=JavaScript src="print_php_files/script.js"></SCRIPT>

	<STYLE type=text/css>
		BODY {
			PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; PADDING-TOP: 0px
		}
		A:link {
			COLOR: #0000ff; TEXT-DECORATION: none
		}
		A:visited {
			COLOR: #005ca2; TEXT-DECORATION: none
		}
		A:active {
			COLOR: #0099ff; TEXT-DECORATION: underline
		}
		A:hover {
			COLOR: #0099ff; TEXT-DECORATION: underline
		}
	
		@media Print {
			DIV.page {
				MARGIN: 0px; HEIGHT: 100%
			}
		}
		.UnderLine {
			FONT-WEIGHT: normal; MARGIN: 1px; COLOR: #0000ff; BORDER-TOP-STYLE: none; BORDER-BOTTOM: black 1px dashed; FONT-FAMILY: "MS Sans Serif", "Microsoft Sans Serif", Tahoma; BORDER-RIGHT-STYLE: none; BORDER-LEFT-STYLE: none; HEIGHT: 18px; TEXT-ALIGN: center
		}
		.UnderLineLeft {
			FONT-WEIGHT: normal; MARGIN: 1px; COLOR: #0000ff; BORDER-TOP-STYLE: none; BORDER-BOTTOM: black 1px dashed; FONT-FAMILY: "MS Sans Serif", "Microsoft Sans Serif", Tahoma; BORDER-RIGHT-STYLE: none; BORDER-LEFT-STYLE: none; HEIGHT: 18px; TEXT-ALIGN: left
		}
		.formthaitext {
			FONT-WEIGHT: bold; FONT-SIZE: 15px; COLOR: #000000; FONT-FAMILY: "MS Sans Serif", "Microsoft Sans Serif", Tahoma
		}
		.textform {
			FONT-SIZE: 11px; COLOR: #000000; FONT-FAMILY: Verdana
		}
		.thaitext {
			FONT-SIZE: 13px; COLOR: #000000; FONT-FAMILY: "MS Sans Serif", "Microsoft Sans Serif", Tahoma
		}
		.thaitext_small {
			FONT-SIZE: 10px; COLOR: #000000; FONT-FAMILY: "MS Sans Serif", "Microsoft Sans Serif", Tahoma
		}
		.headthaitext {
			FONT-SIZE: 15px; COLOR: #000000; FONT-FAMILY: "MS Sans Serif", "Microsoft Sans Serif", Tahoma
		}
		.CordiaUPC {
			FONT-SIZE: 12px; COLOR: #000000; FONT-FAMILY: CordiaUPC
		}
		table{
			height: 1000px;
			border: 30px #000 solid;
		}
	</STYLE>
</HEAD>

<BODY bgColor=#ffffff>
<?php
   include('../class/class_database.php');
        $obj = new database();
    	$obj->connect();
?>

<?php
        $obj->sql =  " ";
        //$sql = $obj->sql;
        //echo $sql;
        //$row = $obj->execute();
        //$rs = mysql_fetch_array($row);
?>

<DIV class=page align=center>
	<div style="width: 660px; margin-left: 30px; margin-right: 15px; margin-top: 20px; padding: 5px;">
      	
		<div style="padding: 5px;"><!-- HEADER -->
			<TABLE width="100%" border=0>
				<TBODY>
					<TR>
						<TD class=thaitext vAlign=top width="100">วันที่รับ<SPAN class=UnderLine> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </SPAN></TD>
						<TD class=thaitext vAlign=center align=right width=400>&nbsp;</TD>
						<TD align=middle height=30><SPAN style="border: #000 solid 2px; padding: 2px;">&nbsp;<SPAN class=formthaitext>QF-ICT- 03</SPAN>&nbsp;</SPAN></TD>
					</TR>
					<TR>
						<TD class=thaitext vAlign=center align=middle height="30" colspan="3">
							<h3>แบบฟอร์มขอลงทะเบียนในระบบโปรแกรม HOSxP</h3>
							<h3>โรงพยาบาลเทพรัตน์นครราชสีมา</h3>
						</TD>
					</TR>

					<TR>
						<TD vAlign=top><B>เรื่อง&nbsp;&nbsp;&nbsp;&nbsp;ขอลงทะเบียนในระบบโปรแกรม HOSxP</B></TD>
					</TR>
							
					<TR>
						<TD vAlign=top><B>เรียน&nbsp;&nbsp;&nbsp;&nbsp;หัวหน้ากลุ่มงานสารสนเทศทางการแพทย์</B></TD>
					</TR>
				</TBODY>
			</TABLE>
		</div><!-- /HEADER -->
		
		<div style="padding: 5px;"><!-- DETAIL -->
			<TABLE class=thaitext cellSpacing=2 cellPadding=5 width="100%" border=0>
				<TBODY>
					<TR>
						<TD vAlign=top>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วยข้าพเจ้า <SPAN class=UnderLine> &nbsp;&nbsp; <?=$rs['prefix_name'];?><?=$rs['person_firstname'];?> &nbsp;&nbsp; <?=$rs['person_lastname'];?>  &nbsp;&nbsp; </SPAN> มีความประสงค์จะลงทะเบียนในระบบโปรแกรม HOSxP จึงขอแจ้งรายละเอียดของข้าพเจ้าเพื่อประกอบดำเนินการดังต่อไปนี้ 
						</TD>
					</TR>
				</TBODY>
			</TABLE>
		
			<TABLE cellSpacing=2 cellPadding=5 width="100%" border=0>
				<TBODY>
					<TR>
						<TD class=thaitext vAlign=top bgColor=#ffffff>ชื่อ-นามสกุล<SPAN class=UnderLine> &nbsp;&nbsp; <?=$rs['prefix_name'];?><?=$rs['person_firstname'];?> &nbsp;&nbsp; <?=$rs['person_lastname'];?> &nbsp;&nbsp; </SPAN>&nbsp;&nbsp;เพศ <SPAN class=UnderLine>&nbsp; &nbsp; <?=$rs['sex_name'];?> &nbsp;&nbsp; </SPAN> เกิดวันที่<SPAN class=UnderLine> &nbsp; <?=$rs['birthdate'];?> &nbsp;</SPAN><BR></TD>
					</TR>
					<TR>
						<TD class=thaitext vAlign=top bgColor=white>เลขประจำตัวประชาชน <SPAN class=UnderLine>&nbsp;&nbsp; <?=$rs['person_id'];?> &nbsp;&nbsp;&nbsp;</SPAN> วันที่เริ่มปฏิบัติงาน<SPAN class=UnderLine> &nbsp; <?=$rs['signin_date'];?> &nbsp;</SPAN>ประเภท<SPAN class=UnderLine> &nbsp; <?=$rs['typeposition_name'];?> &nbsp;</SPAN><BR></TD>
					</TR>
					<TR>
						<TD class=thaitext vAlign=top width="95%" bgColor=white>ตำแหน่ง <SPAN class=UnderLine>&nbsp;&nbsp;<?=$rs['position_name'].' '.$rs['pos_level'];?> &nbsp;</SPAN>&nbsp;&nbsp; สังกัดกลุ่มงาน <SPAN class=UnderLine>&nbsp; <?=$rs['ward_name'];?> &nbsp;</SPAN><BR></TD>
					</TR>
					<TR>
						<TD class=thaitext vAlign=top width="95%" bgColor=white>โทรศัพท์ภายใน <SPAN class=UnderLine>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</SPAN> โทรศัพท์ติดต่อ <SPAN class=UnderLine>&nbsp;&nbsp; <?=$rs['person_tel'];?> &nbsp;&nbsp;</SPAN> E-mail<SPAN class=UnderLine> &nbsp;&nbsp; <?=$rs['person_email'];?> &nbsp;&nbsp;</SPAN></TD>
					</TR>
					<?php
						$hos = new db();
						$hos->connect();
						$hos->sql="select licenseno from doctor where cid = '".$_GET['cid']."' ";
						$row_hos = $hos->execute();
						$rs_hos = mysql_fetch_assoc($row_hos);
					?>
					<TR>
						<TD class=thaitext vAlign=top width="95%" bgColor=white>
							เลขที่ใบประกอบวิชาชีพ <SPAN class=UnderLine>
							<?php if($rs_hos['licenseno'] <> ""){ ?>
							&nbsp;&nbsp;<?php echo $rs_hos['licenseno'];?>&nbsp;&nbsp;
							<?php } else {?>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?php } ?>
							</SPAN>
							รหัสสภาวิชาชีพ <SPAN class=UnderLine>
							<?php if($rs_hos['council_code'] <> ""){ ?>
							&nbsp;&nbsp;<?php echo $rs_hos['council_code'];?>&nbsp;&nbsp;
							<?php } else {?>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?php } ?>
							</SPAN>
							ชื่อผู้ใช้งาน <SPAN class=UnderLine>&nbsp;&nbsp;<?=$rs['person_username'];?>&nbsp;&nbsp;</SPAN>
						</TD>
					</TR>
				</TBODY>
			</TABLE>
			<BR>
			<TABLE cellSpacing=2 cellPadding=5 width="100%" border=0>
				<TBODY>
					<TR>
						<TD class=thaitext vAlign=top bgColor=#ffffff>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้าขอให้คำรับรองว่า 
		  	ข้อความดังกล่าวข้างต้นนี้เป็นความจริงทุกประการ<BR></TD>
					</TR>
				</TBODY>
			</TABLE>
		</div><!-- /DETAIL -->
		
		<div class=thaitext><!-- FOOTER -->
			<div style="padding: 10px; height: 70px;">
			<TABLE class=thaitext  cellSpacing=2 cellPadding=5 width="100%" align=right border=0>
				<TBODY>
					<TR>
						<TD align=middle width="40%">&nbsp;</TD>
						<TD width="60%">
							<p style="margin: 2px; padding: 2px;">ลงชื่อ.................................................. ผู้ขอลงทะเบียน </p>
							<p style="margin: 2px; padding: 2px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<SPAN class=UnderLine> &nbsp;&nbsp; <?=$rs['prefix_name'];?><?=$rs['person_firstname'];?> &nbsp;&nbsp; <?=$rs['person_lastname'];?> &nbsp;&nbsp; </SPAN>) </p>
							<p style="margin: 2px; padding: 2px;">วันที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<SPAN class=UnderLine>&nbsp;&nbsp;<?=date('d'); ?>&nbsp; / &nbsp; <?=date('m'); ?>&nbsp; / &nbsp; <?=date('Y') + 543; ?> &nbsp;</SPAN></p>
						</TD>
					</TR>
				</TBODY>
			</TABLE>
			</div>
			
			<div style="padding: 10px; height: 70px;">
			<TABLE class=thaitext  cellSpacing=2 cellPadding=5 width="100%" align=right border=0>
				<TBODY>
					<TR>
						<TD align=middle width="40%">&nbsp;</TD>
						<TD width="60%">
							<p style="margin: 2px; padding: 2px;">ลงชื่อ.................................................. หัวหน้ากลุ่มงาน</p>
							<p style="margin: 2px; padding: 2px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( .................................................. )</p>
							<p style="margin: 2px; padding: 2px;">ตำแหน่ง ..................................................</p>
						</TD>
					</TR>
				</TBODY>
			</TABLE>
			</div>
			
			<div style="padding: 0px; margin: 10px; height: 180px; border: #000 solid 2px;">
				<div style="margin: 0px; padding: 0px;"><h4>(สำหรับเจ้าหน้าที่ IT)</h4></div>
				
				<TABLE class="thaitext"  cellSpacing=2 cellPadding=5 width="100%" align="right" border="0">
					<TBODY>
						<TR>
							<TD width="60%">
								<p style="margin: 2px; padding: 2px;">ลงชื่อ.................................................. ผู้ดำเนินการ </p>
								<p style="margin: 2px; padding: 2px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( .................................................. ) </p>
								<p style="margin: 2px; padding: 2px;">ตำแหน่ง <SPAN class=UnderLine>&nbsp;&nbsp;&nbsp;&nbsp;นักวิชาการคอมพิวเตอร์&nbsp;&nbsp;&nbsp;&nbsp;</SPAN></p>
								<p style="margin: 2px; padding: 2px;">วันที่.................................................. </p>
							</TD>
							<TD width="40%">
								<p style="margin: 2px; padding: 2px;">ลงชื่อ.................................................. </p>
								<p style="margin: 2px; padding: 2px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<SPAN class=UnderLine>&nbsp; นาย สัญญา &nbsp;&nbsp; ธรรมวงษ์&nbsp;</SPAN>)</p>
								<p style="margin: 2px; padding: 2px;">ตำแหน่ง <SPAN class=UnderLine>&nbsp;นักจัดการงานทั่วไปปฏิบัติการ&nbsp;</SPAN></p>
								<p style="margin: 2px; padding: 2px;">วันที่.................................................. </p>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
			
		</div><!-- /FOOTER -->
		
		<div>
			<TABLE class=thaitext cellSpacing=0 cellPadding=5 width="100%" border=0>
				<TBODY>
					<TR>
						<TD vAlign=top align=middle>
							<INPUT class=thaitext id=submit2 onclick=javascript:window.print(); type=submit value=&nbsp;พิมพ์&nbsp; name=submit3>&nbsp;&nbsp;&nbsp; 
							<!--<INPUT class=thaitext id=submit2 onClick="javascript:document.execCommand('SaveAs','1','form_5002241');" type=submit value=&nbsp;บันทึก&nbsp; name=submit3>&nbsp;&nbsp;&nbsp;-->
							<INPUT class=thaitext onClick="location.href='index.php';" type=button value=กลับหน้าหลัก name=button> 
						</TD>
					</TR>
				</TBODY>
			</TABLE>
		</div>
	</div>	
</DIV>

<!--<DIV class=page align=center>
<TABLE class=thaitext cellSpacing=5 cellPadding=0 width=660 border=0>
	<TBODY>
  	<TR>
    	<TD vAlign=top>
	
      		<TABLE class=thaitext cellSpacing=0 cellPadding=5 width="100%" border=0>
        		<TBODY>
        		<TR>
          			<TD class=formthaitext align=middle height=65>เลขประจำตัวสอบจะประกอบไปด้วยเลข 9 หลัก โดยผู้ที่สมัคร</TD>
				</TR>
        		<TR>
          			<TD vAlign=top>
		  
						<TABLE class=thaitext cellSpacing=0 cellPadding=1 width="100%" border=0>
					  		<TBODY>
					  		<TR>
								<TD width="9%">หน่วยที่ 1</TD>
								<TD width="43%">ตำแหน่งนิติกรปฏิบัติการ</TD>
								<TD width="48%">เลขประจำตัวสอบจะขึ้นต้นด้วย 152_ _ _ _ _ _</TD>
					  		</TR>
					  		<TR>
								<TD>หน่วยที่ 2</TD>
								<TD>ตำแหน่งเศรษฐกรปฏิบัติการ</TD>
								<TD>เลขประจำตัวสอบจะขึ้นต้นด้วย 252_ _ _ _ _ _</TD>
							</TR>
					  		<TR>
								<TD>หน่วยที่ 3</TD>
								<TD>ตำแหน่งนักวิเคราะห์นโยบายและแผนปฏิบัติการ</TD>
								<TD>เลขประจำตัวสอบจะขึ้นต้นด้วย 352_ _ _ _ _ _</TD>
							</TR>
					  		<TR>
								<TD>หน่วยที่ 4</TD>
								<TD>ตำแหน่งนักวิชาการเงินและบัญชีปฏิบัติการ</TD>
								<TD>เลขประจำตัวสอบจะขึ้นต้นด้วย 452_ _ _ _ _ _</TD>
							</TR>
					  		<TR>
								<TD>หน่วยที่ 5 </TD>
								<TD>ตำแหน่งนักวิชาการคอมพิวเตอร์ปฏิบัติการ</TD>
								<TD>เลขประจำตัวสอบจะขึ้นต้นด้วย 552_ _ _ _ _ _</TD>
							</TR>
							</TBODY>
						</TABLE>
			
            			<P><BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้สมัครที่ชำระค่าธรรมเนียมสอบแล้วสามารถเข้าไปตรวจสอบเลขประจำตัวสอบได้หลังจากที่ชำระเงินไปแล้ว 7 วันทำการ โดยเข้าไปที่เว็บไซต์ http://job2.ocsc.go.th หัวข้อ <B>“รับสมัครสอบ หัวข้อย่อยตรวจสอบเลขประจำตัวสอบ”</B>เมื่อได้รับเลขประจำตัวสอบแล้วให้ตรวจสอบความถูกต้องของเลขประจำตัวสอบ ถ้าเลขประจำตัวสอบที่ได้รับถูกต้องให้พิมพ์ใบสมัครลงในกระดาษ A4 แล้วยื่นใบสมัครพร้อมหลักฐานอื่นตามที่กำหนดในข้อ 9 ให้สำนักงาน ก.พ. ในวันสอบภาคความเหมาะสมกับตำแหน่ง สำหรับผู้ที่ยังไม่ได้รับเลขประจำตัวสอบหรือได้รับเลขประจำตัวสอบแล้วไม่ถูกต้อง ให้นำหลักฐานการชำระเงิน หรือใบสมัครที่ได้รับเลขประจำตัวสอบที่ไม่ถูกต้อง ติดต่อศูนย์สรรหาและเลือกสรร สำนักงาน ก.พ. จังหวัดนนทบุรี <B>ภายในวันที่ 10 เมษายน 2552</B></P>
            			<P class=formthaitext>หลักฐานที่ต้องยื่นในวันสอบภาคความเหมาะสมกับตำแหน่ง</P>
			
						<TABLE class=thaitext cellSpacing=0 cellPadding=2 width="90%" border=0>
					  		<TBODY>
              				<TR>
                				<TD vAlign=top align=right width="13%">(1) </TD>
                				<TD vAlign=top width="87%">ใบสมัครที่พิมพ์จากอินเทอร์เน็ตให้ติดรูปถ่ายหน้าตรง ไม่สวมหมวก และ ไม่สวมแว่นตาดำ ถ่ายไม่เกิน 1 ปี ขนาด 1 x 1.5 นิ้ว ลงลายมือชื่อในใบสมัครให้ครบถ้วน </TD>
							</TR>
              				<TR>
                				<TD vAlign=top align=right>(2) </TD>
               					<TD vAlign=top>สำเนาปริญญาบัตรหรือสำเนาหนังสือรับรองฉบับสภามหาวิทยาลัยอนุมัติ และสำเนาระเบียนแสดงผลการศึกษา (Transcript of Records) ที่แสดงว่าเป็นผู้มีคุณวุฒิการศึกษาตรงตามประกาศรับสมัครโดยต้องสำเร็จการศึกษาและได้รับอนุมัติจากผู้มีอำนาจอนุมัติภายในวันปิดรับสมัครจำนวนอย่างละ 2 ฉบับ</TD></TR>
              				<TR>
                				<TD vAlign=top align=right>(3) </TD>
                				<TD vAlign=top>สำเนาบัตรประจำตัวประชาชน หรือสำเนาทะเบียนบ้าน จำนวน 1 ฉบับ</TD>
							</TR>
              				<TR>
                				<TD vAlign=top align=right>(4) </TD>
                				<TD vAlign=top>สำเนาหลักฐานอื่นๆ เช่น ใบสำคัญการสมรส (เฉพาะผู้สมัครสอบเพศหญิง) ใบเปลี่ยนชื่อ นามสกุล (ในกรณีชื่อ-นามสกุล ในหลักฐานการสมัครไม่ตรงกัน) เป็นต้น จำนวน 1 ฉบับ</TD>
							</TR>
						  	<TR>
								<TD vAlign=top align=right>(5) </TD>
								<TD vAlign=top>ใบรับรองแพทย์ซึ่งออกให้ไม่เกิน 1 เดือน และแสดงว่าไม่เป็นโรคต้องห้ามตามกฎ ก.พ. ฉบับที่ 3 พ.ศ. 2535 ซึ่งได้แก่ <BR><BR>- โรคเรื้อนในระยะติดต่อ หรือในระยะที่ปรากฏอาการเป็นที่รังเกียจแก่สังคม 			
									<BR>- วัณโรคในระยะอันตราย
									<BR>- โรคเท้าช้างในระยะที่ปรากฏอาการเป็นที่รังเกียจแก่สังคม
									<BR>- โรคติดยาเสพติด
									<BR>- โรคพิษสุราเรื้อรัง<BR>
								</TD>
							</TR>
							</TBODY>
						</TABLE>
		
						<P>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สำเนาเอกสารทุกฉบับให้ผู้สมัครเขียนคำรับรองว่า <B>“สำเนาถูกต้อง”</B> ลงชื่อ วันที่ และระบุเลขประจำตัวสอบกำกับไว้มุมบนด้านขวาทุกหน้าของสำเนาเอกสาร </P>
			
						<TABLE class=thaitext cellSpacing=10 cellPadding=0 width="90%" align=center border=0>
							<TBODY>
							<TR>
								<TD vAlign=top>
								
									<TABLE class=thaitext cellSpacing=0 cellPadding=5 width="100%" border=0>
										<TBODY>
										<TR>
											<TD vAlign=top align=middle>
												<INPUT class=thaitext id=submit2 onclick=javascript:window.print(); type=submit value=&nbsp;พิมพ์&nbsp; name=submit3>&nbsp;&nbsp;&nbsp; 
												<INPUT class=thaitext id=submit2 onClick="javascript:document.execCommand('SaveAs','1','form_5002241');" type=submit value=&nbsp;บันทึก&nbsp; name=submit3>&nbsp;&nbsp;&nbsp;
												<INPUT class=thaitext onClick="location.href='index.php';" type=button value=กลับหน้าหลัก name=button> 
											</TD>
										</TR>
										</TBODY>
									</TABLE>
									
								</TD>
							</TR>
							</TBODY>
						</TABLE>
						
					</TD>
				</TR>
				</TBODY>
			</TABLE>
			
		</TD>
	</TR>
	</TBODY>
</TABLE>
</DIV>-->
</BODY>
</HTML>