/*********************************************************************
** Program name:Kitchen.hpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is header file for Kitchen child class. This class
**		inherits from the space class. It will assign a new name and 
**		override description, menu, and explore virtual methods. This is 
**		the final destination user will be in to win the game. The
**		explore function in this class utilizes useItem function from
**		the Cat class to solve the game.
*********************************************************************/
#include "Space.hpp"

#ifndef KITCHEN_HPP
#define KITCHEN_HPP

class Kitchen : public Space {
	public:
		Kitchen();
	
		//virtual methods - overridden
		virtual void description();
		virtual char spaceMenu();
		virtual bool explore(Cat *cat);
};

#endif
