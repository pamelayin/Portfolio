/*********************************************************************
** Program name:Item.cpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is header file for Item class. It has private member
**		itemName, overloaded constructor with itemName parameter, and 
**		function to display item description and getter function for 
**		item name.
*********************************************************************/
#include "Item.hpp"
#include <iostream>
#include <string>

using std::string;
using std::cout;
using std::endl;

/*********************************************************************
*   		Item::Item(string itemName)
* This is overloaded constructor for Item class. It will set the passed
* in parameter as the item name.
**********************************************************************/
Item::Item(string itemName) {
	this->itemName = itemName;
}

/*********************************************************************
*   		void Item::itemDescription()
* This displays each item's description when it is called.
**********************************************************************/
void Item::itemDescription() {
	
	//leaf
	if (itemName == "LEAF") {
		cout << "This is a leaf that fell from the nearby tree." << endl;
	
	//ball
	} else if (itemName == "BALL") {
		cout << "This is a ball you roll around at night to disturb hooman's sleep." << endl;
	
	//mouse toy
	} else if (itemName == "MOUSE TOY") {
		cout << "This is your favorite toy. You feel like you have become a tiger "
		<< "when you play with this toy." << endl;
	
	//collar
	} else {
		cout << "This is something on your neck all the time. You always want to break free "
		<< "from this evil thing. You have successfully taken it off but carry with you that "
		<< "it might be useful later." << endl;
	}
	cout << endl;
}

/*********************************************************************
*   		string Item::getItemName()
* This returns item name
**********************************************************************/
string Item::getItemName() {
	return itemName;
}

