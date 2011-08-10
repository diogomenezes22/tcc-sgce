<?php
/**
 * Controller para Ferramentas
 * 
 * @package		jcake
 * @subpakage	jcake.controller
 */
/**
 * @package		jcake
 * @subpakage	jcake.controller
 */
class FerramentasController extends AppController {
	/**
	 * 
	 * Nome do controller
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name 	= 'Ferramentas';

	/**
	 * Model usado pelo controlador
	 * 
	 * @var		array
	 * @access	public
	 */
	public $uses	= array();

	/**
	 * Ajudantes
	 * 
	 * @var		array
	 * @access	public
	 */
	public $helpers		= array('Jcake.Visao');

	/**
	 * Antes de tudo
	 * 
	 * @return void
	 */
	public function beforeFilter()
	{
		$this->layout 	= 'jcake';
		$this->plugin 	= 'jcake';
	}

	/**
	 * 
	 */
	public function index()
	{
		if ($this->data)
		{
			$msg = '';
			switch($this->data['tipo'])
			{
				case 'limparCache':
					$this->setLimpaCache();
					$msg = 'Cache limpo com sucesso';
					break;
				case 'instalarApp':
					$res = $this->getInstala($nome,$admin,$senha,$email);
					$msg = $res ? 'Instalação executada com sucesso' : 'Erro ao executar instalação';
					break;
			}
			$this->set('msg',$msg);
		}
	}

	/**
	 * Limpa o cache
	 * 
	 * @return void
	 */
	private function setLimpaCache()
	{
		Cache::clear();
	}

	/**
	 * Executa a instalação do banco de dados
	 * 
	 * @return boolean
	 */
	private function getInstala($nome,$admin,$senha,$email)
	{
		// desligando o debug
		Configure::write('debug', 2);

		// instancio o datasource só pra pegar erros do banco
		$db = ConnectionManager::getDataSource('default'); 

		// instala todas as tabelas do sistema
		$arq = APP.DS.'docs'.DS.'sql'.DS.mb_strtolower(SISTEMA).'.sql';
		if (!file_exists($arq))
		{
			$this->erro = 'Não foi possível localicar o arquivo '.$arq;
			exit('não foi possível localizar o arquivo '.$arq);
			return false;
		}
		$handle  = fopen($arq,"r");
		$texto   = fread($handle, filesize($arq));
		$sqls	 = explode(";",$texto);
		fclose($handle);
		foreach($sqls as $sql) // executando sql a sql
		{
			if (trim($sql))
			{
				$this->Instalacao->query($sql, $cachequeries=false);
				if ($db->lastError())
				{
					$this->erro = $db->lastError();
					return false;
				}
			}
		}

		// atualiza outras tabelas vias CSV
		foreach($this->csv as $tabela)
		{
			$this->setPopulaTabela(APP.DS.'docs'.DS.'csv'.DS.$tabela.'.csv',$tabela,$db);
		}

		// encriptando a senha
		$senha = Security::hash(Configure::read('Security.salt') . $senha);

		// inclui usuário administrador
		$sql  = 'INSERT INTO usuarios (nome,login,senha,email,cidade_id,ativo,acessos,aniversario,ultimo_acesso,created,modified) values ';
		$sql .= '("'.mb_strtoupper($nome).'","'.$admin.'","'.$senha.'","'.$email.'",2302,1,1,"'.date('dm').'",now(),now(),now())';
		$this->Instalacao->query($sql, $cachequeries=false);
		if ($db->lastError())
		{
			$this->erro = $db->lastError().'<br />'.$sql;
			return false;
		}

		// incluindo o administrador no perfil admin
		$sql  = 'INSERT INTO usuarios_perfil (usuario_id,perfil_id) values ';
		$sql .= '(1,1)';
		$this->Instalacao->query($sql, $cachequeries=false);
		if ($db->lastError())
		{
			$this->erro = $db->lastError().'<br />'.$sql;
			return false;
		}

		// instalando plugins
		foreach($this->plugins as $_plugin)
		{
			$arq = APP.'plugins'.DS.$_plugin.DS.'docs'.DS.'sql'.DS.$_plugin.'.sql';
			if (file_exists($arq))
			{
				// importando o sql para o banco de dados
				$handle  = fopen($arq,"r");
				$texto   = fread($handle, filesize($arq));
				$sqls	 = explode(";",$texto);
				fclose($handle);
				foreach($sqls as $sql) // executando sql a sql
				{
					if (trim($sql))
					{
						$this->Instalacao->query($sql, $cachequeries=false);
						if ($db->lastError())
						{
							exit($db->lastError().'<br />'.$sql);
						}
					}
				}
				if (!$db->lastError())
				{
					foreach($this->csvPlugin as $tabela)
					{
						$this->setPopulaTabela(APP.'plugins'.DS.$_plugin.DS.'docs'.DS.'csv'.DS.$tabela.'.csv',$tabela,$db);
					}
				}
			}
		}
		return true;
	}
}
?>
