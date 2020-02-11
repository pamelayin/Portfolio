
/*********************************************************************
** Program name:Character.cpp
** Author: Pamela Yin
** Date: November 23, 2019
** Description: This is header file for Character base class. This is
**		updated one from project3 which has minor modifications to 
**		function/variable names and recover function that recovers 
**		50% of character's strength points.
*********************************************************************/
#include "Character.hpp"
#include <iostream>
#include <iomanip>
#include <cmath>

using std::cout;
using std::endl;


/*********************************************************************
*   		Character::~Character()
* Destructor
**********************************************************************/
Character::~Character() {}

/*********************************************************************
*   		int Character::dieRollAttack()
* roll a random number based on the number of sides attack die has,
* if more than 1 die, it will loop and accumulate points until all dice
* have been rolled and return points.
**********************************************************************/
int Character::dieRollAttack() {
	//count to count how many dice have been rolled
	int count = 1;
	//points is sum of all random numbers generated from all dice
	int points = 0;

	//loop until all dice have been rolled - generate random number
	//between 1 and number of die sides 
	while (count <= dieCountAttack) {
		points += rand() % dieSidesAttack + 1;
		count++;
	}
	return points;
}

/*********************************************************************
*   		int Character::dieRollDefense()
* roll a random number based on the number of sides defense die has,
* if more than 1 die, it will loop and accumulate points until all dice
* have been rolled and return points.
**********************************************************************/
int Character::dieRollDefense() {
	//count to count how many dice have been rolled
	int count = 1;
	//points is sum of all random numbers generated from all dice
	int points = 0;

	//loop until all dice have been rolled - generate random number
	//between 1 and number of die sides 
	while (count <= dieCountDefense) {
		points += rand() % dieSidesDefense + 1;
		count++;
	}
	return points;
}

/*********************************************************************
*   		bool Character::isAlive()
* this boolean function will return true if character's strength points
* are above 0. If <= 0, it will return false, the character is dead.
**********************************************************************/	
bool Character::isAlive() {
	if (strengthPoints <= 0) {
		return false;
	} else {
		return true;
	}
}

/*********************************************************************
*   		int Character::getAttackPoints()
* this getter function will return actual attackPoints as int
**********************************************************************/	
int Character::getAttackPoints() {
	return attackPoints;
}

/*********************************************************************
*   		int Character::getDefensePoints()
* this getter function will return defensePoints as int
**********************************************************************/	
int Character::getDefensePoints() {
	return defensePoints;
}

/*********************************************************************
*   		int Character::getDamage()
* this getter function will return damage as int
**********************************************************************/	
int Character::getDamage() {
	return damage;
}

/*********************************************************************
*   		void Character::defenderSummary()
* This void function will display character's armor and strength points 
**********************************************************************/	
void Character::defenderSummary() {
	cout << "Armor: " << armor << "\nstrength points: " << strengthPoints << endl;
}

/*********************************************************************
*   		void Character::attack()
* This void function initialize rollAttackPoints variable with the number
* generated from dieRollAttack function and sets it to attackPoints.
**********************************************************************/
void Character::attack() {
	//roll dice, assign to attack points
	attackPoints = dieRollAttack();

	//display attack points
	cout << getName() << "'s attack dice rolled: " << attackPoints << endl;
}

/*********************************************************************
*   		void Character::defense(int attackPoints)
* This void function takes attackPoints as parameter. It will generate
* number from dieRollDefense and set it to defensePoints variable. Then
* it will print message to screen of the defense points. Then damage is
* calculated by subtracting defense points and armor from the attack 
* points. If the damage is less than 0, it will set to 0 since damage
* cannot be negative, just no damage. Then the damage will be subtracted
* from strength points of the character. 
**********************************************************************/
void Character::defense(int attackPoints) {

	defensePoints = dieRollDefense();
	cout << getName() << "'s defense dice rolled: " << defensePoints << endl;

	//damage calculation
	damage = attackPoints - defensePoints - armor;
	//damage cannot be negative, set to 0
	if (damage < 0) {
		damage = 0;
	}
	//subtract damage from strength points
	strengthPoints -= damage;

	//display
	cout << "The total inflicted damage on " << getName() << " is: " << damage << endl;
	cout << getName() << "'s strength points after damage is: " << strengthPoints << endl;
}

/*********************************************************************
*   		void Character::setName(string name)
* This setter function takes parameter of string and sets name. 
**********************************************************************/
void Character::setName(string name) {
	this->name = name;
}

/*********************************************************************
*   		void Character::setAttackType(string attackType)
* This setter function takes parameter of string and sets the attack type. 
**********************************************************************/
void Character::setAttackType(string attackType) {
	this->attackType = attackType;
}

/*********************************************************************
*   		string Character::getType
* This getter function returns the type in string
**********************************************************************/
string Character::getType() {
	return type;
}

/*********************************************************************
*   		string Character::getAttackType
* This getter function returns the type in string
**********************************************************************/
string Character::getAttackType() {
	return attackType;
}

/*********************************************************************
*   		string Character::getName()
* This getter function returns the type in string
**********************************************************************/
string Character::getName() {
	return name;
}

/*********************************************************************
*   		void Character::recover()
* This void function adds 50% of character's current strength points 
* to the character. If already reach character's max strength points, 
* then set strength points at max.
**********************************************************************/
void Character::recover() {
	//heal - 50% 
	double heal = 0.5;

	//strength points = 150% of what it is 
	strengthPoints = round(strengthPoints * (1 + heal));

	//if over max, then set max
	if (strengthPoints > maxStrengthPoints) {
		strengthPoints = maxStrengthPoints;
		cout << getName() << "'s strength points have been recovered"
		<< " to max points of " << strengthPoints << " points." << endl;
	} else {
		cout << getName() << "'s strength points have been recovered "
		<< heal*100 << " percent to: " << strengthPoints << " points." << endl;
	}
}