<?php

namespace Model\Entity;

class Player extends BaseEntity
{

    private $id_player;
    private $email;
    private $nickname;

    /**
     * Get the value of id_player
     */
    public function getId_player()
    {
        return $this->id_player;
    }

    /**
     * Set the value of id_player
     *
     * @return  self
     */
    public function setId_player($id_player)
    {
        $this->id_player = $id_player;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of nickname
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set the value of nickname
     *
     * @return  self
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

}


