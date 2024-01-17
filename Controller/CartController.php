<?php
/**
 * Summary of namespace Controller
 */
namespace Controller;

use Service\CartManager;

/**
 * Summary of ProductController
 */
class CartController extends BaseController
{
    private $cartManager;

    public function __construct(CartManager $cartManager)
    {
        $this->cartManager = $cartManager;
    }

    /**
     * Summary of add
     * @param mixed $id
     * @return void
     */
    public function addToCart($id)
    {   
       
        try {

            $nb = $this->cartManager->addCart($id);
        
            // Retourner les données au format JSON
            header('Content-Type: application/json');
            echo json_encode(["count" => $nb]);
        } catch (\Exception $e) {

            // En cas d'erreur, retourner une réponse JSON avec le message d'erreur
            header('Content-Type: application/json');

            // Code d'erreur interne du serveur
            http_response_code(500);

            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    /**
     * Summary of show
     * @return void
     */
    public function show()
    {              
        $this->render("cart/show.php", [            
            "h1" => "Fiche cart"
            ]);
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