<?php

// namespace PlayingCard;

/**
 *
 */
class Card
{
    /**
     * {@inheritdoc}
     */

    function __construct() {
	    $this->shuffle();
	}

    private $card = [
		    	'AD', '2D', '3D', '4D', '5D', '6D', '7D', '8D', '9D', 'TD', 'JD', 'QD', 'KD',
		    	'AC', '2C', '3C', '4C', '5C', '6C', '7C', '8C', '9C', 'TC', 'JC', 'QC', 'KC',
		    	'AH', '2H', '3H', '4H', '5H', '6H', '7H', '8H', '9H', 'TH', 'JH', 'QH', 'KH',
		    	'AS', '2S', '3S', '4S', '5S', '6S', '7S', '8S', '9S', 'TS', 'JS', 'QS', 'KS'
			];
	private $partition = [];
	public $noPlayer = 0;

	/**
     * {@inheritdoc}
     *	shuffle the cards array
     */
    private function shuffle()
    {
    	shuffle($this->card);
    }

    private function distribution() {
    	if($this->noPlayer > 0)
    	{
    		$listlen = count($this->card);										// get total length of card array
		    $partlen = floor($listlen / $this->noPlayer);						// Round the length down to the nearest integer
		    $partrem = $listlen % $this->noPlayer;								// get the balance
		    $mark = 0;
		    for($k = 0; $k < $this->noPlayer; $k ++) {
		        $incr = ($k < $partrem) ? $partlen + 1 : $partlen;
		        $this->partition[$k] = array_slice($this->card, $mark, $incr);
		        $mark += $incr;
	    	}
    	}
	}

    public function getCard()
    {
    	$this->distribution();
        return $this->partition;
    }

}


$model = new Card;
$model->noPlayer = $_GET['noPlayer'];

$data = json_encode($model->getCard());

echo $data;