<link rel="stylesheet" type="text/css" href="/css/sweetalert.css">
<script src="/js/sweetalert.min.js"></script>
<script src="/js/sweetalert-dev.js"></script>

<script type="text/javascript">
function payment(value){
    var tmp = String(value);
    swal({
        title:"ポイントを購入しますか？", // タイトル文
        type:"warning", // default:null "warning","error","success","info"
        allowOutsideClick:false, // default:false アラートの外を画面クリックでアラート削除
        showCancelButton: true, // default:false キャンセルボタンの有無
        confirmButtonText:"購入", // default:"OK" 確認ボタンの文言
        confirmButtonColor: "#DD6B55", // default:"#AEDEF4" 確認ボタンの色
        cancelButtonText:"キャンセル", // キャンセルボタンの文言
        closeOnConfirm: false // default:true 確認ボタンを押したらアラートが削除される
    },
    function(){
         $.ajax({ 
            type: "POST", 
            url: "/point/paymentresult", 
            data: 'payment='+tmp, 
            success: function(response) {
            }, 
            error: function() { 
                alert('error'); 
            } 
        });

        swal("購入しました！", "ご購入ありがとうございます!", "success");
        return true;
    }
    );
}
</script>

<div class="container main-component">
    <div class="row pb-20">
        <h4 class="headline">入金画面</h4>
        <button type="submit" name="payment" class="btn btn-default col-xs-6 col-xs-offset-3 mb-5" value="1000"  onClick="payment(1000)">1000ポイント</button>
        <button type="submit" name="payment" class="btn btn-default col-xs-6 col-xs-offset-3 mb-5" value="2000"  onClick="payment(2000)">2000ポイント</button>
        <button type="submit" name="payment" class="btn btn-default col-xs-6 col-xs-offset-3 mb-5" value="5000"  onClick="payment(5000)">5000ポイント</button>
        <button type="submit" name="payment" class="btn btn-default col-xs-6 col-xs-offset-3 mb-5" value="10000" onClick="payment(10000)">10000ポイント</button>
        </div >
    </div>
</div>
