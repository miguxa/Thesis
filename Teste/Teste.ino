#include <SD.h>
#include <SparkFun_ADXL345.h>

ADXL345 adxl = ADXL345();
int timer;

void setup()
{
  Serial.begin(9600);
  
  Serial.println("Initializing SD card...");
  if (!SD.begin(10))
    Serial.println("Card failed, or not present");
  else {
    Serial.println("card initialized.");
    if (SD.exists("datalog.txt"))
      SD.remove("datalog.txt");
  }
  
  Serial.println();
  
  Serial.println("Initializing accelerometer...");
  adxl.powerOn(); 
  adxl.setRangeSetting(2);   
  adxl.setSpiBit(0);                
  adxl.setTapDetectionOnXYZ(0, 0, 1); 
  adxl.setTapThreshold(250);         
  adxl.setTapDuration(40);           
  //adxl.setDoubleTapLatency(80);      
  //adxl.setDoubleTapWindow(200);       
  adxl.setFreeFallThreshold(7);       
  adxl.setFreeFallDuration(30);       
  adxl.FreeFallINT(1);
  //adxl.doubleTapINT(1);
  adxl.singleTapINT(1);
  Serial.println("Accelerometer initialized");
}

void loop()
{
  int x, y, z, inc, aux;
  int TAPS[300];
  int VALS[60];
  char ret;
  String frase = ("HELLO");
  
  for(inc=0; inc<300; inc = inc+3) {
    adxl.readAccel(&x, &y, &z);
    TAPS[inc+0]=x;
    TAPS[inc+1]=y;
    TAPS[inc+2]=z;
    ret = ADXL_INTS();
    delay(5);
      
    if (ret == "S") {
      Serial.println("TAP");
      inc = inc - 30;
      
      for (aux=0 ; aux<30; aux=aux+3) {
        adxl.readAccel(&x, &y, &z);
        VALS[30+aux]=x;
        VALS[31+aux]=y;
        VALS[32+aux]=z;
      }
      
      for (aux=0; aux<30; aux=aux+3) {
        VALS[0+aux]=TAPS[inc+0];
        VALS[1+aux]=TAPS[inc+1];
        VALS[2+aux]=TAPS[inc+2];
      }
      
    }    
  }
  
  File fich = SD.open("datalog.txt", FILE_WRITE);
  if (fich) {
    for (aux=0; aux<60; aux=aux+3) {
      Serial.print(VALS[aux+0]);
      /*Serial.print("  ");
      Serial.print(VALS[aux+1]);
      Serial.print("  ");
      Serial.print(VALS[aux+2]);*/
      Serial.println("");
    }
    Serial.println();
    Serial.println();
    Serial.println();
    fich.close();
  }
  else 
    Serial.println("error opening datalog.txt");
  delay(2000);
}

char ADXL_INTS() {
  byte interrupts = adxl.getInterruptSource();
  
  // Free Fall Detection
  if(adxl.triggered(interrupts, ADXL345_FREE_FALL)){
    Serial.println("*** FREE FALL ***");
    return "F";
  } 
  
  // Tap Detection
  if(adxl.triggered(interrupts, ADXL345_SINGLE_TAP)){
    Serial.println("*** TAP ***");
    return "S";
  }

  else
    return NULL;
}
