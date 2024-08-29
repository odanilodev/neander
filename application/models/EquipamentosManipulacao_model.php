<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EquipamentosManipulacao_model extends CI_Model
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
  public function recebeEquipamentosManipulacao(): array
  {
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $query = $this->db->get('ci_equipamento_manipulacao');

    return $query->result_array();
  }

  public function recebeEquipamentosManipulacaoPorNivel($nivel)
  {
      $this->db->where('nivel', $nivel);
      $consulta = $this->db->get('ci_equipamento_manipulacao');
      return $consulta->result_array();
  }

  

}
