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
            'CPP.custo_lote_' . $lote_projeto . '_produto',
            'CPP.custo_lote_' . $lote_projeto . '_mao_de_obra',
            'CPP.custo_lote_' . $lote_projeto . '_embalagem',
            'CPP.custo_lote_' . $lote_projeto . '_perda',
            'NP.codigo_ncm',
            'NP.descricao_ncm'
        ]);

        $this->db->join('ci_ncm_projeto NP', 'NP.codigo_projeto = CPP.codigo_projeto', 'left');

        $this->db->where('CPP.codigo_projeto', $codigo_projeto);
        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('CPP.id_empresa', $this->session->userdata('id_empresa'));
        }

        $consulta = $this->db->get('ci_custo_producao_projeto CPP');

        return $consulta->row_array();
    }
}
