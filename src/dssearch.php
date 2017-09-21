<?php

  $url = 'https://www.arhaandiam.com/testsite/diamond-search';
  $post_data = array(
        'api_key' => '47030ee0-2bf5-11e7-b396-17bd839c5425',
        'unique_identifier' => 3,
        'style' => 'gold',
  );
  
  //Initialize curl
  $ch = curl_init();
  
  //URL to submit
  curl_setopt($ch, CURLOPT_URL, $url);
  
  //Return output instead of outputting it
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  
  //To include header in output
  curl_setopt($ch, CURLOPT_HEADER, 0);
  
  //Adding post variables
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
  
  //Execute & fetch response
  $response = curl_exec($ch);
  
  
  if($response == FALSE) {
     echo __("Error while displaying search").": " . curl_error($ch);
  }
  
  //Close handle
  curl_close($ch);
  
  //Display raw output
  print_r($response);

?>