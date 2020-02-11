
/*********************************************************************
** Program name:BlueMen.cpp
** Author: Pamela Yin
** Date: November 5, 2019
** Description: This is source file for BlueMen class. This class
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
#include "BlueMen.hpp"
#include <iostream>

using std::cout;
using std::endl;

/*********************************************************************
*   		BlueMen::BlueMen()
* Default constructor which initialize all the variables according to
* blue men specs
**********************************************************************/
BlueMen::BlueMen() {
	dieSidesAttack = 10; 
	dieSidesDefense = 6; 
	dieCountAttack = 2; 
	dieCountDefense = 3;
	strengthPoints = 12;
	maxStrengthPoints = strengthPoints;
	attackPoints = 0; 
	defensePoints = 0; 
	armor = 3;
	damage = 0;
	type = "Blue Men";
}

/*********************************************************************
*   		void BlueMen::mob()
* This is a new method specifically create for blue men class. This class
* will check the strengthPoints of blue men. For every 4 points lost, 
* one defense die will be lost. This is implemented by reinitializing
* dieCountDefense variable to a new count according to the updated 
* strength points. Then it will display message how many lost and how 
* many left if any die lost.
**********************************************************************/
void BlueMen::mob() {
	//initialize dieCountLost variable to 0
	int dieCountLost = 0;

	//strength points 0 or less, no defense dice left
	if (strengthPoints <= 0) {
		dieCountDefense = 0;
	//strength points > 0 and <= 4, 1 defense die left
	} else if (strengthPoints <= 4) {
		dieCountDefense = 1;
	//strength points > 4 and <= 8, 2 defense dice left
	} else if (strengthPoints <= 8) {
		dieCountDefense = 2;
	//strength points > 8 and <= 12, 3 defense dice left
	} else {
		dieCountDefense = 3;
	}

	//count how many dice lost
	dieCountLost = 3 - dieCountDefense;

	//if any die lost, display special ability message and die counts 
	if (dieCountLost > 0) {
		cout << getName() <<"'s special ability 'mob' activated! " << endl;
		cout << getName() << " lost total " << dieCountLost << " defense dice so far." << endl;
		cout << getName() << " has total " << dieCountDefense 
		<< " defense dice left." << endl;
		cout << endl;
	}	
}

/*********************************************************************
*   		int BlueMen::defense(int attackPoints)
* This is a overridden method specifically for BlueMen class. This class
* takes attackpoints as parameter. This method runs dieRollDefense method
* and sets it to defensePoints. Then it will calculate the damage the
* character received. If damage is less than 0, it will set to 0. Then
* strength points will be updated based on the damage. Then the method
* will call mob function, which is special ability of blue men.
**********************************************************************/
void BlueMen::defense(int attackPoints) {
	//roll defense die
	defensePoints = dieRollDefense();
	cout << getName() << "'s defense dice rolled: " << defensePoints << "." << endl;

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
	
	//special ability method - update defense die count and display
	mob();

}

