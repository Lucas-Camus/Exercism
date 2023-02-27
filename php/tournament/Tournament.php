<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

class Tournament
{
	private $pointWin;
	private $pointDraw;
	private $pointLoose;
	private $teams = [];

	/**
	 * @param int $pointWin
	 * @param int $pointDraw
	 * @param int $pointLoose
	 */
    public function __construct(int $pointWin = 3,int  $pointDraw = 1, int $pointLoose = 0)
    {
		$this->pointWin = $pointWin;
		$this->pointDraw = $pointDraw;
		$this->pointLoose = $pointLoose;

    }

	/**
	 * @param string $score
	 * @return string|void
	 */
	public function tally(string $score  = '')
	{
		if($score){
			$games = explode("\n", $score);

			foreach($games as $game){
				[$teamA, $teamB, $result] = explode(';',$game);
				$this->teams[$teamA] ??= new Team($teamA);
				$this->teams[$teamB] ??= new Team($teamB);

				switch($result) {
					case 'win':
						$this->teams[$teamA]->addWin($this->pointWin);
						$this->teams[$teamB]->addLoose($this->pointLoose);
						break;
					case 'draw':
						$this->teams[$teamA]->addDraw($this->pointDraw);
						$this->teams[$teamB]->addDraw($this->pointDraw);
						break;
					case 'loss':
						$this->teams[$teamA]->addLoose($this->pointLoose);
						$this->teams[$teamB]->addWin($this->pointWin);
				}
			}

			$this->sortTeam($this->teams);
		}

		return self::formatResult($this->teams);
	}

	/***
	 * @param array $teams
	 * @return void
	 */
	private function sortTeam(array &$teams): void
	{
		usort($teams, fn($teamA, $teamB) => self::compareTeam($teamA,$teamB));
	}

	/**
	 * @param Team $a
	 * @param Team $b
	 * @return int
	 */
	private static function compareTeam(Team $a, Team $b) :int {
		if ($a->total < $b->total) return 1;
		elseif ($a->total > $b->total) return -1;
		else return strcmp($a->name, $b->name);
	}

	/**
	 * @param array $teams
	 * @return string
	 */
	private static function formatResult(array $teams) :string
	{
		$format =  "Team                           | MP |  W |  D |  L |  P";
		$print = "\n%-31s|  %d |  %d |  %d |  %d |  %d";

		if ($teams){
			foreach( $teams as $team){
				$format .= sprintf($print, $team->name , $team->matchPlayed , $team->win ,$team->draw , $team->loose , $team->total);
			}
		}

		return $format;
	}
}


/**
 *
 */
class Team {
	public int $matchPlayed = 0;
	public int $win         = 0;
	public int $draw = 0;
	public int $loose = 0;
	public int $total = 0;
	public string $name = "";

	public function  __construct($name = '') {
		$this->name = $name;
    }

	private function addMatch() {
		$this->matchPlayed ++;
	}

	public function addWin($point){
		$this->addMatch();
		$this->win ++;
		$this->total += $point;
	}

	public function addDraw($point){
		$this->addMatch();
		$this->draw ++;
		$this->total += $point;
	}

	public function addLoose($point){
		$this->addMatch();
		$this->loose ++;
		$this->total += $point;
	}

}
