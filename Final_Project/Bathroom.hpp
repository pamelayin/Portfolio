/*********************************************************************
** Program name:Bathroom.hpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is header file for Bathroom child class. This class
**		inherits from the space class. It will assign a new name and 
**		override description, menu, and explore virtual methods. This 
**		class contains random pick to lose patience points.
*********************************************************************/
#include "Space.hpp"

#ifndef BATHROOM_HPP
#define BATHROOM_HPP

class Bathroom : public Space {
	public:
		Bathroom();
	
		//virtual methods - overridden 
		virtual void description();
		virtual char spaceMenu();
		virtual bool explore(Cat *cat);
};

#endif
