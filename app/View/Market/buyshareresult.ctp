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
                    <td><?php echo $policynum?></td>
                </tr>
                <tr>
                    <td>銘柄名</td>
                    <td><?php echo $stockname?></td>
                </tr>
                <tr>
                    <td>購入端株数</td>
                    <td><?php echo $buying_shares?><td>
                </tr>
                <tr>
                    <td>購入後端株数</td>
                    <td><?php echo ($asset_num)?></td>
                </tr>
                <tr>
                    <td>支払いポイント</td>
                    <td><?php echo ($paying_points)?> pt</td>
                </tr>
                <tr>
                    <td>購入後ポイント残高</td>
                    <td><?php echo ($point)?> pt</td>
                </tr>
            </tbody>
        </table>

        <a href="/market" class="btn btn-info" style="width:100%">マーケットに戻る</a>

        </div>
</div>
