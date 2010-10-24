<?php include_once('includes/header.php'); ?>
<script type="text/javascript">
    $(function(){
        $('#daily_log').tablesorter();
    });
</script>
<table id="daily_log" class="datatable tablesorter" width="70%">
    <thead>
        <tr><th>S.N.</th><th>Date</th><th>Food</th><th>Calories Consumed</th><th>Actions</th></tr>
    </thead>
    <tr><td>1.</td><td>2010-10-01</td><td>Cheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
    <tr><td>2.</td><td>2010-10-02</td><td>Dheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
    <tr><td>3.</td><td>2010-10-03</td><td>Eheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
    <tr><td>4.</td><td>2010-10-04</td><td>Pheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
    <tr><td>5.</td><td>2010-10-05</td><td>Hheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
    <tr><td>6.</td><td>2010-10-06</td><td>Zheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
    <tr><td>7.</td><td>2010-10-07</td><td>Rheese</td><td>220</td><td align="center"><a href="#" class="icon-edit"></a><a href="#" class="icon-delete"></a></td></tr>
</table>
<?php include_once('includes/footer.php'); ?>
