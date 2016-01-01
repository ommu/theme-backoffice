<div class="meta-information <?php echo ($module == null && $currentAction == 'site/index') ? 'main' : ''?> clearfix">
	<div class="box">
		<i class="fa fa-map-marker"></i>
		<span>
			<strong>PGSP Address</strong>
			<?php echo $model->office_place.', '.$model->office_village.', '.$model->office_district.', '.$model->view_meta->city.', '.$model->view_meta->province.', '.$model->view_meta->country.', '.$model->office_zipcode;?>
		</span>
	</div>
	<div class="box">
		<i class="fa fa-phone"></i>
		<span>
			<strong>Phone Numbers</strong>
			<?php if($model->office_phone != '')?>
				<b>Phone</b>: <?php echo $model->office_phone;?><br/>
			<?php if($model->office_fax != '')?>
				<b>Fax</b>: <?php echo $model->office_fax;?>
		</span>
	</div>
	<div class="clear nth-child"></div>
	<div class="box">
		<i class="fa fa-calendar"></i>
		<span>
			<strong>Working Hours</strong>
			<?php echo $model->office_hour;?>
		</span>
	</div>
	<div class="box">
		<i class="fa fa-paper-plane"></i>
		<span>
			<strong>Keep In Touch</strong>
			We are happy to answer your quiestions at <a href="mailto:<?php echo $model->office_email;?>" title="<?php echo $model->office_email;?>"><?php echo $model->office_email;?></a>
		</span>
	</div>
</div>