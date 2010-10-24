<?php
//$path = "./";
//include_once($path . 'includes/header.php');
//$sessMgr->reset();

include_once HEADER;

$oldUsername = '';
//$isLoggedIn = $sessMgr->get('is_logged_in');

//if (!is_null($isLoggedIn) && !$isLoggedIn) {
//    $oldUsername = $sessMgr->get('old_user_name');
//    echo $utils->displayError('The username/password combination you provided is invalid!');
//}
?>
<form action="<?php echo HOST . 'index.php?user=login'; ?>" id="frmLogin" method="post">
    <table class="datatable">
        <tr><th colspan="2">Please provide you username and password to login:</th></tr>
        <tr><td>Username</td><td><input type="text" name="user_name" id="username" value="<?php echo $oldUsername; ?>"/></td></tr>
        <tr><td>Password</td><td><input type="password" name="password" id="password"/></td></tr>
        <tr><td></td><td><input type="submit" name="login" id="login" value="Login"/></td>
        </tr>
    </table>
</form>
<?php include_once FOOTER; ?>
