<?php
/**
 * Helper para auxiliar na renderização das visões do plugin jCake
 * 
 * @package       	jcake
 * @subpackage		jcake.view.helper
 */

/**
 * @package       	jcake
 * @subpackage		jcake.view.helper
 */
class VisaoHelper extends Helper {
	/**
	 * Ajudantes
	 * 
	 * @var		array
	 * @access	public
	 */
	public $helpers 		= array('Form','Html','Time','Session','Paginator');

	/**
	 * Conteúdo jquery no header
	 * 
	 * @var		array
	 * @access	public
	 */
	public $onReadView 		= array();

	/**
	 * Campos para o formulário
	 * 
	 * @var		array
	 * @access	public
	 */
	public $campos			= array();

	/**
	 * Ferramentas para a lista
	 * 
	 * @var		array
	 * @access	public
	 */
	public $listaFerramentas	= array();

	/**
	 * Escrever título dos botões ?
	 * 
	 * @var		string	
	 * @access	public
	 */
	public $escreverTitBt		= true;

	/**
	 * 
	 */
	public function __construct()
	{
		// campos genéricos
		$this->campos['created']['mascara'] 					= 'datahora';
		$this->campos['created']['input']['label']['text'] 		= 'Criado';
		$this->campos['created']['input']['dateFormat'] 		= 'DMY';
		$this->campos['created']['input']['timeFormat'] 		= '24';
		$this->campos['created']['input']['monthNames'] 		= false;
		$this->campos['created']['input']['disabled'] 			= 'disabled';
		$this->campos['created']['th']['width']					= '134px;';
		$this->campos['created']['td']['align']					= 'center';

		$this->campos['modified']['mascara'] 					= 'datahora';
		$this->campos['modified']['input']['label']['text'] 	= 'Modificado';
		$this->campos['modified']['input']['dateFormat'] 		= 'DMY';
		$this->campos['modified']['input']['timeFormat'] 		= '24';
		$this->campos['modified']['input']['monthNames'] 		= false;
		$this->campos['modified']['input']['disabled'] 			= 'disabled';
		$this->campos['modified']['th']['width']				= '134px;';
		$this->campos['modified']['td']['align']				= 'center';
	}

	/**
	 * Código a ser executado antes da renderização da view
	 * 
	 * @return void
	 */
	public function beforeRender()
	{
		$this->setHeaderCssJs($this->Html->params['url']['url']);
	}

	/**
	 * Implementa o cabeçalho header com base na string passada como parâmetro
	 * 
	 * @param	string	$texto		string parâmetro
	 * @param	string	$separador	Caracter delimitador para quebrar o array
	 * @return	void
	 */
	public function setHeaderCssJs($texto=null,$separador='/')
	{
		if ($this->action=='editar' || $this->action=='novo')
		{
			$this->Html->css('/jcake/css/jcake_editar.css', null, array('inline' => false));
		}
		if ($this->action=='listar')
		{
			$this->Html->css('/jcake/css/jcake_listar.css', null, array('inline' => false));
		}

		if (!empty($texto))
		{
			$arrTexto = explode($separador,$texto);
			foreach($arrTexto as $_item => $_nome)
			{
				if (file_exists(WWW_ROOT.'css/'.$_nome.'.css')) $this->Html->css($_nome.'.css', null, array('inline' => false));
				if (file_exists(WWW_ROOT.'js/'.$_nome.'.js'))	$this->Html->script($_nome.'.js', array('inline' => false));
			}
		}
	}

