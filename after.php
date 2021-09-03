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

    protected function __construct(int $pointsDeVie, int $weapon)
    {
        $this->pointsDeVie = $pointsDeVie;
        $this->weapon      = $weapon;
        $this->positionY  = 0;
        $this->positionX  = 0;
    }

    public function deplacement(int $case, string $direction): string
    {
        $splitDirection = str_split($direction);
        if (!is_array($splitDirection) || count($splitDirection) > 2) {
            throw new HeroException('Direction incorrecte');
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

        return $this->positionX.';'.$this->positionY;
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
        'ifrit'   => 50,
        'shiva'   => 80,
        'Bahamut' => 80000
    ];

    public function __construct(int $pointsDeVie, int $weapon = 50)
    {
        parent::__construct($pointsDeVie, $weapon);
    }

    public function invoquer(string $creature): array
    {
        return array_key_exists($creature, self::INVOCATIONS) ?
            ['nom' => $creature, 'pdv' => self::INVOCATIONS[$creature]] :
            ['nom' => 'Démon inconnu', 'pdv' => 100];
    }
}

/**
 * Class HeroException
 */
class HeroException extends Exception
{
}

function main()
{
    $joueur_1 = new Archer(100);
    $joueur_2 = new Sorcier(100, 100);

    $joueur_1->deplacement(6, 'N');
    $joueur_1->deplacement(6, 'N');
    $joueur_1->deplacement(6, 'N');
    echo $joueur_1->deplacement(6, 'N');
    echo "<br>";
    echo $joueur_2->deplacement(4, 'NE');
    echo "<br>";

    $invocation = $joueur_2->invoquer("ifrit");
}

main();
