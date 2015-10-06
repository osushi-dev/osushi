<div class="container">

    <div class="jumbotron">
        <h4>入金確認</h4>

        <p>
            <?php if(strcmp($status, 'ERROR') === 0){ ?>
                OSUSHIポイントの交換に失敗しました。管理者に連絡してください。
            <?php } else if(strcmp($status, 'SUCCESS') === 0){ ?>
                <?php echo $paied ?> 円分のOSUSHIポイントと交換しました！
            <?php } ?>
        </p>
    </div>
</div>
