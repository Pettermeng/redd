    <div class="container-main ">
		<div class="row pt-4">
			<div class="col-12">
				<h2 class="header-title text-left">Project Proponent</h2>
			</div>
		</div>
		
		<div class="row">
			<div class="col-8">
				<div class="form-group">
					<label for="exampleFormControlInput1" class="labelinput">Name of Organization*</label>
					<input type="text" value="<?php echo $_SESSION["organization_name"];?>" class="form-control require " name="organization_name" id="organization_name" placeholder="Fill information here...">
				</div>
			</div>
			<div class="col-4">
				<div class="form-group">
					<label for="exampleFormControlSelect1" class="labelinput">Organizational Category*</label>
					<select class="form-control selectOwrite require" name="id_cate_org" id="id_cate_org">
						<option value="">Choose one of the following...</option>
						<?php foreach ( $organizations as $row ) { ?>
							<option value="<?php echo $row->id;?>" <?php if($_SESSION["id_cate_org"] == $row->id) echo 'selected';?>><?php echo $row->title_en;?></option>
						<?php }?>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<div class="form-group">
					<label for="exampleFormControlInput1" class="labelinput">Fuction/Responsibility*</label>
					<textarea class="form-control require" name="funtcion" id="funtcion" rows="3" placeholder="Fill information here..."><?php echo $_SESSION["funtcion"];?></textarea>
				</div>
			</div>
			<div class="col-6">
				<div class="form-group">
					<label for="exampleFormControlInput1" class="labelinput">Address*</label>
					<textarea class="form-control require" name="address" id="address" rows="3" placeholder="Fill information here..."><?php echo $_SESSION["address"];?></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<div class="form-group">
					<label for="exampleFormControlInput1" class="labelinput">Postal Address (if different from Address)</label>
					<textarea class="form-control" name="postal_address" id="postal_address" rows="3" placeholder="Fill information here..."><?php echo $_SESSION["postal_address"];?></textarea>
				</div>
			</div>
			<div class="col-6">
				<div class="form-group">
					<label for="exampleFormControlInput1" class="labelinput">Contact Person(s)*</label>
					<textarea class="form-control require" name="contact_person" id="contact_person" rows="3" placeholder="Fill information here..."><?php echo $_SESSION["contact_person"];?></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<div class="form-group">
					<label for="exampleFormControlInput1" class="labelinput ">Email Address*</label>
					<input type="email" value="<?php echo $_SESSION["emails"];?>" class="form-control require" name="emails" id="emails" placeholder="Fill information here...">
				</div>
			</div>
			<div class="col-6">
				<div class="form-group">
					<label for="exampleFormControlSelect1" class="labelinput">Telephone Numbers*</label>
					<input type="text" class="form-control require" value="<?php echo $_SESSION["office_number"];?>" name="office_number" id="office_number" placeholder="Office number(s)">
					<input type="text" class="form-control" value="<?php echo $_SESSION["cell_number"];?>" name="cell_number" id="cell_number" placeholder="Cell number(s)">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<div class="form-group">
					<label for="exampleFormControlInput1" class="labelinput ">Fax Number(s)</label>
					<input type="text" value="<?php echo $_SESSION["fax_number"];?>" class="form-control" name="fax_number" id="fax_number" placeholder="Fill information here...">
				</div>
			</div>
			<div class="col-6">
				
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<p class="content-style-1">
				Provide information about the organization(s) involved that provide evidence of the suitability to implement a REDD+ project in Cambodia, including*
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<div class="form-group">
					<label for="exampleFormControlInput1" class="labelinput-style2">Capacity to undertake the activities required by the project, including financial, technical, human resources available)*</label>
					<textarea class="form-control require" name="activities_pro" id="activities_pro" rows="3" placeholder="Fill information here..."><?php echo $_SESSION["activities_pro"];?></textarea>
				</div>
			</div>
			<div class="col-6">
				<div class="form-group">
					<label for="exampleFormControlInput1" class="labelinput-style2">Track record of activities related to forest conservation<br> or restoration</label>
					<textarea class="form-control " name="activities_related" id="activities_related" rows="3" placeholder="Fill information here..."><?php echo $_SESSION["activities_related"];?></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<div class="form-group">
					<label for="exampleFormControlInput1" class="labelinput-style2">Ability and commitment to undertake project activities for at least 20 years</label>
					<textarea class="form-control " name="activities_20yr" id="activities_20yr" rows="3" placeholder="Fill information here..."><?php echo $_SESSION["activities_20yr"];?></textarea>
				</div>
			</div>
			<div class="col-6">
			</div>
		</div>
	</div>

	<div class="container-main ">
		<div class="row pt-4">
			<div class="col-12">
				<h2 class="header-title text-left">Project Partner(s)</h2>
			</div>
		</div>
	</div>

	<?php 
	if($_SESSION["organization_name_partner"]){
	?>
		<?php for($p=0; $p < count($_SESSION["organization_name_partner"]); $p++ ) { ?>
			<div class="container-main needLoopItem " id="category_<?php echo $p;?>">
				
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<label for="exampleFormControlInput1" class="labelinput ">Name of Organization(Project Partner)*</label>
							<input type="text" value="<?php echo $_SESSION["organization_name_partner"][$p];?>" class="form-control require" name="organization_name_partner[]" id="organization_name_partner" placeholder="Fill information here...">
						</div>
					</div>
					<!-- <div class="col-4">
						<div class="form-group">
							<label for="exampleFormControlSelect1" class="labelinput">Organizational Category*</label>
							<select class="form-control selectOwrite require" id="id_cate_org_partner" name="id_cate_org_partner[]">
								<option value="">Choose one of the following...</option>
								<?php foreach ( $organizations as $row ) { ?>
									<option value="<?php echo $row->id;?>" <?php if($_SESSION["id_cate_org_partner"][$p] == $row->id) echo 'selected';?>><?php echo $row->title_en;?></option>
								<?php }?>
							</select>
						</div>
					</div> -->
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label for="exampleFormControlInput1" class="labelinput">Fuction/Responsibility*</label>
							<textarea class="form-control require" name="funtcion_partner[]" id="funtcion_partner" rows="3" placeholder="Fill information here..." name="funtcion_partner[]"><?php echo $_SESSION["funtcion_partner"][$p];?></textarea>
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label for="exampleFormControlInput1" class="labelinput">Address*</label>
							<textarea class="form-control require" name="address_partner[]" id="address_partner" rows="3" placeholder="Fill information here..." name="address_partner[]"><?php echo $_SESSION["address_partner"][$p];?></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label for="exampleFormControlInput1" class="labelinput">Postal Address (if different from Address)</label>
							<textarea class="form-control " name="postal_address_partner[]" id="postal_address_partner" rows="3" placeholder="Fill information here..." name="postal_address_partner[]"><?php echo $_SESSION["postal_address_partner"][$p];?></textarea>
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label for="exampleFormControlInput1" class="labelinput">Contact Person(s)*</label>
							<textarea class="form-control require" name="contact_person_partner[]" id="contact_person_partner" rows="3" placeholder="Fill information here..." name="contact_person_partner[]"><?php echo $_SESSION["contact_person_partner"][$p];?></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label for="exampleFormControlInput1" class="labelinput ">Email Address*</label>
							<input type="email" value="<?php echo $_SESSION["emails_partner"][$p];?>" class="form-control require" name="emails_partner[]" id="emails_partner" placeholder="Fill information here..." name="emails_partner[]">
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label for="exampleFormControlSelect1" class="labelinput">Telephone Numbers*</label>
							<input type="text" value="<?php echo $_SESSION["office_number_partner"][$p];?>" class="form-control require" name="office_number_partner[]" id="office_number_partner" placeholder="Office number(s)" name="office_number_partner[]">
							<input type="text" value="<?php echo $_SESSION["cell_number_partner"][$p];?>" class="form-control " name="cell_number_partner[]" id="cell_number_partner" placeholder="Cell number(s)" name="cell_number_partner[]">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label for="exampleFormControlInput1" class="labelinput ">Fax Number(s)</label>
							<input type="text" value="<?php echo $_SESSION["fax_number_partner"][$p];?>" class="form-control " name="fax_number_partner[]" id="fax_number_partner" placeholder="Fill information here..." name="fax_number_partner[]">
						</div>
					</div>
					<div class="col-6">
						
					</div>
				</div>

			</div>
		<?php }?>

	<?php }else{?>
		<div class="container-main needLoopItem <?php echo $hStep1;?>" id="category_0">
			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<label for="exampleFormControlInput1" class="labelinput ">Name of Organization(Project Partner)*</label>
						<input type="text" class="form-control require" name="organization_name_partner[]" id="organization_name_partner" placeholder="Fill information here...">
					</div>
				</div>
				<!-- <div class="col-4">
					<div class="form-group">
						<label for="exampleFormControlSelect1" class="labelinput">Organizational Category*</label>
						<select class="form-control selectOwrite require" id="id_cate_org_partner" name="id_cate_org_partner[]">
							<option value="">Choose one of the following...</option>
							<?php foreach ( $organizations as $row ) { ?>
								<option value="<?php echo $row->id;?>"><?php echo $row->title_en;?></option>
							<?php }?>
						</select>
					</div>
				</div> -->
			</div>
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="exampleFormControlInput1" class="labelinput">Fuction/Responsibility*</label>
						<textarea class="form-control require" name="funtcion_partner[]" id="funtcion_partner" rows="3" placeholder="Fill information here..." name="funtcion_partner[]"></textarea>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label for="exampleFormControlInput1" class="labelinput">Address*</label>
						<textarea class="form-control require" name="address_partner[]" id="address_partner" rows="3" placeholder="Fill information here..." name="address_partner[]"></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="exampleFormControlInput1" class="labelinput">Postal Address (if different from Address)</label>
						<textarea class="form-control " name="postal_address_partner[]" id="postal_address_partner" rows="3" placeholder="Fill information here..." name="postal_address_partner[]"></textarea>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label for="exampleFormControlInput1" class="labelinput">Contact Person(s)*</label>
						<textarea class="form-control require" name="contact_person_partner[]" id="contact_person_partner" rows="3" placeholder="Fill information here..." name="contact_person_partner[]"></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="exampleFormControlInput1" class="labelinput ">Email Address*</label>
						<input type="email" class="form-control require" name="emails_partner[]" id="emails_partner" placeholder="Fill information here..." name="emails_partner[]">
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label for="exampleFormControlSelect1" class="labelinput">Telephone Numbers*</label>
						<input type="text" class="form-control require" name="office_number_partner[]" id="office_number_partner" placeholder="Office number(s)" name="office_number_partner[]">
						<input type="text" class="form-control " name="cell_number_partner[]" id="cell_number_partner" placeholder="Cell number(s)" name="cell_number_partner[]">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="exampleFormControlInput1" class="labelinput ">Fax Number(s)</label>
						<input type="text" class="form-control " name="fax_number_partner[]" id="fax_number_partner" placeholder="Fill information here..." name="fax_number_partner[]">
					</div>
				</div>
				<div class="col-6">
					
				</div>
			</div>

		</div>

	<?php }?>

	<div class="container-main contentBtnAdd ">
		<div class="row addMorePartner">
			<div class="col-12 text-left">
				<button type="button" class="btn_add_more" id="add_more_partner">Add More Partners</button>
			</div>
		</div>
	</div>