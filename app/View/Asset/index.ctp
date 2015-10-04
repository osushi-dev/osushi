<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load('visualization', '1', {packages:['table']});
    google.setOnLoadCallback(drawTable);

    function drawTable() {
        var dataAsJson = {
            cols:[ 
                {id:'Asset',label:'保有銘柄',type:'string'},
                {id:'ToShareUnit',label:'単元株まで',type:'number'}, 
                {id:'CurrentValues',label:'現在値',type:'number'}, 
                {id:'NumberOfStocks',label:'保有株数',type:'number'}, 
                {id:'GainOrLoss',label:'評価損益',type:'number'}
            ] 
           ,rows:[
                {c:[{v:'明治乳業'},{v: 1000, f: '¥1,000'},{v: 1428, f:'¥1,428'},{v: 2.6},{v: +200}]},
                {c:[{v:'サントリー'},{v: 800, f: '¥800'},{v: 659, f:'¥659'},{v: 6.3},{v: -50}]}
            ]
            };
        var data = new google.visualization.DataTable(dataAsJson);

        var table = new google.visualization.Table(document.getElementById('AssetTable'));

        table.draw(data, {showRowNumber: true});
    }
</script>

<div class="container">
    <div class="jumbotron">
        <body onresize="table.draw(data, {showRowNumbaer: true});">
            <div>
                <span style="font-size:360pt;"><br></span>
                <h4>test</h4>
            </div>
            <div id="AssetTable" style="width: 100%; height: 600px;"></div>
        </body>
    </div>
</div>
