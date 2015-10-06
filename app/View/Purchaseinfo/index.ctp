<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <div class="jumbotron">
        <h2>あなたの購入履歴です</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>購入日</th>
                    <th>商品名</th>
                    <th>銘柄</th>
                    <th>値段</th>
                    <th>個数</th>
                </tr>
            </thead>
            <tbody>
            <?php for( $i = 0; $i < count($purchaseinfos); $i++ ){ ?>
                <tr>
                    <td><?php echo $purchaseinfos[$i]['Purchaseinfo']['date'] ?></td>
                    <td><?php echo $purchaseinfos[$i]['Item']['name'] ?></td>
                    <td><?php echo $purchaseinfos[$i]['Issuelist']['name'] ?></td>
                    <td><?php echo $purchaseinfos[$i]['Purchaseinfo']['price'] ?></td>
                    <td><?php echo $purchaseinfos[$i]['Purchaseinfo']['num'] ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
