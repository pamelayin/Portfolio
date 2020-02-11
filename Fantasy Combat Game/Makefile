CXX = g++
CXXFLAGS = -std=c++0x 
CXXFLAGS += -Wall 
CXXFLAGS += -pedantic-errors
CXXFLAGS += -g
#CXXFLAGS += -O3
LDFLAGS = -lboost_date_time

OBJS = menu.o main.o validation.o Character.o Game.o Queue.o Stack.o
OBJS += Vampire.o Barbarian.o BlueMen.o Medusa.o HarryPotter.o
SRCS = menu.cpp main.cpp validation.cpp Character.cpp Game.cpp Queue.cpp Stack.cpp
SRCS += Vampire.cpp Barbarian.cpp BlueMen.cpp Medusa.cpp HarryPotter.cpp
HEADERS = menu.hpp validation.hpp Character.hpp Game.hpp Queue.hpp Stack.hpp
HEADERS += Vampire.hpp Barbarian.hpp BlueMen.hpp Medusa.hpp HarryPotter.hpp

#target: dependencies
#	rule to build
#

team: ${OBJS} ${HEADERS}
	${CXX} ${LDFLAGS} ${OBJS} -o team

${OBJS}: ${SRCS}
	${CXX} ${CXXFLAGS} -c $(@:.o=.cpp)

clean: 
	rm -f *.o team