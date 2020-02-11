/*********************************************************************
** Program name:Game.cpp
** Author: Pamela Yin
** Date: November 23, 2019
** Description: This is the source file for Game class. This utilizes 
**		most of code written for project3. It added queues where team
**		A and B members are contained that has adding to back, removing
**		front, and move to back functions. The losers are added to loser
**		stack. After each game, teams are assigned points and the winning 
**		team is determined at the end of the tournament.
*********************************************************************/
#include "Game.hpp"
#include <iostream>
#include <string>

using std::string;
using std::cout;
using std::endl;
using std::cin;


/*********************************************************************
*   void Game::createGame()
* This void function will prompt user for team size, create teams 
* (queues) A and B, and create stack for losers. Then it will call
* createTeam method to create two teams and display the team members.
**********************************************************************/
void Game::createGame() {
	//set team size, create containers for team A, B, loser pile
	cout << "Please choose how many team members (1-10) to have on each team." << endl;
	cout << "Team size: ";
	teamSize = numInputVal(1,10);
	teamA = new Queue();
	teamA->setQueueName("Team A");
	teamB = new Queue();
	teamB->setQueueName("Team B");
	loserStack = new Stack();

	//create teams and display members
	createTeam(teamAChar, teamA);
	createTeam(teamBChar, teamB);
	cout << "\t\tTeam A Lineup" << endl;
	teamA->traverse();
	cout << "\t\tTeam B Lineup" << endl;
	teamB->traverse();
}

/*********************************************************************
*   void Game::createTeam(Character* teamChar, Queue* &team)
* This void function will prompt user for character type, create characters
* based on the type by calling createCharacter method. Then it will add
* the character to the team's queue. This is iterated using for loop until
* all characters are initialized based on team size.
**********************************************************************/
void Game::createTeam(Character* teamChar, Queue* &team) {
	for (int i = 0; i < teamSize; i++) {
		//prompt user for character type
		cout << "\nPlease choose " << team->getQueueName() << " member " << i+1 << "." << endl;
		cout << "1. Vampire\t2. Barbarian\t3. Blue Men\t4. Medusa\t5. Harry Potter" << endl;
		int choice = numInputVal(1,5);
		
		//create character, add to team's queue
		teamChar = createCharacter(choice);
		team->addLast(teamChar);
	}
}

/*********************************************************************
*  Character* Game::createCharacter(int choice)
* This function will take user's choice as int as parameter, and create
* character dynamically. Then it prompts user for name, and set the name
* to the character. The function will return a character pointer.
**********************************************************************/
Character* Game::createCharacter(int choice) {
	Character* player;
	switch (choice) {
		//user pick vampire
		case 1:
			player = new Vampire();
			break;
		//user pick barbarian
		case 2:
			player = new Barbarian();
			break;
		//user pick blue men
		case 3:
			player = new BlueMen();
			break;
		//user pick Medusa
		case 4:
			player = new Medusa();
			break;
		//use pick Harry Potter
		case 5:
			player = new HarryPotter();
			break;
	}
	//prompt user for name
	cout << "What would you like to name this character?" << endl;
	string name = "";
	getline(cin, name);
	while (name == "") {
		cout << "The name cannot be blank. Please input name again." << endl;
		getline(cin, name);
	}
	player->setName(name);
	return player;
}

