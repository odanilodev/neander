<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MateriasPrimas_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Log_model');
  }

  /**
   * Retorna uma lista de matérias primas ordenadas pelo nome.
   * 
   * @return array
   */
  public function recebeMateriasPrimas(): array
  {
    $this->db->order_by('MP.nome');
    $this->db->select('MP.*, F.nome_fantasia as NOME_FORNECEDOR, F.id');
    $this->db->join('ci_fornecedores F', 'MP.id_fornecedor = F.id');
    $this->db->where('MP.id_empresa', $this->session->userdata('id_empresa'));
    $query = $this->db->get('ci_materias_primas MP');

    return $query->result_array();
  }

  /**
   * Retorna uma matéria prima específica pelo ID.
   * 
   * @param int $id
   * @return array
   */
  public function recebeMateriaPrima(?int $id): array
  {
    $this->db->where('id', $id);
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $query = $this->db->get('ci_materias_primas');

    return $query->row_array() ?? [];
  }

  /**
   * Retorna uma matéria prima específica pelo nome, excluindo um ID específico.
   * 
   * @param string $nome
   * @param int $id
   * @return array
   */
  public function recebeNomeMateriaPrima(string $nome, int $id): array
  {
    $this->db->where('nome', $nome);
    $this->db->where('id <>', $id);
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $query = $this->db->get('ci_materias_primas');

    return $query->row_array() ?? [];
  }

  /**
   * Insere uma nova matéria prima e registra o log.
   * 
   * @param array $dados
   * @return bool
   */
  public function insereMateriaPrima(array $dados): bool
  {
    $dados['criado_em'] = date('Y-m-d H:i:s');

    $this->db->insert('ci_materias_primas', $dados);

    if ($this->db->affected_rows() > 0) {
      $this->Log_model->insereLog($this->db->insert_id());
      return true;
    }

    return false;
  }

  /**
   * Edita uma matéria prima existente e registra o log.
   * 
   * @param int $id
   * @param array $dados
   * @return bool
   */
  public function editaMateriaPrima(int $id, array $dados): bool
  {
    $dados['editado_em'] = date('Y-m-d H:i:s');

    $this->db->where('id', $id);
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $this->db->update('ci_materias_primas', $dados);

    if ($this->db->affected_rows() > 0) {
      $this->Log_model->insereLog($id);
      return true;
    }

    return false;
  }

  /**
   * Deleta uma matéria prima e registra o log.
   * 
   * @param int $id
   * @return bool
   */
  public function deletaMateriaPrima(int $id): bool
  {
    $this->db->where('id', $id);
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $this->db->delete('ci_materias_primas');

    if ($this->db->affected_rows() > 0) {
      $this->Log_model->insereLog($id);
      return true;
    }

    return false;
  }
}
