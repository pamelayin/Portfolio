/********************************************************************************************************************
 * Name: Pamela Yin
 * Class: CS 325 Section 401
 * Date: August 8, 2020
 * Description: HW6/Portfolio: This is classic minesweeper game that has 10 mines in 9x9 grid. User loses
 * 				when user uncovers mine. If all squares without mines are uncovered, user wins. This program
 * 				uses two boards, one that holds the mines and numbers and one that is displayed. When user uncovers
 * 				a square, the numbers will be copied to user board. If the number is 0, adjacent cells will be
 * 				uncovered as well using floodfill algorithm.
 *********************************************************************************************************************/

#include <iostream>
#include <string>
#include <ctime>
#include <cmath>
#define RESET   "\033[0m"
#define RED     "\033[31m"

using std::cin;
using std::cout;
using std::endl;
using std::string;
using std::to_string;

//prototype
void revealNeighbor(string userBoard[][10], string mineBoard[][10], int row, int col, int &steps);

//print board
void printBoard(string board[][10]) {
	cout << "--------------------" << endl;
	for (int i = 0; i < 10; i++) {
		for (int j = 0; j < 10; j++) {
			cout << board[i][j] << " ";
		}
		cout << endl;
	}
	cout << "--------------------" << endl << endl;
}

//print board when mine is stepped on - mine is in red 
void printBoard(string board[][10], int row, int col) {
	cout << "--------------------" << endl;
	for (int i = 0; i < 10; i++) {
		for (int j = 0; j < 10; j++) {
			if (i == row && j == col) {
				cout << RED << board[row][col] << RESET << " ";
			} else {
				cout << board[i][j] << " ";
			}
		}
		cout << endl;
	}
	cout << "--------------------" << endl << endl;
}

void initBoard(string board[][10]) {
	//initialize board
	for (int i = 0; i < 10; i++) {
		for (int j = 0; j < 10; j++) {
			if (i == 0 && j == 0) {
				board[i][j] = " ";
			} else if (i == 0) {
				board[i][j] = to_string(j);
			} else if (j == 0) {
				board[i][j] = (char)('A'- 1 + i );
			} else {
				board[i][j] = "\u25A0";
			}
		}
	}
}

//check if coordinate is on board
bool onBoard(int x, int y) {
	if (x < 1 || y < 1 || x > 9 || y > 9) {
		return false;
	}
	return true;
}

//randomly generate 10 mines to plant
void createGame(string board[][10]) {
	int mineCount = 0;

	while (mineCount < 10) {
		int rand1 = rand() % 9 + 1;
		int rand2 = rand() % 9 + 1;
		if (board[rand1][rand2] != "*") {
			board[rand1][rand2] = "*";
			mineCount++;
		}
	}

	//count total mines in surrounding cells
	for (int i = 1; i < 10; i++) {
		for (int j = 1; j < 10; j++) {
			
			int totalMines = 0;

			//if not mine, count surrounding mines and replace with num of mines
			if (board[i][j] != "*") {
				//top left corner
				if (onBoard(i-1, j-1) && board[i-1][j-1] == "*") {
					totalMines++;
				}
				//top
				if (onBoard(i-1, j) && board[i-1][j] == "*") {
					totalMines++;
				}
				//top right corner
				if (onBoard(i-1, j+1) && board[i-1][j+1] == "*") {
					totalMines++;
				}
				//left
				if (onBoard(i, j-1) && board[i][j-1] == "*") {
					totalMines++;
				}
				//right
				if (onBoard(i, j+1) && board[i][j+1] == "*") {
					totalMines++;
				}
				//bottom left corner
				if (onBoard(i+1, j-1) && board[i+1][j-1] == "*") {
					totalMines++;
				}
				//bottom
				if (onBoard(i+1, j) && board[i+1][j] == "*") {
					totalMines++;
				}
				//bottom right corner
				if (onBoard(i+1, j+1) && board[i+1][j+1] == "*") {
					totalMines++;
				}
				if (totalMines == 0) {
					board[i][j] = " ";
				} else {
					board[i][j] = to_string(totalMines);
				}
				
			}
			
		}
	}
}

//reveal the square from userboard and if it is empty (0), reveal neighbors too, also count steps (blocks uncovered)
void revealSquare(string userBoard[][10], string mineBoard[][10], int row, int col, int &steps) {
	if (onBoard(row, col)) {
		userBoard[row][col] = mineBoard[row][col];
		steps++;
		if (mineBoard[row][col] == " ") {
			revealNeighbor(userBoard, mineBoard, row, col, steps);
		}
	}
}

//reference: https://www.youtube.com/watch?v=LFU5ZlrR21E
//reference: http://www.cs.ucf.edu/~dmarino/progcontests/modules/floodfill/FloodFill.pdf
//if surrounding squares are not revealed, reveal them 
void revealNeighbor(string userBoard[][10], string mineBoard[][10], int row, int col, int &steps) {
	for (int i = -1; i <= 1; i++) {
		for (int j = -1; j <= 1; j++) {
			if (onBoard(row+i, col+j) && (mineBoard[row+i][col+j] != "*") && (userBoard[row+i][col+j] == "\u25A0")) {
				revealSquare(userBoard, mineBoard, row+i, col+j, steps);
			}
		}
	}
}

//game play 
void playGame(string mineBoard[][10], string userBoard[][10]) {
	bool lose = false;
	char row = ' ';
	int col = -1;
	int steps = 0;

	//continue game until pick wrong cell or uncover all cells without mines
	while (!lose && steps < 71) {
		cout << "Pick a square to uncover - enter letter (row) followed by number (column): " << endl;
		cin >> row >> col;
		
		//check for valid input
		while (toupper(row) < 'A' || toupper(row) > 'I' || col < 1 || col > 9) {
			cout << "Invalid input. Please try again." << endl;
			cout << "Pick a square to uncover - enter letter (row) followed by number (column): " << endl;
			cin.clear();
			cin.ignore(10000, '\n');
			cin >> row >> col;
		}

		row = toupper(row);
		string current = mineBoard[(int) (row-'A'+1)][col];
		//step on mine, end game
		if (current == "*") {
			cout << "You have stepped on a mine. You lost the game." << endl;
			userBoard[(int) (row-'A'+1)][col] = current;
			
			printBoard(mineBoard, (int) (row-'A'+1), col);
			lose = true;
		//already revealed
		} else if (userBoard[(int) (row-'A'+1)][col] != "\u25A0") {
			cout << "This square is already revealed. Please pick another square." << endl << endl;
		//reveal square and print board
		} else {
			revealSquare(userBoard, mineBoard, (int) (row-'A'+1), col, steps);
			printBoard(userBoard);
		}
	}
	//win the game
	if (!lose) {
		cout << "Congratulations! You Won!" << endl;
		printBoard(mineBoard);
	}
}

int main() {
	//random time generator + create board
	srand(time(NULL));
	string mineBoard[10][10];
	string userBoard[10][10];

	cout << "Welcome to Minesweeper. This board contains 10 mines total." << endl;
	cout << "Your goal is to uncover all squares that don't contain mines." << endl;
	cout << "If you step on a mine, you lose." << endl << endl;
	//initialize boards with appropriate characters and create randomly generated mine game
	initBoard(mineBoard);
	initBoard(userBoard);
	createGame(mineBoard);

	cout << "      User Board" << endl;
	printBoard(userBoard);
    
	//uncomment to see where mines are placed 
	// printBoard(mineBoard);
	playGame(mineBoard, userBoard);
}
