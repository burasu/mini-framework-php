<?php

class HomeController {

    public function indexAction()
    {
//        return "hola";

        return new View('home', ['titulo' => 'Mini Framework PHP']);
    }

}