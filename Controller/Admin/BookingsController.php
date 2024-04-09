<?php
namespace Controller\Admin;

use Controller\BaseController;
use Model\Entity\Bookings;
use Model\Repository\BookingsRepository;

class BookingsController extends BaseController
{
    private $bookingsRepository;
    private $bookings;

    public function __construct()
    {
        $this->bookingsRepository = new BookingsRepository;
        $this->bookings = new Bookings;
    }

    public function list()
    {
        $bookings = $this->bookingsRepository->findAll($this->bookings);
        $this->render("admin/list_bookings.php", [
            "h1" => "Liste des réservations",
            "bookings" =>$bookings
        ]);
    }
}