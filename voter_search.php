<?php
    header("Location: http://data.lohud.com/tools/voterlookup/index.php");
    die();
    function cond_concat() {
        $thestring = "";
        $args = func_get_args();
        foreach ($args as $arg) {
            if (!empty($arg)) {
                $thestring .= $arg . " ";
            }
        }
        return $thestring;
    };

    if ($_GET['frm_area']) {
        $area = htmlentities($_GET['frm_area']);
    };

    if ($_GET['frm_last']) {
        $last = str_replace("'","''", htmlentities($_GET['frm_last']));
    };

    if ($_GET['frm_first']) {
        $first = htmlentities($_GET['frm_first']);
    };

    if ($_GET['frm_city']) {
        $city = htmlentities($_GET['frm_city']);
    };

    if ($_GET['frm_street']) {
        $street = htmlentities($_GET['frm_street']);
    };

    //$tablename= "voter_reg_sw_0313";
    $tablename= "voter_reg_sw_1015";
    $where = " where 1";
    if ($area=="lohud") {
        $where .= " and countycode in ('44','60','40')";
    }
    if ($area=="nyc") {
        $where .= " and countycode in ('31','43','24','41','3')";
    }
    if (!($area)) { // this is the opening screen
        $tablename = "";
        $txtmsg = "Use form above to search for voters";
    }
    if (strlen($area) < 3 && strlen($area) > 0) {
        $where .= " and countycode = '" . $area . "'";
    }
    if(strlen($last) > 0) {
        $where .= " and lastname like '" . $last . "%'";
    }
    if(strlen($first) > 0) {
        $where .= " and firstname like '" . $first . "%'";
    }
    if(strlen($city) > 0) {
        $where .= " and city = '" . $city . "'";
    }
    if(strlen($street) > 0) {
        $where .= " and street like '%" . $street . "%'";
    }
    $from = " from {$tablename}";
    $select = "select lastname, firstname, midname, housenum, street, city, zip5, towncity, dob, party, status, sregnumber";
    $order = " ORDER BY lastname, firstname";
    $sql = "$select$from$where$order";
    // echo $sql;

    include("../../js/header_newtemp.html"); 

    $pageref = "Voter search";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <!-- version 1.4.0 -->
    <!-- Kai's ver, WIP update started on 3/8/16 -->
    <!-- Good luck to those who are trying to troubbleshoot this page -->
    <!-- Going to start off with cleaning up the indents so that the page can be SOMEWHAT readable -->
    <!-- Jesus Christ I'd rather see M. Night Shyamalan's "Avatar The Last Airbender" on repeat for a full day -->
    <title>NYS voter lookup</title>
<html>
<head>
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
</head>
<body>
<h2>New York State Voters Lookup</h3>
<p style="font-size:-1;">Data is as of October 2015</p>
<br>
 
<form id = "searchform" action = "voter_search.php" method = "GET" style="padding-bottom:20px;">
    <fieldset>
        <legend>Search options</legend>
        <br clear = "left">
        <label for "id_frm_area">Choose an area:</label>
        <select name = "frm_area" id = "id_frm_area">
        <option SELECTED= 1 value = "lohud">Lower Hudson Valley
        <option value = "40">Putnam
        <option value = "44">Rockland
        <option value = "60">Westchester
        <option value = "stw">Statewide name-only search
        <option value = "nyc">New York City
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
        <input type = "text" name = "frm_last" id = "id_frmlast"></input>
        <br clear = "left">
        <label for "id_frmfirst">Enter part of first name</label>

        <input type = "text" name = "frm_first" id = "id_frmfirst"></input>
        <br clear = "left">
        <label for "id_frmfirst">If desired, specify city name (from mailing address)</label>

        <input type = "text" name = "frm_city" id = "id_frmcity"></input>
        <br clear = "left">
        <label for "id_frmfirst">Enter street name keyword ("Main" not "Main Street")</label>

        <input type = "text" name = "frm_street" id = "id_frmstreet"></input>
        <br clear = "left">
        <input type = "submit" value = "SUBMIT">
        <input type=button value="NEW SEARCH" onClick="location.href='voter_search.php'">

    </fieldset>

</form>
<?php
if(strlen($txtmsg)>0){ echo $txtmsg;}
else {
require_once('../../php/RGrid/RGrid.php');

    
    $params['hostname'] = 'localhost';
    $params['username'] = 'php_user';
    $params['password'] = 'datadesk';
    $params['database'] = 'voters';
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
    $row['lastname'] = '<a href = "voter_detail.php?id=' . $row['sregnumber'] . '">' . $row['lastname'] . ", " . $row['firstname'] . " " . $row['midname'] . '</a>';
    $row['housenum'] = $row['housenum'] . " " . $row['street'] . ", " . $row['city'] . " " . $row ['zip5'];
    
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
     $grid->Display();
     } // end else
    ?>
</body>
</html>


