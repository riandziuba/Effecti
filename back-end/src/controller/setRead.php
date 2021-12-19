<?php

namespace Riandziuba\Effecti\controller;
use Riandziuba\Effecti\entity\bidding;
use Riandziuba\Effecti\helper\entityManagerFactory;
class setRead implements urlControllerInterface{

    private $entity_manager;
    private $bidding_repository;
    
    public function __construct()
    {
        $this->entity_manager = (new entityManagerFactory())
                ->getEntityManager();
        $this->bidding_repository = $this->entity_manager
            ->getRepository(bidding::class);
    }

    public function requestProcess() : void{
        
        $read = isset($_POST['read'.$_POST['id']])?$_POST['read'.$_POST['id']]:0; 
        $id = isset($_POST['id'])?$_POST['id']:'';
        $bidding = $this->bidding_repository->find($id);
        $bidding->setRead($read);
        $this->entity_manager->merge($bidding);
        $this->entity_manager->flush();
    }
}