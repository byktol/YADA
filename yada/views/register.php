<?php include_once HEADER; ?>
<form id="frmRegister" method="post" action="<?php echo HOST . 'index.php?user=register'?>">
    <table class="datatable">
        <tr><th colspan="2" align="left">:: Please specify the info below to register</th></tr>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username" id="username" value="<?php echo $username ?>"/></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" id="password"/></td>
        </tr>
        <tr>
            <td>Confirm Password:</td>
            <td><input type="password" name="c_password" id="c_password"/></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" id="btnRegister" name="btnRegister" value="Register!"/>
                <input type="reset" id="btnReset" name="btnReset" value="Reset"/>
            </td>
        </tr>
    </table>
</form>
<?php include_once FOOTER; ?>