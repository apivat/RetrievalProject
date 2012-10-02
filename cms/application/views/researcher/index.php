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
        <td class="row-head" style="border-left:1px solid #CCC;" width="50%">&nbsp;ชื่อนักวิจัย</td>
        <td class="row-head" width="20%">ประเภทนักวิจัย</td>
        <td class="row-head" width="10%">แก้ไขล่าสุดวันที่</td>
        <td class="row-head" width="10%">วันที่สร้างข้อมูล</td>
        <td class="row-head" style="border-right:1px solid #CCC;" width="10%">&nbsp;</td>
    </tr>
    <?php foreach ($result as $value): ?>
        <tr class="over">
            <td class="row-body" style="border-left:1px solid #CCC;">&nbsp;<?= $value->res_name ?></td>
            <td class="row-body"><?php if($value->is_internal=="1"): echo "นักวิจัยภายใน"; elseif($value->is_internal=="0"): echo "นักวิจัยภายนอก"; else: echo "ไม่ได้เลือกประเภทนักวิจัย"; endif; ?></td>
            <td class="row-body"><?= text_thaidate($value->update_at, FALSE, TRUE) ?></td>
            <td class="row-body"><?= text_thaidate($value->create_at, FALSE, TRUE) ?></td>
            <td class="row-body" align="right" style="border-right:1px solid #CCC;">
                <a href="<?= base_url() . $this->router->class . '/edit/' . $value->res_id ?>"><img src="<?= base_url() ?>public/img/icon/page_edit.png" title="แก้ไข" /></a>&nbsp;
                <a href="javascript:confirmDelete('<?= $value->res_id ?>','<?= $table ?>')"><img src="<?= base_url() ?>public/img/icon/delete.png" title="ลบ" /></a>&nbsp;
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<table width="99%" cellspacing="0" cellpadding="1" border="0" style="margin-top:8px;">
    <tr>
        <td align="right"><?php echo $this->pagination->create_links(); ?></td>
    </tr>
</table>
