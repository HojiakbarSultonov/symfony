<?php
declare(strict_types=1);

namespace App\Component\User;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Clock\DatePoint;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class UserFactory{

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }
    public function create(
        string $email,
        string $password,
        int $age,
        string $gender,
        string $phone,
        string $givenName,

    ):User
    {
        $user = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
        $user->setEmail($email);
        $user->setPassword($hashedPassword);
        $user->setAge($age);
        $user->setGender($gender);
        $user->setPhone($phone);
        $user->setCreatedAt(new DatePoint(timezone: new \DateTimeZone('Asia/Tashkent')));
        $user->setGivenName($givenName);
        return $user;


    }
}

