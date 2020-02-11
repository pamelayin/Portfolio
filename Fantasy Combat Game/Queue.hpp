/*********************************************************************
** Program name:Queue.hpp
** Author: Pamela Yin
** Date: November 24, 2019
** Description: This is the header file for Queue class.
**		This class has a struct Node that contains Character pointers
**		as attributes. It will be used to create singly linked circular
**		list. The queue has functions that prints the queue, move head
**		value to the back, remove head, check if list is empty, modify
**		team points, set and get names for queue.
*********************************************************************/
#include "Character.hpp"
#include <string>

#ifndef QUEUE_HPP
#define QUEUE_HPP

using std::string;

class Queue {
	private:
		int teamPoints = 0;
		string queueName;
	protected:
		//declare class for QueueNode
		struct QueueNode {
			Character* charPtr;
			QueueNode *next;

			QueueNode(Character* charPtr1) {
				charPtr = charPtr1;
				next = nullptr;
			}
		};
		//list head pointer
		QueueNode *head; 
		QueueNode *tail;			
	public:
		//constructor and deconstructor
		Queue() { head = nullptr; tail = nullptr; }
		~Queue();

		//functions
		bool isEmpty() const;
		void moveToBack(Character* charPtr);
		Character* getHead() const;
		void addLast(Character* charPtr);
		void removeFirst();
		void traverse();
		void winPoints();
		void losePoints();

		//getters & setters
		void setQueueName(string queueName);
		int getTeamPoints();
		string getQueueName();
};

#endif