<?php 

define('_ACO',md5(rand(2000,10000).rand(2000,10000).rand(2000,10000).rand(2000,10000)));

include_once("lib/config.php");

$rollback = true;

if(isset($_SESSION['user']))if(sessionCheck($_SESSION['user'],session_id(),$db)) $rollback = false;

if($rollback) echo "<script>window.location.href='member-guard.php?memberLogin';</script>";

if(empty($_GET['tab']) or $_GET['tab'] == "mp"){

	$lnk1='act'; $lnk2='normal'; $lnk3='normal'; $lnk4='normal'; $lnk5='normal'; $lnk6='normal'; $lnk7='normal'; $lnk8='normal';$lnk9='normal';

}else if($_GET['tab'] == "cp"){

	$lnk1='normal'; $lnk2='act'; $lnk3='normal'; $lnk4='normal'; $lnk5='normal'; $lnk6='normal'; $lnk7='normal'; $lnk8='normal';$lnk9='normal';

}else if($_GET['tab'] == "as"){

	$lnk1='normal'; $lnk2='normal'; $lnk3='act'; $lnk4='normal'; $lnk5='normal'; $lnk6='normal'; $lnk7='normal'; $lnk8='normal';$lnk9='normal';

}else if($_GET['tab'] == "bo"){

	$lnk1='normal'; $lnk2='normal'; $lnk3='normal'; $lnk4='act'; $lnk5='normal'; $lnk6='normal'; $lnk7='normal'; $lnk8='normal';$lnk9='normal';

}else if($_GET['tab'] == "so"){

	$lnk1='normal'; $lnk2='normal'; $lnk3='normal'; $lnk4='normal'; $lnk5='act'; $lnk6='normal'; $lnk7='normal'; $lnk8='normal';$lnk9='normal';

}else if($_GET['tab'] == "ms"){

	$lnk1='normal'; $lnk2='normal'; $lnk3='normal'; $lnk4='normal'; $lnk5='normal'; $lnk6='act'; $lnk7='normal'; $lnk8='normal';$lnk9='normal';

}else if($_GET['tab'] == "tt"){

	$lnk1='normal'; $lnk2='normal'; $lnk3='normal'; $lnk4='normal'; $lnk5='normal'; $lnk6='normal'; $lnk7='act'; $lnk8='normal';$lnk9='normal';

}else if($_GET['tab'] == "ta"){

	$lnk1='normal'; $lnk2='normal'; $lnk3='normal'; $lnk4='normal'; $lnk5='normal'; $lnk6='normal'; $lnk7='normal'; $lnk8='act';$lnk9='normal';

}else if($_GET['tab'] == "up"){

	$lnk1='normal'; $lnk2='normal'; $lnk3='normal'; $lnk4='normal'; $lnk5='normal'; $lnk6='normal'; $lnk7='normal'; $lnk8='normal';$lnk9='act';

}

$mid = $_SESSION['user'];

$ml=$db->dataset("Select * from `ml` where `0`=$mid",$mlc);

if($db->is_err){ echo $db->err; exit();}

if($mlc == 0) echo "<script>window.location.href='member-guard.php?memberLogin';</script>";

$mf=$db->dataset("Select * from `mf` where `0`=$mid",$mfc);

if($db->is_err){ echo $db->err; exit();}

$dap=$db->dataset("Select * from `delivery` where `id`=$mid",$mfc);

if($db->is_err){ echo $db->err; exit();}

$prd_count_2 = $db->dataset("Select Count(*) from `pl` where `13`=0 AND `2`=".$_SESSION['user'],$prd_co);

if($db->is_err){ echo $db->err; exit();}

$sell_count_2 = $db->dataset("Select Count(*) from `pl` where `13`=1 AND `2`=".$_SESSION['user'],$prd_co);

if($db->is_err){ echo $db->err; exit();}

$bof_count_2 = $db->dataset("Select Count(*) from `bof` where  `12`=".$_SESSION['user'],$bof_co);

if($db->is_err){ echo $db->err; exit();}

$msg_row = $db->dataset("Select * from `msg` where `2`=".$_SESSION['user'],$msg_count);

if($db->is_err){ echo $db->err; exit();}

$mmt_new = $db->dataset("Select * from `mmt` where `0`=".$ml[0][4],$non);

if($db->is_err){ echo $db->err; exit();}

$m=$db->dataset("Select * from `m` where `0`=$mid",$mc);

