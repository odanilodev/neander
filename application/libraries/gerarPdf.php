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

  public function gerarPdfPrecoVenda($dados)
  {
      $this->CI->load->model('Clientes_model');
      $this->CI->load->model('PrecoVenda_model');
      $this->CI->load->model('CondicoesGeraisFornecimento_model');
  
      $clienteId = $dados['precoVenda'][0]['idCliente'];
      $data['cliente'] = $this->CI->Clientes_model->recebeCliente($clienteId);
  
      $projetosCliente = [];
      foreach ($dados['precoVenda'] as $dado) {
          $projetosCliente = array_merge($projetosCliente, $this->CI->PrecoVenda_model->recebePrecoVendaProjetosCliente($dado['codigoProjeto'], $clienteId));
      }
  
      $data['projetosClientes'] = $projetosCliente;
  
      // Assumindo que o código do projeto para as condições de fornecimento é o primeiro no array
      $codigoProjeto = isset($projetosCliente[0]['codigo_projeto']) ? $projetosCliente[0]['codigo_projeto'] : '';
      // $data['condicaoFornecimento'] = $this->CI->CondicoesGeraisFornecimento_model->recebeCondicoesFornecimentoProjeto($codigoProjeto);
  
      // Adiciona os dados das condições de fornecimento
      $data['condicoesFornecimento'] = $dados['condicoesFornecimento'];
      
  
      $mpdf = new \Mpdf\Mpdf(['format' => 'A4', 'orientation' => 'P']);
  
      $footerHtml = '
          <div style="text-align: center; font-size: 10px;">
              Neander Cosméticos Indústria e Comércio LTDA<br>
              R. Pastor Sebastião André de Oliveira, D-71 - Distrito Industrial - Agudos - SP - CEP 17.123-221<br>
              Email: neander@neandercosmeticos.com.br / Telefone: (14) 3261-7018
          </div>
      ';
      $mpdf->SetHTMLFooter($footerHtml);
  

      // Carrega a view e passa os dados para ela
      $html = $this->CI->load->view('admin/paginas/preco-venda/preco-venda-pdf', $data, true);
      $mpdf->WriteHTML($html);
  
      return $mpdf->Output('', \Mpdf\Output\Destination::INLINE);
  }
  
}
