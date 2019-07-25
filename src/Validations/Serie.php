<?php

namespace Validations;

class Serie{
    public static function validate($serie){
        if(!is_array($serie) && !is_object($serie)) throw new \Exception("Dados inválidos.");

        if(!isset($serie["name"]) || empty($serie["name"])) throw new \Exception("Nome é obrigatório");

        if(!isset($serie["genre"]) || empty($serie["genre"])) throw new \Exception("Gênero é obrigatório");

        $array = array(
            "name" => $serie->name,
            "genre" => $serie->genre,
            "id" => (isset($serie->id)) ? $serie->id : null
        );

        return $array;
    }
}