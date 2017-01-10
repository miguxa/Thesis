#ifndef Lib_h
#define Lib_h

#include "Arduino.h"

class Prints
{
  public:
    Prints();
	String Timer(int tmr);
	String Sinal(int val);
};

#endif