<?php

namespace Riandziuba\Effecti\controller;
use Riandziuba\Effecti\entity\bidding;
use Riandziuba\Effecti\helper\entityManagerFactory;
use Riandziuba\Effecti\helper\responseController;
class getBidding implements urlControllerInterface{

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
        //print_r($_POST);
        $search = isset($_POST['search'])?$_POST['search']:'';
        $biddings = array();
        if($search != ''){
            $query = $this->entity_manager->createQuery('SELECT b FROM Riandziuba\Effecti\entity\bidding b WHERE b.title like :search or b.modalities like :search or b.info like :search');
            $query->setParameter('search', '%'.$search.'%');
            $biddings_obj = $query->getResult();
        }else{
            $biddings_obj = (array) $this->bidding_repository->findAll();
        }
        foreach ($biddings_obj as $bidding){
            $biddings[] = $bidding->getArrayFormat();
        }
        ResponseController::jsonResponse((array)$biddings);
    }
}