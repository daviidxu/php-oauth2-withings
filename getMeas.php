<?php
  function getMeas($access_token) {
    if (isset($access_token)) {
      $request = curl_init();
  
      curl_setopt($request, CURLOPT_URL, "https://wbsapi.withings.net/measure");
  
      curl_setopt($request, CURLOPT_RETURNTRANSFER, TRUE);
  
      curl_setopt($request, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $access_token
      ]);
  
      curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query([ 
        'action' => 'getmeas',
        'meastype' => 1,
        'meastypes' => 1,
        'category' => 1
      ]));
  
      curl_setopt($request, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($request, CURLOPT_SSL_VERIFYPEER, 0);
  
      $response = curl_exec($request);
  
      if ($response === false) {
        echo "cURL Error: " . curl_error($request);
      } else {
        $data = json_decode($response);
        if (isset($data->body->measuregrps[0]->measures[0]->value)) {
          curl_close($request);
          return $data->body->measuregrps[0]->measures[0]->value;
        } else {
            echo "Access token not found.";
        }
      }
    }
  }
?>