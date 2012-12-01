<div 
style="width:1020px;
height: 580px; 
margin-top: 40px;
background-color:#F0F8FF;
border:6px double #0054a6; 
background-image:url('paper.gif');">

     <br/>
    <div style="padding-left: 20px;width: 980px;">
        <span style="width: 100px;font-weight: bold;font-size: 14px;">ชื่อเรื่อง : </span>
        <spen style="width: 750px;font-size: 14px;"><?=$result_pub->pub_title;?></spen>
    </div><br/>
    <div style="padding-left: 20px;width: 980px;">
        <span style="width: 100px;font-weight: bold;font-size: 14px;">ผู่แต่ง : </span>
        <spen style="width: 750px;font-size: 14px;">
            <?php 
            foreach(res_data($result_pub->pub_id) as $res):
                echo $res->res_name;
                echo "<br/>";
            endforeach;
            ?>
        </spen>
    </div><br/>
    <div style="padding-left: 20px;width: 980px;">
        <span style="width: 100px;font-weight: bold;font-size: 14px;">ตีพิมพ์ในวารสาร : </span>
        <spen style="width: 750px;font-size: 14px;"><?=journal_data($result_pub->journal_id);?></spen>
    </div><br/>
    <div style="padding-left: 20px;width: 980px;">
        <span style="width: 100px;font-weight: bold;font-size: 14px;">ปีที่ตีพิมพ์: </span>
        <spen style="width: 750px;font-size: 14px;"><?=$result_pub->pub_year;?></spen>
    </div><br/>
    <div style="padding-left: 20px;width: 980px;">
        <span style="width: 100px;font-weight: bold;font-size: 14px;">บทคัดย่อ : </span>
        <spen style="width: 750px;font-size: 14px;"><?=$result_pub->pub_abstract;?></spen>
    </div><br/>
    <div style="padding-left: 20px;width: 980px;">
        <span style="width: 100px;font-weight: bold;font-size: 14px;">เอกสารอ้างอิง: </span>
        <spen style="width: 750px;font-size: 14px;">
            <?php 
            if(count(pub_ref_data($result_pub->pub_id))!=0):
                foreach(pub_ref_data($result_pub->pub_id) as $ref):
                    echo $ref->pub_title;
                    echo "<br/>";
                endforeach; 
            else:
                echo "ไม่มีเอกสารอ้างอิง";
            endif;
            ?>
        </spen>
    </div><br/>
	
<!--    <div style="padding-left: 20px;width: 980px;">
        <span style="width: 100px;font-weight: bold;font-size: 14px;">เอกสารที่นำไปใช้: </span>
        <spen style="width: 750px;font-size: 14px;">
            <?php 
            if(count(ref_data($result_pub->pub_id))!=0):
                foreach(ref_data($result_pub->pub_id) as $ref):
                    echo $ref->pub_title;
                    echo "<br/>";
                endforeach; 
            else:
                echo "ไม่มีเอกสารที่นำไปอ้างอิง";
            endif;
            ?>
        </spen>
    </div><br/>-->
	
	
    <div style="padding-left: 20px;width: 980px;">
        <span style="width: 100px;font-weight: bold;font-size: 14px;">ดาวน์โหลดเอกสาร: </span>
        <spen style="width: 750px;font-size: 14px;">
        <?php if($this->session->userdata('IsDownload')==1):?>
            <a href="<?=base_url()."home/download/".$result_pub->pub_id;?>"><img style="cursor:pointer;" src="<?=base_url()?>cms/public/img/icon/folder.png" title="ดาวน์โหลด"/></a>
        <?php else: ?>
            คุณไม่มีสิทธิ์ดาวน์โหลด กรุณาติดต่อเจ้าหน้าที่
        <?php endif; ?>
        </spen>
    </div><br/>
    <div style="padding-left: 20px;width: 980px;">
        <span style="width: 100px;font-weight: bold;font-size: 14px;">ดาวน์โหลดไปทั้งหมด: </span>
        <spen style="width: 750px;font-size: 14px;"><?=$result_pub->get_download;?></spen>
    </div><br/>
</div>
