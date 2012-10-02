<?php echo(doctype('xhtml1-trans'))?>
<html>
<head>
    <title>CMS | <?=$title?></title>
    <?php echo(meta(array('name'=>'Content-type','content'=>'text/html;charset=utf-8','type'=>'equiv')))?>
    
</head>
<body>
<?=$this->load->view($content)?>
</body>
</html>