<div class="container">
	<div class="jumbotron">
		<body>
			<h2>あなたの資産総額</h2>
			<table class="table table-striped">
			<thead>
				<tr>
				<th>資産総額</th>
				<th>お気に入り企業数</th>
				</tr>
			</thead>
			<?php echo $this->Html->tableCells($total_asset) . PHP_EOL; ?>	
			</table>
			<span style="font-size:2pt;"><br></span>
			<h2>お気に入りの会社</h2>
			<table class="table table-striped">
			<thead>
				<tr>
				<th>会社名</th>
				<th>業種</th>
				<th>株数</th>
				<th>現在値</th>
				<th>前日比</th>
				<th></th>
				</tr>
			</thead>
			<?php echo $this->Html->tableCells($asset_list) . PHP_EOL; ?>	
			</table>
		</body>
	</div>
</div>
