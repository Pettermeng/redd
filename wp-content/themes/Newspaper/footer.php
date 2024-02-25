

<!-- Instagram -->



<?php if (td_util::get_option('tds_footer_instagram') == 'show') { ?>



<div class="td-main-content-wrap td-footer-instagram-container td-container-wrap <?php echo td_util::get_option('td_full_footer_instagram'); ?>">

    <?php

    //get the instagram id from the panel

    $tds_footer_instagram_id = td_instagram::strip_instagram_user(td_util::get_option('tds_footer_instagram_id'));

    ?>



    <div class="td-instagram-user">

        <h4 class="td-footer-instagram-title">

            <?php echo  __td('Follow us on Instagram', TD_THEME_NAME); ?>

            <a class="td-footer-instagram-user-link" href="https://www.instagram.com/<?php echo $tds_footer_instagram_id ?>" target="_blank">@<?php echo $tds_footer_instagram_id ?></a>

        </h4>

    </div>



    <?php

    //get the other panel seetings

    $tds_footer_instagram_nr_of_row_images = intval(td_util::get_option('tds_footer_instagram_on_row_images_number'));

    $tds_footer_instagram_nr_of_rows = intval(td_util::get_option('tds_footer_instagram_rows_number'));

    $tds_footer_instagram_img_gap = td_util::get_option('tds_footer_instagram_image_gap');

    $tds_footer_instagram_header = td_util::get_option('tds_footer_instagram_header_section');



    //show the insta block

    echo td_global_blocks::get_instance('td_block_instagram')->render(

        array(

            'instagram_id' => $tds_footer_instagram_id,

            'instagram_header' => /*td_util::get_option('tds_footer_instagram_header_section')*/ 1,

            'instagram_images_per_row' => $tds_footer_instagram_nr_of_row_images,

            'instagram_number_of_rows' => $tds_footer_instagram_nr_of_rows,

            'instagram_margin' => $tds_footer_instagram_img_gap

        )

    );



    ?>

</div>



<?php } ?>
<!-- Footer -->
<?php
if (td_util::get_option('tds_footer') != 'no') {
    td_api_footer_template::_helper_show_footer();
}
?>
<!-- Sub Footer -->
<?php if (td_util::get_option('tds_sub_footer') != 'no') { ?>
    <div class="td-sub-footer-container td-container-wrap <?php echo td_util::get_option('td_full_footer'); ?>">
        <div class="td-container">
            <div class="td-pb-row">
                <div class="td-pb-span td-sub-footer-menu">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer-menu',
                            'menu_class'=> 'td-subfooter-menu',
                            'fallback_cb' => 'td_wp_footer_menu'
                        ));
                        //if no menu
                        function td_wp_footer_menu() {
                            //do nothing?
                        }
                        ?>
                </div>
                <div class="td-pb-span td-sub-footer-copy">
                    <?php
                    $tds_footer_copyright = stripslashes(td_util::get_option('tds_footer_copyright'));
                    $tds_footer_copy_symbol = td_util::get_option('tds_footer_copy_symbol');
                    //show copyright symbol
                    if ($tds_footer_copy_symbol == '') {
                        echo '&copy; ';
                    }
                    echo $tds_footer_copyright;
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

</div><!--close td-outer-wrap-->



<?php wp_footer(); ?>

