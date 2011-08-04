<?php
/**
 * Controller para o cadastro de frequências
 * 
 * @package		sgce
 * @subpackage	sgce.controller
 */
/**
 * @package		sgce
 * @subpackage	sgce.controller
 */
class FrequenciasController extends AppController {
	/**
	 * Nome do controller
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 		= 'Frequencias';

	/**
	 * Model do controller
	 * 
	 * @var		array
	 * @access	public
	 */
	public $uses		= array('Frequencias');

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
		$listaCampos 					= array('Frequencias.status','Frequencias.data','Familia.nome');
		$edicaoCampos					= array('Frequencias.status','#','Frequencias.data','#','Familia.nome');
		$listaFerramentas				= array();
		$botoesEdicao					= array();

		$camposPesquisa['Familia.nome'] 	= 'Nome';
		$escreverTitBt 					= false; //Desativa escrito por extenso nos botões

		$campos['Frequencias']['status']['input']['label']['text'] 	= 'Status';
		$campos['Frequencias']['status']['input']['options']		= array('1'=>'Presente', '0'=>'Ausente'); //Mudar para char no banco, pois terá mais de duas opções
		$campos['Frequencias']['status']['th']['width']				= '100px';

		$campos['Frequencias']['data']['input']['label']['text']	= 'Data';
		$campos['Frequencias']['data']['input']['label']['style']	= 'color: green;';
		$campos['Frequencias']['data']['mascara'] 					= '99/99';
		$campos['Frequencias']['data']['input']['style']			= 'width: 46px; text-align: center;';

		//Puchar nomes das famílias direto do banco e exibir aqui em um campo select
		$campos['Familia']['nome']['input']['label']['text'] 	= 'Nome';
		$campos['Familia']['nome']['input']['style']			= 'width: 300px; text-align: left;';
		$campos['Familia']['nome']['th']['width']				= '150px';


		if ($this->action=='imprimir') //Esse "imprimir" é um método do controlador(classe)
		{
			$edicaoCampos = array('Frequencias.status','#','Frequencias.data','#','Familia.nome');
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
			array_unshift($onReadView,'$("#FrequenciaStatus").focus();'); // Define o campo que vai ganhar foco
		}

		$this->set(compact('listaCampos','edicaoCampos','campos','camposPesquisa','escreverTitBt','onReadView','listaFerramentas','botoesEdicao'));
	}
}
?>
