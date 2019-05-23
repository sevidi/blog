<?php


namespace post\services\manage;

use post\entities\User\User;
use post\forms\manage\User\UserCreateForm;
use post\forms\manage\User\UserEditForm;
use post\repositories\UserRepository;
use post\services\RoleManager;
use post\services\TransactionManager;

class UserManageService
{
    private $repository;
    private $roles;
    private $transaction;

    public function __construct(UserRepository $repository, RoleManager $roles, TransactionManager $transaction)
    {
        $this->repository = $repository;
        $this->roles = $roles;
        $this->transaction = $transaction;
    }

    public function create(UserCreateForm $form): User
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->phone,
            $form->photo,
            $form->last_name,
            $form->first_name,
            $form->birhday,
            $form->password
        );

        if ($form->photo) {
            $user->setPhoto($form->photo);
        }

        $this->transaction->wrap(function () use ($user, $form) {
            $this->repository->save($user);
            $this->roles->assign($user->id, $form->role);
        });
        return $user;
    }

    public function edit($id, UserEditForm $form): void
    {
        $user = $this->repository->get($id);
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
            $this->repository->save($user);
            $this->roles->assign($user->id, $form->role);
        });
    }

    public function assignRole($id, $role): void
    {
        $user = $this->repository->get($id);
        $this->roles->assign($user->id, $role);
    }

    public function remove($id): void
    {
        $user = $this->repository->get($id);
        $this->repository->remove($user);
    }

}