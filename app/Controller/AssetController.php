<?php

App::uses('Controller', 'Controller');

class AssetController extends AppController {

    public $components = array('DebugKit.Toolbar');

    public function index() {
        $this->set('page_title','保有資産');

    }
}
