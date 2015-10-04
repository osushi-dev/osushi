<?php
/*  === add css ===  */
$this->Html->css('pages/landing', null, array('inline' => false));

/*  === add js ===  */
$this->Html->script('pages/landing', array('inline' => false));

?>

<section class="landing-header">
    <div class="landing-header-inner center">
        <div class="container">
            <div class="row">
                <h1 class="brand" id="top-title">OSUSHI</h1>
                <p>投資を身近に。OSUSHIで手軽に。</p>
            </div>
            <div class="row">
                <a class="btn btn-lg btn-primary btn-raised" href="dashboard/">
                    OSUSHIにログインする
                </a>
            </div>
            <div class="row">
                <a class="mt-5 btn btn-lg btn-primary btn-raised" href="dashboard/">
                    新規アカウント作成
                </a>
            </div>
        </div>
    </div>
</section>

<section class="landing-introduction">
    <div class="container">
        <div class="m-30 row center">
            <div class="col-sm-4">
                <i class="m-30 fa fa-shopping-cart fa-3x"></i>
                <p>ポイントカード感覚で株式投資をすることができます。</p>
            </div>
            <div class="col-sm-4">
                <i class="m-30 fa fa-shopping-cart fa-3x"></i>
                <p>ポイントカード感覚で株式投資をすることができます。</p>
            </div>
            <div class="col-sm-4">
                <i class="m-30 fa fa-shopping-cart fa-3x"></i>
                <p>ポイントカード感覚で株式投資をすることができます。</p>
            </div>
        </div>
    </div>
</section>
