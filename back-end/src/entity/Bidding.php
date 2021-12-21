<?php
namespace Riandziuba\Effecti\entity;
/** 
 * @Entity 
 * @Table(name="bidding")
 * */
class Bidding {
    /**
     * @Column(type="integer", name="id")
     * @GeneratedValue(strategy="IDENTITY")
     * @Id
     */
    private int $id;
    /**
     * @Column(type="string", unique=true, name="bid_link")
     */
    private string $link ;
    /** 
     * @Column(type="string", name="bid_title")
    */
    private string $title;
    /** 
     * @Column(type="string", name="bid_info", nullable=true)
    */
    private string $info;
    /** 
     * @Column(type="string", length=500, name="bid_modalities", nullable=true)
    */
    private string $modalities;

    /** 
     * @Column(type="integer",name="bid_read", nullable=true)
    */
    private $read;

    function getId() : int {
       return $this->id; 
    }
    
    function getLink(): string {
        return $this->link;
    }

    function getTitle(): string {
        return $this->title;
    }

    function getInfo(): string {
        return $this->info;
    }

    function getModalities(): string {
        return $this->modalities;
    }

    function getRead() {
        return $this->read;
    }

    function setLink(string $link): void {
        $this->link = $link;
    }

    function setTitle(string $title): void {
        $this->title = $title;
    }

    function setInfo(string $info): void {
        $this->info = $info;
    }

    function setModalities(string $modalities): void {
        $this->modalities = $modalities;
    }

    function setRead(bool $read): void {
        $this->read = $read;
    }

        


    function getArrayFormat() : array {
        $array = [];
        $array['id'] = $this->getId();
        $array['link'] = $this->getLink();
        $array['title'] = html_entity_decode($this->getTitle());
        $array['info'] = html_entity_decode($this->getInfo());
        $array['modalities'] = html_entity_decode($this->getModalities());
        $array['read'] = $this->getRead()? true : false;  
        return $array;
    }
}