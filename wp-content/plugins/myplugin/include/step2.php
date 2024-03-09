<div class="container-main ">
    <div class="row pt-4">
        <div class="col-12">
            <h2 class="header-title text-left">Project Details</h2>
        </div>
    </div>
    <div class="row pt-4">
		<div class="col-12 fileupload">
            <label for="exampleFormControlInput1" class="labelinput ">Project Description/Project Design Description</label><br>
            <label for="exampleFormControlInput2" class="sublabelinput ">Upload project description/project design description below</label>
			<!-- <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Choose File</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input require" accept="application/pdf" id="file_project_description"
                    aria-describedby="inputGroupFileAddon01" multiple name="file_project_description[]">
                    <label class="custom-file-label" for="file_project_description">Document.pdf , Document2.pdf</label>
                </div>
            </div> -->
            <div class="form-group">
                <div class="input-file-style">
                    <input 
                        type="file" 
                        class="form-control-file mainFileInput " 
                        id="upload_document"
                        accept="application/pdf,application/vnd.ms-excel"
                        >
                    <div>
                    <div class="row show-container">
                        <div  onclick="functionUploadFile('upload_document','display-name-file')" class="button-file" id="button-file">Choose files</div>
                        <!-- <div  class="button-file" id="upload-project-description">Choose files</div> -->
                        <div class="col-lg-6 display-name" id="title-upload-document">
                            Document.pdf ,Document.pdf
                        </div>
                        
                    </div>
                    <div class="display-name-file">
                        <ul class="fileList">
                            
                        </ul>
                    </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-main pt-4 ">
    <div class="row">
        <div class="col-8">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="labelinput ">Project Name*</label>
                <input type="text" class="form-control require" name="project_name" id="project_name" placeholder="Fill information here...">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group datetime">
                <label for="exampleFormControlSelect1" class="labelinput">Date of Submission*</label>
                <div class="input-group date" data-provide="bootstrap-date">
                    <input type="text" class="form-control bootstrap-date require" id="date_submission" name="date_submission">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <div class="labelinput">Area*</div>
                <input type="number" style="height: 40px;" class="form-control require " name="area" id="area" placeholder="Fill information here...">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="labelinput">Brief Project Description - Intended Project Activities*</label>
                <textarea class="form-control require" id="project_description" rows="3" placeholder="Fill information here..." name="project_description"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="exampleFormControlSelect1" class="labelinput">Type of Project*</label>
                <select class="form-control selectOwrite require" id="type_project" name="type_project">
                    <option value="">Choose one of the following...</option>
                    <?php foreach ( $project_types as $row ) { ?>
                        <option value="<?php echo $row->id;?>"><?php echo $row->project_type_en;?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group datetime">
                <label for="exampleFormControlSelect1" class="labelinput">Project Start Date*</label>
                <div class="input-group date bootstrap-date-range" data-provide="datepicker">
                    <input type="text" class="form-control actual_range require" name="project_start" id="project_start">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group datetime">
                <label for="exampleFormControlSelect1" class="labelinput">Project End Date*</label>
                <div class="input-group date bootstrap-date-range" data-provide="datepicker">
                    <input type="text" class="form-control actual_range require" name="project_end" id="project_end">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-9">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="labelinput">Greenhouse Gases Targeted*</label><br>
                <label for="exampleFormControlInput2" class="sublabelinput ">Specify - and provide estimated emissions reductions of each to be provided by the project (tonnes)</label>
                <textarea class="form-control require" id="greenhouse_gases" name="greenhouse_gases" rows="3" placeholder="Fill information here..."></textarea>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="labelinput">Standard used to generate ERs *</label>
                <select class="form-control selectOwrite require" id="standard" name="standard">
                    <option value="">Choose one of the following...</option>
                    <option value="1">VCS</option>
                    <option value="2">JMC</option>
                    <option value="3">Others</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="labelinput">Description of how the project supports the National REDD+ Strategy*</label>
                <textarea class="form-control require" id="description_strategy" name="description_strategy" rows="3" placeholder="Fill information here..." ></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="labelinput ">View issued records</label>
                <input type="text" class="form-control " name="view_issued_records" id="view_issued_records" placeholder="Fill link here...">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="labelinput ">View buffer records</label>
                <input type="text" class="form-control " name="view_buffer_records" id="view_buffer_records" placeholder="Fill link here...">
            </div>
        </div>
    </div>
    <div class="row">
		<div class="col-12 fileupload">
            <label for="exampleFormControlInput1" class="labelinput ">Project Location*</label><br>
            <label for="exampleFormControlInput2" class="sublabelinput ">including shapefiles (in KML/KMZ format) for relevant geographical locations</label>
			<!-- <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon02">Choose File</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input require" accept=".kml" id="projectLocation_file"
                    aria-describedby="inputGroupFileAddon02" multiple name="projectLocation_file[]">
                    <label class="custom-file-label" for="projectLocation_file">Document.kml , Document2.kmz</label>
                </div>
            </div> -->
            <div class="form-group">
                <div class="input-file-style">
                    <input 
                        type="file" 
                        class="form-control-file mainFileInput require" 
                        id="upload_kml"
                        accept=".kml"
                        multiple>
                    <div>
                        <div class="row show-container">
                            <div onclick="functionUploadFile('upload_kml','display-name-kml-file')" class="button-file" id="button-file">Choose files</div>
                            <div class="col-lg-6 display-name" id="project-location">upload kml file...</div>
                        </div>										
                    </div>
                    <div class="display-name-kml-file">
                        <ul class="fileList">
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
		<div class="col-12 pt-4 fileupload">
            <label for="exampleFormControlInput2" class="sublabelinputStyle2 ">Please provide any other information that allows the REDD+ Taskforce Secretariat, and the REDD+ project review team, to confirm the project has met the applicable rules issued 
by the RGC. (optional)</label>
			<!-- <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon03">Choose File</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" accept="application/pdf" id="otherdocument_file"
                    aria-describedby="inputGroupFileAddon03" multiple name="otherdocument_file[]">
                    <label class="custom-file-label" for="otherdocument_file">Document.pdf , Document2.pdf</label>
                </div>
            </div> -->
            <div class="form-group">
                <div class="input-file-style">
                    <input 
                        type="file" 
                        class="form-control-file mainFileInput" 
                        id="upload_optional"
                        accept="application/pdf,application/vnd.ms-excel"
                        multiple>
                    <div>
                        <div class="row show-container">
                            <div onclick="functionUploadFile('upload_optional', 'display-name-optional-file')" class="button-file" id="button-file">Choose files</div>
                            <div class="col-lg-6 display-name" id="document-optional">Document.pdf ,Document.pdf</div>
                        </div>										
                    </div>
                    <div class="display-name-optional-file">
                        <ul class="fileList">
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-main pt-4 <?php echo $hStep2;?>">
    <div class="row pt-4">
        <div class="col-12">
            <h2 class="header-title text-left">Checklist</h2>
        </div>
    </div>
    <div class="row pt-4">
        <div class="col-12">
            <p class="pStyle">Does the project documents/project design documents include:</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-check ">
                <input class="form-check-input checkboxEvent" type="checkbox" id="mrvCheckbox" name="mrvCheckbox">
                <label class="form-check-label" for="defaultCheck1">
                    MRV related information
                </label>
            </div>
           
        </div>
        <div class="col-12 pt-2 pb-2 hideCheckbox" id="mrvCheckboxFile">
            <!-- <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon04">Choose File</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" accept="application/pdf" id="filepdf_mrv"
                    aria-describedby="inputGroupFileAddon04" multiple name="filepdf_mrv[]">
                    <label class="custom-file-label" for="filepdf_mrv">Document.pdf , Document2.pdf</label>
                </div>
            </div> -->
            <div class="form-group" style="margin-left: 30px;">
                <div class="input-file-style">
                    <input 
                        type="file" 
                        class="form-control-file mainFileInput" 
                        id="upload_mrv"
                        accept="application/pdf,application/vnd.ms-excel"
                        multiple>
                    <div>
                        <div class="row show-container">
                            <div onclick="functionUploadFile('upload_mrv','display-name-upload_mrv-file')" class="button-file" id="button-file">Choose files</div>
                            <div class="col-lg-6  display-name" id="display-name-upload_mrv">Document.pdf ,Document.pdf</div>
                        </div>
                    </div>
                    <div class="display-name-upload_mrv-file">
                        <ul class="fileList">
                            <?php 
                                $docType = $wpdb->get_row("SELECT * FROM $table_list_doc_type WHERE type_code = 'mrv'" );
                                $file_project_description = $wpdb->get_results( "SELECT * FROM $table_lists_documents where id_project = $id_project and id_list_doc_type = $docType->id order by title asc", OBJECT );
                                foreach ($file_project_description as $key => $data) {
                                    
                            ?>
                                <li class="listNameFile" id="remove_id_<?php echo $data->id;?>">
                                    <input type="hidden" name="upload_mrv_old[]" value="<?php echo $data->id;?>">
                                    <a class="removeIconFile" href="#" id="<?php echo $data->id;?>" inputid="upload_document"><i class="fa fa-times txt-color-red eventDelete" aria-hidden="true"></i></a> 
                                    <strong><?php echo $data->title;?></strong>
                                </li>
                            <?php 
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pt-2">
        <div class="col-12">
            <div class="form-check ">
                <input class="form-check-input checkboxEvent" type="checkbox" id="saInCheckbox" name="saInCheckbox">
                <label class="form-check-label" for="defaultCheck1">
                    Safeguard Information
                </label>
            </div>
           
        </div>
        <div class="col-12 pt-2 pb-2 hideCheckbox" id="saInCheckboxFile">
            <!-- <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon05">Choose File</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" accept="application/pdf" id="filepdf_saIn"
                    aria-describedby="inputGroupFileAddon05" multiple name="filepdf_saIn[]">
                    <label class="custom-file-label" for="filepdf_saIn">Document.pdf , Document2.pdf</label>
                </div>
            </div> -->
            <div class="form-group" style="margin-left: 30px;">
                <div class="input-file-style">
                    <input 
                        type="file" 
                        class="form-control-file mainFileInput" 
                        id="upload_safeguard"
                        accept="application/pdf,application/vnd.ms-excel"
                        multiple>
                    <div>
                        <div class="row show-container ">
                            <div onclick="functionUploadFile('upload_safeguard','display-name-safeguard-file')" class="button-file" id="button-file">Choose files</div>
                            <div class="col-lg-6  display-name" id="display-name-safeguard">Document.pdf ,Document.pdf</div>
                        </div>
                    </div>
                    <div class="display-name-safeguard-file">
                        <ul class="fileList">
                            <?php 
                                // $docType = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_list_doc_type WHERE type_code = 'sain'" ) );
                                $docType = $wpdb->get_results( "SELECT * FROM $table_list_doc_type WHERE type_code = 'sain'"  );
                                $file_project_description = $wpdb->get_results( "SELECT * FROM $table_lists_documents where id_project = $id_project and id_list_doc_type = $docType->id order by title asc", OBJECT );
                                foreach ($file_project_description as $key => $data) {
                                    
                            ?>
                                <li class="listNameFile" id="remove_id_<?php echo $data->id;?>">
                                    <input type="hidden" name="upload_safeguard_old[]" value="<?php echo $data->id;?>">
                                    <a class="removeIconFile" href="#" id="<?php echo $data->id;?>" inputid="upload_document"><i class="fa fa-times txt-color-red eventDelete" aria-hidden="true"></i></a> 
                                    <strong><?php echo $data->title;?></strong>
                                </li>
                            <?php 
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pt-2">
        <div class="col-12">
            <div class="form-check ">
                <input class="form-check-input checkboxEvent" type="checkbox" id="bsiCheckbox" name="bsiCheckbox">
                <label class="form-check-label" for="defaultCheck1">
                    Benefit-sharing Information
                </label>
            </div>
           
        </div>
        <div class="col-12 pt-2  pb-2 hideCheckbox" id="bsiCheckboxFile">
            <!-- <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon06">Choose File</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" accept="application/pdf" id="filepdf_bsi"
                    aria-describedby="inputGroupFileAddon06" multiple name="filepdf_bsi[]">
                    <label class="custom-file-label" for="filepdf_bsi">Document.pdf , Document2.pdf</label>
                </div>
            </div> -->
            <div class="form-group" style="margin-left: 30px;">
                <div class="input-file-style">
                    <input 
                        type="file" 
                        class="form-control-file mainFileInput" 
                        id="upload_benefit"
                        accept="application/pdf,application/vnd.ms-excel"
                        multiple>
                    <div>
                        <div class="row show-container">
                            <div onclick="functionUploadFile('upload_benefit','display-name-benefit-file')" class="button-file" id="button-file">Choose files</div>
                            <div class="col-lg-6 display-name " id="display-name-benefit">Document.pdf ,Document.pdf</div>
                        </div>
                    </div>
                    <div class="display-name-benefit-file">
                        <ul class="fileList">
                            <?php 
                                // $docType = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_list_doc_type WHERE type_code = 'bsi'" ) );
                                $docType = $wpdb->get_results( "SELECT * FROM $table_list_doc_type WHERE type_code = 'bsi'" );
                                $file_project_description = $wpdb->get_results( "SELECT * FROM $table_lists_documents where id_project = $id_project and id_list_doc_type = $docType->id order by title asc", OBJECT );
                                foreach ($file_project_description as $key => $data) {
                                    
                            ?>
                                <li class="listNameFile" id="remove_id_<?php echo $data->id;?>">
                                    <input type="hidden" name="upload_benefit_old[]" value="<?php echo $data->id;?>">
                                    <a class="removeIconFile" href="#" id="<?php echo $data->id;?>" inputid="upload_document"><i class="fa fa-times txt-color-red eventDelete" aria-hidden="true"></i></a> 
                                    <strong><?php echo $data->title;?></strong>
                                </li>
                            <?php 
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>