<?php
namespace Database;

class Database{
    private $db;
    private $uriDB;

    public function __construct($uriDB = 'db.json'){
        $this->db = json_decode(file_get_contents($uriDB), true);
        $this->uriDB = $uriDB;
    }

    public function get($entity, $params = array()){
        if(!is_array($params)) throw new Exception("Parâmetros enviados incorretamente.");
        if(empty($entity) || is_null($entity)) throw new \Exception("Necessário enviar nome da entidade a ser buscada.");

        $return = $this->db[$entity];
        return $return;
    }

    public function insert($entity, $data){
        if(empty($entity) || !is_array($data)) throw new \Exception("Parâmetros inválidos");

        if(!isset($data["id"]) || empty($data["id"])) $data["id"] = time();

        $this->db[$entity][] = $data;

        \file_put_contents($this->uriDB, \json_encode($this->db));
        return $data;
    }

    public function delete($entity, $id){
        if(empty($entity) || empty($id)) throw new \Exception("Parâmetros inválidos");

        $array = array();
        foreach($this->db[$entity] as $element){
            if($element["id"] != $id){
                array_push($array, $element);
            }
        }

        $this->db[$entity] = $array;
        \file_put_contents($this->uriDB, \json_encode($this->db));
    }
}