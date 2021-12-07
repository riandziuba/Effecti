<?php

namespace Riandziuba\Effecti\controller;
use Riandziuba\Effecti\entity\licitacao;
use Riandziuba\Effecti\helper\entityManagerFactory;

class siteExtractor implements urlControllerInterface{

    private $entity_manager;
    private $licitacao_repository;
    
    public function __construct()
    {
        $this->entity_manager = (new entityManagerFactory())
                ->getEntityManager();
        $this->licitacao_repository = $this->entity_manager
            ->getRepository(licitacao::class);
    }

    public function requestProcess() : void{
        require_once __DIR__.'/../helper/phpDOM.php'; 
        $html_licitacoes = file_get_html('http://www.ifc-riodosul.edu.br/site/dap/category/licitacoes/');
        foreach($html_licitacoes->find('ul[class=media-list]',0)->find('li[class=media]') as $li){
            $date = '';
            $uasg_code = 0;
            $object = '';
            $a = $li->find('div[class=media-body]',0)->find('h4[class=media-heading]',0)->find('a',0);
            $html_licitacao = file_get_html($a->href);
            $article_tag = $html_licitacao->find('article',0);  
            $title = (string) $article_tag->find('div[class=page-subheader]',0)->find('h2',0)->plaintext;
            $div = $article_tag->find('div[class=entry-content]',0);
            foreach($div->find('p') as $cont => $p_tag){
                switch($cont){
                    case 0:
                        $date = (string) $p_tag->plaintext;
                        break;
                    case 1:
                        $uasg_code = (int) \substr(str_replace('&nbsp;', '', $p_tag->plaintext),13);
                        break;
                    case 2:
                        $object = (string) str_replace('Objeto:&nbsp', '', $p_tag->plaintext);
                }
            }
            if($uasg_code > 0){
                $licitacao = new licitacao();
                $licitacao->setLink($a->href);
                $licitacao->setTitle('AA'.$title);
                $licitacao->setDate($date);
                $licitacao->setUasg_code($uasg_code);
                $licitacao->setObject($object);
                
                $this->entity_manager->merge($licitacao );
                $this->entity_manager->flush();
            }
        }
    }
}