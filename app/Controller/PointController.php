<?php

App::uses('Controller', 'Controller');

class PointController extends AppController {

    public $components = array('DebugKit.Toolbar');

    public function payment() {
        $this->set('page_title','OSUSHIポイント交換');
    }

    public function paymentresult() {
        $this->set('page_title','OSUSHIポイント交換結果');

        $paied = $this->request->data['payment'];

        $API_Token = "APT-e8d43bda-f732-4c0e-bbd6-3d0ba518d9e8";

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

        //預金APIを実行
        $ponq_url = 'http://api.cashless.life/v1/money/deposit';
        $data = array(
            'from' => 'ext',
            'to' => $wallet_ID,
            'currency' => 'JPY',
            'amount' => $paied
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

        $this->set('status','SUCCESS');
        $this->set('contents',$contents);
        $this->set('paied',$paied);
    }

}
