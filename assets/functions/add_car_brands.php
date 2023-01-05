<?php

include "../config.php";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://parseapi.back4app.com/classes/Carmodels_Car_Model_List?limit=1000000');
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'X-Parse-Application-Id: eB78A5eY5SvRUBCFMNHGcVl2uj8mzYu050vuof1s', // This is your app's application id
    'X-Parse-REST-API-Key: p7iFGuN48yjZC0BGKH5VfHw5yUZ4sX90cgW1C3W7' // This is your app's REST API key
));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
$data = json_decode($response); // Here you have the data that you need
//print_r(json_encode($data, JSON_PRETTY_PRINT));
curl_close($curl);
$brands = [];

foreach ($data as $datum) {

    foreach ($datum as $item) {

        if(!in_array($item->Make, $brands, true)){
            array_push($brands, $item->Make);
        }

    }
}
print_r($brands);

$car_brands = new Brand();

// For each brands, insert it in database. (if you don't want duplicates, please reset category table)
//foreach ($brands as $brand) {
//    to add brands, use this but only if table is empty
//    echo $car_brands->addBrand($brand);
//}
