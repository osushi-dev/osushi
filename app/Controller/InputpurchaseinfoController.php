<?php

App::uses('Controller', 'Controller');

class InputpurchaseinfoController extends AppController {

    public $components = array('DebugKit.Toolbar');

    public function index() {
        $this->autoRender = false;

        //-JSONデータの受信処理---------------------------------------------------//
        $json = file_get_contents("php://input");
        $data = json_decode($json,true);

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
        $date = new DateTime();
        for($i = 0; $i < $data['NumOfItems']; $i++){
            if($i > 0){
                $Purchaseinfos->create();
            }
            $Purchaseinfos->save(
                 array(
                     'Purchaseinfos' => array(
                         'userid' => $data['Items'][$i]['userid'],
                         'jancode' => $data['Items'][$i]['jancode'],
                         'price' => $data['Items'][$i]['price'],
                         'num' => $data['Items'][$i]['num'],
                         'date' => $date->format('Y-m-d H:i:s')
                     )
                 )
             );
        }
    }

    public function jsonpost(){
        $this->set('page_title','購入者情報送信');

    }
}
