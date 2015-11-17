<?php if($model->data != null) {?>
<div class="box recent-news-article">
	<h3>Berita Terbaru</h3>
	<ul>
		<?php 
		foreach($model->data as $key => $val) {?>
			<li><a href="<?php echo $val->url;?>" title="<?php echo $val->title?>"><?php echo $val->title?></a></li>
		<?php }?>
	</ul>
</div>
<?php }?>