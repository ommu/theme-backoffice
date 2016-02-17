<?php if($model->data != null) {?>
<div class="box recent-news-article">
	<h3>Centre of Excellence</h3>
	<ul>
		<?php 
		foreach($model->data as $key => $val) {?>
			<li><a terget="_blank" href="<?php echo $val->url;?>" title="<?php echo ucwords(strtolower($val->title));?>"><?php echo ucwords(strtolower($val->title));?></a></li>
		<?php }?>
	</ul>
</div>
<?php }?>