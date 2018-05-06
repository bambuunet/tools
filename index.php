<?php
header('Access-Control-Allow-Origin: *');
$tool = 'index';
if(isset($_GET['tool'])) $tool = $_GET['tool'];
$res = '/md/'.$tool.'.md';
?>

<?php include(dirname(__FILE__).'/header.php'); ?>

<script>
  Olelo('<?php echo $res."?t=".time(); ?>', 'article');
</script>

<?php include(dirname(__FILE__).'/footer.php'); ?>