if($db->is_err){ echo $db->err; exit();}

$em = NULL;

for($i=0;$i<$mc;$i++) $em[] = $m[$i][3];

$icon = $db->dataset("Select `26` as `ico` from `mmt` where `0`=".$ml[0][4],$non);

if(intval($ml[0][5]) == 1) $trust="images/trustpass_big.png"; else $trust="images/trustpass_big_dis.png";

$cershow = $db->dataset("Select * from `cer` where `1`=$mid ORDER BY `0` DESC ",$crs);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?php echo $lan['aco_tit'];?></title>

<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="css/account.css" />

<style>

/*td {border:1px solid;}   */


.borderh{border:1px solid #999; margin:2px; padding:5px}

</style>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>

<script>
$(document).ready(function(){

	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		/*$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});*/
	});

});
</script>


 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<?php
$pro=0;
if(is_numeric($mmt_new[0][4])){ 
	$pro = ($prd_count_2[0][0] * 100) / $mmt_new[0][4];
}

$sell=0;
if(is_numeric($mmt_new[0][17])){ 
	$sell = ($sell_count_2[0][0] * 100) / $mmt_new[0][17];
}


$bof=0;
if(is_numeric($mmt_new[0][17]) && $bof_count_2[0][0]>0){ 
	$bof = ($bof_count_2[0][0] * 100) / $mmt_new[0][17];}


$p=0; $t=0;
foreach ($msg_row as $res) {
	if(intval($res[6]) == 0) $t++;
	$p++;
}
$oldmsg = intval($p-$t);
if ($p==o){
$p++;}
$msgc = intval(($oldmsg*100)/$p);
$pp = 0;
for ($i=0; $i <= 41 ; $i++) { 
	$pp++;
	if(empty($mf[0][$i]))
		$pp--;
}

$profile = intval((($pp * 100)/ 41));

?>

<script>

$(function() {




$( "#progressbar_1" ).progressbar({value: <?php echo $pro ?>});

$( "#progressbar_2" ).progressbar({value: <?php echo $profile ?>});
$( "#progressbar_3" ).progressbar({value: <?php echo $sell ?>});
$( "#progressbar_4" ).progressbar({value: <?php echo $bof ?>});
$( "#progressbar_6" ).progressbar({value: <?php echo $msgc ?>});

});
</script>


<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="js/jquery-ui.js"></script>


<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="js/jquery-ui.js"></script>

<script type="text/javascript" src="js/jquery.validate.js"></script>

<script type="text/javascript" src="js/add_vali.js"></script>

<script type="text/javascript" src="js/jquery.cookie.js"></script>

<script type="text/javascript" src="js/jquery.maskedinput-1.3.js"></script>

<script type="text/javascript" src="js/script.js"></script>

<script language="javascript">

function fill(val)

{

	var arr =val.split("%");

	var c = arr.length;

	document.getElementById('subcat').options.length = 0;

	for(i=1;i<c;i++){

		var optn = document.createElement('OPTION');

		var sp=arr[i].split("|");

		optn.text=sp[0];

		optn.value=sp[1];

		document.getElementById('subcat').options.add(optn);

	}

	if(c == 1) document.getElementById('subcat').style.display='none';

	else document.getElementById('subcat').style.display='inline';

}

function ipic(input,id) {

			if(document.all)

				document.getElementById(id).src = input.value;

			else if (input.files && input.files[0]) {

                var reader = new FileReader();



                reader.onload = function (e) {

                    $('#'+id).attr('src', e.target.result);

                }



                reader.readAsDataURL(input.files[0]);

            }

        }

</script>







</head>



<body>

	<div class="jtopmenu"><?php include(_PAG."top_menu.php")?></div>
<div id="top"></div>	
<table style="" cellpadding="0" cellspacing="0" width="960" align="center">

<!-- **** START HEADER **** -->
<td style="display:block; padding-bottom:5px; height:63px; width: 960px; background:url(images/my_enterbell.png) no-repeat top left;	">
	<div style="text-align:right; padding-top:20px ; padding-right:10px;padding-left:700px "><a href="http://enterbell.com/index.php"><img src="./images/product icon/home.png"  align="baseline">	Go to<span> &nbsp</span>www.enterbell.com</a></div>

</td>
<tbody>

<!-- **** END HEADER **** -->



<!-- **** START BODY **** -->

<tr><td height="800" valign="top">

<table style="padding-left: 2px;" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">

