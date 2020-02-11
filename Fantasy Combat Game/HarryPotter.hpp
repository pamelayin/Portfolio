/*********************************************************************
** Program name:HarryPotter.hpp
** Author: Pamela Yin
** Date: November 5, 2019
** Description: This is header file for HarryPotter class. This class
**		inherits the properties of the base class Character class. 
**		This class only initializes the variables in the public
**		constructor to meet the specs for HarryPotter (die count, sides,
**		armor, strength points, etc). HarryPotter class has new method 
**		(special ability) which will be implemented by method hogwarts().
**		When Harry Potter dies first time, it will revive by making his
**		strength points = 20, and add 1 to life count. It would only 
**		work for first life. This method would be implmented in the 
**		defense method which overrides Character's virtual method.
*********************************************************************/
#include "Character.hpp"
#ifndef HARRYPOTTER_HPP
#define HARRYPOTTER_HPP

class HarryPotter : public Character {
	private:
		int life;
	public:
		//constructor
		HarryPotter();
	
		//new method
		void hogwarts();

		//overriden methods from base class
		virtual void defense(int attackPoints);
};

#endif