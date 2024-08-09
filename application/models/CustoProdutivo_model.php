<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustoProdutivo_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Log_model');
  }

  /**
   * Insere um novo custo produtivo 
   * 
   * @param array $dados
   * @return bool
   */
  public function insereCustoProdutivo(int $id, string $tipo, array $dados): bool
  {
    $dados['editado_em'] = date('Y-m-d H:i:s');
    $this->db->where('id', $id);
    $this->db->update('ci_equipamento_' . $tipo, $dados);

    if ($this->db->affected_rows() > 0) {
      return true;
    }

    return false;
  }
}
