<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load('visualization', '1', {packages:['table']});
    google.setOnLoadCallback(drawTable);
    function drawTable() {
        var dataAsJson = {
            cols:[ 
                {id:'Asset',label:'保有銘柄',type:'string'}
               ,{id:'NumberOfStocks',label:'保有数',type:'number'} 
               ,{id:'CurrentValues',label:'現在値',type:'number'}
               ,{id:'GainOrLoss',label:'評価損益',type:'number'}
               ,{id:'ToShareUnit',label:'単元株まで',type:'number'} 
            ] 
           ,rows:[
                {c:[
                   {v:'明治乳業'}
                  ,{v: 2.6}
                  ,{v: 1428, f:'¥1,428'}
                  ,{v: +200}
                  ,{v: 1000, f: '¥1,000'}
                 ]}
               ,{c:[
                   {v:'サントリー'}
                  ,{v: 6.3}
                  ,{v: 659, f:'¥659'}
                  ,{v: -50}
                  ,{v: 800, f: '¥800'}
                 ]}
            ]

            };
        var TotalDataAsJson = {
            cols:[ 
                {id:'NumberOfHoldings',label:'銘柄数',type:'number'} 
               ,{id:'TotalAssets',label:'資産総額',type:'number'}
               ,{id:'UnrealizedGainsTotal',label:'評価損益合計',type:'number'}
            ] 
           ,rows:[
                {c:[
                   {v: 2}
                  ,{v: 24230, f:'¥24,230'}
                  ,{v: +560}
                 ]}
            ]

            };
        var data = new google.visualization.DataTable(dataAsJson);
        var table = new google.visualization.Table(document.getElementById('AssetTable'));
        table.draw(data, {showRowNumber: true});

        var TotalData = new google.visualization.DataTable(TotalDataAsJson);
        var TotalTable = new google.visualization.Table(document.getElementById('TotalAssetTable'));
        TotalTable.draw(TotalData, {showRowNumber: true});

    }
</script>

<div class="container">
    <div class="jumbotron">
        <body onresize="table.draw(data, {showRowNumber: true});">
            <span style="font-size:64pt;"><br></span>
            <h4>あなたの資産総額</h4>
            <div id="TotalAssetTable"></div>
            <h4>あなたの保有銘柄一覧</h4>
            <div id="AssetTable" style="width: 100%; height: 600px;"></div>
        </body>
    </div>
</div>
