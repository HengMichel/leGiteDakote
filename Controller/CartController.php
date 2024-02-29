<?php
/**
 * Summary of namespace Controller
 */
namespace Controller;

use Model\Entity\Detail;
use Service\CartManager;
use Model\Repository\DetailRepository;

class CartController extends BaseController
{
    private $detailRepository;
    private $detail;


    public function __construct()
    {
        $this->detailRepository = new DetailRepository;
        $this->detail = new Detail;
    }

    /**
     * Summary of add
     * @param mixed $id
     * @return void
     */
    public function addToCart($id)
    {   
        $cm = new CartManager();
        $nb = $cm->addCart($id);
        echo $nb;        
    }
    /**
     * Summary of show
     * @return void
     */

    public function showForm()
    {
          // Récupère les paramètres POST
          $room_id = $_POST['room_id'] ?? null;

          $detail = new Detail();
          $detail->setRoom_id($room_id);

            // Passe les données à la vue
        $data = [
            'detail' => $detail,
            'room_id' => $room_id,
            
        ];
        // d_die($detail)

        $this->render("cart/form_cart.php",$data + [            
        "h1" => "Fiche cart"
        ]);
    }


    public function show($id)
    {
        if (!empty($id) && is_numeric($id)) 
        {   
            // Converti l'ID en entier
            $id = intval($id); 
            // d_die($id);  

            // Instancie la classe RoomsRepository pour interagir avec la base de données
            $d = new DetailRepository;

            // Appele de la méthode findRoomsById pour récupérer les informations de la chambre par son ID
            $detail = $d->findDetailById($id);

            // d_die($room);
            // Vérifie si la chambre existe
            if (empty($detail)) {
                $this->setMessage("danger",  "Le produit N° $id n'existe pas");
                redirection(addLink("home"));
            }
            // Affiche la vue de détails de la chambre avec les informations récupérées
            $this->render("cart/show.php", [
            "detail" => $detail,
            "h1" => "Fiche de la chambre"
            ]);
        } else {
            // Redirige vers une page d'erreur si l'ID n'est pas valide
            error("404.php");
        }

    }
    




    /**
     * Summary of edit
     * @param mixed $id
     * @return void
     */
    public function edit($id)
    {
        
    }

    public function delete($id)
    {
        
    }

}