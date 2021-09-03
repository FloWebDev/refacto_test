<?php

class Archer
{
    private $pointsdevie;
    private $fleches;
    public $position_x;
    public $position_y;

    public function __construct(int $pointsdevie, int $fleches = 10)
    {
        $this->pointsdevie = $pointsdevie;
        $this->fleches     = $fleches;
        $this->position_y  = 0;
        $this->position_x  = 0;
    }

    public function deplacement(int $case, string $direction)
    {
        for ($i = 0; $i < $case; $i++) {
            if ($direction == 'N') {
                $this->position_y++;
            } elseif ($direction == 'NE') {
                $this->position_x++;
                $this->position_y++;
            } elseif ($direction == 'E') {
                $this->position_x++;
            } elseif ($direction == 'SE') {
                $this->position_x++;
                $this->position_y--;
            } else {
                // etc..
            }
        }

        return $this->position_x.';'.$this->position_y;
    }
}

class Sorcier
{
    private $pointsdevie;
    private $pointsdemana;
    public $position_x;
    public $position_y;

    public function __construct(int $pointsdevie, int $pointsdemana = 50)
    {
        $this->pointsdevie  = $pointsdevie;
        $this->pointsdemana = $pointsdemana;
        $this->position_y   = 0;
        $this->position_x   = 0;
    }

    public function deplacement(int $case, string $direction)
    {
        for ($i = 0; $i < $case; $i++) {
            if ($direction == 'N') {
                $this->position_y++;
            } elseif ($direction == 'NE') {
                $this->position_x++;
                $this->position_y++;
            } elseif ($direction == 'E') {
                $this->position_x++;
            } elseif ($direction == 'SE') {
                $this->position_x++;
                $this->position_y--;
            } else {
                // etc..
            }
        }
        return $this->position_x.';'.$this->position_y;
    }

    public function invoquer(string $creature)
    {
        if ($creature == "ifrit") {
            return invoquer("ifrit", 50);
        } elseif ($creature == "shiva") {
            return invoquer("shiva", 80);
        } elseif ($creature == "Bahamut") {
            return invoquer("Bahamut", 80000);
        } else {
            return invoquer("Démon inconnu", 100);
        }
    }
}

function invoquer($creature, $pointsdevie)
{
    return [
        'nom' => $creature,
        'pdv' => $pointsdevie
    ];
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
