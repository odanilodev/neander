<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CondicaoPagamento_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Log_model');
  }

  /**
   * Retorna uma lista de condições de pagamento ordenadas pelo nome.
   * 
   * @return array
   */
  public function recebeCondicoesPagamento(): array
  {
    $this->db->order_by('nome');
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $query = $this->db->get('ci_condicao_pagamento');

    return $query->result_array();
  }

  /**
   * Retorna uma condição de pagamento específica pelo ID.
   * 
   * @param int $id
   * @return array
   */
  public function recebeCondicaoPagamento(?int $id): array
  {
    $this->db->where('id', $id);
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $query = $this->db->get('ci_condicao_pagamento');

    return $query->row_array() ?? [];
  }

  /**
   * Retorna uma condição de pagamento específica pelo nome, excluindo um ID específico.
   * 
   * @param string $nome
   * @param int $id
   * @return array
   */
  public function recebeNomeCondicaoPagamento(string $nome, int $id): array
  {
    $this->db->where('nome', $nome);
    $this->db->where('id <>', $id);
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $query = $this->db->get('ci_condicao_pagamento');

    return $query->row_array() ?? [];
  }

  /**
   * Insere uma nova condição de pagamento e registra o log.
   * 
   * @param array $dados
   * @return bool
   */
  public function insereCondicaoPagamento(array $dados): bool
  {
    $dados['criado_em'] = date('Y-m-d H:i:s');

    $this->db->insert('ci_condicao_pagamento', $dados);

    if ($this->db->affected_rows() > 0) {
      $this->Log_model->insereLog($this->db->insert_id());
      return true;
    }

    return false;
  }

  /**
   * Edita uma condição de pagamento existente e registra o log.
   * 
   * @param int $id
   * @param array $dados
   * @return bool
   */
  public function editaCondicaoPagamento(int $id, array $dados): bool
  {
    $dados['editado_em'] = date('Y-m-d H:i:s');

    $this->db->where('id', $id);
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $this->db->update('ci_condicao_pagamento', $dados);

    if ($this->db->affected_rows() > 0) {
      $this->Log_model->insereLog($id);
      return true;
    }

    return false;
  }

  /**
   * Deleta uma condição de pagamento e registra o log.
   * 
   * @param int $id
   * @return bool
   */
  public function deletaCondicaoPagamento(int $id): bool
  {
    $this->db->where('id', $id);
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $this->db->delete('ci_condicao_pagamento');

    if ($this->db->affected_rows() > 0) {
      $this->Log_model->insereLog($id);
      return true;
    }

    return false;
  }
}
