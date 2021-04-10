<?php

class Conection {
    static public function connect() {
        $link = new PDO("mysql:host=localhost;dbname=teoria_decision","root","1423");

        $link->exec("set names utf8");
        return $link;
    }
}