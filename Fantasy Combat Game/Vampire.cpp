
/*********************************************************************
** Program name:Vampire.cpp
** Author: Pamela Yin
** Date: November 5, 2019
** Description: This is source file for Vampire class. This class
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
#include "Vampire.hpp"
#include <iostream>

using std::cout;
using std::endl;

/*********************************************************************
*   		Vampire::Vampire()
* Default constructor which initialize all the variables according to
* vampire specs
**********************************************************************/
Vampire::Vampire() {
	dieSidesAttack = 12; 
	dieSidesDefense = 6; 
	dieCountAttack = 1; 
	dieCountDefense = 1;
	strengthPoints = 18;
	maxStrengthPoints = strengthPoints;
	attackPoints = 0; 
	defensePoints = 0; 
	armor = 1;
	damage = 0;
	type = "Vampire";
}

/*********************************************************************
*   		int Vampire::charm(int attackPoints)
* This is a new method specifically create for vampire class. This class
* takes attackpoints as parameter and returns int. It will generate 
* random number between 0 and 1. If it returns 1, charm is activated,
* which will return 0. If random number is 0, then it will return the
* same attackPoints passed from the parameter.
**********************************************************************/
int Vampire::charm(int attackPoints) {
	//random number generate between 0 and 1
	int charmRoll = rand() % 2;

	//if 1, charm activate, return 0
	if (charmRoll == 1) {
		cout << getName() <<"'s special ability 'charm' activated! " << endl;
		cout << getName() << " is not attacked!" << endl << endl;
		return 0;
	//if random number 0, charm not activate, return attackPoints as is 
	} else {
		return attackPoints;
	}
	cout << endl;
}

/*********************************************************************
*   		void Vampire::defense(int attackPoints)
* This is a void method that is overriden from Characer class. This class
* takes attackpoints as parameter and rolls defense dice. Then the charm
* method will be utilized to modify attackPoints if applicable. Then it
* will calculate total damage taken, then update strength points, and
* output the damage and strength points.
**********************************************************************/
void Vampire::defense(int attackPoints) {
	//roll defense die
	defensePoints = dieRollDefense();
	cout << getName() << "'s defense dice rolled: " << defensePoints << "." << endl;
	//add charm method in returning attack points
	attackPoints = charm(attackPoints);

	//calculate damage
	damage = attackPoints - defensePoints - armor;

	//damage cannot be negative, set to 0 if less than 0
	if (damage < 0) {
		damage = 0;
	}
	//update strength points
	strengthPoints -= damage;

	//display
	cout << "The total inflicted damage on " << getName() << " is: " << damage << "." << endl;
	cout << getName() << "'s strength points after damage is: " << strengthPoints << "." << endl;
}

