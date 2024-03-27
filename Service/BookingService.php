<?php
namespace Service;

use Model\Entity\Detail;
use Model\Repository\DetailRepository;

class BookingService
{
    private DetailRepository $detailRepository;

    public function __construct(DetailRepository $detailRepository)
    {
        $this->detailRepository = $detailRepository;
    }

    public function insertBookingDetails($roomId, $startDate, $endDate)
    {
        $detail = new Detail();
        $detail->setRoom_id($roomId);
        $detail->setBooking_start_date($startDate);
        $detail->setBooking_end_date($endDate);

        $this->detailRepository->insertDetail($detail);
    }
}
