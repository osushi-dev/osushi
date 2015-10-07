<?php

App::uses('Controller', 'Controller');

class DashboardController extends AppController {

    public $components = array('DebugKit.Toolbar');

    public function index() {
        $this->set('page_title','ダッシュボード');
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
                'fields' => Array('Issuelist.name','Issuelist.businesstype','Issuelist.compareyd','Issuelist.stockprice','Asset.num'),
                'order' => array('Asset.num DESC')
        ));

        $series_data  = array();
        $asset_list   = array();
        $asset_other  = array('その他', 0, '-');
        $series_other = array('name' => 'その他', 'drilldown' => 'その他', 'y' => 0);
        $drilldown_other = array();

        for ($i=0; $i < count($assets); $i++) {
            $_asset_list = array();
            array_push($_asset_list, $assets[$i]['Issuelist']['name']);
            array_push($_asset_list, number_format($assets[$i]['Asset']['num'],4));
            if ($i >= 5) {
                $asset_other[1] += floatval($assets[$i]['Asset']['num']);
                $series_other['y'] += floatval($assets[$i]['Asset']['num']);
                array_push($drilldown_other, array($assets[$i]['Issuelist']['name'], floatval($assets[$i]['Asset']['num'])));
            } else {
                if (floatval($assets[$i]['Issuelist']['compareyd']) <= -0.1) {
                    array_push($_asset_list, array($assets[$i]['Issuelist']['compareyd'], array('class' => 'text-blue')));
                } elseif (floatval($assets[$i]['Issuelist']['compareyd']) >= 0.1) {
                    array_push($_asset_list, array($assets[$i]['Issuelist']['compareyd'], array('class' => 'text-red')));
                } else {
                    array_push($_asset_list, $assets[$i]['Issuelist']['compareyd']);
                }
                array_push($asset_list,  $_asset_list);

                array_push($series_data, array(
                    'name' => $assets[$i]['Issuelist']['name'],
                    'drilldown' => $assets[$i]['Issuelist']['name'],
                    'y'    => floatval($assets[$i]['Asset']['num'])
                ));
            }
        }
				$asset_other[1] = number_format($asset_other[1],4);
        array_push($asset_list, $asset_other);
        array_push($series_data, $series_other);

        $this->set('assets', $assets);
        $this->set('asset_list', $asset_list);

				/* 優待情報 */
        $Compinfos = ClassRegistry::init('Compinfos');
        $joins = array(
           array(
                'type' => 'inner',
                'table' => 'issuelist',
                'alias' => 'Issuelist',
                'conditions' => array(
                        'Issuelist.policynum = Compinfos.policynum',
                        'Issuelist.policynum in (2270,2502,3880)',

                ),
            ),
						array(
                'type' => 'inner',
                'table' => 'assets',
                'alias' => 'Assets',
                'conditions' => array(
                        'Compinfos.policynum = Assets.policynum',
                ),
            ),
						array(
								'type' => 'inner',
								'table' => 'items',
								'alias' => 'Items',
								'conditions' => array(
												'Compinfos.flagshipid = Items.id'
								),
						)
        );
        $compinfos = $Compinfos->find('all',
            array(
                'joins' => $joins,
                'alias' => 'Compinfos',
                'fields' => Array('Issuelist.name','Issuelist.stockprice','Compinfos.unitshares','Compinfos.flagshipprice','Compinfos.interestrate','Items.name','Assets.num'),
								'order' => array('Compinfos.id DESC')
        ));

        $this->set('compinfos', $compinfos);


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
                        'name' => "その他",
                        'id' => "その他",
                        'data' => $drilldown_other
                        // 'data' => array(
                        //     array("v10.0", 5.33),
                        //     array("v6.0", 1.06),
                        //     array("v7.0", 0.5)
                        // )
                    )))
        )));
    }
}