/*********************************************************************
*   			void Game::play()
* This void function creates characters, and implements play. The game picks 
* the first attacker by picking a player at random. After the attacking
* character attacks the defender, if both are alive, the defender and
* attacker will switch. This will run until one player dies. 
* First player of each team is assigned to play the game. After
* one character dies, the loser will be removed from team and put into 
* loser pile. The winner will recover 50% of strength points and go back
* into back of the queue. Each time a winner and loser is produced, each
* team is either given or taken points. Then when one of the team runs
* out of members, the game ends and winning team is announced.
**********************************************************************/
void Game::play() {
	//loop until one team runs out of characters
	while (teamA->isEmpty() == false && teamB->isEmpty() == false) {
		//the fist character in queue starts the game
		playerA = teamA->getHead();
		playerB = teamB->getHead();
		//bool to keep check if players are alive
		bool alive = true;

		//start game, display 
		cout << "------------------Game Start----------------" << endl;
		cout << "Team A Player is " << playerA->getType() << " " << playerA->getName() 
		<< " and Team B Player is " << playerB->getType() << " " << playerB->getName() <<"." << endl << endl;
		
		//random pick which player attacks first
		attackFirst = rand() % 2 + 1;
		int rounds = 0;
		//loop until one of the characters is dead
		while (alive == true) {
			//increase rounds count
			rounds++;
			cout << "\tRound " << rounds << " Fight!" << endl << endl;
			
			//Team A player attack first
			if (attackFirst == 1) {
				
				//set type of each character
				playerA->setAttackType("attacker");
				playerB->setAttackType("defender");

				//display who attacks first
				cout << "Team A Player " << playerA->getType() << " " 
				<< playerA->getName() << " attack Team B Player " 
				<< playerB->getType() << " " << playerB->getName() << " first." << endl;
				cout << endl;

				//Team A player attack"Team B player
				alive = halfRound();
				
				//check"Team B player is alive, if so, continue game
				if (alive == true) {

					//swap attacker and defender
					playerB->setAttackType("attacker");
					playerA->setAttackType("defender");

					//display
					cout << "Team B Player " << playerB->getType() << " " 
					<< playerB->getName() << " attack Team A Player " 
					<< playerA->getType() << " " << playerA->getName() << " next." << endl;
					cout << endl;

					//Team B player attack Team A player
					alive = halfRound();
				}
			//Team B player attack first
			} else {
				//set attacker and defender type for each player
				playerB->setAttackType("attacker");
				playerA->setAttackType("defender");

				//display
				cout << "Team B Player " << playerB->getType() << " " 
				<< playerB->getName() << " attack Team A Player " 
				<< playerA->getType() << " " << playerA->getName() << " first." << endl;
				cout << endl;
				
				//playerB attack playerA
				alive = halfRound();

				//if Team A player is alive, swap attacker and defender, play again
				if (alive == true) {
					//swap player type 
					playerA->setAttackType("attacker");
					playerB->setAttackType("defender");

					//display
					cout << "Team A Player " << playerA->getType() << " "
					<< playerA->getName() << " attack Team B Player " 
					<< playerB->getType() << " " <<playerB->getName() << " next." << endl;
					cout << endl;
					
					//Team A player attack"Team B player
					alive = halfRound();
				}
			}
		}
		//announce the winner - when player A wins
		if (playerA->isAlive() == true) {
			cout << "The winner of battle " 
			<< " is " << teamA->getQueueName() << " Player " 
			<< playerA->getType() << " " << playerA->getName() << "!" << endl;
			
			//loser put into loser stack, removed from team
			loserStack->addFirst(playerB);
			teamB->removeFirst();

			//winner recovers 50% of strength points and puts into the back of the queue
			playerA->recover();
			teamA->moveToBack(playerA);

			//assign team points
			teamA->winPoints();
			teamB->losePoints();

		//announce the winner - when player B wins
		} else {
			cout << "The winner of this battle"
			<< " is " << teamB->getQueueName() << " Player " 
			<< playerB->getType() << " " << playerB->getName() << "!" << endl;

			//loser put into loser stack, removed from team
			loserStack->addFirst(playerA);
			teamA->removeFirst();

			//winner recovers 50% of strength points and put into back of the queue
			playerB->recover();
			teamB->moveToBack(playerB);

			//assign team points
			teamB->winPoints();
			teamA->losePoints();
		}
		cout << endl;
		//display the team member status
		teamA->traverse();
		teamB->traverse();
		loserStack->traverse();
	}

	//announce the final winning team by comparing team points
	if (teamA->getTeamPoints() > teamB->getTeamPoints()) {
		cout << "Congratulations!!! " << endl;
		cout << teamA->getQueueName() << " won the fantasy combat tournament." << endl;
	} else if (teamB->getTeamPoints() > teamA->getTeamPoints()) {
		cout << "Congratulations!!! " << endl;
		cout << teamB->getQueueName() << " won the fantasy combat tournament." << endl;
	} else {
		cout << "There is no winner. This fantasy combat tournament ends in a draw." << endl;
	}
	cout << endl;

	//final team summary
	cout << "\t\tFinal Team Points Summary: " << endl;
	cout << teamA->getQueueName() << " total points: " << teamA->getTeamPoints() << endl;
	cout << teamB->getQueueName() << " total points: " << teamB->getTeamPoints() << endl << endl;
	string answer = "";


	//display loser list
	do {
		cout << "Display loser list? Y/N" << endl;
		getline(cin, answer);
		if (answer == "y" || answer == "Y") {
			loserStack->traverse();
		} else if (answer == "n" || answer == "N") {
			cout << "Loser list will not be disclosed." << endl;
		} else {
			cout << "Invalid entry. Please try again" << endl << endl;
		}
	} while (answer != "y" && answer != "Y" && answer != "n" && answer != "N");
	cout << endl;
}

