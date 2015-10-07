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
                'fields' => Array('Issuelist.name','Issuelist.businesstype','Issuelist.compareyd','Issuelist.stockprice','Asset.num','Asset.id','Issuelist.policynum')
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
							array_push($_asset_list, array($HoldingsList['Issuelist']['compareyd'], array('class' => '')));
						}
						array_push($_asset_list, '<a class="btn btn-sm btn-primary">売</a>');
                        array_push($_asset_list, $HoldingsList['Issuelist']['policynum']);
                        array_push($asset_list,  $_asset_list);
				}
				$this->set('asset_list', $asset_list);
				$this->set('assets', $assets);
    }

    public function buy_fraction() {
        $Asset = ClassRegistry::init('Asset');
        $this->set('page_title','端株売却');
        $this->set('asset_id',$this->request->query['asset_id']);
        $joins = array(
           array(
                'type' => 'inner',
                'table' => 'issuelist',
                'alias' => 'Issuelist',
                'conditions' => array(
                    'and' => array(
                        'Issuelist.policynum = Asset.policynum',
                        'Asset.id = '. $this->request->query['asset_id'] )
                ),
            )
        );
        $assets = $Asset->find('all',
            array(
                'joins' => $joins,
                'alias' => 'Asset',
                'fields' => Array('Issuelist.name','Issuelist.businesstype','Issuelist.compareyd','Issuelist.stockprice','Asset.num','Asset.id','Issuelist.policynum')
        ));
        $this->set('assets',$assets);

    }
    public function buyfractionresult() {

        $this->set('page_title','端株売却結果');
	    $Assets = ClassRegistry::init('Asset');
	    $Fractionalshares = ClassRegistry::init('Fractionalshares');

        $paying_points = $this->request->data['stockprice']*$this->request->data['buying_assets'];
        $API_Token = "APT-02ef7c27-2e4f-4305-b73f-a731daa30c04";

        //ユーザ情報のテーブルからwallet_idを取得
        $User = ClassRegistry::init('User');
        $user_data = $User->find('all',
                       array(
                               'fields' => Array('wallet_id'),
                               'conditions' => array(
                                       'id = 1'
                               ),
                       ));
        $this->set('user_data', $user_data);
        $wallet_ID = $user_data[0]['User']['wallet_id'];
        $osushi_wallet_ID = "WAL-8c576273-d118-45ad-b1cc-866769cd1c80";

        //Pointの残高を表示する（ponqのwalletの残高を取得する）
        $ponq_url = 'http://api.cashless.life/v1/money/remittance';
        $data = array(
            'from' => $osushi_wallet_ID,
            'to' => $wallet_ID,
            'currency' => 'JPY',
            'amount' => $this->request->data['stockprice']*$this->request->data['buynum']
        );
        $headers = array(
            'Content-Type: application/x-www-form-urlencoded',
            'X-Cashless-API-Token: ' . $API_Token
        );
        $options = array('http' => array(
            'method' => 'POST',
            'content' => http_build_query($data),
            'header' => implode("\r\n", $headers),
        ));
        $contents = file_get_contents($ponq_url, false, stream_context_create($options));
        $data = json_decode($contents,true);

        $this->set('balance',$contents);
        $this->set('point',$data['remittance']['withdrawal']['target']['new_balance']);



        $Fractionalshares->save(
            array(
                    'policynum' => $this->request->data['policynum'],
                    'num' => $this->request->data['buynum']
            )
        );
            $Assets->save(
                array(
                   'id' => $this->request->data['assetid'],
                   'num' => $this->request->data['buying_assets']-$this->request->data['buynum'],
                )
            );
        

        $joins = array(
           array(
                'type' => 'inner',
                'table' => 'issuelist',
                'alias' => 'Issuelist',
                'conditions' => array(
                    'and' => array(
                        'Issuelist.policynum = Asset.policynum',
                        'Asset.id = '. $this->request->data['assetid'] )
                ),
            )
        );
        $assets = $Assets->find('all',
            array(
                'joins' => $joins,
                'alias' => 'Asset',
                'fields' => Array('Issuelist.name','Issuelist.businesstype','Issuelist.compareyd','Issuelist.stockprice','Asset.num','Asset.id','Issuelist.policynum')
        ));
        $this->set('assets',$assets);
        if ( $this->request->data['buying_assets']-$this->request->data['buynum'] <= 0 ){
            $Assets->delete($this->request->data['assetid']);
        }

    }
}
