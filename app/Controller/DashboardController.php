<?php

App::uses('Controller', 'Controller');

class DashboardController extends AppController {

    public $components = array('DebugKit.Toolbar');

    public function index() {
        $this->set('page_title','ダッシュボード');

        $Asset = ClassRegistry::init('Asset');
        $assets = $Asset->find('all',
                       array(
                               'fields' => Array('id', 'policynum','num','userid')
                       ));

        $joins = array(
            array(
                'type' => 'inner',
                'table' => 'stocks',
                'alias' => 'Stock',
                'conditions' => array(
                        'Asset.policynum = Stock.policynum'
                ),
            ),
        );
        $tours = $Asset->find('all',
            array(
                'joins' => $joins,
                'alias' => 'Asset',
                'fields' => Array('Asset.id', 'Asset.policynum', 'Asset.num', 'Stock.name'),
                'conditions' => array(
                        'and' => array(
                                array('Asset.userid' => 1)
                        )
                )
        ));

        $this->set('assets',$tours);
    }
}
