<?php

/* Template Name: Project Approved */
get_header();

		

		global $wpdb;
		$table_project = $wpdb->prefix . "project";
		$project_proponent_partner = $wpdb->prefix . "project_proponent_partner";
		$organization_category = $wpdb->prefix . "organization_category";
		$list_doc_type = $wpdb->prefix . "list_doc_type";
		$lists_documents = $wpdb->prefix . "lists_documents";
		$project_id=$_GET['id'];

	if (have_posts()) { ?>
		<?php
			$getProjectData = $wpdb->get_row( "SELECT * FROM $table_project WHERE id=$project_id" );
			if($getProjectData->date_approval == "0000-00-00 00:00:00"){
				$fullurl = get_permalink(get_page_by_path( 'pipeline-project' ));
				 $reUrl = str_replace("project-approved.html","pipeline-project.html",$fullurl);
				header("Location: ".$reUrl."?id=".$project_id);
			 }
		?>
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="body-container">
			
			<!-- Block menu page  -->
			<div class="header-margin-bottom"></div>
			<div class="td-crumb-container">
				<?php 
				$length = 75;
				$contentTitle = $getProjectData->project_name;
			    if(strlen($contentTitle)<$length){
			    	$textUrl = $contentTitle;
			    }else{
				    $visible = substr($contentTitle, 0, $length);
				    $textUrl = balanceTags($visible) . "…";
			    }
				?>
				<?php echo td_page_generator::get_page_breadcrumbs($textUrl); ?>
			</div>
			<div class="header-margin-top"></div>
		     <!-- End Block menu page  -->

			<div class="content-container-approved">
				<div class="container">
					<div class="row">
						<p class="title col-md-10 col-sm-12">
							<?php echo $getProjectData->project_name;?>
						</p>
						<div class="drawline col-lg-12"></div>
					</div>
					<div class="row">
						<div class="col-lg-8 col-sm-12 left-container">
							<p>
								<?php echo $getProjectData->project_description;?>	
							</p>
							<!-- map  -->
							<div id='map_show' class="map mb-4"></div>
							<?php
								global $wpdb;
								$table_list_doc_type = $wpdb->prefix . "list_doc_type";
								$table_lists_documents = $wpdb->prefix . "lists_documents";
								$table_project = $wpdb->prefix . "project";
								$project_id=$_GET['id'];
								// $GLOBALS[ 'kmlData' ] = $wpdb->get_results( "SELECT * from $table_list_doc_type as ldt INNER JOIN $table_lists_documents as ld ON ldt.id=ld.id_list_doc_type WHERE ldt.id=2");
								$GLOBALS[ 'projectData' ] = $wpdb->get_results( "SELECT * from $table_list_doc_type as listDocType INNER JOIN $table_lists_documents as listDoc on listDoc.id_list_doc_type = listDocType.id INNER JOIN $table_project as pro on listDoc.id_project=pro.id where listDocType.type_code='project_locations' AND pro.id=$project_id");
								?>
							<!-- end map  -->
							<!-- table one  -->
							
							<?php
								$fetchDocument = $wpdb->get_results( "SELECT DISTINCT type_title_en,id_list_doc_type,type_code from $lists_documents as listDoc INNER JOIN $list_doc_type as listDocType 
								ON listDoc.id_list_doc_type=listDocType.id WHERE listDoc.id_project=$project_id AND listDocType.type_code !='right_document' AND listDocType.type_code !='project_locations' " );
								$UserID = get_current_user_id();
								if($fetchDocument){
                                    foreach ( $fetchDocument as $row ) {
							?>
										<?php 
											if($UserID ==(int) $getProjectData->created_by) : ?>
												<div class=" border-container" id="<?php echo $row->type_code=='bsi'?'hearder-opa':'normal' ?>">
													<div class="button-header">
														<p><?php echo $row->type_title_en;?></p>
													</div>
													<div class="row table-block">
															<table class="table table-striped">
																<thead class="header-th">
																	<tr>
																		<th class="name"><?php _e("[:km]ឈ្មោះឯកសារ[:en]Document Names[:]");?></th>
																		<th class="date"><?php _e("[:km]កាលធ្វើបច្ចុប្បន្នភាព[:en]Date Updated[:]");?></th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		$fetchDocDetail = $wpdb->get_results( "SELECT * from $lists_documents as listDoc INNER JOIN $list_doc_type as listDocType 
																		ON listDoc.id_list_doc_type=listDocType.id WHERE listDoc.id_project=$project_id AND id_list_doc_type=$row->id_list_doc_type AND listDocType.type_code !='right_document' "); 
																		if($fetchDocDetail){
																			foreach ( $fetchDocDetail as $subrow ) {
																	?>

																	<tr>
																		<td> 
																			<?php 
																			if($subrow->link_download != ''){
																			?>
																				<a class="text-content" target=”_blank” href="<?php echo $subrow->link_download?>"><?php echo  substr($subrow->title,0,50);?></a>
																				<a class="text-content-mobile" target=”_blank” href="<?php echo $subrow->link_download?>"><?php echo  substr($subrow->title,0,20);?></a>
																			<?php 
																			}else{
																			?>
																				<a class="text-content" download target=”_blank” href="<?php echo $subrow->path?>"><?php echo substr($subrow->title,0,50); ?></a>
																				<a class="text-content-mobile" download target=”_blank” href="<?php echo $subrow->path?>"><?php echo substr($subrow->title,0,20); ?></a>
																			<?php 
																			}	
																			?>
																		</td>
																		<td class="date-value"><?php echo $subrow->date_submitted; ?></td>
																	</tr>
																	<?php
																		}
																	}
																	?>

																</tbody>
															</table>
														</div>
												</div>
											<?php elseif($row->type_code!='bsi') : ?>
												<div class="border-container">
													<div class="button-header">
														<p><?php echo $row->type_title_en;?></p>
													</div>
													<div class="row table-block">
															<table class="table table-striped">
																<thead class="header-th">
																	<tr>
																		<th class="name"><?php _e("[:km]ឈ្មោះឯកសារ[:en]Document Names[:]");?></th>
																		<th class="date"><?php _e("[:km]កាលធ្វើបច្ចុប្បន្នភាព[:en]Date Updated[:]");?></th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		$fetchDocDetail = $wpdb->get_results( "SELECT * from $lists_documents as listDoc INNER JOIN $list_doc_type as listDocType 
																		ON listDoc.id_list_doc_type=listDocType.id WHERE listDoc.id_project=$project_id AND id_list_doc_type=$row->id_list_doc_type AND listDocType.type_code !='right_document' "); 
																		if($fetchDocDetail){
																			foreach ( $fetchDocDetail as $subrow ) {
																	?>

																	<tr>
																		<td> 
																			<?php 
																			if($subrow->link_download != ''){
																			?>
																				<a class="text-content" target=”_blank” href="<?php echo $subrow->link_download?>"><?php echo substr($subrow->title,0,50); ?></a>
																				<a class="text-content-mobile" target=”_blank” href="<?php echo $subrow->link_download?>"><?php echo substr($subrow->title,0,20); ?></a>
																			<?php 
																			}else{
																			?>
																				<a class="text-content"  download target=”_blank” href="<?php echo $subrow->path?>"><?php echo substr($subrow->title,0,50); ?></a>
																				<a class="text-content-mobile"  download target=”_blank” href="<?php echo $subrow->path?>"><?php echo substr($subrow->title,0,20); ?></a>
																			
																			<?php 
																			}	
																			?>
																		</td>
																		<td class="date-value"><?php echo $subrow->date_submitted; ?></td>
																	</tr>
																	<?php
																		}
																	}
																	?>

																</tbody>
															</table>
														</div>
												</div>
											<?php endif; 
										?>
							<?php 
                                	} //end forloop
                              } // end if
                            ?>

						</div>
						<div class="col-lg-4 col-sm-12 right-container">
							<div class="border-container">
								<div class="button-header">
									<p><?php _e("[:km]ប្រតិបត្តិករ និងដៃគូគម្រោង[:en]Project Proponent and Partners[:]");?></p>
								</div>

								<?php
			 						$fetchProponent = $wpdb->get_row( "SELECT * from $project_proponent_partner as proPartner LEFT JOIN redd_organization_category as orgCat ON proPartner.id_cate_org = orgCat.id  WHERE id_project=$project_id AND type='proponent'");
								 ?>

									<?php 
										if($fetchProponent->organization_name) : ?>
											<div class="text-title">
												<p class="name"><?php _e("[:km]ប្រតិបត្តិករគម្រោង[:en]Project Proponent[:]");?></p>
												<p class ="detail"><?php echo $fetchProponent->organization_name;?></p>
											</div>
										<?php endif; 
									?>
									
									<?php 
										if($fetchProponent->title_en) : ?>
											<div class="text-title">
												<p class="name"><?php _e("[:km]ប្រភេទស្ថាប័ន/អង្គការ[:en]Organization Category[:]");?></p>
												<p class ="detail"><?php echo $fetchProponent->title_en;?></p>
											</div>
										<?php endif; 
									?>

									
									
									<?php 
										if($fetchProponent->funtcion) : ?>
											<div class="text-title">
												<p class="name"><?php _e("[:km]មុខងារ/ការទទួលខុសត្រូវ[:en]Function/Responsibility[:]");?></p>
												<p class ="detail"><?php echo $fetchProponent->funtcion;?></p>
											</div>
										<?php endif; 
									?>
									
								
									<?php 
										if($fetchProponent->address) : ?>
											<div class="text-title">
												<p class="name"><?php _e("[:km]អាស័យដ្ឋាន[:en]Address[:]");?></p>
												<p class ="detail"><?php echo $fetchProponent->address;?></p>
											</div>
										<?php endif; 
									?>

									<?php 
										if($fetchProponent->emails) : ?>
											<div class="text-title">
												<p class="name"><?php _e("[:km]ព័ត៌មានទំនាក់ទំនង[:en]Contact Info[:]");?></p>
												<p class ="detail"><?php echo $fetchProponent->emails;?></p>
											</div>
										<?php endif; 
									?>
							
									<?php 
										if($fetchProponent->contact_person) : ?>
											<div class="text-title">
												<p class="name"><?php _e("[:km]ជនបង្គោលទំនាក់ទំនង[:en]Contact Person/Focal Point[:]");?></p>
												<p class ="detail"><?php echo $fetchProponent->contact_person;?></p>
											</div>
										<?php endif; 
									?>

								<?php
			 						$fetchPartner = $wpdb->get_results( "SELECT * from $project_proponent_partner as proPartner LEFT JOIN redd_organization_category as orgCat ON proPartner.id_cate_org = orgCat.id  WHERE id_project=$project_id AND type='partner' ORDER BY type DESC" );
									 if($fetchPartner){
									foreach ( $fetchPartner as $row ) {
								?>

									<?php 
										if($row->organization_name) : ?>
											<div class="text-title">
												<p class="name"><?php _e("[:km]ដៃគូគម្រោង[:en]Project Partners[:]");?></p>
												<p class ="detail"><?php echo $row->organization_name;?></p>
											</div>
										<?php endif; 
									?>
									
									<div class="text-title">
										<p class="name"><?php _e("[:km]ស្ថានភាពគម្រោង[:en]Project Status[:]");?></p>
										<p class ="detail"><?php _e("[:km]Registered[:en]Registered[:]");?></p>
									</div>
								<?php
									}
									}
								?>
								<div class="text-title mb-4">
									<?php 
										if($getProjectData->view_issued_records) : ?>
											<a target="_blank" href="<?php echo $getProjectData->view_issued_records?>"><?php _e("[:km]មើលកំណត់ត្រាដែលបានចេញ[:en]View issued records[:]");?></a><br>
										<?php endif; 
									?>
									<?php 
										if($getProjectData->view_buffer_records) : ?>
											<a target="_blank" href="<?php echo $getProjectData->view_buffer_records?>"><?php _e("[:km]មើលកំណត់ត្រាបម្រុង[:en]View buffer records[:]");?></a>
										<?php endif; 
									?>
								</div>
								</div>
							<div class="chart-container mainChart">
								<div class="project-name mb-3">
									<p><?php _e("[:km]ការកាត់បន្ថយការបញ្ចេញឧស្ម័នប្រចាំឆ្នាំនៃគម្រោងក្រវ៉ាញខាងត្បូង (ឯកតាគិតជាលានតោនឧស្ម័នកាបូនិក tCO2eq)[:en]Southern Cardamon Annual Emission Reductions (unit in M tCO2eq)[:]");?></p>
								</div> 

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
									<div id="container_chart_approved"></div>
								</div>
							</div>	
						</div>
					</div>
					<div class="row text-above-footer">
						<?php if( get_field('text_above_footer') ): ?>
							<p class="nomal-text"><span class="color-text">Disclaimers:</span> <?php echo get_field('text_above_footer');?></p>
						<?php endif; ?>
						
					</div>
				</div>
				
			</div>
			
		</div>
        <?php endwhile; ?>

	<?php }

get_footer();