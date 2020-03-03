/*********************************************************************
** Program name:Item.hpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is header file for Item class. It has private member
**		itemName, overloaded constructor with itemName parameter, and 
**		function to display item description and getter function for 
**		item name.
*********************************************************************/
#include <string>
using std::string;

#ifndef ITEM_HPP
#define ITEM_HPP

class Item {
	private:
		//declare variables
		string itemName;
		
	public:
		Item(string itemName);
		void itemDescription();
		string getItemName();
};

#endif
