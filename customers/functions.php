<?php

	require_once('../config.php');
	require_once(DBAPI);

	$customers = null;
	$customer = null;

	/**
	 *  Listagem de Clientes
	 */
	function index() {
		global $customers;
		$customers = find_all('customers');
	} 
	
	/**
	 *  Visualização de um Cliente
	 */
	function view($id = null) {
	  global $customer;
	  $customer = find("customers", $id);
	}
	
	/**
	 *  Cadastro de Clientes
	 */
	function add() {

	  if (!empty($_POST['customer'])) {
		
		$today = 
		  date_create('now', new DateTimeZone('America/Sao_Paulo'));

		$customer = $_POST['customer'];
		$customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");
		
		save('customers', $customer);
		header('location: index.php');
	  }
	}
	
	/**
	 *	Atualizacao/Edicao de Cliente
	 */
	 
	function edit() {

	  $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));

	  if (isset($_GET['id'])) {

		$id = $_GET['id'];

		if (isset($_POST['customer'])) {

			  $customer = $_POST['customer'];
			  $customer['modified'] = $now->format("Y-m-d H:i:s");

			  update("customers", $id, $customer);
			  header("location: index.php");
		} else {

			  global $customer;
			  $customer = find("customers", $id);
		} 
	  } else {
			header("location: index.php");
	  }
	}
	
	 /**
	 *  Formata as datas
	 */
	function formatadata($data , $formato) {
		$dt = new DateTime($data, new DateTimeZone("America/Sao_Paulo"));
		return $dt->format($formato);
	}
	
	 /**
	 *  Formata o CEP
	 */
	function formatacep($cep) {
		return substr($cep,0,5) . "-" . substr($cep,5,3);
	}
	
	/**
	 *  Formata o Telefone
	 */
	function formatatel($tel) {
		 $tl = "(" . substr($tel,0,5) . "-" . substr($tel, 5, 5)  . "-" . substr($tel,7,8);
		 return $tl;
	}
	
	/** Formata o cel
	*/ 
	function formatacel ($cel) { 
	$cl= substr ($cel, 0, 0). "(" . substr($cel, 0, 2). ")" . substr ($cel, 2, 5) . "-" . substr ($cel, 7, 12); 
	return $cl;
	}
	
	
	
?>