	/**
	 * Retorna o campo input para localização da página
	 * 
	 * @param	string	$modelClass	Nome do modelo do cadastro
	 * @return	string	$pag		Texto formatado em xhtml
	 */
	public function getPagIr($modelClass)
	{
		$pag  = "<input type='text' value='".$this->params['paging'][$modelClass]['page']."' name='edIrPag' id='edIrPag' /> ";
		$pag .= "<span class='totalPag'> / ".$this->params['paging'][$modelClass]['pageCount']."</span> ";
		$pag .= "<input type='button' value='Ir' name='btIrPag' id='btIrPag' />";
		if (strpos($this->here,'page:'))
		{
			$arrLink = explode('page:',$this->here);
			$arrLink[1] = substr($arrLink[1],strpos($arrLink[1],'/'),strlen($arrLink[1]));
		} else
		{
			$arrLink[0] = $this->here.'/';
			$arrLink[1] = '';
		}
		if (is_numeric(substr($arrLink[1],0,1))) $arrLink[1] = '';

		$this->setOnReadView('$("#btIrPag").click(function() { document.location.href="'.$arrLink[0].'page:"+$("#edIrPag").val()+"'.$arrLink[1].'" }); ');
		$this->setOnReadView('$("#btIrPag").click(function() { document.location.href="'.$arrLink[0].'page:"+$("#edIrPag").val()+"'.$arrLink[1].'" }); ');
		$this->setOnReadView('$("#edIrPag").keyup(function(e) { if(e.keyCode==13) document.location.href="'.$arrLink[0].'page:"+$("#edIrPag").val()+"'.$arrLink[1].'" }); ');
		$this->setOnReadView('$("#edIrPag").select();');
		return $pag;
	}

