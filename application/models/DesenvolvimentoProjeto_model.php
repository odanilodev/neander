<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DesenvolvimentoProjeto_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Log_model');
    }


    public function recebeDesenvolvimentoProjeto($codigo_projeto)
    {

        $this->db->select([
            'P.nome_produto',
            'DP.lote_partida',
            'DP.lote_partida_produto',
            'DP.lote_partida_mao_de_obra',
            'DP.lote_partida_embalagem',
            'DP.lote_partida_perda',
            'DP.custo_final_outros',
            'NP.codigo_ncm',
            'NP.descricao_ncm'
        ]);

        $this->db->join('ci_ncm_projeto NP', 'NP.codigo_projeto = DP.codigo_projeto', 'left');
        $this->db->join('ci_projetos P', 'P.codigo_projeto = DP.codigo_projeto', 'left');

        $this->db->where('DP.codigo_projeto', $codigo_projeto);
        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('DP.id_empresa', $this->session->userdata('id_empresa'));
        }

        $consulta = $this->db->get('ci_desenvolvimento_projeto DP');

        return $consulta->row_array();
    }


}
