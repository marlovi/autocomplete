 app.config(function($stateProvider, $urlRouterProvider, $locationProvider) {

     var home = {
         name: 'home',
         url: '/home',
         templateUrl: "pages/home.html",
         controller: "homeController"
     }
/////////////////////////////////////////////////////////////////////////
     var cadastrocliente = {
         name: 'cadastrocliente',
         url: '/cliente',
         templateUrl: "pages/cadastrocliente.html",
         controller: "cadastroClienteController"
     }

     var pesquisacliente = {
         name: 'pesquisacliente',
         url: '/pesquisacliente',
         templateUrl: "pages/pesquisacliente.html",
         controller: "pesquisaClienteController"
     }

     var editarcliente = {
         name: 'editarcliente',
         url: '/editarcliente', // endereço visivel ao usuario
         templateUrl: "pages/editarcliente.html",
         controller: "editarClienteController"
     }

     var deletecliente = {
         name: 'deletecliente',
         url: '/deletecliente', // endereço visivel ao usuario
         templateUrl: "pages/deletecliente.html",
         controller: "deleteClienteController"
     }
/////////////////////////////////////////////////////////////////////////
     var cadastroempresa = {
         name: 'cadastroempresa',
         url: '/empresa', // endereço visivel ao usuario
         templateUrl: "pages/cadastroempresa.html", //ok
         controller: "cadastroEmpresaController" //ok
     }

     var pesquisaempresa = {
         name: 'pesquisaempresa',
         url: '/pesquisaempresa',
         templateUrl: "pages/pesquisaempresa.html", //ok
         controller: "pesquisaEmpresaController"   //ok
     }

     var editarempresa = {
         name: 'editarempresa',
         url: '/editarempresa', // endereço visivel ao usuario
         templateUrl: "pages/editarempresa.html", //ok
         controller: "editarEmpresaController"    //ok
     }

     var deleteempresa = {
         name: 'deleteempresa',
         url: '/deleteempresa', // endereço visivel ao usuario
         templateUrl: "pages/deleteempresa.html",  //ok
         controller: "deleteEmpresaController"     //ok
     }
/////////////////////////////////////////////////////////////////////////
 
     var cadastrofornecedor = {
         name: 'cadastrofornecedor',
         url: '/fornecedor', // endereço visivel ao usuario
         templateUrl: "pages/cadastrofornecedor.html",  //ok
         controller: "cadastroFornecedorController"     //ok
     }
     var pesquisafornecedor = {
         name: 'pesquisafornecedor',
         url: '/pesquisafornecedor',
         templateUrl: "pages/pesquisafornecedor.html", //ok 
         controller: "pesquisaFornecedorController"    //ok
     }

     var editarfornecedor = {
         name: 'editarfornecedor',
         url: '/editarfornecedor', // endereço visivel ao usuario
         templateUrl: "pages/editarfornecedor.html",  
         controller: "editarFornecedorController"    //ok  
     }

     var deletefornecedor = {
         name: 'deletefornecedor',
         url: '/deletefornecedor', // endereço visivel ao usuario
         templateUrl: "pages/deletefornecedor.html",   
         controller: "deleteFornecedorController"    //ok   
     }


/////////////////////////////////////////////////////////////////////////

     var cadastroproduto = {
         name: 'cadastroproduto',
         url: '/produto', // endereço visivel ao usuario
         templateUrl: "pages/cadastroproduto.html",
         controller: "cadastroProdutoController"
     }

     var pesquisaproduto = {
         name: 'pesquisaproduto',
         url: '/pesquisaproduto',
         templateUrl: "pages/pesquisaproduto.html",
         controller: "pesquisaProdutoController"
     }

     var editarproduto = {
         name: 'editarproduto',
         url: '/editarproduto', // endereço visivel ao usuario
         templateUrl: "pages/editarproduto.html",
         controller: "editarProdutoController"
     }

     var deleteproduto = {
         name: 'deleteproduto',
         url: '/deleteproduto', // endereço visivel ao usuario
         templateUrl: "pages/deleteproduto.html",
         controller: "deleteProdutoController"
     }
    
///////////////////////////////////////////////////////////////////////// 

var pesagemmanual = {
         name: 'pesagemmanual',
         url: '/pesagemmanual', // endereço visivel ao usuario
         templateUrl: "pages/pesagemmanual.html",
         controller: "pesagemManualController"
         
     }

var pesagementrada = {
         name: 'pesagementrada',
         url: '/pesagementrada', // endereço visivel ao usuario
         templateUrl: "pages/pesagementrada.html",
         controller: "pesagemEntradaController"
         
     }

var pesagemavulsa = {
         name: 'pesagemavulsa',
         url: '/pesagemavulsa', // endereço visivel ao usuario
         templateUrl: "pages/pesagemavulsa.html",
         controller: "pesagemAvulsaController"
         
     }

 

/////////////////////////////////////////////////////////////////////////

     var layoutMeiaPag = {// pesagem manual
         name: 'layoutMeiaPag',
         url: '/impressao', // endereço visivel ao usuario
         templateUrl: "pages/layoutMeiaPag.html",
         controller: "impressaoController"
         
     }

     var layoutMeiaPag_entrada = {// pesagem entrada
         name: 'layoutMeiaPag_entrada',
         url: '/impressao_entrada', // endereço visivel ao usuario
         templateUrl: "pages/layoutMeiaPag_entrada.html",
         controller: "impressaoController"
         
     }

     var layoutMeiaPag_avulsa = {// pesagem avulsa
         name: 'layoutMeiaPag_avulsa',
         url: '/impressao_avulsa', // endereço visivel ao usuario
         templateUrl: "pages/layoutMeiaPag_avulsa.html",
         controller: "impressaoController"
         
     }
/////////////////////////////////////////////////////////////////////////



     $stateProvider.state(home)
         .state(cadastroproduto)
         .state(pesquisaproduto)
         .state(editarproduto)
         .state(deleteproduto)

         .state(cadastrofornecedor)
         .state(pesquisafornecedor)
         .state(editarfornecedor)
         .state(deletefornecedor)

         .state(cadastroempresa)
         .state(pesquisaempresa)
         .state(editarempresa)
         .state(deleteempresa)
         
         .state(cadastrocliente)
         .state(pesquisacliente)
         .state(editarcliente)
         .state(deletecliente)
          
         .state(pesagemmanual)
         .state(pesagementrada)
         .state(pesagemavulsa)

         .state(layoutMeiaPag)
         .state(layoutMeiaPag_entrada)
         .state(layoutMeiaPag_avulsa);


 });