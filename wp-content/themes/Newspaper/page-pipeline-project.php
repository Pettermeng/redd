<?php

/* Template Name: Pipeline Project */


get_header();
		global $wpdb;
		$table_project = $wpdb->prefix . "project";
		$table_project_progress = $wpdb->prefix . "project_progress";
		$table_project_status = $wpdb->prefix . "project_status";
		$project_id=$_GET['id'];
      $all_project_steps = $wpdb->get_results( "SELECT id,status_en from $table_project_status WHERE parent = 0");
	if (have_posts()) { ?>
		<?php
         $getProjectData = $wpdb->get_row( "SELECT * FROM $table_project WHERE id=$project_id"  );
         if($getProjectData->date_approval != "0000-00-00 00:00:00"){
            $fullurl = get_permalink(get_page_by_path( 'project-approved' ));
	         $reUrl = str_replace("pipeline-project.html","project-approved.html",$fullurl);
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
			<div class="content-container-pipeline">
				<div class="container no-padding-pipeline ">
					<div class="row no-gutters">
						<p class="title col-md-10 col-sm-12">
							<?php echo $getProjectData->project_name;?>
						</p>
						<div class="drawline col-lg-12"></div>
						<p class="detail col-lg-12">
							<?php echo $getProjectData->project_description;?>	
						</p>
               </div>
               <div class="row no-gutters header">
                     <div class="col-lg-6 col6 text-left pipeline-progress ">
                        <p><?php _e("[:km]វឌ្ឍនៈភាពគម្រោង[:en]Project Progress[:]");?></p>
                     </div>
                     <div class="col-lg-2 col-2 text-left pipeline-progress ">
                        <p><?php _e("[:km]Start date[:en]Start date[:]");?></p>
                     </div>
                     <div class="col-lg-2 col-2 text-left pipeline-progress ">
                        <p><?php _e("[:km]End date[:en]End date[:]");?></p>
                     </div>
                     <div class="col-lg-2 col-2 text-right pipeline-status">
                        <p><?php _e("[:km]ស្ថានភាពគម្រោង[:en]Status[:]");?></p>
                     </div>
                     
               </div>
               
					<?php
						$getProjectOne = $wpdb->get_row( "SELECT * from $table_project_progress as proProgress INNER JOIN $table_project_status as proStatus on proProgress.id_status = proStatus.id WHERE proProgress.id_project=$project_id  AND proStatus.id=1"  );
					?>
					<?php
						$fetchProject = $wpdb->get_results( "SELECT DISTINCT proProgress.id_project, proProgress.date as start_date,proProgress.end_date,proProgress.step_status, proStatus.id,proStatus.status_en, proStatus.parent from redd_project_progress as proProgress INNER JOIN redd_project_status as proStatus on proProgress.id_status =proStatus.id WHERE proProgress.id_project=$project_id  AND proStatus.parent=0" );
                  $merged_array = $fetchProject + $all_project_steps;

                  if($merged_array){
							foreach ( $merged_array as $key=> $row ) {
					?>
                  
                  
                  <div class="row first "> 
                     <div class="col-lg-12 width-text">
                        <div class="row no-gutters">
                           <!-- Project STEP" -->
                           <div class="col-sm-6 text-left first-title ">
                                 <?php echo $row->status_en;?>
                           </div>
                           <!-- Project START DATE" -->
                           <div class="col-sm-2 text-left ">
                              <?php echo $row->start_date;?>
                           </div>
                           <!-- Project END DATE" -->
                           <div class="col-sm-2 text-left ">
                              <?php echo $row->end_date;?>
                           </div>
                           <!-- Status row "completed, ongoing, not started" -->
                           <div class="col-sm-2 text-lg-right text-center width-button">
                              <?php if($row->step_status=='C') : ?>
                                 <p class='text-white bg-success p-2'>
                                    <?php _e("[:km]ដំណើរការបញ្ចប់[:en]COMPLETED[:]");?>
                                 </p>	
                              <?php elseif($row->step_status=='O') : ?>
                                 <p class='text-white bg-warning p-2'>
                                    <?php _e("[:km]កំពុងដំណើរការ[:en]ONGOING[:]");?>
                                 </p>
                              <?php else : ?>
                                 <p class='text-white bg-secondary p-2'>
                                    <?php _e("[:km]មិនទាន់ចាប់ផ្តើម[:en]Not yet started[:]");?>
                                    									
                                 </p>
                              <?php endif; ?>
                              
									</div>
                        </div>
                         <!-- Progress description -->
                        <div class="row no-gutters mt-2 mb-4">
                           <?php
                              $projectDetail = $wpdb->get_results( "SELECT * from $table_project_progress as proProgress INNER JOIN $table_project_status as proStatus on proProgress.id_status = proStatus.id WHERE proProgress.id_project=$project_id  AND proStatus.id=$row->id" );
                              if($projectDetail){
                                 foreach ( $projectDetail as $subrow ) {
                           ?>
                                 <div class="col-lg-9 col-9 text-left text">
                                    <p class="pl-3">- <?php echo $subrow->process;?></p>
                                 </div>
                           <?php
                                       
                                 }
                              }

                              if($row->id == 4){
                                 $statusSub = $wpdb->get_results( "SELECT * from $table_project_progress as proProgress INNER JOIN $table_project_status as proStatus on proProgress.id_status = proStatus.id WHERE proProgress.id_project=$project_id  AND proStatus.parent=$row->id" );
                                 // var_dump($statusSub);
                                 if($statusSub){
                                    foreach ( $statusSub as $subrow ) {
                           ?>

                                    <div class="col-lg-9 col-9 text-left text">
                                       <p class="pl-3">- <?php echo $subrow->process;?></p>
                                    </div>
                                    <div class="col-lg-3 col-3 text-right">
                                       <?php if($subrow->id==2 || $subrow->id==3) { ?>
                                          <p class='pr-2'>
                                             <?php echo $subrow->date;?>								
                                          </p>
                                       <?php 
                                       }
                                       ?>
                                    </div>

                                    <?php 
                                       if($subrow->id == 7){
                                          $statusSub2 = $wpdb->get_results( "SELECT * from $table_project_progress as proProgress INNER JOIN $table_project_status as proStatus on proProgress.id_status = proStatus.id WHERE proProgress.id_project=$project_id  AND proStatus.parent=$subrow->id" );
                                          // var_dump($statusSub);
                                          if($statusSub){
                                             foreach ( $statusSub2 as $subrow2 ) {
                                    ?>
                                                <div class="col-lg-9 col-9 text-left text">
                                                   <p class="pl-5">+ <?php echo $subrow2->status_en;?></p>
                                                </div>
                                                <div class="col-lg-3 col-3 text-right">
                                                   <?php if($subrow2->id==2 || $subrow2->id==3) { ?>
                                                      <p class='pr-2'>
                                                         <?php echo $subrow2->date;?>								
                                                      </p>
                                                   <?php 
                                                   }
                                                   ?>
                                                </div>

                                                <?php 
                                                   if($subrow2->id==9){
                                                      $statusSub3 = $wpdb->get_results( "SELECT * from $table_project_progress as proProgress INNER JOIN $table_project_status as proStatus on proProgress.id_status = proStatus.id WHERE proProgress.id_project=$project_id  AND proStatus.parent=$subrow2->id" );
                                                      // var_dump($statusSub);
                                                      if($statusSub3){
                                                         foreach ( $statusSub3 as $subrow3 ) {
                                                ?>
                                                            <div class="col-lg-9 col-9 text-left text">
                                                               <p class="" style="padding-left: 80px;">+ <?php echo $subrow3->status_en;?></p>
                                                            </div>
                                                            <div class="col-lg-3 col-3 text-right">
                                                               <?php if($subrow3->id==2 || $subrow3->id==3) { ?>
                                                                  <p class='pr-2'>
                                                                     <?php echo $subrow3->date;?>								
                                                                  </p>
                                                               <?php 
                                                               }
                                                               ?>
                                                            </div>
                                                <?php 
                                                         }
                                                      }
                                                   }
                                                ?>
                                    <?php 
                                             } //end forloop
                                          } // end if
                                       }
                                    ?>

                           <?php 
                                    } //end loop
                                 } //end if
                              } //end if
                           ?>
                        </div>
                     </div>
                  </div>
                  
					<?php
							}
						}
					?>
				</div>
		</div>
		</div>
        <?php endwhile; ?>
	<?php }
get_footer();