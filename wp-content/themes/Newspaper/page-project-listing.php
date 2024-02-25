<?php

/* Template Name: Project Listing */

get_header();


	// $mailResult = false;
	// $mailResult = wp_mail( 'vannarith.ny@bi-kay.com', 'test if mail works', 'hurray' );
	// var_dump($mailResult);

	if (have_posts()) { ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="body-container">
			<!-- Block menu page  -->
			<style type="text/css">
				.sf-menu > li > a{
					padding: 0px 14px !important;
				}
			</style>
			<div class="header-margin-bottom"></div>
			<div class="td-crumb-container">
				<?php echo td_page_generator::get_page_breadcrumbs(get_the_title()); ?>
			</div>
			<div class="header-margin-top"></div>
			 <!-- End Block menu page  -->
			 
			<div class="content-container-listing">
				<div class="container">
					<div class="row no-padding-listing ">
							<?php if( get_field('header_title_listing_project') ): ?>
								<p class="title col-md-10 col-sm-12"><?php echo get_field('header_title_listing_project');?></p>
							<?php endif; ?>
								<p class="drawline col-md-12 col-sm-12"></p>
							<?php if( get_field('header_detail_listing_project') ): ?>
								<p class="detail col-lg-12"><?php echo get_field('header_detail_listing_project');?></p>
							<?php endif; ?>
					</div>
					
					<div class="table-block needMarginBottonProject">
						<!-- Three tab link to click -->
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item ">
								<a class="nav-link active" id="all-project-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All projects</a>
							</li>
							<li class="nav-item project-list-tab">
								<a class="nav-link" id="registered-project-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Registered</a>
							</li>
							<li class="nav-item project-list-tab">
								<a class="nav-link" id="pipeline-project-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Pipeline</a>
							</li>
						</ul>
						<!-- Tab content start  -->
						<div class="tab-content" id="myTabContent">
							<!-- All project  -->
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="all-project-tab">
								<table class="table table-striped">
									<thead class="header-th">
										<tr>
											<th class="register-project"><?php _e("[:km]ID[:en]ID[:]");?></th>
											<th class="register-project"><?php _e("[:km]ឈ្មោះគម្រោងរេដបូកដែលបានចុះបញ្ជីរួច[:en]Project name [:]");?></th>
											<th class="register-project"><?php _e("[:kh]Proponent[:en]Proponent[:]");?></th>
											<th class="register-project"><?php _e("[:kh]Project type[:en]Project type[:]");?></th>
											<th class="register-project"><?php _e("[:kh]AFOLU activities[:en]AFOLU activities[:]");?></th>
											<th class="register-project"><?php _e("[:kh]Methodology[:en]Methodology[:]");?></th>
											<th class="register-project"><?php _e("[:km]ស្ថានភាពគម្រោង[:en]Project Status[:]");?></th>
											<th class="register-project"><?php _e("[:kh]Province[:en]Province[:]");?></th>
										</tr>
									</thead>
									<tbody>
									<?php
										global $wpdb;
										$table_name = $wpdb->prefix . "project";
										$table_project_proponent_partner = $wpdb->prefix . "project_proponent_partner";
										$table_project_type = $wpdb->prefix . "project_type";
										$projectData =  $wpdb->get_results("SELECT project.id, project_name, organization_name, project_type_en, date_approval, address from $table_name as project JOIN $table_project_proponent_partner as proProponent ON project.id = proProponent.id_project JOIN $table_project_type as proType ON project.id_project_type = proType.id WHERE proProponent.type='proponent' order by date_approval DESC");
										foreach ( $projectData as $row ) { 
											?>
												<tr>
													<td><?php echo $row->id?></td>
													<td>
														<?php if ($row->date_approval == "0000-00-00 00:00:00"): ?>
															<a href="<?php echo get_home_url(); ?>/pipeline-project.html?id=<?= $row->id ?>" class="project-name-highligh">
																<?php echo substr($row->project_name,0,56);?>
															</a>
															<a href="<?php echo get_home_url(); ?>/pipeline-project.html?id=<?= $row->id ?>" class="project-name-highligh-mobile">
																<?php echo substr($row->project_name,0,15);?>
															</a>
															
														<?php else: ?>
															<a href="<?php echo get_home_url(); ?>/project-approved.html?id=<?= $row->id ?>" class="project-name">
																<?php echo substr($row->project_name,0,56);?>
															</a>
															<a href="<?php echo get_home_url(); ?>/pipeline-project.html?id=<?= $row->id ?>" class="project-name-mobile">
																<?php echo substr($row->project_name,0,15);?>
															</a>
															
														<?php endif; ?>
													</td>
													<td><?php echo $row->organization_name?> </td>
													<td><?php echo $row->project_type_en?> </td>
													<td></td>
													<td></td>
													<td class="approve"><?php echo $row->date_approval != "0000-00-00 00:00:00" ?  _e('[:km]អនុម័តរួច[:en]Approved[:]') : _e('[:km]កំពុងរៀបចំ[:en]In Pipeline[:]');?></td>	
													<td><?php echo $row->address?> </td>
												</tr>
											<?php
										}
									?>
									</tbody>
								</table>
							</div>
							<!-- Registered or Approved project  -->
							<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="registered-project-tab">
								<table class="table table-striped">
										<thead class="header-th">
											<tr>
												<th class="register-project"><?php _e("[:km]ID[:en]ID[:]");?></th>
												<th class="register-project"><?php _e("[:km]ឈ្មោះគម្រោងរេដបូកដែលបានចុះបញ្ជីរួច[:en]Project name [:]");?></th>
												<th class="register-project"><?php _e("[:kh]Proponent[:en]Proponent[:]");?></th>
												<th class="register-project"><?php _e("[:kh]Project type[:en]Project type[:]");?></th>
												<th class="register-project"><?php _e("[:kh]AFOLU activities[:en]AFOLU activities[:]");?></th>
												<th class="register-project"><?php _e("[:kh]Methodology[:en]Methodology[:]");?></th>
												<th class="register-project"><?php _e("[:km]ស្ថានភាពគម្រោង[:en]Project Status[:]");?></th>
												<th class="register-project"><?php _e("[:kh]Province[:en]Province[:]");?></th>
											</tr>
										</thead>
										<tbody>
										<?php
											global $wpdb;
											$table_name = $wpdb->prefix . "project";
											$table_project_proponent_partner = $wpdb->prefix . "project_proponent_partner";
											$table_project_type = $wpdb->prefix . "project_type";
											$projectData =  $wpdb->get_results("SELECT project.id, project_name, organization_name, project_type_en, date_approval, address from $table_name as project JOIN $table_project_proponent_partner as proProponent ON project.id = proProponent.id_project JOIN $table_project_type as proType ON project.id_project_type = proType.id WHERE project.date_approval != '0000-00-00 00:00:00' AND proProponent.type='proponent' order by date_approval DESC");
											foreach ( $projectData as $row ) { 
												?>
													<tr>
														<td><?php echo $row->id?></td>
														<td>
															<?php if ($row->date_approval == "0000-00-00 00:00:00"): ?>
																<a href="<?php echo get_home_url(); ?>/pipeline-project.html?id=<?= $row->id ?>" class="project-name-highligh">
																	<?php echo substr($row->project_name,0,56);?>
																</a>
																<a href="<?php echo get_home_url(); ?>/pipeline-project.html?id=<?= $row->id ?>" class="project-name-highligh-mobile">
																	<?php echo substr($row->project_name,0,15);?>
																</a>
																
															<?php else: ?>
																<a href="<?php echo get_home_url(); ?>/project-approved.html?id=<?= $row->id ?>" class="project-name">
																	<?php echo substr($row->project_name,0,56);?>
																</a>
																<a href="<?php echo get_home_url(); ?>/pipeline-project.html?id=<?= $row->id ?>" class="project-name-mobile">
																	<?php echo substr($row->project_name,0,15);?>
																</a>
																
															<?php endif; ?>
														</td>
														<td><?php echo $row->organization_name?> </td>
														<td><?php echo $row->project_type_en?> </td>
														<td></td>
														<td></td>
														<td class="approve"><?php echo $row->date_approval != "0000-00-00 00:00:00" ?  _e('[:km]អនុម័តរួច[:en]Approved[:]') : _e('[:km]កំពុងរៀបចំ[:en]In Pipeline[:]');?></td>	
														<td><?php echo $row->address?> </td>
													</tr>
												<?php
											}
										?>
										</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="pipeline-project-tab">
							<table class="table table-striped">
										<thead class="header-th">
											<tr>
												<th class="register-project"><?php _e("[:km]ID[:en]ID[:]");?></th>
												<th class="register-project"><?php _e("[:km]ឈ្មោះគម្រោងរេដបូកដែលបានចុះបញ្ជីរួច[:en]Project name [:]");?></th>
												<th class="register-project"><?php _e("[:kh]Proponent[:en]Proponent[:]");?></th>
												<th class="register-project"><?php _e("[:kh]Project type[:en]Project type[:]");?></th>
												<th class="register-project"><?php _e("[:kh]AFOLU activities[:en]AFOLU activities[:]");?></th>
												<th class="register-project"><?php _e("[:kh]Methodology[:en]Methodology[:]");?></th>
												<th class="register-project"><?php _e("[:km]ស្ថានភាពគម្រោង[:en]Project Status[:]");?></th>
												<th class="register-project"><?php _e("[:kh]Province[:en]Province[:]");?></th>
											</tr>
										</thead>
										<tbody>
										<?php
											global $wpdb;
											$table_name = $wpdb->prefix . "project";
											$table_project_proponent_partner = $wpdb->prefix . "project_proponent_partner";
											$table_project_type = $wpdb->prefix . "project_type";
											$projectData =  $wpdb->get_results("SELECT project.id, project_name, organization_name, project_type_en, date_approval, address from $table_name as project JOIN $table_project_proponent_partner as proProponent ON project.id = proProponent.id_project JOIN $table_project_type as proType ON project.id_project_type = proType.id WHERE project.date_approval = '0000-00-00 00:00:00' AND proProponent.type='proponent' order by date_approval DESC");
											foreach ( $projectData as $row ) { 
												?>
													<tr>
														<td><?php echo $row->id?></td>
														<td>
															<?php if ($row->date_approval == "0000-00-00 00:00:00"): ?>
																<a href="<?php echo get_home_url(); ?>/pipeline-project.html?id=<?= $row->id ?>" class="project-name-highligh">
																	<?php echo substr($row->project_name,0,56);?>
																</a>
																<a href="<?php echo get_home_url(); ?>/pipeline-project.html?id=<?= $row->id ?>" class="project-name-highligh-mobile">
																	<?php echo substr($row->project_name,0,15);?>
																</a>
																
															<?php else: ?>
																<a href="<?php echo get_home_url(); ?>/project-approved.html?id=<?= $row->id ?>" class="project-name">
																	<?php echo substr($row->project_name,0,56);?>
																</a>
																<a href="<?php echo get_home_url(); ?>/pipeline-project.html?id=<?= $row->id ?>" class="project-name-mobile">
																	<?php echo substr($row->project_name,0,15);?>
																</a>
																
															<?php endif; ?>
														</td>
														<td><?php echo $row->organization_name?> </td>
														<td><?php echo $row->project_type_en?> </td>
														<td></td>
														<td></td>
														<td class="approve"><?php _e('[:km]កំពុងរៀបចំ[:en]In Pipeline[:]');?></td>	
														<td><?php echo $row->address?> </td>
													</tr>
												<?php
											}
										?>
										</tbody>
								</table>
							</div>
						</div>
						
					</div>

					<div class="row needMarginBottonProject">
						<div class="col-12">
							<div id='map_show' class="map"></div>
							<?php
								global $wpdb;
								$table_list_doc_type = $wpdb->prefix . "list_doc_type";
								$table_lists_documents = $wpdb->prefix . "lists_documents";
								$table_project = $wpdb->prefix . "project";
								$table_project_proponent_partner = $wpdb->prefix . "project_proponent_partner";
								// $GLOBALS[ 'kmlData' ] = $wpdb->get_results( "SELECT * from $table_list_doc_type as ldt INNER JOIN $table_lists_documents as ld ON ldt.id=ld.id_list_doc_type WHERE ldt.id=2");
								$GLOBALS[ 'kmlData' ] = $wpdb->get_results( "SELECT * from $table_list_doc_type as listDocType INNER JOIN $table_lists_documents as listDoc on listDoc.id_list_doc_type = listDocType.id INNER JOIN $table_project_proponent_partner as ppp on ppp.id_project= listDoc.id_project INNER JOIN $table_project as p on p.id=ppp.id_project where ppp.type='proponent' AND  listDocType.type_code='project_locations'");
								?>
							<!-- <div id="capture"  class="capture"></div> -->
						</div>
					</div>

				</div>
			</div>
		</div>
        <?php endwhile; ?>

	<?php }

get_footer();