	/**
	 * Retorna todos os botões para o formulário
	 * 
	 * @param	array	$botoesEdicao
	 * @return	string	$botoes
	 */
	public function getBotoesEdicao($controlador='', $botoesEdicao=array(), $id=null)
	{
		$botoes = '';
		$arrBt	= array();
		$_botoesEdicao = array();
		if (in_array($this->action,array('editar','excluir')))
		{
			if (!isset($botoesEdicao['novo']))
			{
				$_botoesEdicao['novo']['type'] 		= 'button';
				$_botoesEdicao['novo']['value']		= 'Novo';
				$_botoesEdicao['novo']['onclick']	= 'javascript:document.location.href=\''.Router::url('/',true).mb_strtolower($controlador).'/novo\'';
			}
			if (!isset($botoesEdicao['salvar']))
			{
				$_botoesEdicao['salvar']['type'] 	= 'submit';
				$_botoesEdicao['salvar']['value']	= 'Salvar';
				$_botoesEdicao['salvar']['title'] 	= 'clique aqui para salvar';
			}
			if (!isset($botoesEdicao['excluir']))
			{
				$_botoesEdicao['excluir']['type'] 	= 'button';
				$_botoesEdicao['excluir']['value']	= 'Excluir';
				$_botoesEdicao['excluir']['title'] 	= 'clique aqui para excluir';
				$_botoesEdicao['excluir']['onclick']= '$(\'#topo\').fadeOut(\'fast\', function() { $(\'#msgDel\').fadeIn(\'slow\'); });';
			}
			if (!isset($botoesEdicao['atualizar']))
			{
				$_botoesEdicao['atualizar']['type'] 	= 'button';
				$_botoesEdicao['atualizar']['value']	= 'Atualizar';
				$_botoesEdicao['atualizar']['title'] 	= 'clique aqui para atualizar os dados';
				$_botoesEdicao['atualizar']['onclick']	= 'javascript:document.location.href=\''.$this->here.'\'';
			}
			if (!isset($botoesEdicao['imprimir']))
			{
				$_botoesEdicao['imprimir']['type'] 	= 'button';
				$_botoesEdicao['imprimir']['value']	= 'Imprimir';
				$_botoesEdicao['imprimir']['title'] = 'clique aqui para imprimir este registro';
				$_botoesEdicao['imprimir']['onclick']= 'javascript:document.location.href=\''.Router::url('/',true).mb_strtolower($controlador).'/imprimir/'.$id.'\'';
			}
			if (!isset($botoesEdicao['listar']))
			{
				$_botoesEdicao['listar']['type'] 	= 'button';
				$_botoesEdicao['listar']['value']	= 'Listar';
				$_botoesEdicao['listar']['title'] 	= 'clique aqui para listar em tabela';
				$_botoesEdicao['listar']['onclick']	= 'javascript:document.location.href=\''.Router::url('/',true).mb_strtolower($controlador).'/listar';
				if ($this->Session->check($controlador.'.params'))
				{
					foreach($this->Session->read($controlador.'.params') as $_c => $_v)
					{
						$_botoesEdicao['listar']['onclick'] .= '/'.$_c.':'.$_v;
					}
				}
				$_botoesEdicao['listar']['onclick'] .= '\'';
			}
			if ($this->action=='excluir')
			{
				unset($_botoesEdicao['novo']);
				unset($_botoesEdicao['salvar']);
			}
		}

		if (in_array($this->action,array('novo')))
		{
			$_botoesEdicao['salvar']['type'] 	= 'submit';
			$_botoesEdicao['salvar']['title'] 	= 'clique aqui para salvar';
			$_botoesEdicao['salvar']['value']	= 'Salvar';
			$_botoesEdicao['listar']['type'] 	= 'button';
			$_botoesEdicao['listar']['value']	= 'Listar';
			$_botoesEdicao['listar']['onclick']	= 'javascript:document.location.href=\''.Router::url('/',true).mb_strtolower($controlador).'/listar';
			if ($this->Session->check($controlador.'.params'))
			{
				foreach($this->Session->read($controlador.'.params') as $_c => $_v)
				{
					$_botoesEdicao['listar']['onclick'] .= '/'.$_c.':'.$_v;
				}
			}
			$_botoesEdicao['listar']['onclick'] .= '\'';
		}

		if (in_array($this->action,array('listar')))
		{
			$_botoesEdicao['novo']['type'] 		= 'button';
			$_botoesEdicao['novo']['value']		= 'Novo';
			$_botoesEdicao['novo']['title']		= 'Clique aqui para incluir o novo registro';
			$_botoesEdicao['novo']['onclick']	= 'javascript:document.location.href=\''.Router::url('/',true).mb_strtolower($controlador).'/novo\'';
		}

		// concatenando os botões
		$arrBt = array_merge($_botoesEdicao,$botoesEdicao);

		foreach($arrBt as $_botao => $_prop)
		{
			// trocando id pelo valor do did
			if (is_array($_prop))
			{
				foreach($_prop as $_p => $_v)  if(strpos($_v,'{id}')) $_prop[$_p] = str_replace('{id}',$id,$_v);

				// valores padrão para cada botão
				if (!isset($_prop['value'])) 	$_prop['value'] = $_botao;
				if (!isset($_prop['class'])) 	$_prop['class'] = 'btEdicao';
				if (!isset($_prop['id']))		$_prop['id']	= 'bt'.ucfirst(strtolower($_prop['value']));
				
				// escrever ou não o valor do botão ?
				$valor 			= ($this->escreverTitBt) ? $_prop['value'] : null;
				$_prop['class'] = ($this->escreverTitBt) ? $_prop['class'] : 'btEdicaoP';
				
				$botoes .= $this->Form->button($valor,$_prop);
			}
		}

		return $botoes;
	}

	/**
	 * Retorna uma string com todos os erros do formulário
	 * 
	 * @param	string	$errosForm	Erros do formulário
	 * @return	string	$erros	
	 */
	public function getErrosForm($errosForm='')
	{
		$erros = '';
		foreach($errosForm as $_valor) $erros .= '- '.$_valor."<br />\n";
		$this->setOnReadView('$("#errosForm").fadeIn();');
		return $erros;
	}

