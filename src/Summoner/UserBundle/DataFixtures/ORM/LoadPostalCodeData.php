<?php
namespace Summoner\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Summoner\UserBundle\Entity\PostalCodeCity;

class LoadPostalCodeData implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $manager->getConnection()->getConfiguration()->setSQLLogger(null);

        $fileName = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'postalCode' . DIRECTORY_SEPARATOR . 'FR_all.csv';

        if (!file_exists($fileName)) {
            throw new \RunTimeException(sprintf('The DataFixture can not read the file %s', $fileName));
        }

        $file = new \SplFileObject($fileName, 'rb');

        $file->setFlags(\SplFileObject::READ_CSV | \SplFileObject::SKIP_EMPTY);
        $file->setCsvControl(';');

//        var_dump($file);
        foreach ($file as $key => $data) {

//            var_dump($data);
//            var_dump($key);
            if (!is_array($data)) {
                continue;
            }

            $postalCodeCity = new PostalCodeCity();

            //Because the file content contains zip code twice.

            $postalCodeCity->setPostalCode($data[1]);
            $postalCodeCity->setCity($data[2]);
            $postalCodeCity->setCountryCode($data[0]);
            $manager->persist($postalCodeCity);
        }

        $manager->flush();
    }
}
