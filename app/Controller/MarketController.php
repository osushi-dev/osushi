<?php

App::uses('Controller', 'Controller');

class MarketController extends AppController {

    public $components = array('DebugKit.Toolbar');

    public function index() {
        $this->set('page_title','OSUSHIマーケット');
    }
}
