<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fornecedores_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Log_model');
  }

  /**
   * Retorna uma lista de fornecedores ordenados pelo nome.
   * 
   * @return array
   */
  public function recebeFornecedores(): array
  {
    $this->db->order_by('nome_fantasia');
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $query = $this->db->get('ci_fornecedores');

    return $query->result_array();
  }

  /**
   * Retorna um fornecedor específico pelo ID.
   * 
   * @param int $id
   * @return array
   */
  public function recebeFornecedor(?int $id): array
  {
    $this->db->where('id', $id);
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $query = $this->db->get('ci_fornecedores');

    return $query->row_array() ?? [];
  }

  /**
   * Retorna um fornecedor específico pelo nome, excluindo um ID específico.
   * 
   * @param string $nome
   * @param int $id
   * @return array
   */
  public function recebeNomeFornecedor(string $nome_fantasia, int $id): array
  {
    $this->db->where('nome_fantasia', $nome_fantasia);
    $this->db->where('id <>', $id);
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $query = $this->db->get('ci_fornecedores');

    return $query->row_array() ?? [];
  }

  /**
   * Insere um novo fornecedor e registra o log.
   * 
   * @param array $dados
   * @return bool
   */
  public function insereFornecedor(array $dados): bool
  {
    $dados['criado_em'] = date('Y-m-d H:i:s');

    $this->db->insert('ci_fornecedores', $dados);

    if ($this->db->affected_rows() > 0) {
      $this->Log_model->insereLog($this->db->insert_id());
      return true;
    }

    return false;
  }

  /**
   * Edita um fornecedor existente e registra o log.
   * 
   * @param int $id
   * @param array $dados
   * @return bool
   */
  public function editaFornecedor(int $id, array $dados): bool
  {
    $dados['editado_em'] = date('Y-m-d H:i:s');

    $this->db->where('id', $id);
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $this->db->update('ci_fornecedores', $dados);

    if ($this->db->affected_rows() > 0) {
      $this->Log_model->insereLog($id);
      return true;
    }

    return false;
  }

  /**
   * Deleta um fornecedor e registra o log.
   * 
   * @param int $id
   * @return bool
   */
  public function deletaFornecedor(int $id): bool
  {
    $this->db->where('id', $id);
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $this->db->delete('ci_fornecedores');

    if ($this->db->affected_rows() > 0) {
      $this->Log_model->insereLog($id);
      return true;
    }

    return false;
  }
}
