/*********************************************************************
** Program name:main.cpp
** Author: Pamela Yin
** Date: November 23, 2019
** Description: This is the main file for project4. The main will call 
** 		menu, which will display the game menu for fantasy combat game.
**		This game will let user pick team members and name/type for each
**		character. Each round will call first player in each team's queue
**		and battle (same as project 3). Then winner will recover a portion
**		of strength points and go back into queue and winning team and 
**		losing team are assigned points. The final winner will be determined
**		by total points each team has.
*********************************************************************/
#include "menu.hpp"
#include <ctime>
#include <cstdlib>

int main() {
	//generate random seed based on the time for rand functions
	srand(time(NULL));
	//print menu and execute
	menu();

	return 0;
}

