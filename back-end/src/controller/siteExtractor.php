<?php

namespace Riandziuba\Effecti\controller;

use Riandziuba\Effecti\entity\bidding;
use Riandziuba\Effecti\helper\entityManagerFactory;

class siteExtractor implements urlControllerInterface
{

    private $entity_manager;
    private $bidding_repository;

    public function __construct()
    {
        $this->entity_manager = (new entityManagerFactory())
            ->getEntityManager();
        $this->bidding_repository = $this->entity_manager
        ->getRepository(bidding::class);
    }

    public function requestProcess(): void
    {
        require_once __DIR__ . '/../helper/phpDOM.php';
        $html_biddings = file_get_html('http://www.ifc-riodosul.edu.br/site/dap/category/licitacoes/');
        $number_of_pages = (int) \substr(str_replace('&nbsp', '', $html_biddings->find('ul[class=pagination]', 0)->find('li', -1)->find('a', 0)->href), -3);
        for ($i = 1; $i <= $number_of_pages; $i++) {
            echo $i . '<br>';
            $html_biddings = file_get_html('http://www.ifc-riodosul.edu.br/site/dap/category/licitacoes/page/' . $i . '/');
            foreach ($html_biddings->find('ul[class=media-list]', 0)->find('li[class=media]') as $li) {
                
                $media = $li->find('div[class=media-body]', 0);
                $a = $media->find('h4[class=media-heading]', 0)->find('a', 0);
                $info = $media->find('p[class=info]',0)->plaintext;                
                $modalities_array = $media->find('p[class=categories]',0)->find('a');
                
                foreach($modalities_array as $j => $modality){
                    if($j == 0){
                        $modalities = $modality->plaintext;
                    }else{
                        $modalities .= ', '.$modality->plaintext;
                    }
                }
                $bidding = $this->bidding_repository->findOneBy(array('link' => $a->href ));
                if(!$bidding instanceof bidding){
                    $bidding = new bidding();
                }
                $bidding->setLink($a->href);
                $bidding->setTitle($a->plaintext);
                $bidding->setInfo($info);
                $bidding->setModalities($modalities);

                $this->entity_manager->merge($bidding);
                $this->entity_manager->flush();

            }
        }
    }
}
