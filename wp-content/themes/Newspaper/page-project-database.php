<?php

/* Template Name: Project Database */

get_header();

	global $wpdb;
	$table_project = $wpdb->prefix . "project";
	$table_project_reductions = $wpdb->prefix . "project_annual_emission_reductions";

	$proALls = $wpdb->get_results("
								SELECT *
								FROM $table_project 
								ORDER BY project_name ASC ");
	
	$minYear = $wpdb->get_row( "SELECT YEAR(vintage_end) as year FROM $table_project_reductions ORDER BY YEAR(vintage_end) ASC limit 1 ");
	$maxYear = $wpdb->get_row( "SELECT YEAR(vintage_end) as year FROM $table_project_reductions ORDER BY YEAR(vintage_end) DESC limit 1 ");
									
	$proComplete = 0;
	$proPip = 0;
	$totalVerified = 0;
	
	// $minYear = 2000;
	// $maxYear = 2000;
	foreach ($proALls as $key=>$row) {

		
		if($row->date_approval != "0000-00-00 00:00:00"){
			$proComplete++;
		}else{
			$proPip++;
		}

		$records = $wpdb->get_results("
								SELECT vintage_end, YEAR(vintage_end) as year, verified
								FROM $table_project_reductions 
								where id_project = $row->id
								GROUP BY YEAR(vintage_end)
								ORDER BY YEAR(vintage_end) ASC
								");
		
		if($records){
			foreach ($records as $subKey => $subRow) {
				$totalVerified = $totalVerified + $subRow->verified;
				// var_dump($subRow->verified.'=>'.$subRow->year);
				
			}

		}
	}





	if (have_posts()) { ?>

		<div class="body-container">
		     <!-- Block menu page  -->
			<div class="header-margin-bottom"></div>
			<div class="td-crumb-container">
				<?php echo td_page_generator::get_page_breadcrumbs(get_the_title()); ?>
			</div>
			<div class="header-margin-top"></div>
		     <!-- End Block menu page  -->


			<div class="content-container-database">
				<div class="container no-padding">
					<div class="row">
						<!-- block left menu image container  -->
						<?php 
							if( have_rows('menu_left') ):
						?>
							<div class="col-sm-12 col-md-12 col-lg-3 left-container">
								<?php 
									$count = 0;
									while ( have_rows('menu_left') ) : the_row();
									$count++;
								?>
									<?php 
										if( get_sub_field('title_left_menu') ): 
											$titleContent = get_sub_field('title_left_menu');
											$backgroundImg = get_sub_field('background_image_left_menu');
											$titleLink = get_sub_field('link_title_left_menu');
											$url = get_sub_field('url_left_menu');
									?>
										<!-- item one  -->
										<a href="<?php echo $url;?>">
											<div class="item-container ">
												<div class="bgItem"></div>
												<div class="image-container">
													<img src="<?php echo $backgroundImg['url'];?>" alt="<?php echo $titleContent;?>" width="100%";>
												</div>
												<div class='row title-container' id="title-container-hover">
													<div class="col-8 title">
														<p><?php echo $titleContent;?></p>
													</div>
													
													<div class="col-4 detail">
														<?php 
															if(strtolower($titleLink) == 'log in' ||strtolower($titleLink) == 'ចុចចូល' ){?>
																<p class="login"><?php echo $titleLink;?></p>
															<?php }else{?>
																<p class="plus" style="align-self: flex-end;"><?php echo $titleLink;?></p>
															<?php }?>
													</div>
												</div>
											</div>
										</a>
                					<?php endif; ?> 
								<?php endwhile;?>
							</div>
						<?php endif; ?> 
						<!-- End block left menu image container  -->
						
						<!-- block Right container  -->
						<div class="col-sm-12 col-md-12 col-lg-9 right-container">
							<?php if( get_field('title_page_right') ): ?>
								<span class="top-content"><?php echo get_field('title_page_right');?></span>
							<?php endif; ?>
							<div class="drawline"></div>
							<div>
							<?php if( get_field('content_right') ): ?>
								<p class="sub-content">
									<?php echo get_field('content_right');?>
								</p>
							<?php endif; ?>
							</div>

							<div class="row block-graph align-items-center">
								<div class="left-graph  col-lg-7 col-12 col-sm-12 col-md-12">
									<div class="left-top">
										<p>
										<?php _e("[:km]ការកាត់បន្ថយការបញ្ចេញឧស្ម័នផ្ទះកញ្ចក់ប្រចាំឆ្នាំ នៅកម្ពុជា (ឯកតាគិតជាលានតោនឧស្ម័នកាបូនិក (tCO2e))[:en]REDD+ Projects Annual Emission Reductions in Cambodia (unit in million tCO2e)[:]");?>
										</p>
									</div>
									<div class="drawline"></div>
									<div class="display-graph">
										<style type="text/css">
											#container {
												/*height: 400px;*/
											}
											#datatable{
												display: none;
											}
											.highcharts-axis-title{
												display: none;
											}
										</style>
										<div id="container_chart"></div>
									</div>
								</div>
								<div class="right-graph col-lg-5 col-12 col-sm-12 col-md-12">
									<div class="top-right-container">
										<div class="number-register">
											<p class='number'><?php echo $proComplete;?></p>
											<p class='text'><?php _e("[:km]ចំនួនគម្រោងរេដបូក[:en]Number of projects[:]");?><br><?php _e("[:km]ដែលបានចុះបញ្ជីរួចនៅក្នុងប្រព័ន្ធទិន្នន័យគម្រោងរេដបូកជាតិ[:en]registered[:]");?></p>
											
										</div>
										<div class="drawsmallinevertical"></div>
										<div class="number-project">
											<p class='number'><?php echo $proPip;?></p>
											<p class='text'><?php _e("[:km]ចំនួនគម្រោងរេដបូក[:en]Number of projects[:]");?><br><?php _e("[:km]កំពុងរៀបចំ[:en]in pipeline[:]");?></p>
										</div>
									</div>
									<div class="drawsmalline"></div>
									<div class="bottom-container">
											<p class='number'><?php echo number_format($totalVerified);?></p>
											<p class='text'><?php _e("[:km]បរិមាណកាត់បន្ថយឧស្ម័នផ្ទះកញ្ចក់ដែលបានចេញវិញ្ញាបនបត្របញ្ជាក់រួច[:en]Number of verified Emission Reductions[:]");?><br> <?php _e("[:km]ពីឆ្នាំ[:en]from[:]");?> <?php echo $minYear->year;?> <?php _e("[:km]ដល់ឆ្នាំ[:en]to[:]");?> <?php echo $maxYear->year;?></p>
									</div>
								</div>
								<div class="clear-both"></div>
							</div>

							<?php if( get_field('url_button_view_project_listing') ): ?>
								<a href="<?php echo get_field('url_button_view_project_listing');?>">
								<div class="view-project">
									<p><?php _e("[:km]មើលបញ្ជីគម្រោងរេដបូក[:en]View Project Listing[:]");?> > </p>
								</div>
							</a>
							<?php endif; ?>
							<?php 
                                if(have_rows('sub-title')): 
                            ?>
                                <?php 
                                    $count = 0;
                                    while ( have_rows('sub-title') ) : the_row();
                                        $count++;
                                ?>
                                    <?php 
                                    if( get_sub_field('text-title') ): 
                                        $textTitle = get_sub_field('text-title');
                                        $detail = get_sub_field('detail');
                                    ?>
                                        <div>
                                            <span class="top-content"><?php echo $textTitle;?></span>
                                        </div>
                                        <div class="drawline"></div>
                                        <div>
                                            <p class="sub-content"><?php echo $detail;?></p>
										</div>
										<?php 
											if( get_field('url_read_more') ): ?>
												<a href="<?php echo get_field('url_read_more');?>">
													<p class="read-more"><?php _e("[:km]អានបន្ថែម[:en]Read more[:]");?></p>
												</a>
											<?php endif; ?>
                                    <?php endif; ?> 
                                <?php endwhile;?>
							<?php endif; ?> 
						<!-- block Right container  -->
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php }
get_footer();