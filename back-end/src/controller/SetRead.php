<?php

namespace Riandziuba\Effecti\controller;
use Riandziuba\Effecti\entity\Bidding;
use Riandziuba\Effecti\helper\EntityManagerFactory;
class SetRead implements UrlControllerInterface{

    private $entity_manager;
    private $bidding_repository;
    
    public function __construct() {
        $this->entity_manager = (new EntityManagerFactory())
                ->getEntityManager();
        $this->bidding_repository = $this->entity_manager
            ->getRepository(bidding::class);
    }

    public function requestProcess() : void{
        
        $read = $_POST['read'.$_POST['id']] ?? 0; 
        $id = $_POST['id'] ?? 0;
        $bidding = $this->bidding_repository->find($id);
        $bidding->setRead($read);
        $this->entity_manager->merge($bidding);
        $this->entity_manager->flush();
    }
}