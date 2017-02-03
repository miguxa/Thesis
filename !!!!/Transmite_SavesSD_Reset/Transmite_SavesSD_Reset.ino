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
  pinMode(2, INPUT);  
  SD_init();  
  AccelInit();
}

void loop()
{
  int x, y, z;
  int TAPS[120]={0};
  int ret=0, T=0;
  
  for(tmr=0; tmr<120; tmr = tmr+3) {
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
    Serial.println("Tempo ;  X   ;  Y   ; Z");

    String S;
    for(tmr=0; tmr<40; tmr++) {
      S = S + P.Sinal(TAPS[(tmr*3)+0]);
      S = S + P.Sinal(TAPS[(tmr*3)+1]);
      S = S + P.Sinal(TAPS[(tmr*3)+2]);
      Serial.println(S);
      S = "";
    }
    Serial.print(ret);
    Serial.print(" ");
    if(T<10)
      Serial.print("0");
    Serial.println(T);
    WriteSD(TAPS);
    Serial.println("----------");
  }  
  
  while (ret != 0) {
    if(digitalRead(2) == HIGH){
      ret = 0;
    }
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
  adxl.setFreeFallThreshold(7);       
  adxl.setFreeFallDuration(30);       
  adxl.FreeFallINT(1);
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
  if (!SD.begin(10)) {
    Serial.println("Falha na leitura do cartao");
  }
  else {
    Serial.println("Cartao inicializado");
    if (SD.exists("datalog.csv"))
      SD.remove("datalog.csv");
  }
}
  
void WriteSD (int TAPS[]) {  
  File fich = SD.open("datalog.csv", FILE_WRITE);
  if (fich){
    Serial.println("A escrever no cartao SD");
    fich.println("Tempo ;  X   ;  Y   ; Z");
    for(tmr=0; tmr<40; tmr++) {
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

