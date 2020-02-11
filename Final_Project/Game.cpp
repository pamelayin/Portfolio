/*********************************************************************
** Program name:Game.cpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is the source file for Game class. This is where 
**		the game is implemented. The constructor initializes all game
**		settings by creating new objects for pointers, link the spaces,
**		place items. Destructor will erase all dynamic memory used.
**		There are functions to help with visuals and operation, such as
**		clearScreen, continuePlay, goBackToRoom. There are methods to
**		run the game: play and action. There are also methods to keep
**		track of the game such as showStatus, checkStatus, getStepCount.
*********************************************************************/
#include "Game.hpp"
#include <iostream>
#include <limits>
#include <iomanip>
#include <cstdlib>

using std::cout;
using std::endl;
using std::cin;
using std::streamsize;

/*********************************************************************
*   		Game::Game()
* The constructor creates new Cat (player) object, new Spaces, new Items,
* and initialize starting stepCount (time). Then it links the spaces 
* together using Space's set direction methods by passing in the spaces
* to assign to left, right, top, bottom space pointers. The items are 
* placed in appropriate spaces using setItemLocation method. Then the
* space pointer will set starting location at living room to initiate
* the game.
**********************************************************************/
Game::Game() {
	stepCount = 30;
	//player
	cat = new Cat();
	//spaces
	livingRoom = new LivingRoom();
	outside = new Outside();
	patio = new Patio();
	kitchen = new Kitchen();
	bedroom = new Bedroom();
	bathroom = new Bathroom();
	//items
	mouseToy = new Item("MOUSE TOY");
	leaf = new Item("LEAF");
	ball = new Item("BALL");
	collar = new Item("COLLAR");

	//place items
	livingRoom->setItemLocation(mouseToy);
	patio->setItemLocation(leaf);
	bathroom->setItemLocation(ball);
	bedroom->setItemLocation(collar);

	//link the rooms
	livingRoom->setRight(outside);
	livingRoom->setTop(kitchen);
	livingRoom->setLeft(bedroom);
	livingRoom->setBottom(nullptr);
	outside->setLeft(livingRoom);
	outside->setRight(nullptr);
	outside->setTop(nullptr);
	outside->setBottom(nullptr);
	patio->setRight(kitchen);
	patio->setBottom(bedroom);
	patio->setLeft(nullptr);
	patio->setTop(nullptr);
	bedroom->setTop(patio);
	bedroom->setLeft(bathroom);
	bedroom->setRight(livingRoom);
	bedroom->setBottom(nullptr);
	kitchen->setLeft(patio);
	kitchen->setBottom(livingRoom);
	kitchen->setRight(nullptr);
	kitchen->setTop(nullptr);
	bathroom->setRight(bedroom);
	bathroom->setLeft(nullptr);
	bathroom->setTop(nullptr);
	bathroom->setBottom(nullptr);

	//start game at living room 
	spacePtr = livingRoom;
}

/*********************************************************************
*   		void Game::clearScreen()
* This clears the screen by adding 50 lines of spaces
**********************************************************************/
void Game::clearScreen() {
	//reference:http://www.cplusplus.com/forum/beginner/3304/
    cout << string(50, '\n' );
}

/*********************************************************************
*   		void Game::continuePlay()
* This function lets the user to press enter to continue to next line
**********************************************************************/
void Game::continuePlay() {
	cout << "Press ENTER key to continue" << endl;
	//reference: https://stackoverflow.com/questions/903221/press-enter-to-continue
	cin.ignore(std::numeric_limits<streamsize>::max(),'\n');
}

/*********************************************************************
*   		void Game::goBackToRoom()
* This function lets the user to press enter to go back to room
**********************************************************************/
void Game::goBackToRoom() {
	cout << "Press ENTER to go back to room" << endl;
	cin.ignore(std::numeric_limits<streamsize>::max(),'\n');
}

/*********************************************************************
*   		void Game::play()
* This starts the game. It will display map, instructions, then start
* the game by calling action function, and everything will be looped 
* there.
**********************************************************************/
void Game::play() {
	//show map
	cout << "Before you go anywhere, you might want to take a look at the map "
	<< "to familiarize with the house first." << endl;
	spacePtr->showMap();

	continuePlay();
	clearScreen();

	//instructions
	cout << "\t\tGame Instructions" << endl;
	cout << "Choose an option by pressing the corresponding "
	<< "number and press ENTER to execute." << endl << endl;
	continuePlay();
	clearScreen();

	//start game
	cout << "(Ф ﻌ Ф) Sneaky Cat Mode Activated (Ф ﻌ Ф)" << endl;
	showStatus();

	action(spacePtr->display());
	
}

