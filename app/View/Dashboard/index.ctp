<?php
/*  === add css ===  */
$this->Html->css('components/slick', array('inline' => false));
$this->Html->css('pages/dashboard', array('inline' => false));

/*  === add js ===  */
$this->Html->script('slick.min', array('inline' => false));
$this->Html->script('components/slick', array('inline' => false));
$this->Html->script('pages/dashboard', array('inline' => false));
?>

<script type="text/javascript" src="//code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="//code.highcharts.com/modules/data.js"></script>
<script type="text/javascript" src="//code.highcharts.com/modules/drilldown.js"></script>
<script type="text/javascript">
    $(function () {
        $('#capital_holdings').highcharts(<?php echo $capital_holdings ?>);
    });
</script>

<div class="mt-20 container dashboard">
    <div class="row">
        <h4 class="headline">あなたにオススメ！</h4>
        <div class="mb-10 carousel">
            <div class="recommend-item" style="background-image:url('http://hp.knowledge-works.co.jp/wp-content/uploads/2012/06/Fujiya_Milky.jpg')">
                <div class="overlay"></div>
                <div class="ribbon"><span>POPULAR</span></div>
                <p class="recommend-item-brand">不二家</p>
                <p class="recommend-item-name">ミルキー</p>
                <p class="recommend-item-price">￥148</p>
            </div>
            <div class="recommend-item" style="background-image:url('http://livedoor.blogimg.jp/ftmember/imgs/7/b/7bf3fde8.jpg')">
                <div class="overlay"></div>
                <p class="recommend-item-brand">MEGMILK</p>
                <p class="recommend-item-name">牛乳</p>
                <p class="recommend-item-price">￥198</p>
            </div>
            <div class="recommend-item" style="background-image:url('https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcToga8O-LF_M9Rg2ttr9aWL7_7q_aEUdKqHoukCp4Cz7RTXg2k-jg')">
                <div class="overlay"></div>
                <p class="recommend-item-brand">日清食品</p>
                <p class="recommend-item-name">ラ王</p>
                <p class="recommend-item-price">￥148</p>
            </div>
            <div class="recommend-item" style="background-image:url('https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSvS1f7Rrgc3jJxYryoUFYhUsxX8ewmpk6XWvD1neVUi02pmzpV')">
                <div class="overlay"></div>
                <p class="recommend-item-brand">アサヒ</p>
                <p class="recommend-item-name">スーパードライ</p>
                <p class="recommend-item-price">￥798</p>
            </div>
            <div class="recommend-item" style="background-image:url('http://www.banbix.com/assets_c/2012/03/w_elleair12r8-thumb-260x300-711.jpg')">
                <div class="overlay"></div>
                <p class="recommend-item-brand">大王製紙</p>
                <p class="recommend-item-name">エリエール</p>
                <p class="recommend-item-price">￥298</p>
            </div>
        </div>
    </div>

    <div class="row">
        <h4 class="headline">もうすぐ優待！</h4>
        <div class="bonus">
            <p>
                アサヒ飲料: <span class="attention">あとアサヒスーパードライ3ケースで優待！</span>
            </p>
            <div class="bonus-meter">
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer"></i>
                <i class="fa fa-beer"></i>
                <i class="fa fa-beer"></i>
            </div>
        </div>
        <div class="bonus">
            <p>
                アサヒ飲料: <span class="attention">あとアサヒスーパードライ3ケースで優待！</span>
            </p>
            <div class="bonus-meter">
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer"></i>
                <i class="fa fa-beer"></i>
                <i class="fa fa-beer"></i>
            </div>
        </div>
        <div class="bonus">
            <p>
                アサヒ飲料: <span class="attention">あとアサヒスーパードライ4ケースで優待！</span>
            </p>
            <div class="bonus-meter">
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer active"></i>
                <i class="fa fa-beer"></i>
                <i class="fa fa-beer"></i>
                <i class="fa fa-beer"></i>
                <i class="fa fa-beer"></i>
            </div>
        </div>
    </div>

    <div class="row">
        <h4 class="headline">保有銘柄一覧</h4>
        <div class="col-sm-6">
            <div id="capital_holdings" style="width:100%; height:400px;"></div>
        </div>
        <div class="col-sm-6">
            <table>
                <?php echo $this->Html->tableHeaders(array('タイトル', '値段')) . PHP_EOL; ?>
                <?php echo $this->Html->tableCells($asset_list) . PHP_EOL; ?>
            </table>
        </div>
    </div>
</div>
