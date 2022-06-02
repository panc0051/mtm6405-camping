<?php
session_start();
/**********************************************
 * STARTER CODE
 **********************************************/

/**
 * clearSession
 * This function will clear the session.
 */
function clearSession()
{
  session_unset();
  header("Location: " . $_SERVER['PHP_SELF']);
}

/**
 * Invokes the clearSession() function.
 * This should be used if your session becomes wonky
 */
if (isset($_GET['clear'])) {
  clearSession();
}

/**
 * getResponse
 * Gets the response history array from the session and converts to a string
 * 
 * This function should be used to get the full response array as a string
 * 
 * @return string
 */
function getResponse()
{
  return implode('<br><br>', $_SESSION['camping']['response']);
}

/**
 * updateResponse
 * Adds a new response to the response array found in session
 * Returns the full response array as a string
 * 
 * This function should be used each time an action returns a response
 * 
 * @param [string] $response
 * @return string
 */
function updateResponse($response)
{
  if (!isset($_SESSION['camping'])) {
    createGameData();
  }

  array_push($_SESSION['camping']['response'], $response);

  return getResponse();
}

/**
 * help
 * Returns a formatted string of game instructions
 * 
 * @return string
 */
function help()
{
  return 'Welcome to Camping, the text based camping game. Use the following commands to play the game: <span class="red">fire</span>, <span class="red">wood</span>, <span class="red">tent</span>, <span class="red">roast</span>, <span class="red">rest</span>. To restart the game use the <span class="red">restart</span> command For these instruction again use the <span class="red">help</span> command';
}

/**********************************************
 * YOUR CODE BELOW
 **********************************************/

/**
 * createGameData
 * Creates the game data array and adds it to the session
 * - response array
 * - marshmallows: number of marshmallows
 * - wood: number 
 * - fire: boolean(if true then fire is on, if false then fire is off)
 * - tent: boolean(if true then tent is set up, if false then tent is not set up)
 * returns boolean based on if the session was created or not
 */
function createGameData()
{
  $_SESSION['camping'] = [
    'response' => [],
    "marshmallows" => 3,
    'wood' => 0,
    'fire' => false,
    'tent' => false
  ];
  return isset($_SESSION['camping']);
}


/**
 * tent
 *set the tent property to true
 */
function tent()
{
  $_SESSION['camping']['tent'] = true;

  return updateResponse("You have a tent");
}
/**
 * wood
 * if the fire is not going
 * then increase the wood property by 1

 */
function wood()
{
  if ($_SESSION['camping']['fire'] == false) {
    $_SESSION['camping']['wood']++;
    return updateResponse("You have " . $_SESSION['camping']['wood'] . " wood");
  }


  return "You can't have wood while the fire is on";
}


/**
 * fire
 * 
 */

/**
 * roast
 * 
 */

/**
 * rest
 * 
 */



if (isset($_POST['command'])) {
  if (function_exists($_POST['command'])) {
    //Execute the function AND update the response
    updateResponse($_POST['command']());
  } else {
    updateResponse("{$_POST['command']} is not a valid command");
  }
}
