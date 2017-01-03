#include <SparkFun_ADXL345.h>
#include <Lib.h>


ADXL345 adxl = ADXL345();
Prints P;
int tmr=0;

void setup()
{
  int x, y, z, inc;
  
  Serial.begin(9600);  
  
  AccelInit();
}

void loop()
{
  int x, y, z, inc, aux;
  int TAPS[450]={0};
  int ret=0;
  
  for(inc=0; inc<450; inc = inc+3) {
    adxl.readAccel(&x, &y, &z);
    TAPS[inc+0]=x;
    TAPS[inc+1]=y;
    TAPS[inc+2]=z;
    delay(10);
    if (ret == 0 && inc >2) {
      ret = ADXL_INTS(TAPS[inc-3], TAPS[inc-2], TAPS[inc-1], x, y, z);
      if(ret != 0) 
        ret=(inc/3);
    }
  }

  if (ret) {
    Serial.println(ret);
    Serial.println("Timer   X   Y   Z");
    for(inc=0; inc<450; inc = inc+3) {
      P.PrintTimer(tmr);
      P.PrintSinal(TAPS[inc+0]);
      P.PrintSinal(TAPS[inc+1]);
      P.PrintSinal(TAPS[inc+2]);
      Serial.println();
    }
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
  if( abs(oldX-newX)>300 && abs(oldZ-newZ)>300 && abs(oldZ-newZ)>300 ) 
    return 2;

  else
    return 0;
}
