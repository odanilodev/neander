<div class="content">
    <div class="row mb-9">
        <div class="col-12">
            <div class="card shadow-none border border-300 my-4">
                <div class="card-header p-4 border-bottom border-300 bg-soft">
                    <h4 class="text-900 mb-0"><?= $this->uri->segment(3) ? 'Editar Condição de Pagamento' : 'Cadastrar Condição de Pagamento'; ?></h4>
                </div>

                <div class="card-body p-4">
                    <div class="row g-3">
                        <input type="hidden" class="input-id" value="<?= $condicaoPagamento['id'] ?? ''; ?>">

                        <!-- Nome -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Nome</label>
                            <input class="form-control input-nome input-obrigatorio input-nome-condicao-pagamento" type="text" placeholder="Nome da Condição de Pagamento" value="<?= $condicaoPagamento['nome'] ?? ''; ?>">
                            <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                        </div>

                        <!-- Botão Enviar -->
                        <div class="col-12 text-end my-4">
                            <button class="btn btn-phoenix-primary px-6 btn-envia" onclick="cadastraCondicaoPagamento()">
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
