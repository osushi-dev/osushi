<?php

App::uses('Controller', 'Controller');

class PurchaseinfoController extends AppController {

    public $components = array('DebugKit.Toolbar');

    public function index() {
        $this->set('page_title','購買履歴');
        $Purchaseinfo = ClassRegistry::init('Purchaseinfo');

        //$purchaseinfos = $Purchaseinfo->find('all',
        //        array(
        //            'fields' => Array('jancode','name','date','policynum')
        //            ));

        $joins = array(
           array(
                'type' => 'inner',
                'table' => 'items',
                'alias' => 'Item',
                'conditions' => array(
                        'Purchaseinfo.jancode = Item.jancode'
                ),
            ),
            array(
                'type' => 'inner',
                'table' => 'issuelist',
                'alias' => 'Issuelist',
                'conditions' => array(
                        'Item.policynum = Issuelist.policynum'
                ),
            )
        );
        $purchaseinfos = $Purchaseinfo->find('all',
            array(
                'joins' => $joins,
                'alias' => 'Purchaseinfo',
                'fields' => Array('Purchaseinfo.id', 'Purchaseinfo.jancode', 'Purchaseinfo.price', 'Purchaseinfo.num', 'Purchaseinfo.date', 'Issuelist.name','Item.name'),
        ));

        $this->set('purchaseinfos',$purchaseinfos);
    }
}
