
/*********************************************************************
** Program name:Barbarian.cpp
** Author: Pamela Yin
** Date: November 5, 2019
** Description: This is source file for Barbarian class. This class
**		inherits the properties of the base class Character class. 
**		This class only initializes the variables in the public
**		constructor to meet the specs for Barbarian (die count, sides,
**		armor, strength points, etc). Barbarian does not posess special
**		ability.
*********************************************************************/
#include "Barbarian.hpp"

/*********************************************************************
*   		Barbarian::Barbarian()
* Default constructor which initialize all the variables according to
* barbarian specs
**********************************************************************/
Barbarian::Barbarian() {
	dieSidesAttack = 6; 
	dieSidesDefense = 6; 
	dieCountAttack = 2; 
	dieCountDefense = 2;
	strengthPoints = 12;
	maxStrengthPoints = strengthPoints;
	attackPoints = 0; 
	defensePoints = 0; 
	armor = 0;
	damage = 0;
	type = "Barbarian";
}

