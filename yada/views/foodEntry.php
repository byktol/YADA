<?php include_once HEADER; ?>
<script type="text/javascript">
    $(function(){
        $('#tabs').tabs();
        $('#bfood_list').tablesorter();
    });
</script>
<div id="tabs">
    <ul>
        <li><a href="#b_food">Basic Food</a></li>
        <li><a href="#c_food">Composite</a></li>
    </ul>
    <div id="b_food" style="width: 80%;">
        <table id="bfood_list" class="datatable tablesorter" width="70%">
            <thead>
                <tr><th>S.N.</th><th>Food Name</th><th>Keywords</th><th>Calories</th><th>Actions</th></tr>
            </thead>
            <tr><td>1.</td><td>Cheese</td><td>yak cheese, powered cheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
            <tr><td>2.</td><td>Dheese</td><td>yak cheese, powered cheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
            <tr><td>3.</td><td>Eheese</td><td>yak cheese, powered cheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
            <tr><td>4.</td><td>Pheese</td><td>yak cheese, powered cheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
            <tr><td>5.</td><td>Hheese</td><td>yak cheese, powered cheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
            <tr><td>6.</td><td>Zheese</td><td>yak cheese, powered cheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
            <tr><td>7.</td><td>Rheese</td><td>yak cheese, powered cheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
        </table>
        <div><a href="#" class="ui-corner-all link-btn">(+) Add New Basic Food</a></div>
        <table class="datatable">
            <tr><th colspan="2" align="left">:: Please specify the info below to add a new food</th></tr>
            <tr>
                <td width="15%">Name:</td>
                <td><input type="text" name="food_name" id="food_name" size="40"/></td>
            </tr>
            <tr>
                <td>Keyword:</td>
                <td><input type="text" name="keywords" id="keywords" size="60"/><span class="tips"> (Please use comma to separate the keywords (E.g. potato, tomato)</span></td>
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
    </div>
    <div id="c_food" >
        <table id="cfood_list" class="datatable tablesorter" width="70%">
            <thead>
                <tr><th>S.N.</th><th>Food Name</th><th>Keywords</th><th>Calories</th><th>Actions</th></tr>
            </thead>
            <tr><td>1.</td><td>Burger</td><td>yak cheese, powered cheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
            <tr><td>2.</td><td>Sandwich</td><td>yak cheese, powered cheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
            <tr><td>3.</td><td>Pizza</td><td>yak cheese, powered cheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
            <tr><td>4.</td><td>Cheese-Macaroni</td><td>yak cheese, powered cheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>            
        </table>
        <div><a href="#" class="ui-corner-all link-btn">(+) Add New Composite Food</a></div>
        <table class="datatable">
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
        </table>
    </div>
</div>
<?php include_once FOOTER; ?>
