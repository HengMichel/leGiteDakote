<?php

namespace Service;

use Model\Entity\Detail;
use Model\Repository\DetailRepository;

class DetailManager{

    private DetailRepository $detailRepository;

    public function __construct()
    {
       
        $this->detailRepository = new DetailRepository;
    }

    public function createDetail($bookingId, $roomId, $bookingStartDate, $bookingEndDate)
    {
        $detail = new Detail();
        $detail->setBooking_id($bookingId);
        $detail->setRoom_id($roomId);
        $detail->setBooking_start_date($bookingStartDate);
        $detail->setBooking_end_date($bookingEndDate);

        $this->detailRepository->insertDetail($detail);

        return $detail;
    }


}