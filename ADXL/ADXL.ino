// Distributed with a free-will license.
// Use it any way you want, profit or free, provided it fits in the licenses of its associated works.
// ADXL345
// This code is designed to work with the ADXL345_I2CS I2C Mini Module available from ControlEverything.com.
// https://www.controleverything.com/content/Accelorometer?sku=ADXL345_I2CS#tabs-0-product_tabset-2

#include <Wire.h>
#include <SD.h>

// ADXL345 I2C address is 0x53(83)
#define Addr 0x53

class Str {
  public:
    int X;
    int Y;
    int Z;
    int T;    
};

long int timer = 0;
int dly = 1;
File myFile;

void setup()
{
  Serial.begin(9600);
  pinMode(2, INPUT);
  
  InitAcel();
  Serial.println("Timer   X    Y    Z");  
  
  /*if( SD.begin())
    Serial.println("Cartao pronto");
  else
    Serial.println("Cartao com erro");

  myFile = SD.open("test.txt", FILE_WRITE);
  */
  delay(300);
}

void loop()
{
  Str string;
  
  if (digitalRead(2) == HIGH) {
    //Wire.end();
    exit(1);
  }
  
  /*if (timer == 1000) {
    //Wire.end();
    exit(2);
  }*/
 
  string = LerValores();
    
  PrintTimer();
  PrintSinal(string.X);
  PrintSinal(string.Y);
  PrintSinal(string.Z);
  Serial.println();
}

void PrintTimer () {
  if (timer < 10)
    Serial.print("0000");
  else if (timer < 100)
    Serial.print("000");
  else if (timer < 1000)
    Serial.print("00");
  else if (timer < 10000)
    Serial.print("0");
  Serial.print(timer);
  Serial.print(" ");
  timer = timer + dly;
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

Str LerValores() {
  unsigned int data[6];
  Str string;
  
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
      data[i] = Wire.read();
  }
  
  // Convert the data to 10-bits
  int xAccl = (((data[1] & 0x03) * 256) + data[0]);
  if(xAccl > 511)
    xAccl -= 1024;
  
  int yAccl = (((data[3] & 0x03) * 256) + data[2]);
  if(yAccl > 511)
    yAccl -= 1024;
  
  int zAccl = (((data[5] & 0x03) * 256) + data[4]);
  if(zAccl > 511)
    zAccl -= 1024;

  string.X = xAccl;
  string.Y = yAccl;
  string.Z = zAccl;
  string.T = timer;
  
  return string;
}

void InitAcel() {
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
}

