<?php

namespace Model\Entity;

use Model\Entity\BaseEntity;

class Bookings extends BaseEntity
{
    private $id_booking;
    private $user_id;
    private $booking_price;
    private $booking_state = 'in progress';

    /**
     * Get the value of id_booking
     */
    public function getId_booking()
    {
        return $this->id_booking;
    }

    /**
     * Set the value of id_booking
     *
     * @return  self
     */
    public function setId_booking($id_booking)
    {
        $this->id_booking = $id_booking;
        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    // Déclare comme float car généralement préférable d'utiliser des nombres flottants pour représenter les prix
    /**
     * Get the value of booking_price
     */
    public function getBooking_price(): float
    {
        return $this->booking_price;
    }

    /**
     * Set the value of booking_price
     *
     * @return  self
     */
    public function setBooking_price(float $price)
    {
        $this->booking_price = $price;
        return $this;
    }
    
    /**
     * Get the value of booking_state
     */
    public function getBooking_state()
    {
        return $this->booking_state;
    }

    /**
     * Set the value of booking_state
     *
     * @return  self
     */
    public function setBooking_state($booking_state)
    {
        $this->booking_state = $booking_state;
        return $this;
    }

}