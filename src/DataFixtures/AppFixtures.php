<?php

namespace App\DataFixtures;

use App\Entity\Group;
use App\Entity\Student;
use App\Entity\Teacher;
use App\Entity\Word;
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

    public function load(ObjectManager $manager): void
    {

         $group1 = new Group();
         $group1->setName('Groupe 1');
         $manager->persist($group1);

         $group2 = new Group();
         $group2->setName('Groupe 2');
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

         $micheline = new Teacher();
         $micheline->setFirstName('Micheline');
         $micheline->setLastName('Michu');
         $micheline->setEmail('micheline@gmail.com');
         $password = $this->encoder->encodePassword($micheline, 'password');
         $micheline->setPassword($password);
         $micheline->addGroup($group2);
         $manager->persist($micheline);

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

         $word_hasard = new Word();
         $word_hasard->setName('Hasard');
         $word_hasard->setDefinition(
                            'Principe déclencheur d\'événements non liés à une cause
                                     connue. Il peut être synonyme de l\'« imprévisibilité », de l\'« imprédictibilité »
                                     , de fortune, de destin, ou lié aux mystères de la providence.'
         );
         $word_hasard->setGroup($group1);
        $manager->persist($word_hasard);

        $word_mandat = new Word();
        $word_mandat->setName('Mandat');
        $word_mandat->setDefinition(
            'Document délivré par une personne compétente, généralement un juge ou un magistrat, attestant de 
                      l\'autorisation d\'effectuer un acte qui, sans ce mandat, violerait les droits individuels, dans 
                      le cadre d\'une enquête ou d\'une instruction.'
        );
        $word_mandat->setGroup($group1);
        $manager->persist($word_mandat);

        $word_crime = new Word();
        $word_crime->setName('Crime');
        $word_crime->setDefinition(
            'Désigne la catégorie des infractions les plus graves, catégorie plus ou moins vaste suivant les 
            pays et systèmes juridiques. Le terme provient du latin crimen, qui signifie en latin classique 
            « l’accusation » ou le « chef d’accusation » puis, en bas latin, « faute » ou « souillure ».'
        );
        $word_crime->setGroup($group1);
        $manager->persist($word_crime);

        $word_explosion = new Word();
        $word_explosion->setName('Explosion');
        $word_explosion->setDefinition(
            'Augmentation rapide de volume et une libération d\'énergie, généralement avec génération de
            hautes températures et de gaz. '
        );
        $word_explosion->setGroup($group1);
        $manager->persist($word_explosion);

        $word_tapisserie = new Word();
        $word_tapisserie->setName('Tapisserie');
        $word_tapisserie->setDefinition(
            'tissu fabriqué sur un métier à tisser ou bien à la main, dont le tissage représente des motifs 
            ornementaux'
        );
        $word_tapisserie->setGroup($group2);
        $manager->persist($word_tapisserie);

        $word_marathon = new Word();
        $word_marathon->setName('Marathon');
        $word_marathon->setDefinition(
            'Épreuve sportive individuelle de course à pied qui se dispute généralement sur route sur une 
            distance de 42,195 kilomètres.'
        );
        $word_marathon->setGroup($group2);
        $manager->persist($word_marathon);


        $manager->flush();
    }
}
