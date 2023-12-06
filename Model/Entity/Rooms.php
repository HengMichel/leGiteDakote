<?php

namespace Model\Entity;

class Rooms extends BaseEntity
{
    private $id_room;
    private $room_number;
    private $price;
    private $room_imgs;
    private $persons;
    private $category;
    private $room_state;

    /**
     * Get the value of id_room 
     */
    public function getId_room ()
    {
        return $this->id_room ;
    }

    /**
     * Set the value of id_room 
     *
     * @return  self
     */
    public function setId_room ($id_room )
    {
        $this->id_room  = $id_room ;

        return $this;
    }
    /**
     * Get the value of room_number
     */
    public function getRoom_number()
    {
        return $this->room_number;
    }

    /**
     * Set the value of room_number
     *
     * @return  self
     */
    public function setRoom_number($room_number)
    {
        $this->room_number = $room_number;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of $price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
    
    /**
     * Get the value of room_imgs
     */
    public function getRoom_imgs()
    {
        return $this->room_imgs;
    }

    /**
     * Set the value of $room_imgs
     *
     * @return  self
     */
    public function setRoom_imgs($room_imgs)
    {
        $this->room_imgs = $room_imgs;

        return $this;
    }
    /**
     * Get the value of persons
     */
    public function getPersons()
    {
        return $this->persons;
    }

    /**
     * Set the value of $persons
     *
     * @return  self
     */
    public function setPersons($persons)
    {
        $this->persons = $persons;

        return $this;
    }
    /**
     * Get the value of category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of $category
     *
     * @return  self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }
    /**
     * Get the value of room_state
     */
    public function getRoom_state()
    {
        return $this->room_state;
    }

    /**
     * Set the value of $room_state
     *
     * @return  self
     */
    public function setRoom_state($room_state)
    {
        $this->room_state = $room_state;

        return $this;
    }
    
}