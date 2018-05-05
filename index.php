<?php
header('Access-Control-Allow-Origin: *');
$res = '/md/'.$_GET['tool'].'.md';
?>

<?php include(dirname(__FILE__).'/header.php'); ?>

<script>
  new Olelo('<?php echo $res."?t=".time(); ?>', 'article');
</script>

<?php include(dirname(__FILE__).'/footer.php'); ?>
