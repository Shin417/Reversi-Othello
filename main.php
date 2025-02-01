<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php
    class Board
    {
        public $board;
        public $count1=0;
        public $count2=0;
        function __construct(){
            $this->board = array(
                array(2, 2, 2, 2, 2, 2, 2, 2, 2, 2),
                array(2, 0, 0, 0, 0, 0, 0, 0, 0, 2),
                array(2, 0, 0, 0, 0, 0, 0, 0, 0, 2),
                array(2, 0, 0, 0, 0, 0, 0, 0, 0, 2),
                array(2, 0, 0, 0, -1, 1, 0, 0, 0, 2),
                array(2, 0, 0, 0, 1, -1, 0, 0, 0, 2),
                array(2, 0, 0, 0, 0, 0, 0, 0, 0, 2),
                array(2, 0, 0, 0, 0, 0, 0, 0, 0, 2),
                array(2, 0, 0, 0, 0, 0, 0, 0, 0, 2),
                array(2, 2, 2, 2, 2, 2, 2, 2, 2, 2)
            );
        }
        
        function displayBoard(){
            global  $board;
            $numbers = array(" ", " ", 1, 2, 3, 4, 5, 6, 7, 8);
            $alphabets = array(" ", "a", "b", "c", "d", "e", "f", "g", "h", " ");
            for ($i=0; $i < 10; $i++) { 
                echo($numbers[$i]);
            }
            echo("\n");
            for ($i=0; $i < 10; $i++) {
                echo($alphabets[$i]);
                for ($j=0; $j < 10; $j++) { 
                    if($this->board[$i][$j] == 2){
                        echo("#");
                    } elseif($this->board[$i][$j] == 1){
                        echo("*");
                    } elseif($this->board[$i][$j] == -1){
                        echo("@");
                    } elseif($this->board[$i][$j] == 0){
                        echo("□");
                    }
                }
                echo("\n");
            }
        
        }

        function countDisk(){
            global $count1, $count2;
            for ($i=1; $i <= 8; $i++){ 
                for($j=1; $j <=8; $j++){
                    if($this->board[$j][$i] == 1){
                        $this->count1++;
                    }elseif($this->board[$j][$i] == -1){
                        $this->count2++;
                    }
                }
            }
        }
    }

    class Player{
        public $side;
        public $validPlaceCount = 0;
        function __construct($side){
            $this->side = $side;
        }

        #check right side of the player's target place. if there is more than 1 the enemy's disk in a row next to the right side of the target place and plyer's disk next to them, return the number of enemy's disk between the target place and player's disk else return 0. 
        function countRight($board, $x, $y){
            #Enemy side
            $eSide = $this->side * -1;
            $i;
            $count = 0;
            for($i=1; $board->board[$y][$x+$i] == $eSide; $i++){
                $count++;
            }
            if($board->board[$y][$x+$i] == $this->side){
                return $count;
            } else {
                return 0;
            }
        }

        #same with checkRight but the opposit side
        function countLeft($board, $x, $y){
            $eSide = $this->side * -1;
            $i;
            $count = 0;
            for($i=1; $board->board[$y][$x-$i] == $eSide; $i++){
                $count++;
            }
            if($board->board[$y][$x-$i] == $this->side){
                return $count;
            } else {
                return 0;
            }
        }

        function countUp($board, $x, $y){
            $eSide = $this->side * -1;
            $i;
            $count = 0;
            for($i=1; $board->board[$y+$i][$x] == $eSide; $i++){
                $count++;
            }
            if($board->board[$y+$i][$x] == $this->side){
                return $count;
            } else {
                return 0;
            }
        }

        function countDown($board, $x, $y){
            $eSide = $this->side * -1;
            $i;
            $count = 0;
            for($i=1; $board->board[$y-$i][$x] == $eSide; $i++){
                $count++;
            }
            if($board->board[$y-$i][$x] == $this->side){
                return $count;
            } else {
                return 0;
            }
        }

        function countRightUp($board, $x, $y){
            $eSide = $this->side * -1;
            $i;
            $count = 0;
            for($i=1; $board->board[$y+$i][$x+$i] == $eSide; $i++){
                $count++;
            }
            if($board->board[$y+$i][$x+$i] == $this->side){
                return $count;
            } else {
                return 0;
            }
        }

        function countRightDown($board, $x, $y){
            $eSide = $this->side * -1;
            $i;
            $count = 0;
            for($i=1; $board->board[$y-$i][$x+$i] == $eSide; $i++){
                $count++;
            }
            if($board->board[$y-$i][$x+$i] == $this->side){
                return $count;
            } else {
                return 0;
            }
        }

        function countLeftUp($board, $x, $y){
            $eSide = $this->side * -1;
            $i;
            $count = 0;
            for($i=1; $board->board[$y+$i][$x-$i] == $eSide; $i++){
                $count++;
            }
            if($board->board[$y+$i][$x-$i] == $this->side){
                return $count;
            } else {
                return 0;
            }
        }

        function countLeftDown($board, $x, $y){
            $eSide = $this->side * -1;
            $i;
            $count = 0;
            for($i=1; $board->board[$y-$i][$x-$i] == $eSide; $i++){
                $count++;
            }
            if($board->board[$y-$i][$x-$i] == $this->side){
                return $count;
            } else {
                return 0;
            }
        }

        function targetValidation($board, $x, $y){
            if($board->board[$y][$x] == 0 and ($this->countRight($board, $x, $y) != 0 or $this->countLeft($board, $x, $y) != 0 or $this->countUp($board, $x, $y) != 0 or $this->countDown($board, $x, $y) != 0 or $this->countRightUp($board, $x, $y) != 0 or $this->countRightDown($board, $x, $y) != 0 or $this->countLeftUp($board, $x, $y) != 0 or $this->countLeftDown($board, $x, $y) != 0)){
                return True;
            } else {
                echo("You can't put disk on this place!\n");
                return False;
            }
        }

        function placeDisk($board, $x, $y){
            $board->board[$y][$x] = $this->side;
        }
 
        function reverse($board, $x, $y){
            if($this->countRight($board, $x, $y) != 0){
                $eSide = $this->side * -1;
                $i;
                for($i=1; $board->board[$y][$x+$i] == $eSide; $i++){
                    $board->board[$y][$x+$i] *= -1;
                }
            }
            if($this->countLeft($board, $x, $y) != 0){
                $eSide = $this->side * -1;
                $i;
                for($i=1; $board->board[$y][$x-$i] == $eSide; $i++){
                    $board->board[$y][$x-$i] *= -1;
                }
            }
            if($this->countUp($board, $x, $y) != 0){
                $eSide = $this->side * -1;
                $i;
                for($i=1; $board->board[$y+$i][$x] == $eSide; $i++){
                    $board->board[$y+$i][$x] *= -1;
                }
            }
            if($this->countDown($board, $x, $y) != 0){
                $eSide = $this->side * -1;
                $i;
                for($i=1; $board->board[$y-$i][$x] == $eSide; $i++){
                    $board->board[$y-$i][$x] *= -1;
                }
            }
            if($this->countRightUp($board, $x, $y) != 0){
                $eSide = $this->side * -1;
                $i;
                for($i=1; $board->board[$y+$i][$x+$i] == $eSide; $i++){
                    $board->board[$y+$i][$x+$i] *= -1;
                }
            }
            if($this->countRightDown($board, $x, $y)){
                $eSide = $this->side * -1;
                $i;
                for($i=1; $board->board[$y-$i][$x+$i] == $eSide; $i++){
                    $board->board[$y-$i][$x+$i] *= -1;
                }
            }
            if($this->countLeftUp($board, $x, $y) != 0){
                $eSide = $this->side * -1;
                $i;
                for($i=1; $board->board[$y+$i][$x-$i] == $eSide; $i++){
                    $board->board[$y+$i][$x-$i] *= -1;
                }
            }
            if($this->countLeftDown($board, $x, $y) != 0){
                $eSide = $this->side * -1;
                $i;
                for($i=1; $board->board[$y-$i][$x-$i] == $eSide; $i++){
                    $board->board[$y-$i][$x-$i] *= -1;
                }
            }
        }

        function countValidPlace($board){
            for ($i=1; $i <= 8; $i++) { 
                for ($j=1; $j <= 8; $j++) { 
                    if($board->board[$i][$j] == 0 and ($this->countRight($board, $j, $i) != 0 or $this->countLeft($board, $j, $i) != 0 or $this->countUp($board, $j, $i) != 0 or $this->countDown($board, $j, $i) != 0 or $this->countRightUp($board, $j, $i) != 0 or $this->countRightDown($board, $j, $i) != 0 or $this->countLeftUp($board, $j, $i) != 0 or $this->countLeftDown($board, $j, $i) != 0)){
                        $this->validPlaceCount++;
                    }
                }
            }
        }
    }



    function inputValidation($input){
        $numbers = array("1","2","3","4","5","6","7","8");
        $alphabets = array("a", "b", "c", "d", "e", "f", "g", "h");
        if(strlen($input) == 2){
            $number = substr($input, 1);
            $alphabet = substr($input,0, 1);
            if(in_array($number, $numbers) and in_array($alphabet, $alphabets)){
                $alphabet = array_search($alphabet, $alphabets) + 1;
                return array($number, $alphabet);
            } else {
                echo("Invalid Input\n");
                return False;
            }
        } elseif(strlen($input) == 3){
            $number = substr($input, 2);
            $alphabet = substr($input, 0, 2);
            if(in_array($number, $numbers) and in_array($alphabet, $alphabets)){
                $alphabet = array_search($alphabet, $alphabets) +1;
                return array($number, $alphabet);
            } else {
                echo("Invalid Input\n");
                return False;
            }
        }
    }
    
    function userPrompt($player){
        global $board, $x, $y;
        while(True){
            $target = readline("Enter the target place you want to put your disk: ");
            if (inputValidation($target) != False) {
                $x = (int)inputValidation($target)[0];
                $y = inputValidation($target)[1];
                break;
            } else {
                continue;
            }
        }
    }
    
    
    #side = 1 -> *  side = -1 -> @
    $x;
    $y;
    $board = new Board();
    $player1 = new Player(1);
    $player2 = new Player(-1);

    echo("#########\n");
    echo("#Reversi#\n");
    echo("#########\n");
    echo("\n");
    echo("\n");
    sleep(2);

    $player1->countValidPlace($board);
    $player2->countValidPlace($board);
    while($player1->validPlaceCount != 0 or $player2->validPlaceCount !=0){
        $board->displayBoard();
        echo("Player1's turn!\n");
        while(True){
            if($player1->validPlaceCount == 0){
                echo("You can't put your disk anywhere. You skipp your turn.\n");
                break;
            }
            userPrompt($player1);
            if($player1->targetValidation($board, $x, $y)){
                $player1->placeDisk($board, $x, $y);
                $player1->reverse($board, $x, $y);
                $player1->countValidPlace($board);
                break;
            } else {
                continue;
            }
        }

        $board->displayBoard();

        echo("Player2's turn!\n");
        while(True){
            if($player2->validPlaceCount == 0){
                echo("You can't put your disk anywhere. You skipp your turn.\n");
                break;
            }
            userPrompt($player2);
            if($player2->targetValidation($board, $x, $y)){
                $player2->placeDisk($board, $x, $y);
                $player2->reverse($board, $x, $y);
                $player2->countValidPlace($board);
                break;
            } else {
                continue;
            }
        }
    }
    echo("Game Over!\n");
    $board->countDisk();
    if($board->count1 > $board->count2){
        echo("Player1 Won The Game!\n");
    } elseif($board->count1 < $board->count2){
        echo("Player2 Won The Game!\n");
    } else{
        echo("Draw");
    }

    
    #echo("#########\n");
    #echo("#Reversi#\n");
    #echo("#########\n");
    #sleep(3);
    

    
?>