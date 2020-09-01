CXX = g++
CXXFLAGS = -std=c++11 
CXXFLAGS += -Wall 
CXXFLAGS += -pedantic-errors
CXXFLAGS += -g


ms: minesweeper.o
	${CXX} ${CXXFLAGS} -o ms minesweeper.o 

minesweeper.o: minesweeper.cpp 
	${CXX} ${CXXFLAGS} -c $(@:.o=.cpp)

clean: 
	rm -f *.o
	rm ms

