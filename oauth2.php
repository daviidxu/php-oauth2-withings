<?php
  function getAccessToken () {
    if (isset($_GET['code'])) {
      $authorizationCode = $_GET['code'];
      $request = curl_init();

      curl_setopt($request, CURLOPT_URL, "https://wbsapi.withings.net/v2/oauth2");
    
      curl_setopt($request, CURLOPT_RETURNTRANSFER, TRUE);
    
      curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query([ 
        'action' => 'requesttoken',
        'grant_type' => 'authorization_code',
        'client_id' => 'a16837aaa8f536b229ce20fa8e90a2739885b640ff67de7b84562b6fe0e27513',
        'client_secret' => '881b7dc5686e38894ef0cb27019ebc44e7daf72cc329fe914a43acee15774782',
        'code' => $authorizationCode,
        'redirect_uri' => 'http://localhost:7070'
      ]));
    
      curl_setopt($request, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($request, CURLOPT_SSL_VERIFYPEER, 0);
    
      $response = curl_exec($request);
      if ($response === false) {
        echo "cURL Error: " . curl_error($request);
      } else {
        $data = json_decode($response);
        if (isset($data->body->access_token)) {
          curl_close($request);
          return $data->body->access_token;
        }
      }
    }
  }
?>