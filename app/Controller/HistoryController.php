<?php

App::uses('Controller', 'Controller');

class HistoryController extends AppController {

    public $components = array('DebugKit.Toolbar');

    public function index() {
        $this->set('page_title','購買履歴');
        $History = ClassRegistry::init('History');

        //$histories = $History->find('all',
        //        array(
        //            'fields' => Array('jancode','name','date','policynum')
        //            ));

        $joins = array(
            array(
                'type' => 'inner',
                'table' => 'stocks',
                'alias' => 'Stock',
                'conditions' => array(
                        'History.policynum = Stock.policynum'
                ),
            ),
        );
        $histories = $History->find('all',
            array(
                'joins' => $joins,
                'alias' => 'History',
                'fields' => Array('History.id', 'History.jancode', 'History.name', 'History.date', 'Stock.name'),
        ));


        $this->set('histories',$histories);
    }
}
