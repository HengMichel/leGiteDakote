<?php

namespace Service;


abstract class Session
{
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
        $messages = $_SESSION["messages"] ?? null;

        if (isset($_SESSION["messages"])) {
            unset($_SESSION["messages"]);
        }
        return $messages;
    }

    // public static function authentication(Game $game)
    // {
    //     $_SESSION["game"] = $game;
    // }

    // public static function isConnected()
    // {
    //     return $_SESSION["game"] ?? false;
    // }

    // public static function logout()
    // {
    //     self::destroy();
    // }

    // public static function isAdmin(): bool
    // {
    //     if ($game = self::isConnected()) {
    //         return $game->getNiveau() == ROLE_ADMIN;
    //     }
    //     return false;
    // }
}
