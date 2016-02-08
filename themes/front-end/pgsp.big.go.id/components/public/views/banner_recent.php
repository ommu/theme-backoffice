<div class="banner clearfix">
	<?php
		$this->widget('BannerRecent', array(
			'category'=>2,
		));
		echo '<div class="clear"></div>';
		$this->widget('BannerRecent', array(
			'category'=>3,
		));
	?>
</div>