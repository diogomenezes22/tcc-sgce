<?php
/**
 * Controller Pai de todos
 * 
 * @package       exemploApp
 * @subpackage    exemploApp.app
 */

/**
 * @package       exemploApp
 * @subpackage    exemploApp.app
 */
class AppController extends Controller {
	/**
	 * Página inicial do cadastro de cidades
	 * 
	 * @return	void
	 */
	public function index()
	{
		$this->Controlador->index();
	}

	/**
	 * Exibe a tela para criar um novo registro
	 * 
	 * @return	void
	 */
	public function novo()
	{
		$this->Controlador->novo();
	}

	/**
	 * Exibe a tela de edição
	 * 
	 * @param	integer		$id	Id do registro a ser editado
	 * @return	void
	 */
	public function editar($id=0)
	{
		$this->Controlador->editar($id);
	}

	/**
	 * Exibe a tela de exclusão
	 * 
	 * @param	integer		$id	Id do registro a ser editado
	 * @return	void
	 */
	public function excluir($id=0)
	{
		$this->Controlador->editar($id);
	}

	/**
	 * Executa a exclusão do registro
	 * 
	 * @param	integer		$id	Id do registro a ser excluído
	 * @return	void
	 */
	public function delete($id=0)
	{
		$this->Controlador->delete($id);
	}

	/**
	 * Imprimi na tela o registro selecionado
	 * 
	 * @param	integer		$id	Id do registro a ser excluído
	 * @return	void
	 */
	public function imprimir($id=0)
	{
		$this->Controlador->imprimir($id);
	}

	/**
	 * Lista do cadastro de cidades
	 * 
	 * @return 	void
	 */
	public function listar()
	{
		$this->Controlador->listar();
	}

	/**
	 * Realiza uma pesquisa no banco de dados
	 * 
	 * @parameter 	string 	$texto 	Texto de pesquisa
	 * @parameter 	string 	$campo 	Campo de pesquisa
	 * @parameter	string 	$action	Action para onde será redirecionado ao clicar na resposta
	 * @return 		array 	$lista 	Array com lista de retorno
	 */
	public function pesquisar($campo=null,$texto=null,$action='editar')
	{
		$this->Controlador->pesquisar($campo, $texto, $action);
	}

	/**
	 * Retorna uma lista do banco de dados para comboBox
	 * 
	 * exemplo: http://localhost/sistema/controle/combo/campo/filtro
	 * 
	 * @parameter	string	$campo		Campo a sofrer o filtro
	 * @parameter	string	$filtro		Texto a ser aplicado no filtro
	 * @access		public
	 * @return 		string
	 */
	public function combo($campo=null,$filtro=null)
	{
		$this->Controlador->combo($campo, $filtro);
	}
}

?>
