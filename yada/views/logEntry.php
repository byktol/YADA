<?php include_once HEADER; ?>
<script type="text/javascript">
    $(function(){
        //$('#tabs').tabs();
        //$('#bfood_list').tablesorter();
    });
</script>
<form action="" method="post">
    <table class="datatable addBasicForm" style="display:none">
        <tr><th colspan="2" align="left">:: Please specify the info below to add a new food</th></tr>
        <tr>
            <td width="15%">Food</td>
            <td><select name="basic_foods" id="basic_foods">
                    <option>Basic Food 1</option>
                    <option>Basic Food 2</option>
                    <option>Basic Food 3</option>
                    <option>Basic Food 4</option>
                    <option>Basic Food 5</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Servings:</td>
            <td><input type="text" name="keywords" id="keywords" size="60"/><span class="tips"> (Please use comma to separate the keywords (E.g. potato, tomato)</span></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" id="addLog" name="addLog" value="Add Log"/></td>
        </tr>
    </table>
</form>
<?php include_once FOOTER; ?>