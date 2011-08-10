<?php
/**
 * Componente para auxiliar no CRUD do plugin jCake
 * 
 * @package		jcake
 * @subpackage	jcake.component
 */

/**
 * @package		jcake
 * @subpackage	jcake.component
 */
class ControladorComponent extends Object {
	/**
	 * Inicialização do componente
	 * 
	 * @param	object	$controller Controlador pai
	 * @return	void
	 */
	public function startup(&$controller)
	{
		$this->controller =& $controller;
		$this->controller->plugin 	= 'jcake';
		$this->controller->layout 	= 'jcake';
		$this->controller->viewPath	= 'jcake';

		if (in_array($this->controller->action,array('combo','pesquisar'))) $this->controller->layout 	= 'ajax';

		if (isset($this->controller->modelClass))
		{
			$modelClass = $this->controller->modelClass;
			$primaryKey	= isset($this->controller->$modelClass->primaryKey) ? $this->controller->$modelClass->primaryKey : '';
			$schema		= isset($this->controller->$modelClass->_schema)	? $this->controller->$modelClass->_schema : '';
			$this->controller->set(compact('modelClass','primaryKey','schema'));
		}
		$this->controller->set('titulo',$this->controller->name.' - '.$this->controller->action);
	}

	/**
	 * Exibe a tela inicial do cadastro
	 * 
	 * @return	void
	 */
	public function index()
	{
		$this->controller->redirect('listar');
	}

	/**
	 * Exibe a paginação do cadastro
	 * 
	 * @return void
	 */
	public function listar()
	{
		$this->controller->data = $this->controller->paginate();
		$this->controller->Session->write($this->controller->name.'.params',$this->controller->params['named']);
	}

	/**
	 * Executa a tela de edição do cadastro
	 * 
	 * @parameter	float	$id		Id do registro a ser editado
	 * @return		void
	 */
	public function editar($id=0)
	{
		$modelClass = $this->controller->modelClass;
		if ($this->controller->data)
		{
			if ($this->controller->$modelClass->save($this->controller->data))
			{
				$this->controller->Session->setFlash('O registro foi salvo com sucesso !!!');
				$this->controller->data = $this->controller->$modelClass->read(null,$id);
			} else
			{
				$this->controller->Session->setFlash('O formulário ainda contém erros !!!');
				$this->controller->set('errosForm',array_reverse($this->controller->$modelClass->validationErrors));
			}
		} else
		{
			$this->controller->data = $this->controller->$modelClass->read(null,$id);
		}
		$this->controller->set(compact('id'));
		//$this->setRelacionamentos();
	}

	/**
	 * Executa a inclusão do cadastro
	 * 
	 * @return	void
	 */
	public function novo()
	{
		$modelClass = $this->controller->modelClass;
		if ($this->controller->data)
		{
			if ($this->controller->$modelClass->save($this->controller->data))
			{
				$this->controller->Session->setFlash('O registro foi incluído com sucesso !!!');
				$this->controller->redirect(Router::url('/',true).mb_strtolower($this->controller->name).'/editar/'.$this->controller->$modelClass->id);
			} else
			{
				$this->controller->Session->setFlash('O formulário ainda contém erros !!!');
				$this->controller->set('errosForm',array_reverse($this->controller->$modelClass->validationErrors));
			}
		}
		//$this->setRelacionamentos();
	}

