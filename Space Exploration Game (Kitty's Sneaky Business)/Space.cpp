
/*********************************************************************
** Program name:Space.cpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is source file for Space base class. There are
**		four pointers used to link the different derived spaces. There's
**		also item pointer to point to item stored in each space. There
**		are methods to help set/get item location, space pointers. The
**		3 virtual methods will be inherited and overriden by the derived
**		classes. This class is a friend class of Cat so cat's
**		functions and member variables can be integrated.
*********************************************************************/
#include "Space.hpp"
#include <iostream>
#include <string>

using std::cout;
using std::endl;
using std::string;

/*********************************************************************
*   		Space::Space()
* Constructor - set all link pointers to null, display description and 
* menu.
**********************************************************************/
Space::Space() {
	top = nullptr;
	bottom = nullptr;
	left = nullptr;
	right = nullptr;
	display();
}

/*********************************************************************
*   		Space::~Space()
* Destructor
**********************************************************************/
Space::~Space() {}

/*********************************************************************
*   	char Space::display()
* display description and menu. The response to menu is taken as char 
* and returned.
**********************************************************************/
char Space::display() {
	description();
	return spaceMenu();
}

//virtual functions
void Space::description() {}
char Space::spaceMenu() {}

//setters for right, left, top, bottom pointers
void Space::setRight(Space *r) {
	right = r;
}

void Space::setLeft(Space *l) {
	left = l;
}
void Space::setTop(Space *t) {
	top = t;
}
void Space::setBottom(Space *b) {
	bottom = b;
}

//getters for right, left, top, bottom pointers
string Space::getRight() {
	return right->getLocation();
}

string Space::getLeft() {
	return left->getLocation();
}
string Space::getTop() {
	return top->getLocation();
}
string Space::getBottom() {
	return bottom->getLocation();
}

//return space (room) name
string Space::getLocation() {
	return spaceName;
}

/*********************************************************************
*   	bool Space::hasItem()
* check if the space has an item or not. The result is returned as bool
* type.
**********************************************************************/
bool Space::hasItem() {
	if (itemPtr == nullptr) {
		return false;
	} else {
		return true;
	}
}

/*********************************************************************
*   	void Space::setItemLocation(Item *item)
* This function will set itemPtr point to passed item parameter
**********************************************************************/
void Space::setItemLocation(Item *item) {
	itemPtr = item;
}

/*********************************************************************
*   	void Space::showMap()
* Display house map
**********************************************************************/
void Space::showMap() {
	cout << "\n\t\t\tHouse Map\n" << endl;
	cout << "             _____________________________" << endl;
	cout << "             |             |             |" << endl;
	cout << "             |    Patio    +   Kitchen   |" << endl;
	cout << "_____________|----- + -----|----- + -----|oooooooooo" << endl;
	cout << "|            |             |             |" << endl;
	cout << "|  Bathroom  +   Bedroom   + Living Room + Outside " << endl;
	cout << "|____________|_____________|_____________|oooooooooo" << endl;
	cout << endl;
	cout << "Legend:\t+ Door" << endl << endl;
}

/*********************************************************************
*   	bool Space::explore(Cat *cat)
* This function checks if there's an item in the space, if so, prompt 
* user to pick up the item or not. If yes, item is added to Cat's 
* inventory, and itemPtr is set to nullptr to indicate there's no longer 
* the item in the room. The bool function is set to false unless the 
* game goal has been met (use correct item in correct space).
**********************************************************************/
bool Space::explore(Cat *cat) {
	cout << endl;
	if (hasItem() == true) {
		cout << "You found " << itemPtr->getItemName() << "." << endl << endl;
		cout << "Do you want to take it with you?" << endl;
		cout << "1. Yes\t2. No" << endl;
		int userInput = numInputVal(1,2);
		if (userInput == 1) {
			//add to inventory
			cat->addItem(itemPtr);
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