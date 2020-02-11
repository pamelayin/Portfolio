/*********************************************************************
** Program name:Outside.hpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is header file for Outside child class. This class
**		inherits from the space class. It will assign a new name and 
**		override description, menu, and explore virtual methods.
*********************************************************************/
#include "Space.hpp"
#include <string>
using std::string;

#ifndef OUTSIDE_HPP
#define OUTSIDE_HPP

class Outside : public Space {
	public:
		//constructor
		Outside();
	
		//virtual methods - overridden 
		virtual void description();
		virtual char spaceMenu();
		virtual bool explore(Cat *cat);

};

#endif
