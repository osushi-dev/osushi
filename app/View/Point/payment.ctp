<div class="container">

    <div class="jumbotron">
        <h4>入金画面</h4>

        <form action="/point/paymentresult" method="post">
            <p>
                OSUSHIポイント交換：
                <input type="radio" name="payment" value="1000" checked> 1000 ポイント
                <input type="radio" name="payment" value="2000"> 2000 ポイント
                <input type="radio" name="payment" value="5000"> 5000 ポイント
                <input type="radio" name="payment" value="10000"> 10000 ポイント
            </p>
            <p>
                <input type="submit" value="ポイント交換">
            </p>
        </form>
    </div>
</div>
