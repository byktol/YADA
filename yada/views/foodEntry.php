<?php include_once HEADER; ?>
<script type="text/javascript">
	var compBuilderIndex = 1;
	var compBuilderNumArgs = 0;
	function addCompositeBuilderFoodRow(id, name, servings)
	{
		$('#compBuilderTable').show();
		$('#compBuilderInsertBefore').before('<tr id="compBuilderFoodEntry'+compBuilderIndex+'" class="compBuilderFoodEntry"><td><input type="hidden" name="id'+compBuilderIndex+'" value="'+id+'"><input type="hidden" name="servings'+compBuilderIndex+'" value="'+servings+'">'+name+'</td><td>'+servings+'</td><td style="text-align:center"><a href="javascript:removeCompositeBuilderFoodRow(\'compBuilderFoodEntry'+compBuilderIndex+'\')" class="icon-delete" title="delete"></a></td></tr>');
		compBuilderNumArgs++;
		$('#compBuilderNumberOfArgs').val(compBuilderNumArgs);
		$('#compBuilderMaxIndex').val(compBuilderIndex);
		compBuilderIndex++;
	}
	function removeCompositeBuilderFoodRow(id)
	{
		$('#'+id).remove();
		compBuilderNumArgs--;
		$('#compBuilderNumberOfArgs').val(compBuilderNumArgs);
		if(compBuilderNumArgs == 0)
			$('#compBuilderResetBtn').click();
	}

    $(function(){
        $('#tabs').tabs({"selected":<?php echo (FoodController::$tab?'1':'0'); ?>});
        $('#bfood_list').tablesorter();
        $('#cfood_list').tablesorter();
    });
    $(document).ready(function(){
        $('.addBasicButton').click(function(){
    		$('.addBasicForm').toggle();
    		$('.addBasicPlus').text($('.addBasicPlus').text() == '+' ? '-' : '+');
    		$('#foodName').focus();
        });
        $('.addCompositeButton').click(function(){
    		$('.addCompositeForm').toggle();
    		$('.addCompositePlus').text($('.addCompositePlus').text() == '+' ? '-' : '+');
    		$('#foodNameC').focus();
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
        $('#compBuilderResetBtn').click(function(){
        	$('.compBuilderFoodEntry').remove();
        	$('#compBuilderTable').hide();
        	compBuilderIndex = 1;
        	compBuilderNumArgs = 0;
    		$('#compBuilderNumberOfArgs').val(compBuilderNumArgs);
    		$('#compBuilderMaxIndex').val(compBuilderIndex);
        });
    });
</script>
<div id="tabs">
    <ul>
        <li><a href="#b_food">Basic Food</a></li>
        <li><a href="#c_food">Composite Food</a></li>
    </ul>
    <div id="b_food" style="width: 80%;">
        <h2>Basic Foods&nbsp;&nbsp;&nbsp;&nbsp;<a href="?food=list_food&save=true" style="font-size:17pt;color:#999999" class="icon-save">save</a></h2>
        <br>
        <table id="bfood_list" class="datatable tablesorter" width="70%">
            <thead>
                <tr><th>Entry</th><th>Food Name</th><th>Keywords</th><th>Calories</th><th style="width:100px">Actions</th></tr>
            </thead>
            <?php 
            	// Iterate through the foods
            	$foods = self::getFoodData()->getBasicFoods();
            	$entry = 0;
            	if(!empty($foods))
            	{
	            	for($i=0;$i<count($foods);$i++)
	            	{
	            		$food = $foods[$i];
	            		if($food->getEnabled())
	            		{
            ?>
	            <tr><form action="?food=list_food" method="post"><td>
	            	<?php echo ($entry+1); ?>.
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
	            </td>
	            <input type="hidden" name="foodId" value="<?php echo $food->getId(); ?>">
	            <input type="hidden" name="editBasic" value="true">
	            </form></tr>
            <?php
	            			$entry++;
	            		}
	            	} 
            	}
            	else
            	{
            ?>
            	<tr><td></td><td></td><td></td><td></td><td></td></tr>
            <?php
            	} 
            ?>
        </table>
        <div><span class="ui-corner-all link-btn addBasicButton">(<span class="addBasicPlus">+</span>) Add New Basic Food</span></div>
        <?php if ($undoEnabled) : ?>
        <div style="display: inline"><form action="?food=list_food" method="post"><input type="submit" value="Undo" name="undo" /></form></div>
        <?php endif ?>
        <?php if ($redoEnabled) : ?>
        <div style="display: inline"><form action="?food=list_food" method="post"><input type="submit" value="Redo" name="redo" /></form></div>
        <?php endif ?>
        <form action="?food=list_food" method="post">
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
    <div id="c_food" >
        <h2>Composite Foods&nbsp;&nbsp;&nbsp;&nbsp;<a href="?food=list_food&save=true" style="font-size:17pt;color:#999999" class="icon-save">save</a></h2>
    	<br>
        <table id="cfood_list" class="datatable tablesorter" width="70%">
            <thead>
                <tr><th>Entry</th><th>Food Name</th><th>Keywords</th><th>Calories</th><th style="width:100px">Actions</th></tr>
            </thead>
            <?php 
            	// Iterate through the foods
            	$foods = self::getFoodData()->getCompositeFoods();
            	$entry = 0;
            	if(!empty($foods))
            	{
	            	for($i=0;$i<count($foods);$i++)
	            	{
	            		$food = $foods[$i];
	            		if($food->getEnabled())
	            		{
            ?>
            <form action="?food=list_food" method="post">
	            <tr><td>
	            	<?php echo ($entry+1); ?>.
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
	            			$entry++;
	            		} 
	            	}
            	}
            	else
            	{
            ?>
            	<tr><td></td><td></td><td></td><td></td><td></td></tr>
            <?php
            	} 
            ?>        
        </table>
        <div><span class="ui-corner-all link-btn addCompositeButton">(<span class="addCompositePlus">+</span>) Add New Composite Food</span></div>
        <?php if ($undoEnabled) : ?>
        <div style="display: inline"><form action="?food=list_food" method="post"><input type="submit" value="Undo" name="undo" /></form></div>
        <?php endif ?>
        <?php if ($redoEnabled) : ?>
        <div style="display: inline"><form action="?food=list_food" method="post"><input type="submit" value="Redo" name="redo" /></form></div>
        <?php endif ?>
        <div class="addCompositeForm" style="display:none">
        	<form action="?food=list_food" method="post">
		        <table class="datatable" width="80%">
		        	<tr><td>Name:</td><td colspan="2"><input type="text" name="foodName" id="foodNameC" size="40"></td></tr>
		        	<tr><td>Keywords:</td><td colspan="2"><input type="text" name="keywords" id="keywordsC" size="60"/><span class="tips"> (Please use comma to separate the keywords (E.g. potato, tomato)</span></td></tr>
		            <tr id="composite">
		                <td>Select Basic Foods</td>
		                <td>
		                    <select name="basic_foods" id="compBuilderSelect" size="10" style="width:250px;">
				            <?php 
				            	// Iterate through the foods
				            	$foods = self::getFoodData()->getFoods();
				            	if(!empty($foods))
            					{
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
            					}
		                    ?>
		                    </select>
		                </td>
		                <td>
		                    Servings
		                    <input type="text" name="serving" id="compBuilderServing" value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
		                    <input type="button" id="compBuilderAddBtn" value="Add">
		                    <input type="button" id="compBuilderResetBtn" value="Reset">
		                </td>
		            </tr>
		        </table>
		        <table id="compBuilderTable" class="datatable" style="display:none" width="40%">
		        	<tr><th>Food Name</th><th>Number of Servings</th><th>Action</th></tr>
		        	<tr id="compBuilderInsertBefore"><td></td><td></td><td style="text-align:center"><input type="submit" value="Add Food"></td></tr>
		        </table>
		        <input type="hidden" name="addComposite" value="true">
		        <input id="compBuilderNumberOfArgs" type="hidden" name="numberOfFoods" value="0">
		        <input id="compBuilderMaxIndex" type="hidden" name="maxIndex" value="0">
			</form>
		</div>
    </div>
</div>
<br>
<br>
<?php include_once FOOTER; ?>
