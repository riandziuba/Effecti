<?php

namespace Riandziuba\Effecti\controller;
use Riandziuba\Effecti\entity\licitacao;
use Riandziuba\Effecti\helper\entityManagerFactory;
use Riandziuba\Effecti\helper\responseController;
class getLicitacao implements urlControllerInterface{

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
        
        $licitacoes_obj = (array) $this->licitacao_repository->findAll();
    
        foreach ($licitacoes_obj as $licitacao){
            $licitacoes[] = $licitacao->getArrayFormat();
        }
        ResponseController::jsonResponse((array)$licitacoes);
    }
}