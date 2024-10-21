function carregaSelect2(classe, modal = null, disabled = false) {
  let select2Options = {
    theme: "bootstrap-5",
  };

  if (modal) {
    select2Options.dropdownParent = $(`#${modal}`);
  }

  // Inicializa o select2
  $(`.${classe}`).select2(select2Options);

  // Se o parâmetro disabled for true, desabilita o select2
  if (disabled) {
    $(`.${classe}`).prop('disabled', true).select2("enable", false);
  }
}
