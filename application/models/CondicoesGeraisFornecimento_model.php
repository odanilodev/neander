<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CondicoesGeraisFornecimento_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Log_model');
    }


    public function recebeCondicoesFornecimentoProjeto($codigo_projeto)
    {
        $this->db->select('CGFP.*, CP.nome AS NOME_CONDICAO_PAGAMENTO');


        $this->db->from('ci_condicoes_gerais_fornecimento_projeto CGFP');
        $this->db->join('ci_condicao_pagamento CP', 'CP.id = CGFP.id_condicao_pagamento', 'left');
        $this->db->where('CGFP.codigo_projeto', $codigo_projeto);


        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('CGFP.id_empresa', $this->session->userdata('id_empresa'));
        }

        $consulta = $this->db->get();

        return $consulta->row_array();
    }
}
