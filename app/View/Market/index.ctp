<?php
$this->Html->css('components/slick', array('inline' => false));
$this->Html->css('pages/market', array('inline' => false));

$this->Html->script('slick.min', array('inline' => false));
$this->Html->script('components/slick', array('inline' => false));
?>

<div class="container main-component">
    <div class="row">
        <h4 class="headline">OSUSHIポイント</h4>
        <p align="right">
            <?php echo $point?> pt
        </p>
    </div>

    <div class="row">
        <h4 class="headline">あなたにオススメ！</h4>
        <div class="mb-10 carousel">
            <a href="#item-2211" class="recommend-item" style="background-image:url('http://hp.knowledge-works.co.jp/wp-content/uploads/2012/06/Fujiya_Milky.jpg')">
                <div class="overlay"></div>
                <p class="recommend-item-brand">不二家</p>
                <!--2211-->
            </a>
            <a href="#item-2270" class="recommend-item" style="background-image:url('http://livedoor.blogimg.jp/ftmember/imgs/7/b/7bf3fde8.jpg')">
                <div class="overlay"></div>
                <p class="recommend-item-brand">MEGMILK</p>
                <!--2270-->
            </a>
            <a href="#item-2897" class="recommend-item" style="background-image:url('https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcToga8O-LF_M9Rg2ttr9aWL7_7q_aEUdKqHoukCp4Cz7RTXg2k-jg')">
                <div class="overlay"></div>
                <p class="recommend-item-brand">日清食品</p>
                <!--2897-->
            </a>
            <a href="#item-2502" class="recommend-item" style="background-image:url('https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSvS1f7Rrgc3jJxYryoUFYhUsxX8ewmpk6XWvD1neVUi02pmzpV')">
                <div class="overlay"></div>
                <p class="recommend-item-brand">アサヒ グループホールディングス</p>
                <!--2502-->
            </a>
            <a href="#item-3880" class="recommend-item" style="background-image:url('http://www.banbix.com/assets_c/2012/03/w_elleair12r8-thumb-260x300-711.jpg')">
                <div class="overlay"></div>
                <p class="recommend-item-brand">大王製紙</p>
                <!--3880-->
            </a>
        </div>
    </div>

    <div class="row">
        <h4 class="headline">売出し中！</h4>

        <ul class="list-group">
            <?php for($i = 0; $i < count($shares); $i++){ ?>
                <li class="list-group-item" id="item-<?php echo $shares[$i]['Fractionalshare']['policynum']?>">
                    <p>
                        <span><?php echo $shares[$i]['Fractionalshare']['policynum']?> </span>
                        <span><?php echo $shares[$i]['Stock']['name']?></span>
                    </p>
                    <p align="right">
                        <span>
                            <span class="share-label">端株数</span> <span class="share-num"><?php echo $shares[$i]['Fractionalshare']['num']?></span>
                        </span>
                    </p>
                    <a href="/market/buyshare?shareid=<?php echo $shares[$i]['Fractionalshare']['id']?>" class="btn btn-warning btn-lg" style="width:100%">
                        <?php echo ceil($shares[$i]['Stock']['stockprice']*$shares[$i]['Fractionalshare']['num'])?> ptで買う
                        </a>
                </li>
                <?php }?>
        </ul>
    </div>

</div>
