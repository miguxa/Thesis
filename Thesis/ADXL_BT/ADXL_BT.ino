// Distributed with a free-will license.
// Use it any way you want, profit or free, provided it fits in the licenses of its associated works.
// ADXL345
// This code is designed to work with the ADXL345_I2CS I2C Mini Module available from ControlEverything.com.
// https://www.controleverything.com/content/Accelorometer?sku=ADXL345_I2CS#tabs-0-product_tabset-2

#include <Wire.h>
#include <ADXL345.h>

// ADXL345 I2C address is 0x53(83)
#define Addr 0x53
ADXL345 adxl;

byte buff[6];

long int timer = 0;
int lastValue = 0;

void setup()
{
  Serial.begin(9600);
  pinMode(2, INPUT);
  pinMode(12, OUTPUT);
  pinMode(A4, INPUT);
  digitalWrite(12,LOW);
  


  //Terminate former I2C communication
  Wire.end();
  // Initialise I2C communication as MASTER
  Wire.begin();
  // Start I2C Transmission
  Wire.beginTransmission(Addr);
  // Select bandwidth rate register
  Wire.write(0x2C);
  // Normal mode, Output data rate = 100 Hz
  Wire.write(0x0A);
  // Select power control register
  Wire.write(0x2D);
  // Auto-sleep disable
  Wire.write(0x08);
  // Select data format register
  Wire.write(0x31);
  // Self test disabled, 4-wire interface, Full resolution, Range = +/-2g
  Wire.write(0x08);
  // Stop I2C transmission
  Wire.endTransmission();
  
  adxl.setRangeSetting(2);
  adxl.setRate(3200);
  
  delay(300);
}

void loop()
{ 
  ledOnOff();
  
  
  unsigned int data[2];
  
  for(int i = 0; i < 2; i++)
  {
    // Start I2C Transmission
    Wire.beginTransmission(Addr);
    // Select data register
    Wire.write((52 + i));
    // Stop I2C transmission
    Wire.endTransmission();
    
    // Request 1 byte of data
    Wire.requestFrom(Addr, 1);
    
    // Read 6 bytes of data
    // xAccl lsb, xAccl msb, yAccl lsb, yAccl msb, zAccl lsb, zAccl msb
    if(Wire.available() == 1)
      data[i] = Wire.read();
  }
  //int yAccl = (((int)data[1]) << 8 ) | data[0];
  
  // Convert the data to 10-bits
  int yAccl = (((data[1] & 0x03) * 256) + data[0]);
  if(yAccl > 511)
    yAccl -= 1024;
  /*
  if (timer < 10)
    Serial.print("0");
  if (timer < 100)
    Serial.print("0");
  if (timer < 1000)
    Serial.print("0");
  if (timer < 10000)
    Serial.print("0");
  Serial.print(timer++);

  if (yAccl >= 0)
    Serial.print("+");
  else {
    Serial.print("-");
    yAccl = yAccl * -1;
  }
  if (abs(yAccl) < 10)
    Serial.print("0");
  if (abs(yAccl) < 100)
    Serial.print("0");
    */
  
  Serial.println(yAccl);
  delay(50);
}

void ledOnOff() {
  char BTVal;
  
  if(Serial.available())
    BTVal=Serial.read();
  
  if ((digitalRead(2) == HIGH) || (BTVal == 'o')) {
    if ((lastValue == 1)) {
      digitalWrite(12, LOW);
      Serial.println("LED is off");
      lastValue = 3;
    }
    else if ((lastValue == 0)) {
      digitalWrite(12, HIGH);
      Serial.println("LED is on");
      lastValue = 2;
    }
    delay(100);
  }

  if ((digitalRead(2) == LOW)) {
    if (lastValue == 2)
      lastValue = 1;
    
    else if ((lastValue == 3))
      lastValue = 0;
  }
}

void StartAcel() {
  //Terminate former I2C communication
  Wire.end();
  // Initialise I2C communication as MASTER
  Wire.begin();
  // Start I2C Transmission
  Wire.beginTransmission(Addr);
  // Select bandwidth rate register
  Wire.write(0x2C);
  // Normal mode, Output data rate = 100 Hz
  Wire.write(0x0A);
  // Select power control register
  Wire.write(0x2D);
  // Auto-sleep disable
  Wire.write(0x08);
  // Select data format register
  Wire.write(0x31);
  // Self test disabled, 4-wire interface, Full resolution, Range = +/-2g
  Wire.write(0x08);
  // Stop I2C transmission
  Wire.endTransmission();
  delay(300);
}

void dadosAceler () {
  unsigned int data[6];
  
  for(int i = 0; i < 6; i++)
  {
    // Start I2C Transmission
    Wire.beginTransmission(Addr);
    // Select data register
    Wire.write((50 + i));
    // Stop I2C transmission
    Wire.endTransmission();
    
    // Request 1 byte of data
    Wire.requestFrom(Addr, 1);
    
    // Read 6 bytes of data
    // xAccl lsb, xAccl msb, yAccl lsb, yAccl msb, zAccl lsb, zAccl msb
    if(Wire.available() == 1)
    {
      data[i] = Wire.read();
    }
  }
  
  // Convert the data to 10-bits
  int xAccl = (((data[1] & 0x03) * 256) + data[0]);
  if(xAccl > 511)
  {
    xAccl -= 1024;
  }
  int yAccl = (((data[3] & 0x03) * 256) + data[2]);
  if(yAccl > 511)
  {
    yAccl -= 1024;
  }
  int zAccl = (((data[5] & 0x03) * 256) + data[4]);
  if(zAccl > 511)
  {
    zAccl -= 1024;
  }
 
 if (yAccl >= 0)
    Serial.print("+");
  if (yAccl == 0)
    Serial.print("00");
  else if (yAccl > 0 && yAccl < 10)
    Serial.print("00");
  else if (yAccl >= 10 && yAccl < 100)
    Serial.print("0");
  else if (yAccl < 0 && yAccl > -10)
    Serial.print("-00");
  else if (yAccl <= -10 && yAccl > -100)
    Serial.print("-0");
  if (yAccl < 0 && yAccl > -100)
    yAccl = yAccl * -1;
  Serial.print(yAccl);

  Serial.println("");
  delay(50);
}

void Time () {
  if (timer < 10)
    Serial.print("0000");
  else if (timer < 100)
    Serial.print("000");
  else if (timer < 1000)
    Serial.print("00");
  else if (timer < 10000)
    Serial.print("0");
  Serial.print(timer);
  timer++;
}

