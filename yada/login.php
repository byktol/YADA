<?php
$path = "../../";
include_once(HEADER); ?>
<form action="index.php" name="frmLogin" id="frmLogin" method="post">
    <table>
        <tr><th colspan="">Please provide you username and password to login:</th></tr>
        <tr><td>Username</td><td><input type="text" name="username" id="username"/></td></tr>
        <tr><td>Password</td><td><input type="password" name="password" id="password"/></td></tr>
        <tr><td></td><td><input type="submit" name="login"  id="login" value="Login"/></td></tr>
    </table>
</form>
<?php include_once('includes/footer.php'); ?>
