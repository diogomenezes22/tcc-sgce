<?php
/**
 * View para exibir o formulário de lista do plugin jCake
 * 
 * @package		jcake
 * @subpackage	jcake.view
 */
?>
<?php if (!isset($listaCampos)) die('É preciso definir os campos da lista. Crie a varíavel <strong>$listaCampos</strong> no evento <strong>beforeRender</strong> do seu controlador <strong>'.$this->name.'</strong>.'); ?>
<?php $this->Visao->escreverTitBt = isset($escreverTitBt) ? $escreverTitBt : $this->Visao->escreverTitBt; ?>
<?php $this->Html->css('/jcake/css/jcake_listar.css', null, array('inline' => false)); ?>
<?php if (isset($onReadView)) foreach($onReadView as $_codigo) $this->Visao->setOnReadView($_codigo); ?>
<?php
	if (!isset($listaFerramentas['editar']))
	{
		$listaFerramentas['editar']['title'] 	= 'clique aqui para editar';
		$listaFerramentas['editar']['icone'] 	= 'bt_editar.png';
		$listaFerramentas['editar']['link']		= Router::url('/',true).mb_strtolower($this->name).'/editar/{id}';
	}
	if (!isset($listaFerramentas['excluir']))
	{
		$listaFerramentas['excluir']['title'] 	= 'clique aqui para excluir';
		$listaFerramentas['excluir']['icone'] 	= 'bt_excluir.png';
		$listaFerramentas['excluir']['link']	= Router::url('/',true).mb_strtolower($this->name).'/excluir/{id}';
	}
	if (!isset($listaFerramentas['imprimir']))
	{
		$listaFerramentas['imprimir']['title'] 	= 'clique aqui para imprimir';
		$listaFerramentas['imprimir']['icone'] 	= 'bt_imprimir.png';
		$listaFerramentas['imprimir']['link']	= Router::url('/',true).mb_strtolower($this->name).'/imprimir/{id}';
	}
?>

<div id='listar' class='lista'>
<div id='topo'>
<div id='botoes'>
	<?php echo $this->Visao->getBotoesEdicao($this->name, $botoesEdicao);?>

</div>

<div id='paginas'>
	<?php echo $this->Visao->getPaginas($modelClass); ?>

</div>

<div id='irPag'>
	<?php echo $this->Visao->getPagIr($modelClass); ?>

</div>

<?php
if (isset($camposPesquisa))
{
	$this->Visao->setOnReadView('$("#inPesquisa").keyup(function(e){ setPesquisa("'.Router::url('/',true).mb_strtolower($this->name).'/pesquisar/", (e.keyCode ? e.keyCode : e.which) ); });');
	echo $this->element('pesquisa',array('camposPesquisa'=>$camposPesquisa));
}
?>

</div>

<table cellspacing='0px' padding='0px' border='0px'>

<?php
	// atualizando campos, com base nos campos padrão do helper visão
	foreach($this->Visao->campos as $_campo => $_arrProp)
	{
		foreach($_arrProp as $_prop => $_arrValor)
		{
			// se não criou uma propriedade que o helper visão já tem, recebe esta propriedade do helper.
			if (!isset($campos[$modelClass][$_campo][$_prop])) $campos[$modelClass][$_campo][$_prop] = $_arrValor;
			
			// verificando se o campo realmente possui índice, se não possui, não deixa criar linkTh.
			if (isset($schema[$_campo]))
			{
				if (!isset($schema[$_campo]['key'])) $campos[$modelClass][$_campo]['thOff'] = true;
			}
		}
	}

	// escrevendo linha a linha da lista
	foreach($this->data as $_linha => $_arrModel)
	{
		$id = $_arrModel[$modelClass][$primaryKey];
		// escrevendo o cabeçalho da lista
		if ($_linha==0)
		{
			foreach($listaCampos as $_campo)
			{
				$arrCmp = explode('.',$_campo);
				$titulo = isset($campos[$arrCmp[0]][$arrCmp[1]]['input']['label']['text']) ? $campos[$arrCmp[0]][$arrCmp[1]]['input']['label']['text'] : $_campo;
				echo '<th';
				if (isset($campos[$arrCmp[0]][$arrCmp[1]]['th'])) foreach($campos[$arrCmp[0]][$arrCmp[1]]['th'] as $_tag => $_val) echo " $_tag='$_val'";
				echo '>';
				if (!isset($campos[$arrCmp[0]][$arrCmp[1]]['thOff']))	echo $this->Paginator->sort($titulo,$_campo); else echo $titulo;
				echo '</th>'."\n";
			}
			echo '<th colspan="'.count($listaFerramentas).'"></th>';
		}

		// escrevendo linha a linha
		echo '<tr id="tr'.$id.'"';
		if (isset($_arrModel['tr'])) foreach($_arrModel['tr'] as $_tag => $_val) echo " $_tag='$_val'";
		if (!isset($_arrModel['tr']['class'])) echo 'class="linhaFora" ';
		echo ' onmouseover="javascript:this.className=\'linhaDentro\'"';
		echo ' onmouseout="javascript:this.className=\'linhaFora\'"';
		echo ' onclick="javascript:document.location.href=\''.Router::url('/',true).mb_strtolower($this->name).'/editar/'.$_arrModel[$modelClass]['id'].'\'"';
		echo '>'."\n";
		
		// escrevendo campo a campo
		foreach($listaCampos as $_campo)
		{
			$arrCmp = explode('.',$_campo);
			$mascara= isset($campos[$arrCmp[0]][$arrCmp[1]]['mascara']) ? isset($campos[$arrCmp[0]][$arrCmp[1]]['mascara']) : '';
			$valor = $this->Visao->getMascara($_arrModel[$arrCmp[0]][$arrCmp[1]],$mascara);
			echo '<td';
			if (isset($campos[$arrCmp[0]][$arrCmp[1]]['td'])) foreach($campos[$arrCmp[0]][$arrCmp[1]]['td'] as $_tag => $_val) echo " $_tag='$_val'";
			echo '>';
			echo $valor.'</td>'."\n";
		}
		
		// escrevendo ferramenta a ferramenta
		foreach($listaFerramentas as $_fer => $_arrProp)
		{
			if (is_array($_arrProp))
			{
				$_arrProp['icone'] 	= isset($_arrProp['icone']) ? $_arrProp['icone'] 	: 'bt_desconhecido.png';
				$_arrProp['link']	= isset($_arrProp['link']) 	? $_arrProp['link'] 	: '#';
				if (strpos($_arrProp['link'],'{id}')) $_arrProp['link'] = str_replace('{id}',$id,$_arrProp['link']);
				echo '<td align="center" class="tdFer" title="Clique aqui para executar a ferramenta">';
				echo $this->Html->link($html->image('/jcake/img/'.$_arrProp['icone'],array('border'=>'none')),$_arrProp['link'],array('escape'=>false));
				echo '</td>'."\n";
			}
		}
		echo '</tr>'."\n";
	}
?>
</table>
</div>
<?php //pr($this->data); ?>
