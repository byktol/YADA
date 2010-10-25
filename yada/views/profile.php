<?php include_once HEADER; ?>
<form action="<?php echo HOST . 'index.php?user=profile' ?>" method="post">
<table class="datatable">
    <tr><th colspan="2" align="left">:: Please specify the info below to save your profile</th></tr>
    <tr>
        <td>Firstname:</td>
        <td><input type="text" name="firstname" id="firstname" size="40" value="<?php echo $user->getFirstname() ?>" /></td>
    </tr>
    <tr>
        <td>Lastname:</td>
        <td><input type="text" name="lastname" id="lastname" size="40" value="<?php echo $user->getLastname() ?>" /></td>
    </tr>
    <tr>
        <td>Age:</td>
        <td><input type="text" name="age" id="age" size="2" value="<?php echo $user->getAge() ?>" /></td>
    </tr>
    <tr><td style="width: 25%">Gender</td>
        <td>
            <label><input type="radio" name="gender" id="male" value="1" <?php echo $user->getGender() ? 'checked="checked"' : '' ?>/>Male</label>
            <label><input type="radio" name="gender" id="female" value="0" <?php echo $user->getGender() ? '' : 'checked="checked"' ?>/>Female</label>
        </td>
    </tr>
    <tr>
        <td>Height:</td>
        <td><input type="text" name="height" id="height" size="10" value="<?php echo $user->getHeight() ?>" /><span class="tips"> (Please specify in cm (E.g. 185cm)</span></td>
    </tr>
    <tr>
        <td>Weight:</td>
        <td><input type="text" name="weight" id="weight" size="10" value="<?php echo $user->getWeight() ?>"/><span class="tips"> (Please specify in kg (E.g. 75kg)</span></td>
    </tr>
    <tr>
        <td>Activity Level:</td>
        <td>
            <select name="activity_level" id="activity_level">
                <option value="1" <?php echo $user->getActivityLevel() == 1? 'selected="selected"' : '' ?> >Highly Active</option>
                <option value="2" <?php echo $user->getActivityLevel() == 2? 'selected="selected"' : '' ?> >Active</option>
                <option value="3" <?php echo $user->getActivityLevel() == 3? 'selected="selected"' : '' ?> >Sedentary</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Calorie Calculation Method:</td>
        <td>
            <select name="calculator_id" id="calculator_id">
                <option value="1" <?php echo $user->getCalculatorId() == 1? 'selected="selected"' : '' ?> >Harris-Benedict</option>
                <option value="2" <?php echo $user->getCalculatorId() == 2? 'selected="selected"' : '' ?> >Miffin-Jerror</option>
            </select>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="submit" id="btnSaveProfile" name="btnSaveProfile" value="Save Profile"/>
            <input type="reset" id="btnReset" name="btnReset" value="Reset"/>
        </td>
    </tr>
</table>
</form>
<?php include_once FOOTER; ?>
