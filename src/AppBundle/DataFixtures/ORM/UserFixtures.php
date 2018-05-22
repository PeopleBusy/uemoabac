<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserFixtures implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        /**$user = new User();
        $user->setAuteur("ADMIN");
        $user->setNom("ADMINISTRATEUR");
        $user->setPrenom("Administrateur");

        $user->setUsername("administrateur");
        $user->setIsActive(true);
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setPays("Togo");

        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, "admin");
        $user->setPassword($password);
        $user->setDateCreation(new \DateTime());

        $manager->persist($user);

        $user = new User();
        $user->setAuteur("Admin");
        $user->setNom("DUPONT");
        $user->setPrenom("Paul");
        $user->setPays("Benin");

        $user->setUsername("dupaul");
        $user->setIsActive(true);
        $user->setRoles(array('ROLE_USER'));

        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, "1234");
        $user->setPassword($password);
        $user->setDateCreation(new \DateTime());
        **/


        $user1 = new User();
        $user1->setAuteur("Admin");
        $user1->setNom("PARKER");
        $user1->setPrenom("Peter");
        $user1->setPays("Togo");

        $user1->setUsername("peter");
        $user1->setIsActive(true);
        $user1->setRoles(array('ROLE_USER'));

        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user1, "1234");
        $user1->setPassword($password);
        $user1->setDateCreation(new \DateTime());

        $manager->persist($user1);
        $manager->flush();
    }

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}