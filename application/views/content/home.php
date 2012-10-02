<script type="text/javascript">
    function checkLogin()
    {
        var activeLogin = "<?=$this->session->userdata('LoginActive');?>";
        
        missinginfo = "";
        if(activeLogin != "1")
        {
            missinginfo += "\n - กรุณาเข้าสู่ระบบเพื่อใช้งาน";
        }
        if (missinginfo != "")
        {
            missinginfo ="ข้อมูลต่อไปนี้ผิดพลาด :\n" +
                "_____________________________\n" +
                missinginfo + "\n_____________________________";
            alert(missinginfo);
            return false;
        }
        else
        {
            return true;
        }
    }
</script>
<center>
    <div style="background-image: url('./public/img/cri_bg.jpg'); border: 1px solid rgb(229, 229, 229); padding: 20px; position: relative; text-align: left; top: 40px; width: 752px; height: 226px;"></div>
    <div style="color:#999999;padding:40px;position:relative;text-align:left;top:40px;width:680px;">
       <form id="formword" name="formword" method="post" action="<?=base_url()?>resultdata" onSubmit="JavaScript:return checkLogin();">
        <center>
            <input type="text" id="word" name="word" style="background: none repeat scroll 0 0 #FBFBFB;border: 1px solid #D2D2D2;font-size: 20px;padding: 6px;width: 550px;"/>
            <button id="gbqfba" aria-label="ค้นหา" name="btnK" class="gbqfba"  style="background-color:#4D90FE;background-image:-webkit-linear-gradient(top, #4D90FE, #4787ED);border:1px solid #3079ED;color:#FFFFFF !important;" type="submit">
                <span id="gbqfsa">ค้นหา</span>
            </button>
        </center>
        </form> 
    </div>
    
</center>
