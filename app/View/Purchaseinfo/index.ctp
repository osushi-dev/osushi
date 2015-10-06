<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<div class="container">
    <div class="jumbotron">
        <div class="container">
            <h2>あなたの購入履歴です</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>date</th>
                        <th>item.name</th>
                        <th>stock.name</th>
                        <th>price</th>
                        <th>num</th>
                    </tr>
                </thead>
                <tbody>
                <?php for( $i = 0; $i < count($purchaseinfos); $i++ ){ ?>
                    <tr>
                        <td><?php echo $purchaseinfos[$i]['Purchaseinfo']['date'] ?></td>
                        <td><?php echo $purchaseinfos[$i]['Item']['name'] ?></td>
                        <td><?php echo $purchaseinfos[$i]['Stock']['name'] ?></td>
                        <td><?php echo $purchaseinfos[$i]['Purchaseinfo']['price'] ?></td>
                        <td><?php echo $purchaseinfos[$i]['Purchaseinfo']['num'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
       <p>説明だお</p>
    </div>
</div>
