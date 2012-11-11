<html>
<head>
    <title><?=$txtTitle?></title>
    <?php echo(meta(array('name'=>'Content-type','content'=>'text/html;charset=utf-8','type'=>'equiv')))?>
</head>
<body>
    <?=$this->load->view($content)?>
</body>
</html>