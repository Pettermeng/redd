<?php

/* Template Name: Registation Process */

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
							<?php if( get_field('header_title_registation_process') ): ?>
								<p class="title col-md-10 col-sm-12"><?php echo get_field('header_title_registation_process');?></p>
							<?php endif; ?>
								<p class="drawline col-md-10 col-sm-12"></p>
							<?php if( get_field('header_detail_registation_process') ): ?>
								<p class="detail col-md-10 col-sm-12"><?php echo get_field('header_detail_registation_process');?></p>
							<?php endif; ?>
					</div>
					<div class="row process-to-register">
						<?php if( get_field('content_title_registation_process') ): ?>
								<p class="title col-md-10 col-sm-12"><?php echo get_field('content_title_registation_process');?></p>
							<?php endif; ?>
							<div class="drawline col-md-10 col-sm-12"></div>
							<?php if( get_field('content_detail_registation_process') ): ?>
								<p class="detail col-md-10 col-sm-12"><?php echo get_field('content_detail_registation_process');?></p>
							<?php endif; ?>
					</div>
					<!-- Image block for Desktop  -->
					<div class="row">
						<div class="img_registation">
							<?php if( get_field('desktop_img_registation_process') ): ?>
								<img src="<?php echo get_field('desktop_img_registation_process')['url']; ?>" alt="img" width="100%";>
							<?php endif; ?>
						</div>
					<!-- End Image block for Desktop  -->
					<!-- Image block for Mobile  -->
					</div>

					<div class="row">
						<div class="mobile_image">
							<?php if( get_field('mobile_img_registation_process') ): ?>
								<img src="<?php echo get_field('mobile_img_registation_process')['url']; ?>" alt="img" width="100%";>
							<?php endif; ?>
						
						</div>
					</div>
					<!-- End Image block for Mobile  -->
					<!-- Button Block  -->
					<div class="row">
						<?php 
								if( have_rows('button_registation_process') ):
							?>
								<?php 
									$count = 0;
									while ( have_rows('button_registation_process') ) : the_row();
									$count++;
								?>
								<?php 
									if( get_sub_field('title_button') ): 
										$title = get_sub_field('title_button');
										$url = get_sub_field('url_button');
										?>
										<a class=' col-sm-5 col-lg-2 registation_button' href="<?php echo $url; ?>">
											<?php echo $title?>
										</a>
								<?php endif; ?> 
								<?php endwhile;?>
							<?php endif; ?> 
						</div>
					<!-- End Button Block  -->
					<div class="margin-bottom-90"></div>
				</div>
			</div>
		</div>
        <?php endwhile; ?>
	<?php }
get_footer();