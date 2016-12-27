#ifndef Lib_h
#define Lib_h

#include "Arduino.h"

class Prints
{
  public:
    Prints();
    void PrintSinal(int val);
	int PrintTimer(int &tmr);
};

#endif