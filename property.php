<?php

	// check if the repeater field has rows of data
	if( have_rows('property') ):

		// loop through the rows of data
		while ( have_rows('property') ) : the_row(); ?>

		<div class="col-md-6 col-sm-12 custom-col">
			<a href="<?php the_sub_field('property_link'); ?>" title="<?php the_sub_field('property_name'); ?>">
				<div class="outer-content">
					<img src="<?php the_sub_field('property_image'); ?>" alt="">
					<div class="ico-content">
						<img src="<?php the_sub_field('property_logo'); ?>" alt="">
					</div>
				</div>
			</a>
		</div>

		<?php
		endwhile;

		else :

			// no rows found

		endif;


?>
