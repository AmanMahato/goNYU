<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CG-Add Item</title>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.autocomplete.js"></script>
<script>
$(document).ready(function(){
 $(".tag").autocomplete("autocomplete.php", {
		
		select : function(event,ui){
			alert(ui);
		}
	});

});

</script>
</head>

<body>
<?php
include("../header.php");
include("../connect.php");

session_start();
	
if(!isset($_SESSION['ID']))
	header("location:../login.php?flag=10&usr=");
if(!isset($_REQUEST["row"]))
	header("location:../SaleEntryMaster.php");

$noofrows=$_REQUEST["row"]+$_REQUEST["addrow"];
$FreezeFlag=0;
echo("<form method='get' action='SaleEntryItems.php'> 
<input type='hidden' id='S_Id' name='S_Id' value='$_REQUEST[S_Id]'/> ");
		

$sql = "select * from sale_detail WHERE Sale_Id LIKE ".$_REQUEST['S_Id'];
$result=mysql_query($sql);

$row=mysql_fetch_array($result);

$inv=$row['Sale_Inv_No'];
$date=$row['Sale_Inv_Date'];
$hospid=$row['Hosp_Id'];

$sql = "select * from hospital_master WHERE Hosp_Id like ".$hospid;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$hospid=$row['Hosp_Name'];
$hospcity=$row['City'];

?>

	<br/> <br/>
	<b>Invoice No : <?php echo $inv; ?>
    <br/> Hospital Name : <?php echo $hospid.", ".$hospcity; ?>
    <br/> Date : <?php echo $date; ?></b>

<br/>
<table border="1" bordercolor="#000066" bgcolor="#000099">
<tr>
<td align="center" bgcolor="#FFFFFF">
<b> <font style="text-decoration:underline" face="Comic Sans MS, cursive" color="#0000FF" style="animation-name:none"> Code </font> </b>
</td>

<td align="center" bgcolor="#FFFFFF">
<b> <font style="text-decoration:underline" face="Comic Sans MS, cursive" color="#0000FF" style="animation-name:none"> Quantity </font> </b>
</td>

<td align="center" bgcolor="#FFFFFF">
<b> <font style="text-decoration:underline" face="Comic Sans MS, cursive" color="#0000FF" style="animation-name:none">  Rate  </font> </b>
</td>

<td align="center" bgcolor="#FFFFFF">
<b> <font style="text-decoration:underline" face="Comic Sans MS, cursive" color="#0000FF" style="animation-name:none">  Discount</font> </b>
</td>

<td align="center" bgcolor="#FFFFFF">
<b> <font style="text-decoration:underline" face="Comic Sans MS, cursive" color="#0000FF" style="animation-name:none">  Amount</font> </b>
</td>

</tr>
<br/>    
<?php

	for($i=0;$i<$noofrows;$i++)
	{
		if($i%2==0)
			echo("<tr bgcolor='#8000FF' height='50'>");
		else echo("<tr bgcolor='#009999' height='50'>");
		
		echo("<td width='650' align='center'>");
		if(isset($_REQUEST["item$i"]))
			$det=$_REQUEST["item$i"];
		else $det="";
		
		$j=$i+1;
		echo("$j) <input type='text' class='tag' name='item$i' value='$det' size='95'/></td>");
		
		if(isset($_REQUEST["qty$i"]))
			$det=$_REQUEST["qty$i"];
		else $det="";
		
		echo("<td width='200' align='center'><input type='text' name='qty$i' value='$det' size='20'/></td>");
  	
    	if(isset($_REQUEST["rate$i"]))
			$det=$_REQUEST["rate$i"];
		else $det="";
		
		echo("<td width='200' align='center'><input type='text' name='rate$i' value='$det' size='20'/></td>");

		if(isset($_REQUEST["discount$i"]))
			$det=$_REQUEST["discount$i"];
		else $det="0.00";
		
		echo("<td width='200' align='center'><input type='text' id='tag' name='discount$i' value='$det' size='20'/></td>"); 
		
		if(isset($_REQUEST["item$i"]) && isset($_REQUEST["qty$i"]) && isset($_REQUEST["rate$i"]))
		{
			echo("<td align='center'>");
			
			if($_REQUEST["item$i"]!="" && $_REQUEST["qty$i"]!="" && $_REQUEST["rate$i"]!="")
			{
				$itemdesc = explode(" , ",$_REQUEST["item$i"]);
				$itemdesc1 = explode("p",$itemdesc[5]);
								
				if($itemdesc1[0]<$_REQUEST["qty$i"])	
				{
					echo("<b><font color='#00FF00'>Quantity Entered is GREATER than QOH </font></b>");
					$FreezeFlag=2;
				}
				if($FreezeFlag!=2)
				{
					$amt=$_REQUEST["qty$i"]*$_REQUEST["rate$i"];	
					echo("<b> $amt </b>");
					echo("<input type='hidden' id='amt$i' name='amt$i' value='$amt'/>");
				}
			}
			
			if($_REQUEST["item$i"]=="" && $_REQUEST["qty$i"]!="" && $_REQUEST["rate$i"]!="")
			{
					$FreezeFlag=1;
					echo("<b><font color='#FFFFFF'>Pls select an Item </font></b>");
			}
			else if($_REQUEST["item$i"]=="" && $_REQUEST["qty$i"]=="" && $_REQUEST["rate$i"]!="")
			{
					$FreezeFlag=1;
					echo("<b><font color='#FFFFFF'>Pls select an Item & enter its Quantity </font></b>");
			}
			else if($_REQUEST["item$i"]=="" && $_REQUEST["qty$i"]!="" && $_REQUEST["rate$i"]=="")
			{
					$FreezeFlag=1;
					echo("<b><font color='#FFFFFF'>Pls Select an Item & enter its rate </font></b>");
			}
			else if($_REQUEST["item$i"]!="" && $_REQUEST["qty$i"]=="" && $_REQUEST["rate$i"]=="")
			{
					$FreezeFlag=1;
					echo("<b><font color='#FFFFFF'>Pls Enter Quantity & Rate</font></b>");
			}
			else if($_REQUEST["item$i"]!="" && $_REQUEST["qty$i"]=="" && $_REQUEST["rate$i"]!="")
			{
					$FreezeFlag=1;
					echo("<b><font color='#FFFFFF'>Pls Enter Quantity </font></b>");
			}
			else if($_REQUEST["item$i"]!="" && $_REQUEST["qty$i"]!="" && $_REQUEST["rate$i"]=="")
			{
					$FreezeFlag=1;
					echo("<b><font color='#FFFFFF'>Pls Enter Rate </font></b>");
			}
		
			echo("</td>");
			echo("</tr>");
		}
	}
	
	echo("</table><br/><br/>");
	
        echo(" <input type='hidden' id='row' name='row' value='$noofrows'/>
					<select id='addrow' name='addrow' >
						<option value='0'>Add 0 rows</option>
						<option value='5'>Add 5 rows</option>
                        <option value='10'>Add 10 rows</option>
                        <option value='15'>Add 15 rows</option>
                     </select>
					<input type='submit' value='Update' />");
       
	   if($FreezeFlag==0)
				echo("<input type='submit' value='Freeze Values' formaction='SaleEntryItemsFreeze.php'/>");
 
        echo("</form>");
	
?>
</body>
</html>