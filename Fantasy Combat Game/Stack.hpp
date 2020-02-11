/*********************************************************************
** Program name:Stack.hpp
** Author: Pamela Yin
** Date: November 24, 2019
** Description: This is the header file for Stack class.
**		This class has a struct StackNode that has member character 
**		pointers. This will create doubly linked list stack. The stack
**		class has functions to check list is empty, add to first, 
**		and traverse methods. This is used to hold loser pile.
*********************************************************************/
#include "Character.hpp"

#ifndef STACK_HPP
#define STACK_HPP

class Stack {
	protected:
		//declare class for list node
		struct StackNode {
			Character* charPtr;
			StackNode *next;
			StackNode *prev;

			StackNode(Character* charPtr1) {
				charPtr = charPtr1;
				next = nullptr;
				prev = nullptr;
			}
		};
		//list head pointer
		StackNode *head; 
		StackNode *tail;				
	public:
		//constructor and deconstructor
		Stack() { head = nullptr; tail = nullptr; }
		~Stack();
		bool isEmpty() const;
		void addFirst(Character* charPtr);
		void traverse() const;
};

#endif