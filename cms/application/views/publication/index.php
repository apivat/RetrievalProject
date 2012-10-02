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
        <td class="row-head" style="border-left:1px solid #CCC;" width="8%">&nbsp;ปีที่ตีพิมพ์</td>
        <td class="row-head" width="77%">ชื่อบทความ</td>
        <td class="row-head" width="10%">แก้ไขล่าสุดวันที่</td>
        <td class="row-head" style="border-right:1px solid #CCC;" width="5%">&nbsp;</td>
    </tr>
    <?php foreach ($result as $value): ?>
        <tr class="over">
            <td class="row-body" style="border-left:1px solid #CCC;">&nbsp;<?= $value->pub_year ?></td>
            <td class="row-body"><?= substr($value->pub_title, 0,140); ?>...</td>
            <td class="row-body"><?= text_thaidate($value->update_at, FALSE, TRUE) ?></td>
            <td class="row-body" align="right" style="border-right:1px solid #CCC;">
                <a href="<?= base_url() . $this->router->class . '/edit/' . $value->pub_id ?>"><img src="<?= base_url() ?>public/img/icon/page_edit.png" title="แก้ไข" /></a>&nbsp;
                <a href="javascript:confirmDelete('<?= $value->pub_id ?>','<?= $table ?>')"><img src="<?= base_url() ?>public/img/icon/delete.png" title="ลบ" /></a>&nbsp;
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<table width="99%" cellspacing="0" cellpadding="1" border="0" style="margin-top:8px;">
    <tr>
        <td align="right"><?php echo $this->pagination->create_links(); ?></td>
    </tr>
</table>
