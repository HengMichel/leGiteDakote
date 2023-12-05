<?php

namespace Model\Entity;

class BaseEntity
{
    protected $id;

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

    public function __toString()
    {
        $class = get_called_class();
        $class = explode("\\", $class);
        $table = $class[count($class) - 1];
        // strtolower = met tous les caractères d'un string en minuscule
        return strToLower($table);
    }
}
