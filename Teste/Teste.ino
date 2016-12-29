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
    delay(5);
    if (ret == 0) {
      ret = ADXL_INTS();
    }
  }

  if (ret) {
    Serial.println("Timer X   Y   Z");
    for(inc=0; inc<450; inc = inc+3) {
      P.PrintTimer(tmr);
      P.PrintSinal(TAPS[inc+0]);
      P.PrintSinal(TAPS[inc+1]);
      P.PrintSinal(TAPS[inc+2]);
    }
  }
  
  Serial.println("----------");
  
  if (ret == 2) {
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
