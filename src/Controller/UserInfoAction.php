<?php
declare(strict_types=1);

namespace App\Controller;


use App\Component\User\UserInfoDto;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class UserInfoAction extends AbstractController{
    public function __invoke(#[MapRequestPayload] UserInfoDto $userInfoDto)
    {
       return $userInfoDto;
    }
}
