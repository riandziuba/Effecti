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
     * @Column(type="string", name="lic_date", nullable=true)
    */
    private string $date;
    /** 
     * @Column(type="integer", name="lic_uasg_code", nullable=true)
    */
    private int $uasg_code;
    /** 
     * @Column(type="string", length="500",name="lic_object", nullable=true)
    */
    private string $object;

    /** 
     * @Column(type="integer",name="lic_read", nullable=true)
    */
    private $read;
    
    function getLink() {
        return $this->link;
    }

    function getTitle() {
        return $this->title;
    }

    function getDate() {
        return $this->date;
    }

    function getUasg_code() {
        return $this->uasg_code;
    }

    function getObject() {
        return $this->object;
    }

    function setLink($link): void {
        $this->link = $link;
    }

    function setTitle($title): void {
        $this->title = $title;
    }

    function setDate($date): void {
        $this->date = $date;
    }

    function setUasg_code($uasg_code): void {
        $this->uasg_code = $uasg_code;
    }

    function setObject($object): void {
        $this->object = $object;
    }

    public function getRead()
    {
        return $this->read;
    }

    public function setRead($read)
    {
        $this->read = $read;

        return $this;
    }
}