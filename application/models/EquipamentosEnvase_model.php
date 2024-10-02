<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EquipamentosEnvase_model extends CI_Model
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
  public function recebeEquipamentosEnvase(): array
  {
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $query = $this->db->get('ci_equipamento_envase');

    return $query->result_array();
  }

  public function recebeEquipamentosEnvasePorNivel($nivel)
  {
    $this->db->where('nivel', $nivel);
    $consulta = $this->db->get('ci_equipamento_envase');

    return $consulta->result_array();
  }

  public function recebeDadosEquipamentoEnvase($id_equipamento)
  {
    $this->db->where('id', $id_equipamento);
    $consulta = $this->db->get('ci_equipamento_envase');

    return $consulta->row_array();
  }
}
