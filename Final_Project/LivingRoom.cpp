
/*********************************************************************
** Program name:LivingRoom.cpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is source file for LivingRoom child class. This class
**		inherits from the space class. It will assign a new name and 
**		override description, menu, and explore virtual methods. This
**		class inherits the explore function from Space.
*********************************************************************/
#include "LivingRoom.hpp"
#include <iostream>

using std::cout;
using std::endl;

/*********************************************************************
*   		LivingRoom::LivingRoom() : Space()
* This is constructor for LivingRoom class. It inherits properties of Space
* and assigns a new name.
**********************************************************************/
LivingRoom::LivingRoom() : Space() {
	spaceName = "LIVING ROOM";
}

/*********************************************************************
*   		void LivingRoom::description()
* This function gives introduction to the room
**********************************************************************/
void LivingRoom::description() {
	//can add different color for room in the map
	cout << "\n\t" << getLocation() << endl;
	cout << "This is the living room, where you spend most of your day "
	<< "relaxing. You usually play with toys and look out the window "
	<< "from here." << endl << endl;
}

/*********************************************************************
*   		char LivingRoom::spaceMenu()
* This function gives user list of activities to choose from and matches
* the corresponding int choice with a char and returns that char. This
* char is accessed in Game class to determine what to do next.
**********************************************************************/
char LivingRoom::spaceMenu() {
	cout << "1. Move left to " << getLeft() << endl;
	cout << "2. Move right to " << getRight() << endl;
	cout << "3. Move up to " << getTop()<< endl;
	cout << "4. Explore" << endl;
	cout << "5. Current Status" << endl;
	cout << "6. Map" << endl;
	cout << "7. Inventory" << endl; 

	//user input
	int choice = numInputVal(1,7);

	//return char based on input
	switch(choice) {
		case 1:
			return 'B';
		case 2:
			return 'O';
		case 3:
			return 'K';
		case 4:
			return 'E';
		case 5:
			return 'S';
		case 6: 
			return 'M';
		case 7:
			return 'I';
	}
}