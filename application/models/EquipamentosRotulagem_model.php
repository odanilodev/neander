<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EquipamentosRotulagem_model extends CI_Model
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
  public function recebeEquipamentosRotulagem(): array
  {
    $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    $query = $this->db->get('ci_equipamento_rotulagem');

    return $query->result_array();
  }

  
}
