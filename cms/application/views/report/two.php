<div class="block-status-lavel2">
    <div class="status-lavel2"><img src="<?= base_url() ?>public/img/icon/<?= $imgTitle ?>" align="absmiddle" />&nbsp;&nbsp;<?= $txtTitle ?></div>
</div>
<form name="searchdata" id="searchdata" method="post" action="">
    <div class="block-status-lavel2" style="border:0px solid;">
        <div class="show-result"><b>ทั้งหมด</b> (<?= $num_rows ?>)</div>
        <div style="text-align: right; padding-right: 12px;">
        <a href="<?= base_url() ?>report/twoprint/<?=$pub_year?>">[ พิมพ์รายงาน ]</a>&nbsp;&nbsp;
        <select class="properties" name="pub_year" id="pub_year" onChange="document.searchdata.submit();">
            <option value="0" <?php if($pub_year=="" or $pub_year=="0"){ echo "selected='selected'"; } ?> >ทั้งหมด</option>
            <?php foreach ($result_pub_year as $year_pub): ?>
            <option value="<?=$year_pub->pub_year?>" <?php if($pub_year==$year_pub->pub_year){ echo "selected='selected'"; } ?> ><?=$year_pub->pub_year?></option>
            <?php endforeach; ?>
        </select>
        </div>
    </div>
</form>

<table width="99%" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;background:#FFF;">
    <tr class="title">
        <td class="row-head" style="border-left:1px solid #CCC;" width="5%">&nbsp;ลำดับ</td>
        <td class="row-head" width="70%">หัวข้อ</td>
        <td class="row-head" width="5%">ปีที่ตีพิมพ์</td>
        <td class="row-head" width="20%" style="text-align:center;border-right:1px solid #CCC;">วารสาร</td>
    </tr>
    <?php 
    $i = 1;
    foreach ($result as $value): ?>
        <tr class="over">
            <td class="row-body" style="border-left:1px solid #CCC;">&nbsp;<?= $i ?></td>
            <td class="row-body"><?= substr($value->pub_title, 0,130); ?>...</td>
            <td class="row-body"><?= $value->pub_year ?></td>
            <td class="row-body" style="border-right:1px solid #CCC;"><?= substr($value->journal_title, 0,30); ?>...</td>
        </tr>
    <?php 
    $i++;
    endforeach; 
    ?>
</table>
