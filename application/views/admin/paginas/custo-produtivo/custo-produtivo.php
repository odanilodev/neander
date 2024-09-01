<div class="content">

  <div class="pb-9">
    <div class="card theme-wizard mb-5">
      <div class="card-header bg-100 pt-3 pb-2 border-bottom-0">
        <ul class="nav justify-content-between nav-wizard">
          <li class="nav-item">
            <a class="nav-link active fw-semi-bold btn-etapas btn-manipulation" href="#tab-manipulacao" data-bs-toggle="tab" data-wizard-step="1">
              <div class="text-center d-inline-block">
                <span class="nav-item-circle-parent" style="left:-10px;">
                  <span class="nav-item-circle">
                    <span class="fas fa-info-circle"></span>
                  </span>
                </span>
                <span class="d-none d-md-block mt-1 fs--1">Manipulação</span>
              </div>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link fw-semi-bold btn-etapas" href="#tab-envase" data-bs-toggle="tab" data-wizard-step="2">
              <div class="text-center d-inline-block">
                <span class="nav-item-circle-parent">
                  <span class="nav-item-circle">
                    <span class="fas fa-pen-square"></span>
                  </span>
                </span>
                <span class="d-none d-md-block mt-1 fs--1">Envase</span>
              </div>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semi-bold btn-etapas" href="#tab-rotulagem" data-bs-toggle="tab" data-wizard-step="3">
              <div class="text-center d-inline-block">
                <span class="nav-item-circle-parent">
                  <span class="nav-item-circle">
                    <span class="fas fa-money-check-alt"></span>
                  </span>
                </span>
                <span class="d-none d-md-block mt-1 fs--1">Rotulação</span>
              </div>
            </a>
          </li>
        </ul>
      </div>

      <div class="card-body pt-4 pb-0">
        <div class="d-flex justify-content-between pb-3">
          <!-- Botão para abrir o modal -->
          <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalNiveisProdutos">
            Verificar Níveis
          </button>
          <!-- <button type="button" class="btn btn-phoenix-secondary btn-limpar">
            <span class="fas fa-brush"></span>
            Limpar Campos
          </button> -->
        </div>

        <div class="tab-content">
          <!-- Manipulação Tab -->
          <div class="tab-pane active" role="tabpanel" aria-labelledby="tab-manipulacao" id="tab-manipulacao">
            <div class="mb-3">
              <label for="inputCustoHoraManipulacao" class="form-label">Custo Hora (R$):</label>
              <input type="text" value="<?= number_format(($equipamentosManipulacao[0]['valor_base'] ?? 0), 2, ',', '.') ?>
