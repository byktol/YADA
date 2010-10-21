<?php include_once('includes/header.php'); ?>
<table class="datatable">
    <tr><th colspan="2" align="left">:: Please specify the info below to add a new food</th></tr>
    <tr><td width="25%">Type</td>
        <td>
            <label><input type="radio" name="foot_type" id="basic_food"/>Basic Food</label>
            <label><input type="radio" name="foot_type" id="composite_food"/>Composite Food</label>
        </td>
    </tr>
    <tr>
        <td>Name:</td>
        <td><input type="text" name="food_name" id="food_name" size="40"/></td>
    </tr>
    <tr>
        <td>Keyword:</td>
        <td><input type="text" name="keywords" id="keywords" size="60"/><span class="tips"> (Please use comma to separate the keywords (E.g. potato, tomato)</span></td>
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
