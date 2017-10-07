<?php
namespace Jtg\Models;
/**
 * @Entity @Table(name="properties")
 **/
class Property {

	// public function __construct() {

	// 	die('Yo Im working!');
	// }


	/**
     * @Id @Column(type="integer") @GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $name;

    /**
     * @Column(type="string", nullable=true)
     * @var string
     */
    protected $address = null;

    /**
     * @Column(type="decimal", scale=2)
     * @var int
     */
    protected $price = null;

    /**
     * @Column(type="string", nullable=true)
     * @var string
     */
    protected $status = null;


    /**
     * @Column(type="integer", nullable=true)
     * @var int
     */
    protected $bedrooms = null;


    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }



    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getBedrooms()
    {
        return $this->bedrooms;
    }

    public function setBedrooms($bedrooms)
    {
        $this->bedrooms = $bedrooms;
    }
}
