<?php echo(doctype('xhtml1-trans')) ?>
<html>
    <head>
        <title><?= $title ?> | ระบบ</title>
        <?php echo meta('title', $mTitle); ?>
        <?php echo meta('description', $mDesc); ?>
        <?php echo meta('keywords', $mKey); ?>
        <?php echo meta('language', 'th'); ?>
        <?php echo meta('robots', 'index,follow'); ?>
        <?php echo(meta(array('name' => 'Content-type', 'content' => 'text/html;charset=utf-8', 'type' => 'equiv'))) ?>
        <link href="<?= base_url() ?>public/css/layout.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>public/css/template.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo(base_url()) ?>public/js/jquery-1.7.1.min.js"></script>       
    </head>
    <body>
        <div id="header"><?php $this->load->view('layouts/menu') ?></div>
       <?php $this->load->view($content) ?>
    </body>
</html>