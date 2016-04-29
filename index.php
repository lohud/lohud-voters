<?php
  include('header.php')
?>
  <div class="row" style="padding-top:25px;">
    <div class="large-12 columns">
      <h2>New York State Voters Lookup</h2>
      <p style="font-size:-1;">Data is as of October 2015</p>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <div class="large-4 columns callout primary">
        <form id = "searchform" action = "index.php" method = "GET" style="padding-bottom:20px;">
            <fieldset>
                <legend>Search options</legend>
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
                <label for "id_frmlast">Enter part of last name</label>
                <input type = "text" name = "frm_last" id = "id_frmlast"></input>
                <label for "id_frmfirst">Enter part of first name</label>
                <input type = "text" name = "frm_first" id = "id_frmfirst"></input>
                <label for "id_frmfirst">If desired, specify city name (from mailing address)</label>
                <input type = "text" name = "frm_city" id = "id_frmcity"></input>
                <label for "id_frmfirst">Enter street name keyword ("Main" not "Main Street")</label>
                <input type = "text" name = "frm_street" id = "id_frmstreet"></input>
                <input type="submit" value="Submit" class="button radius">
                <input type=button value="New search" class="button radius" onClick="location.href='index.php'">
            </fieldset>
        </form>
      </div>
      <div class="large-8 columns">
        <?php
          if(strlen($txtmsg) > 0){
            echo $txtmsg;
          }
          else {
            require_once('RGrid/RGrid.php');


            $params['hostname'] = 'localhost';
            $params['username'] = 'php_user';
            $params['password'] = 'datadesk';
            $params['database'] = 'voters';
            function getQueryStringLocal($startnum = null, $exception = null) {
              if ($startnum === null) {
                $startnum = !empty($_GET['start']) ? $_GET['start'] : 0;
              }

              $_GET['start'] = $startnum;

              $qs = '';

              foreach ($_GET as $k => $v) {
                if(!($k == $exception)) {
                  $qs .= urlencode($k) . '=' . urlencode($v)  . '&';
                }
              }

              // If the query string is just a question mark, lose it
              if ($qs == '?') {
                $qs = '';
              }

              return preg_replace('/&$/', '', $qs);
            }

            $grid = RGrid::Create($params, $sql);
            $grid->showHeaders = true;

            $grid->SetDisplayNames(array(
              'lastname'  =>  'Name',                             
              'housenum'  =>  'Address',
              'towncity'  =>  'Municipality',
              'dob'       =>  'DOB',
              'party'     =>  'Party',
              'status'    =>  'Status'
            ));
            $grid->NoSpecialChars('lastname');
            $grid->HideColumn('firstname', 'midname', 'street', 'city', 'zip5', 'sregnumber');
            $grid->SetPerPage(10);
            $grid->AddCallback('RowCallback');

            function RowCallback(&$row) { // The ampersand is so that any changes made are reflected in the final grid
              $row['lastname'] = '<a href = "voter_detail_update.php?id=' . $row['sregnumber'] . '">' . $row['lastname'] . ", " . $row['firstname'] . " " . $row['midname'] . '</a>';
              $row['housenum'] = $row['housenum'] . " " . $row['street'] . ", " . $row['city'] . " " . $row ['zip5'];
            }  
            $grid->Display();
          } // end else
        ?>
      </div>
  </div>
<?php
  include('footer.php')
?>
