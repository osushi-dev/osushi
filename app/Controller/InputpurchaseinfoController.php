<?php

App::uses('Controller', 'Controller');

class InputpurchaseinfoController extends AppController {

    public $components = array('DebugKit.Toolbar');

    public function index() {
        $this->autoRender = false;

        //-JSONデータの受信処理---------------------------------------------------//
        $json = file_get_contents("php://input");
        $jdata = json_decode($json,true);

        $this->response->type('json');
        $this->response->body($json);

        //受信可能JSONデータサンプル
        // {"NumOfItems":2,
        //     "Items":[
        //         {"userid":"1",
        //             "price":"89",
        //             "jancode":"4902011711387"
        //         },
        //         {"userid":"1",
        //             "price":"89",
        //             "jancode":"4902011711387"}
        //             ]
        //         }

        $Purchaseinfos = ClassRegistry::init('Purchaseinfos');
        $Items = ClassRegistry::init('Items');
	$Asset = ClassRegistry::init('Asset');
	$date = new DateTime();

	/*
	$joins = array(
		array(
                	'type' => 'inner',
                	'table' => 'issuelist',
                	'alias' => 'Issuelist',
                	'conditions' => array(
                        	'Items.policynum = Issuelist.policynum'
                	)
            	)
	);

	//jsoncodeから銘柄コードと前日終値を取得
	$pninfo = $Items->find('all',
				array(
					'joins' => $joins,
					'alias' => 'Items',	
					//'conditions' => array('jancode'=> $data['Items'][$i]['jancode'])
					'conditions' => array('Items.jancode'=>'4901085167380'),
					'fields' => array('Items.policynum','Issuelist.lastclose')
			        )
		      	);

	//Var_dump($pninfo);
	//Var_dump($pninfo[0]['Items']['policynum']);

	//ログインユーザが対象の銘柄のAssetがあるか確認
	$assetnum = $Asset->find('count',
				array(
					'conditions' => array(
						'userid' => '1',
						//'userid' => $data['Items'][$i]['userid'], 
						'policynum' => $pninfo[0]['Items']['policynum']
					)
				)
			);

	if($assetnum > 0){
		//echo "update";
		//Asset情報取得
		$assetinfo = $Asset->find('all',
			array(
				'conditions' => array(
					'userid' => '1',
                                       	//'userid' => $data['Items'][$i]['userid'], 
                                   	'policynum' => $pninfo[0]['Items']['policynum']
				)
			)
		);

		//追加分を算出
		$addstocknum = 1000/$pninfo[0]['Issuelist']['lastclose'];
		//$addstocknum = $data['Items'][$i]['price']*$data['Items'][$i]['num']/$pninfo[0]['Issuelist']['lastclose'];
		$newstocknum = $addstocknum + $assetinfo[0]['Asset']['num'];
		//Var_dump($assetinfo[0]['Asset']['id']);

		//更新
		$data= array(
			'id' => $assetinfo[0]['Asset']['id'],
			'num' => $newstocknum 
			);
		$fields = array('num');
		$Asset->save( $data, false, $fields );
		

	}else{
		//echo "insert";
		$addstocknum = 1000/$pninfo[0]['Issuelist']['lastclose'];
                //$addstocknum = $data['Items'][$i]['price']*$data['Items'][$i]['num']/$pninfo[0]['Issuelist']['lastclose'];
                $Asset->save(
			array(
				'Asset' => array(
					'policynum' => $pninfo[0]['Items']['policynum'],
					'num' => $addstocknum,
					'userid' => '1'
                                    	//'userid' => $data['Items'][$i]['userid']
				)
			)
		);

	}
	*/

        for($i = 0; $i < $jdata['NumOfItems']; $i++){
            if($i > 0){
                $Purchaseinfos->create();
         	$Asset->create();   
		$Items->create();
	    }
            $Purchaseinfos->save(
                 array(
                     'Purchaseinfos' => array(
                         'userid' => $jdata['Items'][$i]['userid'],
                         'jancode' => $jdata['Items'][$i]['jancode'],
                         'price' => $jdata['Items'][$i]['price'],
                         'num' => $jdata['Items'][$i]['num'],
                         'date' => $date->format('Y-m-d H:i:s')
                     )
                 )
             );
//////////////
	$joins = array(
                array(
                        'type' => 'inner',
                        'table' => 'issuelist',
                        'alias' => 'Issuelist',
                        'conditions' => array(
                                'Items.policynum = Issuelist.policynum'
                        )
                )
        );
        //jsoncodeから銘柄コードと前日終値を取得
        $pninfo = $Items->find('all',
                                array(
                                        'joins' => $joins,
                                        'alias' => 'Items',     
                                        'conditions' => array('Items.jancode'=> $jdata['Items'][$i]['jancode']),
                                        //'conditions' => array('Items.jancode'=>'4901085167380'),
                                        'fields' => array('Items.policynum','Issuelist.lastclose')
                                )
      	);
        //Var_dump($pninfo);
        //Var_dump($pninfo[0]['Items']['policynum']);
        //ログインユーザが対象の銘柄のAssetがあるか確認
        $assetnum = $Asset->find('count',
                                array(
                                        'conditions' => array(
                                                'userid' => '1',
                                                //'userid' => $data['Items'][$i]['userid'], 
                                                'policynum' => $pninfo[0]['Items']['policynum']
                                        )
                                )
     	);
	if($assetnum > 0){
	                //echo "update";
	                //Asset情報取得
	                $assetinfo = $Asset->find('all',
		                        array(
		                                'conditions' => array(
		                                        'userid' => '1',
		                                        //'userid' => $data['Items'][$i]['userid'], 
		                                        'policynum' => $pninfo[0]['Items']['policynum']
		                                )
		                        )
		    	);
	                //追加分を算出
	                //$addstocknum = 1000/$pninfo[0]['Issuelist']['lastclose'];
	                $addstocknum = $jdata['Items'][$i]['price']*$jdata['Items'][$i]['num']/$pninfo[0]['Issuelist']['lastclose'];
	                $newstocknum = $addstocknum + $assetinfo[0]['Asset']['num'];
	                //Var_dump($assetinfo[0]['Asset']['id']);
	                //更新
	                $data= array(
	                        'id' => $assetinfo[0]['Asset']['id'],
	                        'num' => $newstocknum 
 	       		);
		      	$fields = array('num');
		  	$Asset->save( $data, false, $fields );
	}else{
	                //echo "insert";
	                //$addstocknum = 1000/$pninfo[0]['Issuelist']['lastclose'];
	                $addstocknum = $jdata['Items'][$i]['price']*$jdata['Items'][$i]['num']/$pninfo[0]['Issuelist']['lastclose'];
	                $Asset->save(
	                        array(
	                                'Asset' => array(
	                                        'policynum' => $pninfo[0]['Items']['policynum'],
	                                        'num' => $addstocknum,
	                                        'userid' => '1'
	                                        //'userid' => $data['Items'][$i]['userid']
	                                )
	                        )
	                );
        }
/////////////
        }
    }

    public function jsonpost(){
        $this->set('page_title','購入者情報送信');

    }
}
