<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * dans la majorité des classes, on peut recuperer des services par autowiring(cablage)
     * uniquement dans le constructeur
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {

        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {//creation de 10 utilisateurs classiques
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            //Creation du hash du mot de passe
            $hash = $this->passwordEncoder->encodePassword($user, 'user' . $i);

            $user
                ->setEmail('user' . $i . '@mail.org')
                ->setPassword($hash);
            $manager->persist($user);
        }

        //creation de 3admin
        //email :admin@mail.org
        //mdp:admine0
        //roles:role_ADMIN

        for ($i = 0; $i < 3; $i++) {
            $admin = new User();
            //hash du mdp
            $hash = $this->passwordEncoder->encodePassword($admin, 'admin' . $i);
            $admin
                ->setEmail('admin' . $i . '@mail.org')
                ->setPassword($hash)
                ->setRoles(['ROLE_ADMIN']);
            $manager->persist($admin);
        }


        $manager->flush();

    }
}
