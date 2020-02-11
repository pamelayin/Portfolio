/*********************************************************************
** Program name:Game.hpp
** Author: Pamela Yin
** Date: November 23, 2019
** Description: This is the header file for Game class. This utilizes 
**		most of code written for project3. It added queues where team
**		A and B members are contained that has adding to back, removing
**		front, and move to back functions. The losers are added to loser
**		stack. After each game, teams are assigned points and the winning 
**		team is determined at the end of the tournament.
*********************************************************************/
#include "Character.hpp"
#include "Vampire.hpp"
#include "Barbarian.hpp"
#include "BlueMen.hpp"
#include "Medusa.hpp"
#include "HarryPotter.hpp"
#include "Queue.hpp"
#include "Stack.hpp"
#include "validation.hpp"
#include <string>

#ifndef GAME_HPP
#define GAME_HPP

using std::string;

class Game {
	
	public:
		//deconstructor
		~Game();

		//methods
		void createTeam(Character* teamChar, Queue* &team);
		void createGame();
		Character* createCharacter(int charChoice);
		void play();
		void roundSummary();
		bool halfRound();
	
	private:
		//variables
		int charChoice;
		int teamSize;
		int attackFirst = 0;
		Character *teamAChar, *playerA;
		Character *teamBChar, *playerB;
		Queue* teamA;
		Queue* teamB;
		Stack* loserStack;


};

#endif