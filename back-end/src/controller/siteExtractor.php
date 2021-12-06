<?php
    
    namespace Riandziuba\Effecti\controller;
    
    class siteExtractor implements urlControllerInterface{

        function __construct(){
            
        }

        public function requestProcess() : void{
            require_once __DIR__.'/../helper/phpDOM.php'; 
            $html_licitacoes = file_get_html('http://www.ifc-riodosul.edu.br/site/dap/category/licitacoes/');
            foreach($html_licitacoes->find('ul[class=media-list]',0)->find('li[class=media]') as $li){
                
                $a = $li->find('div[class=media-body]',0)->find('h4[class=media-heading]',0)->find('a',0);
                $html_licitacao = file_get_html($a->href);
                $article_tag = $html_licitacao->find('article',0);  
                $titulo = (string) $article_tag->find('div[class=page-subheader]',0)->find('h2',0)->plaintext;
                $div = $article_tag->find('div[class=entry-content]',0);
                foreach($div->find('p') as $cont => $p_tag){
                    switch($cont){
                        case 0:
                            $date = (string) $p_tag->plaintext;
                            break;
                        case 1:
                            $uasg_code = (int) str_replace('Código UASG:', '', $p_tag->plaintext);
                            break;
                        case 2:
                            $object = (string)str_replace('Objeto:', '', $p_tag->plaintext);
                    }
                }
            }
        }
    }