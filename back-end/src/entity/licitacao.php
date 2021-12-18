<?php
namespace Riandziuba\Effecti\entity;
/** 
 * @Entity 
 * @Table(name="licitacao")
 * */
class licitacao {
    /**
     * @Column(type="string", name="lic_link")
     * @Id
     */
    private string $link ;
    /** 
     * @Column(type="string", name="lic_title")
    */
    private string $title;
    /** 
     * @Column(type="string", name="lic_info", nullable=true)
    */
    private string $info;
    /** 
     * @Column(type="string", name="lic_modalities", nullable=true)
    */
    private int $modalities;

    /** 
     * @Column(type="integer",name="lic_read", nullable=true)
    */
    private $read;
    


    function getArrayFormat() : array {
        $array = [];
        $array['link'] = $this->getLink();
        $array['title'] = $this->getTitle();
        $array['info'] = $this->getInfo();
        $array['modalities'] = $this->getModalities();
        $array['read'] = $this->getRead();  
        return $array;
    }
}