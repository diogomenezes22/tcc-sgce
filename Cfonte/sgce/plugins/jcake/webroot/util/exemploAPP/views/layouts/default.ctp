<?php
/**
 * Layout para a página principal
 *
 * @package		exemploApp
 * @subpackage	exemploApp.view
 */
/**
 * @package		exemploApp
 * @subpackage	exemploApp.view
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout; ?></title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('meucake');

		echo $scripts_for_layout;
	?>
</head>
<body>
<div id="corpo">
	<div id="cabecalho">
		<div id='sigla'>
			<a href='<?php echo Router::url('/',true); ?>'><?php echo (strlen($this->base)>0) ? str_replace('/','',$this->base) : 'Principal'; ?></a>
		</div>

		<div id="logocake">
			<a href='http://www.cakephp.org' target='-blanck'><img src="/meucake/jcake/img/cake.power.gif" border="none" alt="" /></a>
			<a href='http://www.jquery.com' target='-blanck'><img src="/meucake/jcake/img/jquery.power.gif" border="none" alt="" /></a>
		</div>

		<div id='menu'>
			<?php echo $this->Html->link('Cidades',array('controller'=>'cidades')); ?>&nbsp;&nbsp;:&nbsp;&nbsp;
			<?php echo $this->Html->link('Clientes',array('controller'=>'clientes')); ?>&nbsp;&nbsp;:&nbsp;&nbsp;
			<?php echo $this->Html->link('Estados',array('controller'=>'estados')); ?>&nbsp;&nbsp;:&nbsp;&nbsp;
			<?php echo $this->Html->link('Grupos',array('controller'=>'grupos')); ?>
		</div>

	</div>

	<div id="conteudo">
		<?php echo $content_for_layout; ?>
	</div>

</div>
<?php echo $this->element('sql_dump'); ?>

</body>
</html>
