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