<script type="text/javascript" src="<?php echo(base_url()) ?>public/js/editor-full.js"></script>
<script type="text/javascript">
    function checkFields()
    {
        missinginfo = "";
        if(document.frmCms.pub_title.value == "")
        {
            missinginfo += "\n - กรุณากรอกชื่อนักวิจัย";
        }
        
        if(document.frmCms.pub_year.value == ""){
            missinginfo += "\n - กรุณาเลือกปีที่ตีพิมพ์";
        }
        
        if(document.frmCms.lab_id.value == ""){
            missinginfo += "\n - กรุณาเลือก lab name";
        }
        
        if(document.frmCms.res_id.value == "")
        {
            missinginfo += "\n - กรุณาเลือก Researcher";
        }
        
        if(document.frmCms.pub_paper.value == "")
        {
            missinginfo += "\n - กรุณา upload paper";
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
        <dt>หัวข้อ :</dt>
        <dd><input type="text" name="pub_title" id="pub_title" class="cms-thumb" style="width:567px;" value="<?=$result->pub_title?>"/></dd>
        <dt>บทคัดย่อ :</dt>
        <dd><textarea name="pub_abstract" id="pub_abstract" style="border: 1px solid rgb(204, 204, 204); color: rgb(51, 51, 51); width: 467px; height: 92px;"><?=$result->pub_abstract?></textarea></dd>   
        <dt>ปีที่ตีพิมพ์ :</dt>
        <dd><select class="properties" name="pub_year" id="pub_year">
            <option value="">----------------กรุณาเลือก----------------</option>
            <?php for($i=1980;$i<=2015;$i++){ ?>
            <option value="<?=$i?>" <?php if($i==$result->pub_year){ echo "selected='selected'"; } ?>>ปี <?=$i?></option>
            <?php } ?>
        </select></dd>
        <dt>วารสาร :</dt>
        <dd>
        <select class="properties" name="journal_id" id="journal_id">
            <option value="">----------------กรุณาเลือก----------------</option>
            <?php foreach ($result_journal as $journal): ?>
                <option value="<?= $journal->journal_id ?>" <?php if($journal->journal_id==$result->journal_id){ echo "selected='selected'"; } ?>><?= $journal->journal_title ?></option>
            <?php endforeach; ?>
        </select>
        </dd>
        <dt>Lab Name :</dt>
        <dd>
        <select class="properties" name="lab_id" id="lab_id">
            <option value="">----------------กรุณาเลือก----------------</option>
            <?php foreach ($result_lab as $lab): ?>
                <option value="<?= $lab->lab_id ?>" <?php if($lab->lab_id==$result->lab_id){ echo "selected='selected'"; } ?>><?= $lab->lab_shname ?></option>
            <?php endforeach; ?>
        </select>
        </dd>
        <dt>Researcher :</dt>
        <dd>
            <?php if(empty($result_respub)){ ?>
                <select class="properties" multiple="multiple" size="10" name="res_id[]" id="res_id">
                <?php foreach ($result_res as $res): ?>
                    <option value="<?= $res->res_id ?>"><?= $res->res_name ?></option>
                <?php endforeach; ?>
                </select>
            <?php }else{ ?> 
                <select class="properties" multiple="multiple" size="10" name="res_id[]" id="res_id">
                <?php foreach ($result_res as $res): ?>
                    <option value="<?= $res->res_id ?>" <?php if(in_array($res->res_id,$result_respub)){ echo "selected='selected'";  } ?>><?= $res->res_name ?></option>
                <?php endforeach; ?>
                </select>
            <?php } ?>
        </dd>
        <dt>Paper :</dt>
        <dd><input type="text" name="pub_paper" id="pub_paper" class="cms-thumb" style="width:567px;" readonly value="<?= $result->pub_paper ?>" />&nbsp;<img src="<?=base_url()?>public/img/icon/folder_go.png" class="cursor" onclick="setFile('pub_paper', null, 'pub_paper')" title="แทรกไฟล์" /> <img src="<?=base_url()?>public/img/icon/pill.png" class="cursor" onclick="document.getElementById('pub_paper').value='';" title="ลบ" /></dd>
        <dt>Reference Publication :</dt>
        <dd>
            <?php if(empty($result_refpub)){ ?>
                <select class="properties" style="width:577px;" multiple="multiple" size="10" name="pub_ref_id[]" id="pub_ref_id">
                <?php foreach ($result_pub as $pub): ?>
                    <option value="<?= $pub->pub_id ?>"><?= $pub->pub_title ?></option>
                <?php endforeach; ?>
                </select>
            <?php }else{ ?> 
                <select class="properties" style="width:577px;" multiple="multiple" size="10" name="pub_ref_id[]" id="pub_ref_id">
                <?php foreach ($result_pub as $pub): ?>
                    <option value="<?= $pub->pub_id ?>" <?php if(in_array($pub->pub_id,$result_refpub)){ echo "selected='selected'";  } ?>><?= $pub->pub_title ?></option>
                <?php endforeach; ?>
                </select>
            <?php } ?>
        </dd>
        <dt>&nbsp;</dt>
        <dd style="margin-top: 10px;"><input type="submit" class="bt" value="แก้ไขข้อมูล" /></dd>
    </dl>
</form>