/*********************************************************************
** Program name:Character.hpp
** Author: Pamela Yin
** Date: November 23, 2019
** Description: This is header file for Character base class. This is
**		updated one from project3 which has minor modifications to 
**		function/variable names and recover function that recovers 
**		50% of character's strength points.
*********************************************************************/
#ifndef CHARACTER_HPP
#define CHARACTER_HPP

#include <string>
using std::string;

class Character {
	protected:
		//declare variables
		int dieSidesAttack, dieSidesDefense, dieCountAttack, dieCountDefense;
		int attackPoints, defensePoints, strengthPoints, maxStrengthPoints;
		int armor, damage;
		string name, type, attackType;
	public:
		Character() {};
		//pure virtual deconstructor
		//reference: https://piazza.com/class/k0rofchnorj31s?cid=468
		//Noah Johnston's response 
		virtual ~Character() = 0;
	
		//methods
		int dieRollAttack();
		int dieRollDefense();
		bool isAlive();
		void defenderSummary();
		void recover();

		//setter
		void setAttackType(string attackType);
		void setName(string name);

		//getter
		string getType();
		string getAttackType();
		string getName();
		int getAttackPoints();
		int getDefensePoints();
		int getDamage();

		//virtual methods - overridden by some classes
		virtual void attack();
		virtual void defense(int attackPoints);
};

#endif
