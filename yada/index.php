<?php include_once('includes/header.php'); ?>
<table class="datatable">
    <tr><th colspan="2" align="left">:: Please specify the info below to save your </th></tr>
    <tr>
        <td>Name:</td>
        <td><input type="text" name="name" id="name" size="40"/></td>
    </tr>
    <tr><td width="25%">Gender</td>
        <td>
            <label><input type="radio" name="gender" id="male"/>Male</label>
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
                <option>

                </option>
            </select>
        </td>
    </tr>
    <tr id="composite">
        <td>Select Basic Foods</td>
        <td><select name="basic_foods" id="basic_foods">
                <option>Basic Food 1</option>
                <option>Basic Food 2</option>
                <option>Basic Food 3</option>
                <option>Basic Food 4</option>
                <option>Basic Food 5</option>
            </select>
            Servings
            <input type="text" name="serving" id="serving" size="4"/><br/>
            <select name="basic_foods" id="basic_foods">
                <option>Basic Food 1</option>
                <option>Basic Food 2</option>
                <option>Basic Food 3</option>
                <option>Basic Food 4</option>
                <option>Basic Food 5</option>
            </select>
            Servings
            <input type="text" name="serving" id="serving" size="4"/>
        </td>
    </tr>
    <tr>
        <td>Calories:</td>
        <td><input type="text" name="calories" id="calories" size="5"/></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" id="btnFoodEntry" name="foodEntry" value="Add Food"/></td>
    </tr>
</table>
<?php include_once('includes/footer.php'); ?>
