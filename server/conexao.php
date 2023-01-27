<?php

	$banco = 'SEU BANCO DE DADOS';
	$host = 'SEU HOST';
	$usuario = 'SEU USUÁRIO';
	$senha = 'SUA SENHA';

	$key = 'CRIE UMA CHAVE';

	date_default_timezone_set('America/Sao_Paulo');

	try {

		$pdo = new PDO("mysql:dbname=$banco;host=$host;charset=utf8", "$usuario", "$senha");
	
	} catch (Exception $e) {
	
		echo "Erro ao conectar com o banco de dados! " . $e;
	
	}

?>