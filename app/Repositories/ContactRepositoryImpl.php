<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Repositories\Contracts\ContactRepository;
use Exception;

class ContactRepositoryImpl extends AbstractRepository implements ContactRepository
{
    public function __construct(Contact $model) {
        $this->setModel($model);
    }

    public function getUserContact($userId, $contactId)
    {
        return $this->getModel()->where('user_id', $userId)
                                ->where('id', $contactId)
                                ->first();
    }

    public function updateContact($contactId, array $payload)
    {
        $contact = $this->getUserContact($payload['user_id'], $contactId);

        if(!$contact) { 
            throw new Exception('Contact not found', 422);
        }

       $this->update($contactId, $payload);

       return $contact->refresh();
    }

    public function getUserContacts($userId) 
    {
        return $this->getModel()->whereUserId($userId)->get();
    }
}