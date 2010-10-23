<?php include_once('includes/header.php'); ?>
<table class="datatable">
    <tr><th colspan="2" align="left">:: Please specify the info below to register</th></tr>
    <tr>
        <td>Username</td>
        <td><input type="text" name="name" id="name"/></td>
    </tr>   
    <tr>
        <td>Password:</td>
        <td><input type="text" name="password" id="password"/></td>
    </tr>    
    <tr>
        <td></td>
        <td>
            <input type="submit" id="btnRegister" name="btnRegister" value="Save Profile"/>
            <input type="reset" id="btnReset" name="btnReset" value="Reset"/>
        </td>
    </tr>
</table>
<?php include_once('includes/footer.php'); ?>
