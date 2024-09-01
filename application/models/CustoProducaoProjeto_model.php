<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustoProducaoProjeto_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Log_model');
    }


    public function recebeCustoProducaoProjeto($codigo_projeto, $lote_projeto)
    {
    
        $this->db->select([
            'custo_lote_' . $lote_projeto . '_produto',
            'custo_lote_' . $lote_projeto . '_mao_de_obra',
            'custo_lote_' . $lote_projeto . '_embalagem',
            'custo_lote_' . $lote_projeto . '_perda'
        ]);
    
        $this->db->where('codigo_projeto', $codigo_projeto);
        $consulta = $this->db->get('ci_custo_producao_projeto');
        
        return $consulta->row_array();
    }
    
}
