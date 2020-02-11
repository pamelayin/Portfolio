/*********************************************************************
** Program name:Bedroom.hpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is header file for Bedroom class. This class
**		inherits from the space class. It will assign a new name and 
**		override description, menu, and explore virtual methods. This 
**		class contains explore method that enables to user to gain 
**		patience points, along with pick up item.
*********************************************************************/
#include "Space.hpp"

#ifndef BEDROOM_HPP
#define BEDROOM_HPP

class Bedroom : public Space {
	private:
		//declare variables
		int waterCount = 0;
		const int waterMaxCount = 2;
	public:
		Bedroom();
	
		//virtual methods - overridden
		virtual void description();
		virtual char spaceMenu();
		virtual bool explore(Cat *cat);
};

#endif
