<?php
include_once HEADER;
//require_once(BASE . 'controller_funcs.php');
//
//$userExists = $sessMgr->get('e_user_name');
////$sessMgr->reset();
//$sessMgr->display();
//$alreadyRegistered = FALSE;
//if (isset($userExists)) {
//    // first check if the user is already registered throught he controller method
//    if (userExists($username)) {
//        $alreadyRegistered = TRUE;
//        echo $msg = '<div class="error">The username you chose <b>' . $username . '</b> already exists! Please select another one.</div>';
//    }
//}
?>
<form id="frmRegister" method="post" action="<?php echo HOST . 'index.php?user=register'?>">
    <table class="datatable">
        <tr><th colspan="2" align="left">:: Please specify the info below to register</th></tr>
        <tr>
            <td>Username</td>
            <td><input type="text" name="user_name" id="user_name"/></td>
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
                <input type="submit" id="btnRegister" name="btnRegister" value="Save Profile"/>
                <input type="reset" id="btnReset" name="btnReset" value="Reset"/>
            </td>
        </tr>
    </table>
</form>
<?php include_once FOOTER; ?>