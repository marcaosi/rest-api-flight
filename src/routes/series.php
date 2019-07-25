<?php

Flight::route("GET /series", function(){
    $db = new Database\DataBase();
    Flight::json($db->get("series"));
});

Flight::route("POST /series", function(){
    $request = Flight::request();
    var_dump($request);

    try{
        $serie = Validations\Serie::validate($request->data);
        
        $db = new Database\DataBase();

        $serie = $db->insert("series", $serie);

        // Flight::json($serie);
    }catch(\Exception $ex){
        Flight::json(array(
            "error" => true,
            "msg" => utf8_encode($ex->getMessage())
        ));
    }
});

Flight::route("DELETE /series/@id", function($id){
    $db = new Database\DataBase();

    $db->delete("series", $id);

    Flight::json([]);
});