/*********************************************************************
*   		void Game::action(char userChoice)
* The function passes in the char user picked from numbers in the space
* menus. For every move to a different room, stepCount decreases. Each
* char will either assign spacePtr to that room, or call the appropriate
* function for status related cases.
**********************************************************************/
void Game::action(char userChoice) {
	cout << endl;
	switch(userChoice) {
		case 'T':
			//bathroom
			stepCount--;
			spacePtr = bathroom;			
			break;
		case 'B':
			//bedroom
			stepCount--;
			spacePtr = bedroom;			
			break;
		case 'P':
			//patio
			stepCount--;
			spacePtr = patio;			
			break;
		case 'K':
			//kitchen
			stepCount--;
			spacePtr = kitchen;			
			break;
		case 'L':
			//living room
			stepCount--;
			spacePtr = livingRoom;
			break;
		case 'O':
			//outside
			stepCount--;
			spacePtr = outside;			
			break;
		case 'I':
			//inventory
			cat->showInventory();
			goBackToRoom();
			break;
		case 'S':
			//status
			showStatus();
			goBackToRoom();
			break;
		case 'M':
			//map
			spacePtr->showMap();
			goBackToRoom();
			break;
		case 'E':
			//explore
			stepCount--;
			gameWon = spacePtr->explore(cat);
			if (gameWon == false) {
				goBackToRoom();
			break;
			}
	}
	//continue game if patience and step count left and user didn't win
	if (checkStatus() == true && gameWon == false) {
		action(spacePtr->display());
	//win game 
	} else if (gameWon == true) {
		cout << endl << endl;
		cout << " (=^ ◡ ^=) (=^ ◡ ^=) (=^ ◡ ^=) (=^ ◡ ^=)" << endl;
		cout << "                                          " << endl;
		cout << "       Congratulations! You Won!!	 	   " << endl;
		cout << "                                          " << endl;
		cout << " (=^ ◡ ^=) (=^ ◡ ^=) (=^ ◡ ^=) (=^ ◡ ^=)" << endl;
	}
}

/*********************************************************************
*   		void Game::showstatus()
* The function keeps track of patience points and step counts (time)
**********************************************************************/
void Game::showStatus() {
	cout << endl;
	cout << "*************************" << endl;
	cout << "*    Current Status     *" << endl;
	
	//patience
	//reference: https://stackoverflow.com/questions/530614/print-leading-zeros-with-c-output-operator
	cout << "*   Patience: " << std::setw(2) << std::setfill('0') 
	<< cat->getPatience() << "/" << cat->getMaxPatience() << "     *" << endl;
	
	//step count (time)
	cout << "*  Time (Steps): " << std::setw(2) << std::setfill('0')
	<< getStepCount() << "/" << maxStepCount << "  *" << endl;
	
	cout << "*************************" << endl;
}

/*********************************************************************
*   		bool Game::checkStatus()
* The function checks for patience points or step count <= 0, and if 
* so, display message and end the game.
**********************************************************************/
bool Game::checkStatus() {
	//patience
	if (cat->hasPatience() == false) {
		cout << "\nYou lost all patience. You give up and decide to take a nap and "
		<< "wait for hooman to come back home to feed you." << endl;
		cout << "\n====================Game Over====================\n" << endl;
		return false;
	//steps (time)
	} else if (stepCount <= 0) {
		cout << "\nOh no! Hooman is back. You ran out of time. You act cute in front of hooman "
		<< "as if nothing happened and secretly plot to do it again another time." << endl;
		cout << "\n====================Game Over====================\n" << endl;
		return false;
	} else {
		return true;
	}
}

/*********************************************************************
*   		int Game::getStepCount()
* Returns stepCount
**********************************************************************/
int Game::getStepCount() {
	return stepCount;
}

/*********************************************************************
*   		Game::~Game()
* Destructor that deletes all the objects created in the constructors
**********************************************************************/
Game::~Game() {
	delete cat;
	//spaces
	delete livingRoom;
	delete outside;
	delete patio;
	delete kitchen;
	delete bedroom;
	delete bathroom;
	//items
	delete mouseToy;
	delete leaf;
	delete ball;
	delete collar;
}