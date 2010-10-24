<?php include_once HEADER; ?>
<form action="<?php echo HOST . 'index.php?user=login'; ?>" id="frmLogin" method="post">
    <table class="datatable">
        <tr><th colspan="2">Please provide you username and password to login:</th></tr>
        <tr><td>Username</td><td><input type="text" name="username" id="username" value="<?php echo $username; ?>"/></td></tr>
        <tr><td>Password</td><td><input type="password" name="password" id="password"/></td></tr>
        <tr><td></td><td><input type="submit" name="login" id="login" value="Login"/></td>
        <tr><td>Or</td><td><a href="<?php echo HOST . 'index.php?user=register' ?>">Register a new account</a></td>
        </tr>
    </table>
</form>
<?php include_once FOOTER; ?>
