<?php
session_start();

/* Template Name: Project Detail */

//TEST

get_header();
global $wpdb;
$table_name = $wpdb->prefix . "organization_category";
$organizations = $wpdb->get_results("SELECT * FROM $table_name order by title_en asc", OBJECT);
$table_name = $wpdb->prefix . "project_type";
$project_types = $wpdb->get_results("SELECT * FROM $table_name order by project_type_en asc", OBJECT);

// Get all project from DB to validate unique project name
$table_project_name = $wpdb->prefix . "project";
$all_project_names =  $wpdb->get_results("SELECT project_name FROM $table_project_name");

$baseURL = get_site_url();
$fullurl = get_permalink(get_page_by_path('project-detail'));
$reUrl = str_replace("project-detail.html", "registation-complete.html", $fullurl);
// for store data of org 

if (isset($_POST['organization_name'])) {
	$_SESSION["organization_name"] = $_POST['organization_name'];
	$_SESSION["id_cate_org"] = $_POST['id_cate_org'];
	$_SESSION["function"] = $_POST['function-pp'];
	$_SESSION["address"] = $_POST['address-pp'];
	$_SESSION["postal_address"] = $_POST['postal-pp'];
	$_SESSION["contact_person"] = $_POST['contact-pp'];
	$_SESSION["emails"] = $_POST['email-pp'];
	$_SESSION["office_number"] = $_POST['office-phone-pp'];
	$_SESSION["cell_number"] = $_POST['cell-phone-pp'];
	$_SESSION["fax_number"] = $_POST['fax-pp'];

	$_SESSION["activities_pro"] = $_POST['activities_pro'];
	$_SESSION["activities_related"] = $_POST['activities_related'];
	$_SESSION["activities_20yr"] = $_POST['activities_20yr'];

	$_SESSION["organization_name_partner"] = $_POST['name-org-partner'];
	$_SESSION["id_cate_org_partner"] = $_POST['category-partner'];
	$_SESSION["function_partner"] = $_POST['function-partner'];
	$_SESSION["address_partner"] = $_POST['address-partner'];
	$_SESSION["postal_address_partner"] = $_POST['postal-partner'];
	$_SESSION["contact_person_partner"] = $_POST['contact-partner'];
	$_SESSION["emails_partner"] = $_POST['email-partner'];
	$_SESSION["office_number_partner"] = $_POST['office-phone-partner'];
	$_SESSION["cell_number_partner"] = $_POST['cell-phone-partner'];
	$_SESSION["fax_number_partner"] = $_POST['fax-partner'];
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

		<?php
		if (isset($_GET['status'])) {
		?>
			<div class="alert alert-danger text-left">
				<strong><?php _e("[:km]Project can't be save, please try again.[:en]Project can't be save, please try again.[:]"); ?></strong>
			</div>
		<?php
		}
		?>
		<div class="content-container-project_detail">
			<div class="row stepOne"><?php _e("[:km]Project Details[:en]Project Details[:]"); ?></div>
			<div class="container no-padding">
				<!-- block process -->
				<div class="processStep">
					<div class="step1 active">
						<div class="point"></div>
						<div class="titleStep"><?php _e("[:km]ប្រតិបត្តិការនិង<br>ដៃគូគម្រោងរេដបូក[:en]Project Proponent<br>and Partners[:]"); ?></div>
					</div>
					<div class="step2 active">
						<div class="point"></div>
						<div class="titleStep project-detaile-desktop"><?php _e("[:km]គម្រោងលម្អិត[:en]Project Details[:]"); ?></div>
						<div class="titleStep project-detaile-mobile"><?php _e("[:km]គម្រោង<br>លម្អិត[:en]Project<br>Details[:]"); ?></div>
					</div>
					<div class="step3">
						<div class="point"></div>
						<div class="titleStep"><?php _e("[:km]ការចុះបញ្ជីគម្រោង<br>រេដបូកបានបញ្ចប់[:en]Registration <br> Completed[:]"); ?></div>
					</div>
				</div>


				<!-- block process -->
				<form action="<?php echo $reUrl; ?>" method="post" enctype="multipart/form-data" id="blockStep2">

					<div class="form-container">
						<div class="title-container">
							<div class="title">
								<p><?php _e("[:km]គម្រោងលម្អិត[:en]Project Details[:]"); ?></p>
							</div>
						</div>
						<!-- upload file pdf  -->

						<div class='row'>
							<p class="col-lg-12 title-upload-document" id="title-upload-document"><?php _e("[:km]ការពិពណ៌នាអំពីគម្រោង/ការពិពណ៌នាអំពីការរៀបចំគម្រោង[:en]Project Description/Project Design Description[:]"); ?>*</p>
							<p class="col-lg-12 small-title"><?php _e("[:km]ដាក់ការពិព័ណនាអំពីគម្រោង/ការពិព័ណនាអំពីការរៀបចំគម្រោងតាមជំហានបន្តបន្ទាប់ដូចខាងក្រោម[:en]Upload project description/project design description below[:]"); ?></p>
							<div class="col-lg-12">
								<!-- <form enctype="multipart/form-data"> -->
								<div class="form-group">
									<div class="input-file-style">
										<input type="file" class="form-control-file require" id="upload_document" accept=".docx,.pdf,.xlsx,.pptx">
										<div>
											<div class="row show-container">
												<div onclick="functionUploadFile('upload_document','display-name-file')" class="button-file" id="button-file"><?php _e("[:km]ជ្រើសរើសឯកសារ[:en]Choose files[:]"); ?></div>
												<!-- <div  class="button-file" id="upload-project-description">Choose files</div> -->
												<div class="col-lg-6 display-name" id="display-name"><?php _e("[:km]ឯកសារជាទម្រង់ kml ឯកសារ២ជាទម្រង់kmz[:en]Document1.pdf, Document2.docx[:]"); ?></div>
											</div>

											<!-- start add link to download template -->
											<div col-12>
												<div class="row show-container" style="display: inline; font-size: x-small; font-family: 'Myriad Pro'; font-style: italic;">
													<span>Need an example?</span>
													<a href="<?php echo $baseURL ?>/sample.pdf" Download>
														<span style="color: #077907; text-decoration-line: underline;">
															Download here.
														</span>
													</a>
												</div>
											</div>
											<!-- end add link to download template -->

											<div class="row show-container display-name-file">
												<ul class="fileList"></ul>
											</div>

										</div>
									</div>
								</div>
								<!-- </form> -->
							</div>
						</div>
					</div>
					<div class="row sub-container">
						<div class="col-lg-8 no-padding">
							<div class="form-group">
								<label for="name-org-red" class="name-org-red"><?php _e("[:km]ឈ្មោះគម្រោង[:en]Project Name[:]"); ?>*</label>
								<input class="form-control require organization-name" type="text" id="project-name" name="project-name" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]"); ?>">
								<p style="color:red;font-size:12px;margin-top:8px;opacity:0;" id="project-name-duplicate-label"><?php _e("[:km]ឈ្មោះគម្រោងមានក្នុងប្រព័ន្ធរួចហើយ[:en]The project name already exist[:]"); ?></p>
								<input class="hidden" type="hidden" id="list-project-name" name="list-project-name" value='<?php echo json_encode($all_project_names); ?>'>
							</div>
						</div>
						<div class="col-lg-4 no-padding-on-mobile no-padding-right">
							<div class="form-group">
								<label for="name" class="date_submission"><?php _e("[:km]កាលបរិច្ឆេទដាក់ពាក្យស្នើសុំចុះបញ្ជី[:en]Date of Submission[:]"); ?>*</label>
								<input class="form-control bootstrap-date require" type="text" id="date_submission" name="date_submission" placeholder="<?php _e("[:km]ថ្ងៃ/ខែ/ឆ្នាំ[:en]DD/MM/YYYY[:]"); ?>">
							</div>
						</div>
						<!-- block project description -->
						<div class=" col-lg-12 high-top"></div>
						<div class="col-lg-12 no-padding">
							<div class="form-group">
								<label for="project_description"><?php _e("[:km]សេចក្តីពិពណ៌នាសង្ខេបអំពីគម្រោង - ផែនការសកម្មភាពគម្រោង[:en]Brief Project Description - Intended Project Activities[:]"); ?>*</label>
								<textarea class="form-control require text-area-style" id="project_description" name="project_description" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]"); ?>"></textarea>
							</div>
						</div>

						<!-- block project type -->
						<div class=" col-lg-12 high-top"></div>
						<div class="col-lg-6 no-padding">
							<label for="project-category" class="project-category"><?php _e("[:km]ប្រភេទគម្រោង[:en]Type of Project[:]"); ?>*</label>
							<select class="form-control require category" id="project-type" name="type_project">
								<option value=""><?php _e("[:km]ជ្រើសរើសយកមួយក្នុងចំណោមចំណុចដូចខាងក្រោម[:en]Choose one of following[:]"); ?></option>
								<?php foreach ($project_types as $row) { ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->project_type_en; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-lg-3 bootstrap-date-range no-padding-on-mobile no-padding-right ">
							<div class="form-group">
								<label for="name" class="project_start"><?php _e("[:km]កាលបរិច្ឆេទចាប់ផ្តើម[:en]Project Start Date[:]"); ?>*</label>
								<input class="form-control bootstrap-date-range actual_range require" type="text" id="project_start" name="project_start" placeholder="<?php _e("[:km]ថ្ងៃ/ខែ/ឆ្នាំ[:en]DD/MM/YYYY[:]"); ?>">
							</div>
						</div>
						<div class="col-lg-3 bootstrap-date-range no-padding-on-mobile no-padding-right">
							<div class="form-group">
								<label for="name" class="project_end"><?php _e("[:km]កាលបរិច្ឆេទបញ្ចប់[:en]Project End Date[:]"); ?>*</label>
								<input class="form-control  actual_range require" type="text" id="project_end" name="project_end" placeholder="<?php _e("[:km]ថ្ងៃ/ខែ/ឆ្នាំ[:en]DD/MM/YYYY[:]"); ?>">
							</div>
						</div>

						<!-- block Greenhouse Gases Targeted* -->
						<div class=" col-lg-12 high-top"></div>
						<div class="col-lg-9 no-padding">
							<div class="form-group">
								<label for="greenhouse require" id="label-greenhouse"><?php _e("[:km]គោលដៅកាត់បន្ថយការបញ្ចេញឧស្ម័នផ្ទះកញ្ចក់[:en]Greenhouse Gases Targeted[:]"); ?>*</label>
								<p class="col-lg-12 small-title" style="font-size: x-small; font-family: 'Myriad Pro'; font-style: italic;">
									<?php _e("[:km]បញ្ជាក់និងផ្តល់នូវការប៉ាន់ប្រមាណបរិមាណកាត់បន្ថយការបញ្ចេញឧស្ម័នផ្ទះកញ្ចក់ដែលផ្តល់ដោយគម្រោង (គិតជាតោន)[:en]Specify - and provide estimated emissions reductions of each to be provided by the project (tonnes)[:]"); ?>
								</p>
								<textarea class="form-control require text-area-style " id="greenhouse_gases" name="greenhouse_gases" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]"); ?>"></textarea>
							</div>
						</div>
						<div class="col-lg-3 no-padding-on-mobile no-padding-right">
							<label for="standard" class="project-category"><?php _e("[:km]បទដ្ឋានដែលបានប្រើប្រាស់ដើម្បីបង្កើត(គណនា)បរិមាណកាត់បន្ថយការបញ្ចេញឧស្ម័ន[:en]Standard used to generate ERs[:]"); ?> <sup>1</sup> *</label>
							<select class="form-control require category" id="standard" name="standard">
								<option value=""><?php _e("[:km]ជ្រើសរើសយកមួយក្នុងចំណោមចំណុចដូចខាងក្រោម[:en]Choose one of the following...[:]"); ?></option>
								<option value="1">VCS</option>
								<option value="2">JMC</option>
								<option value="3">Others</option>
							</select>
						</div>
						<div class=" col-lg-12 high-top"></div>
						<div class="col-lg-12 no-padding">
							<div class="form-group">
								<label for="description_strategy">
									<?php _e("[:km]ការពិពណ៌នាអំពីការចូលរួមចំណែករបស់គម្រោងគាំទ្រដល់យុទ្ធសាស្រ្តរេដបូកជាតិ[:en]Description of how the project supports the National REDD+ Strategy[:]"); ?>*
								</label>
								<textarea class="form-control require text-area-style" id="description_strategy" name="description_strategy" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]"); ?>"></textarea>
							</div>
						</div>
						<!-- project location  -->
						<div class=" col-lg-12 high-top"></div>
						<p class="col-lg-12 project-location-title no-padding" id="project-location"><?php _e("[:km]ទីតាំងគម្រោង[:en]Project Location in Vector[:]"); ?>*</p>
						<p class="col-lg-12 small-title"><?php _e("[:km]រួមទាំងរូបសណ្ឋាន (ជាទម្រង់ KML/KMZ/ESRI) ពីទីតាំងភូមិសាស្រ្តគម្រោង[:en]including shapefiles (in KML/KMZ/ESRI format) for relevant geographical locations[:]"); ?></p>
						<!-- upload file kml  -->
						<div class="col-lg-12">
							<!-- <form enctype="multipart/form-data"> -->
							<div class="form-group">
								<div class="input-file-style">
									<input type="file" class="form-control-file require" id="upload_kml" accept=".kmz,.kml,.shp,.shx,.dbf" multiple>
									<div>
										<div class="row show-container">
											<div onclick="functionUploadFile('upload_kml','display-name-kml-file')" class="button-file" id="button-file"><?php _e("[:km]ជ្រើសរើសឯកសារ[:en]Choose files[:]"); ?></div>
											<div class="col-lg-6 display-name" id="display-name-kml">.kml, .kmz</div>
										</div>
									</div>
									<div class="row show-container display-name-kml-file">
										<ul class="fileList"></ul>
									</div>
								</div>
							</div>
							<!-- </form> -->
						</div>




						<div class=" col-lg-12 high-top"></div>
						<p class="col-lg-12 project-location-title no-padding" id="project-location"><?php _e("[:km]ទីតាំងគម្រោងក្នុងវ៉ិចទ័រ[:en]Project Location[:]"); ?>*</p>
						<p class="col-lg-12 small-title"><?php _e("[:km]រួមទាំងរូបសណ្ឋាន ជាទម្រង់ JPG/PNG ។ គុណភាពបង្ហាញរូបភាពដែលបានណែនាំគឺ 300dpi។[:en]including images in JPG/PNG format. Recommended image resolution is 300dpi.[:]"); ?></p>
						<!-- upload file kml  -->
						<div class="col-lg-12">
							<!-- <form enctype="multipart/form-data"> -->
							<div class="form-group">
								<div class="input-file-style">
									<input type="file" class="form-control-file require" id="upload_jpg" accept=".jpg,.png,.svg" multiple>
									<div>
										<div class="row show-container">
											<div onclick="functionUploadFile('upload_jpg','display-name-image-file')" class="button-file" id="button-file"><?php _e("[:km]ជ្រើសរើសឯកសារ[:en]Choose files[:]"); ?></div>
											<div class="col-lg-6 display-name" id="display-name-image">image.jpg image.png image.svg</div>
										</div>
									</div>
									<div class="row show-container display-name-image-file">
										<ul class="fileList"></ul>
									</div>
								</div>
							</div>
							<!-- </form> -->
						</div>




						<p class="col-lg-12 no-padding" id="document-optional">
							<?php _e("[:km]សូមផ្ដល់នូវឯកសារបន្ថែមពាក់ព័ន្ធដែលអនុញ្ញាត្តិឱ្យលេខាធិការដ្ឋានរេដបូក និងក្រុមការងារពិនិត្យវាយតម្លៃគម្រោងរេដបូក អាចបញ្ជាក់បានថាគម្រោងរេដបូកសុំចុះបញ្ជីបំពេញទៅតាមវិធាននានាដែលបានដាក់ចេញដោយរាជរដ្ឋាភិបាលកម្ពុជា (មិនតម្រូវ/ជាជម្រើស)[:en]Please provide any other information that allows the REDD+ Taskforce Secretariat, and the REDD+ 
								project review team, to confirm the project has met the applicable rules issued by the RGC. (optional)[:]"); ?>

						</p>
						<!-- upload file pdf  -->
						<div class="col-lg-12">
							<!-- <form enctype="multipart/form-data"> -->
							<div class="form-group">
								<div class="input-file-style">
									<input type="file" class="form-control-file" id="upload_optional" accept=".docx,.pdf,.xlsx,.pptx" multiple>
									<div>
										<div class="row show-container">
											<div onclick="functionUploadFile('upload_optional', 'display-name-optional-file')" class="button-file" id="button-file"><?php _e("[:km]ជ្រើសរើសឯកសារ[:en]Choose files[:]"); ?></div>
											<div class="col-lg-6 display-name" id="display-name-optional"><?php _e("[:km]ឯកសារជាទម្រង់ kml ឯកសារ២ជាទម្រង់kmz[:en]Document1.pdf, Document2.docx[:]"); ?></div>
										</div>
									</div>
									<div class="row show-container display-name-optional-file">
										<ul class="fileList"></ul>
									</div>
								</div>
							</div>
							<!-- </form> -->
						</div>
						<p class="col-lg-12 small-title">
							<?php _e("[:km]<sup>1</sup> ប្រសិនបើគម្រោងរេដបូកមិនទាន់មាននៅក្នុងបញ្ជីវិជ្ជមាននៃបទដ្ឋានដែលបានអនុម័តដោយរាជរដ្ឋាភិបាលនៅឡើយ ដែលត្រូវបានប្រើប្រាស់ដោយគម្រោងកាបូនព្រៃឈើនោះ សូមផ្តល់ព័ត៌មានពាក់ព័ន្ធចាំបាច់ ដើម្បីឱ្យលេខាធិការដ្ឋានរេដបូកអាចវាយតម្លៃលើបទដ្ឋានស្នើឡើងនោះ ស្របទៅតាមគោលការណ៍ណែនាំដែលមានចែងក្នុងប្បញ្ញត្តិដាច់ដោយឡែក[:en]<sup>1</sup> If the project is not already on a government approved “positive list” of standards that may be used for forest carbon projects, please provide information needed to assess the standard proposed, per any guidance provided in separate regulations.[:]"); ?>

						</p>

					</div>
					<div class="checkbox-container">
						<div class="title-container">
							<div class="title">
								<p><?php _e("[:km]បញ្ជីផ្ទៀងផ្ទាត់[:en]Checklist[:]"); ?></p>
							</div>
						</div>
						<div class='row'>
							<p class="col-lg-12 small-title">
								<?php _e("[:km]តើឯកសារគម្រោង/ឯកសាររៀបចំគម្រោង រួមមាន៖[:en]If the PD/PDD does not include those elements please check the box and attach them[:]"); ?>:
							</p>
						</div>
						<!-- checlist one  -->
						<div class="form-check">
							<input type="checkbox" class="form-check-input checkboxEvent" id="mrv" name="mrv">
							<label class="form-check-label related" id="label-related" for="mrv"><?php _e("[:km]ព័ត៌មានទាក់ទងទៅនឹងការវាស់វែង ការរាយការណ៍ និងការផ្ទៀងផ្ទាត់[:en]MRV related information[:]"); ?></label>
						</div>
						<div class="col-lg-12 hideCheckbox" id="mrvFile">
							<div class="form-group">
								<div class="input-file-style">
									<input type="file" class="form-control-file " id="upload_mrv" accept=".docx,.pdf,.xlsx,.pptx" multiple>
									<div>
										<div class="row show-container">
											<div onclick="functionUploadFile('upload_mrv','display-name-upload_mrv-file')" class="button-file" id="button-file"><?php _e("[:km]ជ្រើសរើសឯកសារ[:en]Choose files[:]"); ?></div>
											<div class="col-lg-6  display-name" id="display-name-upload_mrv"><?php _e("[:km]ឯកសារជាទម្រង់ kml ឯកសារ២ជាទម្រង់kmz[:en]Document1.pdf, Document2.docx[:]"); ?></div>
										</div>
									</div>

									<!-- start add link to download template -->
									<div col-12>
										<div class="row show-container" style="display: inline; font-size: x-small; font-family: 'Myriad Pro'; font-style: italic;">
											<span>Need an example?</span>
											<a href="<?php echo $baseURL ?>/sample.pdf" Download>
												<span style="color: #077907; text-decoration-line: underline;">
													Download here.
												</span>
											</a>
										</div>
									</div>
									<!-- end add link to download template -->

									<div class="row show-container display-name-upload_mrv-file">
										<ul class="fileList"></ul>
									</div>
								</div>
							</div>
						</div>

						<!-- checklist two  -->
						<div class="form-check">
							<input type="checkbox" class="form-check-input checkboxEvent" id="safeguard" name="safeguard">
							<label class="form-check-label related" id="label-safeguard" for="safeguard"><?php _e("[:km]ព័ត៌មានស្តីពីការធានាសុវត្ថិភាពរេដបូក[:en]Safeguard Information[:]"); ?></label>
						</div>
						<!-- <div class=" col-lg-12 high-top"></div> -->
						<div class="col-lg-12  hideCheckbox " id="safeguardFile">
							<div class="form-group">
								<div class="input-file-style">
									<input type="file" class="form-control-file " id="upload_safeguard" accept=".docx,.pdf,.xlsx,.pptx" multiple>
									<div>
										<div class="row show-container ">
											<div onclick="functionUploadFile('upload_safeguard','display-name-safeguard-file')" class="button-file" id="button-file"><?php _e("[:km]ជ្រើសរើសឯកសារ[:en]Choose files[:]"); ?></div>
											<div class="col-lg-6  display-name" id="display-name-safeguard"><?php _e("[:km]ឯកសារជាទម្រង់ kml ឯកសារ២ជាទម្រង់kmz[:en]Document1.pdf, Document2.docx[:]"); ?></div>
										</div>
									</div>

									<!-- start add link to download template -->
									<div col-12>
										<div class="row show-container" style="display: inline; font-size: x-small; font-family: 'Myriad Pro'; font-style: italic;">
											<span>Need an example?</span>
											<a href="<?php echo $baseURL ?>/sample.pdf" Download>
												<span style="color: #077907; text-decoration-line: underline;">
													Download here.
												</span>
											</a>
										</div>
									</div>
									<!-- end add link to download template -->

									<div class="row show-container display-name-safeguard-file">
										<ul class="fileList"></ul>
									</div>
								</div>
							</div>
						</div>

						<!-- checklist three -->
						<div class="form-check">
							<input type="checkbox" class="form-check-input checkboxEvent" id="benefit" name="benefit">
							<label class="form-check-label related" id="label-benefit" for="benefit"><?php _e("[:km]ព័ត៌មានស្តីពីការបែងចែកផលប្រយោជន៍[:en]Benefit-sharing Information[:]"); ?></label>
						</div>
						<div class="col-lg-12 hideCheckbox" id="benefitFile">
							<div class="form-group">
								<div class="input-file-style">
									<input type="file" class="form-control-file " id="upload_benefit" accept=".docx,.pdf,.xlsx,.pptx" multiple>
									<div>
										<div class="row show-container">
											<div onclick="functionUploadFile('upload_benefit','display-name-benefit-file')" class="button-file" id="button-file"><?php _e("[:km]ជ្រើសរើសឯកសារ[:en]Choose files[:]"); ?></div>
											<div class="col-lg-6 display-name " id="display-name-benefit"><?php _e("[:km]ឯកសារជាទម្រង់ kml ឯកសារ២ជាទម្រង់kmz[:en]Document1.pdf, Document2.docx[:]"); ?></div>
										</div>
									</div>

									<!-- start add link to download template -->
									<div col-12>
										<div class="row show-container" style="display: inline; font-size: x-small; font-family: 'Myriad Pro'; font-style: italic;">
											<span>Need an example?</span>
											<a href="<?php echo $baseURL ?>/sample.pdf" Download>
												<span style="color: #077907; text-decoration-line: underline;">
													Download here.
												</span>
											</a>
										</div>
									</div>
									<!-- end add link to download template -->

									<div class="row show-container display-name-benefit-file">
										<ul class="fileList"></ul>
									</div>
								</div>
							</div>
						</div>


					</div>
					<!-- two button  -->
					<div class="row button-container needMarginBottm">
						<div class="row col-lg-7 field-require" id="field-require">

							<?php _e("[:km]ត្រូវការបំពេញព័ត៌មានចាំបាច់[:en]*Required fields[:]"); ?>
						</div>
						<div class=" col-lg-5 no-padding text-right">
							<button type="button" class="col-lg-3 back" id="back"><?php _e("[:km]ថយក្រោយ[:en]Back[:]"); ?></button>
							<button type="button" class="col-lg-3 next" id="next-step"><?php _e("[:km]ទៅមុខ[:en]Next[:]"); ?></button>
							<img class="loader_img" src="<?php echo get_template_directory_uri(); ?>/images/loading_1.gif" alt="">
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>
<?php }
get_footer();
