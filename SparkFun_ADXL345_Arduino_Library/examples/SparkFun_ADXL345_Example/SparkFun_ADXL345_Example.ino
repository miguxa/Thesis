/*  ********************************************* 
 *  SparkFun_ADXL345_Example
 *  Triple Axis Accelerometer Breakout - ADXL345 
 *  Hook Up Guide Example 
 *  
 *  Utilizing Sparkfun's ADXL345 Library
 *  Bildr ADXL345 source file modified to support 
 *  both I2C and SPI Communication
 *  
 *  E.Robert @ SparkFun Electronics
 *  Created: Jul 13, 2016
 *  Updated: Sep 06, 2016
 *  
 *  Development Environment Specifics:
 *  Arduino 1.6.11
 *  
 *  Hardware Specifications:
 *  SparkFun ADXL345
 *  Arduino Uno
 *  *********************************************/

#include <SparkFun_ADXL345.h>         // SparkFun ADXL345 Library

/*********** COMMUNICATION SELECTION ***********/
/*    Comment Out The One You Are Not Using    */
//ADXL345 adxl = ADXL345(10);           // USE FOR SPI COMMUNICATION, ADXL345(CS_PIN);
ADXL345 adxl = ADXL345();             // USE FOR I2C COMMUNICATION
int timer=0;

/****************** INTERRUPT ******************/
/*      Uncomment If Attaching Interrupt       */
//int interruptPin = 2;                 // Setup pin 2 to be the interrupt pin (for most Arduino Boards)


/******************** SETUP ********************/
/*          Configure ADXL345 Settings         */
void setup(){

  Serial.begin(9600);                 // Start the serial terminal
  Serial.println("");
  Serial.println("SparkFun ADXL345 Accelerometer Hook Up Guide Example");
  Serial.println();
  pinMode(2, INPUT);
  
  adxl.powerOn();                     // Power on the ADXL345

  adxl.setRangeSetting(2);           // Give the range settings
                                      // Accepted values are 2g, 4g, 8g or 16g
                                      // Higher Values = Wider Measurement Range
                                      // Lower Values = Greater Sensitivity

}

/****************** MAIN CODE ******************/
/*     Accelerometer Readings and Interrupt    */
void loop(){
  // Accelerometer Readings
  int x,y,z,i;
  int S[400];

  Serial.println("Carregar para iniciar");
  
  while(digitalRead(2) == LOW)
    ;

  Serial.println("Inicio");
  
  for(i=0; i<400; i=i+3) {
    adxl.readAccel(&x, &y, &z);         // Read the accelerometer values and store them in variables declared above x,y,z
    timer = timer + 1;
    S[i+0]=x;
    S[i+1]=y;
    S[i+2]=z;
    delay(5);
  }

  Serial.println("Fim");
  delay(1000);
  
  for(i=0; i<400; i=i+3) {
    PrintSinal(S[i+0]);
    PrintSinal(S[i+1]);
    PrintSinal(S[i+2]);
    Serial.println("");
  }
  // Output Results to Serial
  /* UNCOMMENT TO VIEW X Y Z ACCELEROMETER VALUES */  
  /*Serial.print(x);
  Serial.print(", ");
  Serial.print(y);
  Serial.print(", ");
  Serial.println(z); 
  */
  //delay(50);
}

void PrintSinal (int val) {
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
