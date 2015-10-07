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

        <form action="/asset/buyfractionresult" method="post">
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
                    <td><input type="text" name="buynum" value="<?php echo $assets[0]['Asset']['num']?>"></td>
                </tr>
                 <tr>
                    <td>株価</td>
                    <td><?php echo $assets[0]['Issuelist']['stockprice']?> 円</td>
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
                    <input type="hidden" name="assetid" value="<?php echo $asset_id?>">
                    <input type="hidden" name="policynum" value="<?php echo $assets[0]['Issuelist']['policynum']?>">
                    <input type="hidden" name="buying_assets" value="<?php echo $assets[0]['Asset']['num']?>">
                    <input type="hidden" name="stockprice" value="<?php echo $assets[0]['Issuelist']['stockprice']?>">
                    <input type="submit" class="btn btn-danger" style="width:100%;" value="売却する">
                </form>
            </div>
        </div>
    </div>
</div>