	/**
	 * Retorna todos os campos para edição do formulário
	 * 
	 * @param	array	$edicaoCampos	Matriz contendo os campos a serem editados
	 * @param	array	$campos			Matriz com todos os campos e suas propriedades
	 * @param	integer	$id				Id do registro a ser editado
	 * @param	boolean	$leitura		Define se o campo será retornado, somente, para leitura
	 * @return	string	$htmlCampos		input para cada campo
	 */
	public function getCampos($edicaoCampos=array(), $campos=array(), $modelClass='', $id=0, $leitura=false)
	{
		$htmlCampos = '';
		foreach($this->campos as $_campo => $_arrProp)
		{
			if (!isset($campos[$modelClass][$_campo])) $campos[$modelClass][$_campo] = $_arrProp;
		}

		$lHr = 0;
		foreach($edicaoCampos as $_campo)
		{
			if ($_campo!='#' && $_campo!='@')
			{
				$arrCmp = explode('.',$_campo);
				if (!isset($arrCmp[1])) $arrCmp[1] = mb_strtolower($arrCmp[0]);
				$input 		= isset($campos[$arrCmp[0]][$arrCmp[1]]['input']) 	? $campos[$arrCmp[0]][$arrCmp[1]]['input'] : array();
				$mascara 	= isset($campos[$arrCmp[0]][$arrCmp[1]]['mascara']) ? $campos[$arrCmp[0]][$arrCmp[1]]['mascara'] : '';

				// configurando a máscara normal ou dinheiro
				if (!isset($input['disabled']))
				{
					if ($mascara=='dinheiro')
					{
						$this->setOnReadView('$("#'.$this->Form->domId($_campo).'").priceFormat({prefix:"R$ ",centsSeparator:",",thousandsSeparator:"."});');
					} elseif($mascara)
					{
						$this->setOnReadView('$("#'.$this->Form->domId($_campo).'").mask("'.$mascara.'");');
					}
				}

				// configurando alguns propriedades genéricas do input
				if (!isset($input['label']['text'])) 	$input['label']['text'] 	= $arrCmp[1];
				if (!isset($input['div']['class'])) 	$input['div']['class']		= 'edicaoCampo';
				if (!isset($input['div']['id']))		$input['div']['id']			= 'ed_'.$arrCmp[0].'_'.$arrCmp[1];
				if (!isset($input['label']['class']))	$input['label']['class']	= 'labelCampo';
				if (empty($input['label']['class'])) 	unset($input['label']['class']);
				if (empty($input['div']['class'])) 		unset($input['div']['class']);
				if (empty($input['div']['id'])) 		unset($input['div']['id']);

				// escrevendo o input
				if (!$leitura && !isset($input['disabled']))
				{
					$htmlCampos .= $this->Form->input($_campo,$input)."\n";
				} else
				{
					if ( isset($this->Form->data[$arrCmp[0]] ) )
					{
						$valor		= '';
						$opcoes		= isset($campos[$arrCmp[0]][$arrCmp[1]]['input']['options']) ? $campos[$arrCmp[0]][$arrCmp[1]]['input']['options'] : array();
						if (isset($this->Form->data[$arrCmp[0]][$arrCmp[1]]))
						{
							$valor = $this->getMascara($this->Form->data[$arrCmp[0]][$arrCmp[1]],$mascara,$opcoes);
						} else
						{
							if (isset($this->Form->data[$arrCmp[0]][0]))
							{
								foreach($this->Form->data[$arrCmp[0]] as $_linha => $_arrRelCmp)
								{
									$valor .= $this->getMascara($_arrRelCmp[$arrCmp[1]],$mascara,$opcoes).', ';
								}
								$valor = substr($valor,0,strlen($valor)-2);
							}
							if (isset($campos[$arrCmp[0]][mb_strtolower($arrCmp[0])]['input']['label']['text']))
							{
								$input['label']['text'] = $campos[$arrCmp[0]][mb_strtolower($arrCmp[0])]['input']['label']['text'];
							}
						}
						$htmlCampos .= '<div  class="in_leitura" id="le'.$arrCmp[1].'">';
						$htmlCampos .= '<span class="ti_leitura" id="le'.$arrCmp[1].'"';
						foreach($input['label'] as $_tag => $_valor) $htmlCampos .= " $_tag='$_valor'";
						$htmlCampos .= '>';
						$htmlCampos .= $input['label']['text'].': </span>';
						$htmlCampos .= $valor;
						$htmlCampos .= '</div>'."\n";
					}
				}
			} elseif($_campo=='#')
			{
				$htmlCampos .= '<br />'."\n";
			} elseif($_campo=='@')
			{
				$htmlCampos .= '<br /><hr id="hr'.$lHr.'" class="linhaHr">'."\n";
				$lHr++;
			}
		}
		$htmlCampos .= '<br />'."\n";
		return $htmlCampos;
	}

