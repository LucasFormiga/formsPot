<?php

/*
	fPot
	Version: 1.0
	Author: Forms [github.com/LucasFormiga]
	> System Settings
*/

// Imports
require_once 'database.manager.php';
require_once '../settings.php';
require_once 'vendors/steamauth/steamauth.php';
if (!isset($_SESSION['steamid'])):
	header_remove();
	http_response_code(403);
	return;
endif;

class UserManager
{

	private $uName;
	private $uAvatar;
	private $uProfileURL;
	private $u64ID;

	public function __construct()
	{
		// Setup vars data
		$this->uName 		= $_SESSION['steam_personaname'];
		$this->uAvatar 		= $_SESSION['steam_avatarfull'];
		$this->uProfileURL	= $_SESSION['steam_profileurl'];
		$this->u64ID 		= $_SESSION['steam_steamid'];
	}

	public function getUserName()
	{
		return $this->uName;
	}

	public function getUserAvatar()
	{
		return $this->uAvatar;
	}

	public function getUserProfileURL()
	{
		return $this->uProfileURL;
	}

	public function getUser64ID()
	{
		return $this->u64ID;
	}

	/*
	*	SHOW: Return a JSON string with data collected before
	*/
	public function returnData()
	{
		header_remove();
		http_response_code(200);
		
		$data = array(	'logged'		=> 1,
						'name' 			=> $this->getUserName(),
						'avatar' 		=> $this->getUserAvatar(),
						'profile_url'	=> $this->getUserProfileURL(),
						'id64'			=> $this->getUser64ID()
					);
		echo json_encode(array('success' => 1, 'data' => $data));
	}

	/*
	*	EXECUTE: Inserts the player into database if he's a new player
	*/
	public function setupUserOnDatabase()
	{
		if ($this->alreadyMember()):
			$this->updatePlayer();
			return;
		endif;

		$manager = new DatabaseManager();

		$insert = "INSERT INTO players (steam_64id, name, profile_url, trade_link, role, banned, ban_reason) VALUES (:id, :name, :url, :link, :role, :ban, :reason);";

		$prep = $manager->getDatabaseConnection()->prepare($insert);

		$prep->bindValue(':id', 		$this->getUser64ID(), 			PDO::PARAM_STR);
		$prep->bindValue(':name', 		$this->getUserName(), 			PDO::PARAM_STR);
		$prep->bindValue(':url', 		$this->getUserProfileURL(), 	PDO::PARAM_STR);
		$prep->bindValue(':link', 	'', 								PDO::PARAM_STR);
		$prep->bindValue(':role', 	0, 									PDO::PARAM_INT);
		$prep->bindValue(':ban', 		0, 								PDO::PARAM_INT);
		$prep->bindValue(':reason', 	'', 							PDO::PARAM_STR);

		$prep->execute();
	}

	/*
	*	EXECUTE: Update player data if he's already a member
	*/
	public function updatePlayer()
	{
		$manager = new DatabaseManager();

		$update = "UPDATE players SET name = :name, profile_url = :url WHERE steam_64id = :id";

		$prep = $manager->getDatabaseConnection()->prepare($update);

		$prep->bindValue(':id', 		$this->getUser64ID(), 			PDO::PARAM_STR);
		$prep->bindValue(':name', 		$this->getUserName(), 			PDO::PARAM_STR);
		$prep->bindValue(':url', 		$this->getUserProfileURL(), 	PDO::PARAM_STR);

		$prep->execute();
	}

	/*
	*	EXECUTE: Verifies the player to make sure if he is a new or is already a member
	*/
	public function alreadyMember()
	{
		$manager = new DatabaseManager();

		$select = "SELECT steam_64id FROM players WHERE steam_64id = :id";

		$prep = $manager->getDatabaseConnection()->prepare($select);

		$prep->bindValue(':id', 		$this->getUser64ID(), 			PDO::PARAM_STR);

		$prep->execute();

		if ($prep->rowCount() > 0):
			return true;
		else:
			return false;
		endif;
	}

}

$user_manager = new UserManager();
$user_manager->returnData();
$user_manager->setupUserOnDatabase();