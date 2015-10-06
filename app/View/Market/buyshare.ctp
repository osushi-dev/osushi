<?php
$this->Html->css('components/slick', array('inline' => false));
$this->Html->css('pages/market', array('inline' => false));

$this->Html->script('slick.min', array('inline' => false));
$this->Html->script('components/slick', array('inline' => false));
?>

<div class="container">

    <div class="jumbotron">

        <div class="row">
            <h4 class="headline">端株購入　確認</h4>
        </div>

        <span>
            下記の内容で端株を購入します。
        </span>

        <table class="table table-striped">
            <tbody>
                <tr>
                    <td>銘柄コード</td>
                    <td><?php echo $shares[0]['Fractionalshare']['policynum']?></td>
                </tr>
                <tr>
                    <td>銘柄名</td>
                    <td><?php echo $shares[0]['Stock']['name']?></td>
                </tr>
                <tr>
                    <td>購入端株数</td>
                    <td><?php echo $shares[0]['Fractionalshare']['num']?></td>
                </tr>
                <tr>
                    <td>購入後端株数</td>
                    <td><?php echo ($asset_num+$shares[0]['Fractionalshare']['num'])?></td>
                </tr>
                <tr>
                    <td>支払いポイント</td>
                    <td><?php echo ceil($shares[0]['Stock']['stockprice']*$shares[0]['Fractionalshare']['num'])?> pt</td>
                </tr>
                <tr>
                    <td>購入後ポイント残高</td>
                    <td><?php echo ($point - $shares[0]['Stock']['stockprice']*$shares[0]['Fractionalshare']['num'])?> pt</td>
                </tr>
            </tbody>
        </table>
        <span>
            上記の内容でよろしければ、「購入する」ボタンを押して購入してください。
        </span>

        <div class="row">
            <div class="col-xs-6">
                <a href="/market" class="btn btn-info" style="width:100%">マーケットに戻る</a>
            </div>
            <div class="col-xs-6">
                <form action="/market/buyshareresult" method="post">
                    <input type="hidden" name="shareid" value="<?php echo $shareid?>">
                    <input type="hidden" name="assetid" value="<?php echo $asset_id?>">
                    <input type="hidden" name="policynum" value="<?php echo $shares[0]['Fractionalshare']['policynum']?>">
                    <input type="hidden" name="stockname" value="<?php echo $shares[0]['Stock']['name']?>">
                    <input type="hidden" name="buying_shares" value="<?php echo $shares[0]['Fractionalshare']['num']?>">
                    <input type="hidden" name="paying_points" value="<?php echo ceil($shares[0]['Stock']['stockprice']*$shares[0]['Fractionalshare']['num'])?>">
                    <input type="submit" class="btn btn-danger" style="width:100%;" value="購入する">
                </form>
            </div>
        </div>
    </div>
</div>
