/*********************************************************************
** Program name:Cat.cpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is source file for Cat class. This class contains
**		all movements for the cat object. It has friend Space class
**		that can access this class. It has add/remove items, read/manage
**		inventory, gain and lose patience. The inventory is contained
**		as a vector of Item pointers.
*********************************************************************/
#include <iostream>
#include <vector>
#include <algorithm>
#include <string>
#include <thread>
#include <chrono>

#include "Cat.hpp"
#include "validation.hpp"

using std::vector;
using std::cout;
using std::endl;
using std::cin;
using std::string;

/*********************************************************************
*   		Cat::Cat()
* This is constructor for Cat class. it reserves 3 element slots for 
* inventory vector, and sets the starting patience value.
**********************************************************************/
Cat::Cat() {
	//reserve 3 slots for the vector 
	//reference:https://stackoverflow.com/questions/11134497/constant-sized-vector
	inventory.reserve(3);
	patience = 10;
}

/*********************************************************************
*   		vector<Item*> Cat::getInventory()
* This is method that returns the inventory. This is is used by Kitchen
* class to access the inventory vector.
**********************************************************************/
vector<Item*> Cat::getInventory() {
	return inventory;
}

/*********************************************************************
*   		bool Cat::inventoryFull()
* Returns if true if inventory is full by checking if there are 3 elements.
**********************************************************************/
bool Cat::inventoryFull() {
	if (inventory.size() == 3) {
		return true;
	} else {
		return false;
	}
}	

/*********************************************************************
*   		void Cat::addItem(Item *item)
* It adds item passed by the parameter to the inventory. If the inventory
* is full, ask user if user would like to remove an item first, then it
* will call the method again and add the new item.
**********************************************************************/
void Cat::addItem(Item *item) {
	addItemCount = 0;
	cout << endl;
	//inventory is full
	if (inventoryFull() == true) {
		cout << "Your mouth is full. Would you like to drop an item first?" << endl;
		cout << "Remember: once you drop an item, you cannot pick it up again." << endl;
		cout << "1. Yes\t2. No" << endl;
		int addItemInput = numInputVal(1,2);
		//remove item first, then add new item
		if (addItemInput == 1) {
			removeItem();
			addItem(item);
		//nothing happens
		} else {
			cout << "You cannot pick up " << item->getItemName() << " since you cannot carry "
			<< "more than 3 items in your mouth." << endl;
		}
	//add item 
	} else {
		inventory.push_back(item);
		cout << "You picked up " << item->getItemName() << "." << endl;
		addItemCount++;
	}
}

/*********************************************************************
*   		bool Cat::addItemSuccess()
* This function checks if adding item was successful by checking 
* addItemCount counter from addItem method.
**********************************************************************/
bool Cat::addItemSuccess() {
	if (addItemCount == 0) {
		return false;
	} else {
		return true;
	}
}

/*********************************************************************
*   		void Cat::removeItem()
* This function displays a message to remove inventory and displays
* the inventory, and let user manage inventory from there.
**********************************************************************/
void Cat::removeItem() {
	cout << "Which item would you like to remove from inventory?" << endl;
	showInventory();
}

/*********************************************************************
*   		void Cat::removeItem(Item *item)
* This overloaded function directly removes the item from the inventory.
**********************************************************************/
void Cat::removeItem(Item *item) {
	//reference:https://stackoverflow.com/questions/3385229/c-erase-vector-element-by-value-rather-than-by-position
	inventory.erase(std::remove(inventory.begin(), inventory.end(), item));
	cout << "Successfully removed " << item->getItemName() << " from your inventory." << endl;
}

/*********************************************************************
*   		bool Cat::useItem(Item* item)
* This function checks if passed parameter item is the collar. Return 
* true for collar and false for other items.
**********************************************************************/
bool Cat::useItem(Item* item) {
	if (item->getItemName() == "COLLAR") {
		cout << "You hang the collar on the cabinet door knob to pull with your teeth......" << endl << endl;
		std::this_thread::sleep_for (std::chrono::seconds(2));
		cout << "It worked! You have opened the cabinet door and found your favorite food." << endl;
		cout << "It's time to feast!" << endl;
		cout << endl;
		return true;
	} else {
		cout << endl;
		cout << "Trying " << item->getItemName() << "..." << endl << endl;
		std::this_thread::sleep_for (std::chrono::seconds(1));
		cout << "The cabinet did not budge. Let's try again with something else." << endl;
		cout << endl;
		return false;
	}
}

/*********************************************************************
*   		void Cat::readInventory()
* This function reads the full inventory
**********************************************************************/
void Cat::readInventory() {
	cout << "Inventory: " << inventory.size() << "/3" << endl;
	cout << endl;
	//empty 
	if (inventory.empty()) {
		cout << "There's nothing in your inventory." << endl;
	//not empty
	} else {
		for (unsigned i = 0; i < inventory.size(); i++) {
			cout << i+1 << ". " << inventory[i]->getItemName() << endl;
		}
	}
	cout << endl;
}

/*********************************************************************
*   		void Cat::showInventory()
* This function reads the full inventory, and if the inventory is not
* empty, call manageInventory method.
**********************************************************************/
void Cat::showInventory() {
	readInventory();
	if (!inventory.empty())	{
		manageInventory();
	}	
	cout << endl;
}

/*********************************************************************
*   		void Cat::manageInventory()
* This function prompts user if user would like to manage inventory.
* If yes, prompt user for which item, then display descriptions and ask
* to remove or not, if remove, then delete from the inventory.
**********************************************************************/
void Cat::manageInventory() {
		//prompt for choice
		cout << "What would you like to do?" << endl;
		cout << "1. Manage Inventory\t2. Go Back" << endl;
		int manageInvenInput = numInputVal(1,2);

		//manage inventory
		if (manageInvenInput == 1) {
			cout << "Enter the number for the inventory item to manage." << endl;
			readInventory();
			int invInput = numInputVal(1,inventory.size());
			cout << endl;

			//show description of the item selected
			inventory[invInput-1]->itemDescription();
			cout << "Would you like to remove this item from inventory?" << endl;
			cout << "1. Yes\t2. No" << endl;

			int removeInput = numInputVal(1,2);
			//remove item
			if (removeInput == 1) {
				removeItem(inventory[invInput-1]);
			}
		}	
}

//getter - return patience
int Cat::getPatience() {
	return patience;
}

//getter - return max patience
int Cat::getMaxPatience() {
	return maxPatience;
}

/*********************************************************************
*   		void Cat::gainPatience(int points)
* This function adds the passed int to the patience. If above maxPatience,
* then set to max.
**********************************************************************/
void Cat::gainPatience(int points) {
	patience += points;
	if (patience > maxPatience) {
		patience = maxPatience;
	}
	cout << "\n+" << points << " Patience" << endl;
}

/*********************************************************************
*   		void Cat::losePatience(int points)
* This function subtracts the passed int to the patience. 
**********************************************************************/
void Cat::losePatience(int points) {
	patience -= points;
	cout << "\n-" << points << " Patience" << endl;
}

/*********************************************************************
*   		bool Cat::hasPatience()
* This function checks if the patience is above 0, if not, return false.
**********************************************************************/
bool Cat::hasPatience() {
	if (patience <= 0) {
		return false;
	} else {
		return true;
	}
}