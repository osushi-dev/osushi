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
                <a class="btn btn-transparent btn-raised" href="dashboard/">
                    OSUSHIにログインする
                </a>
            </div>
        </div>
    </div>
</section>

<section class="landing-introduction">
    <div class="container">
        <div class="m-30 row center">
            <div class="col-sm-4">
                <i class="m-30 fa fa-dollar fa-4x"></i>
                <p>資金の準備無しに株式投資を始めることができます。</p>
            </div>
            <div class="col-sm-4">
                <i class="m-30 fa fa-shopping-cart fa-4x"></i>
                <p>日々の買い物で株式投資ができるため、時間が必要ありません。</p>
            </div>
            <div class="col-sm-4">
                <i class="m-30 fa fa-desktop fa-4x"></i>
                <p>直感的なUI、シンプルな情報を提供しているため、難しい理解が必要ありません。</p>
            </div>
        </div>
    </div>
</section>
