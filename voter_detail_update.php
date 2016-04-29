<?php
  include('header.php')
?>

<div class="row" style="padding-top:25px">
    <div class="large-12 columns">
        <h3>Voter records in NY state (active and inactive) as of October 2015:</h3>
        <input type=button class="button" value="Back to current search" onClick="history.go(-1)">
        <input type=button class="button" value="New search" onClick="location.href='voter_search.php'">
        <div class="large-12 columns callout primary">
            <h3 class = "pcase">Voter record detail</h3>
            <?php
                $tablename = "voter_reg_sw_1015";
                $pid = htmlentities($_GET['id']);
                $option = htmlentities($GET['opt']);
                require('mysql_connect.php');
                //this is the typical single-record pull
                $query = "select * from {$tablename} where sregnumber ='" . $pid . "' order by regdate desc" ;
                //echo $query;
                $result = mysql_query($query) or die ("Could not run query (" . $query . " <br>because:<br> " . mysql_error());
                while ($row = mysql_fetch_array($result)){
                    $fullname = $row['lastname'] . ", " . $row['firstname'] . " " . $row['midname'] . " " . $row['suffix'];
                    $address = cond_concat($row[4],$row[5],$row[6],$row[7],$row[8],$row[9],",",$row[10],$row[11],$row[12] ? "-" . $row[12] : "");
                    $mail_address = cond_concat($row[13],$row[14],$row[15],$row[16]);
                    //echo($fullname);
                    echo('<table class = "sofT">' . "\n");
                    echo('<tr><td class = "helpHed">Name</td><td colspan = "3" class = "helpBod">' . $fullname .   '</td><td class = "helpHed">Status</td><td class = "helpBod">' . $row['status'] . '</td></tr>' . "\n");
                    echo('<tr><td class = "helpHed">Address</td><td class = "helpBod" colspan = "3">' . $address . '</td><td class = "helpHed">Town/city</td><td class = "helpBod">' . $row['towncity'] . '</td></tr>' . "\n");
                    if($mail_address) {
                        echo('<tr></td><td class = "helpHed">Mailing address</td><td class = "helpBod" colspan = "5">' . $mail_address . '</td></tr>' . "\n");
                    }

                    echo('<tr><td class = "helpHed">DOB</td><td class = "helpBod">' . $row['dob'] .   '</td><td class = "helpHed">M/F</td><td class = "helpBod">' . $row['gender'] . '</td><td class = "helpHed">Party</td><td class = "helpBod">' . $row['party'] . '</td></tr>' . "\n");
                    echo('<tr><td class = "helpHed">Reg. date</td><td class = "helpBod">' . $row['regdate'] .   '</td><td class = "helpHed">Reg. type</td><td class = "helpBod">' . $row['regsource'] . '</td><td class = "helpHed">Last vote</td><td class = "helpBod">' . $row['lastvotedate'] . '</td></tr>' . "\n");

                    if(!($row['status'] == "ACTIVE" || $row['status'] == "PREREG")){
                        echo('<tr></td><td class = "helpHed">Reason for non-active status</td><td class = "helpBod" >' . $row['statusreason'] . '</td><td class = "helpHed">Inactive date</td><td class = "helpBod">' . $row['inact_date'] . '</td><td class = "helpHed">Purge date </td><td class = "helpBod">' . $row['purge_date'] . '</td></tr>'. "\n");
                    }
                    if($row['prevname']){
                        echo('<tr><td class = "helpHed">Previous name</td><td class = "helpBod">' . $row['prevname'] .   '</td><td class = "helpHed">Prev. address</td><td class = "helpBod">' . $row['prevaddress'] . '</td><td class = "helpHed">Last year/county voted</td><td class = "helpBod">' . $row['lastyearvoted'] . "/" . $row['lastcountyvoted'] .  '</td></tr>' . "\n");
                    }

                    echo('<tr></td><td class = "helpHed">Voting history</td><td class = "helpBod" colspan = "5">' . $row['vhistory'] . '</td></tr>' ."\n");
                    echo('</table>');
                }//end while
            ?>
        </div>
    </div>
</div>
<?php
  include('footer.php')
?>