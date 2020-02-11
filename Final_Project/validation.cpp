/*********************************************************************
** Program name:validation.cpp
** Author: Pamela Yin
** Date: December 9, 2019
** Description: This is the source file for validation. It has method
**		that checks if input is a number, if input is an integer, and
**		if a number is within given range. If inputs are not valid,
**		it will display error message and will loop until user inputs 
**		valid entry.
*********************************************************************/
#include "validation.hpp"
#include <iostream>
#include <string>

using std::endl;
using std::cout;
using std::cin;
using std::string;

/*********************************************************************
*             int numInputVal(int begRange, int endRange)  
* This function takes 2 parameters, the beginning number and the ending 
* number for the range to check. It will initialize the flags and call
* the method intInputVal() to check if input is an integer. If it is 
* not, it will reprompt until user enters valid integer. Then the function
* will check if the number is within the valid range by passing the 
* parameters to method checkNumRange. If is not within the range,
* it will loop back and reprmpt for input again. Then it wil return the
* number that meets all the criteria.
**********************************************************************/
//check user input for menu selection 
int numInputVal(int begRange, int endRange) {
	bool inputValid = false;
	int inputNum = 0;
	cout << "\nYour choice: ";
	//keep going until valid number within range
	while (inputValid == false) {
		//check if input is number
		inputNum = intInputVal();
		//check if number is within range
		if (checkNumRange(inputNum,begRange,endRange) == false) {
			inputValid = false;
		} else {
			inputValid = true;
		}
	}
	return inputNum;
}

/*********************************************************************
*             int intInputVal()  
* This function takes no parameters. It will initialize the flag and 
* variable. It will take input from user as string, check if input is 
* not blank, then check if fist character is - sign or number, to check
* for negative integers, then iterate through rest of the string, 
* checking if each character is a number or not. For every invalid input
* the count will go up. If the count is 0, the input will be converted
* back to integer, else it will display error message and loop again to
* prompt for another input. The method will return a valid input as int.
**********************************************************************/
int intInputVal() {
	//declare variables
	string inputString="";
	bool isInteger = false;
	int input = 0;
	//loop until valid integer input
	while (isInteger == false) {
		isInteger = true;
		//source: https://piazza.com/class/k0rofchnorj31s?cid=98
		//get input in form of string

		getline(cin, inputString);
		
		//use counter to keep track of invaid inputs
		int count = 0;

		//check user input numbers that are 1-4 digits long
		if (inputString.size() != 0 && inputString.size() < 5) {
			//check if characters in the input are numbers or not when first character
			//is negative sign and has number afterwards
			if (inputString[0] == '-' && inputString.size() > 1) {
				for (unsigned i = 1; i < inputString.size(); i++) {
					if (!isdigit(inputString[i])) {
						count++;
					}
				}
			//check all inputs are numbers
			} else {
				for (unsigned i = 0; i < inputString.size(); i++) {
					if (!isdigit(inputString[i])) {
						count++;
					}		
				}
			}
		} else {
			count++;
		}
		//if errors are found, prompt again and reset input to 0
		if (count > 0) {
				cout << "The input is not valid. Please try again." << endl;
				isInteger = false;
		} else {
			//convert input from string type to int
			input = std::stoi(inputString);	
		}
	}	
	return input;
}

/*********************************************************************
*     bool checkNumRange(int inputNum, int beginNum, int endNum)
* This function takes the input number, beginning integer and ending 
* integer for the range to check for. If it is outside of range, it
* will return error message and return false.
**********************************************************************/
bool checkNumRange(int inputNum, int beginNum, int endNum) {
	//check if step size is valid
	if (inputNum < beginNum || inputNum > endNum) {
		cout << "The input is out of range. Please try again." << endl;
		return false;
	} else {
		return true;
	}
}

