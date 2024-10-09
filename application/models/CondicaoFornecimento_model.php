<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CondicaoFornecimento_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Log_model');
  }

  /**
   * Insere uma nova condição de fornecimento e registra o log.
   * 
   * @param array $dados
   * @return bool
   */
  public function insereCondicaoFornecimento(array $dados): bool
  {
    $dados['criado_em'] = date('Y-m-d H:i:s');

    $this->db->insert('ci_condicoes_gerais_fornecimento_projeto', $dados);

    if ($this->db->affected_rows() > 0) {
      $this->Log_model->insereLog($this->db->insert_id());
      return true;
    }

    return false;
  }
}
