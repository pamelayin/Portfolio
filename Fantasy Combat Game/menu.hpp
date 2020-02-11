/*********************************************************************
** Program name:menu.hpp
** Author: Pamela Yin
** Date: November 23, 2019
** Description: This is the header file for menu. It provides menu to
**		either play or quit game. If user selects play, It will create
**		game object, and create and implement the game. Then it will 
** 		call reprompt menu. The reprompt menu will ask to play again.
**		Otherwise the program is terminated. The menu validation will
**		check if user input right choice.
*********************************************************************/
#include "validation.hpp"
#include "Game.hpp"

#ifndef MENU_HPP
#define MENU_HPP

//function prototypes
void menu();
void playAgainMenu();

#endif