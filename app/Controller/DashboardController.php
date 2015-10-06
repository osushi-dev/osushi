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
        // $joins = array(
        //     array(
        //         'type' => 'inner',
        //         'table' => 'stocks',
        //         'alias' => 'Stock',
        //         'conditions' => array(
        //                 'Asset.policynum = Stock.policynum'
        //         ),
        //     ),
        // );
        // $tours = $Asset->find('all',
        //     array(
        //         'joins' => $joins,
        //         'alias' => 'Asset',
        //         'fields' => Array('Asset.id', 'Asset.policynum', 'Asset.num', 'Stock.name'),
        //         'conditions' => array(
        //                 'and' => array(
        //                         array('Asset.userid' => 1)
        //                 )
        //         )
        //     ));

        $series_data = array();

        foreach ($assets as &$value) {
            array_push($series_data, array(
                'name' => $value['Issuelist']['name'],
                'drilldown' => $value['Issuelist']['name'],
                'y'    => intval($value['Asset']['num'])
            ));
        }

        $this->set('assets', $assets);
        $this->set('capital_holdings',
            json_encode(array(
                'title' => '',
                'chart' => array('type' => 'pie'),
                'plotOptions' => array(
                    'series' => array(
                        'dataLabels' => array(
                            'enabled' => true,
                            'format' => '{point.name}'
                        )
                    )
                ),
                'xAxis' => array(
                    'labels' => array(
                        'enabled' => false
                    )
                ),
                'yAxis' => array(
                    'labels' => array(
                        'enabled' => false
                    )
                ),
                'tooltip' => array(
                    'headerFormat' => '<span style="font-size:11px">{series.name}</span><br>',
                    'pointFormat' => '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}株</b> of total<br/>'
                ),
                'series' => array(array(
                    'name' => "Brands",
                    'colorByPoint' => true,
                    'data' => $series_data
                )),
                'drilldown' => array(
                    'series' => array(array(
                        'name' => "Microsoft Internet Explorer",
                        'id' => "Microsoft Internet Explorer",
                        'data' => array(
                            array("v11.0", 24.13),
                            array("v8.0", 17.2),
                            array("v9.0", 8.11),
                            array("v10.0", 5.33),
                            array("v6.0", 1.06),
                            array("v7.0", 0.5)
                        )
                    )))
        )));
    }
}
