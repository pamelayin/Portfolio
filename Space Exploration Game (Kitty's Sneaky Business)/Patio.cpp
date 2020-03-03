
/*********************************************************************
** Program name:Patio.cpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is source file for Patio child class. This class
**		inherits from the space class. It will assign a new name and 
**		override description, menu, and explore virtual methods. This 
**		class contains an option to get a hint through explore.
*********************************************************************/
#include "Patio.hpp"
#include <iostream>

using std::cout;
using std::endl;

/*********************************************************************
*   		Patio::Patio() : Space()
* This is constructor for Patio class. It inherits properties of Space
* and assigns a new name.
**********************************************************************/
Patio::Patio() : Space() {
	spaceName = "PATIO";
}

/*********************************************************************
*   		void Patio::description()
* This function gives introduction to the room
**********************************************************************/
void Patio::description() {
	cout << "\n\t" << getLocation() << endl;
	cout << "You move to the patio. This is where you get your daily dose "
	<< "of sunbathing and look at the birds on the tree. There are chairs "
	<< "in the patio you use to jump into the kitchen window." << endl << endl;
}

/*********************************************************************
*   		char Patio::spaceMenu()
* This function gives user list of activities to choose from and matches
* the corresponding int choice with a char and returns that char. This
* char is accessed in Game class to determine what to do next.
**********************************************************************/
char Patio::spaceMenu() {
	cout << "1. Move down to " << getBottom() << endl;
	cout << "2. Move right to " << getRight() << endl;
	cout << "3. Explore" << endl;
	cout << "4. Current Status" << endl;
	cout << "5. Map" << endl;
	cout << "6. Inventory" << endl;

	int choice = numInputVal(1,6);

	//match up user choice with char 
	switch(choice) {
		case 1:
			return 'B';
		case 2:
			return 'K';
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
*   	bool Patio::explore(Cat *cat)
* This function is similar to the one in Space class except it gives 
* an option to do something else prior (jump on chair). By doing so,
* it displays a hint message. Or else, it would let user find and pick
* up item normally.
**********************************************************************/
bool Patio::explore(Cat *cat) {
	cout << endl;
	cout << "What would you like to do here?" << endl;
	cout << "1. Jump on a chair\t2. Look around" << endl;
	int patioInput = numInputVal(1,2);
	cout << endl;
	//jump on chair - display hint message
	if (patioInput == 1) {
		cout << "You look inside the kitchen from the chair. You can see the cabinet "
		<< "where hooman keeps your food. The knob is round, which you are not able to "
		<< "open with your paws. Maybe you can hook something circular on it and pull to open..."
		<< "like my COLLAR? (Ф ﻌ Ф)!!" << endl;
	//look for item 
	} else {
		//if item is there, give option to pick up
		if (hasItem() == true) {
			cout << endl;
			cout << "You found " << itemPtr->getItemName() << "." << endl << endl;
			cout << "Do you want to take it with you?" << endl;
			cout << "1. Yes\t2. No" << endl;
			int userInput = numInputVal(1,2);
			if (userInput == 1) {
				cat->addItem(itemPtr);
				if (cat->addItemSuccess() == true) {
					itemPtr = nullptr;
				}
			}
		//if item is not there, display message
		} else {
			cout << "There's nothing interesting here." << endl;
		}
	}
	cout << endl;
	//game won = false
	return false;
}