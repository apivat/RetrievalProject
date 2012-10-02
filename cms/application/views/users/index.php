<div class="block-status-lavel2">
    <div class="status-lavel2"><img src="<?= base_url() ?>public/img/icon/<?= $imgTitle ?>" align="absmiddle" />&nbsp;&nbsp;<?= $txtTitle ?></div>
</div>

<form name="searchdata" id="searchdata" method="post" action="">
    <div class="block-status-lavel2" style="border:0px solid;">
        <div class="show-result"><b>ทั้งหมด</b> (<?= $num_rows ?>)</div>
        <div style="text-align: right; padding-right: 12px;"><b>ค้นหา :</b> <input type="text" name="data" id="data" style="border: 1px solid #CCCCCC; color: #333333; padding: 4px; width: 215px;" /></div>
    </div>
</form>

<table width="99%" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;background:#FFF;">
    <tr class="title">
        <td class="row-head" style="border-left:1px solid #CCC;" width="20%">&nbsp;ชื่อผู้ใช้</td>
        <td class="row-head" width="30%">Username</td>
        <td class="row-head" width="10%">สถานะ</td>
        <td class="row-head" width="10%">ดาวน์โหลด</td>
        <td class="row-head" width="15%">แก้ไขล่าสุดวันที่</td>
        <td class="row-head" width="15%">วันที่สร้างข้อมูล</td>
    </tr>
    <?php foreach ($result as $value): ?>
        <tr class="over">
            <td class="row-body" style="border-left:1px solid #CCC;">&nbsp;<?= $value->user_name ?></td>
            <td class="row-body"><?= $value->user_username; ?></td>
            <td class="row-body">
            <?php  if($value->user_status==1){ ?>
            <a href="javascript:confirmStatus('<?= $value->user_id ?>','0')"><img src="<?= base_url() ?>public/img/icon/flag_green.png" title="สถานะใช้งานได้" /></a>    
            <?php }else{ ?>
            <a href="javascript:confirmStatus('<?= $value->user_id ?>','1')"><img src="<?= base_url() ?>public/img/icon/flag_red.png" title="สถานะใช้งานไม่ได้" /></a> 
            <?php } ?>
            </td>
            <td class="row-body">
            <?php  if($value->isdownload==1){ ?>
            <a href="javascript:confirmDownload('<?= $value->user_id ?>','0')"><img src="<?= base_url() ?>public/img/icon/folder_go.png" title="สามารถดาวน์โลหดได้" /></a>    
            <?php }else{ ?>
            <a href="javascript:confirmDownload('<?= $value->user_id ?>','1')"><img src="<?= base_url() ?>public/img/icon/folder_delete.png" title="ไม่สามารถดาวน์โลหดได้" /></a> 
            <?php } ?>    
            </td>
            <td class="row-body"><?= text_thaidate($value->update_at, FALSE, TRUE) ?></td>
            <td class="row-body"><?= text_thaidate($value->create_at, FALSE, TRUE) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<table width="99%" cellspacing="0" cellpadding="1" border="0" style="margin-top:8px;">
    <tr>
        <td align="right"><?php echo $this->pagination->create_links(); ?></td>
    </tr>
</table>
