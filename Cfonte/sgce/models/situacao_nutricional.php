<?php
/**
 * Model para as situações nutricionais
 *
 * @package		sgce
 * @subpackage	sgce.model
 */
/**
 * @package		sgce
 * @subpackage	sgce.model
 */
class SituacaoNutricional extends AppModel {
	/**
	 * Nome do model
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 			= 'SituacaoNutricional';

	/**
	 * Campo padrão do model
	 * 
	 * @var		string
	 * @access	public
	 */
	public $displayField 	= 'situacao_nutricional';

	/**
	 * Campo de ordenação padrão
	 * 
	 * @var		string
	 * @access	public
	 */
	public $order		 	= 'SituacaoNutricional.situacao_nutricional';

	/**
	 * Regras de validação para cada campo do model
	 * 
	 * @var		array
	 * @access	public
	 */
	public $validate = array
	(
		'situacao_nutricional' => array
		(
			1 	=> array
			(
				'rule' 		=> 'notEmpty',
				'required' 	=> true,
				'message' 	=> 'É necessário informar a situação nutricional da criança!',
			)
		)
	);

	/**
	 * Relacionamento 1 para 1
	 * 
	 * @var		array
	 * @access	public
	 */
	public $belongsTo = array(
		'Dependente' => array(
			'className' => 'Dependente',
			'foreignKey' => 'dependente_id',
			'conditions' => '',
			'fields' => 'Dependente.id, Dependente.nome'
		)
	);

}
?>
