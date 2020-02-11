/*********************************************************************
** Program name:menu.cpp
** Author: Pamela Yin
** Date: November 23, 2019
** Description: This is the source file for menu. It provides menu to
**		either play or quit game. If user selects play, It will create
**		game object, and create and implement the game. Then it will 
** 		call reprompt menu. The reprompt menu will ask to play again.
**		Otherwise the program is terminated. The menu validation will
**		check if user input right choice.
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
 * This is menu function that asks player to play game or terminate. If 
 * play, then create game and play game, and call reprompt menu. If no,
 * then exit the program. Method will check for invaild entries.
 * ********************************************************************/
void menu() {
	//main menu display
	cout << "\n\t\tFantasy Combat Game" << endl << endl;
	cout << "This game consists of two teams, each team can have characters"
	<< " which user can pick how many and what type. Each round, one character of" 
	<< " each team's queue will fight. Winner will heal and wait for next turn, and"
	<< " loser will die and eliminated from the team. Winning team will get 2 points" 
	<< " and losing team will lose 1 point. At the end, winning team will be announced."
	<< endl << endl;

	cout << "Please input your choice." << endl;
	//prompt user to keep playing or terminate
	cout << "1. Play" << endl;
	cout << "2. Exit" << endl << endl;
	string choice;
	getline(cin, choice);
	cout << endl;

	//play
	if (choice == "1") {
		//create game and play with selected characters
		Game game;
		game.createGame();
		game.play();
		
		//reprompt menu to play again
		playAgainMenu();

	//quit 
	} else if (choice == "2") {
		cout << "Terminating Program. Goodbye!" << endl << endl;

	//invalid entry - prompt again
	} else {
		cout << "Invalid entry. Please try again." << endl << endl;	
		menu();
	}
	
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
	//continue play
	if (choice == "1") {
		menu();
	//terminate game
	} else if (choice == "2") {
		//quit the program
		cout << "Terminating Program. Goodbye!" << endl << endl;
	} else {
		cout << "Invalid entry. Please try again." << endl << endl;	
		playAgainMenu();
	}
}
