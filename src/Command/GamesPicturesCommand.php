<?php

namespace App\Command;

use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GamesPicturesCommand extends Command
{
    protected static $defaultName = 'games:pictures';
    protected static $defaultDescription = 'Add cover and logo pictures to games';

    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $em;

    /**
     * @return array
     */
    private function getPictures(): array
    {
        $arrayGame['League of Legends'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/928-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/thumb/clearlogo/928.png',
        ];
        $arrayGame['World of Warcraft'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/149-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/149.png',
        ];
        $arrayGame['Overwatch'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/32185-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/32185.png',
        ];
        $arrayGame['Starcraft'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/153-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/153.png',
        ];
        $arrayGame['Civilization VI'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/thumb/boxart/front/68643-1.jpg',
            'logo' => null,
        ];
        $arrayGame['Call of Duty'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/952-2.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/952.png',
        ];
        $arrayGame['Apex la Légende'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/63344-1.jpg',
            'logo' => null,
        ];
        $arrayGame['Counter Strike : Globale Offensive'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/10771-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/10771.png',
        ];
        $arrayGame['Player Unknown Battleground'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/52158-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/53832.png',
        ];
        $arrayGame['DotA 2'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/2474-1.png',
            'logo' => null,
        ];
        $arrayGame['GTA V'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/20952-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/20952.png',
        ];
        $arrayGame['Minecraft'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/70429-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/68757-1.png',
        ];
        $arrayGame['The Witcher III : Wild Hunt'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/33255-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/33255.png',
        ];
        $arrayGame['The Elder Scrolls V : Skyrim'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/43879-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/43879.png',
        ];
        $arrayGame['Dark Souls'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/74917-1.jpg',
            'logo' => null,
        ];
        $arrayGame["Assassin's Creed"] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/12-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/12.png',
        ];
        $arrayGame['Cyberpunk 2077'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/22722-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/22722-1.png',
        ];
        $arrayGame['Borderlands 2'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/78354-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/5647.png',
        ];
        $arrayGame['Final Fantasy VII'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/29221-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/525.png',
        ];
        $arrayGame['SimCity 2000'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/771-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/771.png',
        ];
        $arrayGame['Age of Empire II'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/749-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/16096.png',
        ];
        $arrayGame['Monster Hunter : World'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/60572-1.jpg',
            'logo' => null,
        ];
        $arrayGame['Diablo III'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/912-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/912.png',
        ];
        $arrayGame['Path of Exile'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/11131-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/11131.png',
        ];
        $arrayGame['Magic : Arena'] = [
            'cover' => 'https://images.ctfassets.net/s5n2t79q9icq/1zRKpcySEKfuKb9tBCqW9e/d5c1483085cb1a1958ea67a096461419/AsWSTijxCt.jpg?fm=webp',
            'logo' => 'https://images.ctfassets.net/s5n2t79q9icq/3Z55mYwwA9H6AGX44YkUJ5/fef06bf05ab422d05c4981af843880b8/arena-logo-medium.png?fm=webp',
        ];
        $arrayGame['Hearthstone'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/18552-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/18552.png',
        ];
        $arrayGame['Heroes of the Storm'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/48640-1.jpg',
            'logo' => null,
        ];
        $arrayGame['Kingdom Come Delivrance'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/20196-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/20196.png',
        ];
        $arrayGame['Red Dead Redemption 2'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/66595-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/55247-1.png',
        ];
        $arrayGame['Destiny 2'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/77521-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/50624.png',
        ];
        $arrayGame['Valorant'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/72904-1.jpg',
            'logo' => null,
        ];
        $arrayGame['Among Us'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/80312-1.jpg',
            'logo' => null,
        ];
        $arrayGame['Doom Eternal'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/64830-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/64830-1.png',
        ];
        $arrayGame['Star Wars Battlefront II'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/54115-1.jpg',
            'logo' => null,
        ];
        $arrayGame['ArmA III'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/16136-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/16136.png',
        ];
        $arrayGame['Total War : Warhammer II'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/32330-1.jpg',
            'logo' => null,
        ];
        $arrayGame['ARK : Survival Evolved'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/28903-1.jpg',
            'logo' => null,
        ];
        $arrayGame['Dead by Daylight'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/50807-1.jpg',
            'logo' => null,
        ];
        $arrayGame['Fallout'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/235-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/235.png',
        ];
        $arrayGame['The Binding of Isaac : Rebirth'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/25701-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/25701.png',
        ];
        $arrayGame['Star Wars Jedi : Fallen Order'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/64819-1.jpg',
            'logo' => null,
        ];
        $arrayGame['Left 4 Dead 2'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/clearlogo/855.png',
            'logo' => 'https://cdn.thegamesdb.net/images/original/boxart/front/855-1.jpg',
        ];
        $arrayGame['Battlefield V'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/55756-1.jpg',
            'logo' => null,
        ];
        $arrayGame['Age of Mythology'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/7804-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/7804.png',
        ];
        $arrayGame['The Sims 3'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/8833-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/8833.png',
        ];
        $arrayGame['Far Cry 5'] = [
            'cover' => 'https://cdn.thegamesdb.net/images/original/boxart/front/52745-1.jpg',
            'logo' => 'https://cdn.thegamesdb.net/images/original/clearlogo/52745.png',
        ];
        return $arrayGame;
    }

    /**
     * Constructor.
     * @param GameRepository $gameRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(
        GameRepository $gameRepository,
        EntityManagerInterface $em
    ) {
        $this->gameRepository = $gameRepository;
        $this->em = $em;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('     ');
        $output->writeln('<info>Importing all pictures...</info>');
        $output->writeln('     ');

        foreach ($this->getPictures() as $gameName => $arrayInfoPictures) {
            $game = $this->gameRepository->findOneBy(['name' => $gameName]);

            $output->writeln('     ');
            $output->writeln('<comment>Import to game : ' . $gameName);
            $output->writeln('<comment>  -> cover : ' . $arrayInfoPictures['cover'] . ',');
            $output->writeln('<comment>  -> logo : ' . $arrayInfoPictures['logo']);
            $output->writeln('     ');
            $output->writeln('--------</comment>');

            $game
                ->setThumbnailCover($arrayInfoPictures['cover'])
                ->setThumbnailLogo($arrayInfoPictures['logo']);
                
            $this->em->persist($game);

        }
        $this->em->flush();
        $output->writeln('     ');
        $output->writeln('<fg=white;bg=#ff00ff>                                                    ');
        $output->writeln('  (*^‿^*) Pictures imported with success ! (*^‿^*)  ');
        $output->writeln('                                                    </>');
        return command::SUCCESS;
    }
}
