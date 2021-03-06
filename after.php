<?php

/**
 * Class Abstract Hero
 */
abstract class Hero
{
    protected int $pointsDeVie;
    protected int $weapon;
    protected int $positionX;
    protected int $positionY;
    const ERROR_DIRECTION_MESSAGE = 'Direction non autorisée';

    protected function __construct(int $pointsDeVie, int $weapon)
    {
        $this->pointsDeVie = $pointsDeVie;
        $this->weapon      = $weapon;
        $this->positionY   = 0;
        $this->positionX   = 0;
    }

    public function deplacement(int $case, string $direction): string
    {
        $splitDirection = str_split($direction);
        if (!is_array($splitDirection) || count($splitDirection) < 1 || count($splitDirection) > 2) {
            throw new HeroException(self::ERROR_DIRECTION_MESSAGE);
        }

        if (count($splitDirection) === 1) {
            if (!in_array(mb_strtoupper($splitDirection[0]), ['N', 'S', 'E', 'W'])) {
                throw new HeroException(self::ERROR_DIRECTION_MESSAGE);
            }
        } elseif (count($splitDirection) === 2) {
            if (!in_array(mb_strtoupper($splitDirection[0]), ['N', 'S']) ||
            !in_array(mb_strtoupper($splitDirection[1]), ['E', 'W'])) {
                throw new HeroException(self::ERROR_DIRECTION_MESSAGE);
            }
        }

        foreach ($splitDirection as $dir) {
            $dir = mb_strtoupper($dir);
            if ($dir === 'N') {
                $this->positionY += $case;
            } elseif ($dir === 'S') {
                $this->positionY -= $case;
            } elseif ($dir === 'E') {
                $this->positionX += $case;
            } elseif ($dir === 'W') {
                $this->positionX -= $case;
            }
        }

        return $this->positionX . ';' . $this->positionY;
    }
}

/**
 * Class Archer
 */
class Archer extends Hero
{
    public function __construct(int $pointsDeVie, int $weapon = 10)
    {
        parent::__construct($pointsDeVie, $weapon);
    }
}

/**
 * Class Sorcier
 */
class Sorcier extends Hero
{
    const INVOCATIONS = [
        'IFRIT' => [
            'nom' => 'ifrit',
            'pdv' => 50
        ],
        'SHIVA' => [
            'nom' => 'shiva',
            'pdv' => 80
        ],
        'BAHAMUT' => [
            'nom' => 'Bahamut',
            'pdv' => 80000
        ],
    ];

    public function __construct(int $pointsDeVie, int $weapon = 50)
    {
        parent::__construct($pointsDeVie, $weapon);
    }

    public function invoquer(string $creature): array
    {
        $creature = mb_strtoupper($creature);
        return array_key_exists($creature, self::INVOCATIONS) ?
            ['nom' => self::INVOCATIONS[$creature]['nom'], 'pdv' => self::INVOCATIONS[$creature]['pdv']] :
            ['nom' => 'Démon inconnu', 'pdv' => 100];
    }
}

/**
 * Class HeroException
 */
class HeroException extends Exception
{
}

function main(): void
{
    try {
        $joueur_1 = new Archer(100);
        $joueur_2 = new Sorcier(100, 100);

        $joueur_1->deplacement(6, 'N');
        $joueur_1->deplacement(6, 'N');
        $joueur_1->deplacement(6, 'N');
        echo $joueur_1->deplacement(6, 'N');
        echo '<br>';
        echo $joueur_2->deplacement(4, 'NE');
        echo '<br>';

        $invocation = $joueur_2->invoquer('ifrit');
    } catch (HeroException $e) {
        echo '<p>Erreur : ' . $e->getMessage() . '</p>';
    }
}

main();
