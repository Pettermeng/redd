<style>
    .sfc_subscribe_frm{
        margin-top: -20px;
        margin-bottom: 20px;
    }
    .sfc_subscribe_frm .form-group div{
        display: inline-block;
        margin: 5px 0;
        width: 29%;
    }
    .sfc_subscribe_frm .form-group div input.form_input_text{
        width: 100%;
    }
	#captcha {
		border-right: 1px solid #ccc;
		overflow: hidden;
		width: 200px;
	}
    .sfc_subscribe_frm .default_btn{
		background: #077907;
        color:#FFF;
		border: medium none;
		font-weight: normal;
		padding: 5px !important;
		text-transform: uppercase;
		width: 120px;
	}
</style>
<script type="text/javascript">
	/*var onloadCallback = function() {
		grecaptcha.render("captcha", {
		  "sitekey" : "6LcL2xoTAAAAABFQRPoad5zHvXIp9CYS23ZjRQK3",
		  "theme" 	: "light",
		  "size"	: "normal"
		});
	};*/
</script>
<div id="sfc_wrapper">
<form role="form" id="sfc_subscribe_frm" class="sfc_subscribe_frm">
    <div class="form-group">
        <div><input type="text" class="form-control form_input_text" placeholder="Full Name" name="data[full_name]"></div>
        <div><input type="text" class="form-control form_input_text" name="data[email]" placeholder="Please enter you email address"></div>
        <div><input type="text" class="form-control form_input_text" placeholder="Phone Number" name="data[phone]"></div>
        <!--<li><label>Security Check <span>*</span></label><div id="captcha"></div></li>-->
        <button type="submit" class="default_btn"><?php _e('[:en]SUBSCRIBE ME[:km]ចុះឈ្មោះ[:]');?></button>
    </div>
</form>
</div>
<!--<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>-->
