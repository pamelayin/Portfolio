/*********************************************************************
** Program name:Cat.hpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is header file for Cat class. This class contains
**		all movements for the cat object. It has friend Space class
**		that can access this class. It has add/remove items, read/manage
**		inventory, gain and lose patience. The inventory is contained
**		as a vector of Item pointers.
*********************************************************************/
#include <vector>
#include "Item.hpp"
#include "validation.hpp"

using std::vector;

#ifndef CAT_HPP
#define CAT_HPP

class Cat {
	private:
		//declare variables
		vector <Item*> inventory;
		int patience;
		const int maxPatience = 10;
		int addItemCount;
		
	public:
		//space class is friend class of cat
		//source:https://beginnersbook.com/2017/09/friend-class-and-friend-functions/
		friend class Space;

		//constructor
		Cat();
		//methods

		//item
		void addItem(Item *item);
		bool addItemSuccess();
		void removeItem();
		void removeItem(Item *item);
		bool useItem(Item *item);

		//inventory
		bool inventoryFull();
		vector<Item*> getInventory();
		void readInventory();
		void showInventory();
		void manageInventory();

		//patience
		int getPatience();
		int getMaxPatience();
		bool hasPatience();
		void losePatience(int points);
		void gainPatience(int points);
	
};

#endif
