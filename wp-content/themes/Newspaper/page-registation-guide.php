<?php

/* Template Name: Registation Guide */


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
			
			<div class="content-container-guide">
				<div class="container">
					<div class="row no-margin">
						<p class="title col-md-10 col-sm-12"><?php _e("[:km]ដំណើរការចុះបញ្ជី[:en]Registration Process[:]");?></p>
						<div class="drawline col-md-12 col-sm-12"></div>
						<div class="text-detail">
							<?php echo the_content() ?>
							<!-- <p>Process to register a REDD+ project in the national REDD+ project database</p>
							<ol>
								<li>A REDD+ Project Proponent seeking to register a REDD+ Project in the National REDD+ Project Database shall <br>notify the RTS and provide:
									<ol class="d">
										<li>A concept note that includes evidence of how the proposed REDD+ Project is aligned with the <br><a href="#">National REDD+ Strategy;</a></li>
										<li><a href="#"> Geographic information</a> on areas covered by the REDD+ Project, in particular its project accounting area.</li>
									</ol>
								</li><br>
								<li>A REDD+ Project Proponent may request a Letter of No Objection (LoNO) from the National Authority for all GHG ER<br> Mechanisms.In order to do so, it must:
									<ol class="d">
										<li><a href="#">Submit a LoNO Request Form </a>and share a concept note with the National Authority;</li>
										<li>Provide evidence that the project is aligned with the National REDD+ Strategy;</li>
										<li>Demonstrate that the project is seeking registration in the National REDD+ Project Database.</li>
									</ol>
								</li><br>

								<li>When a REDD+ Project Proponent is ready to formally apply for registration in the National REDD+ Project<br> Database, it shall submit to the RTS:
									<ol class="d">
										<li>Two copies of a completed REDD+ registration form <a href="#">(Annex 9 of the Sub-decree);</a></li>
										<li>Any additional documents needed to demonstrate conformance with the Conditions of Eligibility (Chapter 3).</li>
									</ol>
								</li><br>

								<li>Upon receipt of the registration form and supporting documentation, the RTS shall: (a) Record, on behalf of the<br> REDD+ Project Proponent, the request for registration and the date of submission of the registration form in the<br> National REDD+ Project Database; and (b) conduct a completeness check of the documentation submitted. 
									<ol class="d">
										<li>The RTS may request from the project proponent additional documentation if deemed necessary; in such <br>case, the request and date of request should be recorded in the National REDD+ Project Database;</li>
										<li>Once all required documentation has been submitted, within 5 working days, the RTS shall issue to the<br> REDD+ Project Proponent notification of reception of the REDD+ registration request form;</li>
										<li>The RTS shall also post notification of the complete registration form on the National REDD+ <br>Project Database.</li>
									</ol>
								</li><br>

								<li>Once documentation is considered complete, the RTS shall appoint a REDD+ project review team to evaluate the REDD+ project proposal based on its alignment with the Conditions of Eligibility (Chapter 3) and to determine whether the project (or program) should be registered within the National REDD+ Project Database.
									<ol class="d">
										<li>The RTS may keep a “roster” of experts in various fields, such as GHG measurement, REDD+ safeguards and benefit sharing that may be called on to participate in the REDD+ project review team.</li>
										<li>Members serving on the REDD+ project review team should be recorded publicly on the National REDD+ Project Database;</li>
										<li>The RTS shall forward the registration request, including all relevant documents, to the REDD+ project review team and record the date of transmittal in the National REDD+ Project Database.</li>
									</ol>
								</li><br>

								<li>The REDD+ project review team shall provide its findings to the RTS who will take a decision as to the status of the<br> application and notify the REDD+ Project Proponent, within 60 days of the notification on the completeness of the<br> request for registration, as to one of the following:
									<ol class="d">
										<li>The REDD+ Project is eligible to be formally registered in the National REDD+ Project Database; </li>
										<li>Request for modifications to the proposal, based on recommendations from the REDD+ project<br> review team; or </li>
										<li>The proposal is rejected, communicating the reasons for reaching that decision.</li>
									</ol>
								</li><br>

								<li>The REDD+ Project proponent may appeal the decision by sending, in writing, its request to the REDD+ Taskforce.
									<ol class="d">
										<li>The REDD+ Taskforce will be requested to respond to the appeal within 10 working days of the request;</li>
										<li>The date and content of the appeal should be recorded in the National REDD+ Project Database, as well as<br> the response to the appeal.</li>
									</ol>
								</li><br>

								<li>The RTS shall:
									<ol class="d">
										<li>Record the findings of the REDD+ project review team in the National REDD+ Project Database and <br>decisions by the RTS and the REDD+ Taskforce and make these publicly available;</li>
										<li>Make publicly available any appeals by the REDD+ Project Proponent, and responses to such appeals;</li>
										<li>If the REDD+ Project has been accepted, the REDD+ Project shall appear in the formal listing of <br>confirmed REDD+ Projects in the database.</li>
									</ol>
								</li><br>

								<li>Only if standard/registry requires: <a href="#">Request project approval or endorsement</a>
								</li>
							</ol>
							<div class="margin-bottom-32"></div>
							<p>Mauris cursus nec erat vel scelerisque. Donec nisi nunc, consectetur id vulputate a, laoreet nec tellus. Aenean id gravida<br> nibh. Fusce laoreet aliquam nisi, quis pulvinar purus gravida quis. </p>
						 -->
							
							<!-- button block  -->
							<div class="row block_button">
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

											<a <?php if($count == 1) {echo 'target="_blank"';}?> href="<?php echo $url; ?>" class="col-sm-4 col-lg-3 download_button "><?php echo $title?></a>
									<?php endif; ?> 
									<?php endwhile;?>
								<?php endif; ?> 
							</div>
							<!-- button block  -->
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php endwhile; ?>
	<?php }
get_footer();