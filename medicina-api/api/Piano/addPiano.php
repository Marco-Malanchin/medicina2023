<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once dirname(__FILE__) . '/../../common/connect.php';
    include_once dirname(__FILE__) . '/../../model/piano.php';

    $database = new Database();
    $db = $database->connect();

    $data = json_decode(file_get_contents("php://input"));

    if(empty($data) || empty($data->codice) || empty($data->nome)  || empty($data->cfu)){
        http_response_code(400);
        die(json_encode(array("Message" => "Bad request")));
    }

    $piano = new Piano($db);
    
    if($piano->addPiano($data->codice, $data->nome, $data->cfu, $data->settore, $data->n_settore, $data->taf_ambito, $data->ore_lezione, $data->ore_laboratorio, $data->ore_tirocinio, $data->tipo_insegnamento, $data->semestre, $data->descrizione_semestre, $data->anno1, $data->anno2,) > 0)
    {
        http_response_code(201);
        echo json_encode(array("Message"=> "Created"));
    }
    else
    {
        http_response_code(503);
        echo json_encode(array("Message"=>'Error'));
    }

?>