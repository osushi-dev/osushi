<?php

App::uses('Controller', 'Controller');

class AssetController extends AppController {

    public $components = array('DebugKit.Toolbar');

    public function index() {
        $this->set('page_title','保有資産');
        $Asset = ClassRegistry::init('Asset');

        $joins = array(
           array(
                'type' => 'inner',
                'table' => 'issuelist',
                'alias' => 'Issuelist',
                'conditions' => array(
                        'Issuelist.policynum = Asset.policynum'
                ),
            )
        );
        $assets = $Asset->find('all',
            array(
                'joins' => $joins,
                'alias' => 'Asset',
                'fields' => Array('Issuelist.name','Issuelist.businesstype','Issuelist.compareyd','Issuelist.stockprice','Asset.num')
        ));
        $total = 0;
        $company_num = 0;

        foreach ( $assets as $asset ){
            $total += $asset['Asset']['num'] * $asset['Issuelist']['stockprice'];
            $company_num += 1;
        }

        $this->set('assets',$assets);
        $this->set('total',$total);
        $this->set('company_num',$company_num);


    }
}
