<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PrecoVenda_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Log_model');
    }

    public function recebePrecoVendaProjetosCliente($codigo_projeto,  $versao_projeto, $versao_preco_venda)
    {
        $this->db->select('PVP.total_sem_imposto, PVP.total_unit, PVP.valor_st_estado, P.nome_produto, C.nome_fantasia, PVP.codigo_projeto, PVP.versao_projeto, PVP.lote, PVP.total_st, PVP.versao_preco_venda, PVP.outros');

        // Joins
        $this->db->join('ci_ncm_projeto NP', 'NP.codigo_projeto = PVP.codigo_projeto', 'left');
        $this->db->join('ci_desenvolvimento_projeto DP', 'DP.codigo_projeto = PVP.codigo_projeto', 'left');
        $this->db->join('ci_projetos P', 'P.codigo_projeto = PVP.codigo_projeto', 'left');
        $this->db->join('ci_clientes C', 'C.id = PVP.id_cliente', 'left');

        // Filtros
        $this->db->where('PVP.codigo_projeto', $codigo_projeto);
        $this->db->where('PVP.versao_projeto', $versao_projeto);
        $this->db->where('PVP.versao_preco_venda', $versao_preco_venda);

        // Verifica o id_empresa da sessão, se necessário
        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('PVP.id_empresa', $this->session->userdata('id_empresa'));
        }

        // Consulta
        $consulta = $this->db->get('ci_preco_venda_projeto PVP');

        return $consulta->result_array();
    }

    public function inserePrecoVenda($dados)
    {
        $dados['criado_em'] = date('Y-m-d H:i:s');

        $this->db->insert('ci_preco_venda_projeto', $dados);

        if ($this->db->affected_rows() > 0) {
            $this->Log_model->insereLog($this->db->insert_id());
            return true;
        }

        return false;
    }

    public function recebeUltimaVersaoPrecoVenda($codigo_projeto)
    {
        $this->db->select_max('versao_preco_venda');
        $this->db->where('codigo_projeto', $codigo_projeto);
        $query = $this->db->get('ci_preco_venda_projeto');
        $result = $query->row();

        return $result ? $result->versao_preco_venda : 0;
    }

    public function verificaPrecoVendaExistente($codigo_projeto, $versao_projeto, $id_cliente)
    {
        $this->db->where('codigo_projeto', $codigo_projeto);
        $this->db->where('versao_projeto', $versao_projeto);
        $this->db->where('id_cliente', $id_cliente);

        $query = $this->db->get('ci_preco_venda_projeto');

        return $query->num_rows() > 0;
    }
}
