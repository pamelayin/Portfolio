
/*********************************************************************
** Program name:Bedroom.cpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is source file for Bedroom class. This class
**		inherits from the space class. It will assign a new name and 
**		override description, menu, and explore virtual methods. This 
**		class contains explore method that enables to user to gain 
**		patience points, along with pick up item.
*********************************************************************/
#include "Bedroom.hpp"
#include <iostream>

using std::cout;
using std::endl;

/*********************************************************************
*   		Bedroom::Bedroom() : Space()
* This is constructor for Bedroom class. It inherits properties of Space
* and assigns a new name.
**********************************************************************/
Bedroom::Bedroom() : Space() {
	spaceName = "BEDROOM";
}

/*********************************************************************
*   		void Bedroom::description()
* This function gives introduction to the room
**********************************************************************/
void Bedroom::description() {
	cout << "\n\t" << getLocation() << endl;
	cout << "Here is where you eat, drink water, and sleep. You like to sleep "
	<< "on hooman's bed even though you have your own bed, for no apparent reason. " 
	<< "From your animal sense, you feel you can get something important in this "
	<< "room. You may want to spend extra time here exploring." << endl << endl;
}

/*********************************************************************
*   		char Bedroom::spaceMenu()
* This function gives user list of activities to choose from and matches
* the corresponding int choice with a char and returns that char. This
* char is accessed in Game class to determine what to do next.
**********************************************************************/
char Bedroom::spaceMenu() {
	cout << "1. Move left to " << getLeft() << endl;
	cout << "2. Move right to " << getRight() << endl;
	cout << "3. Move up to " << getTop() << endl;
	cout << "4. Explore" << endl;
	cout << "5. Current Status" << endl;
	cout << "6. Map" << endl;
	cout << "7. Inventory" << endl;

	int choice = numInputVal(1,7);

	//use user input, return corresponding char
	switch(choice) {
		case 1:
			return 'T';
		case 2:
			return 'L';
		case 3:
			return 'P';
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

/*********************************************************************
*   	bool Patio::explore(Cat *cat)
* This function is similar to the one in Space class except it gives 
* an option to drink water (+2 patience for 2 times). It also has many
* options for explore, picking the right one would show option to pick
* up item (collar).
**********************************************************************/
bool Bedroom::explore(Cat *cat) {
	cout << "What would you like to do here?" << endl;
	cout << "1. Drink water\t2. Look around" << endl;
	int bedroomInput = numInputVal(1,2);

	//drink water, 2x max
	if (bedroomInput == 1) {
		if (waterCount < waterMaxCount) {
			cout << "Water was so refreshing. You feel satisfied." << endl;
			cat->gainPatience(2);
			waterCount++;
		} else {
			cout << "You already drank enough water for today." << endl;
		}
	//look around 
	} else {
		cout << endl;
		cout << "There's a hook under the bed. It seems interesting. "
		<< "What would you like to do? " << endl;
		cout << "1. Smell it" << endl;
		cout << "2. Touch it with your paw" << endl;
		cout << "3. Rub your face on it" << endl;
		cout << "4. Walk away" << endl;
		int hookInput = numInputVal(1,4);
		cout << endl;
		if (hookInput == 1) {
			cout << "It smells like steel. Disgusting." << endl;
		} else if (hookInput == 2) {
			cout << "It is very sturdy and cold to the touch." << endl;
		} else if (hookInput == 3) {
			//if pick 3 and has not picked up the item
			if (hasItem() == true) {
				cout << "While rubbing your face on it, it got hooked onto "
				<< "your COLLAR and it slipped off." << endl;
				cout << "Even though you hate it, it seems like it can come "
				<< "in handy later. You decide to take it with you." << endl << endl;
				
				//add to inventory
				cat->addItem(itemPtr);
				if (cat->addItemSuccess() == true) {
					itemPtr = nullptr;
				}
			} else {
				cout << "It is a good scratching spot." << endl;
			}
		}
	}
	cout << endl;
	return false;
}