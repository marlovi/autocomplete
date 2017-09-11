<?php
// NESSA VERSAO CONSEGUI RENDERIZAR O HTML EM PDF 
// SALVAR O ARQUIVO PDF 
// DEIXAR NA VISUALIZAÇÃO PARA IMPRESSÃO
// Inclui a classe DOMPDF
include_once("dompdf/dompdf_config.inc.php");

/**
 * Gera um arquivo PDF lendo o conteúdo HTML proveniente de uma string
 * @param string $titulo Define o título do arquivo PDF
 * @param string $html A string de origem contendo a strutura HTML a ser convertida para PDF
 * @param string $tipo Define o tipo do documento PDF (P = Retrato ou L = Paisagem
 * @return bool Retorna se o arquivo foi gerado com sucesso ou não
 */
// ISSO FOI FEITO PARA EU VISUALIZAR O ARQUIVO NA PAGINA DE NAVEGAÇÃO
// MAS NAO ESTOU VISUALIZANDO O ARQUIVO CRIADO.


// Html de teste
$html = '
     <!doctype html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>Ticket Pesagem manual</title>
      <style>
         * { font-family: sans-serif; }
         [class*="col-"] {
         position: relative;
         text-align:center;
         border: 1px solid red;
         }
         .col-1 {width: 8.33%;}
         .col-2 {width: 16.66%;}
         .col-3 {width: 25%;}
         .col-4 {width: 33.33%;}
         .col-40 {width: 40%;}
         .col-5 {width: 41.66%;}
         .col-6 {width: 50%;}
         .col-7 {width: 58.33%;}
         .col-8 {width: 66.66%;}
         .col-9 {width: 75%;}
         .col-10 {width: 83.33%;}
         .col-11 {width: 91.66%;}
         .col-12 {width: 100%;}

         [class*="empresa"] {
         position: relative;
         text-align:center;
         word-spacing:0.1em; //espaçamento do texto
         border: 1px solid red;
         width: 40%;
         }

         [class*="assinatura"] {
         position: relative;
         align-items: center;
         text-align:center;
         //word-spacing:0.1em; //espaçamento do texto
         //border: 1px solid red;
         width: 40%;
         }
         [class*="dados"] {
         position: relative;
        // text-align:center;
         font-size: 80%;
         //word-spacing:0.1em; //espaçamento do texto
         //border: 1px solid red;
         width: 40%;
         }

          
      </style>
   </head>
   <!-- versão compacta  style="width: 250px;" --> 
    <body >
   <header class="empresa">
      <h3>TICKET PESAGEM MANUAL </h3>
   </header>
   <div class="empresa">
      <p style="font-size: 140%;""><b >   Balanças Rio Verde </b>    <br> </p>
      <p> Avenida Presidente Vargas qd47 lt07 <br>
         Jardim Presidente - Rio Verde - GO <br>
         Telefone:(64) 3612-4882 <br>
         <b>-----------------------------------------------------</b> <br>
      </p>
   </div>
   <div class="dados">
      <table>
      <tr>
            <td> 
               DATA: 
            </td>
            <td> 
               11/09/2017
            </td>
            <td> 
               12:00:00
            </td>
         </tr>
         <tr>
            <td> 
               PESAGEM NUMERO: 
            </td>
            <td> 
                
            </td>
            <td style="text-align:right;"> 
               1023
            </td>
         </tr>
         <tr>
            <td> 
               TIPO DE OPERAÇÃO: 
            </td>
            <td> 
                
            </td>
            <td style="text-align:right;"> 
               MANUAL
            </td>
         </tr>
         <tr>
            <td> 
               PLACA: 
            </td>
            <td> 
                
            </td>
            <td style="text-align:right;"> 
               SOS-0000
            </td>
         </tr>
         
         
         <tr>
            <td> 
               PRODUTO: 
            </td>
            <td  > 
               01  
            </td>
            <td style="text-align:right;"> 
               SOJA
            </td>
         </tr>
      </table>

<table>
            <tr>
               <td > 
                  PESO ENTRADA: 
               </td>
               <td> 
               </td>
               <td style="text-align:right;"> 
                  12000
               </td>
               <td> 
                  kg   
               </td>
            </tr>
            <tr>
               <td> 
                  PESO SAÍDA:
               </td>
               <td> 
               </td>
               <td style="text-align:right;"> 
                  2000
               </td>
               <td> 
                  kg   
               </td>
            </tr>
            <tr>
               <td> 
                  DESCONTOS:
               </td>
               <td> 
               </td>
               <td style="text-align:right;"> 
                  0000
               </td>
               <td> 
                  kg   
               </td>
            </tr>
            <tr>
               <td> 
                  PESO LIQUIDO:
               </td>
               <td> 
               </td>
               <td style="text-align:right;"> 
                  10000
               </td>
               <td> 
                  kg   
               </td>
            </tr>
         </table>


         <table>
            <tr>
               <td> 
                  CLIENTE: 
               </td>
               <td> 
                  CLIENTE COM O NOME BEM GRANDE
               </td>
            </tr>

            <tr>
               <td> 
                  FORNECEDOR: 
               </td>
               
               <td> 
                  FORNECEDOR COM O NOME GRANDE
               </td>
            </tr>

         </table>


   </div>
   <div class="assinatura">
         <p> <br> <br>
            <sup>______________________</sup> <br>
           <small>ASSINATURA BALANCEIRO: </small>  <br> <br>
         </p>
         <p> <br>
            <sup>______________________</sup> <br>
           <small>  ASSINATURA TRANSPORTADOR:  </small>  <br> <br>
         </p>
      </div>
</body>
</html>
';
/* Cria a instância */
$dompdf1 = new DOMPDF();
/* Carrega seu HTML */
$dompdf1->load_html($html); 

/* Renderiza */
$dompdf1->render();
 
/* Exibe */
$dompdf1->stream(
    "arquivo2.pdf", /* Nome do arquivo de saída */
    array(
        "Attachment" => false /* Para download, altere para true */
    )
);
// FIM DA GAMBIARRA.
// Tenta criar o arquivo PDF
$NUMERO_TICKET = 1221;
$titulo = "TICKET_NUMERO $NUMERO_TICKET .PDF";
toPDF($titulo, $html);

function toPDF($titulo, $html, $tipo = "L") {
    $dompdf = new DOMPDF();

    // Define internamente o tipo do documento
    if ($tipo == "L") {
        $dompdf->set_paper("A4", "landscape");
    }

    // Carrega o $html de entrada para a classe
    $dompdf->load_html($html); 

    // "Renderiza" o conteúdo
    $dompdf->render();

    /* Exibe */
$dompdf->stream(
    "arquivo.pdf", /* Nome do arquivo de saída */
    array(
        "Attachment" => false /* Para download, altere para true */
    )
);

    // Cria e obtém o PDF gerado
    $pdf = $dompdf->output();

    // Define o caminho onde será salvo
    $arquivo = "" . $titulo; 
    return ( file_put_contents($arquivo,$pdf) );
}

?>