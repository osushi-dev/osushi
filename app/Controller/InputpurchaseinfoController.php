<?php

App::uses('Controller', 'Controller');

class InputpurchaseinfoController extends AppController {

    public $components = array('DebugKit.Toolbar');

    public function index() {
        $this->autoRender = false;

        //-JSONデータの受信処理---------------------------------------------------//
        $json = file_get_contents("php://input");
        $data = json_decode($json);

        $this->response->type('json');
        $this->response->body($json);

        $Purchaseinfos = ClassRegistry::init('Purchaseinfos');
        $Purchaseinfos->save(
             array(
                 'Purchaseinfos' => array(
                     'userid' => $data->{'userid'},
                     'jancode' => $data->{'jancode'},
                     'price' => $data->{'price'}
                 )
             )
         );
        $this->set('json_data', $json);
    }

    public function jsonpost(){
        $this->set('page_title','購入者情報送信');

    }
}
