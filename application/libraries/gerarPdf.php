<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Mpdf\Mpdf;

class GerarPdf
{
  protected $CI;

  public function __construct()
  {
    $this->CI = &get_instance();
  }

  public function gerarPdfPrecoVenda($dados, $nome_cliente, $contato_cliente, $dadosCondicoesFornecimento)
  {
    $this->CI->load->model('PrecoVenda_model');
    $this->CI->load->model('CondicoesGeraisFornecimento_model');
    $this->CI->load->model('CondicaoPagamento_model');
    
    $data['nome_fantasia'] = $nome_cliente;
    $data['contato'] = $contato_cliente;
    $data['condicoesFornecimento'] = $dadosCondicoesFornecimento;

    $projetosCliente = [];
    foreach ($dados as $dado) {
      $ultima_versao_preco_venda = $this->CI->PrecoVenda_model->recebeUltimaVersaoPrecoVenda($dado['codigo_projeto']);

      $projetosCliente = array_merge($projetosCliente, $this->CI->PrecoVenda_model->recebePrecoVendaProjetosCliente($dado['codigo_projeto'], $dado['versao_projeto'], $ultima_versao_preco_venda));
    }

    $data['condicoesFornecimento']['NOME_CONDICAO_PAGAMENTO'] = $this->CI->CondicaoPagamento_model->recebeCondicaoPagamentoNome($dadosCondicoesFornecimento['id_condicao_pagamento']);
    
    $data['projetosClientes'] = $projetosCliente;

    $mpdf = new \Mpdf\Mpdf(['format' => 'A4', 'orientation' => 'P']);

    $footerHtml = '
          <div style="text-align: center; font-size: 10px;">
              Neander Cosméticos Indústria e Comércio LTDA<br>
              R. Pastor Sebastião André de Oliveira, D-71 - Distrito Industrial - Agudos - SP - CEP 17.123-221<br>
              Email: neander@neandercosmeticos.com.br / Telefone: (14) 3261-7018
          </div>
      ';
    $mpdf->SetHTMLFooter($footerHtml);

    $html = $this->CI->load->view('admin/paginas/preco-venda/preco-venda-pdf', $data, true);
    $mpdf->WriteHTML($html);

    return $mpdf->Output('', \Mpdf\Output\Destination::INLINE);
  }
}
