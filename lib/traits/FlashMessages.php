<?php

namespace ProfitPress\Traits;

trait FlashMessages {

    protected function flashMessages($entity, $flash_type)
    {
        if (method_exists($entity, 'getMessages')) {
            foreach ($entity->getMessages() as $message) {
                $this->flash->{$flash_type}($message);
            }
        }
    }
}