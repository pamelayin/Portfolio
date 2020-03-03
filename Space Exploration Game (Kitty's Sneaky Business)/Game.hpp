/*********************************************************************
** Program name:Game.hpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is the header file for Game class. This is where 
**		the game is implemented. The constructor initializes all game
**		settings by creating new objects for pointers, link the spaces,
**		place items. Destructor will erase all dynamic memory used.
**		There are functions to help with visuals and operation, such as
**		clearScreen, continuePlay, goBackToRoom. There are methods to
**		run the game: play and action. There are also methods to keep
**		track of the game such as showStatus, checkStatus, getStepCount.
*********************************************************************/
#include "Cat.hpp"
#include "Space.hpp"
#include "LivingRoom.hpp"
#include "Kitchen.hpp"
#include "Patio.hpp"
#include "Bedroom.hpp"
#include "Bathroom.hpp"
#include "Outside.hpp"

#ifndef Game_HPP
#define Game_HPP

class Game {
	private:
		//variables
		int stepCount = 0;
		const int maxStepCount = 30;
		bool gameWon = false;

		//pointers
		//space related 
		Space *spacePtr = nullptr;

		Space *livingRoom;
		Space *outside;
		Space *patio;
		Space *kitchen;
		Space *bedroom;
		Space *bathroom;
		
		//item related
		Item *mouseToy;
		Item *collar;
		Item *leaf;
		Item *ball;

		Cat *cat;
	public:
		//constructor and destructor
		Game();
		~Game();
		
		//methods
		void clearScreen();
		void continuePlay();
		void goBackToRoom();
		void play();
		void action(char userChoice);
		void showStatus();
		bool checkStatus();
		int getStepCount();		

};

#endif