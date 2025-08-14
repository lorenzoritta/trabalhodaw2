<?php
session_start();
include_once "../class/produtoDAO.class.php";
include_once "../class/vendas.class.php"; // classe para vendas
include_once "../class/vendasDAO.class.php";

if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) === 0) {
    echo "Carrinho vazio!";
    exit;
}

$total = 0;
$objProdutoDAO = new ProdutoDAO();
foreach ($_SESSION['carrinho'] as $idProduto) {
    $produto = $objProdutoDAO->listar("WHERE id_manga = $idProduto")[0];
    $total += $produto['preco'];
}

// Inserir venda
$objVendasDAO = new VendasDAO();
$idVenda = $objVendasDAO->inserir($_SESSION['id_cliente'], $total, 'Pendente', 'Não definido'); // status e entrega iniciais

// Inserir itens da venda (assumindo que você tenha uma tabela itens_venda)
foreach ($_SESSION['carrinho'] as $idProduto) {
    $produto = $objProdutoDAO->listar("WHERE id_manga = $idProduto")[0];
    $objVendasDAO->inserirItem($idVenda, $idProduto, 1, $produto['preco']);
}

// Limpar carrinho
unset($_SESSION['carrinho']);
echo "Compra finalizada com sucesso!";
?>
