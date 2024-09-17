<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f9f9f9;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2,
        h3,
        h4 {
            margin: 0;
            padding: 0;
            color: #000;
        }

        h3 {
            margin-bottom: 20px;
        }

        h4 {
            margin-top: 20px;
            border-top: 2px solid #44916d;
            padding-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            font-size: 12px;
            border: 1px solid #ddd;
            padding: 10px;
            padding-top: 5px;
            text-align: left;
        }

        th {
            background-color: #44916d;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Alinhamento do cabeçalho */
        .header {
            text-align: center;
        }

        .header img {
            max-height: 60px;
        }

        .header-text {
            margin-left: 20px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #555;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Cabeçalho -->
        <div class="header">
            <img src="<?= base_url('./assets/img/icons/file (1).jpg') ?>" alt="Logo">
            <h2 class="header-text" style="margin: 10px 0;">Neander Cosméticos Indústria e Comércio LTDA - ME</h2>
        </div>


        <!-- Título da Proposta -->
        <h4 style="margin-bottom:10px;">PROPOSTA COMERCIAL</h4>

            <!-- Informações de Cliente, Contato e Data -->
            <table>
                <tr>
                    <td><strong>Cliente:</strong> <?= htmlspecialchars($cliente['nome_fantasia']) ?></td>
                    <td><strong>Contato:</strong> <?= htmlspecialchars($cliente['contato']) ?></td>
                    <td><strong>Data:</strong> <?= date('d/m/Y') ?></td>
                </tr>
            </table>

            <!-- Tabela de Produtos -->
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Descrição do Produto</th>
                        <th>Lote Mínimo em pcs</th>
                        <th>Valor unit. s/ impostos</th>
                        <th>Valor unit. com impostos</th>
                        <th>Valor unit. da ST</th>
                        <th>Total com impostos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $item = 1;
                    $totalComImposto = 0; // Inicializa o total
                    ?>
                    <?php foreach ($projetosClientes as $projetoCliente): ?>
                        <?php
                        // Calcula o total com impostos para a linha atual
                        $loteMinimo = 10;
                        $valorStEstado = isset($projetoCliente['valor_st_estado']) ? $projetoCliente['valor_st_estado'] : 0;
                        $totalComImpostoLinha = $loteMinimo * $valorStEstado;

                        // Adiciona ao total geral
                        $totalComImposto += $totalComImpostoLinha;
                        ?>
                        <tr>
                            <td><?= $item++ ?></td>
                            <td><?= htmlspecialchars($projetoCliente['nome_produto']) ?></td>
                            <td><?= htmlspecialchars($loteMinimo) ?></td>
                            <td><?= htmlspecialchars($projetoCliente['total_sem_imposto']) ?></td>
                            <td><?= htmlspecialchars($projetoCliente['total_unit']) ?></td>
                            <td><?= htmlspecialchars($valorStEstado) ?></td>
                            <td><?= number_format($totalComImpostoLinha, 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" style="text-align: right;"><strong>Total:</strong></td>
                        <td><?= number_format($totalComImposto, 2, ',', '.') ?></td>
                    </tr>
                </tfoot>
            </table>

            <!-- Condições Gerais de Fornecimento -->
            <h4 style="margin-bottom:10px;">CONDIÇÕES GERAIS DE FORNECIMENTO:</h4>
            <table>
                <tr>
                    <td><strong>Condição de Pagamento:</strong> <?= $condicoesFornecimento['NOME_CONDICAO_FORNECIMENTO'] ?? 'Nenhuma condição de pagamento selecionada.' ?></td>
                </tr>
                <tr>
                    <td><strong>Matéria-Prima:</strong> <?= $condicoesFornecimento['checkMateriaPrima'] == 0 ? 'Pago pela empresa' : 'Pago pelo Cliente' ?></td>
                </tr>
                <tr>
                    <td><strong>Embalagem:</strong> <?= $condicoesFornecimento['checkEmbalagem'] == 0 ? 'Pago pela empresa' : 'Pago pelo Cliente' ?></td>
                </tr>
                <tr>
                    <td><strong>Rótulo:</strong> <?= $condicoesFornecimento['checkRotulo'] == 0 ? 'Pago pela empresa' : 'Pago pelo Cliente' ?></td>
                </tr>
                <tr>
                    <td><strong>Impostos:</strong> <?= $condicoesFornecimento['impostos'] ?? '' ?></td>
                </tr>
                <tr>
                    <td><strong>Transporte:</strong> <?= $condicoesFornecimento['checkTransporte'] == 0 ? 'Pago pela empresa' : 'Pago pelo Cliente' ?></td>
                </tr>
            </table>

            <h4>Observações importantes:</h4>
            <p><?= $condicoesFornecimento['observacoes'] ?? '' ?></p>


    </div>
</body>

</html>