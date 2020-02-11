/*********************************************************************
** Program name:Vampire.hpp
** Author: Pamela Yin
** Date: November 5, 2019
** Description: This is header file for Vampire class. This class
**		inherits the properties of the base class Character class. 
**		This class only initializes the variables in the public
**		constructor to meet the specs for Vampire (die count, sides,
**		armor, strength points, etc). Vampire class has new method 
**		(special ability) charm, which will roll a number between 0 
**		and 1. If 1, then charm activates which will return 0, which 
**		is set to new attackPoints, if not it will return original
**		attackPoints. The defense function will have charm function 
**		and set the int returned to attackPoints. Then it will calcuate
**		damage and display new damage and strength points.
*********************************************************************/
#include "Character.hpp"
#ifndef VAMPIRE_HPP
#define VAMPIRE_HPP


class Vampire : public Character {

	public:
		//constructor
		Vampire();
	
		//new method
		int charm(int attackPoints);

		//overriden methods from base class
		virtual void defense(int attackPoints);
};

#endif