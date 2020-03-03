/*********************************************************************
** Program name:LivingRoom.hpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is header file for LivingRoom child class. This class
**		inherits from the space class. It will assign a new name and 
**		override description, menu, and explore virtual methods. 
*********************************************************************/
#include "Space.hpp"
#include <string>
using std::string;

#ifndef LIVINGROOM_HPP
#define LIVINGROOM_HPP

class LivingRoom : public Space {
	public:
		LivingRoom();
	
		//virtual methods - overridden
		virtual void description();
		virtual char spaceMenu();

};

#endif
