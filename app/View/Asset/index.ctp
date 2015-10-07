<?php
$this->Html->css('pages/aset', array('inline' => false));
?>
<div class="container">
    <div class="jumbotron">

        <div class="row">
            <h4 class="headline">あなたの資産総額</h4>
            <h3 align="right">
                <?php echo floor($total_asset['total']); ?> 円
            </h3>
        </div>
        <div class="row">
            <h4 class="headline">お気に入りの会社</h4>
			<ul class="list-group">
                <?php for($i = 0; $i < count($assets); $i++){ ?>
                    <a href="http://stocks.finance.yahoo.co.jp/stocks/detail/?code=<?php echo $asset_list[$i][6] ?>.T" class="list-group-item">
						<div class="row-action-primary">
							<span><?php echo $asset_list[$i][1]?></span>
						</div>
						<h4 class="list-group-item-heading">
							<?php echo $asset_list[$i][0]?>
						</h4>
                        <div class="list-group-item-text">
							<h4>株数 <?php echo round($asset_list[$i][2],2)?></h4>
							<div align="right">
								<span>株価 <?php echo $asset_list[$i][3]?></span><br>
								<h4>前日比 <span class="<?php echo $asset_list[$i][4][1]['class']?>"><?php echo $asset_list[$i][4][0]?></span></h4>
							</div>
						</div>
                    </a>
					<div align="right">
					<a href="/asset/buy_fraction?asset_id=<?php echo $assets[$i]['Asset']['id']?>" class="btn btn-sm btn-primary"><?php echo $asset_list[$i][0]?> の端株を売る</a>
				</div>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
