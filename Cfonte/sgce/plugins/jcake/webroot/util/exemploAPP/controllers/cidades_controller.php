<?php
/**
 * Controller para o cadastro de cidades
 * 
 * @package		exemploApp
 * @subpackage	exemploApp.controller
 */
/**
 * @package		exemploApp
 * @subpackage	exemploApp.controller
 */
class CidadesController extends AppController {
	/**
	 * Nome do controller
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 		= 'Cidades';

	/**
	 * Model do controller
	 * 
	 * @var		array
	 * @access	public
	 */
	public $uses		= array('Cidade');

	/**
	 * Componentes
	 * 
	 * @var		array
	 * @access	public
	 */
	public $components	= array('Jcake.Controlador');

	/**
	 * Ajudantes
	 * 
	 * @var		array
	 * @access	public
	 */
	public $helpers		= array('Jcake.Visao');

	/**
	 * 
	 */
	public function beforeFilter()
	{
		if (isset($this->data))
		{
			$this->data['Cidade']['nome'] = mb_strtoupper($this->data['Cidade']['nome']);
		}
	}

	/**
	 * Executa código antes da renderização da view
	 * 
	 * @return	void
	 */
	public function beforeRender()
	{
		$campos							= array();
		$onReadView 					= array();
		$listaCampos 					= array('Cidade.nome','Estado.uf','Cidade.modified','Cidade.created');
		$edicaoCampos					= array('Cidade.nome','#','Estado.uf','@','Cidade.modified','#','Cidade.created');
		$listaFerramentas				= array();
		$botoesEdicao					= array();

		$listaFerramentas['excluir']	= '';
		$botoesEdicao['novo']	 		= '';
		$botoesEdicao['salvar']	 		= '';
		$botoesEdicao['excluir'] 		= '';

		$camposPesquisa['Cidade.nome'] 	= 'Nome';
		$escreverTitBt 					= false;

		$campos['Cidade']['nome']['input']['label']['text'] 	= 'Nome';
		$campos['Cidade']['nome']['input']['size']				= '60';
		$campos['Cidade']['nome']['th']['width']				= '400px';

		$campos['Cidade']['estado_id']['input']['label']['text']= 'Estado';
		$campos['Cidade']['estado_id']['input']['style']		= 'width: 60px;';
		

		$campos['Estado']['uf']['input']['label']['text'] 		= 'Uf';
		$campos['Estado']['uf']['input']['disabled']			= 'disabled';
		$campos['Estado']['uf']['th']['width']					= '99px';
		$campos['Estado']['uf']['td']['align']					= 'center';
		//$campos['Estado']['uf']['thOff']						= true;

		if ($this->action=='imprimir')
		{
			$edicaoCampos					= array('Cidade.nome','#','Estado.uf','@','Cidade.modified','Cidade.created');
		}

		if ($this->action=='listar')
		{
			foreach($this->data as $_linha => $_arrModel)
			{
				$id = $_arrModel['Cidade']['id'];
				if ($id==2302) array_unshift($onReadView,'$("#tr'.$id.'").css("background-color","#88E288")');
				if ($_arrModel['Cidade']['estado_id']==1) array_unshift($onReadView,'$("#tr'.$id.'").css("background-color","#F2BCBC")');
			}
		}

		if ($this->action=='editar' || $this->action=='novo')
		{
			array_unshift($onReadView,'$("#CidadeNome").focus();');
		}

		$this->set(compact('listaCampos','edicaoCampos','campos','camposPesquisa','escreverTitBt','onReadView','listaFerramentas','botoesEdicao'));
	}
}
?>
