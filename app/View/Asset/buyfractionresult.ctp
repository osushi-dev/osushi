<?php
$this->Html->css('components/slick', array('inline' => false));
$this->Html->css('pages/market', array('inline' => false));

$this->Html->script('slick.min', array('inline' => false));
$this->Html->script('components/slick', array('inline' => false));
?>

<div class="container">

    <div class="jumbotron">

        <div class="row">
            <h4 class="headline">端株購入結果　確認</h4>
        </div>

        <span>
            下記の内容で端株を購入しました。
        </span>

        <table class="table table-striped">
            <tbody>
                <tr>
                    <td>銘柄コード</td>
                    <td><?php echo $assets[0]['Issuelist']['policynum']?></td>
                </tr>
                <tr>
                    <td>銘柄名</td>
                    <td><?php echo $assets[0]['Issuelist']['name']?></td>
                </tr>
                <tr>
                    <td>保有端株数</td>
                    <td><?php echo $assets[0]['Asset']['num']?></td>
                </tr>
                <tr>
                    <td>売却端株数</td>
                    <td><?php echo $this->request->data['buynum']?></td>
                </tr>
            </tbody>
        </table>

        <a href="/market" class="btn btn-info" style="width:100%">マーケットに戻る</a>

        </div>
</div>
