<?php
/**
 * @package       exemploApp
 * @subpackage    exemploApp.model
 */

/**
 * @package       exemploApp
 * @subpackage    exemploApp.model
 */
class AppModel extends Model {
	/**
	 * Matriz que conterá os models que sofrerão cache na action find
	 * 
	 * @var		array
	 * @access	public
	 */
	public $cacheModels = array('Estado','Cidade','Grupo');

	/**
	 * Retorna uma lista do model
	 * 
	 * Só cria o cache quando não tem parâmetros e ainda é to do tipo list ou all
	 * 
	 * @param	null	$conditions		Tipo da lista, list, all 
	 * @param	array	$fields			Registros da lista
	 * @param	null	$order			Ordem da lista
	 * @param	null	$recursive		Qual modelo de recursividade, o pardão é -1
	 */
	function find($conditions = null, $fields = array(), $order = null, $recursive = null)
	{
		// refazendo o cache para os models selecionados
		if (in_array($this->name,$this->cacheModels))
		{
			// cache somente  para list e all
			if 	(
					(in_array($conditions,array('list','all'))
					&&
					(count($fields)==0) && $order==null && $recursive==null)
				)
				
			{
				$chave 	= $conditions.'_'.$this->name;
				if (($lista = Cache::read($chave)) === false)
				{
					$lista = parent::find($conditions);
					Cache::write($chave, $lista);
					//echo 'criei cache com a chave '.$chave.'<br />';
				} else
				{
					//echo 'recuperei list_'.$this->name.'<br />';
				}
				return $lista;
			}
		}
		return parent::find($conditions,$fields,$order,$recursive);
	}

	/**
	 * Executa código depois que o model foi atualizado
	 * 
	 * @param	array	$created
	 * @return	void
	 */
	public function afterSave($created) 
	{
		$this->setCache();
	}

	/**
	 * Depois de deletar
	 * 
	 * @return void
	 */
	public function afterDelete()
	{
		$this->setCache();
	}

	/**
	 * 
	 */
	// refazendo o cache para os models selecionados
	private function setCache()
	{
		if (in_array($this->name,$this->cacheModels))
		{
			// criando cache list
			Cache::delete('list_'.$this->name);

			// invalidando cache all
			Cache::delete('all_'.$this->name);
		}
	}
}

?>
