<?php

class Conection {
    static public function connect() {
        //PRODUCCION CLOUD
        // $link = new PDO("mysql:host=bhomdhafhc0kz0nel0vv-mysql.services.clever-cloud.com;dbname=bhomdhafhc0kz0nel0vv",
        // "ugdb6r5tpc7tmuoe","IRtGYq1A8m1EOYVzcPIa");

        //BETA LOCAL
        $link = new PDO("mysql:host=localhost;dbname=teoria_decision","root","1423");

        $link->exec("set names utf8");
        return $link;
    }
}