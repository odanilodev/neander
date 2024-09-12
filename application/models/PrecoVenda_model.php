<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PrecoVenda_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Log_model');
    }

    public function recebePrecoVendaProjetosCliente($codigo_projeto, $id_cliente)
    {
        $this->db->select('PVP.total_sem_imposto, PVP.total_unit, PVP.valor_st_estado, P.nome_produto, C.nome_fantasia, PVP.codigo_projeto');
    
        // Joins
        $this->db->join('ci_ncm_projeto NP', 'NP.codigo_projeto = PVP.codigo_projeto', 'left');
        $this->db->join('ci_custo_producao_projeto CPP', 'CPP.codigo_projeto = PVP.codigo_projeto', 'left');
        $this->db->join('ci_projetos P', 'P.codigo_projeto = PVP.codigo_projeto', 'left');
        $this->db->join('ci_clientes C', 'C.id = PVP.id_cliente', 'left');
    
        // Filtros
        $this->db->where('PVP.codigo_projeto', $codigo_projeto);
        $this->db->where('PVP.id_cliente', $id_cliente);
    
        // Verifica o id_empresa da sessão, se necessário
        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('PVP.id_empresa', $this->session->userdata('id_empresa'));
        }
    
        // Consulta
        $consulta = $this->db->get('ci_preco_venda_projeto PVP');
    
        return $consulta->result_array(); // Use result_array() para obter múltiplos resultados
    }
    
}
