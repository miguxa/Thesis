/*
  Morse.cpp - Library for flashing Morse code.
  Created by David A. Mellis, November 2, 2007.
  Released into the public domain.
*/

#include "Arduino.h"
#include "Lib.h"

Prints::Prints(){}

String Prints::Timer(int tmr) {
	String S;
	if (tmr < 10)
		S="0000";
	  else if (tmr < 100)
		S="000";
	  else if (tmr < 1000)
		S="00";
	  else if (tmr < 10000)
		S="0";
	S = S + tmr;
	return S;
}

String Prints::Sinal(int val) {
  String S = " ; ";
  if (val >= 0)
    S=S+"+";
  if (val == 0)
    S=S+"00";
  else if (val > 0 && val < 10)
    S=S+"00";
  else if (val >= 10 && val < 100)
    S=S+"0";
  else if (val < 0 && val > -10)
    S=S+"-00";
  else if (val <= -10 && val > -100)
    S=S+"-0";
  if (val < 0 && val > -100)
    val = val * -1;
  S=S+val;
  return S;
}