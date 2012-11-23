<center style="width: 1000px;">
    <div style="position: absolute;">
            <img src="<?= base_url(); ?>public/img/cgi_logo_s.png" width="55" height="65"/>
        </div>
    <div style="padding-top: 30px;margin-bottom: 30px;"><?= $txtTitle ?>  </div> 
    <hr/>
    <div style="font-weight: bold;font-size: 13px;">
        <div style="width: 5%;float: left;text-align: left">NO.</div> 
        <div style="width: 30%;float: left;text-align: left">ชื่อ - นามสกุล</div>  
        <div style="width: 30%;float: left;text-align: left">อีเมลล์</div> 
        <div style="width: 15%;float: left;text-align: left">เบอร์โทรศัพท์</div> 
        <div style="width: 20%;float: left;text-align: left">ประเภทนักวิจัย</div> 
    </div>
    <hr/>
    <?php
    $i=1;
    foreach ($result as $value):
    ?>
    <div style="font-size: 13px;">
        <div style="width: 5%;float: left;text-align: left"><?=$i?></div> 
        <div style="width: 30%;float: left;text-align: left"><?=$value->res_name?></div>  
        <div style="width: 30%;float: left;text-align: left"><?=$value->res_email?></div> 
        <div style="width: 15%;float: left;text-align: left"><?=$value->res_tel?></div> 
        <div style="width: 20%;float: left;text-align: left"><?php if($value->is_internal=="1"): echo "นักวิจัยภายใน"; elseif($value->is_internal=="0"): echo "นักวิจัยภายนอก"; else: echo "ไม่ได้เลือกประเภทนักวิจัย"; endif; ?></div> 
    </div>
    <?php 
    $i++;
    endforeach;
    ?>
</center>