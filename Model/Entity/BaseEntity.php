<?php

namespace Model\Entity;

class BaseEntity
{
    protected $id;
    // new but don't need but for another project ..
    // protected $created_at;
    // protected $updated_at;
    // protected $is_deleted;

    public function __toString()
    {
        // retourne le nom de la classe à partir de son namespase 
        // exemple : Model\Entity\Rooms
        $class = get_called_class();
        // Découpe une chaine de caractèrs dès qu'il rencotre un caractère spécifique ici c'est le "\"
        // Elle retourne ensuite un tableau indexé contenant les élément dans la chaine de caractères
        // Exemple : 
        // ["Model","Entity","Rooms"]
        $class = explode("\\", $class);
        $table = $class[count($class) - 1];
        // strtolower = met tous les caractères d'un string en minuscule
        return strToLower($table);
    }

     /**
     * Get the value of id
     *
     * @return integer
     */
    public function getId(): int
    // public function getId()
    {
        return $this->id;
    }
     /**
     * Set the value of id
     *
     * @param integer $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    // ######## pas l'utilite pour ce projet ######################################
    /**
     * Get the value of created_at
     */ 
    // public function getCreatedAt()
    // {
    //     return $this->created_at;
    // }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    // public function setCreatedAt($createdAt)
    // {
    //     $this->created_at = $createdAt;

    //     return $this;
    // }

    /**
     * Get the value of updated_at
     */ 
    // public function getUpdatedAt()
    // {
    //     return $this->updated_at;
    // }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */ 
    // public function setUpdatedAt($updatedAt)
    // {
    //     $this->updated_at = $updatedAt;

    //     return $this;
    // }

    /**
     * Get the value of is_deleted
     */ 
    // public function getIsDeleted()
    // {
    //     return $this->is_deleted;
    // }

    /**
     * Set the value of is_deleted
     *
     * @return  self
     */ 
    // public function setIsDeleted($isDeleted)
    // {
    //     $this->is_deleted = $isDeleted;

    //     return $this;
    // }

}
