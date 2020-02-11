/*********************************************************************
** Program name:Patio.hpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is header file for Patio child class. This class
**		inherits from the space class. It will assign a new name and 
**		override description, menu, and explore virtual methods.
*********************************************************************/
#include "Space.hpp"

#ifndef PATIO_HPP
#define PATIO_HPP

class Patio : public Space {
	public:
		//constructor - new name
		Patio();	
		//virtual methods - overridden
		virtual void description();
		virtual char spaceMenu();
		virtual bool explore(Cat *cat);
};

#endif
