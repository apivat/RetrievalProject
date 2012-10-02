<script type="text/javascript">
    function checkFields()
    {
        missinginfo = "";
        if(document.frmCms.res_name.value == "")
        {
            missinginfo += "\n - กรุณากรอกชื่อนักวิจัย";
        }
        if(document.frmCms.res_tel.value == "")
        {
            missinginfo += "\n - กรุณากรอกหมายเลขโทรศัพท์ติดต่อ";
        }
        if(document.frmCms.res_email.value == "")
        {
            missinginfo += "\n - กรุณากรอกอีเมล";
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
<?php if (isset($complete)): ?>
    <div class="box-complete"><b><?= $complete ?></b></div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="box-error"><b><?= $error ?></b></div>
<?php endif; ?>

<div class="block-status-lavel2">
    <div class="status-lavel2"><img src="<?= base_url() ?>public/img/icon/<?= $imgTitle ?>" align="absmiddle" />&nbsp;&nbsp;<?= $txtTitle ?></div>
</div>

<form name="frmCms" id="frmCms" method="post" action="" onSubmit="JavaScript:return checkFields();">
    <dl>
        <dt>ชื่อนักวิจัย :</dt>
        <dd><input type="text" name="res_name" id="res_name" class="cms-thumb" value="<?=$result->res_name?>" /></dd>
        <dt>หมายเลขโทรศัพท์ติดต่อ :</dt>
        <dd><input type="text" name="res_tel" id="res_tel" class="cms-thumb" value="<?=$result->res_tel?>" /></dd>
        <dt>อีเมล :</dt>
        <dd><input type="text" name="res_email" id="res_email" class="cms-thumb" value="<?=$result->res_email?>" /></dd>   
        <dt>Lab Name :</dt>
        <dd><div style="margin-top: 6px;">
            <input type="radio" name="is_internal" id="is_internal" value="1" <?php if($result->is_internal=="1" or $result->is_internal==""): echo 'checked="checked"'; endif;?>/>&nbsp;นักวิจัยภายใน&nbsp;&nbsp;
            <input type="radio" name="is_internal" id="is_internal" value="0" <?php if($result->is_internal=="0"): echo 'checked="checked"'; endif;?>/>&nbsp;นักวิจัยภายนอก</div>
        </dd>
        <dt>&nbsp;</dt>
        <dd style="margin-top: 10px;"><input type="submit" class="bt" value="แก้ไข" /></dd>
    </dl>
</form>
