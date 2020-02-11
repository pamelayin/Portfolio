/*********************************************************************
** Program name:Medusa.hpp
** Author: Pamela Yin
** Date: November 5, 2019
** Description: This is header file for Medusa class. This class
**		inherits the properties of the base class Character class. 
**		This class only initializes the variables in the public
**		constructor to meet the specs for Medusa (die count, sides,
**		armor, strength points, etc). Medusa class has new method 
**		(special ability) which will be implemented by method glare().
**		When attack dice roll 12, glare is activated, which displays 
**		a message and sets attackPoints to 1000, which kills all other
**		opponent characters. However, Vampire's charm can deactivate 
**		glare by resetting attackpoints to 0 and Harry potter will
**		revive if has second life.
*********************************************************************/
#include "Character.hpp"
#ifndef MEDUSA_HPP
#define MEDUSA_HPP

class Medusa : public Character {

	public:
		//constructor
		Medusa();
	
		//new method
		void glare();

		//overriden methods from base class
		virtual void attack();
		int getAttackPoints();
};

#endif