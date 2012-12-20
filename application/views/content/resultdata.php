<div style='height: 115px;width: 100%;border-bottom: 1px solid #DEDEDE;'>
    <img src="./public/img/cgi_logo_s.png" style="margin-left: 15px; margin-top: 10px; float: left; width: 70px; height: 85px;"/>
    <div style="height: 80px; width: 80%; float: left; margin-top: 20px;">
        <form id="formword" name="formword" method="post" action="<?= base_url() ?>resultdata">
            <input type="text" value="<?=$word?>" style="background: none repeat scroll 0 0 #FBFBFB;border: 1px solid #D2D2D2;font-size: 15px;margin: 25px 10px 10px 25px;padding: 5px;width: 500px;" name="word" id="word">    
            <button id="gbqfba" class="gbqfba" style="background-color:#4D90FE;background-image:-webkit-linear-gradient(top, #4D90FE, #4787ED);border:1px solid #3079ED;color:#FFFFFF !important;" type="submit" name="btnK" aria-label="ค้นหา">
                <span id="gbqfsa">ค้นหา</span>
            </button>
        </form>
    </div>
</div>
<div style="border-bottom: 1px solid rgb(222, 222, 222); height: 57px; background-color: seashell;">
    <div style="margin-left: 20px;margin-bottom: 2px;margin-top: 2px;">Precision : <b><?=$Precision?></b></div>
    <div style="margin-left: 20px;margin-bottom: 2px;">ค้นหาได้เป็นจำนวน : <b><?=$result_count?></b></div>
    <div style="margin-left: 20px;margin-bottom: 2px;">เอกสารทั้งหมด : <b><?=$total?></b></div>
</div>
<?php
if(!empty($result_ans)):
    foreach ($result_ans as $result_sim):
        $row_pub = $this->db->get_where("publication",array("pub_id"=>$result_sim[1]))->row();
?>
        <div style='border-bottom-color:#DEDEDE;border-bottom-style:dashed;border-bottom-width:1px;height: 50px;width: 100%;'>
            <div class="title_link" style="width: 100%;float: left;">
                <div style="width: 3%;padding-left: 20px;padding-top:5px;float: left;"><img style="cursor:pointer;" src="<?=base_url()?>cms/public/img/icon/folder.png" title="ดาวน์โหลด"/></div> 
                <div style="width: 90%;padding-top:5px;float: left;"><a href="<?=base_url()?>detail/<?=$row_pub->pub_id?>"><?=$row_pub->pub_name?></a></div>
            </div>
            <div style="width: 100%;float: left;">
                <div style="width: 3%;padding-left: 20px;padding-top:5px;float: left;"></div>
                <div style="width: 90%;padding-top:5px;float: left;"><b>Similarity Coefficient</b> = <?=$result_sim[0]?></div> 
            </div>
        </div>
<?php
    endforeach;
endif;
?>
