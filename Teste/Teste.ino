#include <SparkFun_ADXL345.h>
#include <Lib.h>
#include <SD.h>


ADXL345 adxl = ADXL345();
Prints P;
int tmr=1;

void setup()
{
  int x, y, z;
  
  Serial.begin(9600);    

  SD_init();
  
  Serial.println();
  
  AccelInit();
}

void loop()
{
  int x, y, z, aux;
  int TAPS[123]={0};
  int ret=0, T=0;
  
  for(tmr=0; tmr<123; tmr = tmr+3) {
    adxl.readAccel(&x, &y, &z);
    TAPS[tmr+0]=x;
    TAPS[tmr+1]=y;
    TAPS[tmr+2]=z;
    delay(10);
    if (ret == 0 && tmr >2) {
      ret = ADXL_INTS(TAPS[tmr-3], TAPS[tmr-2], TAPS[tmr-1], x, y, z);
      if(ret != 0) 
        T=(tmr/3);
    }
  }

  if (ret) {
    Serial.print(T);
    Serial.print("  ");
    Serial.println(ret);
    
    Serial.println("Tempo ;  X   ;  Y   ; Z");
    
    for(tmr=0; tmr<41; tmr++) {
      Serial.print(P.Timer(tmr));
      Serial.print(P.Sinal(TAPS[(tmr*3)+0]));
      Serial.print(P.Sinal(TAPS[(tmr*3)+1]));
      Serial.print(P.Sinal(TAPS[(tmr*3)+2]));
      Serial.println();
    }
    delay(1000);

    WriteSD(TAPS);
    }
  
  Serial.println("----------");
  
  if (ret != 0) {
    delay(1000);
    exit(1);  
  }
}

void AccelInit() {
  Serial.println("A inicializar acelerometro");
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
  Serial.println("Acelerometro inicializado");
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

void SD_init() {
  Serial.println("A inicializar cartao SD");
  // see if the card is present and can be initialized:
  if (!SD.begin(10))
    Serial.println("Falha na leitura do cartao");
  else {
    Serial.println("Cartao inicializado");
    if (SD.exists("datalog.txt"))
      SD.remove("datalog.txt");
  }
}
  
void WriteSD (int TAPS[]) {  
  File fich = SD.open("datalog.txt", FILE_WRITE);
  if (fich){
    Serial.println("A escrever no cartao SD");
    fich.println("Tempo ;  X   ;  Y   ; Z");
    for(tmr=0; tmr<41; tmr++) {
      fich.print(P.Timer(tmr));
      fich.print(P.Sinal(TAPS[(tmr*3)+0]));
      fich.print(P.Sinal(TAPS[(tmr*3)+1]));
      fich.print(P.Sinal(TAPS[(tmr*3)+2]));
      fich.println();
    }
    Serial.println("Escrita no cartao SD concluida");
    fich.close();
  }
  else
    Serial.print("ERROR");

}

