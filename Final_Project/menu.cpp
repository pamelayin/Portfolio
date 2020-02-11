/*********************************************************************
** Program name:menu.cpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is the source file for menu. It provides user with
**		introduction to the game. It will create and implement the game. 
**		Then it will call reprompt menu. The reprompt menu will ask to 
**		play again. Otherwise the program is terminated. The menu 
**		validation will check if user input valid number.
*********************************************************************/
#include "menu.hpp"
#include <iostream>
#include <string>

using std::string;
using std::cout;
using std::endl;
using std::cin;

/*********************************************************************
 * 			void menu()
 * This is menu function that provides user with description and starts
 * the game. After the game is done, it deletes the dynamic object and
 * calls the reprompt menu.
 * ********************************************************************/
void menu() {
	//main menu display
	cout << "\n\t\t\t/ᐠ｡ꞈ｡ᐟ\\Kitty's Sneaky Business /ᐠ｡ꞈ｡ᐟ\\" << endl << endl;
	cout << "You are a spoiled house cat. You are loved and supplied with "
	<< "food and toys, but you are never satisfied because you don't get " 
	<< "to eat all you want because you are obese cat. Hooman has just left "
	<< "the house to get groceries, it is a good chance to sneak into the kitchen "
	<< "to find food to binge eat! However, you have very little patience and limited"
	<< "time to complete the mission. No time to lose! Let's go!" << endl << endl;
	
	//create game, play, delete 
	Game *game = new Game();
	game->play();
	delete game;

	//reprompt menu
	playAgainMenu();
}

/*********************************************************************
 * 			void playAgainMenu()
 * This is reprompt menu that will ask user to play game again or not.
 * User may select 1 for yes and 2 for no, and all other inputs will be
 * invalid and reprompted. If user selects yes, it will call menu function
 * again and play game again. If user selects no, program will terminate.
 * ********************************************************************/
void playAgainMenu() {
	//prompt user to keep playing or terminate
	cout << endl << "Play again?" << endl;
	cout << "1. Yes\t2. No" << endl;
	string choice;
	getline(cin, choice);
	cout << endl;
	
	if (choice == "1") {
		//continue play
		menu();
	} else if (choice == "2") {
		//quit the program
		cout << "Terminating Program. Goodbye!" << endl << endl;
	} else {
		cout << "Invalid entry. Please try again." << endl << endl;	
		playAgainMenu();
	}
}







