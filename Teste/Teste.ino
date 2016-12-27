#include <SparkFun_ADXL345.h>
#include <Lib.h>


ADXL345 adxl = ADXL345();
Prints P;
int tmr=0;
int TAPS[120]={0};

void setup()
{
  int x, y, z, inc;
  
  Serial.begin(9600);  
  
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

  for (inc=0; inc<30; inc=inc+3) {
    adxl.readAccel(&x, &y, &z);
    TAPS[inc+0]=x;
    TAPS[inc+1]=y;
    TAPS[inc+2]=z;
  }
}

void loop()
{
  int x, y, z, inc, aux;
  int VALS[60]={0};
  int ret=0;
  
  for(inc=30; inc<120; inc = inc+3) {
    adxl.readAccel(&x, &y, &z);
    TAPS[inc+0]=x;
    TAPS[inc+1]=y;
    TAPS[inc+2]=z;
    delay(5);
    ret = ADXL_INTS();
    
    if (ret == 2) { 
      Serial.println(inc);    
      for (aux=0 ; aux<45; aux=aux+3) {
        adxl.readAccel(&x, &y, &z);
        VALS[15+aux]=x;
        VALS[16+aux]=y;
        VALS[17+aux]=z;
        delay(5);
      }
      
      for (aux=0; aux<15; aux=aux+3) {
        VALS[0+aux]=TAPS[inc+aux+0];
        VALS[1+aux]=TAPS[inc+aux+1];
        VALS[2+aux]=TAPS[inc+aux+2];
      }
      
      for (aux=0; aux<60; aux=aux+3) {
        P.PrintTimer(tmr);
        P.PrintSinal(VALS[aux+0]);
        P.PrintSinal(VALS[aux+1]);
        P.PrintSinal(VALS[aux+2]);
        Serial.println("");
      }
      
      break;
    }  
  }

  if (ret != 2) {
    for (aux=0; aux<30; aux=aux+3) {
      TAPS[aux+0] = TAPS[aux+90];
      TAPS[aux+1] = TAPS[aux+91];
      TAPS[aux+2] = TAPS[aux+92];
    }
  }
  
  Serial.println("----------");
  
  if (ret == 2) {
    delay(1000);
    exit(1);  
  }
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
