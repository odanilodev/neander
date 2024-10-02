<div class="content">
  <div class="row mb-9">
    <div class="col-12">
      <div class="card shadow-none border border-300 my-4">
        <div class="card-header p-4 border-bottom border-300 bg-soft">
          <h4 class="text-900 mb-0"><?= $this->uri->segment(3) ? 'Editar Matéria Prima' : 'Cadastrar Matéria Prima'; ?></h4>
        </div>

        <div class="card-body p-4">
          <div class="row g-3">
            <input type="hidden" class="input-id" value="<?= $materiaPrima['id'] ?? ''; ?>">

            <!-- Nome -->
            <div class="col-md-4 mb-3">
              <label class="form-label">Nome</label>
              <input class="form-control input-nome input-obrigatorio" type="text" placeholder="Nome da Matéria Prima" value="<?= $materiaPrima['nome'] ?? ''; ?>">
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <!-- I.N.C.I -->
            <div class="col-md-4 mb-3">
              <label class="form-label">I.N.C.I</label>
              <input class="form-control input-inci input-obrigatorio" type="text" placeholder="INCI da Matéria Prima" value="<?= $materiaPrima['inci'] ?? ''; ?>">
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <!-- CAS Number -->
            <div class="col-md-4 mb-3">
              <label class="form-label">CAS Number</label>
              <input class="form-control input-cas-number input-obrigatorio" type="text" placeholder="CAS Number da Matéria Prima" value="<?= $materiaPrima['cas_number'] ?? ''; ?>">
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <!-- Valor R$ -->
            <div class="col-md-4 mb-3">
              <label class="form-label">Valor R$</label>
              <input class="form-control input-valor input-obrigatorio mascara-dinheiro" type="text" placeholder="Valor da Matéria Prima" value="<?= $materiaPrima['valor'] ?? ''; ?>">
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <!-- Fornecedor -->
            <div class="col-md-4 mb-3">
              <label class="form-label">Fornecedor</label>
              <select class="form-control select-fornecedor input-obrigatorio select2" name="fornecedor" required>
                <option value="" disabled selected>Selecione o fornecedor</option>
                <?php foreach ($fornecedores as $fornecedor) : ?>
                  <option value="<?= $fornecedor['id']; ?>" <?= isset($materiaPrima['id_fornecedor']) && $materiaPrima['id_fornecedor'] == $fornecedor['id'] ? 'selected' : ''; ?>>
                    <?= $fornecedor['nome_fantasia']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <!-- Composição em Português -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Composição em Português</label>
              <textarea class="form-control input-composicao-ptbr input-obrigatorio" rows="3" placeholder="Digite aqui a composição"><?= $materiaPrima['composicao_ptbr'] ?? ''; ?></textarea>
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <!-- Descrição -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Descrição</label>
              <textarea class="form-control input-descricao input-obrigatorio" rows="3" placeholder="Digite aqui a descrição"><?= $materiaPrima['descricao'] ?? ''; ?></textarea>
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <!-- Botão Enviar -->
            <div class="col-12 text-end my-4">
              <button class="btn btn-phoenix-primary px-6 btn-envia" onclick="cadastraMateriaPrima()">
                <?= $this->uri->segment(3) ? 'Editar' : 'Cadastrar'; ?>
                <span class="fas fa-chevron-right" data-fa-transform="shrink-3"></span>
              </button>
              <div class="spinner-border text-primary load-form d-none" role="status"></div>
            </div>
          </div> <!-- .row.g-3 -->
        </div> <!-- .card-body.p-4 -->
        
      </div> <!-- .card -->
    </div> <!-- .col-12 -->
  </div> <!-- .row.mb-9 -->
</div> <!-- .content -->