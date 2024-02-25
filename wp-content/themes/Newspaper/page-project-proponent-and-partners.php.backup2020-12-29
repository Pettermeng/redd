<?php

/* Template Name: Project Proponent and Partner */


get_header();
	// session_start();
	global $wpdb;
	$table_name = $wpdb->prefix . "organization_category";

	$organizations = $wpdb->get_results( "SELECT * FROM $table_name order by title_en asc", OBJECT );

	$fullurl = get_permalink(get_page_by_path( 'project-detail' ));
	$reUrl = str_replace("register-project.html","project-detail.html",$fullurl);

	if (have_posts()) { ?>

		<div class="body-container">
			<!-- Block menu page  -->
			<div class="header-margin-bottom"></div>
				<div class="td-crumb-container">
					<?php echo td_page_generator::get_page_breadcrumbs(get_the_title()); ?>
				</div>
			<div class="header-margin-top"></div>
			<!-- End Block menu page  -->

			<div class="content-container-proponent_partner">

				<div class="container no-padding">
					<!-- block process -->
					<div class="processStep">
						<div class="step1 active">
							<div class="point"></div>
							<div class="titleStep"><?php _e("[:km]ប្រតិបត្តិការនិង<br>ដៃគូគម្រោងរេដបូក[:en]Project Proponent<br>and Partners[:]");?></div>
						</div>
						<div class="step2">
							<div class="point"></div>
							<div class="titleStep project-detaile-desktop"><?php _e("[:km]គម្រោងលម្អិត[:en]Project Details[:]");?></div>
							<div class="titleStep project-detaile-mobile"><?php _e("[:km]គម្រោង<br>លម្អិត [:en]Project<br>Details[:]");?></div>
						</div>
						<div class="step3">
							<div class="point"></div>
							<div class="titleStep"><?php _e("[:km]ការចុះបញ្ជីគម្រោង<br>រេដបូកបានបញ្ចប់[:en]Registration <br> Completed[:]");?></div>
						</div>
					</div>
					<!-- block process -->
				</div>
				<div class="row stepOne"><?php _e("[:km]ប្រតិបត្តិការនិងដៃគូគម្រោងរេដបូក[:en]Project Proponent and Partners[:]");?></div>

				
				
				<!-- Contianer of form  -->
				<form class='row no-padding' action="<?php echo $reUrl;?>" method="post" enctype="multipart/form-data" id="blockStep1">
					<!-- project proponent  -->
					<div class="col-lg-12  form-container">
						<div class="title-container">
							<div class="title">
								<p> <?php _e("[:km]ប្រតិបត្តិការគម្រោង[:en]Project Proponent[:]");?></p>
							</div>
						</div>
						<div class="row proponent-container  no-padding">
							<div class="col-lg-8 col-sm-12">
								<div class="form-group">
									<label for="name-org" class="name-org"><?php _e("[:km]ឈ្មោះស្ថាប័ន/អង្គការ[:en]Name of Organization[:]");?>*</label>
									<input class="form-control require organization-name" type="text" id="name_org_pp" name="organization_name" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>">
								</div>
							</div>
							<div class="col-lg-4">
								<label for="category" class="organizational-category"><?php _e("[:km]ប្រភេទស្ថាប័ន/អង្គការ[:en]Organizational Category[:]");?>*</label>
								<select class="form-control require category" id="catagory-pp" name="id_cate_org">
									<option value=""><?php _e("[:km]ជ្រើសរើសយកមួយក្នុងចំណោមចំណុចដូចខាងក្រោម[:en]Choose one of following[:]");?></option>
									<?php foreach ( $organizations as $row ) { ?>
										<option value="<?php echo $row->id;?>" <?php if($_SESSION["id_cate_org"] == $row->id) echo 'selected';?>><?php echo $row->title_en;?></option>
									<?php }?>
								</select>
							</div>
							<!-- function  -->
							<div class=" col-lg-12 high-top"></div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="function"><?php _e("[:km]មុខងារ/ការទទួលខុសត្រូវ[:en]Function/Responsibility[:]");?>*</label>
									<textarea class="form-control require text-area-style" id="function-pp" name="function-pp" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></textarea>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="address"><?php _e("[:km]អាស័យដ្ឋាន[:en]Address[:]");?>*</label>
									<textarea class="form-control require text-area-style" id="address-pp" name="address-pp" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></textarea>
								</div>
							</div>
							<!-- function  -->
							<!-- Postal  -->
							<div class=" col-lg-12 high-top"></div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="postal"><?php _e("[:km]អាស័យដ្ឋានប្រៃសណីយ (ប្រសិនបើខុសពីអាស័យដ្ឋាន)[:en]Postal Address (if different from Address)[:]");?></label>
									<textarea class="form-control text-area-style" id="postal-pp" name="postal-pp" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></textarea>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="contact"><?php _e("[:km]ជនបង្គោលទំនាក់ទំនង[:en]Contact Person(s)[:]");?>*</label>
									<textarea class="form-control require text-area-style" id="contact-pp" name="contact-pp" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></textarea>
								</div>
							</div>
							<!-- End Postal  -->
							<!-- Email  -->
							<div class=" col-lg-12 high-top"></div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="email"><?php _e("[:km]អ៊ីមេល[:en]Email Address[:]");?>*</label>
									<input class="form-control require" type="text" id="email-pp" name="email-pp"   placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="office-phone"><?php _e("[:km]ទូរស័ព្ទ[:en]Telephone Numbers[:]");?>*</label>
									<input class="form-control phone_number require" type="text" id="office-phone-pp" name="office-phone-pp" placeholder="<?php _e("[:km]លេខទូរស័ព្ទការិយាល័យ[:en]Office number[:]");?>"><br>					
									<input class="form-control phone_number" type="text" id="cell-phone-pp" name="cell-phone-pp" placeholder="<?php _e("[:km]លេខទូរស័ព្ទ[:en]Cell number[:]");?>">						
								</div>
							</div>
							<!-- End Email  -->
							<!-- Fax Number  -->
							<div class="col-lg-6">
								<div class="form-group">
									<label for="email"><?php _e("[:km]លេខទូរសារ[:en]Fax Number[:]");?></label>
									<input class="form-control phone_number" type="text" id="fax-pp" name="fax-pp" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>">
								</div>
							</div>
							<!-- End Fax Number  -->
							<!-- description -->
							<div class="col-lg-12 description">
								<p>
									<?php _e("[:km]ផ្តល់ព័ត៌មានស្តីពីស្ថាប័ន/អង្គការពាក់ព័ន្ធ ដែលជាភ័ស្តុតាងបង្ហាញពីភាពសមស្របក្នុងការអនុវត្តគម្រោងរេដបូកនៅកម្ពុជា រួមទាំង[:en]Provide information about the organization(s) involved that provide evidence of the suitability to implement a REDD+ project in Cambodia, including[:]");?>*
								</p>
							</div>
							<!-- description -->
							<!-- description -->
							
							<div class=" col-lg-12 high-top"></div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="activities_pro" class="detail">
										<?php _e("[:km]សមត្ថភាពអនុវត្តសកម្មភាពគម្រោងរេដបូកដែលបានលើកស្នើឡើង រួមទាំងធនធានហិរញ្ញវត្ថុ ធនធានបច្ចេកទេស និងធនធានមនុស្សដែលស្ថាប័ន/អង្គការមាន)[:en]Capacity to undertake the activities required by the project, including financial, technical, human resources available)[:]");?>*
									</label>
									<textarea class="form-control require text-area-style" id="activities_pro" name="activities_pro"  placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></textarea>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="activities_related" class="detail-margin">
										<?php _e("[:km]កំណត់ត្រាបទពិសោធន៍ក្នុងការអនុវត្តសកម្មភាពពាក់ព័ន្ធនិងការអភិរក្ស ឬស្តារធនធានព្រៃឈើឡើងវិញ[:en]Track record of activities related to forest conservation or restoration[:]");?>
									</label>
									<textarea class="form-control text-area-style" id="activities_related" name="activities_related" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></textarea>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="activities_20yr" class="detail-margin">
										<?php _e("[:km]លទ្ធភាព និងការប្ដេជ្ញាចិត្តអនុវត្តសកម្មភាពគម្រោងយ៉ាងតិច រយៈពេល ២០ ឆ្នាំ[:en]Ability and commitment to undertake project activities for at least 20 years[:]");?>
									</label>
									<textarea class="form-control text-area-style" id="activities_20yr" name="activities_20yr"  placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></textarea>
								</div>
							</div>
						</div>
					</div><br>
					<!-- project proponent  -->
					<!-- project Partner  -->
					<div class="col-lg-12 form-container">
						
						<div class="title-container">
							<div class="itle">
								<p><?php _e("[:km]ដៃគូគម្រោងរេដបូក[:en]Project Partner(s)[:]");?></p>
							</div>
						</div>
						<div class="row proponent-container  no-padding ">
							<div class="mainPartner">
								<div class="row col-lg-12 contentProponentpartner ">
									<!-- <div class="removeIconFile"><i class="fa fa-times txt-color-red eventDelete" aria-hidden="true"></i></div> -->
									<div class="col-lg-8 organization-name no-padding-right">
										<div class="form-group">
											<label for="partner"><?php _e("[:km]ឈ្មោះស្ថាប័ន/អង្គការ(ដៃគូគម្រោងរេដបូក)[:en]Name of Organization(Project Partner)[:]");?>*</label>
											<input class="form-control require organization-name" type="text" id="name-org-partner" name="name-org-partner[]" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>">
										</div>
									</div>
									<div class="col-lg-4 no-padding-right">
										<label for="category" class="organizational-category"><?php _e("[:km]ប្រភេទស្ថាប័ន/អង្គការ[:en]Organizational Category[:]");?>*</label>
										<select class="form-control require category" id="category-partner" name="category-partner[]">
											<option value=""><?php _e("[:km]ជ្រើសរើសយកមួយក្នុងចំណោមចំណុចដូចខាងក្រោម[:en]Choose one of following[:]");?></option>
											<?php foreach ( $organizations as $row ) { ?>
												<option value="<?php echo $row->id;?>" <?php if($_SESSION["id_cate_org_partner"] == $row->id) echo "selected";?>><?php echo $row->title_en;?></option>
											<?php }?>
										</select>
									</div>
									<!-- function  -->
									<div class=" col-lg-12 high-top"></div>
									<div class="col-lg-6 function-right no-padding-right">
										<div class="form-group">
											<label for="function"><?php _e("[:km]មុខងារ/ការទទួលខុសត្រូវ[:en]function/Responsibility[:]");?>*</label>
											<textarea class="form-control require text-area-style" id="function-partner" name="function-partner[]" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></textarea>
										</div>
									</div>
									<div class="col-lg-6 no-padding-right">
										<div class="form-group">
											<label for="address"><?php _e("[:km]អាស័យដ្ឋាន[:en]Address[:]");?>*</label>
											<textarea class="form-control require text-area-style" id="address-partner" name="address-partner[]" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></textarea>
										</div>
									</div>
									<!-- function  -->
									<!-- Postal  -->
									<div class=" col-lg-12 high-top"></div>
									<div class="col-lg-6 postal-right no-padding-right">
										<div class="form-group">
											<label for="postal"><?php _e("[:km]អាស័យដ្ឋានប្រៃសណីយ (ប្រសិនបើខុសពីអាស័យដ្ឋាន)[:en]Postal Address (if different from Address)[:]");?></label>
											<textarea class="form-control  text-area-style" id="postal-partner" name="postal-partner[]" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></textarea>
										</div>
									</div>

									<div class="col-lg-6 no-padding-right">
										<div class="form-group">
											<label for="contact"><?php _e("[:km]ជនបង្គោលទំនាក់ទំនង[:en]Contact Person(s)[:]");?>*</label>
											<textarea class="form-control require text-area-style" id="contact-partner" name="contact-partner[]" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></textarea>
										</div>
									</div>
									<!-- End Postal  -->
									<!-- Email  -->
									<div class=" col-lg-12 high-top"></div>
									<div class="col-lg-6 email-right no-padding-right">
										<div class="form-group">
											<label for="email"><?php _e("[:km]អ៊ីមេល[:en]Email Address[:]");?>*</label>
											<input class="form-control require" type="text" id="email-partner" name="email-partner[]" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>">
										</div>
									</div>
									<div class="col-lg-6 no-padding-right">
										<div class="form-group">
											<label for="office-phone"><?php _e("[:km]ទូរស័ព្ទ[:en]Telephone Numbers[:]");?>*</label>
											<input class="form-control phone_number require" type="text" id="office-phone-partner" name="office-phone-partner[]" placeholder="<?php _e("[:km]លេខទូរស័ព្ទការិយាល័យ[:en]Office number[:]");?>"><br>					
											<input class="form-control phone_number" type="text" id="cell-phone-partner" name="cell-phone-partner[]" placeholder="<?php _e("[:km]លេខទូរស័ព្ទ[:en]Cell number[:]");?>">						
										</div>
									</div>
									<!-- End Email  -->
									<!-- Fax Number  -->
									<div class="col-lg-6 fix-right no-padding-right">
										<div class="form-group">
											<label for="fax-partner"><?php _e("[:km]លេខទូរសារ[:en]Fax Number[:]");?></label>
											<input class="form-control phone_number" type="text" id="fax-partner" name="fax-partner[]" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>">
										</div>
									</div>
									<div class="col-lg-12 border-style">
										
									</div>
								</div>
							</div>


							<!-- End Fax Number  -->
							<!-- button add more partner  -->
							<div class=" col-lg-12"></div>
							<div class="col-lg-12 add-more-partner-container">
								<button type="button" class="add_more_partner" id="add_more_partner"><?php _e("[:km]បញ្ជាក់បន្ថែមដៃគូអនុវត្តគម្រោងប្រសិនបើមាន[:en]Add More Partners[:]");?></button>
							</div>
							<div class=" col-lg-12 high-top"></div>
							<!-- button add more partner  -->
							<div class="col-lg-6 field-require" id="field-require">*<?php _e("[:km]ត្រូវការបំពេញព័ត៌មានចាំបាច់[:en]Required fields[:]");?></div>
							<div class="col-lg-6 next-container">
								<button type="button" class="col-lg-3 next" id="next"><?php _e("[:km]ទៅមុខ[:en]Next[:]");?></button>
							</div>
							</div>
						</div>
					<!-- project Partner  -->
				</form>	
				
				<!-- End Contianer of form  -->

				
				
			</div>
		</div>
	<?php 
	

}

	
get_footer();