<tbody><tr>
<!--- Menu Top -->
<td height="10">
<!--------
<div class="comhead corner-tl corner-tr">

<img src="<?php echo $mf[0][28];?>" style="width:120px; height:60px; float:left; margin:3px" />

<img src="<?php echo $icon[0]['ico'];?>" style="float:right" /><img src="<?php echo $trust;?>" style="float:right" />

<h1 style="margin:3px 0 0 0;font-family:Trebuchet MS"><?php echo $ml[0][1];?></h1>

<?php

$bt=str_replace(" ","",$ml[0][7]);

$cbt=NULL;

$cbt=explode("|",$bt);

$arr_bt=NULL;

foreach($cbt as $xin)

  if(!empty($xin)){ $xin = str_replace('bt0','bt',$xin);

	$arr_bt[]=$lan['cm_'.$xin];}

unset($xin);

$str_bt="[".implode(", ",$arr_bt)."]";

?>

<label><?php echo $str_bt?></label><br />

</div>
----->
<div class="acomenu" style="position:relative">

<a href="javascript:void(0)" rel="content1" rev="commenu" class="corner-tr corner-tl <?php echo $lnk1; ?>"><?php echo $lan['aco_mp']; ?></a>
<a href="javascript:void(0)" rel="content3" rev="commenu" class="corner-tr corner-tl <?php echo $lnk3; ?>"><?php echo $lan['aco_as']; ?></a>
<a href="javascript:void(0)" rel="content2" rev="commenu" class="corner-tr corner-tl <?php echo $lnk2; ?>"><?php echo $lan['aco_cp']; ?></a>




<a href="javascript:void(0)" rel="content5" rev="commenu" class="corner-tr corner-tl <?php echo $lnk5; ?>"><?php echo $lan['aco_so']; ?></a>
<a href="javascript:void(0)" rel="content4" rev="commenu" class="corner-tr corner-tl <?php echo $lnk4;?>"><?php echo $lan['aco_bo'];?></a>
<a href="javascript:void(0)" rel="content6" rev="commenu" class="corner-tr corner-tl <?php echo $lnk6; ?>"><?php echo $lan['aco_mc']; ?></a>
<a href="javascript:void(0)" rel="content8" rev="commenu" class="corner-tr corner-tl <?php echo $lnk8; ?>"><?php echo $lan['aco_ta']; ?></a>



<a href="javascript:void(0)" style="position:absolute;right:2px;top:1px;"  rel="content9" rev="commenu" class="corner-tr corner-tl <?php echo $lnk9;?>">UPGRADE</a>


</div>

</td>

</tr>

<tr><td valign="top">

<div style="border:0px solid #d9c8e2; border-top:none; padding:0; margin:0" class="corner-bl corner-br">

<table style="padding: 0pt; margin: 0pt;" border="0" cellspacing="0" height="700" width="100%">

<tbody><tr>

<td valign="top">

<center><img src="images/page-preload.gif" border="0" style="margin-top:100px;" id="pgPreload"/></center>

<div class="aco-content" id="content1" align="left" style="display:none">
<br />
<?php include(_PAG."acc_home.php");?>

</div>

<div class="aco-content" id="content2" align="center" style="display:none">
<br />
<?php include(_PAG."com_profile.php");?>

</div>



<div class="aco-content" id="content3" align="center" style="display:none">
<br />
<?php include(_PAG."acc_setting.php");?>

</div>



<div class="aco-content" id="content4" align="center" style="display:none">
<br /><br />
<?php include(_PAG."buyoffer.php");?>

</div>



<div class="aco-content" id="content5" align="center" style="display:none">
<br />
<?php include(_PAG."selling.php");?>

</div>



<div class="aco-content" id="content6" align="center" style="display:none">
<br /><br />
<?php include(_PAG."msg.php");?>

</div>



<div class="aco-content" id="content7" align="center" style="display:none">
<br /><br />
Trade Tools not build yet

</div>



<div class="aco-content"  id="content8"  style="display:none">
<br /><br />
<?php include(_PAG."trs.php");?>

</div>

<div class="aco-content" id="content9" align="left" style="display:none">
<br /><br />
<?php include(_PAG."myplan.php");?>

</div>

<script type="text/javascript" src="js/jquery.form.js"></script>

<script language="javascript">

function sel(textBox){

	textBox.focus();

	//textBox.select();

}

