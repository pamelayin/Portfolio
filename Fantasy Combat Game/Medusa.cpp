
/*********************************************************************
** Program name:Medusa.cpp
** Author: Pamela Yin
** Date: November 5, 2019
** Description: This is source file for Medusa class. This class
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
#include "Medusa.hpp"
#include <iostream>

using std::cout;
using std::endl;

/*********************************************************************
*   		Medusa::Medusa()
* Default constructor which initialize all the variables according to
* medusa specs
**********************************************************************/
Medusa::Medusa() {
	dieSidesAttack = 6; 
	dieSidesDefense = 6; 
	dieCountAttack = 2; 
	dieCountDefense = 1;
	strengthPoints = 8;
	maxStrengthPoints = strengthPoints;
	attackPoints = 0; 
	defensePoints = 0; 
	armor = 3;
	damage = 0;
	type = "Medusa";
}

/*********************************************************************
*   		void Medusa::glare()
* This is a new method specifically create for medusa class. To make 
* sure all opponents die, attackpoints are set to 1000, which exceeds
* the defense and strength points of any character. It will output a
* message glare is used.
**********************************************************************/
void Medusa::glare() {
	//set damage beyond any character's strength points
	attackPoints = 1000;

	cout << endl;
	//display message
	cout << getName() << "'s special ability 'glare' activated! " << endl;
	cout << getName() << "'s attack increase to 1000." << endl;
	cout << "The opponent has turned into stone." << endl;
	cout << endl;
}

/*********************************************************************
*   		void Medusa::attack()
* This void function initialize rollAttackPoints variable with the number
* generated from dieRollAttack function. If dice roll is 12, then glare 
* is activated. If not, rollAttackPoints is assigned to attackPoints.
**********************************************************************/
void Medusa::attack() {
	//roll dice, assign to attack points
	attackPoints = dieRollAttack();

	//display attack points
	cout << getName() << "'s attack dice rolled: " << attackPoints << "." << endl;

	//if roll is 12, then glare is activated
	if (attackPoints == 12) {
		glare();
	} 

}
