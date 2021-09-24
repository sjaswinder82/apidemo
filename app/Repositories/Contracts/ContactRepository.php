<?php

namespace App\Repositories\Contracts;

interface ContactRepository 
{
    public function getUserContacts($userId);
    public function getUserContact($userId, $contactId);
    public function updateContact($userId, array $payload);

}