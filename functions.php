<?php
function callOverview($symbol) {
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://cloud.iexapis.com/beta/stock/" .$symbol . "/quote?token=sk_7f2be94967774e0bae7793372cfc083e",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "",
    CURLOPT_HTTPHEADER => array(
      "Postman-Token: 11f4d863-cd81-46c5-a959-c1e694cecf5c",
      "cache-control: no-cache"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    return $response;
  }
}

function callHistorical($symbol) {
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://cloud.iexapis.com/beta/stock/" . $symbol ."/chart/3m?token=sk_7f2be94967774e0bae7793372cfc083e",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "",
    CURLOPT_HTTPHEADER => array(
      "Postman-Token: 9a926ad1-3b4c-4113-9139-d21578d91879",
      "cache-control: no-cache"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    return $response;
  }
}


?>
