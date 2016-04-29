<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
<!-- version 1.3.0 -->
<!-- Domain name -->

<title>NYS voter lookup</title>


<?php

function cond_concat() {
$thestring = "";
$args = func_get_args();
foreach ($args as $arg) {
if (!empty($arg)) {
$thestring .= $arg . " ";
}//end if
//if empty do nothing
}//end foreach

return $thestring;
}

$db=mysql_connect ("localhost", "php_user", "datadesk") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("tjnnewsc_voters"); 




if($_GET['frm_name']) $area = htmlentities($_GET['frm_area']) ;
if($_GET['frm_area']) $last = htmlentities($_GET['frmlast']);
if($_GET['frm_Dept']) $first = htmlentities($_GET['frmfirst']);

$tablename= "voter_reg_0209";
$where = " where 1";
if($area=="nyc")
 $tablename .= "_nyc";
if($area=="lohud"||$area=="44"||$area=="60"||$area=="40")
$tablename .= "_lohud";
if($area=="nonact")
$tablename .= "_nonact";
if(!($area)) //this is opening screen
$tablename .= "_lohud";


if(strlen($area)<3&&strlen($area)>0)
$where .= " and countycode = '" . $area . "'";
if(strlen($last)>3)
$where .= " and lastname like = '" . $last . "'";
if(strlen($first)>3)
$where .= " and firstname like = '" . $first . "'";

$from = " from {$tablename}";
    $select = "select lastname, firstname, midname, housenum, street, city, zip5, towncity, dob, party, status, sregnumber";
	

    $order = " ORDER BY lastname, firstname";
   $sql = "$select$from$where$order";
   echo $sql;
   
   
include("header_local.html");	

?>
<html>
<head>


<style type="text/css">
h3.pcase { text-transform: none; }
</style>
<style type = "text/css">
input:focus, textarea:focus, select:focus{
background-color: lightyellow;
}
fieldset {
	width:350px; 
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:100%;
	background-color:#ccc;
	color:#666;
	border:solid 0 #fff;
	
		}
legend {
width:140px;
height:30px;
color: #446891;
font-size:1.5em;
letter-spacing:-1px;
white-space:pre; /* hack: make sure */
background: transparent url("legend_bg.gif") no-repeat;

}	
fieldset>legend {
background: transparent url("legend_bg.gif") no-repeat;
}
label {
	text-align:right;
	width:70px;
	float:left;
	padding:0.2em;
	margin:0;
	 }
textfield, textarea, select
{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:120%;
	margin:3px;
	height:20px;
	width:250px; 
	}	
input.submit {
border:solid 0 #fff;
margin:3px;
background: transparent url("submit.gif") no-repeat;
height:20px;

width:80px;
font:1.1em Verdana, Arial, Helvetica, sans-serif;
color:#666;
text-transform:uppercase;
 }
 option {
 font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:120%;
 
 }
</style>
</head>
<body>


<image align = "left" src = "transparent.png" width = "40" height = "120">
<image align = "right" src = "transparent.png" width = "120" height = "120">



  <h2>New York State Voters Lookup</h3>
  <p> <font size = "-2"> Data is from February 2010
 </font></p>
 <br>
 
<form id = "searchform" action = "voter_search.php" method = "GET">

<fieldset>
<legend>&nbsp;Search options&nbsp;&nbsp;&nbsp;&nbsp;	</legend>
<br clear = "left">
<label for "id_frm_area">Choose an area:</label>
<select name = "frm_area" id = "id_frm_area">
<option SELECTED= 1 value = "lohud">Lower Hudson Valley
<option value = "40">Putnam
<option value = "44">Rockland
<option value = "60">Westchester
<option value = "sw">Statewide name-only search
<option value = '1'>Albany  
<option value = '2'>Allegany 
<option value = '3'>Bronx 
<option value = '4'>Broome 
<option value = '5'>Cattaraugus 
<option value = '6'>Cayuga 
<option value = '7'>Chautauqua 
<option value = '8'>Chemung 
<option value = '9'>Chenango 
<option value = '10'>Clinton 
<option value = '11'>Columbia 
<option value = '12'>Cortland 
<option value = '13'>Delaware 
<option value = '14'>Duchess 
<option value = '15'>Erie 
<option value = '16'>Essex 
<option value = '17'>Franklin 
<option value = '18'>Fulton 
<option value = '19'>Genesee 
<option value = '20'>Greene 
<option value = '21'>Hamilton 
<option value = '22'>Herkimer 
<option value = '23'>Jefferson 
<option value = '24'>Kings 
<option value = '25'>Lewis 
<option value = '26'>Livingston 
<option value = '27'>Madison 
<option value = '28'>Monroe 
<option value = '29'>Montgomery 
<option value = '30'>Nassau 
<option value = '31'>New York 
<option value = '32'>Niagara 
<option value = '33'>Oneida 
<option value = '34'>Onondaga 
<option value = '35'>Ontario 
<option value = '36'>Orange 
<option value = '37'>Orleans 
<option value = '38'>Oswego 
<option value = '39'>Otsego 
<option value = '41'>Queens 
<option value = '42'>Rensselaer 
<option value = '43'>Richmond 
<option value = '45'>St. Lawrence 
<option value = '46'>Saratoga 
<option value = '47'>Schenectady 
<option value = '48'>Schoharie 
<option value = '49'>Schuyler 
<option value = '50'>Seneca 
<option value = '51'>Steuben 
<option value = '52'>Suffolk 
<option value = '53'>Sullivan 
<option value = '54'>Tioga 
<option value = '55'>Tompkins 
<option value = '56'>Ulster 
<option value = '57'>Warren 
<option value = '58'>Washington 
<option value = '59'>Wayne 
<option value = '61'>Wyoming 
<option value = '62'>Yates 
</select>
<br clear = "left">
<label for "id_frmlast">Enter part of last name</label>
<input type = "text" name = "frmlast" id = "id_frmlast"></input>
<br clear = "left">
<label for "id_frmfirst">Enter part of first name</label>

