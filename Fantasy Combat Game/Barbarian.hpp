/*********************************************************************
** Program name:Barbarian.hpp
** Author: Pamela Yin
** Date: November 5, 2019
** Description: This is header file for Barbarian class. This class
**		inherits the properties of the base class Character class. 
**		This class only initializes the variables in the public
**		constructor to meet the specs for Barbarian (die count, sides,
**		armor, strength points, etc). Barbarian does not posess special
**		ability.
*********************************************************************/
#include "Character.hpp"
#ifndef BARBARIAN_HPP
#define BARBARIAN_HPP

#include <string>
using std::string;

class Barbarian : public Character {
	public:
		//constructor
		Barbarian();	
};

#endif