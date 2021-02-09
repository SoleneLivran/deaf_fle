<?php

namespace App\DataFixtures;

use App\Entity\Group;
use App\Entity\Student;
use App\Entity\Teacher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

         $group1 = new Group();
         $manager->persist($group1);

         $group2 = new Group();
         $manager->persist($group2);


         $sarah = new Teacher();
         $sarah->setFirstName('Sarah');
         $sarah->setLastName('Livran');
         $sarah->setEmail('sarah@gmail.com');
         $password = $this->encoder->encodePassword($sarah, 'password');
         $sarah->setPassword($password);
         $sarah->addGroup($group1);
         $sarah->addGroup($group2);
         $manager->persist($sarah);

         $titi = new Student();
         $titi->setFirstName('Titi');
         $titi->setLastName('Tititi');
         $titi->setText('oihugeqonh ehibgfdi ehbeoopqe eoqhuqh eddf');
         $titi->setGroup($group1);
         $manager->persist($titi);

         $toto = new Student();
         $toto->setFirstName('Toto');
         $toto->setLastName('Tototo');
         $toto->setText('oihugDSRFGVRSeqonh rgrgreg dsfadf utkjkut qadWS');
         $toto->setGroup($group1);
         $manager->persist($toto);

         $tata = new Student();
         $tata->setFirstName('Tata');
         $tata->setLastName('Tatata');
         $tata->setText('ghgfhgh ghgffgss dgdfg dfgfgf gdfdga');
         $tata->setGroup($group1);
         $manager->persist($tata);

         $tutu = new Student();
         $tutu->setFirstName('Tutu');
         $tutu->setLastName('Tututu');
         $tutu->setText('jhpjpijip tehtteh teer rytyt teywfe');
         $tutu->setGroup($group2);
         $manager->persist($tutu);

         $tyty = new Student();
         $tyty->setFirstName('Tyty');
         $tyty->setLastName('Tytyty');
         $tyty->setText('okijhgfd ujyfdsr sfg srgthy srgeth');
         $tyty->setGroup($group2);
         $manager->persist($tyty);
         $manager->flush();
    }
}
