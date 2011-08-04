<?php
/**
 * Controller para os logs
 * 
 * @package		sgce
 * @subpackage	sgce.controller
 */
/**
 * @package		sgce
 * @subpackage	sgce.controller
 */
class LogsController extends AppController {
	/**
	 * Nome do controller
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 		= 'Logs';

	/**
	 * Model do controller
	 * 
	 * @var		array
	 * @access	public
	 */
	public $uses		= array('Logs');

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
	 * Antes de tudo
	 */
	public function beforeFilter()
	{
	/**
	 * Executa código antes da renderização da view
	 * 
	 * @return	void
	 */
	}
	public function beforeRender()
	{
		$campos							= array();
		$onReadView 					= array();
		$listaCampos 					= array('Logs.data','Usuario.nome','Logs.descricao');
		$edicaoCampos					= array('Logs.data','#','Usuario.nome','#','Logs.descricao');
		$listaFerramentas				= array();
		$botoesEdicao					= array();

		$camposPesquisa['Usuario.nome'] 	= 'Nome';
		$escreverTitBt 					= false; //Desativa escrito por extenso nos botões

		//Dados devem ser gerados altomaticamente
		$campos['Logs']['data']['input']['label']['text']	= 'Data';
		$campos['Logs']['data']['input']['label']['style']	= 'color: green;';
		$campos['Logs']['data']['mascara'] 					= '99/99';
		$campos['Logs']['data']['input']['style']			= 'width: 46px; text-align: center;';

		//Puchar dados do usuário logado
		$campos['Usuario']['nome']['input']['label']['text'] 	= 'Usuário';
		$campos['Usuario']['nome']['input']['style']			= 'width: 100px; text-align: left;';
		$campos['Usuario']['nome']['th']['width']				= '150px';

		//Dados devem ser gerados altomaticamente
		$campos['Logs']['descricao']['input']['label']['text'] 	= 'Descrição';
		$campos['Logs']['descricao']['input']['style']			= 'width: 350px; text-align: left;';
		$campos['Logs']['descricao']['th']['width']				= '150px';




		if ($this->action=='imprimir') //Esse "imprimir" é um método do controlador(classe)
		{
			$edicaoCampos = array('Logs.data','#','Usuario.nome','#','Logs.descricao');
		}

		if ($this->action=='listar')
		{
			foreach($this->data as $_linha => $_arrModel)
			{
				// Irá colorir todas as datas que estiverem vencendo em X dias
				//if ($_arrModel['Cestas']['quantidade']>XXXXX) array_unshift($onReadView,'$("#tr'.$id.'").css("background-color","#F2BCBC")');
			}
		}

		if ($this->action=='editar' || $this->action=='novo')
		{
			array_unshift($onReadView,'$("#CestasQuantidade").focus();'); // Define o campo que vai ganhar foco
		}

		$this->set(compact('listaCampos','edicaoCampos','campos','camposPesquisa','escreverTitBt','onReadView','listaFerramentas','botoesEdicao'));
	}
}
?>
