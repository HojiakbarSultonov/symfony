<?php
declare(strict_types=1);
namespace App\Component\User;

use Symfony\Component\Serializer\Attribute\Groups;

class UserInfoDto
{
    public function __construct(
        #[Groups(['user:read', 'user:write'])]
        private string $familyName,
        #[Groups(['user:read', 'user:write'])]
        private bool $isMarried,
    ){}

    public function getIsMarried(): bool
    {
        return $this->isMarried;
    }

    public function getFamilyName(): string
    {
        return $this->familyName;
    }
}