$(document).ready(function(){

$(window).load(function(){$('#pgPreload').remove();});

	$('#ediTbl img').hover(function(){

			var src = $(this).attr('src');

			var newSrc = src.replace('_dis.png','.png');

			if($(this).css('cursor') == 'pointer')

				$(this).attr('src',newSrc);

	},function(){

			var src = $(this).attr('src');

			var newSrc = src.replace('.png','_dis.png');

			if($(this).css('cursor') == 'pointer')

				$(this).attr('src',newSrc);

	});

	$('.edi').click(function(){

		var id = ($(this).attr('id')).replace('e-','');

		//alert(id);

		$('#s-'+id).hide();

		$('#'+id).show();

		sel($('#'+id));

		$('#t-'+id).show();

		$(this).hide();

	});

	$('.edix').click(function(){

		var id = ($(this).attr('id')).replace('e-','');

		$('#s-'+id).hide();

		$('#d-'+id).show();

		$('#t-'+id).show();

		$(this).hide();

	});

	$('#txtCtel1,#txtCtel2,#txtCtel3').keyup(function(){

		$('#txtCtel').val($('#txtCtel1').val()+'-'+$('#txtCtel2').val()+'-'+$('#txtCtel3').val());

	});

	$('#txtCfax1,#txtCfax2,#txtCfax3').keyup(function(){

		$('#txtCfax').val($('#txtCfax1').val()+'-'+$('#txtCfax2').val()+'-'+$('#txtCfax3').val());

	});

	$('#txtCfax1,#txtCfax2,#txtCfax3,#txtCtel1,#txtCtel2,#txtCtel3').blur(function(){ $(this).trigger('keyup');});

	$('.acc_text').keypress(function(e){

		var id = $(this).attr('id');

		if($(this).hasClass('req') && !$(this).val() && e.keyCode == 13) return false;

		if($(this).hasClass('email') && e.keyCode == 13){

			var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;

			var inputVal = $(this).val();

			if(inputVal.search(emailRegEx) == -1){

				alert($('#err-'+id).val());

				 return false

			}

			if($(this).hasClass('uniq')){

				var ems = $('#all-'+id).val();

				var olde = $(this).attr('alt');

				ems = ems.replace(olde,'');

				if(ems.search(inputVal) >= 0){

					alert($('#err2-'+id).val());

				 	return false

				}

			}

		}

			

		if(e.keyCode == 13)

			$('#t-'+id).trigger('click');

	});

	$('.num').keydown(function(e){

			if ( e.keyCode == 46 || e.keyCode == 8 ) {

            ;// let it happen, don't do anything

        	}

       		else {
       			
				if(e.keyCode == 13)
					$('#t-'+id).trigger('click');
            // Ensure that it is a number and stop the keypress

           		if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105 )) {

                	e.preventDefault(); 

            	}   

       	 	}
       	 	

	});

	$('.tik').click(function(){

		var id = ($(this).attr('id')).replace('t-','');

		var txt = $('#'+id).val();

		var mem = $('#memId').val();

		if($('#'+id).hasClass('email')){

			var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;

			var inputVal = $('#'+id).val();

			if(inputVal.search(emailRegEx) == -1){

				alert($('#err-'+id).val());

				 return false

			}

			if($('#'+id).hasClass('uniq')){

				var ems = $('#all-'+id).val();

				var olde = $('#'+id).attr('alt');

				ems = ems.replace(olde,'');

				if(ems.search(inputVal) >= 0){

					alert($('#err2-'+id).val());

				 	return false

				}

			}

		}

		$(this).hide();

		$('#p-'+id).show();

		$.post("pages/edit.php",{id:mem,mod:id,val:txt}, function(data){
			if(data == false){
				alert('Email is repeated. Please try again ');
			}
			
			
			if(data){

				$('#p-'+id).hide();

				if(id == "txtCqc"){if(txt == '1') txt = "in house"; else if(txt == '2') txt = "3rd party"; else  txt = "no";}

				if(id == "txtCtel"){

					var spl = txt.split('-');	

					$('#txtCtel1').attr('alt',spl[0]);

					$('#txtCtel2').attr('alt',spl[1]);

					$('#txtCtel3').attr('alt',spl[2]);

					$('#d-'+id).hide();

				}

				if(id == "txtCfax"){

					var spl = txt.split('-');	

					$('#txtCfax1').attr('alt',spl[0]);

					$('#txtCfax2').attr('alt',spl[1]);

					$('#txtCfax3').attr('alt',spl[2]);

					$('#d-'+id).hide();

				}
				
					$('#s-'+id).html(txt);

					$('#s-'+id).show().effect("pulsate", 100);

					$('#'+id).attr('alt',txt);

					$('#'+id).hide();

					$('#e-'+id).show();	
				
				

			}else{

				$('#p-'+id).hide();

				$('#s-'+id).show().effect("pulsate", 100);

				$('#'+id).hide();

				$('#'+id).val($('#s-'+id).text());

				$('#e-'+id).show();

			}

		});

	});

	$('.rdo').click(function(){

		if(this.checked){

			var id = ($(this).attr('id')).replace('rdo-','');

			var cap = "txtM"+$(this).attr('name');

			var txt = $(this).val();

			var mem = $('#memId').val();

			$(this).hide();

			$('#p-'+id).show();

			$.post("pages/edit.php",{id:mem,mod:cap,val:txt}, function(data){

				if(data){

					$('#p-'+id).hide();

					$('#rdo-'+id).show();

					$("label[for^='rdo-"+id+"']").effect("pulsate", 100);

				}else{

					$('#p-'+id).hide();

					$('#rdo-'+id).removeAttr('checked');

					$('#rdo-'+id).show().effect("pulsate", 100);

				}

			});

		}

	});

	$('.chk').change(function(){

			var mem = $('#memId').val();

			var cap = "txtC";

			var id = ($(this).attr('id')).replace('chk-','');

			var selector = id[0]+id[1];

			cap = cap+selector;
			

			var allBt = $('#'+cap).val();

			var newBt = allBt.replace('|'+id,'');

			if(newBt == allBt)

				newBt = allBt + '|' + id;

			if(selector == 'bt' && newBt == ""){

			alert($('#bt-type-err').val());

			newBt = allBt;

			$(this).attr('checked','checked');

			}

			var chk = this.checked ? true : false;

			$('#p-'+id).show();

			$(this).hide();

			$('#'+cap).val(newBt);

			//$('#xxx').html(newBt);

			$.post("pages/edit.php",{id:mem,mod:cap,val:newBt}, function(data){

			if(data){

				$('#p-'+id).hide();

				$('#chk-'+id).show();

				$("label[for^='chk-"+id+"']").effect("pulsate", 100);

			}else{

				$('#p-'+id).hide();

				if(chk) $('#chk-'+id).removeAttr('checked'); else $('#chk-'+id).attr('checked','checked');

				$('#chk-'+id).show();

			}

			});

		});
		


		$('#chgCerimg').click(function(){$('#filCerimg').trigger('click');}); 

		$('#chgComLgo').click(function(){$('#filComLgo').trigger('click');}); 

		$('#filComLgo').change(function(){

			var conf = $('#hidComLgoErr').val();

			var file = $(this).val();

			var extArry = ['bmp','jpg','jpeg','gif','png'];

			var extension = (file.substr( (file.lastIndexOf('.') +1) )).toLowerCase();

			if(jQuery.inArray(extension,extArry) >= 0){

				if(confirm(conf)){

					var imgW = $('#imgComLgo').width() - 4;

					var imgH = $('#imgComLgo').height();

					$('#imgComLgo').before('<div style="position:absolute; background:url(images/loading.gif) #f7dfed center center no-repeat; width:'+imgW+'px; height:'+imgH+'px" class="border corner-all4" id="divComLgo"></div>');

					$('#imgComLgo').hide();

					$('#frmComLgo').submit();

				}

			}else alert($('#hidComLgoErr3').val()); 

		});


		$('#frmComLgo').ajaxForm(function(data){

			if(data){

				$('#imgComLgo').attr('src',data);

				$('#divComLgo').remove();

				$('#imgComLgo').show();

			}else{

				$('#divComLgo').remove();

				$('#imgComLgo').show();

				alert($('#hidComLgoErr2').val());

			}

		});

		$('.dbl').dblclick(function(){

			var id = ($(this).children('span').attr('id')).replace('s-','');

			$('#e-'+id).trigger('click');

		});

});

