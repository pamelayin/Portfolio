
/*********************************************************************
** Program name:Bathroom.cpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is source file for Bathroom child class. This class
**		inherits from the space class. It will assign a new name and 
**		override description, menu, and explore virtual methods. This 
**		class contains random pick to lose patience points.
*********************************************************************/
#include "Bathroom.hpp"
#include <iostream>
#include <cstdlib>

using std::cout;
using std::endl;

/*********************************************************************
*   		Bathroom::Bathroom() : Space()
* This is constructor for Bathroom class. It inherits properties of Space
* and assigns a new name.
**********************************************************************/
Bathroom::Bathroom() : Space() {
	spaceName = "BATHROOM";
}

/*********************************************************************
*   		void Bathroom::description()
* This function gives introduction to the room
**********************************************************************/
void Bathroom::description() {
	//can add different color for room in the map
	cout << "\n\t" << getLocation() << endl;
	cout << "Bathroom is one of your least favorite places in the house." 
	<< " You only have bad memories of getting soaked in water in this scary "
	<< "place. You feel hesitant to explore." << endl << endl;
}

/*********************************************************************
*   		char Bathroom::spaceMenu()
* This function gives user list of activities to choose from and matches
* the corresponding int choice with a char and returns that char. This
* char is accessed in Game class to determine what to do next.
**********************************************************************/
char Bathroom::spaceMenu() {
	cout << "1. Move right to " << getRight() << endl;
	cout << "2. Explore" << endl;
	cout << "3. Current Status" << endl;
	cout << "4. Map" << endl;
	cout << "5. Inventory" << endl;

	int choice = numInputVal(1,5);

	//return char based on user's choice
	switch(choice) {
		case 1:
			return 'B';
		case 2:
			return 'E';
		case 3:
			return 'S';
		case 4:
			return 'M';
		case 5:
			return 'I';
	}
}

/*********************************************************************
*   	bool Bathroom::explore(Cat *cat)
* This function has random number generator that has 50% chance of losing
* patience points. It then proceeds to finding item, and if user selects
* to take it or not.
**********************************************************************/
bool Bathroom::explore(Cat *cat) {
	//random event 
	int badluck = rand() % 2;
	//lose patience points
	if (badluck == 1) {
		cout << "You accidentally stepped on a wet floor tile. It's making you cranky." << endl;
		cat->losePatience(5);
	}
	cout << endl;
	
	//check if room has item
	if (hasItem() == true) {
		cout << endl;
		cout << "You found " << itemPtr->getItemName() << "." << endl;
		cout << "It must have rolled inside when you were chasing it in the bedroom." << endl << endl;
		cout << "Do you want to take it with you?" << endl;
		cout << "1. Yes\t2. No" << endl;
		int userInput = numInputVal(1,2);
		
		//add to inventory
		if (userInput == 1) {
			cat->addItem(itemPtr);
			//if added to inventory, then set ptr to null
			if (cat->addItemSuccess() == true) {
				itemPtr = nullptr;
			}
		}
	} else {
		cout << "There's nothing interesting here." << endl;
	}
	cout << endl;
	return false;
}
