<?php
include_once HEADER;
$sessMgr = SessionManager::getInstance();
$logDate = $date;

$arrConsumptions = $log->getConsumption();
?>
<script type="text/javascript">
    $(function(){
        $('#log_date').datepicker({date_format:'yyyy-mm-dd'});
    });
</script>
<form action="<?php echo HOST . 'foodHandler.php'; ?>" id="frmLogEntry" method="post">
    <table class="datatable">
        <tr><th colspan="4">Please provide the foods for your entry below:</th></tr>
        <tr><td>Date</td><td colspan="3"><input type="text" name="log_date" id="log_date"/></td></tr>
        <?php foreach ($arrConsumptions as $cnsmp) {
        ?>
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
                <td>Servings</td><td><input type="text" name="qty" id="qty" size="10" value="<?php echo $cnsmp->getQuantity(); ?>"/></td>
            </tr><?php } ?>
        <tr><td></td>
            <td colspan="3">
                <input type="submit" name="btnAddLog" id="btnAddLog" value="Updaet Log"/>
                <input type="hidden" name="task" id="task" value="log_entry"/></td>
        </tr>
    </table>
</form>
<?php include_once FOOTER; ?>
