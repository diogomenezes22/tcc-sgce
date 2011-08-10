<?php
/**
 * Layout de administração do plugin jCake
 * 
 * @package		jcake
 * @subpackage	jcake.view.layouts
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>

	<title><?php if(isset($titulo)) echo $titulo; else echo $this->name.' - '.$this->action; ?></title>

	<?php echo $this->Html->meta('icon'); ?>

	<?php echo $this->Html->css('/jcake/css/jcake_layout.css'); ?>
	<?php if (file_exists(WWW_ROOT.'css/'.mb_strtolower($this->name).'.css')) echo $this->Html->css(mb_strtolower($this->name).'.css'); ?>

	<?php echo $this->Html->script('/jcake/js/jquery-1.5.1.min')."\n"; ?>
	<?php echo $this->Html->script('/jcake/js/jquery.maskedinput-1.1.4.pack')."\n"; ?>

	<?php echo $this->Html->script('/jcake/js/jcake')."\n"; ?>

	<script type="text/javascript">
	var url = "<?php echo Router::url('/',true); ?>";
	$(document).ready (function()
	{
		setTimeout(function(){ $("#flashMessage").fadeOut(4000); },3000);
		$("#ferramentas img").hover(function() { $(this).css("background-color","#5277AA") }).mouseout(function() { $(this).css("background-color","transparent") }) ;
		<?php echo $this->Visao->getOnReadView(); ?>
	});
	</script>

	<?php echo $scripts_for_layout;	?>

</head>
<body>
<div id="corpo">

	<div id="cabecalho">
		<?php echo $this->Session->flash(); ?>

		<div id='sigla'>
			<a href='<?php echo Router::url('/',true); ?>'><?php echo (strlen($this->base)>0) ? str_replace('/','',$this->base) : 'Principal'; ?></a>

			<?php if (isset($this->name)) : ?> :: <a href="<?php echo mb_strtolower(Router::url('/',true).$this->name); ?>" ><?php echo ucfirst($this->name); ?></a><?php endif ?>

			<?php if (isset($this->action)) : ?> :: <a href="<?php echo mb_strtolower(Router::url('/',true).$this->name.'/'.$this->action); ?>" ><?php echo ucfirst($this->action); ?></a><?php endif ?>

		</div>

		<div id='ferramentas'>
			<a href='<?php echo Router::url('/',true).'ferramentas'; ?>' title='Clique aqui para acessar ferramentas'><img id='ferFer' src='<?php echo Router::url('/',true).'img/bt_ferramentas.png'; ?>' border='0' /></a>
			<a href='<?php echo Router::url('/',true).'relatorios'; ?>'  title='Clique aqui para acessar relatórios'> <img id='ferRel' src='<?php echo Router::url('/',true).'img/bt_relatorios.png'; ?>'  border='0' /></a>
		</div>

		<div id='menu'>
			<?php echo $this->Html->link('Usuários',array('plugin'=>null,'controller'=>'usuarios','action'=>'listar')); ?>&nbsp;&nbsp;:&nbsp;&nbsp;
		
		</div>

		<div id='logocake'>
			<a href='http://www.cakephp.org' target='-blanck'><img src="<?php echo Router::url('/',true); ?>/jcake/img/cake.power.gif" border="none" alt="" /></a>
			<a href='http://www.jquery.com' target='-blanck'><img src="<?php  echo Router::url('/',true); ?>/jcake/img/jquery.power.gif" border="none" alt="" /></a>
		</div>

	</div>

	<div id="conteudo">
		<?php echo $content_for_layout; ?>

	</div>

</div>

<div id='sqlDump'>
<?php echo $this->element('sql_dump'); ?>
</div>

</body>
</html>
