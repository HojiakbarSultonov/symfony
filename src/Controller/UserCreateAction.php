<?php

declare(strict_types=1);
namespace App\Controller;

use App\Component\User\UserFactory;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserCreateAction extends AbstractController

{

    public function __construct(private  UserFactory $userFactory){}
    public function __invoke(User $user):void
    {
    $user = $this->userFactory->create(
        $user->getEmail(),
        $user->getPassword(),
        $user->getAge(),
        $user->getGender(),
        $user->getPhone(),
        $user->getGivenName()
    );
        print_r($user);
        exit();
    }
}
