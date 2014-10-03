<?php

class HomeController {

    public function indexAction()
    {
//        return "hola";

        return new View('home', ['titulo' => 'This is Sparta....!!!!']);

    }

}