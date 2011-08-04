<?php
/**
 * Controller para o cadastro de cestas
 * 
 * @package		sgce
 * @subpackage	sgce.controller
 */
/**
 * @package		sgce
 * @subpackage	sgce.controller
 */
class CestasController extends AppController {
	/**
	 * Nome do controller
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 		= 'Cestas';

	/**
	 * Model do controller
	 * 
	 * @var		array
	 * @access	public
	 */
	public $uses		= array('Cestas');

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
// Transforma os campos especificados para caixa ALTA (mb_strtoupper)
/*		if (isset($this->data))
		{
			$this->data['Usuario']['nome'] = mb_strtoupper($this->data['Usuario']['nome']);
		}
*/
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
		$listaCampos 					= array('Cestas.quantidade','Cestas.saida');
		$edicaoCampos					= array('Cestas.quantidade','#','Cestas.saida');
		$listaFerramentas				= array();
		$botoesEdicao					= array();

		$camposPesquisa['Cestas.saida'] 	= 'Data de saída';
		$escreverTitBt 					= false; //Desativa escrito por extenso nos botões

		$campos['Cestas']['quantidade']['input']['label']['text'] 	= 'Quantidade de Cesta';
		$campos['Cestas']['quantidade']['input']['style']			= 'width: 25px; text-align: left;';
		$campos['Cestas']['quantidade']['th']['width']				= '150px';

		$campos['Cestas']['saida']['input']['label']['text']	= 'Data de saída';
		$campos['Cestas']['saida']['input']['label']['style']	= 'color: green;';
		$campos['Cestas']['saida']['mascara'] 					= '99/99';
		$campos['Cestas']['saida']['input']['style']			= 'width: 46px; text-align: center;';


		if ($this->action=='imprimir') //Esse "imprimir" é um método do controlador(classe)
		{
			$edicaoCampos = array('Cestas.quantidade','#','Cestas.saida');
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
