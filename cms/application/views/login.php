<?php echo(doctype('xhtml1-trans')) ?>
<html>
    <head>
        <title>Content Management System | <?= $title ?></title>
        <?php echo(meta(array('name' => 'Content-type', 'content' => 'text/html;charset=utf-8', 'type' => 'equiv'))) ?>
        <?php echo(link_tag(base_url() . 'public/css/layout.css')) ?>
        <?php echo(link_tag(base_url() . 'public/css/style.css')) ?>
        <?php echo(link_tag(base_url() . 'public/css/element.css')) ?>
        <?php echo(link_tag(base_url() . 'public/css/font.css')) ?>

        <script type="text/javascript" src="<?php echo(base_url()) ?>library/dojo/dojo/dojo.js"></script>
        <script type="text/javascript" src="<?php echo(base_url()) ?>public/js/ajax.js"></script>
        <script type="text/javascript" src="<?php echo(base_url()) ?>public/js/javascript.js"></script>
    </head>
    <body onload="dojo.byId('username').focus()">
    <center>
        <div class="login-top"><span class="login-top-url"><a href="../" class="Lglay">&larr; หน้าแรกระบบสืบค้นผลงานตีพิมพ์สถาบันวิจัยจุฬาภรณ์</a></span></div>
        <div class="login-logo"></div>
        <br />
        <form method="post" action="">
            <?php if (@$status == 'false'): ?><div class="login-error"><b>Error:</b> Login failed.</div><?php endif; ?>
            <div class="login-form">
                <label class="login">Username</label>
                <input type="text" id="username" name="username" class="login" />
                <div class="login-blank20">&nbsp;</div>
                <label class="login">Password</label>
                <input type="password" name="password" class="login" />
                <input type="image" id="btLogin" src="<?= base_url() ?>public/img/button/bt_login.png" onmouseover="dojo.byId('btLogin').className = 'bt_login-over'" onmouseout="dojo.byId('btLogin').className = 'bt_login'" class="bt_login" />
            </div>
            <?= $this->session->userdata('id') ?>
        </form>
    </center>
</body>
</html>