<div class="block-status-lavel2">
    <div class="status-lavel2"><img src="<?= base_url() ?>public/img/icon/<?= $imgTitle ?>" align="absmiddle" />&nbsp;&nbsp;<?= $txtTitle ?></div>
</div>
<form name="searchdata" id="searchdata" method="post" action="">
    <div class="block-status-lavel2" style="border:0px solid;">
        <div class="show-result"><b>ทั้งหมด</b> (<?= $num_rows ?>)</div>
        <div style="text-align: right; padding-right: 12px;">
        <a href="<?= base_url() ?>report/oneprint/<?=$is_internal?>">[ พิมพ์รายงาน ]</a>&nbsp;&nbsp;
        <select class="properties" name="is_internal" id="is_internal" onChange="document.searchdata.submit();">
            <option value="2" <?php if($is_internal=="" or $is_internal=="2"){ echo "selected='selected'"; } ?> >นักวิจัยทั้งหมด</option>
            <option value="1" <?php if($is_internal=="1"){ echo "selected='selected'"; } ?>>นักวิจัยภายใน</option>
            <option value="0" <?php if($is_internal=="0"){ echo "selected='selected'"; } ?>>นักวิจัยภายนอก</option>
        </select>
        </div>
    </div>
</form>

<table width="99%" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;background:#FFF;">
    <tr class="title">
        <td class="row-head" style="border-left:1px solid #CCC;" width="5%">&nbsp;ลำดับ</td>
        <td class="row-head" width="30%">ชื่อ-นามสกุล</td>
        <td class="row-head" width="25%">อีเมลล์</td>
        <td class="row-head" width="20%">เบอร์โทรศัพท์</td>
        <td class="row-head" width="20%" style="border-right:1px solid #CCC;">ประเภทนักวิจัย</td>
    </tr>
    <?php 
    $i = 1;
    foreach ($result as $value): ?>
        <tr class="over">
            <td class="row-body" style="border-left:1px solid #CCC;">&nbsp;<?= $i ?></td>
            <td class="row-body"><?= $value->res_name ?></td>
            <td class="row-body"><?= $value->res_email ?></td>
            <td class="row-body"><?= $value->res_tel ?></td>
            <td class="row-body" style="border-right:1px solid #CCC;"><?php if($value->is_internal=="1"): echo "นักวิจัยภายใน"; elseif($value->is_internal=="0"): echo "นักวิจัยภายนอก"; else: echo "ไม่ได้เลือกประเภทนักวิจัย"; endif; ?></td>
        </tr>
    <?php 
    $i++;
    endforeach; 
    ?>
</table>