<input type = "text" name = "frmfirst" id = "id_frmfirst"></input>
<br clear = "left">
<input type = "submit" value = "SUBMIT">
<input type=button value="NEW SEARCH" onClick="location.href='voter_search.php'">

</fieldset>

</form>


<img align = "left" src = "transparent.png" width ="40" height = "120">


<?php

require_once('../../php/RGrid/RGrid.php');

    
    $params['hostname'] = 'localhost';
    $params['username'] = 'php_user';
    $params['password'] = 'datadesk';
    $params['database'] = 'tjnnewsc_salary';
	function getQueryStringLocal($startnum = null,$exception = null)
        {
            if ($startnum === null) {
                $startnum = !empty($_GET['start']) ? $_GET['start'] : 0;
            }

            $_GET['start'] = $startnum;

            $qs = '';
            foreach ($_GET as $k => $v) {
                if(!($k == $exception))
                $qs .= urlencode($k) . '=' . urlencode($v)  . '&';
            }

            // If the query string is just a question mark, lose it
            if ($qs == '?') {
                $qs = '';
            }

            return preg_replace('/&$/', '', $qs);
        }
 
 $grid = RGrid::Create($params, $sql);
$grid->showHeaders = true;
//   $select = "select lastname, firstname, midname, housenum, street, city, zip5, towncity, dob, party, status";
	
	

 $grid->SetDisplayNames(array(   'lastname'             => 'Name',                             
                                 'housenum'       => 'Address',
                                 'towncity'       => 'Municipality',
                                 'dob'       => 'DOB',
								 'party'       => 'Party',
								 'status'  => 'Status'
                                   ));
 $grid->NoSpecialChars('lastname');
 $grid->HideColumn('firstname', 'midname', 'street', 'city', 'zip5', 'sregnumber');
  $grid->SetPerPage(10);
 $grid->AddCallback('RowCallback');

    function RowCallback(&$row) // The ampersand is so that any changes made are reflected in the final grid
   {
  	$row['lastname'] = '<a href = "voter_detail.php?id=' . $row['sregnumber'] . '>' . $row['lastname'] . ", " . $row['firstname'] . " " . $row['midname'] . '</a>';
	$row['housnum'] = $row['housenum'] . " " . $row['street'] . ", " . $row['city'] . " " . $row ['zip5'];
	
	}  
	?>
	<style type="text/css">
   
body {
            background-color: #eee;
        }

        table.datagrid {
		background-color: #eee;
            font-family:Verdana, Arial, Helvetica, sans-serif;
            font-size: 10pt;
            border-collapse: collapse;
            width: 750px;
        }


        .datagrid thead th {
            color: white;
            background-color: #ccc;
            border-color: white #807070 #807070 white;
            border-width: 1px;
            border-style: solid;
            text-align: left;
            padding-left: 5px;
            font-weight: bold;
			
        }

        /**
        * Format the table cells
        */
        .datagrid tbody td {
            padding-left: 5px;
            border: 1px solid #ddd;
            background-color: white;
        }
        
        /*
        * Format the alternate table columns
        */
        .datagrid tbody td.col_1,
        .datagrid tbody td.col_3, {
            background-color: #eee;
        }
        
        /**
        * No link underlining
        */
        .datagrid tbody a {
            text-decoration: underline;
        }
        
        /**
        * Mouse overs
        */
        .datagrid tbody td.mouseover {
            background-color: #eee;
            border-left: 1px solid #0A246A;
            border-right: 1px solid #0A246A;
        }

        .datagrid tbody td.mouseover a {
            background-color: #0A246A;
            color: white;
        }
    // -->
    </style>
    
    <script language="javascript" type="text/javascript" defer="defer">
    <!--
        /**
        * 
        */
        function TdMouseOver()
        {
            this.className += ' mouseover';
        }
        var elements = document.getElementsByTagName('td');

        for (var i=0; i<elements.length; i++) {
            elements[i].onmouseover = TdMouseOver;
        }
    // -->
    </script>

 

    <?php
	$grid->Display()
	?>
 <image align = "left" src = "transparent.png" width = "40" height = "100">   
 <image align = "right" src = "transparent.png" width = "120" height = "100">

 

</body>
</html>



