<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>YADA: Yet Another Diet Assistant</title>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo CSS_PATH . 'reset.css'; ?>"/>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo CSS_PATH . 'style.css'; ?>"/>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo JQUERY_CSS; ?>"/>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo TBL_SORTER_BLUE; ?>"/>
        <link href="<?php echo IMAGES; ?>favicon.ico" rel="shortcut icon" type="image/x-icon">
        <script type="text/javascript" src="<?php echo JQUERY; ?>"></script>
        <script type="text/javascript" src="<?php echo JQUERY_UI; ?>"></script>
        <script type="text/javascript" src="<?php echo TBL_SORTER; ?>"></script>
    </head>
    <body>
        <div id="header" style="background-color:#6fa7d1;height:100px;background-image:url(<?php echo IMAGES; ?>Hamburger.png);background-position:right;background-repeat:no-repeat">
            <h1 style="margin-left:25px;">Welcome to your diet assistant! It's a beautiful day!</h1>
            <?php if (SessionManager::getInstance()->isLoggedIn()) : ?>
            	<br>
                <span style="margin-left:40px;">Hello, <strong><?php echo SessionManager::getInstance()->getUser()->getUsername() ?></strong></span>
            <?php endif ?>
            </div>
            <div id="body">
            <?php if (SessionManager::getInstance()->isLoggedIn()) : ?>
            <ul id="top-menu">
                <li><a href="<?php echo HOST . 'index.php?food=list_food' ?>">Food Entry</a></li>
                <li><a href="<?php echo HOST . 'index.php?user=profile' ?>">My Profile</a></li>
                <li><a href="<?php echo HOST . 'index.php?user=today' ?>">Daily Log</a></li>
                <li><a href="<?php echo HOST . 'index.php?user=log' ?>">New Log Entry</a></li>
                <li class="last"><a href="<?php echo HOST . 'index.php?user=logout' ?>">Logout</a></li>
            </ul>
            <?php endif ?>
            <?php if (SessionManager::getInstance()->errorCount() > 0) : ?>
                        <div class="error">
                            <ul>
                    <?php foreach (SessionManager::getInstance()->getErrors() as $e) : ?>
                            <li><?php echo $e ?></li>
                    <?php endforeach ?>
                        </ul>
                    </div>
            <?php endif; ?>
            <?php if (SessionManager::getInstance()->warningCount() > 0) : ?>
                                <div class="warning">
                                    <ul>
                    <?php foreach (SessionManager::getInstance()->getWarnings() as $w) : ?>
                                    <li><?php echo $w ?></li>
                    <?php endforeach ?>
                                </ul>
                            </div>
            <?php endif; ?>
            <?php if (SessionManager::getInstance()->infoCount() > 0) : ?>
                                        <div class="info">
                                            <ul>
                    <?php foreach (SessionManager::getInstance()->getInfos() as $i) : ?>
                                            <li><?php echo $i ?></li>
                    <?php endforeach ?>
                                        </ul>
                                    </div>
            <?php endif; ?>




