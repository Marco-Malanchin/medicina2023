<?php 

function login($data)
    {
       // $url = 'http://localhost:8080/Progetto-Panini/food-api/API/user/login.php';
        $url = 'http://localhost/medicina2023/medicina-api/api/user/login.php';

        $curl = curl_init($url);    //inizializza una nuova sessione di cUrl
        //Curl contiene il return del curl_init 

        curl_setopt($curl, CURLOPT_URL, $url); // setta l'url 
        curl_setopt($curl, CURLOPT_POST, true); // specifica che è una post request
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // ritorna il risultato come stringa

        $headers = array(
            "Content-Type: application/json",
            "Content-Lenght: 0",
        );


        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // setta gli headers della request

        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        $responseJson = curl_exec($curl);   //eseguo

        curl_close($curl);  //chiudo sessione

        $response = json_decode($responseJson);     //decodifico la response dal json
        if ($response->response == true)        //response == true vuol dire sessione senza errori
        {
            $_SESSION['user_id'] = $response->userID;
            header('Location: pages/index.php');
        }
        else
        {
            return -1;
        }
    }
    function getUser(){
        $url = 'http://localhost/medicina2023/medicina-api/api/user/getUser.php?id='.$_SESSION['user_id'];

        $json_data = file_get_contents($url);
        $res = json_decode($json_data);
        return $res[0]->name; 
    }

    function getAutentication($id){
        $url = 'http://localhost/medicina2023/medicina-api/api/user/getAutentication.php?id='.$id.'';

        $json_data = file_get_contents($url);
        $res = json_decode($json_data);
        return $res[0]->name; 
}
?>