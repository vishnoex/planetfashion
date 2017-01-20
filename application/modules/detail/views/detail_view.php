<div class="container">
	<ul style="float:left; list-style-type:none;">
		<?php
			$href = "";
			foreach ($breadcrumb as $k => $v) {
				if(sizeof($breadcrumb) > 1) {
					if($k == 1) {
						$href .= $v;
		?>
						<li style="display: inline;"><a href="<?php echo base_url(); ?>"><?php echo $v; ?></a></li>
		<?php
					} else if($k > 1  && $k < sizeof($breadcrumb) - 1) {
		?>
						<li style="display: inline;">&nbsp;&nbsp;>>&nbsp;&nbsp;</li>
						<li style="display: inline;"><a href="<?php echo strtolower($href); ?>"><?php echo $v; ?> </a></li>
		<?php
					}
				}
			}
		?>
	</ul>

	<div class="fh5co-spacer fh5co-spacer-md"></div>

	<ul>
		<h1><?php echo $product_name; ?></h1>
	</ul>
</div>