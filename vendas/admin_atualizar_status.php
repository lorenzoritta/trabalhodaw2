<?php
include_once "../class/vendasDAO.class.php";

$id = $_POST['id_venda'];
$status = $_POST['status_venda'];

$objVendasDAO = new VendasDAO();
$objVendasDAO->atualizarStatus($id, $status);

header("Location: admin_compras.php");
?>