	/**
	 * Deleta um registro do banco de dados. Em caso de sucesso retorna para a lista.
	 * 
	 * @param 	integer	$id				Id do registro a ser excluído
	 * #param	boolean	$cascade		Deleta os relacionamentos também
	 * @return	void
	 */
	public function delete($id=null, $cascade = true)
	{
		// recuperando parãmetros
		$modelClass	= $this->controller->modelClass;
		$primaryKey	= isset($this->controller->$modelClass->primaryKey) ? $this->controller->$modelClass->primaryKey : 'id';

		// excluíndo o registro
		if ($this->controller->$modelClass->delete($id)) 
		{
			$this->controller->Session->setFlash('<span class="excluido_ok">Registro excluído com sucesso !!!</span>');
			$linkLista = Router::url('/',true).mb_strtolower($this->controller->name).'/listar';
			if ($this->controller->Session->check($this->controller->name.'.params'))
			{
				foreach($this->controller->Session->read($this->controller->name.'.params') as $_c => $_v)
				{
					$linkLista .= '/'.$_c.':'.$_v;
				}
			}
			$this->controller->redirect($linkLista);
		} else
		{
			$this->controller->Session->setFlash('<span class="excluido_erro">Não foi possível deletar o id <strong>'.$id.'</strong></span>');
		}
	}

	/**
	 * 
	 */
	public function imprimir($id=0)
	{
		$modelClass = $this->controller->modelClass;
		$this->controller->data = $this->controller->$modelClass->read(null,$id);
		$this->controller->set(compact('id'));
		//$this->setRelacionamentos();
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
		$url = Router::url('/',true);
		if (isset($this->controller->params['plugin']) && !empty($this->controller->params['plugin'])) $url = Router::url('/',true).mb_strtolower($this->controller->params['plugin']).'/';
		
		$parametros										= array();
		$pluralHumanName 								= Inflector::humanize(Inflector::underscore($this->controller->name));
		$modelClass 									= $this->controller->modelClass;
		$id												= isset($this->controller->modelClass->primaryKey) ? $this->controller->modelClass->primaryKey : 'id';
		if (!empty($campo)) $parametros['conditions'] 	= $campo.' like "%'.$texto.'%"';
		if (!empty($campo)) $parametros['order'] 		= $campo;
		if (!empty($campo)) $parametros['limit'] 		= 20;
		$parametros['fields'] 							= array($id,$campo);
		$pesquisa 										= $this->controller->$modelClass->find('list',$parametros);

		$this->controller->Session->write('campoPesquisa'.$this->controller->name,$campo);
		$this->controller->set('link',$url.mb_strtolower(str_replace(' ','_',$pluralHumanName)).'/'.$action);
		$this->controller->set('pesquisa',$pesquisa);
	}

	/**
	 * Retorna o resultado de um pesquisa para preencher um elemento select
	 * 
	 * exemplo: http://localhost/app/controller/combo/campo/filtro
	 * 
	 * @param	string	$campo	Campo a sofrer a pesquisa
	 * @param	string	$filtro	Texto a ser pesquisado
	 */
	public function combo($campo=null,$filtro=null)
	{
		$modelClass = $this->controller->modelClass;
		$parametros['conditions'] = (!empty($campo) && !empty($filtro)) ? $campo.'="'.$filtro.'"' : array();
		$lista = $this->controller->$modelClass->find('list',$parametros);
		$this->controller->set('lista',$lista);
	}

	/**
	 * Joga na camada de visão, uma lista de todos os relacionamentos do Model corrente
	 * 
	 * @param	string	$modelClass Nome do Modelo
	 * @return void
	 */
	private function setRelacionamentos()
	{
		$modelClass	= $this->controller->modelClass;
		if (method_exists($this->controller,'beforeSetRelacionamentos'))
		{
			$this->controller->beforeSetRelacionamentos();
		}

		foreach($this->controller->$modelClass->__associations as $associacao)
		{
			if (count($this->controller->$modelClass->$associacao))
			{
				foreach($this->controller->$modelClass->$associacao as $assoc => $arr_opcoes)
				{
					$parametros = array();
					if (isset($arr_opcoes['fields'])) 		$parametros['fields'] 		= $arr_opcoes['fields'];
					if (isset($arr_opcoes['conditions']))	$parametros['conditions'] 	= $arr_opcoes['conditions'];
					$this->controller->viewVars[Inflector::pluralize(strtolower($assoc))] = $this->controller->$modelClass->$assoc->find('list',$parametros);
				}
			}
		}
	}
}
?>
