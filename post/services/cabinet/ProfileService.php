<?php


namespace post\services\cabinet;

use post\forms\User\ProfileEditForm;
use post\repositories\UserRepository;
use post\services\TransactionManager;

class ProfileService
{
    private $users;
    private $transaction;

    public function __construct(UserRepository $users, TransactionManager $transaction)
    {
        $this->users = $users;
        $this->transaction = $transaction;
    }

    public function edit($id, ProfileEditForm $form): void
    {
        $user = $this->users->get($id);
        $user->edit(
            $form->username,
            $form->email,
            $form->phone,
            $form->photo,
            $form->last_name,
            $form->first_name,
            $form->birthday
        );

        if ($form->photo) {
            $user->setPhoto($form->photo);
        }

        $this->transaction->wrap(function () use ($user, $form) {
            $this->users->save($user);
        });
    }

}