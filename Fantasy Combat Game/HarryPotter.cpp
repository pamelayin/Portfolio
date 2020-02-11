
/*********************************************************************
** Program name:HarryPotter.cpp
** Author: Pamela Yin
** Date: November 5, 2019
** Description: This is source file for HarryPotter class. This class
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
#include "HarryPotter.hpp"
#include <iostream>

using std::cout;
using std::endl;

/*********************************************************************
*   		HarryPotter::HarryPotter()
* Default constructor which initialize all the variables according to
* medusa specs
**********************************************************************/
HarryPotter::HarryPotter() {
	dieSidesAttack = 6; 
	dieSidesDefense = 6; 
	dieCountAttack = 2; 
	dieCountDefense = 2;
	strengthPoints = 10;
	maxStrengthPoints = 20;
	attackPoints = 0; 
	defensePoints = 0; 
	armor = 0;
	damage = 0;
	life = 1;
	type = "Harry Potter";
}

/*********************************************************************
*   		void HarryPotter::hogwarts()
* This is a new method specifically create for HarryPotter class. When
* Harry Potter's strength points are 0 or below and is the first life,
* it will print out message that special ability will be activated. It
* will set strengthPoints to 20 and increase the life count.
**********************************************************************/
void HarryPotter::hogwarts() {
	//hogwarts only work when Harry Potter die the first life
	if (strengthPoints <= 0 && life == 1) {
		//display message
		cout << endl;
		cout << getName() << "'s strength points reached below 0 for first life." << endl;
		cout << getName() << "'s special ability 'Hogwarts' activated! " << endl;
		cout << getName() << " recovers and strength points become 20." << endl;
		//assign 20 for strength points 
		strengthPoints = 20;
		//life count increase 
		life++;
	}
	cout << endl;
}

/*********************************************************************
*   		void HarryPotter::defense(int attackPoints)
* This is a overridden method specifically for HarryPotter class. This class
* takes attackpoints as parameter. This method runs dieRollDefense method
* and sets it to defensePoints. Then it will calculate the damage the
* character received. If damage is less than 0, it will set to 0. Then
* strength points will be updated based on the damage. Then the method
* will call hogwarts function, which is special ability of Harry Potter.
**********************************************************************/
void HarryPotter::defense(int attackPoints) {
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

	//if dead, call hogwarts 
	if (isAlive() == false) {
		hogwarts();
	}
}