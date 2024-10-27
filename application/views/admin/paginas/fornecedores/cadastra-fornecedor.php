<div class="content">
  <div class="row mb-9">
    <div class="col-12">
      <div class="card shadow-none border border-300 my-4">
        <div class="card-header p-4 border-bottom border-300 bg-soft">
          <h4 class="text-900 mb-0"><?= $this->uri->segment(3) ? 'Editar Fornecedor' : 'Cadastrar Fornecedor'; ?></h4>
        </div>

        <div class="card-body p-4">
          <div class="row g-3">
            <input type="hidden" class="input-id" value="<?= $fornecedor['id'] ?? ''; ?>">
            <h5 class="text-900">Informações Gerais</h5>

            <!-- Razão Social -->
            <div class="col-md-3 mb-3">
              <label class="form-label">Razão Social</label>
              <input class="form-control input-razao-social input-obrigatorio" type="text" placeholder="Razão Social" autocomplete="off" value="<?= $fornecedor['razao_social'] ?? ''; ?>">
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <!-- Nome Fantasia -->
            <div class="col-md-3 mb-3">
              <label class="form-label">Nome Fantasia</label>
              <input class="form-control input-nome-fantasia input-obrigatorio" type="text" placeholder="Nome Fantasia" autocomplete="off" value="<?= $fornecedor['nome_fantasia'] ?? ''; ?>">
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <!-- CNPJ -->
            <div class="col-md-3 mb-3">
              <label class="form-label">CNPJ</label>
              <input class="form-control input-cnpj input-obrigatorio mascara-cnpj" type="text" placeholder="CNPJ" autocomplete="off" value="<?= $fornecedor['cnpj'] ?? ''; ?>">
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <!-- Contato Pessoa -->
            <div class="col-md-3 mb-3">
              <label class="form-label">Contato Pessoa</label>
              <input class="form-control input-contato-pessoa input-obrigatorio" type="text" placeholder="Contato Pessoa" autocomplete="off" value="<?= $fornecedor['contato'] ?? ''; ?>">
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <!-- Telefone -->
            <div class="col-md-3 mb-3">
              <label class="form-label">Telefone</label>
              <input class="form-control input-telefone input-obrigatorio mascara-tel" type="text" placeholder="Telefone" autocomplete="off" value="<?= $fornecedor['telefone'] ?? ''; ?>">
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <!-- Email -->
            <div class="col-md-3 mb-3">
              <label class="form-label">Email</label>
              <input class="form-control input-email input-obrigatorio" type="email" placeholder="Email" autocomplete="off" value="<?= $fornecedor['email'] ?? ''; ?>">
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <hr>
            <h5 class="text-900">Endereço</h5>

            <!-- CEP -->
            <div class="col-md-3 mb-3">
              <label class="form-label">CEP *</label>
              <input name="cep" class="form-control input-cep input-obrigatorio mascara-cep" type="text" placeholder="CEP" autocomplete="off" value="<?= $fornecedor['cep'] ?? ''; ?>">
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <!-- RUA -->
            <div class="col-md-3 mb-3">
              <label class="form-label">Rua *</label>
              <input class="form-control input-rua input-obrigatorio" type="text" placeholder="Rua" autocomplete="off" value="<?= $fornecedor['rua'] ?? ''; ?>">
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <!-- NUMERO -->
            <div class="col-md-3 mb-3">
              <label class="form-label">Número *</label>
              <input class="form-control input-numero" type="text" placeholder="Número" autocomplete="off" value="<?= $fornecedor['numero'] ?? ''; ?>">
            </div>

            <!-- BAIRRO -->
            <div class="col-md-3 mb-3">
              <label class="form-label">Bairro *</label>
              <input class="form-control input-bairro input-obrigatorio" type="text" placeholder="Bairro" autocomplete="off" value="<?= $fornecedor['bairro'] ?? ''; ?>">
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <!-- CIDADE -->
            <div class="col-md-3 mb-3">
              <label class="form-label">Cidade *</label>
              <input class="form-control input-cidade input-obrigatorio" type="text" placeholder="Cidade" autocomplete="off" value="<?= $fornecedor['cidade'] ?? ''; ?>">
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <!-- ESTADO -->
            <div class="col-md-3 mb-3">
              <label class="form-label">Estado *</label>
              <input class="form-control input-estado input-obrigatorio" type="text" placeholder="Estado" autocomplete="off" value="<?= $fornecedor['estado'] ?? ''; ?>">
              <div class="d-none aviso-obrigatorio">Preencha este campo</div>
            </div>

            <!-- COMPLEMENTO -->
            <div class="col-md-3 mb-3">
              <label class="form-label">Complemento</label>
              <input class="form-control input-complemento" type="text" placeholder="Complemento" autocomplete="off" value="<?= $fornecedor['complemento'] ?? ''; ?>">
            </div>

            <!-- Botão Enviar -->
            <div class="col-12 text-end my-4">
              <button class="btn btn-phoenix-primary px-6 btn-envia" onclick="cadastraFornecedor()">
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
