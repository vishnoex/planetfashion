<div class="container">
	<ul style="float:left; list-style-type:none;">
		<?php foreach ($breadcrumb as $k => $v) {
			if($breadcrumb[2]) {
		?>
			<li style="display: inline;"><a href="#"><?php echo $v; ?></a></li>
		<?php } } ?>
	</ul>
</div>