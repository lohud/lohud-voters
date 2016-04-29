<?php
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
        $txtmsg = "Use form on the left to search for voters";
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

    $pageref = "Voter search";
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>The Journal News/lohud.com Voter Database</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.0/foundation.min.css" />
    <link rel="stylesheet" href="css/app.css" />
  </head>
  <body>
  <script type="text/javascript">
    var indexOpt;
  </script>
  <div id='banner' style="height:77px;"></div>
  <script>
  if(window.self==window.top) {
    var banner = document.getElementById("banner");
    banner.style.backgroundColor = "black"; 
    banner.innerHTML = "<a href='http://www.lohud.com'><img src='http://data.lohud.com/lohud%20logos/site-masthead-logo.png' width='300' /></a><br>";
  }
  </script>  