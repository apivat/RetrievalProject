<script type="text/javascript">
    function checkFields()
    {
        missinginfo = "";
        if(document.frmCms.res_name.value == "")
        {
            missinginfo += "\n - กรุณากรอกชื่อนักวิจัย";
        }
        
        if(document.frmCms.res_tel.value == ""){
            missinginfo += "\n - กรุณากรอกหมายเลขโทรศัพท์ติดต่อ";  
        }else if(!document.frmCms.res_tel.value.match(/[^\\d]/)){
            missinginfo += "\n - กรุณากรอกหมายเลขโทรศัพท์เฉพาะตัวเลขเท่านั้น"; 
        }
        var regex_email=/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*\@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.([a-zA-Z]){2,4})$/
        if(document.frmCms.res_email.value == ""){
            missinginfo += "\n - กรุณากรอกอีเมล";
        }else if(!document.frmCms.res_email.value.match(regex_email)){
            missinginfo += "\n - กรุณากรอกอีเมลให้ถูกต้อง";
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
<?php if (isset($error)): ?>
    <div class="box-error"><b><?= $error ?></b></div>
<?php endif; ?>

<div class="block-status-lavel2">
    <div class="status-lavel2"><img src="<?= base_url() ?>public/img/icon/<?= $imgTitle ?>" align="absmiddle" />&nbsp;&nbsp;<?= $txtTitle ?></div>
</div>

<form name="frmCms" id="frmCms" method="post" action="" onSubmit="JavaScript:return checkFields();">
    <dl>
        <dt>ชื่อนักวิจัย :</dt>
        <dd><input type="text" name="res_name" id="res_name" class="cms-thumb" /></dd>
        <dt>หมายเลขโทรศัพท์ติดต่อ :</dt>
        <dd><input type="text" name="res_tel" id="res_tel" class="cms-thumb" /></dd>
        <dt>อีเมล :</dt>
        <dd><input type="text" name="res_email" id="res_email" class="cms-thumb" /></dd>   
        <dt>ประเภทนักวิจัย :</dt>
        <dd><div style="margin-top: 6px;">
            <input type="radio" name="is_internal" id="is_internal" value="1" checked="checked"/>&nbsp;นักวิจัยภายใน&nbsp;&nbsp;
            <input type="radio" name="is_internal" id="is_internal" value="0"/>&nbsp;นักวิจัยภายนอก</div>
        </dd>
        <dt>&nbsp;</dt>
        <dd style="margin-top: 10px;"><input type="submit" class="bt" value="เพิ่มข้อมูล" /></dd>
    </dl>
</form>