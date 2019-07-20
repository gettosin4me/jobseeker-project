<?php

namespace Jobseeker\App\Repository;

use Doctrine\ORM\EntityManager;

class UserRepository
{
	/**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function signUp(string $email, string $password): User
    {
        $user = new Jobseeker\App\Models\User($email, $password);

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
