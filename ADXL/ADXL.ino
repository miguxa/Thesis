// Distributed with a free-will license.
// Use it any way you want, profit or free, provided it fits in the licenses of its associated works.
// ADXL345
// This code is designed to work with the ADXL345_I2CS I2C Mini Module available from ControlEverything.com.
// https://www.controleverything.com/content/Accelorometer?sku=ADXL345_I2CS#tabs-0-product_tabset-2

#include <Wire.h>
#include <SD.h>

// ADXL345 I2C address is 0x53(83)
#define Addr 0x53

long int timer = 0;
int dly = 1;
File myFile;

void setup()
{
  Serial.begin(9600);
  pinMode(2, INPUT);
  
  InitAcel();
  
  
  /*if( SD.begin())
    Serial.println("Cartao pronto");
  else
    Serial.println("Cartao com erro");

  myFile = SD.open("test.txt", FILE_WRITE);
  */
}

void loop()
{
  int S[400];
  int i=0;

  Serial.println("Press to start");

  while(digitalRead(2) == LOW)
    ;
  
  if (digitalRead(2) == HIGH) {
    Serial.println("Leitura iniciada");
    
    for (i=0; i<400; i=i+4) { 
      LerValores(S[i], S[i+1], S[i+2], S[i+3]);
      timer = timer + dly;
      delay(50);
    }
    
    Serial.println("Leitura terminada");
    delay(1000);
    Serial.println("Timer   X    Y    Z");  
  
    for (i=0; i<400; i=i+4) {
      PrintTimer(S[i]);
      PrintSinal(S[i+1]);
      PrintSinal(S[i+2]);
      PrintSinal(S[i+3]);
      Serial.println();
    }
    
    delay(100);
    Serial.print("!");
  }
  
  if (timer == 1000) {
    //Wire.end();
    exit(2);
  }
}

void PrintTimer (int tmr) {
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

void LerValores(int &T, int &X, int &Y, int &Z) {
  unsigned int data[6];
  int string[4];
  
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
  int xAccl = (data[0] + ((data[1] & 0x03) * 256));
  int yAccl = (data[2] + ((data[3] & 0x03) * 256));
  int zAccl = (data[4] + ((data[5] & 0x03) * 256));

  if(xAccl > 511)
    xAccl -= 1024;
    
  if(yAccl > 511)
    yAccl -= 1024;
  
  if(zAccl > 511)
    zAccl -= 1024;

  T = timer;
  X = xAccl;
  Y = yAccl;
  Z = zAccl;
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

