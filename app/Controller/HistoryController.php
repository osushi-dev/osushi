<?php

App::uses('Controller', 'Controller');

class HistoryController extends AppController {

    public $components = array('DebugKit.Toolbar');

    public function index() {
        $this->set('page_title','購買履歴');

    }
}
