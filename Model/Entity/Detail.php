<?php

namespace Model\Entity;

use Model\Entity\BaseEntity;

class Detail extends BaseEntity
{
    private $id_detail;
    private $room_id;
    private $booking_id;
    private $booking_start_date;
    private $booking_end_date;

    /**
     * Get the value of id_detail
     */
    public function getId_Detail()
    {
        return $this->id_detail;
    }

    /**
     * Set the value of id_detail
     *
     * @return  self
     */
    public function setId_Detail($id_detail)
    {
        $this->id_detail = $id_detail;

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
     * Get the value of booking_id
     */
    public function getBooking_id()
    {
        return $this->booking_id;
    }

    /**
     * Set the value of booking_id
     *
     * @return  self
     */
    public function setBooking_id($booking_id)
    {
        $this->booking_id = $booking_id;

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


}