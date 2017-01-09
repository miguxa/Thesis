#include <SparkFun_ADXL345.h>
#include <Lib.h>
#include <SD.h>


ADXL345 adxl = ADXL345();
Prints P;
int tmr=0;

void setup()
{
  int x, y, z, inc;
  
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
  
  AccelInit();
}

void loop()
{
  int x, y, z, inc, aux;
  int TAPS[450]={0};
  int ret=0, T=0;
  
  for(inc=0; inc<450; inc = inc+3) {
    adxl.readAccel(&x, &y, &z);
    TAPS[inc+0]=x;
    TAPS[inc+1]=y;
    TAPS[inc+2]=z;
    delay(10);
    if (ret == 0 && inc >2) {
      ret = ADXL_INTS(TAPS[inc-3], TAPS[inc-2], TAPS[inc-1], x, y, z);
      if(ret != 0) 
        T=(inc/3);
    }
  }

  if (ret) {
    Serial.print(T);
    Serial.print("  ");
    Serial.println(ret);
    File fich = SD.open("Ficheiro.xls", FILE_WRITE);
    
    Serial.println("Timer  ; X  ; Y  ; Z");
    fich.println("Timer  ; X  ; Y  ; Z");
    for(inc=0; inc<450; inc = inc+3) {
      P.PrintTimer(tmr);
      P.PrintSinal(TAPS[inc+0]);
      P.PrintSinal(TAPS[inc+1]);
      P.PrintSinal(TAPS[inc+2]);
      Serial.println();
      fich.print(TAPS[inc+0]);
      fich.print(";");
      fich.print(TAPS[inc+0]);
      fich.print(";");
      fich.print(TAPS[inc+0]);
      fich.println();
    }
    fich.close();
  }
  
  Serial.println("----------");
  
  if (ret != 0) {
    delay(1000);
    exit(1);  
  }
}

void AccelInit() {
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

int ADXL_INTS(int &oldX, int &oldY, int &oldZ, int &newX, int &newY, int &newZ) {  
  if( abs(oldX-newX)>500 && abs(oldY-newY)>500 && abs(oldZ-newZ)>500 ) 
    return 5;

  else if( abs(oldX-newX)>400 && abs(oldY-newY)>400 && abs(oldZ-newZ)>400 ) 
    return 4;

  else if( abs(oldX-newX)>300 && abs(oldY-newY)>300 && abs(oldZ-newZ)>300 ) 
    return 3;

  else if( abs(oldX-newX)>200 && abs(oldY-newY)>200 && abs(oldZ-newZ)>200 ) 
    return 2;

  else if( abs(oldX-newX)>100 && abs(oldY-newY)>100 && abs(oldZ-newZ)>100 ) 
    return 1;

  else
    return 0;
}
