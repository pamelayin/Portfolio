/*********************************************************************
** Program name: main.cpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is the main file for final project. It calls on
**		menu which will provide user with choice to play the game. The 
**		game creates a cat and a house with 6 spaces (rooms). The game
**		starts with 30 steps (time) and 10 patience (HP). In each
**		room, cat can explore to find hints and items, and lose or gain
**		patience points. Cat can also access map and current status and
**		inventory. All movement would cost step. The game is won by 
**		finding partcular item at particular location to use in a 
**		different location without running out of time and HP. 
*********************************************************************/
#include "validation.hpp"
#include "menu.hpp"
#include <iostream>
#include <ctime>

using std::cout;
using std::endl;

int main() {
	srand(time(NULL));
	
	menu();
	
	return 0;
}