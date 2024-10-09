function carregaSelect2(classe, modal = null) {
  let select2Options = {
    theme: "bootstrap-5",
  };

  if (modal) {
    select2Options.dropdownParent = $(`#${modal}`);
  }

  $(`.${classe}`).select2(select2Options);
}
