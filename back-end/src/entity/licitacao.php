<?php
namespace Riandziuba\Effecti\entity;
/** 
 * @Entity 
 * @Table(name="licitacao")
 * */
class licitacao {
    /**
     * @Column(type="integer", name="licitacao_id")
     * @Id
     * @GeneratedValue
     */
    private $id;
    /** 
     * @Column(type="string", name="lic_title")
    */
    private $title;
    /** 
     * @Column(type="string", name="lic_date", nullable=true)
    */
    private $date;
    /** 
     * @Column(type="integer", name="lic_uasg_code", nullable=true)
    */
    private $uasg_code;
    /** 
     * @Column(type="string", length="500",name="lic_object", nullable=true)
    */
    private $object;

    /** 
     * @Column(type="integer",name="lic_read", nullable=true)
    */
    private $read;
    
    function getId() {
        return $this->id;
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

    function setId($id): void {
        $this->id = $id;
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