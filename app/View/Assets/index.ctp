<div>
<script type="text/javascript">
	google.load('visualization', '1', {packages:['table']});
    google.setOnLoadCallback(drawTable);

    function drawTable() {

        var dataAsJson = {
            cols:[ 
                {id:'date',label:'購入日時',type:'date'},
                {id:'price',label:'金額',type:'number'}, 
                {id:'purch',label:'内容',type:'string'}], 
            rows:[
                {c:[{v:new Date(2015, 8, 27)},{v: 1000, f: '¥1,000'},{v:'ビール'}]},
                {c:[{v:new Date(2015, 8, 28)},{v: 800, f: '¥800'},{v:'お菓子'}]}]
            };
        var data = new google.visualization.DataTable(dataAsJson);

        var table = new google.visualization.Table(document.getElementById('histable'));

        table.draw(data, {showRowNumber: true});
    }
</script>
</div>
