<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<link href="<?php echo base_url();?>/assets/code_verfiy/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="<?php echo base_url();?>/assets/code_verfiy/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>/assets/code_verfiy/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url();?>/assets/code_verfiy/jquery-1.7.2.min.js"></script>
<body>
<div class="container">
	<div class="row">
	<br /><br /><br /><br /><br /><br />
	<center>
    	<div class="col-sm-6" style="background: rgba(0, 0, 0, -6.3);border-radius: 20px;border: 1px solid #272625;background: rgb(239, 244, 240);
">
        <div class="alert alert-danger" id="codeMsg" style="margin-top: 10px;display:none;"><?php echo lang('chk email validation error'); ?></div>
        <div class="alert alert-success" id="AgaincodeMsg" style="margin-top: 10px;display:none;"><?php echo lang('validation code did not recive error'); ?></div>
		<h2><h1><?php echo lang('chk email'); ?></h1></h2>
        <p class="desc"><?php echo lang('chk email six-digit'); ?> <strong><?php echo $this->session->userdata('reg_email'); ?></strong><?php echo lang('chk email six-digit-enter'); ?></p>
        <br><br>

       <label><span class="normal"><?php echo lang('chk email confirmation-code'); ?></span></label>
                    
         <div class="confirmation_code split_input large_bottom_margin" data-multi-input-code="true">
    			<div class="confirmation_code_group">
					<div class="split_input_item input_wrapper">
                        <input type="text" class="inline_input" maxlength="1" onKeyPress="return isNumberKey(event)" id="code_1" name="code_1">
                    </div>
					<div class="split_input_item input_wrapper">
                        <input type="text" class="inline_input" maxlength="1" onKeyPress="return isNumberKey(event)" id="code_2" name="code_2">
                    </div>
					<div class="split_input_item input_wrapper">
                        <input type="text" class="inline_input" maxlength="1" onKeyPress="return isNumberKey(event)" id="code_3" name="code_3">
                    </div>
				</div>

				<div class="confirmation_code_span_cell"> - </div>

				<div class="confirmation_code_group">
					<div class="split_input_item">
                        <input type="text" class="inline_input" maxlength="1" onKeyPress="return isNumberKey(event)" id="code_4" name="code_4">
                    </div>
					<div class="split_input_item">
                        <input type="text" class="inline_input" maxlength="1" onKeyPress="return isNumberKey(event)" id="code_5" name="code_5">
                    </div>
					<div class="split_input_item">
                        <input type="text" class="inline_input" maxlength="1" onKeyPress="return isNumberKey(event)" id="code_6" name="code_6">
                    </div>
				</div>
			</div>
         
            <span><?php echo lang('validation code did not recive'); ?><a href="javascript:void(0)" onclick="sendAgain();" style="color: #1708fd;"> <?php echo lang('validation code send again'); ?> </a> </span><br><br>

        </div> 

            </div>
	</center>		
    </div>
</div>
</body>

<style type="text/css">

body {
    margin:0;
    padding:0;
    background:url(../themes/default/img/Video_Image.jpg) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
	
}

