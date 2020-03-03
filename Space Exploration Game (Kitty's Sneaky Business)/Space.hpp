/*********************************************************************
** Program name:Space.hpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is header file for Space base class. There are
**		four pointers used to link the different derived spaces. There's
**		also item pointer to point to item stored in each space. There
**		are methods to help set/get item location, space pointers. The
**		3 virtual methods will be inherited and overriden by the derived
**		classes. This class is a friend class of Cat so cat's
**		functions and member variables can be integrated.
*********************************************************************/
#include "validation.hpp"
#include "Item.hpp"
#include "Cat.hpp"
#include <string>

using std::string;
using std::vector;

#ifndef ROOM_HPP
#define ROOM_HPP

class Space {
	protected:
		//declare variables
		string spaceName;
		Space *top = nullptr;
		Space *bottom = nullptr;
		Space *left = nullptr;
		Space *right = nullptr;
		Item *itemPtr = nullptr;

	public:
		//constructor & destructor
		Space();
		virtual ~Space() = 0;
	
		//methods
		bool hasItem();
		void showMap();
		char display();

		//setters
		void setItemLocation(Item *item);
		void setRight(Space *r);
		void setLeft(Space *l);
		void setTop(Space *t);
		void setBottom(Space *b);

		//getters
		string getLocation();
		string getRight();
		string getLeft();
		string getTop();
		string getBottom();

		//virtual methods - overridden by some classes
		virtual bool explore(Cat *cat);
		virtual void description();
		virtual char spaceMenu();

};

#endif
