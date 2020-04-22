<?php

header("Access-Control-Allow-Origin: *");

$binStatus = '';
 $date = '';
//listen for arduino response
if (isset($_GET['binstatus']))
{
    $binStatus = $_GET['binstatus'];

    if (!$binStatus === 'bin_full')
{
        $my_file_update = fopen("Not_ful_update.text", "w");
        fwrite($my_file_update, "arduino called");
        fclose($my_file_update);
        $_message = "arduino called";
    }

    if ($binStatus === 'bin_full')
    {
                           $date = new DateTime();
    
                echo $date->format('U = Y-m-d H:i:s') . "\n";
              
        /*
        //code goes here

        //API Url
        $url = 'http://smartbin-app-1.herokuapp.com/updatebin?bin_id=1';

        $ch = curl_init($url);

        //The JSON data.
        $jsonData = array(
            'bin_id_1' => 'full', );

        $jsonDataEncoded = json_encode($jsonData);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $result = curl_exec($ch);
*/
              $date = new DateTime();
              $record = $date->format('U = Y-m-d H:i:s') . "\n";
      
        $my_file_update = fopen("full_update.text", "w");
        fwrite($my_file_update,  $record);
        fclose($my_file_update);
        $_message = "arduino called";
    }
    else echo "arudino spoke but not waht i wanted to hear...!!";
}


 else echo "arudino hasn't spoken yet...!!";