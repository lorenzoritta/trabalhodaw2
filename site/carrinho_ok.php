<?php
session_start();
include_once "../class/vendas.class.php";
include_once "../class/vendasDAO.class.php";
$objVendas = new Vendas();
$objVendas->setId_cliente($_SESSION["id"]);
$objVendas->setData_venda(date("y-m-d"));
$objVendas->setForma_pagamento($_POST["pagamento"]);
$objVendas->setEntrega($_POST["endereco"]);
$objVendas->setStatus_venda("nova compra");
$objDAO = new VendaDAO();
$retorno = $objDAO->inserir($objVendas);
if ($retorno > 0) {
    echo "venda inserida";
} else {
    echo "erro";
}
?>