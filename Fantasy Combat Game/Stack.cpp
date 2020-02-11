/*********************************************************************
** Program name: Stack.cpp
** Author: Pamela Yin
** Date: November 24, 2019
** Description: This is the source file for Stack class.
**		This class has a struct StackNode that has member character 
**		pointers. This will create singly linked list stack. The stack
**		class has functions to check list is empty, add to first, 
**		and traverse methods. This is used to hold loser pile.
*********************************************************************/
#include "Stack.hpp"
#include <iostream>
#include <iomanip>
using std::cout;
using std::endl;

/*********************************************************************
 * bool Stack::isEmpty() const
 * This is const function that checks if the list is empty by checking
 * if head is pointing to a node. If head is nullptr, then list is empty
 * and return true. If not, there's something in the list, return false.
 * ********************************************************************/
bool Stack::isEmpty() const {
	if (head == nullptr) {
		return true;
	} else {
		return false;
	}
}

/*********************************************************************
 * 			void Stack::addFirst(Character* charPtr)
 * This function will creates a new stack node with passed parameter 
 * character pointer and add to the stack list as the head.
 * ********************************************************************/
void Stack::addFirst(Character* charPtr) {
	
	//create new pointer, point to a new StackNode 
	StackNode *temp = new StackNode(charPtr);

	//if list is empty, add to head directly
	if (isEmpty() == true) {
		//set both head and tail pointers to the num
		head = temp;
		tail = temp;
		
	//when list is not empty
	} else {
		//head's prev point to temp, temp's next point to head, set head to temp
		head->prev = temp;
		temp->next = head;
		head = temp;
	}
	cout << "Loser " << temp->charPtr->getName() << " has been added to loser pile." << endl;
	//set head's prev and tail's next to point to nullptr
	//free temp pointer
	head->prev = nullptr;
	tail->next = nullptr;
	temp = nullptr;
	
}


// void Stack::check() {
// 	if (head == nullptr && tail == nullptr) {
// 		cout << "list empty check" << endl;
// 	} else {
// 		StackNode *ptr = head;
// 		cout << "head: " << head->value << endl;
// 		// cout << "before head: " << (head->prev)->value << endl;
// 		cout << "after head: " << (head->next)->value << endl;
// 		do {
// 			ptr = ptr->next;
// 			cout << "next" << endl;
// 			cout << "before: " << (ptr->prev)->value << endl;
// 			cout << "after: " << (ptr->next)->value << endl;
// 		} while (ptr->next != nullptr);
// 	}
// }

/*********************************************************************
 * 			void Stack::traverse() const
 * This is const function that reads the list from beginning to end. It
 * creates a new pointer set to head. If head is empty, it will display
 * a message. If the list has numbers, it will go through the list by
 * accessing the value for the pointer, then set the next's node until
 * there's no more numbers.
 * ********************************************************************/
void Stack::traverse() const {
	cout << "\n\tLoser Pile (top to bottom)" << endl;
	//start from head
	StackNode *nodePtr = head;
	//if no head, then print message list is empty
	if (isEmpty() == true) {
		cout << "There are no losers in this game." << endl;
	//read through the list 
	} else {
		
		int i = 0;
		//continue read until no nodePtr
		while (nodePtr) {
			//print value stored in current node
			i++;
			cout << i << ". ";
			cout << " Character Name: ";
			cout << std::left << std::setw(10) << std::setfill(' ') << nodePtr->charPtr->getName();
			cout << "Type: " << nodePtr->charPtr->getType();
			cout << endl;
			//go to next node
			nodePtr = nodePtr->next;
		}
	}
	cout << endl;
	//set the pointer to nullptr
	nodePtr = nullptr;
	// check();
}


/*********************************************************************
 * 		Stack::~Stack()
 * //reference: Starting Out With C++ Early Object 
 * //9th edition, by Gaddis, P.1057-1058
 * This is destructor That creates a pointer point to head. While 
 * the list is not empty, keep track of the node to be deleted by the
 * pointer garbage. Iterate through the list by pointing nodePtr to the
 * next, while deleting values stored in garbage. Then delete the nodePtr.
 * ********************************************************************/
Stack::~Stack() {
	//set the pointer to head
	StackNode *nodePtr = head;
	while (nodePtr != nullptr) {
		//trash keep track of node to be deleted
		StackNode *garbage = nodePtr;
		//move to next
		nodePtr = nodePtr->next;
		//delete "garbage"
		delete garbage->charPtr;
		delete garbage;
	}
	delete nodePtr;
}