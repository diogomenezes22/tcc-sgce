<?php
/**
 * Model de clientes
 *
 * @package		exemploApp
 * @subpackage	exemploApp.model
 */
/**
 * @package		exemploApp
 * @subpackage	exemploApp.model
 */
class Cliente extends AppModel {
	/**
	 * Nome do model
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 			= 'Cliente';

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
	public $order		 	= 'Cliente.nome';

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
				'message' 	=> 'É necessário informar o nome do cliente !!!',
			),
			2	=> array
			(
				'rule' 		=> 'isUnique',
				'required' 	=> true,
				'message' 	=> 'Este nome já foi cadastrado',
			)
		),
		'email'	=> array
		(
			1	=> array
			(
				'rule'		=> 'email',
				'message' 	=> 'e-mail inválido !!!',
				 'allowEmpty' => true
			),
		)
	);

	/**
	 * Relacionamento 1 para 1
	 * 
	 * @var		array
	 * @access	public
	 */
	public $belongsTo = array(
		'Cidade' => array(
			'className' => 'Cidade',
			'foreignKey' => 'cidade_id',
			'conditions' => '',
			'fields' => 'Cidade.id, Cidade.nome'
		),
		'Estado' => array(
			'className' => 'Estado',
			'foreignKey' => 'estado_id',
			'conditions' => '',
			'fields' => 'Estado.id, Estado.uf'
		)
	);

	/**
	 * Relacionamento 1 para n
	 */
	public $hasAndBelongsToMany	= array
	(
		'Grupo' => array
		(
			'className'		=> 'Grupo',
			'joinTable'		=> 'clientes_grupo',
			'associationForeignKey' => 'grupo_id',
			'foreignKey'	=> 'cliente_id',
			'unique'		=> true,
			'fields' 		=> 'Grupo.id, Grupo.nome'
		),
	);
}

?>
