<?php require_once $path . 'autoload.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>YADA: Yet Another Diet Assistant</title>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo CSS_PATH . 'reset.css'; ?>"/>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo CSS_PATH . 'style.css'; ?>"/>
        <script type="text/javascript" src="<?php echo JQUERY; ?>"></script>
    </head>
    <body>
        <div id="header">            
            <h2>Welcome to you diet assistant! Its a beautiful day!</h2>
        </div>
        <div id="body">
            <ul id="top-menu">
                <li><a href="foodEntry.php">Food Entry</a></li>
                <li><a href="profile.php">My Profile</a></li>
                <li class="last"><a href="foodLog.php">My Food Log</a></li>
            </ul>