/*********************************************************************
*   			bool Game::halfRound()
* This bool function will check which player is the attacker, and display
* message of which player is attacker and defender. For defender, it will
* call defenderSummary method from character class which will display 
* character's armor and strength points. Then it will have attacker 
* attack the defender by calling attack function. Then the defender
* player will use defense function with attacker's attack points as 
* parameter. Then it will check if the defender is still alive, if not
* it will display the defender player died and return true/false depend
* on if the defending character is alive or dead. If the defender is 
* alive, it will go back to play menu and continue another round.
**********************************************************************/

bool Game::halfRound() {
	if (playerA->getAttackType() == "attacker") {
		cout << endl;
		cout << "Attacker Type: " << "Team A Player " 
		<< playerA->getType() << " " << playerA->getName() << endl;
		cout << "Defender Type: " << "Team B Player " 
		<< playerB->getType() << " " << playerB->getName() << endl;
		
		//armor, strength points summary
		playerB->defenderSummary();
		cout << endl;

		//playerA attack
		cout << "Team A Player " << playerA->getType() << endl;
		playerA->attack();
		cout << endl;

		//playerB defend
		cout << "Team B Player " << playerB->getType() << endl;
		playerB->defense(playerA->getAttackPoints());
		cout << endl;

		//if"Team B player is dead, display message
		if (playerB->isAlive() == false) {
			cout << "Team B Player " << playerB->getType() << " " 
			<< playerB->getName() << " died." << endl;
		}
		cout << endl;
		//return true if"Team B player is alive, false if dead
		return playerB->isAlive();

	} else {
		cout << "Attacker Type: " << "Team B Player " 
		<< playerB->getType() << " " << playerB->getName() << endl;
		cout << "Defender Type: " << "Team A Player " 
		<< playerA->getType() << " " << playerA->getName() << endl;

		//armor, strength points summary
		playerA->defenderSummary();
		cout << endl;

		//playerB attack
		cout << "Team B Player " << playerB->getType() << endl;
		playerB->attack();
		cout << endl;

		//playerA defend
		cout << "Team A Player " << playerA->getType() << endl;
		playerA->defense(playerB->getAttackPoints());
		cout << endl;
		
		//if Team A player is dead, display message
		if (playerA->isAlive() == false) {
			cout << "Team A Player " << playerA->getType() << " " 
			<< playerA->getName() << " died." << endl;
		}
		cout << endl;
		//return true if Team A player is alive, false if dead
		return playerA->isAlive();	
	}
}

/*********************************************************************
*   		Game::~Game()
* Deconstructor to free the memory taken by the player pointers to the
* newly created queues/stack on heap.
**********************************************************************/
Game::~Game() {
	teamAChar = nullptr;
	teamBChar = nullptr;
	playerA = nullptr;
	playerB = nullptr;
	delete teamA;
	delete teamB;
	delete loserStack;
}