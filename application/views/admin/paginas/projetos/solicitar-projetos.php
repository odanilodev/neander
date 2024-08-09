<div class="content">

  <div class="row mb-9">
    <div class="col-12 col-xxl-12">
      <div class="card shadow-none my-4" data-component-card="data-component-card">

        <div class="card-header p-4 bg-soft">
          <div class="row g-3 justify-content-between align-items-center">
            <div class="col-12 col-md">
              <h4 class="text-900 mb-0" data-anchor="data-anchor" id="with-validation">Cadastrar Projeto<a class="anchorjs-link " aria-label="Anchor" style="padding-left: 0.375em;"></a></h4>
            </div>
          </div>
        </div>
        <div class="card-body p-0">

          <div class="p-0 border-0 code-to-copy" id="with-validation-code">
            <div class="card theme-wizard mb-5" data-theme-wizard="data-theme-wizard">
              <div class="card-header bg-100 pt-3 pb-2 border-bottom-0">
                <ul class="nav justify-content-between nav-wizard">

                  <li class="nav-item">
                    <a class="nav-link active fw-semi-bold btn-etapas" href="#bootstrap-wizard-tab1" data-bs-toggle="tab" data-wizard-step="1">
                      <div class="text-center d-inline-block">
                        <span class="nav-item-circle-parent">
                          <span class="nav-item-circle">
                            <span class="fas fa-info-circle"></span>
                          </span>
                        </span>
                        <span class="d-none d-md-block mt-1 fs--1">Informações</span>
                      </div>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link fw-semi-bold btn-etapas" href="#bootstrap-wizard-tab2" data-bs-toggle="tab" data-wizard-step="2">
                      <div class="text-center d-inline-block">
                        <span class="nav-item-circle-parent">
                          <span class="nav-item-circle">
                            <span class="fas fa-pen-square"></span>
                          </span>
                        </span>
                        <span class="d-none d-md-block mt-1 fs--1">Briefing</span>
                      </div>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link fw-semi-bold btn-responsavel btn-etapas" href="#bootstrap-wizard-tab3" data-bs-toggle="tab" data-wizard-step="3">
                      <div class="text-center d-inline-block">
                        <span class="nav-item-circle-parent">
                          <span class="nav-item-circle">
                            <span class="fas fa-money-check-alt"></span>
                          </span>
                        </span>
                        <span class="d-none d-md-block mt-1 fs--1">Custos</span>
                      </div>
                    </a>
                  </li>


                  <li class="nav-item">
                    <a class="nav-link fw-semi-bold btn-etapas" href="#bootstrap-wizard-tab4" data-bs-toggle="tab" data-wizard-step="4" onclick="cadastraProjeto()">
                      <div class="text-center d-inline-block">
                        <span class="nav-item-circle-parent">
                          <span class="nav-item-circle">
                            <span class="fas fa-check"></span>
                          </span>
                        </span>
                        <span class="d-none d-md-block mt-1 fs--1">Finalizar</span>
                      </div>
                    </a>
                  </li>

                </ul>
              </div>

              <div class="card-body pt-4 pb-0">
                <div class="tab-content">
                  <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-wizard-tab1" id="bootstrap-wizard-tab1">

                    <input type="hidden" value="<?= isset($cliente['id']) ? $cliente['id'] : "" ?>" class="input-id">

                    <form id="form-informacoes" class="needs-validation" novalidate="novalidate" data-wizard-form="1">

                      <div class="row">

                        <div class="mb-2 mt-2 col-md-4">
                          <label class="form-label text-900">Nome da marca *</label>
                          <input required class="form-control campo-informacoes" type="text" name="nome_marca" placeholder="Insira o nome da marca" />
                          <div class="invalid-feedback">Preencha este campo</div>
                        </div>

                        <div class="mb-2 mt-2 col-md-4">
                          <label class="form-label">Mercado Alvo *</label>
                          <input required class="form-control campo-informacoes" type="text" name="mercado_alvo" placeholder="Insira o mercado Alvo" />
                          <div class="invalid-feedback">Preencha este campo</div>
                        </div>

                        <div class="mb-2 mt-2 col-md-4">
                          <label class="form-label text-900">Associar concorrentes</label>
                          <input class="form-control campo-informacoes" type="text" name="associar_concorrentes" placeholder="Concorrentes" />

                        </div>

                        <div class="mb-2 mt-5 col-md-3">
                          <div class="form-check form-switch">
                            <input name="cliente_fornecera_embalagens" class="form-check-input campo-informacoes" type="checkbox" id="cliente_fornecera_embalagem">
                            <label class="form-check-label" for="cliente_fornecera_embalagem">Cliente fornecerá embalagens</label>
                          </div>
                        </div>

                        <div class="mb-2 mt-5 col-md-3">

                          <div class="form-check form-switch">
                            <input name="cliente_fornecera_materia_prima" class="form-check-input campo-informacoes" type="checkbox" id="cliente_fornecera_materia_prima">
                            <label class="form-check-label" for="cliente_fornecera_materia_prima">Cliente fornecerá matéria-prima</label>
                          </div>

                        </div>

                        <div class="mb-2 mt-5 col-md-3">
                          <div class="form-check form-switch">
                            <input name="cliente_fornecera_rotulos" class="form-check-input campo-informacoes" type="checkbox" id="cliente-fornecera-rotulos">
                            <label class="form-check-label" for="cliente-fornecera-rotulos">Cliente fornecerá rótulos</label>
                          </div>
                        </div>

                        <div class="mb-2 mt-5 col-md-3">
                          <div class="form-check form-switch">
                            <input name="cliente_fornecera_caixas_embarque" class="form-check-input campo-informacoes" type="checkbox" id="cliente-fornecera-caixas">
                            <label class="form-check-label" for="cliente-fornecera-caixas">Cliente fornecerá caixas de embarque</label>
                          </div>
                        </div>

                        <!-- Observação Informações -->
                        <div class="col-md-12 mb-3">
                          <label class="form-label">Observação Informações</label>
                          <textarea name="observacao_info"class="form-control input-observacao-info input-obrigatorio campo-informacoes" rows="3" placeholder="Digite aqui a descrição"><?= $materiaPrima['observacao_info'] ?? ''; ?></textarea>
                          <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                        </div>


                      </div>
                    </form>
                  </div>

                  <div class="tab-pane" role="tabpanel" aria-labelledby="bootstrap-wizard-tab2" id="bootstrap-wizard-tab2">
                    <form id="form-briefing" class="needs-validation" novalidate="novalidate" data-wizard-form="2">

                      <div class="row">

                        <div class="mb-2 mt-2 col-md-3">
                          <label class="form-label">Nome do produto *</label>
                          <input required class="form-control campo-briefing" type="text" name="nome_produto" placeholder="Nome do produto">
                          <div class="invalid-feedback">Preencha este campo</div>
                        </div>

                        <div class="mb-2 mt-2 col-md-3">
                          <label class="form-label">Tipo da embalagem *</label>
                          <select required class="form-control campo-briefing select2" name="tipo_embalagem">
                            <option value="" disabled selected>Selecione o tipo da embalagem</option>
                            <?php foreach ($tiposEmbalagem as $tipoEmbalagem) : ?>
                              <option value="<?= $tipoEmbalagem['id']; ?>">
                                <?= $tipoEmbalagem['nome']; ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                          <div class="invalid-feedback">Preencha este campo</div>
                        </div>

                        <div class="mb-2 mt-2 col-md-3">
                          <label class="form-label">Tipo da tampa *</label>
                          <select required class="form-control campo-briefing select2" name="tipo_tampa">
                            <option value="" disabled selected>Selecione o tipo da tampa</option>
                            <?php foreach ($tiposTampa as $tipoTampa) : ?>
                              <option value="<?= $tipoTampa['id']; ?>">
                                <?= $tipoTampa['nome']; ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                          <div class="invalid-feedback">Preencha este campo</div>
                        </div>


                        <div class="mb-2 col-md-3 mt-2">
                          <label class="form-label">Volumetria *</label>
                          <input required class="form-control campo-briefing" type="text" name="volumetria" placeholder="Volumetria">
                          <div class="invalid-feedback">Preencha este campo</div>
                        </div>

                        <div class="mb-2 col-md-3 mt-3">
                          <label class="form-label">Apelo do rotulo *</label>
                          <input required class="form-control campo-briefing" type="text" name="apelo_rotulo" placeholder="Apelo do rotulo">
                          <div class="invalid-feedback">Preencha este campo</div>
                        </div>

                        <div class="mb-2 col-md-3 mt-3">
                          <label class="form-label">Ativos do produto *</label>
                          <input required class="form-control campo-briefing" type="text" name="ativos_produto" placeholder="Ativos do produto">
                          <div class="invalid-feedback">Preencha este campo</div>
                        </div>

                        <div class="mb-2 col-md-3 mt-3">
                          <label class="form-label">Cor *</label>
                          <input class="form-control campo-briefing" type="text" name="cor" placeholder="Cor">
                          <div class="invalid-feedback">Preencha este campo</div>

                        </div>

                        <div class="mb-2 col-md-3 mt-3">
                          <label class="form-label">Fragrância *</label>
                          <input class="form-control campo-briefing" type="text" name="fragrancia" placeholder="Fragrância">
                          <div class="invalid-feedback">Preencha este campo</div>
                        </div>

                        <!-- Observação Briefing -->
                        <div class="col-md-12 mb-3">
                          <label class="form-label">Observação Briefing</label>
                          <textarea name="observacao_briefing" class="campo-briefing form-control input-observacao-briefing input-obrigatorio" rows="3" placeholder="Digite aqui a observação"><?= $materiaPrima['observacao_briefing'] ?? ''; ?></textarea>
                          <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                        </div>

                      </div>
                    </form>
                  </div>

                  <div class="tab-pane" role="tabpanel" aria-labelledby="bootstrap-wizard-tab3" id="bootstrap-wizard-tab3">

                    <form class="mb-2 needs-validation" id="form-custos" novalidate="novalidate" data-wizard-form="3">

                      <div class="row gx-3 gy-2">

                        <div class="col-md-4">
                          <label class="form-label">Produto</label>
                          <input class="form-control campo-custos" placeholder="Custo do produto" name="custo_cliente_produto" type="text" />
                        </div>

                        <div class="col-md-4">
                          <label class="form-label">Embalagens</label>
                          <input class="form-control campo-custos" placeholder="Custo da embalagem" name="custo_cliente_embalagens" type="text" />
                        </div>

                        <div class="col-md-4">
                          <label class="form-label">Rótulos</label>
                          <input class="form-control campo-custos" placeholder="Custo do Rótulo" name="custo_cliente_rotulos" type="text" />
                        </div>

                      </div>

                      <!-- Observação Custos -->
                      <div class="col-md-12 mb-3">
                        <label class="form-label">Observação Custos</label>
                        <textarea name="observacao_custo" class="campo-custos form-control input-observacao-custo input-obrigatorio" rows="3" placeholder="Digite aqui a observação"><?= $materiaPrima['observacao_custo'] ?? ''; ?></textarea>
                        <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                      </div>

                    </form>

                  </div>

                  <div class="tab-pane d-none" role="tabpanel" aria-labelledby="bootstrap-wizard-tab4" id="bootstrap-wizard-tab4">
                    <div class="row flex-center pb-8 pt-4 gx-3 gy-4">
                      <div data-bds-toggle="tab" data-wizard-step="1">
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <div class="card-footer border-top-0" data-wizard-footer="data-wizard-footer">
                <div class="d-flex pager wizard list-inline mb-0">
                  <button class="d-none btn btn-link ps-0 bnt-voltar" type="button" data-wizard-prev-btn="data-wizard-prev-btn">
                    <span class="fas fa-chevron-left me-1" data-fa-transform="shrink-3"></span>Voltar
                  </button>
                  <div class="flex-1 text-end">
                    <button class="btn btn-primary px-6 px-sm-6 btn-proximo" type="submit" data-wizard-next-btn="data-wizard-next-btn">
                      Próximo <span class="fas fa-chevron-right ms-1" data-fa-transform="shrink-3"> </span>
                    </button>
                  </div>
                </div>

                <div class="spinner-border text-primary load-form d-none" role="status"></div>
                <input class="input-id-cliente" type="hidden" value="<?= $this->uri->segment(3) ?>">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>