<?php include_once HEADER; ?>
<script type="text/javascript">
    $(function(){
        //$('#tabs').tabs();
        //$('#bfood_list').tablesorter();
    });
    $(document).ready(function(){
        $('.addBasicButton').click(function(){
    		$('.addBasicForm').toggle('slow');
    		$('.addBasicPlus').text($('.addBasicPlus').text() == '+' ? '-' : '+');
        });
        $('.addCompositeButton').click(function(){
    		$('.addCompositeForm').toggle('slow');
    		$('.addCompositePlus').text($('.addCompositePlus').text() == '+' ? '-' : '+');
        });
    });
</script>
<div id="tabs">
    <ul>
        <li><a href="#b_food">Basic Food</a></li>
        <li><a href="#c_food">Composite</a></li>
    </ul>
    <br>
    <h2>Basic Foods</h2>
    <div id="b_food" style="width: 80%;">
        <table id="bfood_list" class="datatable tablesorter" width="70%">
            <thead>
                <tr><th>S.N.</th><th>Food Name</th><th>Keywords</th><th>Calories</th><th>Actions</th></tr>
            </thead>
            <?php 
            	// Iterate through the foods
            	$foods = $this->getFoodData()->getBasicFoods();
            	for($i=0;$i<count($foods);$i++)
            	{
            		$food = $foods[$i];
            		if($food->getEnabled())
            		{
            ?>
            <tr><td><?php echo ($i+1); ?>.</td><td><?php echo $food->getName(); ?></td><td>//TODO: put keywords here</td><td><?php echo $food->getNutritionFact('calories', false); ?></td><td align="center"><a href="#" class="icon-edit"></a><a href="<?php echo $this->getDisableUri($food->getId()); ?>" class="icon-delete"></a></td></tr>
            <?php
            		}
            	} 
            ?>
        </table>
        <div class="addBasicButton"><span class="ui-corner-all link-btn">(<span class="addBasicPlus">+</span>) Add New Basic Food</span></div>
        <form action="" method="post">
	        <table class="datatable addBasicForm" style="display:none">
	            <tr><th colspan="2" align="left">:: Please specify the info below to add a new food</th></tr>
	            <tr>
	                <td width="15%">Name:</td>
	                <td><input type="text" name="foodName" id="foodName" size="40"/></td>
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
	            <input type="hidden" name="addBasic" value="true">          
	        </table>
        </form>
    </div>
    <br><br>
    <h2>Composite Foods</h2>
    <div id="c_food" >
        <table id="cfood_list" class="datatable tablesorter" width="70%">
            <thead>
                <tr><th>S.N.</th><th>Food Name</th><th>Keywords</th><th>Calories</th><th>Actions</th></tr>
            </thead>
            <?php 
            	// Iterate through the foods
            	$foods = $this->getFoodData()->getCompositeFoods();
            	for($i=0;$i<count($foods);$i++)
            	{
            		$food = $foods[$i];
            		if($food->getEnabled())
            		{
            ?>
            <tr><td><?php echo ($i+1); ?>.</td><td><?php echo $food->getName(); ?></td><td>TODO: put keywords here</td><td><?php echo $food->getNutritionFact('calories', false); ?></td><td align="center"><a href="#" class="icon-edit"></a><a href="<?php echo $this->getDisableUri($food->getId()); ?>" class="icon-delete"></a></td></tr>
            <?php
            		} 
            	}
            ?>         
        </table>
        <div class="addCompositeButton"><span class="ui-corner-all link-btn">(<span class="addCompositePlus">+</span>) Add New Composite Food</span></div>
        <table class="datatable addCompositeForm" style="display:none">
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
<br>
<br>
<?php include_once FOOTER; ?>
