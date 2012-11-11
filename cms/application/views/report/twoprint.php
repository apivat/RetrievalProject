<center style="width: 1000px;">
    <div style="position: absolute;">
            <img src="<?= base_url(); ?>public/img/cgi_logo_s.png" width="55" height="65"/>
        </div>
    <div style="padding-top: 30px;margin-bottom: 30px;"><?= $txtTitle ?>  </div> 
    <hr/>
    <div style="font-weight: bold;font-size: 13px;">
        <div style="width: 5%;float: left;">NO.</div> 
        <div style="width: 65%;float: left;">หัวข้อ</div>  
        <div style="width: 10%;float: left;">ปีที่ตีพิมพ์</div> 
        <div style="width: 20%;float: left;">วารสาร</div> 
    </div>
    <hr/>
    <?php
    $i=1;
    foreach ($result as $value):
    ?>
    <div style="font-size: 13px;">
        <div style="width: 5%;float: left;"><?=$i?></div> 
        <div style="width: 65%;float: left;text-align: left;"><?= substr($value->pub_title, 0,110); ?>...</div>  
        <div style="width: 10%;float: left;"><?= $value->pub_year ?></div> 
        <div style="width: 20%;float: left;text-align: left;"><?= substr($value->journal_title, 0,30); ?>...</div> 
    </div>
    <?php 
    $i++;
    endforeach;
    ?>
</center>