<?php include_once('includes/header.php'); ?>
<script type="text/javascript">
    $(function(){
        $('#log_date').datepicker({date_format:'yyyy-mm-dd'});
    });
</script>
<form action="<?php echo HOST . 'foodHandler.php'; ?>" name="frmLogEntry" id="frmLogEntry" method="post">
    <table class="datatable">
        <tr><th colspan="2">Please provide the foods for your entry below:</th></tr>
        <tr><td>Date</td><td><input type="text" name="log_date" id="log_date"/></td></tr>
        <tr><td>Food</td>
            <td>
                <select>
                    <option value="1">Basic Food 1</option>
                    <option value="2">Basic Food 2</option>
                    <option value="3">Basic Food 3</option>
                    <option value="4">Composite Food 1</option>
                    <option value="5">Composite Food 2</option>
                    <option value="6">Composite Food 3</option>
                    <option value="7">Composite Food 4</option>
                    <option value="8">Composite Food 5</option>
                </select>
            </td>
        </tr>
        <tr><td></td>
            <td><label><input type="checkbox" value="1" name="continue_log" /> Continue adding log</label>
                <input type="submit" name="btnAddLog" id="btnAddLog" value="Add To Log"/>
                <input type="hidden" name="task" id="task" value="log_entry"/></td>
        </tr>
    </table>
</form>
<?php include_once('includes/footer.php'); ?>
