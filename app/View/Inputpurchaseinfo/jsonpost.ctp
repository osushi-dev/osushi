<script type="text/javascript">
    $(function(){
        $("#response").html("Response Values");

        $("#button").click( function(){
            var url = $("#url_post").val();

                var JSONdata = {
                    userid: $("#userid").val(),
                    jancode: $("#jancode").val(),
                    price: $("#price").val()
                };

            alert(JSON.stringify(JSONdata));

            $.ajax({
                type : 'post',
                url : url,
                data : JSON.stringify(JSONdata),
                contentType: 'application/JSON',
                dataType : 'JSON',
                scriptCharset: 'utf-8',
                success : function(data) {
                    // Success
                    alert("success");
                    //alert(JSON.stringify(data));
                    $("#response").html(JSON.stringify(data));
                },
                error : function(data) {
                    // Error
                    alert("error");
                    //alert(JSON.stringify(data));
                    $("#response").html(JSON.stringify(data));
                }
            });
        })
    })
</script>
<div class="container">
    <div class="jumbotron">
        <h4>Jsonリクエストのテスト</h4>
        <hr>
        <p>以下で入力した値をjsonリクエストで送信し、受信したJsonをそのまま返却し、最下部に表示します</p>
        <hr>
        <p>URL: <input type="text" id="url_post" name="url" size="100" value="http://thiro.osushi.thiroyoshi.com/Inputpurchaseinfo"></p>
        <p>UserId: <input type="text" id="userid" size="30" value="1"></p>
        <p>JanCode: <input type="text" id="jancode" size="30" value="49000000001"></p>
        <p>Unit Price: <input type="text" id="price" size="30" value="100"></p>
        <p><button class="btn btn-lg btn-raised btn-primary" id="button" type="button">submit</button></p>
        <textarea id="response" cols=120 rows=10 disabled></textarea>
    </div>
</div>
