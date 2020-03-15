<?php 

//
// Transform data from John Hopkins University Covid https://github.com/CSSEGISandData
//
// Converts column Updates to rows
//
// file output: Date(YMD), Country, Confirmed
//
// By @sensorpro
//
// For visualisation https://sensorpro.net/charts/covid19
//
// excludes China.

$url='https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_time_series/time_series_19-covid-Confirmed.csv';

$file = fopen($url,"r");

$v=array(); // ROW
$u=array(); // US

$r1=array();
$r2=array();

$i=0;
while(! feof($file)) {
$data =fgetcsv($file);
 
  for ($j = 0; $j < sizeof($data); $j++) {
      if ($i<1) {
      array_push($r1, $data[$j]);
      $filedate=$data[$j];
      }

    $country=$data[0] . "-" . $data[1];
    $country=str_replace(",","",$country);
    $country=str_replace(" ","-",$country);
    $country=ltrim($country,"-");
    
    switch ($data[1]) {
    case "China":
    break;
    
    case "US":
    if ($j > 3 & $i > 0) {
      $d = date_create_from_format('m/d/y', trim($r1[$j]) );
      $d = date_format($d, 'Y-m-d');
      array_push($u, $d . ',' . $country . ',' . $data[$j] . "\r\n");
    }        
    break;
        
    default:
    if ($j > 3 & $i > 0) {
      $d = date_create_from_format('m/d/y', trim($r1[$j]) );
      $d = date_format($d, 'Y-m-d');
      array_push($v, $d . ',' . $country . ',' . $data[$j] . "\r\n");
    }
      
    } //switch
    
   }
    
$i++;
}

fclose($file);

sort($v); 

array_unshift($v,"date,name,value" . "\r\n");

$file = "covid-row.csv";

file_put_contents($file, $v);

fclose($file);

//US

sort($u); 

array_unshift($u,"date,name,value" . "\r\n");

$file = "covid-us.csv";

file_put_contents($file, $u);

fclose($file);

?> 