" class="form-control mascara-dinheiro" id="inputCustoHoraManipulacao" placeholder="Insira o valor base">
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Equipamento</th>
                  <th>Nível</th>
                  <th>Tempo Prod.</th>
                  <th>Valor MO</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($equipamentosManipulacao as $equipamentoManipulacao) : ?>
                  <tr>
                    <td class="no-padding" style="padding-left: 10px;"><?= $equipamentoManipulacao['nome'] ?></td>
                    <td class="no-padding"><?= $equipamentoManipulacao['nivel'] . ' - ' . $equipamentoManipulacao['tanque'] ?></td>
                    <td class="editable no-padding">
                      <input value="<?= $equipamentoManipulacao['tempo_prod'] == '00:00:00' ? '' : $equipamentoManipulacao['tempo_prod'] ?>" data-id-equipamento-manipulacao="<?= $equipamentoManipulacao['id'] ?>" class="mascara-tempo input-custo-producao input-equipamento-manipulacao" type="text" placeholder="00:00">
                      <div class="spinner-border text-primary load-form-<?= $equipamentoManipulacao['id'] ?> d-none" role="status"></div>
                    </td>
                    <td class="no-padding valores-totais-manipulacao valor-total-manipulacao-<?= $equipamentoManipulacao['id'] ?>">R$ <?= number_format($equipamentoManipulacao['valor_mo'] ?? 0.00, 2, ',', '.') ?>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>

          <div class="tab-pane" role="tabpanel" aria-labelledby="tab-envase" id="tab-envase">

            <label for="inputCustoHoraEnvase" class="form-label">Custo Hora(R$):</label>

            <div class="mb-3">
              <div class="mb-3 col-md-12">
                <input type="text" value="<?= number_format(($equipamentosEnvase[0]['valor_base'] ?? '0'), 2, ',', '.') ?>" class="form-control mascara-dinheiro" id="inputCustoHoraEnvase" placeholder="Insira o valor base">
              </div>
            </div>

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Equipamento</th>
                  <th>Nível</th>
                  <th>PÇs/Hora</th>
                  <th>Valor MO</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($equipamentosEnvase as $equipamentoEnvase) : ?>
                  <tr>
                    <td class="no-padding" style="padding-left: 10px;"><?= $equipamentoEnvase['nome'] ?></td>
                    <td class="no-padding"><?= $equipamentoEnvase['nivel']  . '-' . $equipamentoEnvase['tipo'] ?> </td>
                    <td class="editable no-padding">
                      <input value="<?= $equipamentoEnvase['pcs_hora'] == 0 ? '' : $equipamentoEnvase['pcs_hora'] ?>" data-mo-envase="<?= $equipamentoEnvase['mo'] ?>" data-id-equipamento-envase="<?= $equipamentoEnvase['id'] ?>" class="input-custo-producao input-equipamento-envase" type="text" placeholder="00">
                    </td>
                    <td class="no-padding valores-totais-envase valor-total-envase-<?= $equipamentoEnvase['id'] ?>">R$ <?= number_format($equipamentoEnvase['valor_mo'] ?? 0.00, 2, ',', '.') ?>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>

          <div class="tab-pane" role="tabpanel" aria-labelledby="tab-rotulagem" id="tab-rotulagem">
            <div class="mb-3">
              <div class="text-end">
              </div>
              <label for="inputCustoHoraRotulagem" class="form-label">Custo Hora (R$):</label>
              <input type="text" value="<?= number_format(($equipamentosRotulagem[0]['valor_base'] ?? 0), 2, ',', '.') ?>" class="form-control mascara-dinheiro" id="inputCustoHoraRotulagem" placeholder="Insira o valor base">
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Equipamento</th>
                  <th>Nível</th>
                  <th>PÇs/Hora</th>
                  <th>Valor MO</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($equipamentosRotulagem as $equipamentoRotulagem) : ?>
                  <tr>
                    <td class="no-padding" style="padding-left: 10px;"><?= $equipamentoRotulagem['nome'] ?></td>
                    <td class="no-padding"><?= $equipamentoRotulagem['nivel'] . ' - ' . $equipamentoRotulagem['tipo'] ?></td>
                    <td class="editable no-padding">
                      <input value="<?= $equipamentoRotulagem['pcs_hora'] == 0 ? '' : $equipamentoRotulagem['pcs_hora'] ?>" data-id-equipamento-rotulagem="<?= $equipamentoRotulagem['id'] ?>" class="input-custo-producao input-equipamento-rotulagem" type="text" placeholder="00">
                    </td>
                    <td class="no-padding valores-totais-rotulagem valor-total-rotulagem-<?= $equipamentoRotulagem['id'] ?>">R$ <?= number_format($equipamentoRotulagem['valor_mo'] ?? 0.00, 2, ',', '.') ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalNiveisProdutos" tabindex="-1" aria-labelledby="modalNiveisProdutosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalNiveisProdutosLabel">Níveis e Produtos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center">Nível</th>
                <th>Produto</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">1</td>
                <td>Shampoos, Sabonetes líquidos de baixa complexidade</td>
              </tr>
              <tr>
                <td class="text-center">2</td>
                <td>Shampoos, Sabonetes líquidos de alta complexidade</td>
              </tr>
              <tr>
                <td class="text-center">3</td>
                <td>Cremes, Condicionadores, Desodorante Rollon, Serum de baixa complexidade</td>
              </tr>
              <tr>
                <td class="text-center">4</td>
                <td>Cremes, Condicionadores de alta complexidade</td>
              </tr>
              <tr>
                <td class="text-center">5</td>
                <td>Cremes, Máscaras, Matizadores de alta complexidade</td>
              </tr>
              <tr>
                <td class="text-center">6</td>
                <td>Géis</td>
              </tr>
              <tr>
                <td class="text-center">7</td>
                <td>Produtos líquidos</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>