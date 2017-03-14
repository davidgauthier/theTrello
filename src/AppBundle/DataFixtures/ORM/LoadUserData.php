<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        // Get our userManager, you must implement `ContainerAwareInterface`
        $userManager = $this->container->get('fos_user.user_manager');

        $userData = [
            [
                'username' => 'david',
                'email' => 'david@thetrello.com',
                'password' => 'david',
            ],
            [
                'username' => 'toto',
                'email' => 'toto@thetrello.com',
                'password' => 'toto',
            ],
        ];

        foreach ($userData as $i => $userData) {
            $user = $userManager->createUser();
            $user->setUsername($userData['username']);
            $user->setEmail($userData['email']);
            $user->setPlainPassword($userData['password']);
            $user->setEnabled(true);
            //$user->setRoles(array('ROLE_USER'));
            //$userManager->updatePassword($user);
            //$manager->persist($user);
            $userManager->updateUser($user, true);

            $this->addReference(sprintf('user-%s', $i), $user);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 30;
    }
}
