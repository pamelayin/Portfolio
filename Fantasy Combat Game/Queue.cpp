/*********************************************************************
** Program name: Queue.cpp
** Author: Pamela Yin
** Date: November 24, 2019
** Description: This is the source file for Queue class.
**		This class has a struct Node that contains Character pointers
**		as attributes. It will be used to create singly linked circular
**		list. The queue has functions that prints the queue, move head
**		value to the back, remove head, check if list is empty, modify
**		team points, set and get names for queue.
*********************************************************************/
#include "Queue.hpp"
#include <iostream>
#include <iomanip>
using std::cout;
using std::endl;

/*********************************************************************
 * bool Queue::isEmpty() const
 * This is const function that checks if the list is empty by checking
 * if head is pointing to a node. If head is nullptr, then list is empty
 * and return true. If not, there's something in the list, return false.
 * ********************************************************************/
bool Queue::isEmpty() const {
	if (head == nullptr) {
		return true;
	} else {
		return false;
	}
}

/*********************************************************************
 * 			void Queue::moveToBack(Character* charPtr)
 * This function is adds the character (head) to the end of the list, 
 * then remove the head to move the character to end of queue.
 * ********************************************************************/
void Queue::moveToBack(Character* charPtr) {
	addLast(charPtr);
	removeFirst();
	// QueueNode *temp = nullptr;
	// if (isEmpty() == true) {
	// 	cout << getQueueName() << " has no players." << endl;
	// } else if (head == tail) {
	// 	head = tail;
	// 	tail->next = head;
	// } else {
	// 	temp = head;
	// 	head = head->next;
	// 	tail->next = temp;
	// 	tail = temp;
	// 	tail->next = head;
	// }
}

/*********************************************************************
 * 			void Queue::addLast(Character* charPtr)
 * This function adds passed parameter character to the end of the queue
 * ********************************************************************/
void Queue::addLast(Character* charPtr) {
	QueueNode *temp = new QueueNode(charPtr);

	//if list is empty, set head and tail to the char
	if (isEmpty() == true) {
		head = temp;
		tail = temp;
	//when list is not empty
	} else {
		//add to last of the list
		tail->next = temp;
		// temp->prev = tail;
		tail = temp;	
		tail->next = head;
	}
	//link tail's next to nullptr
	tail->next = head;
	// head->prev = nullptr;

	//free the temp pointer
	temp = nullptr;
}

/*********************************************************************
 * 			void Queue::removeFirst()
 * This function will remove the head, then assign the next node in the 
 * list as the new head.
 * ********************************************************************/
void Queue::removeFirst() {
	//check if list is empty, display mesasge
	if (isEmpty() == true)  {
		cout << getQueueName() << " has no players." << endl;
	//check if there is only one number in list
	} else if (head == tail) {

		tail->next = nullptr;
		
		//delete the node
		delete head;

		//set head and tail to nullptr
		head = nullptr;
		tail = nullptr;
		
		cout << getQueueName() << " now has no players left to fight." << endl;
	
	//when there's 2 or more numbers in the list
	} else {
		//create new pointer, point to value at head
		QueueNode* temp;
		temp = head;

		//set the head's next number to head, disconnect the link to the head
		head = head->next;
		// head->prev = nullptr;
		tail->next = head;
		//delete temp pointer points to the beginning number and set temp to nullptr
		delete temp;
		temp = nullptr;
	}
}



/*********************************************************************
 * 			void Queue::traverse()
 * this method iterates through the entire list by reading each character
 * values from head node to the tail one by one using a node pointer.
 * ********************************************************************/
void Queue::traverse() {
	cout << "\t" << getQueueName() << " Player List" << endl;
	//start from head
	QueueNode *nodePtr = head;
	//if no head, then print message list is empty
	if (isEmpty() == true) {
		cout << getQueueName() << " does not have any players." << endl;
	//read through the list 
	} else {
		int i = 0;
		//continue read until head
		do {
			//print value stored in current node
			i++;
			cout << i << ". ";
			cout << "Character Name: ";
			cout << std::left << std::setw(10) << std::setfill(' ') << nodePtr->charPtr->getName();
			cout << "Type: " << nodePtr->charPtr->getType();
			cout << endl;
			//go to next node
			nodePtr = nodePtr->next;
		} while (nodePtr != head);
	}
	cout << endl;
	//set the pointer to nullptr
	nodePtr = nullptr;

}

/*********************************************************************
 * Character* Queue::getHead() const
 * This function will return the charater pointer stored in the node
 * ********************************************************************/
Character* Queue::getHead() const {
	if (head == nullptr && tail == nullptr) {
		cout << "There is no head value to display since list is empty." << endl;
		return nullptr;
	} else {
		return head->charPtr;
	}
}

/*********************************************************************
 * 		void Queue::winPoints()
 * this method will add 2 points to the winning team and display total
 * team points
 * ********************************************************************/
void Queue::winPoints() {
	teamPoints += 2;
	cout << endl;
	cout << getQueueName();
	cout << " won this battle. 2 points are rewarded." << endl;
	cout << getQueueName() << " total team points: " << getTeamPoints() << endl;
}

/*********************************************************************
 * 		void Queue::losePoints()
 * this method will subtract 1 point from the winning team and display total
 * team points
 * ********************************************************************/
void Queue::losePoints() {
	teamPoints -= 1;
	cout << endl;
	cout << getQueueName();
	cout << " lost this battle. 1 point is deducted." << endl;
	cout << getQueueName() << " total team points: " << getTeamPoints() << endl;
}

/*********************************************************************
 * 		int Queue::getTeamPoints()
 * this method will return total team points 
 * ********************************************************************/
int Queue::getTeamPoints() {
	return teamPoints;
}

/*********************************************************************
 * 		void Queue::setQueueName(string queueName)
 * this is setter for queueName variable
 * ********************************************************************/
void Queue::setQueueName(string queueName) {
	this->queueName = queueName;
}

/*********************************************************************
 * 		void Queue::getQueueName()
 * this emthod returns the queue name
 * ********************************************************************/
string Queue::getQueueName() {
	return queueName;
}

/*********************************************************************
 * 		Queue::~Queue()
 * //reference: Starting Out With C++ Early Object 
 * //9th edition, by Gaddis, P.1057-1058
 * This is destructor that creates a pointer point to head's next node.
 * Then it will iterate the list one by one and delete the nodes and the
 * character pointers. This will iterate through the tail of the list 
 * before it gets to head. Then it will delete head node and its values.
 * ********************************************************************/
Queue::~Queue() {

	if (head != nullptr) {
        QueueNode* curr = head->next;
        while (curr != nullptr && curr != head) {
            QueueNode* temp = curr;
            curr = curr->next;
			delete temp->charPtr;
            delete temp;
        }
		delete head->charPtr;
        delete head;
        head = nullptr;
    }
} 