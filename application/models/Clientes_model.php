<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clientes_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Log_model');
  }

  /**
   * Retorna uma lista de clientes ordenados pelo nome.
   * 
   * @return array
   */
  public function recebeClientes($cookie_filtro_clientes = null, $limit = null, $page = null, $count = null)
  {
    if (isset($cookie_filtro_clientes)) {
      $filtro = json_decode($cookie_filtro_clientes, true);
    }

    $this->db->select('C.*');
    $this->db->from('ci_clientes C');
    $this->db->where('C.id_empresa', $this->session->userdata('id_empresa'));

    // Ajuste no filtro de status
    if (isset($filtro['status']) && $filtro['status'] !== 'all') {
      $this->db->where('C.status', $filtro['status']);
    }

    if (isset($filtro['cidade']) && $filtro['cidade'] !== 'all') {
      $this->db->where('C.cidade', $filtro['cidade']);
    }

    if (isset($filtro['nome_fantasia']) && !empty($filtro['nome_fantasia'])) {
      $this->db->group_start();
      $this->db->like('C.nome_fantasia', $filtro['nome_fantasia']);
      $this->db->or_like('C.contato', $filtro['nome_fantasia']);
      $this->db->or_like('C.email', $filtro['nome_fantasia']);
      $this->db->group_end();
    }

    $this->db->order_by('C.status, C.nome_fantasia', 'ASC');

    if (!$count) {
      $offset = ($page - 1) * $limit;
      $this->db->limit($limit, $offset);
    }

    $this->db->group_by('C.id');

    $query = $this->db->get();

    if ($count) {
      return $query->num_rows();
    }

    return $query->result_array();
  }



  /**
   * Retorna um cliente específico pelo ID.
   * 
   * @param int $id
   * @return array
   */
  public function recebeCliente(?int $id): array
  {
    $this->db->where('id', $id);
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $query = $this->db->get('ci_clientes');

    return $query->row_array() ?? [];
  }

  public function recebeCidadesCliente()
  {
    $this->db->select('cidade');
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $this->db->order_by('cidade');
    $this->db->group_by('cidade');
    $query = $this->db->get('ci_clientes');
    return $query->result_array();
  }

  /**
   * Retorna um cliente específico pelo nome, excluindo um ID específico.
   * 
   * @param string $nome
   * @param int $id
   * @return array
   */
  public function recebeNomeCliente(string $razao_social, int $id): array
  {
    $this->db->where('razao_social', $razao_social);
    $this->db->where('id <>', $id);
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $query = $this->db->get('ci_clientes');

    return $query->row_array() ?? [];
  }

  /**
   * Insere um novo cliente e registra o log.
   * 
   * @param array $dados
   * @return bool
   */
  public function insereCliente(array $dados): bool
  {
    $dados['criado_em'] = date('Y-m-d H:i:s');

    $this->db->insert('ci_clientes', $dados);

    if ($this->db->affected_rows() > 0) {
      $this->Log_model->insereLog($this->db->insert_id());
      return true;
    }

    return false;
  }

  /**
   * Edita um cliente existente e registra o log.
   * 
   * @param int $id
   * @param array $dados
   * @return bool
   */
  public function editaCliente(int $id, array $dados): bool
  {
    $dados['editado_em'] = date('Y-m-d H:i:s');

    $this->db->where('id', $id);
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $this->db->update('ci_clientes', $dados);

    if ($this->db->affected_rows() > 0) {
      $this->Log_model->insereLog($id);
      return true;
    }

    return false;
  }

  /**
   * Deleta um cliente e registra o log.
   * 
   * @param int $id
   * @return bool
   */
  public function deletaCliente(int $id): bool
  {
    $this->db->where('id', $id);
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $this->db->delete('ci_clientes');

    if ($this->db->affected_rows() > 0) {
      $this->Log_model->insereLog($id);
      return true;
    }

    return false;
  }
}
