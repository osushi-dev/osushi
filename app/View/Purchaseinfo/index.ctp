<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<div class="jumbotron">
    <div class="row">
        <h4 class="headline">あなたの購入履歴</h4>
    </div>
    <div class="list-group">
        <?php
        $before_date = "";
        for( $i = 0; $i < count($purchaseinfos); $i++ ){
            if(strcmp($before_date,$purchaseinfos[$i]['Purchaseinfo']['date']) !== 0){
        ?>
            <h5 class="headline"><?php echo $purchaseinfos[$i]['Purchaseinfo']['date'] ?></h5>
        <?php }
            $before_date = $purchaseinfos[$i]['Purchaseinfo']['date'];
        ?>
        <div href="#" class="list-group-item">
            <div class="row-action-primary">
                <span><?php echo $purchaseinfos[$i]['Issuelist']['name'] ?></span>
            </div>
            <h4 class="list-group-item-heading">
                <?php echo $purchaseinfos[$i]['Item']['name'] ?>
            </h4>
            <div class="list-group-item-text">
                <div align="right">
                    <span>¥ <?php echo $purchaseinfos[$i]['Purchaseinfo']['price'] ?> ,</span>
                    <span><?php echo $purchaseinfos[$i]['Purchaseinfo']['num'] ?> ヶ</span>
                    <h4>取得端株 <?php echo round($purchaseinfos[$i]['Purchaseinfo']['shares'],2) ?></h4>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