</script>
<!-------------------------------------------------->
<script>
$(document).ready(function()
{
	$('#cershow li a').click(function(){
		var cerid = $(this).attr('cerid');
		var cerimg = $(this).attr('cerimg');
		var qudel = confirm('You want delete this item');
		if(qudel == true){
			$(this).parent().effect("pulsate", 200,function(){
				$(this).remove();
			});

			$.post('pages/cer.php',{idcer:cerid,imgcer:cerimg}, function(Data){
				
			
			})
		}
		
	});
});
</script>
<script>
$(document).ready(function()
{


 function getDoc(frame) {
     var doc = null;
     
     // IE8 cascading access check
     try {
         if (frame.contentWindow) {
             doc = frame.contentWindow.document;
         }
     } catch(err) {
     }

     if (doc) { // successful getting content
         return doc;
     }

     try { // simply checking may throw in ie8 under ssl or mismatched protocol
         doc = frame.contentDocument ? frame.contentDocument : frame.document;
     } catch(err) {
         // last attempt
         doc = frame.document;
     }
     return doc;
 }

$("#frmCertification").submit(function(e)
{
		$("#multi-msg").html("<img src='loading.gif'/>");

	var formObj = $(this);
	var formURL = formObj.attr("action");

if(window.FormData !== undefined)  // for HTML5 browsers
//	if(false)
	{
	
		var formData = new FormData(this);
		$.ajax({
        	url: formURL,
	        type: 'POST',
			data:  formData,
			mimeType:"multipart/form-data",
			contentType: false,
    	    cache: false,
        	processData:false,
        	dataType: 'json',
			success: function(data, textStatus, jqXHR)
		    {
		    		if(data[0] == 'true'){
						$("#multi-msg").html('<spna>Item was successfully added</span>');
						//$('#imgCerimg').attr('src',data[3]);
						$('#cershow').prepend("<li><img src='"+data[3]+"'/><span>"+data[1]+"</span><span>"+data[2]+"</span></li>");
						$('#cershow li:first-child').effect("pulsate", 300);
		    		}
					

		    },
		  	error: function(jqXHR, textStatus, errorThrown) 
	    	{
				$("#multi-msg").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
	    	} 	        
	   });
        e.preventDefault();
   }
   else  //for olden browsers
	{
		//generate a random id
		var  iframeId = 'unique' + (new Date().getTime());

		//create an empty iframe
		var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');

		//hide it
		iframe.hide();

		//set form target to iframe
		formObj.attr('target',iframeId);

		//Add iframe to body
		iframe.appendTo('body');
		iframe.load(function(e)
		{
			var doc = getDoc(iframe[0]);
			var docRoot = doc.body ? doc.body : doc.documentElement;
			var data = docRoot.innerHTML;
			$("#multi-msg").html('<pre><code>'+data+'</code></pre>');
		});
	
	}

});


$("#multi-post").click(function()
	{
		
	$("#multiform").submit();
	
});

});
</script>

