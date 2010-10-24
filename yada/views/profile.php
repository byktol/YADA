<?php
include_once HEADER;

//$calCalcTemplate = new HarrisBenedictTemplate();
//$calCalcTemplate = new MifflinJerrorTemplate();
//
//$user = new User();
//$user->setName("abhishek");
//
//$calMetrics = new CalorieMetrics();
//$calMetrics->setAge(26);
//$calMetrics->setGender("MALE");
//$calMetrics->setWeight(55);
//$calMetrics->setHeight(150);
//$calMetrics->setActivityLevel(1.2);
//$calMetrics->setCalorieCalcTpl($calCalcTemplate);
//$cal = $calCalcTemplate->calculateNutritionFact($calMetrics);

//echo "cal: ".$cal;

//$userDao = new UserDAO();
//$user = $userDao->getUser('');
//echo "<pre>";
//print_r($user);

?>
<table class="datatable">
    <tr><th colspan="2" align="left">:: Please specify the info below to save your profile</th></tr>
    <tr>
        <td>Name:</td>
        <td><input type="text" name="name" id="name" size="40"/></td>
    </tr>
    <tr><td style="width: 25%">Gender</td>
        <td>
            <label><input type="radio" name="gender" id="male" checked="checked" />Male</label>
            <label><input type="radio" name="gender" id="female"/>Female</label>
        </td>
    </tr>
    <tr>
        <td>Height:</td>
        <td><input type="text" name="height" id="height" size="10"/><span class="tips"> (Please specify in cm (E.g. 185cm)</span></td>
    </tr>
    <tr>
        <td>Weight:</td>
        <td><input type="text" name="weight" id="weight" size="10"/><span class="tips"> (Please specify in kg (E.g. 75kg)</span></td>
    </tr>
    <tr>
        <td>Activity Level:</td>
        <td>
            <select name="activity_level" id="activity_level">
                <option value="0">--Choose Activity Level--</option>
                <option value="1">Highly Active</option>
                <option value="2">Active</option>
                <option value="3">Sedentary</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Calorie Calculation Method:</td>
        <td>
            <select name="calculation" id="calculation">
                <option value="0">--Choose Method--</option>
                <option value="1">Harris-Benedict</option>
                <option value="2">Miffin-Jerror</option>
            </select>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="submit" id="btnSaveProfile" name="btnSaveProfile" value="Save Profile"/>
            <input type="button" id="btnCalcCalorie" name="btnCalcCalorie" value="Calcualte Calorie"/>
            <input type="reset" id="btnReset" name="btnReset" value="Reset"/>
        </td>
    </tr>
</table>
<?php include_once FOOTER; ?>
