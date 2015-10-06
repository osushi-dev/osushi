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
				$total_asset = array(
						'total' => $total,
						'numofcomp' => $company_num
				);

        $this->set('assets',$assets);
				$this->set('total_asset', $total_asset);

				$asset_list  = array();

				foreach ( $assets as $HoldingsList ){
						$_asset_list = array();
						array_push($_asset_list, $HoldingsList['Issuelist']['name']);
						array_push($_asset_list, $HoldingsList['Issuelist']['businesstype']);
						array_push($_asset_list, $HoldingsList['Asset']['num']);
						array_push($_asset_list, $HoldingsList['Issuelist']['stockprice']);
						if (floatval($HoldingsList['Issuelist']['compareyd']) <= -0.1) {
							array_push($_asset_list, array($HoldingsList['Issuelist']['compareyd'], array('class' => 'text-blue')));
						} elseif (floatval($HoldingsList['Issuelist']['compareyd']) >= 0.1) {
							array_push($_asset_list, array($HoldingsList['Issuelist']['compareyd'], array('class' => 'text-red')));
						} else {
							array_push($_asset_list, $HoldingsList['Issuelist']['compareyd']);
						}
						array_push($asset_list,  $_asset_list);
				}
				$this->set('asset_list', $asset_list);
    }
}
