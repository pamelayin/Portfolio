CXX = g++
CXXFLAGS = -std=c++11 
CXXFLAGS += -Wall 
CXXFLAGS += -pedantic-errors
CXXFLAGS += -g
#CXXFLAGS += -O3
LDFLAGS = -lboost_date_time

OBJS = main.o validation.o menu.o Game.o Cat.o Item.o Space.o 
OBJS += LivingRoom.o Outside.o Patio.o Bedroom.o Bathroom.o Kitchen.o

SRCS = main.cpp validation.cpp menu.cpp Game.cpp Cat.cpp Item.cpp Space.cpp
SRCS += LivingRoom.cpp Outside.cpp Patio.cpp Bedroom.cpp Bathroom.cpp Kitchen.cpp

HEADERS = validation.hpp menu.hpp Game.hpp Cat.hpp Item.hpp Space.hpp 
HEADERS += LivingRoom.hpp Outside.hpp Patio.hpp Bedroom.hpp Bathroom.hpp Kitchen.hpp

#target: dependencies

cat: ${OBJS} ${HEADERS}
	${CXX} ${LDFLAGS} ${OBJS} -o cat

${OBJS}: ${SRCS}
	${CXX} ${CXXFLAGS} -c $(@:.o=.cpp)

clean: 
	rm -f *.o cat