<?php

 use Riandziuba\Effecti\controller\
 {getLicitacao, siteExtractor};
   return [
       '/extract' => siteExtractor::class,
       '/licitacoes' => getLicitacao::class
   ];