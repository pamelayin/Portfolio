/*********************************************************************
** Program name:BlueMen.hpp
** Author: Pamela Yin
** Date: November 5, 2019
** Description: This is header file for BlueMen class. This class
**		inherits the properties of the base class Character class. 
**		This class only initializes the variables in the public
**		constructor to meet the specs for BlueMen (die count, sides,
**		armor, strength points, etc). BlueMen class has new method 
**		(special ability) which will be implemented by method mob()
**		which will set the number of defense dies left depending on
**		how much damage is received. For every 4 damage received, 
**		defense die count will decrease. It will display the die count
**		summary after each round if any die lost.
*********************************************************************/
#include "Character.hpp"
#ifndef BLUEMEN_HPP
#define BLUEMEN_HPP

class BlueMen : public Character {

	public:
		//constructor
		BlueMen();
	
		//new method
		void mob();

		//overriden methods from base class
		virtual void defense(int attackPoints);
};

#endif