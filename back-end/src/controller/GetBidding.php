<?php

namespace Riandziuba\Effecti\controller;
use Riandziuba\Effecti\entity\Bidding;
use Riandziuba\Effecti\helper\EntityManagerFactory;
use Riandziuba\Effecti\helper\ResponseController;
class GetBidding implements UrlControllerInterface{

    private $entity_manager;
    private $bidding_repository;
    
    public function __construct() {
        $this->entity_manager = (new EntityManagerFactory())
                ->getEntityManager();
        $this->bidding_repository = $this->entity_manager
            ->getRepository(bidding::class);
    }

    public function requestProcess() : void {
        $search = $_POST['search'] ?? '';
        $biddings = array();
        if($search != '') {
            $query = $this->entity_manager->createQuery('SELECT b FROM Riandziuba\Effecti\entity\bidding b WHERE b.title like :search or b.modalities like :search or b.info like :search');
            $query->setParameter('search', '%'.$search.'%');
            $biddings_obj = $query->getResult();
        } else {
            $biddings_obj = (array) $this->bidding_repository->findAll();
        }
        foreach ($biddings_obj as $bidding) {
            $biddings[] = $bidding->getArrayFormat();
        }
        ResponseController::jsonResponse((array)$biddings);
    }
}