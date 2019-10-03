<?php

/*
    cURL API REQUEST
    Requests information from the API, sending credentials and capturing errors.
*/

function getUnits() {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.sightmap.com/v1/assets/1273/multifamily/units?per-page=100",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_HTTPHEADER => array(
        "API-Key: 7d64ca3869544c469c3e7a586921ba37",
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      //return $response;
    }
    
    $arr = json_decode($response, true);
    $units = $arr['data'];
    return $units;
}

/*
    UNIT SORTING
    Scans through the collected units and sorts them into one of two possible groups by the 'area' key. Produces a list of units that match the provided criteria.
*/

$units = getUnits();

function splitUnits($list, $units) {

    $group1 = [];
    $group2 = [];

    foreach ($units as $unit){
        if($unit['area'] == 1) {
            array_push($group1, $unit);
        }
        else if ($unit['area'] > 1) {
            array_push($group2, $unit);
        } else {}
    }
    
    if ($list == 0) {
        return $group1; 
    } else if ($list == 1) {
        return $group2; 
    } else {}
    
}

$list1 = splitUnits(0, $units);
$list2 = splitUnits(1, $units);

/*
    VALUE OUTPUT
    Requests the value from an array, formatting it if necessary and returning a human-readable version for printing.
*/

function getValue($unit, $key) {
    if($key == 'updated_at') {
        $dateTime = date("F jS, Y, g:ia", strtotime($unit[$key]));
        return $dateTime;
    } else {
        $value = $unit[$key];
        return $value;
    }
}

/*
    LOOPED UNIT OUTPUT
    Loops through the requested list, outputting an HTML-formatted list of the requested Values from each individual unit.
*/

function outputArea($list) {
    foreach ($list as $array) {
        echo '<div class="unitBox">
        <h6 class="unitNumber"><strong>Unit</strong> ' . getValue($array, 'unit_number') . '</h6>
        <ul>
        <div class="row">
        <li class="col first">' . getValue($array, 'area') . ' square ft.<br /></li>
        <li class="col"><strong>Last updated <br /></strong>' . getValue($array, 'updated_at') . '<br /></li>
        </div>
        </ul>
        </div>';
    }
}

?>