<?php

namespace Service;

use Model\Entity\Users;

abstract class Session
{
    const SESSION_KEY_MESSAGES = "messages";
    const ROLE_ADMIN = "admin";
    const SESSION_KEY_USERS = "users";


    public static function destroy()
    {
        session_destroy();
    }

    public static function addMessage($type, $message)
    {
        $_SESSION["messages"][$type][] = $message;
    }

    public static function getMessages()
    {
        $messages = $_SESSION[self::SESSION_KEY_MESSAGES] ?? null;

        if (isset($_SESSION[self::SESSION_KEY_MESSAGES])) {
            unset($_SESSION[self::SESSION_KEY_MESSAGES]);
        }
        return $messages;
    }

    public static function authentication(Users $users)
    {
        $_SESSION["users"] = $users;
    }

    public static function isConnected()
    {
        // return $_SESSION[self::SESSION_KEY_USERS] ?? false;
        return isset($_SESSION[self::SESSION_KEY_USERS]);
    }

    public static function getConnectedUser()
    {
        return $_SESSION[self::SESSION_KEY_USERS] ?? null;
    }

    public static function logout()
    {
        self::destroy();
    }

    public static function isAdmin(): bool
    {
        // if ($users = self::isConnected()) {
        //     return $users->getRole() == self::ROLE_ADMIN;
        // }
        $user = self::isConnected();

        // if ($user instanceof Users) {
        //     return $user->getRole() == self::ROLE_ADMIN;
        //     }    

        // return false;
        return $user instanceof Users && $user->getRole() == self::ROLE_ADMIN;

    }
}
