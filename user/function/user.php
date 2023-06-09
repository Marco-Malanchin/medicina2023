<?php
function addUser($data)
{
    $url = 'http://localhost/medicina2023/medicina-api/api/user/addUser.php';

    $curl = curl_init($url); //inizializza una nuova sessione di cUrl
    //Curl contiene il return del curl_init 

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // ritorna il risultato come stringa

    $headers = array(
        "Content-Type: application/json",
        "Content-Lenght: 0",
    );

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // setta gli headers della request

    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

    $responseJson = curl_exec($curl);

    curl_close($curl);

    $response = json_decode($responseJson);

    return $response;
}
function getLastUserIdFromEmail($email){
    $url = 'http://localhost/medicina2023/medicina-api/api/user/getLastUserIdFromEmail.php?email='.$email.'';

    $json_data = file_get_contents($url);
    $res = json_decode($json_data);
    return $res[0]->id; 
}
function addPrivileges($data)
{
    $url = 'http://localhost/medicina2023/medicina-api/api/user/addPrivileges.php';

    $curl = curl_init($url); //inizializza una nuova sessione di cUrl
    //Curl contiene il return del curl_init 

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // ritorna il risultato come stringa

    $headers = array(
        "Content-Type: application/json",
        "Content-Lenght: 0",
    );

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // setta gli headers della request

    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

    $responseJson = curl_exec($curl);

    curl_close($curl);

    $response = json_decode($responseJson);

    return $response;
}

function getArchiveUser(){
    $url = 'http://localhost/medicina2023/medicina-api/api/user/getArchiveUser.php';

    $json_data = file_get_contents($url);

    $decode_data = json_decode($json_data, $assoc = true);
    $off_data = $decode_data;
    if (!empty($off_data)) {
        $off_arr = array();

        foreach ($off_data as $off) {
            $off_record = array(
                'nome' => $off['name'],
                'cognome' => $off['surname'],
                'email' => $off['email'],
            );
            array_push($off_arr, $off_record);
        }

        return $off_arr;
    }
    else{
        return -1; 
    }
}
?>