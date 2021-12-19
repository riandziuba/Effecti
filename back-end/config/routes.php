<?php

 use Riandziuba\Effecti\controller\
 {getBidding, siteExtractor, setRead};
   return [
       '/extract' => siteExtractor::class,
       '/biddings' => getBidding::class,
       '/read' => setRead::class
   ];