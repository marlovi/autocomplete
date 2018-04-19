// NUMERO TICKET
/////////////////////

SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro` WHERE p.`id_pesagem` = ".$id_pesagem." AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor` AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`




	//OK se existe entrada E true                                     recebe 1 
	//OK se existe entrada e fornecedor                               recebe 12   
	//OK se existe entrada e fornecedor e cliente                     recebe 13 
	//OK se existe entrada e fornecedor e cliente e produto           recebe 14 
	//OK se existe entrada e fornecedor e cliente e produto e placa   recebe 15 
	//OK se existe entrada e fornecedor e cliente e placa             recebe 16 
	//OK se existe entrada e fornecedor e produto                     recebe 17 
	//OK se existe entrada e fornecedor e produto e placa             recebe 18 
	//OK se existe entrada e fornecedor e placa                       recebe 19 
	//OK se existe entrada e cliente                                  recebe 110  
	//OK se existe entrada e cliente e produto                        recebe 111  
	//OK se existe entrada e cliente e produto e placa                recebe 112  
	//OK se existe entrada e cliente e placa                          recebe 113  
	//OK se existe entrada e produto                                  recebe 114  
	//OK se existe entrada e produto e placa                          recebe 115  
	//OK se existe entrada e placa                                    recebe 116 

	//OK se existe saida E true                                     recebe 2
	//OK se existe saida e fornecedor                               recebe 22   
	//OK se existe saida e fornecedor e cliente                     recebe 23 
	//OK se existe saida e fornecedor e cliente e produto           recebe 24 
	//OK se existe saida e fornecedor e cliente e produto e placa   recebe 25
	//OK se existe saida e fornecedor e cliente e placa             recebe 26 
	//OK se existe saida e fornecedor e produto                     recebe 27 
	//OK se existe saida e fornecedor e produto e placa             recebe 28 
	//OK se existe saida e fornecedor e placa                       recebe 29 
	//OK se existe saida e cliente                                  recebe 210  
	//OK se existe saida e cliente e produto                        recebe 211  
	//OK se existe saida e cliente e produto e placa                recebe 212  
	//OK se existe saida e cliente e placa                          recebe 213  
	//OK se existe saida e produto                                  recebe 214  
	//OK se existe saida e produto e placa                          recebe 215  
	//OK se existe saida e placa                                    recebe 216

	//OK se existe entrada e saida E true                                     recebe 3
	//OK se existe entrada e saida e fornecedor                               recebe 32   
	//OK se existe entrada e saida e fornecedor e cliente                     recebe 33 
	//OK se existe entrada e saida e fornecedor e cliente e produto           recebe 34 
	//OK se existe entrada e saida e fornecedor e cliente e produto e placa   recebe 35
	//OK se existe entrada e saida e fornecedor e cliente e placa             recebe 36 
	//OK se existe entrada e saida e fornecedor e produto                     recebe 37 
	//OK se existe entrada e saida e fornecedor e produto e placa             recebe 38 
	//OK se existe entrada e saida e fornecedor e placa                       recebe 39 
	//OK se existe entrada e saida e cliente                                  recebe 310  
	//OK se existe entrada e saida e cliente e produto                        recebe 311  
	//OK se existe entrada e saida e cliente e produto e placa                recebe 312  
//OK se existe entrada e saida e cliente e placa                          recebe 313  

//OK se existe entrada e saida e produto                                  recebe 314  
//OK se existe entrada e saida e produto e placa                          recebe 315  
//OK se existe entrada e saida e placa                                    recebe 316

 ticket                           recebe   considerando que ser  estiver fazio nao vale 

