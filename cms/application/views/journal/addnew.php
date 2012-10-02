<script type="text/javascript">
    function checkFields()
    {
        missinginfo = "";
        if(document.frmCms.journal_title.value == "")
        {
            missinginfo += "\n - กรุณากรอกชื่อวารสาร";
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
        <dt>ชื่อวารสาร :</dt>
        <dd><input type="text" name="journal_title" id="journal_title" class="cms-thumb" style="width:567px;" /></dd>
        <dt>&nbsp;</dt>
        <dd style="margin-top: 10px;"><input type="submit" class="bt" value="เพิ่มข้อมูล" /></dd>
    </dl>
</form>