	/**
	 * Implementa o código jquery
	 * 
	 * @parameter	string	$codigo Código jquery
	 * @return 		void
	 */
	public function setOnReadView($codigo='')
	{
		array_push($this->onReadView,$codigo);
	}

	/**
	 * Retorno o o código para jquery
	 * 
	 * @return 		string 	$texto
	 */
	public function getOnReadView()
	{
		$texto 		= '';
		$codigos	= $this->onReadView;
		$l = 0;
		foreach($codigos as $_item => $_codigo)
		{
			$texto .= $_codigo."\n";
			$l++;
			if ($l>0 && $l<count($codigos)) $texto .= "\t\t";
		}
		if (empty($codigos)) $texto .= "\r";
		return $texto;
	}

	/**
	 * Retorno o valor do campo mascarado
	 * 
	 * @parameter	string		$valor		Valor do campo
	 * @param		string		$mascara	Máscara a ser aplicada no valor
	 * @param		array		$opcoes		Opções para exibição, exemplo: 1=>Sim, 0=>Não
	 * @return		string		$mascarado	Campo mascarado
	 */
	public function getMascara($valor='', $mascara='', $opcoes=array())
	{
		$mascarado = $valor;
		switch($mascara)
		{
			case 'datahora':
				$mascarado = $this->Time->format('d/m/Y H:i:s',strtotime($valor));
				if ($valor=='0000-00-00 00:00:00') $mascarado = '';
				break;
			case 'data':
				$mascarado = $this->Time->format('d/m/Y',strtotime($valor));
				if ($valor=='0000-00-00') $mascarado = '';
				break;
			case 'hora':
				$mascarado = $this->Time->format('H:i:s',strtotime($valor));
				if ($valor=='00:00:00') $mascarado = '';
				break;
			case 'cpf':
				$mascarado = substr($valor,0,3).'.'.substr($valor,3,3).'.'.substr($valor,6,3).'-'.substr($valor,9,2);
				break;
			case 'aniversario':
			case '99/99':
				$mascarado = substr($valor,0,2).'/'.substr($valor,2,2);
				break;
			case 'cep':
			case '99.999-999':
				$mascarado = substr($valor,0,2).'.'.substr($valor,2,3).'-'.substr($valor,5,3);
				break;
			case 'telefone':
			case '99 9999-9999':
				$mascarado = substr($valor,0,2).' '.substr($valor,2,4).'-'.substr($valor,6,4);
				break;
		}
		if (count($opcoes)>0)
		{
			foreach($opcoes as $_val1 => $_val2)
			{
				if ($valor==$_val1) $mascarado = $_val2;
			}
		}
		return $mascarado;
	}

	/**
	 * Retorna a paginação
	 * 
	 * @param	string	$modelClass 	Nome do modelo
	 * @return	string	$paginas
	 */
	public function getPaginas($modelClass='')
	{
		$paginas = '';
		if ($this->params['paging'][$modelClass]['page']>1)		$paginas .= $this->Paginator->first('<<'); 	else $paginas .= '<span>&nbsp;</span>';
		if ($this->params['paging'][$modelClass]['page']>1)		$paginas .= $this->Paginator->prev('<');	else $paginas .= '<span>&nbsp;</span>';
		if ($this->params['paging'][$modelClass]['page']<$this->params['paging'][$modelClass]['pageCount']) $paginas .= $this->Paginator->next('>'); else 	$paginas .= '<span>&nbsp;</span>';
		if ($this->params['paging'][$modelClass]['page']<$this->params['paging'][$modelClass]['pageCount']) $paginas .= $this->Paginator->last('>>'); else 	$paginas .= '<span>&nbsp;</span>';
		return $paginas;
	}
}
?>
