<?php echo $this->Html->css('principal'); ?>
<div id='info'>
	<div id='dadosUsuario'>
	<center><h2>Usuário</h2></center>
		<?php 
			$data = $this->Session->read('usuario');
			foreach($data as $_campo => $_valor)
			{
				switch($_campo)
				{
					case 'ultimo':
						echo '<label>Último Acesso: </label> '.$this->Time->format('d/m/Y h:i:s',$_valor);
						break;
					default:
						if ($_campo!='id') echo '<label>'.$_campo.': </label> '.$_valor;
				}
				if ($_campo!='id') echo '<br /><br />';
			}
			?>
	</div>

	<div id='dadosPerfil'>
		<center><h2>Perfis</h2></center>
		<?php $data = $this->Session->read('perfis'); foreach($data as $_valor) echo ' - <strong>'.$_valor.'</strong><br />'; ?>
	</div>

</div>
