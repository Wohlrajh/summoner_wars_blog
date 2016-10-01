<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadMemberData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $memberDataSet = array(
            array(
                'email' => 'fred.derame@free.fr',
                'username' => 'wohlrajh',
                'enabled' => 1
            )
        );

        $userManager = $this->container->get('fos_user.user_manager');

        foreach ($memberDataSet as $row) {
            $member = $userManager->createUser();
            if ($userManager->findUserByEmail($row['email'])) {
                continue;
            }
            foreach ($row as $property => $value) {
                $member->{"set" . ucfirst($property)}($value);
            }
            $member->setPlainPassword('1Verseau');
            $member->addRole('ROLE_MEMBER');

            $userManager->updateUser($member);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 0; // the order in which fixtures will be loaded
    }
}