.input_wrapper{position:relative}
.plastic_select, input[type=url], input[type=text], input[type=tel], input[type=number], input[type=email], input[type=password], select, textarea {
    font-size: 1.25rem;
    line-height: normal;
    padding: .75rem;
    border: 1px solid #C5C5C5;
    border-radius: .25rem;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    outline: 0;
    color: #555459;
    width: 100%;
    max-width: 100%;
    font-family: Slack-Lato,appleLogo,sans-serif;
    margin: 0 0 .5rem;
    -webkit-transition: box-shadow 70ms ease-out,border-color 70ms ease-out;
    -moz-transition: box-shadow 70ms ease-out,border-color 70ms ease-out;
    transition: box-shadow 70ms ease-out,border-color 70ms ease-out;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    box-shadow: none;
    height: auto;
}
.no_touch .plastic_select:hover,.no_touch input:hover,.no_touch select:hover,.no_touch textarea:hover{border-color:#2780f8}
.focus,.plastic_select:active,.plastic_select:focus,input[type=url]:active,input[type=url]:focus,input[type=text]:active,input[type=text]:focus,input[type=number]:active,input[type=number]:focus,input[type=email]:active,input[type=email]:focus,input[type=password]:active,input[type=password]:focus,select:active,select:focus,textarea:active,textarea:focus{border-color:#2780f8;box-shadow:0 0 7px rgba(39,128,248,.15);outline-offset:0;outline:0}

.large_bottom_margin {
    margin-bottom: 2rem!important;
}
.split_input{display:table;border-spacing:0}
.split_input_item{display:table-cell;border:1px solid #9e9ea6}
.split_input_item:not(:first-child){border-left:none}
.split_input_item:first-child{border-top-left-radius:5px;border-bottom-left-radius:5px}
.split_input_item:last-child{border-top-right-radius:5px;border-bottom-right-radius:5px}
.split_input_item.focused{border:1px double #2780f8;box-shadow:0 0 7px rgba(39,128,248,.3)}
.split_input_item input{height:5rem;text-align:center;font-size:2.5rem;border:none;background:0 0;box-shadow:none}
.split_input_item input:active,.split_input_item input:focus,.split_input_item input:hover{box-shadow:none}


.fs_split{position:absolute;overflow:hidden;width:100%;top:0;bottom:0;left:0;right:0;background-color:#e8e8e8;-webkit-transition:background-color .2s ease-out 0s;-moz-transition:background-color .2s ease-out 0s;transition:background-color .2s ease-out 0s}
.fs_split h1{font-size:2.625rem;line-height:3rem;font-weight:300;margin-bottom:2rem}
.fs_split label{margin-bottom:.5rem}
.fs_split .desc{font-size:1.25rem;color:#9e9ea6;margin-bottom:2rem}
.fs_split .email{color:#555459;font-weight:700}
.fs_split .header_error_message{margin:0 11%;padding:1rem 2rem;background:#fff1e1;border:none;border-left:.5rem solid #ffa940;border-radius:.25rem}
.fs_split .header_error_message h3{margin:0}
.fs_split .error_message{display:none;font-weight:700;color:#ffa940}
.fs_split .error input,.fs_split .error textarea{border:1px solid #ffa940;background:#fff1e1}
.fs_split .error input:focus,.fs_split .error textarea:focus{border-color:#fff1e1;box-shadow:0 0 7px rgba(255,185,100,.15)}
.fs_split .error .error_message{display:inline}
.confirmation_code_span_cell{display:table-cell;font-weight:700;font-size:2rem;text-align:center;padding:0 .5rem;width:2rem}
.confirmation_code_state_message{position:absolute;width:100%;opacity:0;-webkit-transition:opacity .2s;-moz-transition:opacity .2s;transition:opacity .2s}
.confirmation_code_state_message.error,.confirmation_code_state_message.processing,.confirmation_code_state_message.ratelimited{font-size:1.25rem;font-weight:700;line-height:2rem}
.confirmation_code_state_message.processing{color:#3aa3e3}
.confirmation_code_state_message.error,.confirmation_code_state_message.ratelimited{color:#ffa940}
.confirmation_code_state_message ts-icon:before{font-size:2.5rem}
.confirmation_code_state_message svg.ts_icon_spinner{height:2rem;width:2rem}
.confirmation_code_checker{position:relative;height:12rem;text-align:center}
.confirmation_code_checker[data-state=unchecked] .confirmation_code_state_message.unchecked,.confirmation_code_checker[data-state=error] .confirmation_code_state_message.error,.confirmation_code_checker[data-state=processing] .confirmation_code_state_message.processing,.confirmation_code_checker[data-state=ratelimited] .confirmation_code_state_message.ratelimited{opacity:1}
.large_bottom_margin {
    margin-bottom: 2rem !important;
}
</style>

<script type="text/javascript">

function sendAgain()
{
    $.ajax({
        url: '<?php echo site_url("user/send_again_code_verification") ?>',
        type: 'POST',
        data: {},
        datatype: "json",
        success: function (data) {
            if(data=='success'){
                $('#codeMsg').hide();
                $('#AgaincodeMsg').show();
             }else{
                $('#codeMsg').hide();
                $('#AgaincodeMsg').hide();
             }
        }
    });  
}
 

$("#code_1").keypress(function () {
     $("#code_2").focus();
});
$("#code_2").keypress(function () {
     $("#code_3").focus();
});
$("#code_3").keypress(function () {
     $("#code_4").focus();
});
$("#code_4").keypress(function () {
     $("#code_5").focus();
});
$("#code_5").keypress(function () {
     $("#code_6").focus();
});


setInterval(function () {

    var code_1 = $('#code_1').val();
    var code_2 = $('#code_2').val();
    var code_3 = $('#code_3').val();
    var code_4 = $('#code_4').val();
    var code_5 = $('#code_5').val();
    var code_6 = $('#code_6').val();

    if(code_1!='' && code_2!='' && code_3!='' && code_4!='' && code_5!='' && code_6!='' ){
        $('#codeMsg').hide();
        $('#AgaincodeMsg').hide(); 
        var code = code_1+code_2+code_3+code_4+code_5+code_6 ;
        $.ajax({
            url: '<?php echo site_url("user/chk_code_verification") ?>',
            type: 'POST',
            data: { code:code},
            datatype: "json",
            success: function (data) {
                if(data!='flase'){
                     $('#AgaincodeMsg').hide();
                     if(data=='2'){
                        window.location.href = '<?php echo site_url("user-detail"); ?>';
                      }else if(data=='3'){
                        window.location.href = '<?php echo site_url("partners-detail"); ?>';
                      }else if(data=='4'){
                        window.location.href = '<?php echo site_url("developer-detail"); ?>';
                      }else if(data=='5'){
                        window.location.href = '<?php echo site_url("merchant-detail"); ?>';
                      }
                      // window.location.href = '<?php echo site_url("user/after_code_verification"); ?>';
                 }else{
                      $('#AgaincodeMsg').hide(); 
                      $('#codeMsg').show();
                 }
            }
        });      
    }

    
},
3000
);  


function isNumberKey(evt)
{
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;

 return true;
}
</script>

