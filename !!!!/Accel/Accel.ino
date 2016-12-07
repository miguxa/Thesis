#include <SparkFun_ADXL345.h>         // SparkFun ADXL345 Library

ADXL345 adxl = ADXL345();             // USE FOR I2C COMMUNICATION
int tmr=0;

void setup(){

  Serial.begin(9600);                 // Start the serial terminal
  Serial.println("SparkFun ADXL345 Accelerometer Hook Up Guide Example");
  Serial.println();
  pinMode(2, INPUT);
  
  adxl.powerOn();                     // Power on the ADXL345

  adxl.setRangeSetting(2);            // Give the range settings
                                      // Accepted values are 2g, 4g, 8g or 16g
                                      // Higher Values = Wider Measurement Range
                                      // Lower Values = Greater Sensitivity
}

void loop(){
  // Accelerometer Readings
  int x,y,z,i;
  int S[450];

  Serial.println("Carregar para iniciar");
  while(digitalRead(2) == LOW)
    ;
  Serial.println("Inicio");
  
  for(i=0; i<450; i=i+3) {
    adxl.readAccel(&x, &y, &z);         // Read the accelerometer values and store them in variables declared above x,y,z
    S[i+0]=x;
    S[i+1]=y;
    S[i+2]=z;
    delay(5);
  }

  Serial.println("Fim");
  delay(1000);
  Serial.println("Time    X    Y    Z");
  
  for(i=0; i<450; i=i+3) {
    PrintTimer();
    PrintSinal(S[i+0]);
    PrintSinal(S[i+1]);
    PrintSinal(S[i+2]);
    Serial.println("");
  }
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

void PrintTimer () {
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
  Serial.print(" ");
}
