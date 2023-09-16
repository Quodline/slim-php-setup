<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('users')]
final class User
{
    #[Id]
    #[Column, GeneratedValue]
    public readonly int $id;

    #[Column(unique: true, nullable: false)]
    public string $username;

    #[Column(length: 4)]
    public int $pin;

    #[Column(name: 'created_at', nullable: false)]
    public \DateTime $createdAt;
}
