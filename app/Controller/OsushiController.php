<?php

App::uses('Controller', 'Controller');

class OsushiController extends AppController {

    public $components = array('DebugKit.Toolbar');

    public function index() {
        $this->set('page_title','トップ');
    }
}
