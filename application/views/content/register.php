<script type="text/javascript">
    function checkFields()
    {
        missinginfo = "";
        if(document.formregis.user_name.value == "")
        {
            missinginfo += "\n - กรุณากรอกชื่อ-นามสกุล";
        }

        if(document.formregis.user_postion.value == ""){
            missinginfo += "\n - กรุณากรอกตำแหน่ง";
        }
        
        if(document.formregis.dep_id.value == ""){
            missinginfo += "\n - กรุณาเลือกแผนก";
        }
        
        if(document.formregis.user_tel.value == "")
        {
            missinginfo += "\n - กรุณากรอกหมายเลขโทรศัพท์";
        }
        
        if(document.formregis.user_email.value == "")
        {
            missinginfo += "\n - กรุณากรอกอีเมลล์";
        }
        
        if(document.formregis.confirm.checked  == false)
        {
            missinginfo += "\n - กรุณาคลิกยืนยันการสมัคร";
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
    <div id="box-register">
        <center><span class="font-topic">ลงทะเบียนใช้งาน</span></center>
        <form id="formregis" name="formregis" method="post" action="" onSubmit="JavaScript:return checkFields();">
            <div class="box-field-regis">
                <span class="label-field-regis">ชื่อ-นามสกุล :</span>
                <span><input type="text" name="user_name" class="input-field-regis"/></span>
            </div>
            <div class="box-field-regis">
                <span class="label-field-regis">ตำแหน่ง :</span>
                <span><input type="text" name="user_postion" class="input-field-regis"/></span>
            </div>
            <div class="box-field-regis">
                <span class="label-field-regis">แผนก :</span>
                <span>
                    <select class="input-select-regis" name="dep_id" id="dep_id">
                        <?php foreach ($result_dep as $dep): ?>
                        <option value="<?=$dep->dep_id?>"><?=$dep->dep_name?></option>
                        <?php endforeach; ?>
                    </select>
                </span>
            </div>
            <div class="box-field-regis">
                <span class="label-field-regis">หมายเลขโทรศัพท์ :</span>
                <span><input type="text" name="user_tel" class="input-field-regis"/></span>
            </div>
            <div class="box-field-regis">
                <span class="label-field-regis">อีเมลล์ :</span>
                <span><input type="text" name="user_email" class="input-field-regis"/></span>
            </div>
            <div class="box-field-regis">
                <span class="label-field-regis">หมวดที่สนใน :</span>
                <span>
                    <select class="input-select-regis" multiple="multiple" size="9" name="lab_id[]" id="lab_id">
                        <?php foreach ($result_lab as $lab): ?>
                        <option value="<?=$lab->lab_id?>"><?=$lab->lab_shname?></option>
                        <?php endforeach; ?>
                    </select>
                </span>
            </div>
            <div class="box-field-regis">
                <span class="label-field-regis">&nbsp;</span>
                <span style="font-weight: bold;color:#000"><input type="checkbox" name="confirm" value="confirm"/>ยืนยันเงื่อนไขการสมัครใช้บริการ</span>
            </div>
            <div class="box-button-regis">
                <span><input type="submit" value="สมัครใช้บริการ"/></span>
                <span><input type="button" value="ยกเลิกการสมัคร" onclick="javascript:window.location='<?=base_url()?>'"/></span>
            </div>
        </form>
    </div>
</center>