// Arduino code and library is available to download - link below the video.
 
/* Accelerometer connection pins (I2C) to Arduino are shown below:

Arduino     Accelerometer ADXL345
  A5            SCL
  A4            SDA
  3.3V          CS
  3.3V          VCC
  GND           GND
*/ 

#include <Wire.h>
#include <ADXL345.h>


ADXL345 accel; //variable adxl is an instance of the ADXL345 library

int x,y,z;  
int rawX, rawY, rawZ;
float X, Y, Z;
float rollrad, pitchrad;
float rolldeg, pitchdeg;

int AccelMinX = 0;
int AccelMaxX = 0;
int AccelMinY = 0;
int AccelMaxY = 0;
int AccelMinZ = 0;
int AccelMaxZ = 0; 

int accX = 0;
int accY = 0;
int accZ = 0;

int pitch = 0;
int roll = 0;

void setup(){
   
  Serial.begin(115200);
   
  Serial.println("Ready.");
  Wire.begin();
 
  accel.init(-1, 0, 8);
  accel.setSoftwareOffset(-0.023, 0, 0.03577027);
  accel.printCalibrationValues(40);
 }

void loop(){
  //ACCEL
 /* AccelRotation accelRot;
   
  accelRot = accel.readPitchRoll();
  Serial.print("{Pitch: ");
  Serial.print(accelRot.pitch);
   
   
  Serial.print("Roll: ");
  Serial.print(accelRot.roll);
  Serial.println("}");
  /*
 
  AccelG accelG;
  accelG = accel.readAccelG();
  Serial.print("{X: ");
  Serial.print(accelG.x);
   
   
  Serial.print("Y: ");
  Serial.print(accelG.y);
   
  Serial.print("Z: ");
  Serial.print(accelG.z);
  Serial.println("}");
  */
  delay(20);
  //END ACCEL
}
