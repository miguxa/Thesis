/*
  Morse.cpp - Library for flashing Morse code.
  Created by David A. Mellis, November 2, 2007.
  Released into the public domain.
*/

#include "Arduino.h"
#include "Lib.h"

Prints::Prints(){}


void Prints::PrintSinal(int val)
{
  if (val >= 0)
    Serial.print("+");
  if (val == 0)
    Serial.print("00");
  else if (val > 0 && val < 10)
    Serial.print("00");
  else if (val >= 10 && val < 100)
    Serial.print("0");
  else if (val < 0 && val > -10)
    Serial.print("-00");
  else if (val <= -10 && val > -100)
    Serial.print("-0");
  if (val < 0 && val > -100)
    val = val * -1;
  Serial.print(val);
  Serial.print(" "); 
}

int Prints::PrintTimer(int &tmr){
	tmr = tmr + 1;
  if (tmr < 10)
    Serial.print("0000");
  else if (tmr < 100)
    Serial.print("000");
  else if (tmr < 1000)
    Serial.print("00");
  else if (tmr < 10000)
    Serial.print("0");
  Serial.print(tmr);
  Serial.print("; ");
  return tmr;
}