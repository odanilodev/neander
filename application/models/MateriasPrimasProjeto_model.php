<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MateriasPrimasProjeto_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Log_model');
  }

  public function insereMateriaPrimaProjeto( array $dados): bool
  {
    $dados['criado_em'] = date('Y-m-d H:i:s');

    $this->db->insert('ci_materia_prima_projeto', $dados);

    if ($this->db->affected_rows() > 0) {
      $this->Log_model->insereLog($this->db->insert_id());
      return true;
    }

    return false;
  }


}