<!-- block chart  -->
<?php 
if(is_page_template( 'page-project-database.php')){

        global $wpdb;
        $table_project = $wpdb->prefix . "project";
        $table_project_reductions = $wpdb->prefix . "project_annual_emission_reductions";
        $table_national_baseline = $wpdb->prefix . "national_baseline";

        $proALL = $wpdb->get_results(" SELECT * FROM $table_project ORDER BY project_name ASC ");
        // var_dump($recordAlls);
        // echo '<pre>'.print_r($recordAlls).'</pre>';
        // block national_baseline
        $national_baseline = $wpdb->get_row( "SELECT * FROM $table_national_baseline"  );
        // var_dump($national_baseline->national_baseline);
        
        $data_verified = array();
        $data_issued = array();
        foreach ($proALL as $row) {

            // block verified
            $subRecord = $wpdb->get_results("
                                    SELECT vintage_end, YEAR(vintage_end) as year, verified
                                    FROM $table_project_reductions 
                                    where id_project = $row->id
                                    GROUP BY YEAR(vintage_end)
                                    ORDER BY YEAR(vintage_end) ASC
                                ");
            foreach ($subRecord as $subrow) {
                $data_verified[$subrow->year] = $data_verified[$subrow->year] + $subrow->verified;
            }

            $subRecord = $wpdb->get_results("
                                    SELECT vintage_end, YEAR(vintage_end) as year, SUM(issued) as issued
                                    FROM $table_project_reductions 
                                    where id_project = $row->id
                                    GROUP BY YEAR(vintage_end)
                                    ORDER BY YEAR(vintage_end) ASC
                                ");
            foreach ($subRecord as $subrow) {
                $data_issued[$subrow->year] = $data_issued[$subrow->year] + $subrow->issued;
            }
        }

        $keyChart = 1000000;

        // block verified
        $dataComplete = '[';
        $labelYearComplete = '[';
        $bLineData = '[';
        ksort($data_verified);
        foreach ($data_verified as $key => $data) {
            // $value = number_format($data / $keyChart, 2, '.', '');
            $dataComplete = $dataComplete.$data.',';
            $labelYearComplete = $labelYearComplete.$key.',';
            $bLineData = $bLineData.$national_baseline->national_baseline.',';
        }
        if(count($data_verified) > 0){
            $rest = substr($dataComplete, 0, -1);
            $dataComplete = $rest.']';
        }else{
            $dataComplete = $dataComplete.']';
        }
        
        if(count($data_verified) > 0){
            $keyYear = substr($labelYearComplete, 0, -1);
            $labelYearComplete = $keyYear.']';
        }else{
            $labelYearComplete = $labelYearComplete.']';
        }
        
        if(count($data_verified) > 0 ){
            $bLineKey = substr($bLineData, 0, -1);
            $bLineData = $bLineKey.']';
        }else{
            $bLineData = $bLineData.']';
        }
        

        // block verified
        $dataIssued = '[';
        ksort($data_issued);
        foreach ($data_issued as $key => $data) {
            // $value = number_format($data / $keyChart, 2, '.', '');
            $dataIssued = $dataIssued.$data.',';
        }
        if(count($data_issued) > 0){
            $rest = substr($dataIssued, 0, -1);
            $dataIssued = $rest.']';
        }else{
            $dataIssued = $dataIssued.']';
        }
        // var_dump($bLineData);
    if($proALL){
?>
        <script>
            Highcharts.chart('container_chart', {
                chart: {
                    type: 'column',
                    backgroundColor: 'none',
                    marginLeft: 20
                },
                navigation: {
                    buttonOptions: {
                        enabled: false
                    }
                },

                title: {
                    text: ''
                },
                xAxis: {
                    categories: <?php echo $labelYearComplete;?>,
                },
                plotOptions: {
                    column: {
                        borderRadius: 0
                    }
                },
                tooltip: {
                    formatter: function () {
                        var value = this.y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        return '<b>' + this.x +'</b><br>'+this.series.name+': ' + value + '</b>';
                    }
                },
                legend:{
                    align: 'left',
                    verticalAlign: 'top',
                    symbolRadius: 0,
                    symbolWidth: 10,
                    symbolHeight: 10,
                    floating: true,
                    enabled: true,
                    x: -20,
                    y: -15,
                    itemStyle: {
                        "color": "#333333", 
                        "cursor": "pointer", 
                        "fontSize": "12px", 
                        "fontWeight": "normal", 
                        "textOverflow": "ellipsis"
                    }
                },
                yAxis: {
                    labels: {
                        align: 'left',
                        format: '{value}',
                        // maxStaggerLines: 0.5,
                        style:{
                            color: '#333333',
                            cursor: 'default',
                            fontSize: '12px',
                        },
                        formatter: function() {	
                            return this.value/<?php echo $keyChart?>;		
                        }
                    },
                    min: 0,
                    startOnTick: false,
                    endOnTick: false
                },
                series: [{
                            type: 'column',
                            name:'Issued',
                            color: '#077907',
                            data: <?php echo $dataIssued;?>
                        }, {
                            type: 'column',
                            name: 'Verified',
                            color: '#83BC83',
                            data: <?php echo $dataComplete;?>
                        },{
                            type: 'spline',
                            name: 'Forest Reference',
                            color: '#333333',
                            data: <?php echo $bLineData;?>,
                            // marker: {
                            //     lineWidth: 1,
                            //     radius: 0,
                            //     width: 5,
                            //     symbol: 'circle',
                            //     // lineColor: Highcharts.getOptions().colors[3],
                            //     fillColor: '#000'
                            // }
                            lineWidth: 2,
                            dashStyle: 'Dash',
                            lineColor: 'orange',
                            type: 'scatter',
                            marker: {
                                enabled: false  
                            },
                            showInLegend: false,
                            enableMouseTracking: true
                            
                }]
            });
        </script>

<?php 
    } 
}
?>

<!-- chart in project approved areal  -->
<?php 
    if(is_page_template( 'page-project-approved.php')){

        global $wpdb;
        $table_project = $wpdb->prefix . "project";
        $table_project_reductions = $wpdb->prefix . "project_annual_emission_reductions";
        $project_id=$_GET['id'];
        // var_dump($_GET['id']);
        
        $data_verified = array();
        $data_issued = array();

        // block verified
        $subRecord = $wpdb->get_results("
                                SELECT vintage_end, YEAR(vintage_end) as year, verified
                                FROM $table_project_reductions 
                                where id_project = $project_id
                                GROUP BY YEAR(vintage_end)
                                ORDER BY YEAR(vintage_end) ASC
                            ");

if($subRecord){
        foreach ($subRecord as $subrow) {
            $data_verified[$subrow->year] = $data_verified[$subrow->year] + $subrow->verified;
        }

        // block issued
        $subRecord = $wpdb->get_results("
                                SELECT vintage_end, YEAR(vintage_end) as year, SUM(issued) as issued
                                FROM $table_project_reductions 
                                where id_project = $project_id
                                GROUP BY YEAR(vintage_end)
                                ORDER BY YEAR(vintage_end) ASC
                            ");
        foreach ($subRecord as $subrow) {
            $data_issued[$subrow->year] = $data_issued[$subrow->year] + $subrow->issued;
        }

        $keyChart = 1000000;

        // block verified
        $dataComplete = '[';
        $labelYearComplete = '[';
        $bLineData = '[';
        ksort($data_verified);
        foreach ($data_verified as $key => $data) {
            // $value = number_format($data / $keyChart, 2, '.', '');
            $dataComplete = $dataComplete.$data.',';
            $labelYearComplete = $labelYearComplete.$key.',';
        }
        $rest = substr($dataComplete, 0, -1);
        $dataComplete = $rest.']';

        $keyYear = substr($labelYearComplete, 0, -1);
        $labelYearComplete = $keyYear.']';


        // block issued
        $dataIssued = '[';
        ksort($data_issued);
        foreach ($data_issued as $key => $data) {
            // $value = number_format($data / $keyChart, 2, '.', '');
            $dataIssued = $dataIssued.$data.',';
        }
        $rest = substr($dataIssued, 0, -1);
        $dataIssued = $rest.']';

        // var_dump($labelYearComplete);
        // var_dump($dataComplete);
        // var_dump($dataIssued);

        // block color
        $colors = array();
        $colors[0][0] = '#23A4D6'; 
        $colors[0][1] = '#B3E5F8';
        $colors[1][0] = '#F68E43'; 
        $colors[1][1] = '#FFBD8D';
        $colors[2][0] = '#E02235'; 
        $colors[2][1] = '#FFACB4';
        $colors[3][0] = '#7B3DAB'; 
        $colors[3][1] = '#DFB7FF';
        $colors[4][0] = '#00CBC5'; 
        $colors[4][1] = '#96E7E5';
        $colors[5][0] = '#059C6E'; 
        $colors[5][1] = '#AEFDCD';
        $colors[6][0] = '#A2A2A2'; 
        $colors[6][1] = '#CACACA'; 
        
        $idColor = $project_id%7;
		if($idColor == 0){
			$idColor = 7;
		}
?>
<script>
    Highcharts.chart('container_chart_approved', {
        chart: {
            type: 'column',
            backgroundColor: 'none',
            marginLeft: 20
        },
        navigation: {
            buttonOptions: {
                enabled: false
            }
        },
        tooltip: {
            formatter: function () {
                var value = this.y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                return '<b>' + this.x +'</b><br>'+this.series.name+': ' + value + '</b>';
            }
        },

        title: {
            text: ''
        },
        xAxis: {
            categories: <?php echo $labelYearComplete;?>,
        },
        plotOptions: {
            column: {
                borderRadius: 0
            }
        },
        legend:{
            align: 'left',
            verticalAlign: 'top',
            symbolRadius: 0,
            symbolWidth: 10,
            symbolHeight: 10,
            floating: true,
            enabled: true,
            x: -20,
            y: -10,
            itemStyle: {
                "color": "#333333", 
                "cursor": "pointer", 
                "fontSize": "12px", 
                "fontWeight": "bold", 
                "textOverflow": "ellipsis"
            }
        },
        yAxis: {
            labels: {
                align: 'left',
                format: '{value}',
                // maxStaggerLines: 0.5,
                style:{
                    color: '#333333',
                    cursor: 'default',
                    fontSize: '12px',
                },
                formatter: function() {	
                    return this.value/<?php echo $keyChart?>;		
                }
            },
            min: 0,
            startOnTick: false,
            endOnTick: false
        },
        series: [
                {
                    type: 'column',
                    name: 'Issued',
                    color: '<?php echo $colors[$idColor-1][0];?>',
                    data: <?php echo $dataIssued;?>
                }, {
                    type: 'column',
                    name: 'Verified',
                    color: '<?php echo $colors[$idColor-1][1];?>',
                    data: <?php echo $dataComplete;?>
                }
        ]
    });
</script>
<?php 
    }else{
?>
<script>
    jQuery(document).ready(function ($) {
        $(".mainChart").hide();
    });
</script>
<?php 
    }
}
?>



<?php 
    if(is_page_template( 'page-project-listing.php')){
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="https://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobubble/src/infobubble.js"></script>
<script type="text/javascript" src="https://geoxml3.googlecode.com/svn/branches/polys/geoxml3.js"></script>
<script type="text/javascript" src="https://geoxml3.googlecode.com/svn/trunk/ProjectedOverlay.js"></script>
    <script>
      function initMap() {
            var map;
            map = new google.maps.Map(document.getElementById('map_show'), {
            mapTypeId: 'terrain',
            center: new google.maps.LatLng(12.3573827, 104.0724153),
            zoom: 7,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
            var data=[];
            <?php

                if(isset($GLOBALS['kmlData'])){ 
                    foreach ($GLOBALS['kmlData'] as $key => $value) { ?>
                        var path = "<?php echo $value->path;?>";
                        var id_project = "<?php echo $value->id_project;?>";
                        var created_at="<?php echo $value->created_at;?>";
                        var organization_name="<?php echo $value->organization_name;?>";
                        var date_approval="<?php echo $value->date_approval;?>";
                        var projectStatus=""
                        if(date_approval=="0000-00-00 00:00:00"){
                                projectStatus="In Pipeline"
                            }
                            else{
                                projectStatus="Approved"
                            }
                        data.push({path:path,id_project:id_project,created_at:created_at,organization_name:organization_name,projectStatus:projectStatus})
            <?php 
                    }
                }
            ?>
            var infowindow = new google.maps.InfoWindow();
            for (const eachData of data) {
                        kmlLayer = new google.maps.KmlLayer(eachData.path, {
                            suppressInfoWindows: true,
                            preserveViewport: true,
                            map: map,
                        });
                        kmlLayer.addListener('click', function (event) {
                            var url="<?php echo get_home_url(); ?>/pipeline-project.html?id="+eachData.id_project;
                            var organization_name=eachData.organization_name;
                            var created_at=eachData.created_at;
                            var projectStatus=eachData.projectStatus;
                            infowindow.setContent(event.featureData.infoWindowHtml+"<p style='color:black;margin:-25px 0px 0px 0px;'>" +'Project Proponent : '+ organization_name +"</><p style='color:black;margin:0px;'>"+'Project Start Date :'+ created_at +" <p style='color:black;margin: 0px;'>" +'Project Status : '+ projectStatus +"</><br><a href='"+url+"'>View page detail</a>");
                            // infowindow.setContent(event.featureData.infoWindowHtml+"<p style='color:black;margin:10px 0px 0px 0px;'>" +'Project Proponent : '+ organization_name +"</><p style='color:black;margin:0px;'>"+'Project Start Date :'+ created_at +" <p style='color:black;margin: 0px;'>" +'Project Status : '+ projectStatus +"</><br><a href='"+url+"'>View page detail</a>");
                            infowindow.setOptions({pixelOffset: event.pixelOffset});
                            infowindow.setPosition(event.latLng);
                            infowindow.open(map);
                        });

            }
      }
    </script>
    

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAKSIjTi_oYsJG_aOIHFQJtfqaByNfXIc&callback=initMap">
    </script>
<?php }?>

<?php 
	global $wpdb;
	$table_name = $wpdb->prefix . "organization_category";
	$organizations = $wpdb->get_results( "SELECT * FROM $table_name order by title_en asc", OBJECT );
?>



<?php 
    if(is_page_template( 'page-project-approved.php')){
?>
<script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map_show'), {
            mapTypeId: 'terrain',
            center: new google.maps.LatLng(12.3573827, 104.0724153),
            zoom: 7,
            mapTypeId: google.maps.MapTypeId.ROADMAP

        });
            var data=["https://redd.s7.bi-kay.com/wp-content/uploads/2020/11/14633_file.kml"];
            <?php
                if(isset($GLOBALS['projectData'])){ 
                    
                    foreach ($GLOBALS['projectData'] as $key => $value) { ?>
                        var path = "<?php echo $value->path;?>";
                        data.push(path)
            <?php 
                    }
                }
            ?>
            for (const eachData of data) {
                        kmlLayer = new google.maps.KmlLayer(eachData, {
                            suppressInfoWindows: true,
                            preserveViewport: true,
                            map: map,
                        });
                        var transitLayer = new google.maps.TransitLayer();
                        transitLayer.setMap(map);
                        kmlLayer.addListener('click', function (event) {
                            
                        });
            }
            
      }

     </script>

    
    <script defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAKSIjTi_oYsJG_aOIHFQJtfqaByNfXIc&callback=initMap">
    </script>
<?php }?>
<!-- end map block  -->

<script>
    jQuery(document).ready(function ($) {
			var countCat = 0;
			// custome add more project partner button
			$('#add_more_partner').click(function (e) {
                countCat++;
                var content = '<div class="row col-lg-12 contentProponentpartner" id = "category_'+countCat+'"><div class="removeIconFile" id = "'+countCat+'"><i class="fa fa-times txt-color-red eventDelete" aria-hidden="true"></i></div><div class="col-lg-12 organization-name no-padding-right"><div class="form-group"> <label for="partner"><?php _e("[:km]ឈ្មោះស្ថាប័ន/អង្គការ(ដៃគូគម្រោងរេដបូក)[:en]Name of Organization(Project Partner)[:]");?>*</label> <input class="form-control require organization-name" type="text" id="name-org-partner'+countCat+'" name="name-org-partner[]" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></div></div><div class=" col-lg-12 high-top"></div><div class="col-lg-6 function-right no-padding-right"><div class="form-group"> <label for="function"><?php _e("[:km]មុខងារ/ការទទួលខុសត្រូវ[:en]Fuction/Responsibility[:]");?>*</label><textarea class="form-control require text-area-style" id="function-partner'+countCat+'" name="function-partner[]" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></textarea></div></div><div class="col-lg-6 no-padding-right"><div class="form-group"> <label for="address"><?php _e("[:km]អាស័យដ្ឋាន[:en]Address[:]");?>*</label><textarea class="form-control require text-area-style" id="address-partner'+countCat+'" name="address-partner[]" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></textarea></div></div><div class=" col-lg-12 high-top"></div><div class="col-lg-6 postal-right no-padding-right"><div class="form-group"> <label for="postal"><?php _e("[:km]អាស័យដ្ឋានប្រៃសណីយ (ប្រសិនបើខុសពីអាស័យដ្ឋាន)[:en]Postal Address (if different from Address)[:]");?></label><textarea class="form-control text-area-style" id="postal-partner'+countCat+'" name="postal-partner[]" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></textarea></div></div><div class="col-lg-6 no-padding-right"><div class="form-group"> <label for="contact"><?php _e("[:km]ជនបង្គោលទំនាក់ទំនង[:en]Contact Person(s)[:]");?>*</label><textarea class="form-control require text-area-style" id="contact-partner'+countCat+'" name="contact-partner[]" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></textarea></div></div><div class=" col-lg-12 high-top"></div><div class="col-lg-6 email-right no-padding-right"><div class="form-group"> <label for="email"><?php _e("[:km]អ៊ីមេល[:en]Email Address[:]");?>*</label> <input class="form-control require" type="text" id="email-partner'+countCat+'" name="email-partner[]" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></div></div><div class="col-lg-6 no-padding-right"><div class="form-group"> <label for="office-phone"><?php _e("[:km]ទូរស័ព្ទ [:en]Telephone Numbers[:]");?>*</label> <input class="form-control phone_number require" type="text" id="office-phone-partner'+countCat+'" name="office-phone-partner[]" placeholder="<?php _e("[:km]លេខទូរស័ព្ទការិយាល័យ[:en]Office number[:]");?>"><br> <input class="form-control phone_number" type="text" id="cell-phone-partner'+countCat+'" name="cell-phone-partner[]" placeholder="<?php _e("[:km]លេខទូរស័ព្ទ[:en]Cell number[:]");?>"></div></div><div class="col-lg-6 fix-right no-padding-right"><div class="form-group"> <label for="fax-partner"><?php _e("[:km]លេខទូរសារ[:en]Fax Number[:]");?></label> <input class="form-control phone_number" type="text" id="fax-partner'+countCat+'" name="fax-partner[]" placeholder="<?php _e("[:km]បំពេញព័ត៌មាននៅទីនេះ...[:en]Fill information here...[:]");?>"></div></div><div class="col-lg-12 border-style"></div></div>';
                $(".mainPartner").append(content);
            });

            $(document).off('click', '.removeIconFile').on('click', '.removeIconFile', function(){
                console.log("RemoveIcon is click")
                var id = $(this).attr('id');
			    $('#category_'+id).remove();
		    });
    });
</script>




</body>

</html>