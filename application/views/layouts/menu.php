<style>
#mask {
	display: none;
	background: #000; 
	position: fixed; left: 0; top: 0; 
	z-index: 10;
	width: 100%; height: 100%;
	opacity: 0.8;
	z-index: 999;
}

/* You can customize to your needs  */
.login-popup{
	display:none;
	background: #5199BA;
	padding: 10px; 	
	border: 2px solid #ddd;
	float: left;
	font-size: 1.2em;
	position: fixed;
	top: 50%; left: 50%;
	z-index: 99999;
	box-shadow: 0px 0px 20px #999; /* CSS3 */
        -moz-box-shadow: 0px 0px 20px #999; /* Firefox */
        -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
	border-radius:3px 3px 3px 3px;
        -moz-border-radius: 3px; /* Firefox */
        -webkit-border-radius: 3px; /* Safari, Chrome */
}

img.btn_close { Position the close button
	float: right; 
	margin: -28px -28px 0 232px;
}

fieldset { 
	border:none; 
}

form.signin .textbox label { 
	display:block; 
	padding-bottom:7px; 
}

form.signin .textbox span { 
	display:block;
}

form.signin p, form.signin span { 
	color:white; 
	font-size:11px; 
	line-height:18px;
} 

form.signin .textbox input { 
	background:#666666; 
	border-bottom:1px solid #333;
	border-left:1px solid #000;
	border-right:1px solid #333;
	border-top:1px solid #000;
	color:#fff; 
        border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px;
        -webkit-border-radius: 3px;
	font:13px Arial, Helvetica, sans-serif;
	padding:6px 6px 4px;
	width:200px;
}

form.signin input:-moz-placeholder { color:#bbb; text-shadow:0 0 2px #000; }
form.signin input::-webkit-input-placeholder { color:#bbb; text-shadow:0 0 2px #000;  }

.button { 
	background: -moz-linear-gradient(center top, #f3f3f3, #dddddd);
	background: -webkit-gradient(linear, left top, left bottom, from(#f3f3f3), to(#dddddd));
	background:  -o-linear-gradient(top, #f3f3f3, #dddddd);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#f3f3f3', EndColorStr='#dddddd');
	border-color:#000; 
	border-width:1px;
        border-radius:4px 4px 4px 4px;
	-moz-border-radius: 4px;
        -webkit-border-radius: 4px;
	color:#333;
	cursor:pointer;
	display:inline-block;
	padding:6px 6px 4px;
	margin-top:10px;
	font:12px; 
	width:214px;
}
.button:hover { background:#ddd; }    
</style>
<script>
    function checkFieldsLogin()
    {
        loginmissinginfo = "";
        if(document.loginfrm.username.value == "")
        {
            loginmissinginfo += "\n - กรุณากรอก Username หรือ Email";
        }
        
        if(document.loginfrm.password.value == "")
        {
            loginmissinginfo += "\n - กรุณากรอก Password";
        }
        
        if(!document.loginfrm.username.value == "" && !document.loginfrm.password.value == ""){
            $.post("./login", { 
                username: document.loginfrm.username.value, 
                password: document.loginfrm.password.value 
            },
            function(data) {
                //alert(data);
                if(data=="200"){
                    window.location = "<?=base_url();?>";
                }else{
                    loginmissinginfo ="ข้อมูลต่อไปนี้ผิดพลาด :\n" +
                        "_____________________________\n" +
                        loginmissinginfo + "\n_____________________________";
                    alert("\n การเข้าสู่ระบบไม่ถูกต้องโปรดทำการเข้าสู่ระบบใหม่อีกครั้ง");
                    return false;
                }
            });
        }

        if (loginmissinginfo != "")
        {
            loginmissinginfo ="ข้อมูลต่อไปนี้ผิดพลาด :\n" +
                "_____________________________\n" +
                loginmissinginfo + "\n_____________________________";
            alert(loginmissinginfo);
            return false;
        }
        else
        {
            return false;
        }
    }
</script>
<span class="menubar">ระบบสืบค้นผลงานตีพิมพ์สถาบันวิจัยจุฬาภรณ์</span>
<?php 
if (!$this->session->userdata('LoginActive')):
?>
<span class="menubar" style="display: block;float: right;margin-right:20px;"><a href="#login-box" class="login-window">เข้าสู่ระบบ</a></span>
<span class="menubar" style="display: block;float: right;margin-right:20px;"><a href="<?=base_url()?>register">สมัครสมาชิก</a></span>
<div id="login-box" class="login-popup">
        <a href="#" class="close"><img src="<?=base_url()?>public/img/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
          <form name="loginfrm" method="post" class="signin" action="" onSubmit="JavaScript:return checkFieldsLogin();">
                <fieldset class="textbox">
            	<label class="username">
                <span>Username or email</span>
                <input id="username" name="username" value="" type="text" autocomplete="on" placeholder="Username">
                </label>
                <label class="password">
                <span>Password</span>
                <input id="password" name="password" value="" type="password" placeholder="Password">
                </label>
                <button class="submit button" type="submit">Sign in</button>       
                </fieldset>
          </form>
</div>
<?php else: ?>
<span class="menubar" style="display: block;float: right;margin-right:20px;"><a href="<?=base_url();?>logout">ออกจากระบบ</a></span>
<span class="menubar" style="display: block;float: right;margin-right:20px;"><?=$this->session->userdata('Name')?></span>
<span class="menubar" style="display: block;float: right;margin-right:20px;"><a href="<?=base_url();?>searchcondition">ค้นหาแบบมีเงื่อนไข</a></span>
<span class="menubar" style="display: block;float: right;margin-right:20px;"><a href="<?=base_url();?>">ค้นหาแบบธรรมดา</a></span>
<?php endif; ?>
<script>
$(document).ready(function() {
	$('a.login-window').click(function() {
		
                //Getting the variable's value from a link 
		var loginBox = $(this).attr('href');
                //var loginBox = $('#login-box')

		//Fade in the Popup
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border see css style
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').live('click', function() { 
	$('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
});
</script>