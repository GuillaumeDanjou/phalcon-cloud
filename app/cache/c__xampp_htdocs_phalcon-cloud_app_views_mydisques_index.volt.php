<?php foreach ($disques as $index => $disque) { ?>
   <h4><span class="glyphicon glyphicon-hdd"></span> <?php echo $disque->nom; ?> <span class="badge"><?php echo $occupationDisques[$index]; ?> <?php echo $uniteDisques[$index]; ?> / <?php echo $quotaDisques[$index]; ?> <?php echo $uniteDisques[$index]; ?></span></h4>
    <?php echo $progressBars[$index]; ?>
    <a href="./Scan/index/<?php echo $disque->id; ?>" class="btn btn-info btn-lg btn-block"><span class="glyphicon glyphicon-folder-open"></span> Ouvrir</a>
<?php } ?>