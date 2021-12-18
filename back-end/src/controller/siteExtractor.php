<?php

namespace Riandziuba\Effecti\controller;

use Riandziuba\Effecti\entity\licitacao;
use Riandziuba\Effecti\helper\entityManagerFactory;

class siteExtractor implements urlControllerInterface
{

    private $entity_manager;
    private $licitacao_repository;

    public function __construct()
    {
        $this->entity_manager = (new entityManagerFactory())
            ->getEntityManager();
        $this->licitacao_repository = $this->entity_manager
            ->getRepository(licitacao::class);
    }

    public function requestProcess(): void
    {
        require_once __DIR__ . '/../helper/phpDOM.php';
        $html_licitacoes = file_get_html('http://www.ifc-riodosul.edu.br/site/dap/category/licitacoes/');
        $number_of_pages = (int) \substr(str_replace('&nbsp', '', $html_licitacoes->find('ul[class=pagination]', 0)->find('li', -1)->find('a', 0)->href), -3);
        for ($i = 1; $i <= $number_of_pages; $i++) {
            echo $i . '<br>';
            $html_licitacoes = file_get_html('http://www.ifc-riodosul.edu.br/site/dap/category/licitacoes/page/' . $i . '/');
            foreach ($html_licitacoes->find('ul[class=media-list]', 0)->find('li[class=media]') as $li) {
                
                $media = $li->find('div[class=media-body]', 0);
                $a = $media->find('h4[class=media-heading]', 0)->find('a', 0);
                $info = $media->find('p[class=info]')->plaintext;
                $modalities_array = $media->find('p[class=categories')->find('a');
                
                foreach($modalities_array as $j => $modality){
                    if($j == 0){
                        $modalities = $modality->plaintext;
                    }else{
                        $modalities .= ', '.$modality->plaintext;
                    }
                }
                $licitacao = new licitacao();
                $licitacao->setLink($a->href);
                $licitacao->setTitle($a->plaintext);
                $licitacao->setInfo($info);
                $licitacao->setModalities($modalities);

                $this->entity_manager->merge($licitacao);
                $this->entity_manager->flush();

            }
        }
    }
}
