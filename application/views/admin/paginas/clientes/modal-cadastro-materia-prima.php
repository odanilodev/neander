  <!-- Modal Custo Produtivo -->
  <div class="modal fade" id="modalCadastroMateriaPrima" tabindex="-1" aria-labelledby="modalCadastroMateriaPrima" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 800px;">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="modalCadastroMateriaPrimaLabel">Cadastrar Nova Matéria Prima</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" style="overflow-x:hidden;">
                  <div class="card mb-5">
                      <div class="card-body p-4">
                          <div class="row g-3">

                              <!-- Nome -->
                              <div class="col-md-4 mb-3">
                                  <label class="form-label">Nome</label>
                                  <input class="form-control input-nome input-obrigatorio" type="text" placeholder="Nome da Matéria Prima">
                                  <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                              </div>

                              <!-- I.N.C.I -->
                              <div class="col-md-4 mb-3">
                                  <label class="form-label">I.N.C.I</label>
                                  <input class="form-control input-inci input-obrigatorio" type="text" placeholder="INCI da Matéria Prima">
                                  <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                              </div>

                              <!-- CAS Number -->
                              <div class="col-md-4 mb-3">
                                  <label class="form-label">CAS Number</label>
                                  <input class="form-control input-cas-number input-obrigatorio" type="text" placeholder="CAS Number da Matéria Prima">
                                  <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                              </div>

                              <!-- Valor R$ -->
                              <div class="col-md-4 mb-3">
                                  <label class="form-label">Valor R$</label>
                                  <input class="form-control input-valor input-obrigatorio mascara-dinheiro" type="text" placeholder="Valor da Matéria Prima">
                                  <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                              </div>

                              <!-- Fornecedor -->
                              <div class="col-md-4 mb-3">
                                  <label class="form-label">Fornecedor</label>
                                  <select class="form-control select-fornecedor input-obrigatorio select2" name="fornecedor" required>
                                      <option value="" disabled selected>Selecione o fornecedor</option>
                                      <?php foreach ($fornecedores as $fornecedor) : ?>
                                          <option value="<?= $fornecedor['id']; ?>">
                                              <?= $fornecedor['nome_fantasia']; ?>
                                          </option>
                                      <?php endforeach; ?>
                                  </select>
                                  <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                              </div>

                              <!-- Composição em Português -->
                              <div class="col-md-6 mb-3">
                                  <label class="form-label">Composição em Português</label>
                                  <textarea class="form-control input-composicao-ptbr input-obrigatorio" rows="3" placeholder="Digite aqui a composição"></textarea>
                                  <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                              </div>

                              <!-- Descrição -->
                              <div class="col-md-6 mb-3">
                                  <label class="form-label">Descrição</label>
                                  <textarea class="form-control input-descricao input-obrigatorio" rows="3" placeholder="Digite aqui a descrição"></textarea>
                                  <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                              </div>


                          </div> <!-- .row.g-3 -->
                      </div> <!-- .card-body.p-4 -->

                  </div>

              </div>
              <div class="modal-footer">
                  <div class="col-12 text-end">
                      <button class="btn btn-phoenix-primary px-6 btn-envia" onclick="cadastraMateriaPrima()">
                          Cadastrar
                          <span class="fas fa-chevron-right" data-fa-transform="shrink-3"></span>
                      </button>
                      <div class="spinner-border text-primary load-form d-none" role="status"></div>
                  </div>
              </div>
          </div>
      </div>
  </div>