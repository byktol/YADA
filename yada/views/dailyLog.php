<?php include_once HEADER; ?>
<script type="text/javascript">
    $(function(){
        $('#daily_log').tablesorter();
    });
</script>
<div>Your required calories for the day: <?php echo $calories;?></div>
<table id="daily_log" class="datatable tablesorter" width="70%">
    <thead>
        <tr><th>S.N.</th><th>Date</th><th>Food</th><th>Calories Consumed</th><th>Actions</th></tr>
    </thead>
    <?php
    foreach ($arrLogs as $num => $log) {
        $arrCnsmpObj = $log->getConsumption();

        // lets find the total cals and all the foods
        $totalCal = 0;
        $foods = array();

        foreach ($arrCnsmpObj as $cnsmpObj) {
            $food = $cnsmpObj->getFood();
            $foods[] = $food->getName();
            $totalCal += $food->getNutritionFact('calories', TRUE);
        }
    ?>
        <tr><td><?php echo ($num + 1); ?></td><td><?php echo $log->getDate(); ?></td><td><?php echo implode(', ', $foods); ?></td><td><?php echo $totalCal; ?></td><td align="center"><a href="?user=today&for=<?php echo $log->getDate(); ?>" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
<?php } ?>

</table>
<?php include_once FOOTER; ?>
