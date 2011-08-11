<?php
/**
 * View para exibir o formulário de edição do plugin jCake
 * 
 * @package		jcake
 * @subpackage	jcake.view
 */
?>
<?php if (!isset($edicaoCampos)) die('É preciso definir quais campos serão editados. Crie a variável <strong>$edicaoCampos</strong> no evento <strong>beforeRender</strong> do seu controlador <strong>'.$this->name.'</strong>.'); ?>
<?php $this->Visao->escreverTitBt = isset($escreverTitBt) ? $escreverTitBt : $this->Visao->escreverTitBt; ?>
<?php echo $this->Form->create($modelClass, array('url'=>str_replace($this->base,'',$this->here)))."\n"; ?>
<?php echo $this->Form->input($primaryKey)."\n"; ?>
<?php if (isset($onReadView)) foreach($onReadView as $_codigo) $this->Visao->setOnReadView($_codigo); ?>
<?php if (isset($focus)) $this->Visao->setOnReadView('$("#'.$this->Form->domId($focus).'").focus();'); ?>
<?php if (!isset($id)) $id = 0; ?>
<?php if (!isset($botoesEdicao)) $botoesEdicao = array(); ?>

<div id='editar'>

<div id='topo'>

<div id='botoes'>
	<?php echo $this->Visao->getBotoesEdicao($this->name,$botoesEdicao, $id); ?>

</div>

<?php
if (isset($camposPesquisa))
{
	$this->Visao->setOnReadView('$("#inPesquisa").keyup(function(e){ setPesquisa("'.Router::url('/',true).mb_strtolower($this->name).'/pesquisar/", (e.keyCode ? e.keyCode : e.which) ); });');
	echo $this->element('pesquisa',array('camposPesquisa'=>$camposPesquisa));
}
?>

</div>

<div id='msg'>
	<?php if (isset($msgEdicao)) echo $msgEdicao; ?>

</div>

<div id='msgDel'>
	<label>Você tem certeza de excluir este registro ?</label>
	<?php if (isset($id)) echo $this->Form->button('Sim',array('id'=>'delSim','type'=>'button', 'onclick'=>'document.location.href=\''.Router::url('/',true).mb_strtolower($this->name).'/delete/'.$id.'\'')); ?>
	<?php if (isset($id)) echo $this->Form->button('Nao',array('id'=>'delNao','type'=>'button', 'onclick'=>'$(\'#msgDel\').fadeOut(\'fast\', function() { $(\'#topo\').fadeIn(\'slow\'); });')); ?>
	<?php if (isset($excluir)) $this->Visao->setOnReadView('$(\'#topo\').fadeOut(\'fast\', function() { $(\'#msgDel\').fadeIn(\'slow\'); });'); ?>
</div>

<div id='errosForm'>
	<label>Por favor corrija os erros abaixo:</label><br />
	<?php if (isset($errosForm)) echo $this->Visao->getErrosForm($errosForm); ?>

</div>

<div id='campos'>
<?php if (isset($edicaoCampos)) echo $this->Visao->getCampos($edicaoCampos, $campos, $modelClass, $id); ?>
<?php echo $this->Form->end()."\n"; ?>

</div>

</div>
<?php //pr($this->data); ?>
