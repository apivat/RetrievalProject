<?php echo(doctype('xhtml1-trans'))?>
<html>
<head>
    <title>CMS | <?=$title?></title>
    <?php echo(meta(array('name'=>'Content-type','content'=>'text/html;charset=utf-8','type'=>'equiv')))?>
    <?php echo(link_tag(base_url().'public/css/layout.css'))?>
    <?php echo(link_tag(base_url().'public/css/style.css'))?>
    <?php echo(link_tag(base_url().'public/css/font.css'))?>
    <?php echo(link_tag(base_url().'public/js/ext/resources/css/ext-all.css'))?>
    <script type="text/javascript" charset="utf-8" src="<?php echo(base_url())?>library/dojo/dojo.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo(base_url())?>public/js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo(base_url())?>public/js/javascript.js"></script>  
    <script type="text/javascript" charset="utf-8" src="<?php echo(base_url())?>plugins/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo(base_url())?>public/js/ext/ext-all.js"></script>
</head>
<body>
<center>
    <div id="header"><?=$this->load->view('layouts/header')?></div>
    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" valign="top" width="200"><div id="navigator"><?=$this->load->view('layouts/navigator')?></div></td>
            <td align="left" valign="top"><?=$this->load->view($content)?></td>
        </tr>
    </table>
    <div class="blank-footer"><!-- blank --></div>
    <div id="footer"><?=$this->load->view('layouts/footer')?></div>
</center>
</body>
</html>
