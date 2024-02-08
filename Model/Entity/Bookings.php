<?php

namespace Model\Entity;

use Model\Entity\BaseEntity;

class Bookings extends BaseEntity
{
    private $id_booking;
    private $booking_start_date;
    private $booking_end_date;
    private $user_id;
    private $room_id;
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
     * Get the value of booking_start_date
     */
    public function getBooking_start_date()
    {
        return $this->booking_start_date;
    }

    /**
     * Set the value of booking_start_date
     *
     * @return  self
     */
    public function setBooking_start_date($booking_start_date)
    {
        $this->booking_start_date = $booking_start_date;

        return $this;
    }

    /**
     * Get the value of booking_end_date
     */
    public function getBooking_end_date()
    {
        return $this->booking_end_date;
    }

    /**
     * Set the value of booking_end_date
     *
     * @return  self
     */
    public function setBooking_end_date($booking_end_date)
    {
        $this->booking_end_date = $booking_end_date;

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

    /**
     * Get the value of room_id
     */
    public function getRoom_id()
    {
        return $this->room_id;
    }

    /**
     * Set the value of room_id
     *
     * @return  self
     */
    public function setRoom_id($room_id)
    {
        $this->room_id = $room_id;

        return $this;
    }

    /**
     * Get the value of booking_price
     */
    public function getBooking_price()
    {
        return $this->booking_price;
    }

    /**
     * Set the value of booking_price
     *
     * @return  self
     */
    public function setBooking_price($booking_price)
    {
        $this->booking_price = $booking_price;

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