
/*********************************************************************
** Program name:Kitchen.cpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is source file for Kitchen child class. This class
**		inherits from the space class. It will assign a new name and 
**		override description, menu, and explore virtual methods. This is 
**		the final destination user will be in to win the game. The
**		explore function in this class utilizes useItem function from
**		the Cat class to solve the game.
*********************************************************************/
#include "Kitchen.hpp"
#include <iostream>

using std::cout;
using std::endl;

/*********************************************************************
*   		Kitchen::Kitchen() : Space()
* This is constructor for Kitchen class. It inherits properties of Space
* and assigns a new name.
**********************************************************************/
Kitchen::Kitchen() : Space() {
	spaceName = "KITCHEN";
}

/*********************************************************************
*   		void Kitchen::description()
*  This function gives introduction to the room
**********************************************************************/
void Kitchen::description() {
	cout << "\n\t" << getLocation() << endl;
	cout << "The hooman has denied your access to this place. Being the cat "
	<< "you are, you never listen to anyone and do whatever you want." << endl << endl;
}

/*********************************************************************
*   		char Kitchen::spaceMenu()
* This function gives user list of activities to choose from and matches
* the corresponding int choice with a char and returns that char. This
* char is accessed in Game class to determine what to do next.
**********************************************************************/
char Kitchen::spaceMenu() {
	cout << "1. Move left to " << getLeft() << endl;
	cout << "2. Move down to " << getBottom() << endl;
	cout << "3. Explore" << endl;
	cout << "4. Current Status" << endl;
	cout << "5. Map" << endl;
	cout << "6. Inventory" << endl;

	int choice = numInputVal(1,6);

	//match up user choice with char
	switch(choice) {
		case 1:
			return 'P';
		case 2:
			return 'L';
		case 3:
			return 'E';
		case 4:
			return 'S';
		case 5:
			return 'M';
		case 6:
			return 'I';
	}
}

/*********************************************************************
*   	bool Kitchen::explore(Cat *cat)
* This function is overrides the explore function in Space class. It 
* will display inventory and ask user to pick an item to use. If the 
* user picks the correct item, it will return true, if not return false.
**********************************************************************/
bool Kitchen::explore(Cat *cat) {
	cout << endl;
	cout << "You are standing in front of the cabinet which has your food. "
	<< "It has round knob, which you cannot open with your paws. You must use "
	<< "a tool. These are items in your inventory. Which one do you want to try?" << endl;
	cout << endl;

	//display inventory
	cat->readInventory();

	//inventory is not empty
	if (cat->getInventory().size() != 0) {
		//user pick
		int toolPickInput = numInputVal(1, cat->getInventory().size());
		//if item is right one to solve, then return true, else return false
		return cat->useItem(cat->getInventory()[toolPickInput-1]);
	} else {
		//inventory is empty
		cout << "You have nothing to use. Better go explore rest of the house!" << endl;
		return false;
	}
}