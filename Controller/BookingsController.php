<?php

namespace Controller;

use Model\Entity\Bookings;
use Controller\BaseController;
use Form\BookingsHandleRequest;
use Model\Repository\BookingsRepository;

class BookingsController extends BaseController
{
    private $bookingsRepository;
    private $form;
    private $bookings;

    public function __construct()
    {
        $this->bookingsRepository = new BookingsRepository;
        $this->form = new BookingsHandleRequest;
        $this->bookings = new Bookings;
    }

    public function list(){

        $bookingss = $this->bookingsRepository->findBookings($this->bookings);

        $this->render("bookings/list_bookings.php", [
            "bookingss" => $bookingss
        ]);
    }

    public function newBookings(){

        $bookings = $this->bookings;
        $this->form->handleForm($bookings);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->bookingsRepository->addBookings($bookings);
            return redirection(addLink("users","dashUsers"));
        }

        $errors = $this->form->getEerrorsForm();

        return $this->render("bookings/form_bookings.php",  [
            "bookings" => $bookings,
            "errors" => $errors
        ]);
    }
    
    public function modifBookings($bookings)
    {
        $bookingss = $this->bookingsRepository->cancelBookings($this->bookings);
        $this->bookingsRepository->cancelBookings($bookings);
        return redirection(addLink("bookings"));

    }

    // public function findContestById($id){

    //     $contest = Contest::findContestById($id);

    //     $this->render("list_contest.php");
    // }
}