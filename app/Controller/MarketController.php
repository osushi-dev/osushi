<?php

App::uses('Controller', 'Controller');

class MarketController extends AppController {

    public $components = array('DebugKit.Toolbar');

    public function index() {
        $this->set('page_title','OSUSHIマーケット');

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

        //Pointの残高を表示する（ponqのwalletの残高を取得する）
        $ponq_url = 'http://api.cashless.life/v1/wallet/balance';
        $data = array(
            'wallet' => $wallet_ID
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
        $this->set('point',$data['content']['balance']['JPY']['amount']);

        //売りだされている端株を取得する
        $Fractionalshare = ClassRegistry::init('Fractionalshare');
        $joins = array(
            array(
                'type' => 'inner',
                'table' => 'issuelist',
                'alias' => 'Stock',
                'conditions' => array(
                        'Fractionalshare.policynum = Stock.policynum'
                ),
            ),
        );
        $shares = $Fractionalshare->find('all',
            array(
                'joins' => $joins,
                'alias' => 'Fractionalshare',
                'fields' => Array('Fractionalshare.id', 'Fractionalshare.policynum', 'Fractionalshare.num', 'Stock.name', 'Stock.stockprice'),
                )
            );
        $this->set('shares',$shares);

    }

    public function buyshare()
    {
        $this->set('page_title','端株購入');
        $this->set('shareid',$this->request->query['shareid']);

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

        //Pointの残高を表示する（ponqのwalletの残高を取得する）
        $ponq_url = 'http://api.cashless.life/v1/wallet/balance';
        $data = array(
            'wallet' => $wallet_ID
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
        $this->set('point',$data['content']['balance']['JPY']['amount']);


        $Fractionalshare = ClassRegistry::init('Fractionalshare');
        $joins = array(
            array(
                'type' => 'inner',
                'table' => 'issuelist',
                'alias' => 'Stock',
                'conditions' => array(
                        'and' => array(
                            'Fractionalshare.policynum = Stock.policynum',
                            'id = ' . $this->request->query['shareid']
                        )
                ),
            ),
        );
        $shares = $Fractionalshare->find('all',
            array(
                'joins' => $joins,
                'alias' => 'Fractionalshare',
                'fields' => Array('Fractionalshare.id', 'Fractionalshare.policynum', 'Fractionalshare.num', 'Stock.name', 'Stock.stockprice'),
                )
            );
        $this->set('shares',$shares);

        $Asset = ClassRegistry::init('Asset');
        $asset_data = $Asset->find('all',
                       array(
                               'fields' => Array('id','num'),
                               'conditions' => array(
                                       'policynum = ' . $shares[0]['Fractionalshare']['policynum']
                               ),
                       ));
        if(!$asset_data){
            $this->set('asset_num', 0);
            $this->set('asset_id', 0);
        }
        else{
            $this->set('asset_num', $asset_data[0]['Asset']['num']);
            $this->set('asset_id', $asset_data[0]['Asset']['id']);
        }
        //本来なら、ここで残高と突き合わせて購入不可ならエラーを返すべき
    }

    public function buyshareresult()
    {
        $this->set('page_title','端株購入結果');

        $Fractionalshare = ClassRegistry::init('Fractionalshare');

        $shares = $Fractionalshare->delete($this->request->data['shareid']);
        $this->set('shares',$shares);

        if($shares){
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
                'from' => $wallet_ID,
                'to' => $osushi_wallet_ID,
                'currency' => 'JPY',
                'amount' => $this->request->data['paying_points']
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


            $Asset = ClassRegistry::init('Asset');
            $asset_data = $Asset->find('all',
                           array(
                                   'fields' => Array('num'),
                                   'conditions' => array(
                                           'id = ' . $this->request->data['assetid']
                                   ),
                           ));
            $this->set('asset_data',$asset_data);

            if(!$asset_data){
                $asset_data_saved = $Asset->save(
                    array ( 'policynum' => $this->request->data['policynum'],
                            'num' => $this->request->data['buying_shares'],
                            'userid' => '1'
                    )
                );
                $assetid_saved = $asset_data_saved['Asset']['id'];
            }
            else{
                $asset_num_before_update = $asset_data[0]['Asset']['num'];
                $asset_data_saved = $Asset->save(
                    array ( 'id' => $this->request->data['assetid'],
                            'num' => ($asset_num_before_update+$this->request->data['buying_shares'])
                    )
                );
                $assetid_saved = $this->request->data['assetid'];
            }
            $this->set('assetid_saved',$assetid_saved);
            $this->set('asset_data_saved',$asset_data_saved);

            $asset_data_updated = $Asset->find('all',
                           array(
                                   'fields' => Array('num'),
                                   'conditions' => array(
                                           'id = ' . $assetid_saved
                                   ),
                           ));
            $this->set('asset_data_updated',$asset_data_updated);
            $this->set('asset_num',$asset_data_updated[0]['Asset']['num']);

            $this->set('policynum',$this->request->data['policynum']);
            $this->set('stockname',$this->request->data['stockname']);
            $this->set('buying_shares',$this->request->data['buying_shares']);
            $this->set('paying_points',$this->request->data['paying_points']);
        }

    }
}
