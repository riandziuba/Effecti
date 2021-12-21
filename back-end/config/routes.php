<?php

 use Riandziuba\Effecti\controller\
 {GetBidding, SiteExtractor, SetRead};
   return [
       '/extract' => SiteExtractor::class,
       '/biddings' => GetBidding::class,
       '/read' => SetRead::class
   ];