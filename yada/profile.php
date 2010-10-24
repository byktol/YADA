<?php
$path = "./";
include_once($path . 'includes/header.php');

$isRegSuccess = $sessMgr->get('reg_succes');
$regMsg = '';
$isProfileSaved = $sessMgr->get('is_profile_saved');

if (isset($isProfileSaved)) {
    if ($isProfileSaved) {
        echo $utils->displaySuccess('Your profile has been saved successfully !');
    } else {
        echo $utils->displayErro('There was problem while saving your profile!');
    }
} else {
    if (isset($isRegSuccess)) {
        if ($isRegSuccess) {
            echo $utils->displaySuccess('Yeee ha! You have been successfully registered!');
        } else {
            echo $utils->displayError('Sorry, we could not register you at the moment! Please try at a later time.');
        }
    }
}
?>
<form name="frmProfile" id="frmProfile" action="userHandler.php" method="post">
    <table class="datatable">
        <tr><th colspan="2" align="left">:: Please specify the info below to set your profile</th></tr>
        <tr><td width="25%">Gender</td>
            <td>
                <label><input type="radio" name="gender" id="male" checked value="1" />Male</label>
                <label><input type="radio" name="gender" id="female" value="0"/>Female</label>
            </td>
        </tr>
        <tr>
            <td>Age:</td>
            <td><input type="text" name="age" id="age" size="5"/><span class="tips"> (Please specify in years</span></td>
        </tr>
        <tr>
            <td>Height:</td>
            <td><input type="text" name="height" id="height" size="10"/><span class="tips"> (Please specify in cm</span></td>
        </tr>
        <tr>
            <td>Weight:</td>
            <td><input type="text" name="weight" id="weight" size="10"/><span class="tips"> (Please specify in kg</span></td>
        </tr>
        <tr>
            <td>Activity Level:</td>
            <td>
                <select name="activity_level" id="activity_level">
                    <option value="0">--Choose Activity Level--</option>
                    <option value="1">Extra Active</option>
                    <option value="1">Very Active</option>
                    <option value="1">Moderately Active</option>
                    <option value="2">Lightly Active</option>
                    <option value="3">Sedentary</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Calorie Calculation Method:</td>
            <td>
                <select name="cal_calc_method" id="cal_calc_method">
                    <option value="0">--Choose Method--</option>
                    <option value="1">Harris-Benedict</option>
                    <option value="2">Mifflin-Jerror</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" id="btnSaveProfile" name="btnSaveProfile" value="Save Profile"/>
                <input type="button" id="btnCalcCalorie" name="btnCalcCalorie" value="Calcualte Calorie"/>
                <input type="reset" id="btnReset" name="btnReset" value="Reset"/>
                <input type="hidden" id="task" name="task" value="save_profile"/>
            </td>
        </tr>
    </table>
</form>
<?php include_once('includes/footer.php'); ?>
