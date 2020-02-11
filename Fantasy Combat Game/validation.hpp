/*********************************************************************
** Program name:validation.hpp
** Author: Pamela Yin
** Date: October 29, 2019
** Description: This is the source file for validation. It has method
**		that checks if input is a number, if input is an integer, and
**		if a number is within given range. If inputs are not valid,
**		it will display error message and will loop until user inputs 
**		valid entry.
*********************************************************************/
#ifndef VALIDATION_HPP
#define VALIDATION_HPP

//function prototypes
int numInputVal(int begRange, int endRange);
int intInputVal();
bool checkNumRange(int inputNum, int beginNum, int endNum);

#endif