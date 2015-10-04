<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load('visualization', '1', {packages:['table']});
    google.setOnLoadCallback(drawTable);
    function drawTable() {
        var dataAsJson = {
            cols:[ 
                {id:'Asset',label:'保有銘柄',type:'string'},
                {id:'NumberOfStocks',label:'保有数',type:'number'}, 
                {id:'CurrentValues',label:'現在値',type:'number'}, 
                {id:'GainOrLoss',label:'評価損益',type:'number'}
                {id:'ToShareUnit',label:'単元株まで',type:'number'}, 
            ] 
           ,rows:[
                {c:[{v:'明治乳業'},{v: 2.6},{v: 1428, f:'¥1,428'},{v: +200},{v: 1000, f: '¥1,000'}]},
                {c:[{v:'サントリー'},{v: 6.3},{v: 659, f:'¥659'},{v: -50},{v: 800, f: '¥800'}]}
            ]
            };
        var data = new google.visualization.DataTable(dataAsJson);

        var table = new google.visualization.Table(document.getElementById('AssetTable'));

        table.draw(data, {showRowNumber: true});
    }
</script>

<div class="container">
    <div class="jumbotron">
        <body onresize="table.draw(data, {showRowNumber: true});">
        <div>
            <span style="font-size:64pt;"><br></span>
            <h4>あなたの資産総額</h4>
        </div>
        <div style="width: 100%; height: 220px;">
            <h4>あなたの保有銘柄一覧</h4>
            <div id="AssetTable"></div>
        </div>
        </body>
    </div>
</div>
