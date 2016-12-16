#include <SD.h>
#include <SparkFun_ADXL345.h>

ADXL345 adxl = ADXL345();
int TAPS[120]={0};

void setup()
{
  int aux;

  for (aux=0; aux<30; aux++)
    TAPS[aux]=-1;
  
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
  //int VALS[60]={0};
  int ret;
  
  for(inc=0; inc<120; inc = inc+3) {
    adxl.readAccel(&x, &y, &z);
    TAPS[inc+0]=x;
    TAPS[inc+1]=y;
    TAPS[inc+2]=z;
    delay(5);
    ret = ADXL_INTS();
    
    if (ret == 2) { 
      Serial.println(inc);    
      /*for (aux=0 ; aux<30; aux=aux+3) {
        adxl.readAccel(&x, &y, &z);
        VALS[30+aux]=x;
        VALS[31+aux]=y;
        VALS[32+aux]=z;
        delay(5);
      }
      
      for (aux=27; aux>=0; aux=aux-3) {
        VALS[0+aux]=TAPS[inc+0];
        VALS[1+aux]=TAPS[inc+1];
        VALS[2+aux]=TAPS[inc+2];
      }
      Serial.print(inc);
      for (aux=0; aux<60; aux=aux+3) {
        Serial.print(VALS[aux+0]);
        Serial.print("  ");
        Serial.print(VALS[aux+1]);
        Serial.print("  ");
        Serial.print(VALS[aux+2]);
        Serial.println();
      }*/
    }  
  }

  /*for (aux=0; aux<120; aux=aux+3) {
        Serial.print(TAPS[aux+0]);
        Serial.print("  ");
        Serial.print(TAPS[aux+1]);
        Serial.print("  ");
        Serial.print(TAPS[aux+2]);
        Serial.println();
      }
  Serial.println("----------");*/
  
  
  /*File fich = SD.open("datalog.txt", FILE_WRITE);
  if (fich) {
    for (aux=0; aux<60; aux=aux+3) {
      Serial.print(VALS[aux+0]);
      /*Serial.print("  ");
      Serial.print(VALS[aux+1]);
      Serial.print("  ");
      Serial.print(VALS[aux+2]);
      Serial.println("");
    }
    Serial.println();
    Serial.println();
    Serial.println();
    fich.close();
  }
  else 
    Serial.println("error opening datalog.txt");*/
}

int ADXL_INTS() {
  byte interrupts = adxl.getInterruptSource();
  
  // Free Fall Detection
  if(adxl.triggered(interrupts, ADXL345_FREE_FALL)){
    Serial.println("*** FREE FALL ***");
    return 1;
  } 
  
  // Tap Detection
  if(adxl.triggered(interrupts, ADXL345_SINGLE_TAP)){
    Serial.println("*** TAP ***");
    return 2;
  }

  else
    return 3;
}
