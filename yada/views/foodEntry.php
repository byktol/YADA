<?php include_once HEADER; ?>
<script type="text/javascript">
	function addCompositeBuilderFoodRow(id, name, servings)
	{
		
	}

    $(function(){
        //$('#tabs').tabs();
        //$('#bfood_list').tablesorter();
    });
    $(document).ready(function(){
        $('.addBasicButton').click(function(){
    		$('.addBasicForm').toggle();
    		$('.addBasicPlus').text($('.addBasicPlus').text() == '+' ? '-' : '+');
        });
        $('.addCompositeButton').click(function(){
    		$('.addCompositeForm').toggle();
    		$('.addCompositePlus').text($('.addCompositePlus').text() == '+' ? '-' : '+');
        });
        $('.editBtn').click(function(){
            $('.editting').hide();
            $('.non-edit').show();
            var id = $(this).attr('id');
            $('#'+id+'Submit').show();
            $('#'+id+'NameSpan').hide();
            $('#'+id+'NameInput').show();
            $('#'+id+'NameInput').select();
            $('#'+id+'KeywordsSpan').hide();
            $('#'+id+'KeywordsInput').show();
            $('#'+id+'CaloriesSpan').hide();
            $('#'+id+'CaloriesInput').show();
            $(this).hide();
        });
        $('.editBtnC').click(function(){
            $('.edittingC').hide();
            $('.non-editC').show();
            var id = $(this).attr('id');
            $('#'+id+'SubmitC').show();
            $('#'+id+'NameSpanC').hide();
            $('#'+id+'NameInputC').show();
            $('#'+id+'NameInputC').select();
            $('#'+id+'KeywordsSpanC').hide();
            $('#'+id+'KeywordsInputC').show();
            $(this).hide();
        });
        $('#compBuilderAddBtn').click(function(){
            var name = $('#compBuilderSelect option:selected').text();
            var id = $('#compBuilderSelect option:selected').val();
            var servings = $('#compBuilderServing').val();
            addCompositeBuilderFoodRow(id, name, servings);
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
                <tr><th>S.N.</th><th>Food Name</th><th>Keywords</th><th>Calories</th><th style="width:100px">Actions</th></tr>
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
            <form action="" method="post">
	            <tr><td>
	            	<?php echo ($i+1); ?>.
	            </td><td>
	            	<input id="editBtn<?php echo $i; ?>NameInput" class="editting" type="text" name="foodName" value="<?php echo $food->getName(); ?>" style="display:none">
	            	<span id="editBtn<?php echo $i; ?>NameSpan" class="non-edit"><?php echo $food->getName(); ?></span>
	            </td><td>
	            	<input id="editBtn<?php echo $i; ?>KeywordsInput" class="editting" type="text" name="keywords" value="<?php echo ($food->getKeywords() == null ? '' : implode(', ', $food->getKeywords())); ?>" style="display:none">
	            	<span id="editBtn<?php echo $i; ?>KeywordsSpan" class="non-edit"><?php echo ($food->getKeywords() == null ? '' : implode(', ', $food->getKeywords())); ?></span>
	            </td><td>
	            	<input id="editBtn<?php echo $i; ?>CaloriesInput" class="editting" type="text" name="calories" value="<?php echo $food->getNutritionFact('calories', false); ?>" style="display:none">
	            	<span id="editBtn<?php echo $i; ?>CaloriesSpan" class="non-edit"><?php echo $food->getNutritionFact('calories', false); ?></span>
	            </td><td align="center">
	            <input id="editBtn<?php echo $i; ?>Submit" class="editting" type="submit" value="done" style="display:none;margin-right:10px">
	            <span id="editBtn<?php echo $i; ?>" class="icon-edit editBtn span-btn non-edit" title="edit"></span>
	            <a href="<?php echo $this->getDisableUri($food->getId()); ?>" class="icon-delete" title="delete"></a>
	            </td></tr>
	            <input type="hidden" name="foodId" value="<?php echo $food->getId(); ?>">
	            <input type="hidden" name="editBasic" value="true">
            </form>
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
                <tr><th>S.N.</th><th>Food Name</th><th>Keywords</th><th>Calories</th><th style="width:100px">Actions</th></tr>
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
            <form action="" method="post">
	            <tr><td>
	            	<?php echo ($i+1); ?>.
	            </td><td>
	            	<input id="editBtn<?php echo $i; ?>NameInputC" class="editting" type="text" name="foodName" value="<?php echo $food->getName(); ?>" style="display:none">
	            	<span id="editBtn<?php echo $i; ?>NameSpanC" class="non-edit"><?php echo $food->getName(); ?></span>
	            </td><td>
	            	<input id="editBtn<?php echo $i; ?>KeywordsInputC" class="editting" type="text" name="keywords" value="<?php echo ($food->getKeywords() == null ? '' : implode(', ', $food->getKeywords())); ?>" style="display:none">
	            	<span id="editBtn<?php echo $i; ?>KeywordsSpanC" class="non-edit"><?php echo ($food->getKeywords() == null ? '' : implode(', ', $food->getKeywords())); ?></span>
	            </td><td>
	            	<span class="non-edit"><?php echo $food->getNutritionFact('calories', false); ?></span>
	            </td><td align="center">
	            <input id="editBtn<?php echo $i; ?>SubmitC" class="editting" type="submit" value="done" style="display:none;margin-right:10px">
	            <span id="editBtn<?php echo $i; ?>" class="icon-edit editBtnC span-btn non-edit" title="edit"></span>
	            <a href="<?php echo $this->getDisableUri($food->getId()); ?>" class="icon-delete" title="delete"></a>
	            </td></tr>
	            <input type="hidden" name="foodId" value="<?php echo $food->getId(); ?>">
	            <input type="hidden" name="editComposite" value="true">
            </form>
            <?php
            		} 
            	}
            ?>         
        </table>
        <div class="addCompositeButton"><span class="ui-corner-all link-btn">(<span class="addCompositePlus">+</span>) Add New Composite Food</span></div>
        <form action="" method="post">
	        <table class="datatable addCompositeForm" style="display:none">
	            <tr id="composite">
	                <td>Select Basic Foods</td>
	                <td>
	                    <select name="basic_foods" id="compBuilderSelect" size="6" style="width:250px;">
			            <?php 
			            	// Iterate through the foods
			            	$foods = $this->getFoodData()->getBasicFoods();
			            	for($i=0;$i<count($foods);$i++)
			            	{
			            		$food = $foods[$i];
			            		if($food->getEnabled())
			            		{
			            ?>
	                        <option <?php echo ($i==0?'selected="selected"':''); ?> value="<?php echo $food->getId(); ?>"><?php echo $food->getName(); ?></option>
	                    <?php 
			            		}
			            	}
	                    ?>
	                    </select>
	                </td>
	                <td>
	                    Servings
	                    <input type="text" name="serving" id="compBuilderServing"/>&nbsp;&nbsp;&nbsp;&nbsp;
	                    <button id="compBuilderAddBtn">Add</button>
	                    <button id="compBuilderResetBtn">Reset</button>
	                </td>
	            </tr>
	            <tr><td>
	            </td></tr>
	        </table>
	        <input type="hidden" name="addComposite" value="true">
		</form>
    </div>
</div>
<br>
<br>
<?php include_once FOOTER; ?>
