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


  public function recebeCustoHoraManipulacao()
  {
    
    if ($this->session->userdata('id_empresa') > 1) {
      $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
    }
    
    $query = $this->db->get('ci_custo_hora_manipulacao');

    return $query->row_array();
  }

  public function insereCustoHoraManipulacao($dados)
  {
      $dados['criado_em'] = date('Y-m-d H:i:s');
  
      if ($this->db->insert('ci_custo_hora_manipulacao', $dados)) {
          $this->Log_model->insereLog($this->db->insert_id());
          return true;
      } else {
          // Exibir o último erro caso ocorra falha
          log_message('error', 'Erro ao inserir Custo Hora: ' . $this->db->last_query());
          return false;
      }
  }

  public function atualizaCustoHoraManipulacao($dados)
  {
      $dados['editado_em'] = date('Y-m-d H:i:s');
  
      $this->db->where('id_empresa', $dados['id_empresa']);
  
      if ($this->db->update('ci_custo_hora_manipulacao', $dados)) {
          $this->Log_model->insereLog($this->db->insert_id());
          return true;
      } else {
          log_message('error', 'Erro ao atualizar Custo Hora: ' . $this->db->last_query());
          return false;
      }
  }
}
