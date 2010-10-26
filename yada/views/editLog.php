<?php
include_once HEADER;
$sessMgr = SessionManager::getInstance();

$arrConsumptions = $log->getConsumption();

$foods = SessionManager::getInstance()->getFoodData();
$foodList = '';
?>
<script type="text/javascript">
    $(function(){
        $('#log_date').datepicker({date_format:'yyyy-mm-dd'});
    });
</script>
<form action="<?php echo HOST . 'index.php?user=updatelog'; ?>" id="frmLogEntry" method="post">
    <table class="datatable" width="50%">
        <tr><th colspan="6">Please provide the foods for your entry below:</th></tr>
        <tr><td>S.N.</td><td>Date</td><td colspan="3"><input type="text" name="log_date" id="log_date" value="<?php echo $date; ?>"/></td><td>Delete</td></tr>
        <?php foreach ($arrConsumptions as $sn => $cnsmp) {
        ?>
            <tr><td><?php echo ($sn + 1); ?>.</td>
                <td>Food</td>
                <td>
                    <select name="foods[]" id="foods">
                    <?php
                    foreach ($foods->getFoods() as $food) {
                        //$selected = $cnsmp->getFood()->getId();
                        $selected = ($cnsmp->getFood()->getId() == $food->getId()) ? ' selected' : '';
                        echo '<option value="' . $food->getId() . '" ' . $selected . '>' . $food->getName() . '</option>';
                    } ?>

                </select>
            </td>
            <td>Servings</td><td><input type="text" name="qty[]" id="qty" size="10" value="<?php echo $cnsmp->getQuantity(); ?>"/></td>
            <td align="center"><a href="<?php echo $this->getDelURI($food->getId(), $date); ?>" class="icon-delete"></a></td>
        </tr><?php } ?>
        <tr><td></td>
            <td colspan="5" align="right">
                <input type="submit" name="btnAddLog" id="btnAddLog" value="Update Log"/>
                <input type="hidden" name="date" id="date" value="<?php echo $date; ?>"/>
                <input type="hidden" name="task" id="task" value="log_entry"/></td>
        </tr>
    </table>
</form>
<?php include_once FOOTER; ?>
