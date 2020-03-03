
/*********************************************************************
** Program name:Outside.cpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is source file for Outside child class. This class
**		inherits from the space class. It will assign a new name and 
**		override description, menu, and explore virtual methods. The 
**		explore methods add extra features that can gain/lose patience
**		points by random.
*********************************************************************/
#include "Outside.hpp"
#include <iostream>
#include <cstdlib>

using std::cout;
using std::endl;

/*********************************************************************
*   		Outside::Outside() : Space() 
* This is constructor for Patio class. It inherits properties of Space
* and assigns a new name.
**********************************************************************/
Outside::Outside() : Space() {
	spaceName = "OUTSIDE";
}

/*********************************************************************
*   		void Patio::description()
* This function gives introduction to the room
**********************************************************************/
void Outside::description() {
	cout << "\n\t" << getLocation() << endl;
	cout << "You have managed to open the door and get outside. You have "
	<< "only been outside in a box carried by hooman to go get tortured by "
	<< "needles. You have always dreamed of exploring the wild outdoors "
	<< "but have no idea what is out there." << endl << endl;
}

/*********************************************************************
*   		char Outside::spaceMenu()
* This function gives user list of activities to choose from and matches
* the corresponding int choice with a char and returns that char. This
* char is accessed in Game class to determine what to do next.
**********************************************************************/
char Outside::spaceMenu() {
	cout << "1. Move left to " << getLeft() << endl;
	cout << "2. Explore" << endl;
	cout << "3. Current Status" << endl;
	cout << "4. Map" << endl;
	cout << "5. Inventory" << endl;

	int choice = numInputVal(1,5);

	//return char matched with the user choice option
	switch(choice) {
		case 1:
			return 'L';
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
*   	bool Outside::explore(Cat *cat)
* This function is overrides the one in space class. It creates 3 random
* events, where one loses patience points, one is game over, and one is
* gain patience points.
**********************************************************************/
bool Outside::explore(Cat *cat) {
	cout << endl;
	//3 random events 
	int event = rand() % 3 + 1;
	if (event == 1) {
		//enjoy - gain 3 patience
		cout << "You enjoy the refreshing grass smell and the warm sunshine." << endl;
		cat->gainPatience(3);
	} else if (event == 2) {
		//get in fight - lose the game 
		cout << "You got into a fight with a very aggressive street cat and lost. You are very angry." << endl;
		cat->losePatience(10);
	} else {
		//get lost - lose 3 patience
		cout << "You got lost while stalking the birds. You panicked but luckily you found your way back."
		<< " You feel a little annoyed." << endl;
		cat->losePatience(3);
	}
	cout << endl;
	return false;
}