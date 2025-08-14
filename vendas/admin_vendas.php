<?php
include_once "../class/vendasDAO.class.php";

$objVendasDAO = new VendasDAO();
$vendas = $objVendasDAO->listarTodas(); // retorna array com vendas + itens

echo "<h1>Vendas Recentes</h1>";
echo "<table border='1' cellpadding='8'>";
echo "<tr><th>ID</th><th>Cliente</th><th>Data</th><th>Total</th><th>Status</th><th>Itens</th><th>Ação</th></tr>";

foreach ($vendas as $v) {
    echo "<tr>";
    echo "<td>{$v['id_venda']}</td>";
    echo "<td>{$v['id_cliente']}</td>";
    echo "<td>{$v['data_venda']}</td>";
    echo "<td>R$ " . number_format($v['total'], 2, ',', '.') . "</td>";

    // Listar itens
    $itens = $objVendasDAO->listarItens($v['id_venda']);
    echo "<td>";
    foreach ($itens as $item) {
        echo "{$item['nome']} (R$ " . number_format($item['preco'], 2, ',', '.') . ")<br>";
    }
    echo "</td>";

    // Status e formulário
    echo "<td>
            <form method='post' action='admin_atualizar_status.php'>
                <input type='hidden' name='id_venda' value='{$v['id_venda']}'>
                <select name='status_venda'>
                    <option value='Pendente'>Pendente</option>
                    <option value='Em Processamento'>Em Processamento</option>
                    <option value='Enviada'>Enviada</option>
                    <option value='Concluída'>Concluída</option>
                </select>
                <button type='submit'>Atualizar</button>
            </form>
          </td>";

    echo "</tr>";
}
echo "</table>";