<script>
		 var w=window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

</script>
<div id="back-top" class="back-top ">

	<span > 
		<a href="#top"  style="" >	<div  class="cornerhover" style=" background:url(images/top.png);height:30px;margin-top:10px"><div style="padding-left:50px;padding-top:10px ; "> Top</div></div></a></br>
		<a href=" http://enterbell.com/supportcenter/index.php?act=tickets&code=open" ><div	 class="cornerhover" style=" background:url(images/sugg.png);height:30px"> <div style="padding-left:50px;padding-top:10px"> Suggestions</div></div></a></br>
		<a href= "http://enterbell.com/page.php?pid=37" ><div	 class="cornerhover" style=" background:url(images/adv.png);height:30px"> <div style="padding-left:50px;padding-top:10px"> Advertise</div></div></a></br>	
		<a href="http://enterbell.com/supportcenter/index.php?act=tickets&code=open"><div	 class="cornerhover" style=" background:url(images/supp.png);height:30px"> <div style="padding-left:50px;padding-top:10px"> Support Center</div></div></a></br>
		<a href=" " ><div	 class="cornerhover" style=" background:url(images/rec.png);height:30px"> <div style="padding-left:50px;padding-top:10px"> Recommend Us</div></div></a></br>
		<a  ><div	 class="cornerhover" style=" background:url(images/up-arrow2.png);height:38px;margin-left:1px"> <div style="padding-left:20px;padding-top:5px"></div></div></a></br>

			
			
</span>
		
</div>


<!------------------------------------------>



</td>

</tr></tbody></table>

</div>

</td></tr>

</tbody></table>

</td></tr>

<!-- **** END BODY **** -->



<!-- **** START FOOTER **** -->

<?php include(_PAG."footer.php");?>

<!-- **** END FOOTER **** -->

</tbody></table>


</body>

</html> 