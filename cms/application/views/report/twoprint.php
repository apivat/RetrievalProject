<center style="width: 1000px;">
    <div style="position: absolute;">
            <img src="<?= base_url(); ?>public/img/cgi_logo_s.png" width="55" height="65"/>
        </div>
    <div style="padding-top: 30px;margin-bottom: 30px;"><?= $txtTitle ?>  </div> 
    <hr/>
    <div style="font-weight: bold;font-size: 13px;height:25px;">
        <div style="width: 50px;float: left;text-align: left">NO.</div> 
        <div style="width: 600px;float: left;text-align: left">หัวข้อ</div>  
        <div style="width: 80px;float: left;text-align: center">ปีที่ตีพิมพ์</div> 
        <div style="width: 250px;float: left;text-align: center">วารสาร</div> 
    </div>
    <hr/>
    <?php
    $i=1;
    foreach ($result as $value):
    ?>
    <div style="font-size: 13px;height:40px;float: left;">
        <div style="width: 50px;float: left;text-align: left"><?=$i?></div> 
        <div style="width: 600px;float: left;text-align: left;"><?= $value->pub_title ?></div>  
        <div style="width: 80px;float: left;text-align: center"><?= $value->pub_year ?></div> 
        <div style="width: 250px;float: left;text-align: left;"><?= $value->journal_title ?></div> 
    </div>
    <?php 
    $i++;
    endforeach;
    ?>
</center>