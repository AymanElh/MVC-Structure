<?php

namespace App\Core;

class Session
{
    public function __construct() {
        session_start();
        $this->removeOldFlashMessages();
    }

    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function setFlashMessages(string $key, string $message, string $type = 'success')
    {
        $_SESSION['flash_messages'][$key] = [
            'message' => $message,
            'type' => $type,
            'remove' => false
        ];
    }

    public function remove($key) : void
    {
        unset($_SESSION[$key]);
    }

    public function destroy() : void
    {
        session_destroy();
    }

    public function getFlashMessages(string $key)
    {
        return $_SESSION['flash_messages'][$key]['message'] ?? null;
    }

    public function removeOldFlashMessages()
    {
        if(isset($_SESSION['flash_messages'])) {
            foreach ($_SESSION['flash_messages'] as $key => &$value) {
                if($value['remove']) {
                    unset($_SESSION['flash_messages'][$key]);
                }
                $value['remove'] = true;
            }
        }
    }
}