<?php

/* Template Name: Read More */

get_header();


	if (have_posts()) { ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="body-container">

		     <!-- Block menu page  -->
			<div class="header-margin-bottom"></div>
			<div class="td-crumb-container">
				<?php echo td_page_generator::get_page_breadcrumbs(get_the_title()); ?>
			</div>
			<div class="header-margin-top"></div>
		     <!-- End Block menu page  -->
			
			 <div class="content-container">
				<div class="container">
					<div class="row">
						<?php 
                            if( get_field('text-title') ): 
                                $textTitle = get_field('text-title');
                                $detail = get_field('detail');
                            ?>
								<p class="read-title col-md-10 col-sm-12"><?php echo $textTitle;?></p>
                                <div class="drawline"></div>
								<p class="read-detail col-md-10 col-sm-12"><?php echo $detail;?></p>
							<?php endif; ?> 
					</div>
					<div class="margin-bottom-90"></div>
				</div>
			</div>
		</div>
        <?php endwhile; ?>
	<?php }
get_footer();