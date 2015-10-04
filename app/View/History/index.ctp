<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<div class="container">
    <div class="jumbotron">
        <div class="container">
            <h2>あなたの購入履歴です</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>date</th>
                        <th>name</th>
                        <th>policyname</th>
                    </tr>
                </thead>
                <tbody>
                <?php for( $i = 0; $i < count($histories); $i++ ){ ?>
                    <tr>
                        <td><?php echo $histories[$i]['History']['date'] ?></td>
                        <td><?php echo $histories[$i]['History']['name'] ?></td>
                        <td><?php echo $histories[$i]['Stock']['name'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
       <p>説明だお</p>
    </div>
</div>
