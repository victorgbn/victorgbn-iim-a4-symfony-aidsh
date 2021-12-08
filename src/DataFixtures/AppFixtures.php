<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Villain;
use App\Entity\Mission;
use App\Entity\Priority;
use App\Entity\Status;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Faker;

class AppFixtures extends Fixture
{
    private $encoder;
    private $client;
    public function __construct(UserPasswordHasherInterface $encoder, HttpClientInterface $client)
    {
        $this->encoder = $encoder;
        $this->client = $client;
    }

    public function load(ObjectManager $manager): void
    {  
        // add Fake Users
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 15; $i++) {
            $user = new User();
            $user->setName($faker->userName);
            $user->setEmail($faker->email);
            $user->setPassword($this->encoder->hashPassword($user, $faker->password));
            $user->setRoles(['ROLE_CLIENT']);

            $manager->persist($user);
        }

        // add Superhero
        for ($a = 1; $a <= 15; $a++) { 
            $response = $this->client->request(
                'GET',
                'https://www.superheroapi.com/api.php/4525199984238444/'.$a.'/'
            );
            $content = $response->toArray();
            $user = new User();
            $user->setName($content["name"]);
            $user->setEmail($faker->email);
            $user->setPassword($this->encoder->hashPassword($user, $faker->password));
            $user->setRoles(['ROLE_SUPER_HERO']);

            $manager->persist($user);
        }

         // add Admin
        $responsePX = $this->client->request(
            'GET',
            'https://www.superheroapi.com/api.php/4525199984238444/search/Professor%20X'
        );
        $contentPX = $responsePX->toArray();
        $admin = new User();
        $admin->setEmail('professorX@goat.dev');
        $admin->setName($contentPX["results-for"]);
        $admin->setPassword($this->encoder->hashPassword($admin, 'password'));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        //add Villain 
        //Not with API…
        for ($b = 0; $b < 50; $b++){
            $bad = new Villain();
            $bad->setName('Bad '.$b);
            $manager->persist($bad);
        }

        //add Priority
        $priority1 = new Priority();
        $priority1->setPriorityName('Low');
        $manager->persist($priority1);

        $priority2 = new Priority();
        $priority2->setPriorityName('Medium');
        $manager->persist($priority2);

        $priority3 = new Priority();
        $priority3->setPriorityName('High');
        $manager->persist($priority3);

        //add Status
        $status1 = new Status();
        $status1->setStatusName('To Validate');
        $manager->persist($status1);

        $status2 = new Status();
        $status2->setStatusName('To Do');
        $manager->persist($status2);

        $status3 = new Status();
        $status3->setStatusName('In Progress');
        $manager->persist($status3);

        $status4 = new Status();
        $status4->setStatusName('Done');
        $manager->persist($status4);
        
        //add Missions
        for ($m = 0; $m <= 5; $m++){
            $mission = new Mission();
            $mission->setName('Mission '.$m);
            $mission->setName('Mission '.$m);
            $mission->setDescription('A very important mission.');
            $mission->setDeadline(new \DateTime('08/12/2021'));
            $manager->persist($mission);
        }

        $manager->flush();
    }
}
