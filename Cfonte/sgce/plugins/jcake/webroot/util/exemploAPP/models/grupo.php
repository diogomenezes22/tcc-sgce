<?php
/**
 * Model para grupos
 *
 * @package		exemploApp
 * @subpackage	exemploApp.model
 */
/**
 * @package		exemploApp
 * @subpackage	exemploApp.model
 */
class Grupo extends AppModel {
	/**
	 * Nome do model
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 			= 'Grupo';

	/**
	 * Campo padrão do model
	 * 
	 * @var		string
	 * @access	public
	 */
	public $displayField 	= 'nome';

	/**
	 * Campo de ordenação padrão
	 * 
	 * @var		string
	 * @access	public
	 */
	public $order		 	= 'Grupo.nome';

	/**
	 * Regras de validação para cada campo do model
	 * 
	 * @var		array
	 * @access	public
	 */
	public $validate = array
	(
		'nome' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty',
				'required' 	=> true,
				'message' 	=> 'É necessário informar o nome do Grupo!',
			)
		)
	);

	/**
	 * Relacionamento 1 para n
	 */
	public $hasAndBelongsToMany	= array
	(
		'Cliente' => array
		(
			'className'		=> 'Cliente',
			'joinTable'		=> 'clientes_grupo',
			'associationForeignKey' => 'cliente_id',
			'foreignKey'	=> 'grupo_id',
			'unique'		=> true,
			'fields' 		=> 'Cliente.id, Cliente.nome'
		),
	);
}

?>
