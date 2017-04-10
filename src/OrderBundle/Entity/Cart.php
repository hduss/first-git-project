<?php

namespace OrderBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;


/**
* Cart
*/
class Cart
{
   /**
    * @var int
    */
   private $id; 

## @var ArrayCollection sert a recuperer plusieurs lines car c'est une relation oneToMany ##
    /**
     * @var ArrayCollection
     */
    private $lines;

    /** 
    * @var Customer 
    */
    private $customer;


   /**
    * @var string
    */
   private $number;    


   /**
    * @var \DateTime
    */
   private $date;    


   /**
    * @var string
    */
   private $status;    


   /**
    * Get id
    *
    * @return integer
    */
   public function getId()
   {
       return $this->id;
   }    


   /**
    * Set number
    *
    * @param string $number
    * @return Cart
    */




   public function setNumber($number)
   {
       $this->number = $number;        return $this;
   }    


   /**
    * Get number
    *
    * @return string
    */
   public function getNumber()
   {
       return $this->number;
   }    



   /**
    * Set date
    *
    * @param \DateTime $date
    * @return Cart
    */
   public function setDate($date)
   {
       $this->date = $date;        
       return $this;
   }    




   /**
    * Get date
    *
    * @return \DateTime
    */
   public function getDate()
   {
       return $this->date;
   }    

   /**
    * Set status
    *
    * @param string $status
    * @return Cart
    */



   public function setStatus($status)
   {
       $this->status = $status;        
       return $this;
   }    

   /**
    * Get status
    *
    * @return string
    */
   public function getStatus()
   {
       return $this->status;
   }


    public function __construct()
    {
        $this->lines = new ArrayCollection();
    }

    /** 
    * @return ArrayCollection 
    */

    public function getLines()
    {
        return $this->lines;
    }

    public function setLines($lines)
    {
        $this->lines = $lines;
    }


    public function addLine(Line $line)
    {
        
        $this->lines->add($line);
        $line->setCart($this);
        return $this;


    }


    public function getCustomer()
    {
        return $this->$customer;
    }


    /** 
    * @param Customer 
    * @return Cart
    */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
        return $this->customer;
    }






}