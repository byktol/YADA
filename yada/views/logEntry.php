<?php include_once HEADER; ?>
<?php 
	require_once "php/config.php";
	require_once "SessionManager.php";
	require_once "FoodController.php";
?>
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
        $('#log_date').datepicker({dateFormat:'yy-mm-dd'});
    });
    $(document).ready(function(){
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
        <form action="?user=log" method="post">
	        <table class="datatable" width="70%">
	        	<tr><td>Date:</td><td colspan="2"><input type="text" name="logDate" id="log_date"><span class="tips"> (yyyy-mm-dd)</span></td></tr>
	            <tr id="composite">
	                <td>Select Foods</td>
	                <td>
	                    <select name="basic_foods" id="compBuilderSelect" size="10" style="width:250px;">
			            <?php 
			            	// Iterate through the foods
			            	$foods = FoodController::getFoodData()->getFoods();
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
	        <input type="hidden" name="addLogEntry" value="true">
	        <input id="compBuilderNumberOfArgs" type="hidden" name="numberOfFoods" value="0">
	        <input id="compBuilderMaxIndex" type="hidden" name="maxIndex" value="0">
		</form>
<?php include_once FOOTER; ?>
