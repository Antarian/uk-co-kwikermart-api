<?php

namespace App\DataFixtures;

use App\Auth\ORM\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('testuser1@test.devel');
        // encode the plain password
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                'test-Password1'
            )
        );
        $user->setIdentity(bin2hex(random_bytes(48)));

        $manager->persist($user);

        // add more users if needed

        $manager->flush();
    }
}
