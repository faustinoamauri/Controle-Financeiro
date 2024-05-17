<?php
    //validando se existe algum erro no código php
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); 
            
	//Importando obejto conexão
	include_once('conectbd.php');

	$id = $_POST["fldID"];
            
    //verifica se existe conexão com o banco de dados através da função acessarbd
    acessarbd();

    //variável que armazena a conexão com o banco de dados
	$bd_conected = true;

			if ($bd_conected) {
				$string_sql = "SELECT * from gastos where cod_gasto = '$id';";
				$consulta = mysqli_query(acessarbd(), $string_sql); //Realiza a consulta
				
				if(mysqli_num_rows($consulta) != 0){ //verifica se existe conteudo na tabela e faz a impressão
               	
					$row = mysqli_fetch_array($consulta);
					$cod_gasto = $row["cod_gasto"];
					$data = $row["data"];
					$valor = $row["valor"];
					$descricao = $row["descricao"];		
					
					echo "<!DOCTYPE html";
					echo "<html>";
						echo "<head>";
							echo "<title>Editar Gastos</title>";
						echo "</head>";
					echo "<body>";

						echo '<form method="post" action="updt_gastos.php">';
							echo '<p>Código: <input type="hidden" name="fldID" value="'.$cod_gasto.'"/></p>';
							echo '<p>Data: <input type="text" name="fldData" value="'.$data.'"/></p>';
							echo '<p>Valor: <input type="text" name="fldValor" value="'.$valor.'"/></p>';
							echo '<p>Descrição: <input type="text" name="fldDescricao" value="'.$descricao.'"/></p>';
							echo '<input name="btnEnviar" value="Enviar" type="submit"/>&nbsp;&nbsp;';
							echo '<input name="btnCancelar" value="Cancelar" type="reset"/>';
						echo '</form>';

						echo '<a href="alt_gastos.html">Alterar outra despesa</a><br/>'; //Apenas um link para retornar para a consulta
						echo '<a href="principal.html">Tela Principal</a>'; //Apenas um link para retornar para o site da empresa


					echo "</body>";
					echo "</html>";
			
				} else {
							echo "<h1 align='center'>Não existem dados a serem exibidos </h1><br/>";
							echo '<a href="alt_gastos.html">Tentar novamente</a><br/>'; //Apenas um link para retornar para a consulta
							echo '<a href="principal.html">Tela Principal</a>'; //Apenas um link para retornar para o site da empresa

							mysqli_free_result($consulta);
						}
			
		
		 
				//fecha conexão com o banco de dados
				mysqli_close(acessarbd()); 

			}


        ?>